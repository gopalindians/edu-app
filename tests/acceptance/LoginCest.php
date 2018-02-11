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
		$I->submitForm( 'form', [ 'email' => 'MilesDavis', 'password' => 'miles@davis.com' ] );
		$I->see( 'Thank you for Signing Up!' );

	}
}
