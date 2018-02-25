<?php


class LoginCest {
	public function _before( AcceptanceTester $I ) {
	}

	public function _after( AcceptanceTester $I ) {
	}

	// tests
	public function seeLoginPage( AcceptanceTester $I ) {
		$I->amOnPage( 'auth/login' );
		$I->see( 'Email address' );
	}


	public function submitLoginFormSeeError( AcceptanceTester $I ) {
		$I->amOnPage( '/auth/login' );
		$I->submitForm( 'form', [ 'email' => 'miles@davis.co', 'password' => '12345678' ] );
		$I->dontSee( 'Thank you for Signing Up!' );
	}
}
