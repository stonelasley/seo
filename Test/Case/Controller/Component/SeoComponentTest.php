<?php
App::uses('Controller', 'Controller');
App::uses('Component', 'Controller');
App::uses('ComponentCollection', 'Controller');
App::uses('BlackListComponent', 'Seo.Controller/Component');

class TestSeoBlackListController extends Controller {

	public $paginate = null;
}

class BlackListTest extends CakeTestCase {

	public function setUp() {
		parent::setUp();
		// Setup our component and fake test controller
		$Collection = new ComponentCollection();
		$this->BlackListComponent = new BlackListComponent($Collection);
		$CakeRequest = new CakeRequest();
		$CakeResponse = new CakeResponse();
		$this->Controller = new TestSeoBlackListController($CakeRequest, $CakeResponse);
		$this->BlackListComponent->startup($this->Controller);
	}

	public function testIsBannedRedirect() {
		//$this->BlackListComponent->Controller->here = '/';
		//$this->BlackListComponent->Controller->expectOnce('redirect');
		//$this->assertTrue($this->BlackList->isBanned());
	}

	public function testIsBannedOnBannedPage() {
		//$this->BlackListComponent->Controller->here = '/seo/seo_blacklists/banned';
		//$this->BlackListComponent->Controller->expectNever('redirect');
		//$this->assertTrue($this->BlackList->isBanned());
	}

	public function testHandleHoneyPot() {
		//$this->BlackListComponent->Controller->here = '/seo/seo_blacklists/honeypot';
		//$this->BlackListComponent->Controller->expectOnce('redirect');
		//$this->assertTrue($this->BlackList->isBanned());
	}

	public function tearDown() {
		parent::tearDown();
		// Clean up after we're done
		unset($this->BlackListComponent);
		unset($this->Controller);
	}

}

class TestBlacklist extends CakeTestModel {

	public $data = null;

	public $useTable = false;

	public function isBanned() {
		return true;
	}

}

class TestHoneyPotVisit extends CakeTestModel {

	public $data = null;

	public $useTable = false;

	public function isTriggered() {
		return true;
	}
}