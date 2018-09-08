<?php
/**
 * Project: edu_app
 * Author: gopalindians <$USER_EMAIL>
 * Date: 07-09-2018
 * Time: 21:19
 * Link:
 */

class Feedback extends CI_Controller {

	private $user_email;
	private $feedback;

	/**
	 * Feedback constructor.
	 */
	public function __construct() {
		parent::__construct();

		$this->load->helper( [ 'form', 'url', 'htmlpurifier', 'app' ] );
		$this->load->library( [ 'form_validation', 'session', 'user_agent' ] );
		$this->load->model( 'feedback_model' );
	}

	public function index() {
		$this->load->view( 'layout/header',['title'=>'Feedback']  );
		$this->load->view( 'feedback/index' );
		$this->load->view( 'layout/footer_without_cards' );
	}

	public function post() {
		$this->user_email = $this->input->post( 'email' );
		$this->feedback   = $this->input->post( 'feedback' );

		$this->form_validation->set_rules( 'email', 'Email', 'trim|required|valid_email|min_length[5]|max_length[255]' );
		$this->form_validation->set_rules( 'feedback', 'Feedback', 'trim|required|min[12]|max[1500]' );
		if ( $this->form_validation->run() == false ) {
			$this->load->view( 'layout/header',['title'=>'Feedback'] );
			$this->load->view( 'feedback/index' );
			$this->load->view( 'layout/footer_without_cards' );

		} else {
			$this->feedback_model->save_feedback( $this->user_email, $this->feedback, $_SERVER['HTTP_REFERER'] ?? '', $this->get_client_ip(), $_SERVER['HTTP_USER_AGENT'] ?? '' );
			$this->load->view( 'layout/header',['title'=>'Feedback'] );
			$this->load->view( 'feedback/index' );
			$this->load->view( 'layout/footer_without_cards' );
			$response['type']    = 'success';
			$response['message'] = 'Thanks for your feedback';
			$this->session->set_flashdata( 'response', $response );
			redirect( base_url( '/feedback/index' ) );
		}
	}




	/**
	 *
	 * Function to get the client IP address
	 * @see https://stackoverflow.com/a/15699240/1847730
	 * @return string
	 */
	private function get_client_ip() {
		$ipaddress = '';
		if ( isset( $_SERVER['HTTP_CLIENT_IP'] ) ) {
			$ipaddress = $_SERVER['HTTP_CLIENT_IP'];
		} else if ( isset( $_SERVER['HTTP_X_FORWARDED_FOR'] ) ) {
			$ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
		} else if ( isset( $_SERVER['HTTP_X_FORWARDED'] ) ) {
			$ipaddress = $_SERVER['HTTP_X_FORWARDED'];
		} else if ( isset( $_SERVER['HTTP_FORWARDED_FOR'] ) ) {
			$ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
		} else if ( isset( $_SERVER['HTTP_FORWARDED'] ) ) {
			$ipaddress = $_SERVER['HTTP_FORWARDED'];
		} else if ( isset( $_SERVER['REMOTE_ADDR'] ) ) {
			$ipaddress = $_SERVER['REMOTE_ADDR'];
		} else {
			$ipaddress = 'UNKNOWN';
		}

		return $ipaddress;
	}

}