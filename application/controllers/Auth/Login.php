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
		$this->load->helper( [ 'form', 'url', 'htmlpurifier', 'app' ] );
		$this->load->library( [ 'form_validation', 'session', 'user_agent' ] );
		$this->load->model( 'user_model' );
	}

	public function index() {
		set_ref();
		if ( ! checkAuth( $this ) ) {
			$fb = '';
			try {
				$fb = new \Facebook\Facebook( [
					'app_id'                => getenv( 'FB_APP_ID' ), // Replace {app-id} with your app id
					'app_secret'            => getenv( 'FB_APP_SECRET' ),
					'default_graph_version' => 'v2.2',
				] );
			} catch ( \Facebook\Exceptions\FacebookSDKException $e ) {
			}

			$helper = $fb->getRedirectLoginHelper();

			$permissions = [ 'email' ]; // Optional permissions
			$callbackUrl = 'http://' . getenv( 'BASE_URL' ) . '/facebook/handle_callback';
			$loginUrl    = $helper->getLoginUrl( $callbackUrl, $permissions );
			$this->load->view( 'layout/header' );
			$this->load->view( 'auth/login', [
				'loginUrl' => $loginUrl
			] );
			$this->load->view( 'layout/footer_without_cards' );
		} else {

			if ( null !== get_ref() ) {
				redirect( get_ref() );
			} else {
				redirect( base_url() );
			}
		}
	}

	public function post() {
		$this->email    = html_purify( $this->input->post( 'email' ) );
		$this->password = html_purify( $this->input->post( 'password' ) );
		$this->form_validation->set_rules( 'email', 'Email', 'trim|required|valid_email|min_length[10]|max_length[255]|callback_check_if_email_exists', [
			'check_if_email_exists' => '{field} do not exists',
		] );
		$this->form_validation->set_rules( 'password', 'Password', 'required' );

		if ( $this->form_validation->run() == false ) {
			try {
				$fb = new \Facebook\Facebook( [
					'app_id'                => getenv( 'FB_APP_ID' ), // Replace {app-id} with your app id
					'app_secret'            => getenv( 'FB_APP_SECRET' ),
					'default_graph_version' => 'v2.2',
				] );
			} catch ( \Facebook\Exceptions\FacebookSDKException $e ) {
			}
			$helper      = $fb->getRedirectLoginHelper();
			$permissions = [ 'email' ]; // Optional permissions
			$callbackUrl = 'http://' . getenv( 'BASE_URL' ) . '/facebook/handle_callback';
			$loginUrl    = $helper->getLoginUrl( $callbackUrl, $permissions );
			$this->load->view( 'layout/header' );
			$this->load->view( 'auth/login', [
				'loginUrl' => $loginUrl
			] );

			$this->load->view( 'layout/footer_without_cards' );
		} else {

			if ( $this->user_model->check_if_email_and_pass_matches( $this->email, $this->password ) ) {
				$this->session->set_userdata( [
					getenv( 'SESSION_USER_EMAIL' )      => $this->email,
					getenv( 'SESSION_UID' )             => $this->user_model->get_data_by_email( $this->email )[0]->id,
					getenv( 'SESSION_USER_SAFE_EMAIL' ) => explode( '@', $this->email )[0]
				] );
			} else {
				$response['type']    = 'danger';
				$response['message'] = 'Email or password doesn\'t not matches';
				$this->session->set_flashdata( 'response', $response );
				redirect( base_url( '/auth/login' ) );
			}

			if ( get_ref() !== null ) {
				redirect( get_ref() );
			} else {
				redirect( base_url() );
			}
		}
	}

	public function check_if_email_exists( $email ) {
		if ( $this->user_model->check_if_email_already_exists( $email ) > 0 ) {
			return true;
		} else {
			return false;
		}
	}
}