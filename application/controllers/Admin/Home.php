<?php
/**
 * Project: edu_app
 * Author: gopalindians <$USER_EMAIL>
 * Date: 24-02-2018
 * Time: 14:57
 * Link:
 */

class Home extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->helper( [ 'form', 'url','app' ] );
		$this->load->library( [ 'form_validation', 'session' ] );
		$this->load->model( 'admin_model' );
		$this->load->model( 'report_model' );
	}

	public function index(): void {
		if ( $this->checkAuth() ) {
			$this->load->view( 'admin/layout/header' );
			$this->load->view( 'admin/index', [ 'reports' => $this->report_model->get_all_reports() ] );
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