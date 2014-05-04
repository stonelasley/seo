<?php
App::uses('Controller', 'Controller');
App::uses('Component', 'Controller');
App::uses('ComponentCollection', 'Controller');
App::uses('SeoComponent', 'Seo.Controller/Component');

/**
 * SeoTestController class
 *
 * @package Seo.Test.Case.Controller.Component
 */
class SeoTestController extends Controller {

/**
 * components property
 *
 * @var array
 */
	public $components = array('Session', 'Auth', 'Seo.Seo');

/**
 * testUrl property
 *
 * @var mixed null
 */
	public $testUrl = null;

/**
 * construct method
 *
 */
	public function __construct($request, $response) {
		$request->addParams(Router::parse('/seo_test'));
		$request->here = '/seo_test';
		$request->webroot = '/';
		Router::setRequestInfo($request);
		parent::__construct($request, $response);
	}

/**
 * redirect method
 *
 * @param string|array $url
 * @param mixed $status
 * @param mixed $exit
 * @return void
 */
	public function redirect($url, $status = null, $exit = true) {
		$this->testUrl = Router::url($url);
		return false;
	}

}

class SeoComponentTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'plugin.seo.seo_title',
		'plugin.seo.seo_meta_tag',
		'plugin.seo.seo_canonical',
		'plugin.seo.seo_blacklist',
		'plugin.seo.seo_honeypot_visit'
	);

/**
 * initialized property
 *
 * @var boolean
 */
	public $initialized = false;

/**
 * component collection property
 *
 * @var array
 */
	public $collection = array();

	public function setUp() {
		parent::setUp();
		$request = new CakeRequest(null, false);
		$this->Controller = new SeoTestController($request, $this->getMock('CakeResponse'));
		$this->collection = new ComponentCollection();
		$this->collection->init($this->Controller);
		$this->Seo = new SeoComponent($this->collection);
		$this->Seo->request = $request;
		$this->Seo->response = $this->getMock('CakeResponse');

		$this->Controller->Components->init($this->Controller);
		$this->Seo->initialize($this->Controller);
		$this->initialized = true;
		Router::reload();
		Router::connect('/:controller/:action/*');
	}

/**
 * testStartup calls all methods when turned on
 *
 * @return void
 */
	public function testStartup() {
		$settings = array('titles' => true, 'canonical' => true, 'meta_tags' => true);
		$this->Seo = $this->getMock('SeoComponent', array('getTitle', 'getMetaTags', 'getCanonical'), array($this->collection, $settings));
		$this->Seo->expects($this->once())
			->method('getTitle');
		$this->Seo->expects($this->once())
			->method('getMetaTags');
		$this->Seo->expects($this->once())
			->method('getCanonical');

		$this->Seo->startup($this->Controller);
	}

/**
 * testStartupOff calls no methods when no configuration
 *
 * @return void
 */
	public function testStartupOff() {
		$settings = array();
		$this->Seo = $this->getMock('SeoComponent', array('getTitle', 'getMetaTags', 'getCanonical'), array($this->collection, $settings));
		$this->Seo->expects($this->never())
			->method('getTitle');
		$this->Seo->expects($this->never())
			->method('getMetaTags');
		$this->Seo->expects($this->never())
			->method('getCanonical');

		$this->Seo->startup($this->Controller);
	}

/**
 * testStartupExplicitOff calls no methods when no configuration
 *
 * @return void
 */
	public function testStartupExplicitOff() {
		$settings = array('titles' => false, 'canonical' => false, 'meta_tags' => false);
		$this->Seo = $this->getMock('SeoComponent', array('getTitle', 'getMetaTags', 'getCanonical'), array($this->collection, $settings));
		$this->Seo->expects($this->never())
			->method('getTitle');
		$this->Seo->expects($this->never())
			->method('getMetaTags');
		$this->Seo->expects($this->never())
			->method('getCanonical');

		$this->Seo->startup($this->Controller);
	}

/**
 * testInitialize calls all methods when turned on
 *
 * @return void
 */
	public function testInitialize() {
		$settings = array('blacklist' => true);
		$this->Seo = $this->getMock('SeoComponent', array('isBanned', 'handleIfHoneyPot', 'getConfig'), array($this->collection, $settings));
		$this->Seo->expects($this->once())
			->method('isBanned')
			->will($this->returnValue(false));
		$this->Seo->expects($this->once())
			->method('handleIfHoneyPot');
		$this->Seo->expects($this->once())
			->method('getConfig')
			->will($this->returnValue(''));

		$this->Seo->initialize($this->Controller);
	}

/**
 * testIsBanned redirects
 *
 * @return void
 */
	public function testIsBanned() {
		$request = new CakeRequest('/', false);
		$this->Seo->SeoBlacklist = $this->getMock('SeoBlacklist', array('isBanned'));
		$response = $this->getMock('CakeResponse');
		$this->Controller = $this->getMock('SeoTestController', array('redirect'), array($request, $response));
		$this->Seo->initialize($this->Controller);
		$this->Controller->expects($this->once())
			->method('redirect');
		$this->Seo->SeoBlacklist->expects($this->once())
			->method('isBanned')
			->will($this->returnValue(true));

		$result = $this->Seo->isBanned();

		$this->assertTrue($result);
	}

/**
 * testIsBanned on unbanned
 *
 * @return void
 */
	public function testIsBannedOnNon() {
		$this->Seo->SeoBlacklist = $this->getMock('SeoBlacklist', array('isBanned'));
		$request = new CakeRequest(null, false);
		$response = $this->getMock('CakeResponse');
		$this->Controller = $this->getMock('SeoTestController', array('redirect'), array($request, $response));
		$this->Seo->SeoBlacklist->expects($this->once())
			->method('isBanned')
			->will($this->returnValue(false));

		$this->assertFalse($this->Seo->isBanned());
	}

/**
 * testHandleIfHoneyPot on untriggered
 *
 * @return void
 */
	public function testHandleIfHoneyPot() {
		$this->Seo->SeoHoneypotVisit = $this->getMock('SeoHoneypotVisit', array('add', 'isTriggered'));
		$request = new CakeRequest('/', false);
		$response = $this->getMock('CakeResponse');
		$this->Controller = $this->getMock('SeoTestController', array('redirect'), array($request, $response));
		$this->Seo->SeoHoneypotVisit->expects($this->once())
			->method('add')
			->will($this->returnValue(true));
		$this->Seo->SeoHoneypotVisit->expects($this->once())
			->method('isTriggered')
			->will($this->returnValue(false));

		$this->Seo->initialize($this->Controller);
		$this->Seo->handleIfHoneyPot();
	}

/**
 * testHandleHoneyPotTriggered
 *
 * @return void
 */
	public function testHandleHoneyPotTriggered() {
		$this->Seo->SeoHoneypotVisit = $this->getMock('SeoHoneypotVisit', array('add', 'isTriggered'));
		$this->Seo->SeoBlacklist = $this->getMock('SeoBlacklist', array('addToBanned'));
		$request = $this->getMock('CakeRequest', array('here'), array('/'));
		$response = $this->getMock('CakeResponse');
		$this->Controller = $this->getMock('SeoTestController', array('redirect'), array($request, $response));
		$this->Seo->SeoHoneypotVisit->expects($this->once())
			->method('add')
			->will($this->returnValue(true));
		$this->Seo->SeoBlacklist->expects($this->once())
			->method('addToBanned')
			->will($this->returnValue(true));
		$this->Seo->SeoHoneypotVisit->expects($this->once())
			->method('isTriggered')
			->will($this->returnValue(true));

		$this->Seo->initialize($this->Controller);
		$this->Seo->handleIfHoneyPot();
	}

/**
 * testGetTitle
 *
 * @return void
 */
	public function testGetTitle() {
		$this->Seo->SeoTitle = $this->getMock('SeoTitle', array('findTitleByUri'));
		$this->Seo->SeoTitle->expects($this->once())
			->method('findTitleByUri')
			->will($this->returnValue(
				array(
					'SeoTitle' => array(
						'title' => 'foo'
					)
				)
			));

		$this->Seo->getTitle();

		$this->assertTrue(isset($this->Controller->viewVars['seoTitle']));
		$this->assertTextEquals('foo', $this->Controller->viewVars['seoTitle']);
	}

/**
 * testGetMetaTag
 *
 * @return void
 */
	public function testGetMetaTag() {
		$this->Seo->SeoMetaTag = $this->getMock('SeoMetaTag', array('findAllTagsByUri'));
		$this->Seo->SeoMetaTag->expects($this->once())
			->method('findAllTagsByUri')
			->will($this->returnValue(
					array(
						0 => array(
							'SeoMetaTag' => array(
								'id' => '535da751-922c-4089-8779-1173173cdfff',
								'seo_uri_id' => '535da751-0100-409c-9adb-1173173cdfff',
								'name' => 'description',
								'content' => 'home page description content',
								'is_http_equiv' => true,
								'created' => '2014-04-27 18:56:49',
								'modified' => '2014-04-27 19:37:52'
							),
							'SeoUri' => array(
								'uri' => '/'
							)
						),
						1 => array(
							'SeoMetaTag' => array(
								'id' => '535da751-dc40-4991-a9a9-1173173cdfff',
								'seo_uri_id' => '535da751-0100-409c-9adb-1173173cdfff',
								'name' => 'keywords',
								'content' => 'home page keywords content',
								'is_http_equiv' => true,
								'created' => '2014-04-27 18:56:49',
								'modified' => '2014-04-27 19:37:52'
							),
							'SeoUri' => array(
								'uri' => '/'
							)
						),
						2 => array(
							'SeoMetaTag' => array(
								'id' => '535da751-1524-42f9-a722-1173173cdfff',
								'seo_uri_id' => '535da751-0100-409c-9adb-1173173cdfff',
								'name' => 'robots',
								'content' => 'home page robots content',
								'is_http_equiv' => false,
								'created' => '2014-04-27 18:56:49',
								'modified' => '2014-04-27 19:37:52'
							),
							'SeoUri' => array(
								'uri' => '/'
							)
						)
					)
				)
			);

		$this->Seo->getMetaTags();

		$this->assertTrue(isset($this->Controller->viewVars['seoMetaTags']));
		$this->assertTextEquals('description', $this->Controller->viewVars['seoMetaTags'][0]['http-equiv']);
		$this->assertTextEquals('home page description content', $this->Controller->viewVars['seoMetaTags'][0]['content']);
		$this->assertTextEquals('keywords', $this->Controller->viewVars['seoMetaTags'][1]['http-equiv']);
		$this->assertTextEquals('home page keywords content', $this->Controller->viewVars['seoMetaTags'][1]['content']);
		$this->assertTextEquals('robots', $this->Controller->viewVars['seoMetaTags'][2]['name']);
		$this->assertTextEquals('home page robots content', $this->Controller->viewVars['seoMetaTags'][2]['content']);
	}

/**
 * testGetCanonical
 *
 * @return void
 */
	public function testGetCanonical() {
		$this->Seo->SeoCanonical = $this->getMock('SeoCanonical', array('findByUri'));
		$this->Seo->SeoCanonical->expects($this->once())
			->method('findByUri')
			->will($this->returnValue(
				array(
					'SeoCanonical' => array(
						'canonical' => 'foo'
					)
				)
			));

		$this->Seo->getCanonical();

		$this->assertTrue(isset($this->Controller->viewVars['seoCanonical']));
		$this->assertStringEndsWith('/SeoCanonical%5Bcanonical%5D:foo', $this->Controller->viewVars['seoCanonical']);
	}

/**
 * tearDown
 *
 * @return void
 */
	public function tearDown() {
		parent::tearDown();
		unset($this->Seo);
		unset($this->Controller);
	}

}