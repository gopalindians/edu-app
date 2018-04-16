<?php
/**
 * Project: edu_app
 * Author: gopalindians <$USER_EMAIL>
 * Date: 10-03-2018
 * Time: 19:13
 * Link:
 */
class Comment extends CI_Controller {

	private $question_id;
	private $comment_body;
	private $user_email;
	private $user_id;
	private $limit;
	private $offset;

	public function __construct() {
		parent::__construct();
		$this->load->helper( [ 'form', 'url', 'htmlpurifier', 'app' ] );
		$this->load->library( [ 'form_validation', 'session' ] );
		$this->load->model( 'question_model' );
		$this->load->model( 'comment_model' );
		$this->load->model( 'user_model' );
	}


	public function post_comment( $id, $slug = 'NULL' ): void {
		if ( checkAuth( $this ) ) {
			$this->comment_body = html_purify( $this->input->post( 'question_comment' ) );
			$this->question_id  = html_purify( $id );
			if ( $this->comment_body === '' ) {
				$response['type']    = 'warning';
				$response['message'] = 'Comment cannot be empty';
				$this->session->set_flashdata( 'response', $response );
				redirect( '/question/' . $this->question_id . '/' . $slug, 'GET' );
			}
			$this->email   = $this->session->userdata()[ getenv( 'SESSION_USER_EMAIL' ) ];
			$this->user_id = $this->user_model->get_data_by_email( $this->email )[0]->id;

			$this->comment_model->save_new_comment( $this->user_id, $this->comment_body, $this->question_id );

			$url = '/question/' . $this->question_id . '/' . $slug;
			header( 'Location: ' . $url, true, 303 );
			die();
		}

		redirect( base_url( 'auth/login' ) );
	}

	public function get_more_comments(): void {

		/*$question_id, $limit, $offset*/
		$this->question_id = $this->input->post( 'question_id' );
		$this->limit       = $this->input->post( 'limit' );
		$this->offset      = $this->input->post( 'offset' );

		$more_comments = $this->comment_model->get_comments_by_question_id( $this->question_id, $this->limit, $this->offset );

		$this->output
			->set_content_type( 'application/json' )
			->set_output( json_encode( [
				'comments' => $more_comments,
				'csrf'     => $this->security->get_csrf_hash(),
			] ) );
	}
}