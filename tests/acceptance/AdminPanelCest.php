<?php


class AdminPanelCest {
	public function _before( AcceptanceTester $I ) {
	}

	public function _after( AcceptanceTester $I ) {
	}

	// tests
	public function seeHomePage( AcceptanceTester $I ) {
		$I->amOnPage( '/admin' );
		$I->see( 'You are inside admin mode! Take care' );
	}


	public function seeLoginPage( AcceptanceTester $I ) {
		$I->amOnPage( '/admin/auth/login' );
		$I->see( 'Email address' );
		$I->see( 'Password' );
	}

	public function seeRegisterPage( AcceptanceTester $I ) {
		$I->amOnPage( '/admin/auth/register' );
		$I->seeInCurrentUrl( 'register' );
		$I->seeElement( 'input', [ 'type' => 'email', 'name' => 'admin_email' ] );
		$I->seeElement( 'input', [ 'type' => 'password', 'name' => 'pass' ] );
		$I->seeElement( 'input', [ 'type' => 'password', 'name' => 'confirm_pass' ] );
	}


	public function dontSeeErrorAfterSubmittingRegisterPage( AcceptanceTester $I ) {
		$this->seeRegisterPage( $I );

		$I->submitForm( 'form', [
			'email'        => 'gopalindians@gmail.com',
			'pass'         => '12345678',
			'confirm_pass' => '12345678'
		] );

		$I->seeResponseCodeIs(200);
	}


}
