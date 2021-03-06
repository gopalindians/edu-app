<?php

defined( 'BASEPATH' ) OR exit( 'No direct script access allowed' );

/**
 * Project: edu_app
 * Author: gopalindians <gopalindians@gmail.com>
 * Date: 07-01-2018
 * Time: 19:17
 * Link:
 */
class Login extends CI_Controller {
	private $user_email;
	private $password;


	/**
	 * Login constructor.
	 */
	public function __construct() {
		parent::__construct();


		$this->load->helper( [ 'form', 'url', 'htmlpurifier', 'app' ] );
		$this->load->library( [ 'form_validation', 'session', 'user_agent' ] );
		$this->load->model( 'user_model' );
		//$this->config->item( 'language' );
		$this->lang->load( 'auth_login', check_lang() );
	}

	public function index(): void {
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
			$callbackUrl = getenv( 'BASE_URL' ) . '/facebook/handle_callback';
			$loginUrl    = $helper->getLoginUrl( $callbackUrl, $permissions );
			$this->load->view( 'layout/header' );
			$this->load->view( 'auth/login', [ 'loginUrl' => $loginUrl ] );
			$this->load->view( 'layout/footer_without_cards' );
		} else {

			if ( '' !== get_ref() ) {
				header('Location: '.get_ref());
			} else {
				header('Location: /');
			}
		}
	}

	public function post(): void {
		$this->user_email = html_purify( $this->input->post( 'email' ) );
		$this->password   = $this->input->post( 'password' );
		$this->form_validation->set_rules( 'email', 'Email', 'trim|required|valid_email|min_length[5]|max_length[255]|callback_check_if_email_exists', [ 'check_if_email_exists' => '{field} do not exists', ] );
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
			$callbackUrl = 'https://' . getenv( 'BASE_URL' ) . '/facebook/handle_callback';
			$loginUrl    = $helper->getLoginUrl( $callbackUrl, $permissions );
			$this->load->view( 'layout/header' );
			$this->load->view( 'auth/login', [
				'loginUrl' => $loginUrl
			] );

			$this->load->view( 'layout/footer_without_cards' );
		} else {
			if ( $this->user_model->check_if_email_and_pass_matches( $this->user_email, $this->password ) ) {
				$this->session->set_userdata( [
					getenv( 'SESSION_USER_EMAIL' )      => $this->user_email,
					getenv( 'SESSION_UID' )             => $this->user_model->get_data_by_email( $this->user_email )[0]->id,
					getenv( 'SESSION_USER_SAFE_EMAIL' ) => explode( '@', $this->user_email )[0]
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

	/**
	 * @param $email
	 *
	 * @return bool|null
	 *
	 */
	public function check_if_email_exists( $email ): ?bool {
		return $this->user_model->check_if_email_already_exists( $email ) > 0;
	}
}