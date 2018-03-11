<?php
/**
 * Project: edu_app
 * Author: gopalindians <$USER_EMAIL>
 * Date: 11-03-2018
 * Time: 01:21
 * Link:
 */

class Profile extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->helper( [ 'form', 'url' ] );
		$this->load->library( [ 'form_validation', 'session', 'pagination' ] );
		$this->load->model( 'user_model' );
		$this->load->model( 'question_model' );
	}

	public function view( $profile_id, $safe_email ) {
		$this->load->view( 'layout/header' );
		$this->load->view( 'profile/view', [] );
		$this->load->view( 'layout/footer' );
	}
}