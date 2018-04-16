<?php

defined( 'BASEPATH' ) OR exit( 'No direct script access allowed' );

/**
 * Project: edu_app
 * Author: gopalindians <gopalindians@gmail.com>
 * Date: 06-02-2018
 * Time: 23:36
 * Link:
 */
class Logout extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->helper( [ 'url' ] );
		$this->load->library( [ 'session' ] );
	}

	public function index(): void {
		$this->session->unset_userdata( 'AE' );
		redirect( 'admin/auth/login' );
	}
}