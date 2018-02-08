<?php
/**
 * Project: edu_app
 * Author: gopalindians <$USER_EMAIL>
 * Date: 07-01-2018
 * Time: 20:01
 * Link:
 */

defined( 'BASEPATH' ) OR exit( 'No direct script access allowed' );


require APPPATH . 'libraries/REST_Controller.php';

use Restserver\Libraries\REST_Controller;

class Register extends REST_Controller {

	public function index_post() {

		$email    = $this->post( 'email' );
		$password = $this->post( 'password' );


		$this->load->model( 'user_model' );

		if ( ! filter_var( $email, FILTER_VALIDATE_EMAIL ) ) {
			$response['message']     = 'email is not valid';
			$response['status_code'] = REST_Controller::HTTP_BAD_REQUEST;
			$this->response( $response, REST_Controller::HTTP_BAD_REQUEST );

		} else if ( $this->user_model->check_if_email_already_exists( $email ) > 0 ) {
			$response['message']     = 'email already occupied';
			$response['status_code'] = REST_Controller::HTTP_BAD_REQUEST;
			$this->response( $response, REST_Controller::HTTP_BAD_REQUEST );

		} else {

			$user                    = $this->user_model->save_new_user( $email, $password );
			$response['message']     = 'account created successfully';
			$response['status_code'] = REST_Controller::HTTP_CREATED;
			$response['data']        = $user;
			$this->response( $response, REST_Controller::HTTP_CREATED );
		}


	}

	public function index_get() {
		$this->response( [ 'user' => 'gopal' ], 201 );
	}

}