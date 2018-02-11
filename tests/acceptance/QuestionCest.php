<?php


class QuestionCest {
	public function _before( AcceptanceTester $I ) {
	}

	public function _after( AcceptanceTester $I ) {
	}

	// tests
	public function dontSeeAddQuestionPageWhenNotAuthorized( AcceptanceTester $I ) {
		$I->amOnPage( '/question/add' );
		$I->seeInCurrentUrl('auth/login');
	}
}
