<?php


class RegisterCest {
	public function _before( AcceptanceTester $I ) {
	}

	public function _after( AcceptanceTester $I ) {
	}

	// tests
	public function seeRegisterPage( AcceptanceTester $I ) {
		$I->amOnPage( '/auth/register' );
		$I->see( 'We\'ll never share your email with anyone else.' );
	}


}
