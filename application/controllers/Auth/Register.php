<?php
/**
 * Project: edu_app
 * Author: gopalindians <$USER_EMAIL>
 * Date: 07-01-2018
 * Time: 20:01
 * Link:
 */

defined( 'BASEPATH' ) OR exit( 'No direct script access allowed' );


class Register extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->helper( [ 'form', 'url' ] );
		$this->load->library( [ 'form_validation', 'session' ] );
		$this->load->model( 'user_model' );
	}

	public function index() {
		$this->load->view( 'layout/header' );
		$this->load->view( 'auth/register' );
		$this->load->view( 'layout/footer' );
	}

	public function post() {
		$email            = $this->input->post( 'email' );
		$password         = $this->input->post( 'password' );
		$confirm_password = $this->input->post( 'confirm_password' );


		$this->form_validation->set_rules( 'email', 'Email', 'trim|required|valid_email|min_length[10]|max_length[255]|is_unique[users.email]|callback_check_if_email_already_exists' );
		$this->form_validation->set_rules( 'password', 'Password', 'required' );
		$this->form_validation->set_rules( 'confirm_password', 'Confirm Password', 'required|matches[password]' );


		if ( $this->form_validation->run() == false ) {
			$this->load->view( 'layout/header' );
			$this->load->view( 'auth/register' );
			$this->load->view( 'layout/footer' );
		} else {
			$this->load->model( 'user_model' );
			$user                    = $this->user_model->save_new_user( $email, $password );
			$response['message']     = 'account created successfully';
			$response['status_code'] = 200;
			$response['user']        = $user;

			$this->session->set_userdata( [ 'UE' => $user ] );

			$this->session->set_flashdata( 'response', $response );
			redirect( '/auth/register' );


		}
	}

	public function check_if_email_already_exists( $email ) {
		if ( $this->user_model->check_if_email_already_exists( $email ) > 0 ) {
			$this->form_validation->set_message( 'check_if_email_already_exists', '{field} is already in use' );

			return false;
		} else {
			return true;
		}
	}

}