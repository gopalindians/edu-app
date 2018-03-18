<?php if ( ! defined( 'BASEPATH' ) ) {
	exit( 'No direct script access allowed' );
}

if ( ! function_exists( 'get_full_url' ) ) {
	function get_full_url() {

		$currentURL = current_url(); //for simple URL

		$params = $_SERVER['QUERY_STRING']; //for parameters

		if ( $params != '' ) {
			return $currentURL . '?' . $params;
		}

		return $currentURL;
	}
}


if ( ! function_exists( 'checkAuth' ) ) {
	function checkAuth( $_this ) {
		if ( $_this->session->has_userdata( getenv( 'SESSION_USER_EMAIL' ) ) ) {
			return true;
		}

		return false;
	}
}


if ( ! function_exists( 'set_ref' ) ) {
	function set_ref() {
		$_SESSION['ref'] = $_SERVER['HTTP_REFERER'] ?? '';

		return true;
	}
}

if ( ! function_exists( 'get_ref' ) ) {
	function get_ref() {
		return $_SESSION['ref'] ?? '';
	}
}