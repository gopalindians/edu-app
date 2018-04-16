<?php
/**
 * Project: edu_app
 * Author: gopalindians <gopalindians@gmail.com>
 * Date: 07-02-2018
 * Time: 00:27
 * Link:
 */

defined( 'BASEPATH' ) OR exit( 'No direct script access allowed' );

class Question extends CI_Controller {
	private $question_id;
	private $question_text;
	private $question_slug;
	private $question_description;

	private $user_email;
	private $user_id;

	/**
	 * Question constructor.
	 */
	public function __construct() {
		parent::__construct();
		$this->load->helper( [ 'form', 'url', 'app', 'text' ] );
		$this->load->library( [ 'form_validation', 'session', 'minify' ] );
		$this->load->model( 'question_model' );
		$this->load->model( 'comment_model' );
		$this->load->model( 'user_model' );
	}

	/**
	 * shows question
	 *
	 * @param        $id   int question_id
	 * @param string $slug string question_slug
	 */
	public function view( $id, $slug = 'NULL' ): void {
		set_ref();
		$this->question_id = $id;
		$question          = $this->question_model->get_question_by_id( $id );
		$this->load->view( 'layout/header', [
			'title'       => character_limiter( $question[0]->question_text ?? '', 55 ),
			'keywords'    => $question[0]->question_text ?? '',
			'description' => word_limiter( $question[0]->question_text ?? '', 150 )
		] );
		$limit    = 5;
		$offset   = 0;
		$comments = $this->comment_model->get_comments_by_question_id( $this->question_id, $limit, $offset );
		$this->load->view( 'question/view', [
			'question' => $question,
			'comments' => $comments
		] );
		$this->load->view( 'layout/footer' );
	}

	/**
	 * show add new question form
	 */
	public function add(): void {
		if ( checkAuth( $this ) ) {
			$this->load->view( 'layout/header' );
			$this->load->view( 'question/add' );
			$this->load->view( 'layout/footer' );
		} else {
			redirect( base_url( 'auth/login' ) );
		}
	}

	/**
	 * Handle adding new question
	 */
	public function post(): void {
		if ( checkAuth( $this ) ) {
			$this->question_text        = $this->input->post( 'question_text' );
			$this->question_slug        = $this->slug( $this->input->post( 'question_text' ) );
			$this->question_description = $this->input->post( 'question_description' );
			$this->form_validation->set_rules( 'question_text', 'Question text', 'trim|required|min_length[10]|max_length[255]' );
			$this->form_validation->set_rules( 'question_description', 'Question description', 'required' );

			if ( $this->form_validation->run() == false ) {
				$this->load->view( 'layout/header' );
				$this->load->view( 'question/add' );
				$this->load->view( 'layout/footer' );
			} else {
				$this->user_email   = $this->session->userdata()['UE'];
				$this->user_id = $this->user_model->get_data_by_email( $this->user_email )[0]->id;
				$response      = $this->question_model->save_new_question( $this->user_id, $this->question_text, $this->question_slug, $this->question_description );
				$this->session->set_flashdata( 'response', $response );
				redirect( '/' );
			}
		} else {
			redirect( base_url( 'auth/login' ) );
		}
	}

	/**
	 * @param $z
	 *
	 * @return string
	 */
	private function slug( $z ): string {
		$z = strtolower( $z );
		$z = preg_replace( '/[^a-z0-9 -]+/', '', $z );
		$z = str_replace( ' ', '-', $z );

		return trim( $z, '-' );
	}

	/**
	 * @param        $id
	 * @param string $slug
	 */
	public function edit( $id, $slug = 'NULL' ): void {
		$question = $this->question_model->get_question_by_id( $id );
		$this->load->view( 'layout/header', [
			'title'       => character_limiter( $question[0]->question_text ?? '', 55 ),
			'keywords'    => $question[0]->question_text ?? '',
			'description' => word_limiter( $question[0]->question_text ?? '', 150 )
		] );
		$this->load->view( 'question/edit', [ 'question' => $question ] );
		$this->load->view( 'layout/footer' );
	}

	/**
	 * Handle question edit
	 *
	 * @param  int   $id   question id
	 * @param string $slug question slug
	 */
	public function post_edit( $id, $slug = 'NULL' ): void {

		$this->question_id          = $this->uri->segment( 2 );
		$this->question_slug        = $this->uri->segment( 3 );
		$this->question_text        = $this->input->post( 'question_text' );
		$this->question_description = $this->input->post( 'question_description' );
		$question                   = $this->question_model->get_question_by_id( $id );
		$this->form_validation->set_rules( 'question_text', 'Question text', 'trim|required|min_length[10]|max_length[255]' );
		$this->form_validation->set_rules( 'question_description', 'Question description', 'required|max_length[1500]' );
		if ( $this->form_validation->run() == false ) {
			$this->load->view( 'layout/header' );
			$this->load->view( 'question/edit', [ 'question' => $question ] );
			$this->load->view( 'layout/footer' );

		} else {
			//if logged in user and question posted by the user matches update the question
			if ( $this->session->get_userdata()[ getenv( 'SESSION_UID' ) ] == $this->question_model->get_question_by_id( $this->question_id )[0]->user_id ) {
				$this->question_model->update_question( $this->session->get_userdata()[ getenv( 'SESSION_UID' ) ], $this->question_id, $this->question_text, $this->question_description, $this->slug( $this->question_text ) );
			} else {
				redirect( base_url( 'auth/login' ) );
			}
			$response['type']    = 'success';
			$response['message'] = 'Question updated successfully!';
			$this->session->set_flashdata( 'response', $response );
			redirect( base_url( 'question/' . $this->question_id . '/' . $this->question_slug ) );
		}
	}
}