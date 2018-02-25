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
		$this->load->helper( [ 'form', 'url' ] );
		$this->load->library( [ 'form_validation', 'session' ] );
		$this->load->model( 'admin_model' );
	}

	public function index() {
		if ( $this->checkAuth() ) {
			$this->load->view( 'admin/layout/header' );
			$this->load->view( 'admin/index' );
			$this->load->view( 'admin/layout/footer' );
		} else {
			redirect( '/admin/auth/login' );
		}
	}

	private function checkAuth() {
		if ( $this->session->has_userdata( 'AE' ) ) {
			return true;
		} else {
			return false;
		}
	}
}