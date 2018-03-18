<?php

defined( 'BASEPATH' ) OR exit( 'No direct script access allowed' );

/**
 * Project: edu_app
 * Author: gopalindians <$USER_EMAIL>
 * Date: 06-02-2018
 * Time: 23:36
 * Link:
 */
class Logout extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->helper( [ 'url', 'app' ] );
		$this->load->library( [ 'session' ] );
		set_ref();
	}

	public function index() {
		$this->session->unset_userdata( getenv( 'SESSION_UID' ) );
		$this->session->unset_userdata( getenv( 'SESSION_USER_EMAIL' ) );
		$this->session->unset_userdata( getenv( 'SESSION_USER_SAFE_EMAIL' ) );
		$this->session->unset_userdata( 'FBRLH_state' );
		$this->session->unset_userdata( 'fb_access_token' );
		$this->session->unset_userdata( 'facebook_email' );
		$this->session->unset_userdata( 'facebook_first_name' );
		$this->session->unset_userdata( 'facebook_last_name' );
		$this->session->unset_userdata( 'facebook_profile_picture' );
		redirect( get_ref() );
	}
}