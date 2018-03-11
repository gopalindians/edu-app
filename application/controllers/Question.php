<?php
/**
 * Project: edu_app
 * Author: gopalindians <$USER_EMAIL>
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

	private $email;
	private $user_id;

	public function __construct() {
		parent::__construct();
		$this->load->helper( [ 'form', 'url' ] );
		$this->load->library( [ 'form_validation', 'session','minify' ] );
		$this->load->model( 'question_model' );
		$this->load->model( 'comment_model' );
		$this->load->model( 'user_model' );
	}


	public function view( $id, $slug = 'NULL' ) {
		$this->question_id = $id;
		$this->load->view( 'layout/header' );

		$question = $this->question_model->get_question_by_id( $id );

		$limit    = 5;
		$offset   = 0;
		$comments = $this->comment_model->get_comments_by_question_id( $this->question_id, $limit, $offset );
		$this->load->view( 'question/view', [
			'question' => $question,
			'comments' => $comments
		] );
		$this->load->view( 'layout/footer' );
	}


	public function add() {
		if ( $this->checkAuth() ) {
			$this->load->view( 'layout/header' );
			$this->load->view( 'question/add' );
			$this->load->view( 'layout/footer' );
		} else {
			if ( isset( $_SERVER['HTTP_REFERER'] ) && $_SERVER['HTTP_REFERER'] !== base_url() ) {
				$referral_url = str_replace( base_url(), '', $_SERVER['HTTP_REFERER'] );
				redirect( '/auth/login?referrer=' . $referral_url );
			} else {
				redirect( '/auth/login' );
			}

		}
	}

	public function post() {
		if ( $this->checkAuth() ) {
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
				$this->email   = $this->session->userdata()['UE'];
				$this->user_id = $this->user_model->get_data_by_email( $this->email )[0]->id;
				$response      = $this->question_model->save_new_question( $this->user_id, $this->question_text, $this->question_slug, $this->question_description );
				$this->session->set_flashdata( 'response', $response );
				redirect( '/' );
			}
		} else {
			redirect( '/auth/login' );
		}
	}

	private function checkAuth() {
		if ( $this->session->has_userdata( 'UE' ) ) {
			return true;
		} else {
			return false;
		}
	}

	private function slug( $z ) {
		$z = strtolower( $z );
		$z = preg_replace( '/[^a-z0-9 -]+/', '', $z );
		$z = str_replace( ' ', '-', $z );

		return trim( $z, '-' );
	}


	public function edit( $id, $slug = 'NULL' ) {
		$this->load->view( 'layout/header' );
		$question = $this->question_model->get_question_by_id( $id );
		$this->load->view( 'question/edit', [ 'question' => $question ] );
		$this->load->view( 'layout/footer' );
	}

	public function post_edit( $id, $slug = 'NULL' ) {

		$this->load->view( 'layout/header' );
		$question = $this->question_model->get_question_by_id( $id );
		$this->load->view( 'question/edit', [ 'question' => $question ] );
		$this->load->view( 'layout/footer' );
	}
}