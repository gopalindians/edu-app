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


if ( ! function_exists( 'preferred_language' ) ) {

	function preferred_language( $available_languages, $http_accept_language ) {

		$available_languages = array_flip( $available_languages );
		$langs               = [];
		preg_match_all( '~([\w-]+)(?:[^,\d]+([\d.]+))?~', strtolower( $http_accept_language ), $matches, PREG_SET_ORDER );
		foreach ( $matches as $match ) {

			[ $a, $b ] = explode( '-', $match[1] ) + [ '', '' ];
			$value = isset( $match[2] ) ? (float) $match[2] : 1.0;
			if ( isset( $available_languages[ $match[1] ] ) ) {
				$langs[ $match[1] ] = $value;
				continue;
			}
			if ( isset( $available_languages[ $a ] ) ) {
				$langs[ $a ] = $value - 0.1;
			}
		}
		if ( $langs ) {
			arsort( $langs );

			return key( $langs ); // We don't need the whole array of choices since we have a match
		}
	}
}

if ( ! function_exists( 'check_lang' ) ) {
	function check_lang() {
		if ( isset( $_SERVER['HTTP_ACCEPT_LANGUAGE'] ) ) {
			$supported_languages = [ 'en', 'hi' ];
			if ( in_array( preferred_language( $supported_languages, $_SERVER['HTTP_ACCEPT_LANGUAGE'] ), $supported_languages, true ) ) {
				return preferred_language( $supported_languages, $_SERVER['HTTP_ACCEPT_LANGUAGE'] );
			}
		}
		return 'en';
	}
}