<?php


class HomePageCest {
	public function _before( AcceptanceTester $I ) {
	}

	public function _after( AcceptanceTester $I ) {
	}

	// tests
	public function HomePageWorks( AcceptanceTester $I ) {
		$I->amOnPage( '/' );
		$I->see( 'Special title treatment' );
	}
}
