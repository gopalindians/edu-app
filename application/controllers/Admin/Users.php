<?php
/**
 * Project: edu_app
 * Author: gopalindians <gopalindians@gmail.com>
 * Date: 16-04-2018
 * Time: 23:49
 * Link:
 */

class Users extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->helper( [ 'form', 'url' ] );
		$this->load->library( [ 'form_validation', 'session' ] );
		$this->load->model( 'admin_model' );
		$this->load->model( 'report_model' );
		$this->load->model( 'admin/user_model' );
	}

	public function index(): void {
		if ( $this->checkAuth() ) {
			$this->load->view( 'admin/layout/header' );
			$this->load->view( 'admin/users', [ 'users' => $this->user_model->get_users( 10, 1 ) ] );
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