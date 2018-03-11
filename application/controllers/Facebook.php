<?php
/**
 * Project: edu_app
 * Author: gopalindians <$USER_EMAIL>
 * Date: 12-03-2018
 * Time: 00:01
 * Link:
 */

class Facebook extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->helper( [ 'form', 'url', 'htmlpurifier' ] );
		$this->load->library( [ 'form_validation', 'session', 'user_agent' ] );
	}


	public function handle_callback(): void {
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
		try {
			$accessToken = $helper->getAccessToken();
		} catch ( Facebook\Exceptions\FacebookResponseException $e ) {
			// When Graph returns an error
			echo 'Graph returned an error: ' . $e->getMessage();
			exit;
		} catch ( Facebook\Exceptions\FacebookSDKException $e ) {
			// When validation fails or other local issues
			echo 'Facebook SDK returned an error: ' . $e->getMessage();
			exit;
		}

		if ( ! isset( $accessToken ) ) {
			if ( $helper->getError() ) {
				header( 'HTTP/1.0 401 Unauthorized' );
				echo 'Error: ' . $helper->getError() . "\n";
				echo 'Error Code: ' . $helper->getErrorCode() . "\n";
				echo 'Error Reason: ' . $helper->getErrorReason() . "\n";
				echo 'Error Description: ' . $helper->getErrorDescription() . "\n";
			} else {
				header( 'HTTP/1.0 400 Bad Request' );
				echo 'Bad request';
			}
			exit;
		}

		// Logged in
		echo '<h3>Access Token</h3>';
		var_dump( $accessToken->getValue() );

		// The OAuth 2.0 client handler helps us manage access tokens
		$oAuth2Client = $fb->getOAuth2Client();

		// Get the access token metadata from /debug_token
		$tokenMetadata = $oAuth2Client->debugToken( $accessToken );
		echo '<h3>Metadata</h3>';
		var_dump( $tokenMetadata->getUserId() );

		// Validation (these will throw FacebookSDKException's when they fail)
		try {
			$tokenMetadata->validateAppId( getenv( 'FB_APP_ID' ) );
		} catch ( \Facebook\Exceptions\FacebookSDKException $e ) {
		} // Replace {app-id} with your app id
		// If you know the user ID this access token belongs to, you can validate it here
		//$tokenMetadata->validateUserId('123');
		$tokenMetadata->validateExpiration();

		if ( ! $accessToken->isLongLived() ) {
			// Exchanges a short-lived access token for a long-lived one
			try {
				$accessToken = $oAuth2Client->getLongLivedAccessToken( $accessToken );
			} catch ( Facebook\Exceptions\FacebookSDKException $e ) {
				echo '<p>Error getting long-lived access token: ' . $helper->getMessage() . "</p>\n\n";
				exit;
			}

			echo '<h3>Long-lived</h3>';
			//var_dump( $accessToken->getValue() );
		}

		$_SESSION['fb_access_token'] = (string) $accessToken;

		// User is logged in with a long-lived access token.
		// You can redirect them to a members-only page.
		//header('Location: https://example.com/members.php');

		//var_dump( $_SESSION['fb_access_token'] );


		$response = '';
		try {
			// Returns a `Facebook\FacebookResponse` object
			$response = $fb->get( '/me?fields=id,name,email', (string) $accessToken );
		} catch ( Facebook\Exceptions\FacebookResponseException $e ) {
			echo 'Graph returned an error: ' . $e->getMessage();
			exit;
		} catch ( Facebook\Exceptions\FacebookSDKException $e ) {
			echo 'Facebook SDK returned an error: ' . $e->getMessage();
			exit;
		}

		$user = $response->getGraphUser();

		var_dump($user->getEmail());

		//echo 'Name: ' . $user->ge;

		exit(1);// OR
		//// echo 'Name: ' . $user->getName();

	}
}