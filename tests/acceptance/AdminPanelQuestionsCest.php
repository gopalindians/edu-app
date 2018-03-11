<?php


class AdminPanelQuestionsCest {
	public function _before( AcceptanceTester $I ) {
	}

	public function _after( AcceptanceTester $I ) {
	}

	// tests
	public function seeAdminPanelQuestionsPage( AcceptanceTester $I ) {
		$I->amOnPage( '/admin/questions' );
		$I->seeResponseCodeIs( 200 );
	}
}
