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

	/**
	 * @var String  Email address of admin
	 */
	private $admin_email;

	/**
	 * @var String  Password of admin
	 */
	private $pass;

	/**
	 * @var String  Confirm password for admin
	 */
	private $confirm_pass;

	/**
	 * Register constructor.
	 */
	public function __construct() {
		parent::__construct();
		$this->load->helper( [ 'form', 'url' ] );
		$this->load->library( [ 'form_validation', 'session' ] );
		$this->load->model( 'admin_model' );
	}

	public function index(): void {
		if ( ! $this->checkAuth() ) {
			$this->load->view( 'admin/layout/header' );
			$this->load->view( 'admin/auth/register' );
			$this->load->view( 'admin/layout/footer' );
		} else {
			redirect( '/admin' );
		}
	}

	public function post(): void {
		$this->admin_email  = $this->input->post( 'admin_email' );
		$this->pass         = $this->input->post( 'pass' );
		$this->confirm_pass = $this->input->post( 'confirm_pass' );

		$this->form_validation->set_rules( 'admin_email', 'Email', 'trim|required|valid_email|min_length[10]|max_length[255]|is_unique[admins.admin_email]|callback_check_if_email_already_exists' );
		$this->form_validation->set_rules( 'pass', 'Password', 'required' );
		$this->form_validation->set_rules( 'confirm_pass', 'Confirm Password', 'required|matches[pass]' );


		if ( $this->form_validation->run() == false ) {
			$this->load->view( 'layout/header' );
			$this->load->view( 'auth/register' );
			$this->load->view( 'layout/footer' );
		} else {
			$this->load->model( 'admin_model' );
			$admin                   = $this->admin_model->save_new_admin( $this->admin_email, $this->pass );
			$response['message']     = 'account created successfully';
			$response['status_code'] = 200;
			$response['admin']       = $admin;

			$this->session->set_userdata( [ 'AE' => $admin ] );
			$this->session->set_flashdata( 'response', $response );
			redirect( 'admin/home' );
		}
	}

	public function check_if_email_already_exists( $email ): ?bool {
		if ( $this->admin_model->check_if_email_already_exists( $email ) > 0 ) {
			$this->form_validation->set_message( 'check_if_email_already_exists', '{field} is already in use' );

			return false;
		}

		return true;
	}

	private function checkAuth(): bool {
		if ( $this->session->has_userdata( 'AE' ) ) {
			return true;
		}

		return false;
	}

}