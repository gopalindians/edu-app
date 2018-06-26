<?php
/**
 * Project: edu_app
 * Author: gopalindians <$USER_EMAIL>
 * Date: 17-04-2018
 * Time: 22:19
 * Link:
 */

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Forgot extends CI_Controller {

	private $user_email;

	public function __construct() {
		parent::__construct();

		$this->load->helper( [ 'form', 'url', 'htmlpurifier', 'app' ] );
		$this->load->library( [ 'form_validation', 'session', 'user_agent' ] );
		$this->load->model( 'user_model' );
	}

	public function show_forgot_page(): void {
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
			$this->load->view( 'auth/show_forgot', [ 'loginUrl' => $loginUrl ] );
			$this->load->view( 'layout/footer_without_cards' );
		} else {
			if ( null !== get_ref() ) {
				redirect( get_ref() );
			} else {
				redirect( base_url() );
			}
		}
	}

	public function post_forgot_page(): void {
		$mail_flag        = false;
		$this->user_email = html_purify( $this->input->post( 'email' ) );
		$this->form_validation->set_rules( 'email', 'Email', 'trim|required|valid_email|min_length[5]|max_length[255]|callback_check_if_email_exists', [ 'check_if_email_exists' => '{field} do not exists', ] );
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
			$helper      = $fb->getRedirectLoginHelper();
			$permissions = [ 'email' ]; // Optional permissions
			$callbackUrl = 'https://' . getenv( 'BASE_URL' ) . '/facebook/handle_callback';
			$loginUrl    = $helper->getLoginUrl( $callbackUrl, $permissions );
			$this->load->view( 'layout/header' );
			$this->load->view( 'auth/show_forgot', [ 'loginUrl' => $loginUrl ] );
			$this->load->view( 'layout/footer_without_cards' );
		} else {
			//email is valid and exists
			//no send email to the user
			$mail = new PHPMailer();                              // Passing `true` enables exceptions
			try {
				//Server settings
				$mail->SMTPDebug = ( getenv( 'ENV' ) === 'production' ) ? 0 : 1;                                 // Enable verbose debug output
				$mail->isSMTP();                                      // Set mailer to use SMTP
				$mail->Host        = 'smtp.gmail.com';  // Specify main and backup SMTP servers
				$mail->SMTPAuth    = true;                               // Enable SMTP authentication
				$mail->Username    = 'gopalindians@gmail.com';                 // SMTP username
				$mail->Password    = '9149669099!@#QWe345';                           // SMTP password
				$mail->SMTPSecure  = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
				$mail->Port        = 465;                                    // TCP port to connect to
				$mail->SMTPAutoTLS = false;
				$mail->XMailer     = '';

				//Recipients
				$mail->setFrom( 'gopalindians@gmail.com', 'Mailer' );
				$mail->addAddress( $this->user_email, '' );     // Add a recipient

				//Content
				$mail->isHTML( true );                                  // Set email format to HTML
				$mail->Subject = 'Password reset request - ' . getenv( 'APP_NAME' );
				//$mail->Body    = $this->render_email( $this->user_email, '' );
				$mail->Body    = 'Please click on the link to reset password:'.getenv('APP_URL').'/';
				$mail->CharSet = 'utf-8';
				$mail_flag     = $mail->send();
			} catch ( Exception $e ) {
				echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
				exit( 1 );
			}
			if ( $mail_flag ) {
				$response['type']    = 'success';
				$response['message'] = 'We have sen you an email regarding this';
				$this->session->set_flashdata( 'response', $response );
				redirect( base_url( '/auth/forgot-password' ) );
			}
		}
	}

	public function check_if_email_exists( $email ): ?bool {
		return $this->user_model->check_if_email_already_exists( $email ) > 0;
	}

	public function render_email( $email, $message ): string {
		ob_start();
//		include $this->load->view( 'auth/forgot_password_email_template.php' );
		return ob_get_contents();
	}
}