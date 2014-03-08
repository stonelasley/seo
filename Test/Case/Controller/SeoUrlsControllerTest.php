<?php
App::uses('SeoUrlsController', 'Seo.Controller');


/**
 * TestSeoUrlsController
 *
 * @package tags
 * @subpackage tags.tests.cases.controllers
 */
class TestSeoUrlsController extends SeoUrlsController {

/**
 * Auto render
 *
 * @var boolean
 */
	public $autoRender = false;

/**
 * Redirect URL
 *
 * @var mixed
 */
	public $redirectUrl = null;

/**
 * Override controller method for testing
 *
 * @param array|string $url
 * @param null $status
 * @param bool $exit
 * @return void
 */
	public function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}

/**
 * Override controller method for testing
 *
 * @param null $action
 * @param null $layout
 * @param null $file
 * @return void
 */
	public function render($action = null, $layout = null, $file = null) {
		$this->renderedView = $action;
	}

}

/**
 * SeoUrlsController Test Case
 *
 */
class SeoUrlsControllerTestCase extends CakeTestCase {

/**
 * Name
 *
 * @var string
 */
	public $name = 'SeoUrls';

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'plugin.seo.seo_url'
	);

/**
 * SeoUrls Controller Instance
 *
 * @return void
 */
	public $SeoUrls = null;

/**
 * setUp
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();

		$request = new CakeRequest();
		$response = $this->getMock('CakeResponse');

		$this->SeoUrls = new TestSeoUrlsController($request, $response);

		$this->SeoUrls->params = array(
			'named' => array(),
			'url' => array());
		$this->SeoUrls->constructClasses();
		$this->SeoUrls->Session = $this->getMock('SessionComponent', array(), array(), '', false);
		$this->SeoUrls->SeoUrl = $this->getMock('SeoUrl', array('parseCriteria'));
		$this->SeoUrls->Prg = $this->getMock('Prg', array('commonProcess'));
	}

/**
 * tearDown
 *
 * @return void
 */
	public function tearDown() {
		parent::tearDown();
		unset($this->SeoUrls);
	}

/**
 * testSeoUrlsControllerInstance
 *
 * @return void
 */
	public function testSeoUrlsControllerInstance() {
		$this->assertTrue(is_a($this->SeoUrls, 'SeoUrlsController'));
	}

/**
 * testAdminIndex method
 *
 * @return void
 */
	public function testAdminIndex() {
	}

/**
 * testAdminView method
 *
 * @return void
 */
	public function testAdminView() {
	}

/**
 * testAdminAdd method
 *
 * @return void
 */
	public function testAdminAdd() {
	}

/**
 * testAdminEdit method
 *
 * @return void
 */
	public function testAdminEdit() {
	}

/**
 * testAdminDelete method
 *
 * @return void
 */
	public function testAdminDelete() {
	}

/**
 * testAdminApprove method
 *
 * @return void
 */
	public function testAdminApprove() {
	}

}
