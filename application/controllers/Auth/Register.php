<?php
/**
 * Project: edu_app
 * Author: gopalindians <$USER_EMAIL>
 * Date: 07-01-2018
 * Time: 20:01
 * Link:
 */

defined( 'BASEPATH' ) OR exit( 'No direct script access allowed' );
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


class Register extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->helper( [ 'form', 'url', 'htmlpurifier', 'app' ] );
		$this->load->library( [ 'form_validation', 'session' ] );
		$this->load->model( 'user_model' );
		$this->load->model( 'user_meta_model' );
	}

	public function index(): void {
		set_ref();
		if ( ! $this->checkAuth() ) {
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
			$callbackUrl = 'https://' . getenv( 'BASE_URL' ) . '/facebook/handle_callback';
			$loginUrl    = $helper->getLoginUrl( $callbackUrl, $permissions );
			$this->load->view( 'layout/header' );
			$this->load->view( 'auth/register', [
				'loginUrl' => $loginUrl
			] );
			$this->load->view( 'layout/footer_without_cards' );
		} else {
			redirect( get_ref() );
		}
	}

	public function post(): void {
		$email            = html_purify( $this->input->post( 'email' ) );
		$password         = html_purify( $this->input->post( 'password' ) );
		$confirm_password = html_purify( $this->input->post( 'confirm_password' ) );


		$this->form_validation->set_rules( 'email', 'Email', 'trim|required|min_length[5]|max_length[255]|is_unique[users.email]|callback_check_if_email_already_exists|callback_check_if_a_valid_email', [
			'check_if_a_valid_email' => '{field} is not valid'
		] );
		$this->form_validation->set_rules( 'password', 'Password', 'required' );
		$this->form_validation->set_rules( 'confirm_password', 'Confirm Password', 'required|matches[password]' );


		if ( $this->form_validation->run() == false ) {
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
			$callbackUrl = 'https://' . getenv( 'BASE_URL' ) . '/facebook/handle_callback';
			$loginUrl    = $helper->getLoginUrl( $callbackUrl, $permissions );
			$this->load->view( 'layout/header' );
			$this->load->view( 'auth/register', [
				'loginUrl' => $loginUrl
			] );
			$this->load->view( 'layout/footer_without_cards' );
		} else {
			$user                = $this->user_model->save_new_user( $email, $password );
			$user_meta_info      = $this->user_meta_model->save_new_user_meta( $user['user_id'] );
			$response['message'] = 'Account created successfully';
			$response['type']    = 'success';
			$response['user']    = $user;
			$this->session->set_userdata( [
				getenv( 'SESSION_USER_EMAIL' )      => $user['email'],
				getenv( 'SESSION_UID' )             => $user['user_id'],
				getenv( 'SESSION_USER_SAFE_EMAIL' ) => explode( '@', $user['email'] )[0],
			] );

			$mail = new PHPMailer();                              // Passing `true` enables exceptions
			try {
				//Server settings
				$mail->SMTPDebug = ( getenv( 'ENV' ) === 'production' ) ? 0 : 4;                                 // Enable verbose debug output
				$mail->isSMTP();                                      // Set mailer to use SMTP
				$mail->Host        = 'tls://smtp.gmail.com:587';  // Specify main and backup SMTP servers
				$mail->SMTPAuth    = true;                               // Enable SMTP authentication
				$mail->Username    = 'gopalindians@gmail.com';                 // SMTP username
				$mail->Password    = '9149669099!@#QWe345';                           // SMTP password
				$mail->SMTPSecure  = 'tls';                            // Enable TLS encryption, `ssl` also accepted
				$mail->Port        = 587;                                    // TCP port to connect to
				$mail->SMTPAutoTLS = false;

				//Recipients
				$mail->setFrom( 'gopalindians@gmail.com', 'Mailer' );
				$mail->addAddress( $email, '' );     // Add a recipient

				//Content
				$mail->isHTML( true );                                  // Set email format to HTML
				$mail->Subject = 'Hello welcome to ' . getenv( 'APP_NAME' );
				$mail->Body    = 'Hi, <b>Welcome to' . getenv( 'APP_NAME' ) . ' !</b>';
				$mail->send();
			} catch ( Exception $e ) {
				//echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
			}
			$this->session->set_flashdata( 'response', $response );
			//header( 'Cache-Control: no cache' );
			redirect( '' );
		}
	}

	public function check_if_email_already_exists( $email ): bool {
		if ( $this->user_model->check_if_email_already_exists( $email ) > 0 ) {
			$this->form_validation->set_message( 'check_if_email_already_exists', '{field} is already in use' );

			return false;
		}

		return true;
	}

	private function checkAuth(): bool {
		if ( $this->session->has_userdata( 'UE' ) ) {
			return true;
		}

		return false;
	}

	public function check_if_a_valid_email( $email ): bool {
		return ( filter_var( $email, FILTER_VALIDATE_EMAIL ) && preg_match( '/@.+\./', $email ) );
	}
}