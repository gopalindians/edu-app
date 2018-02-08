<?php
/**
 * Project: edu_app
 * Author: gopalindians <$USER_EMAIL>
 * Date: 07-01-2018
 * Time: 20:01
 * Link:
 */

defined( 'BASEPATH' ) OR exit( 'No direct script access allowed' );


class Home extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->helper( [ 'form', 'url' ] );
		$this->load->library( [ 'form_validation', 'session' ] );
		$this->load->model( [ 'user_model', 'question_model' ] );
	}

	public function index() {
		$this->load->view( 'layout/header' );
		$this->load->view( 'layout/sidebar' );

		$questions = $this->question_model->get_questions();

		foreach ( $questions as $question ) {
			$question->question_description = ( strlen( $question->question_description ) > 40 ) ? substr( $question->question_description, 0, 41 ) . '...' : $question->question_description;
		}

		$this->load->view( 'home/index', [ 'questions' => $questions ] );

		$this->load->view( 'layout/footer' );
	}
}