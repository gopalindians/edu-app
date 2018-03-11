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
		$this->load->helper( [ 'form', 'url', 'htmlpurifier' ] );
		$this->load->library( [ 'form_validation', 'session' ] );
		$this->load->model( 'user_model' );
	}

	public function index(): void {
		if ( ! $this->checkAuth() ) {
			$this->load->view( 'layout/header' );
			$this->load->view( 'auth/register' );
			$this->load->view( 'layout/footer_without_cards' );
		} else {
			redirect( '/' );
		}
	}

	public function post(): void {
		$email            = html_purify( $this->input->post( 'email' ) );
		$password         = html_purify( $this->input->post( 'password' ) );
		$confirm_password = html_purify( $this->input->post( 'confirm_password' ) );


		$this->form_validation->set_rules( 'email', 'Email', 'trim|required|min_length[10]|max_length[255]|is_unique[users.email]|callback_check_if_email_already_exists|callback_check_if_a_valid_email', [
			'check_if_a_valid_email' => '{field} is not valid'
		] );
		$this->form_validation->set_rules( 'password', 'Password', 'required' );
		$this->form_validation->set_rules( 'confirm_password', 'Confirm Password', 'required|matches[password]' );


		if ( $this->form_validation->run() == false ) {
			$this->load->view( 'layout/header' );
			$this->load->view( 'auth/register' );
			$this->load->view( 'layout/footer_without_cards' );
		} else {


			$user                = $this->user_model->save_new_user( $email, $password );
			$response['message'] = 'Account created successfully';
			$response['type']    = 'success';
			$response['user']    = $user;
			$this->session->set_userdata( [ 'UE' => $user ] );
			$this->session->set_flashdata( 'response', $response );
			redirect( '/auth/register' );
		}
	}

	public function check_if_email_already_exists( $email ): bool {
		if ( $this->user_model->check_if_email_already_exists( $email ) > 0 ) {
			$this->form_validation->set_message( 'check_if_email_already_exists', '{field} is already in use' );

			return false;
		} else {
			return true;
		}
	}

	private function checkAuth(): bool {
		if ( $this->session->has_userdata( 'UE' ) ) {
			return true;
		} else {
			return false;
		}
	}

	public function check_if_a_valid_email( $email ): bool {
		return ( filter_var( $email, FILTER_VALIDATE_EMAIL ) && preg_match( '/@.+\./', $email ) );
	}
}