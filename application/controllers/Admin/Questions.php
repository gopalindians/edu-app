<?php
/**
 * Project: edu_app
 * Author: gopalindians <$USER_EMAIL>
 * Date: 10-03-2018
 * Time: 16:49
 * Link:
 */

class Questions extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->helper( [ 'form', 'url' ] );
		$this->load->library( [ 'form_validation', 'session' ] );
		$this->load->model( 'admin_model' );
		$this->load->model( 'report_model' );
		$this->load->model( 'admin/question_model' );
	}

	public function index(): void {
		if ( $this->checkAuth() ) {
			$this->load->view( 'admin/layout/header' );
			$this->load->view( 'admin/questions', [
				'questions' => $this->question_model->get_questions( 10, 1 )
			] );
			$this->load->view( 'admin/layout/footer' );
		} else {
			redirect( '/admin/auth/login' );
		}
	}

	private function checkAuth(): ?bool {
		if ( $this->session->has_userdata( 'AE' ) ) {
			return true;
		}

		return false;
	}

}