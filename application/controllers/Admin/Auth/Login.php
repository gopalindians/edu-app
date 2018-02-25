<?php
/**
 * Project: edu_app
 * Author: gopalindians <$USER_EMAIL>
 * Date: 24-02-2018
 * Time: 14:56
 * Link:
 */

class Login extends CI_Controller {

	public $admin_email;
	public $pass;

	public function __construct() {
		parent::__construct();
		$this->load->helper( [ 'form', 'url' ] );
		$this->load->library( [ 'form_validation', 'session' ] );
		$this->load->model( 'admin_model' );
	}

	public function index() {
		if ( ! $this->checkAuth() ) {
			$this->load->view( 'admin/layout/header' );
			$this->load->view( 'admin/auth/login' );
			$this->load->view( 'admin/layout/footer' );
		} else {
			redirect( '/admin/' );
		}
	}

	public function post() {
		$this->admin_email = $this->input->post( 'admin_email' );
		$this->pass        = $this->input->post( 'pass' );

		$this->form_validation->set_rules( 'admin_email', 'Email', 'trim|required|valid_email|min_length[10]|max_length[255]|callback_check_admin_email|callback_check_if_admin_email_and_admin_pass_matches',
			[
				'check_admin_email'                           => '{field} do not exists',
				'check_if_admin_email_and_admin_pass_matches' => '{field} and password not matches'
			] );
		$this->form_validation->set_rules( 'pass', 'Password', 'required' );

		if ( $this->form_validation->run() == false ) {
			$this->load->view( 'admin/layout/header' );
			$this->load->view( 'admin/auth/login' );
			$this->load->view( 'admin/layout/footer' );
		} else {
			$this->session->set_userdata( [ 'AE' => $this->admin_email ] );
			redirect( '/admin' );
		}
	}

	public function check_admin_email( $admin_email ) {
		if ( $this->admin_model->check_if_email_already_exists( $admin_email ) > 0 ) {
			return true;
		} else {
			return false;
		}
	}

	public function check_if_admin_email_and_admin_pass_matches( $admin_email, $pass ) {
		if ( $this->admin_model->check_if_admin_email_and_admin_pass_matches( $this->admin_email, $this->pass ) ) {
			return true;
		} else {
			return false;
		}
	}


	/**
	 * @return bool
	 */
	private function checkAuth() {
		if ( $this->session->has_userdata( 'AE' ) ) {
			return true;
		} else {
			return false;
		}
	}
}