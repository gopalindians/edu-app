<?php

defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Project: edu_app
 * Author: gopalindians <$USER_EMAIL>
 * Date: 07-01-2018
 * Time: 19:17
 * Link:
 */

#require(APPPATH.'libraries/REST_Controller.php');

#require APPPATH . 'libraries/REST_Controller.php';
class Login extends \Restserver\Libraries\REST_Controller {


	public function __construct()
	{
		// Construct the parent class
		parent::__construct();
		// Configure limits on our controller methods
		// Ensure you have created the 'limits' table and enabled 'limits' within application/config/rest.php
		$this->methods['users_get']['limit'] = 500; // 500 requests per hour per user/key
		$this->methods['users_post']['limit'] = 100; // 100 requests per hour per user/key
		$this->methods['users_delete']['limit'] = 50; // 50 requests per hour per user/key
	}

	public function index_get() {
		$this->response( [ 'user' => 'gopal' ], 201 );
	}

}