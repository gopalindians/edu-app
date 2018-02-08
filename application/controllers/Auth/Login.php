<?php

defined( 'BASEPATH' ) OR exit( 'No direct script access allowed' );

/**
 * Project: edu_app
 * Author: gopalindians <$USER_EMAIL>
 * Date: 07-01-2018
 * Time: 19:17
 * Link:
 */
class Login extends CI_Controller {

	private $email;
	private $password;


	public function __construct() {
		parent::__construct();
		$this->load->helper( [ 'form', 'url' ] );
		$this->load->library( [ 'form_validation', 'session' ] );
		$this->load->model( 'user_model' );
	}

	public function index() {
		$this->load->view( 'layout/header' );
		$this->load->view( 'auth/login' );
		$this->load->view( 'layout/footer' );
	}

	public function post() {
		$this->email    = $this->input->post( 'email' );
		$this->password = $this->input->post( 'password' );


		$this->form_validation->set_rules( 'email', 'Email', 'trim|required|valid_email|min_length[10]|max_length[255]|callback_check_if_email_exists' );
		$this->form_validation->set_rules( 'password', 'Password', 'required' );

		if ( $this->form_validation->run() == false ) {
			$this->load->view( 'layout/header' );
			$this->load->view( 'auth/login' );
			$this->load->view( 'layout/footer' );
		} else {
			$this->session->set_userdata( [ 'UE' => $this->email ] );
			redirect( '/' );
		}
	}

	public function check_if_email_exists( $email ) {
		if ( $this->user_model->check_if_email_already_exists( $email ) > 0 ) {
			$this->form_validation->set_message( 'check_if_email_exists', '{field} do not exists' );
			return TRUE;
		} else {
			return FALSE;
		}
	}
}