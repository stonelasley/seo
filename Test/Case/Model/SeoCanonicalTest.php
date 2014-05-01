<?php
App::uses('SeoCanonical', 'Seo.Model');
App::uses('ControllerCakeTest', 'CakeTestCase');

/**
 * SeoCanonical Test Case
 *
 */
class SeoCanonicalTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'plugin.seo.seo_canonical',
		'plugin.seo.seo_uri',
		'plugin.seo.seo_redirect',
		'plugin.seo.seo_title',
		'plugin.seo.seo_status_code',
		'plugin.seo.seo_meta_tag',
		'plugin.seo.seo_a_b_test'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->SeoCanonical = ClassRegistry::init('Seo.SeoCanonical');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		parent::tearDown();
		unset($this->SeoCanonical);
		ClassRegistry::flush();
	}

/**
 *
 *
 * @return void
 */
	public function testInstance() {
		$this->assertTrue(is_a($this->SeoCanonical, 'SeoCanonical'));
	}

/**
 * testBeforeSave
 *
 * @return void
 */
	public function testRollWithCallback() {
		$SeoCanonical = $this->getMockForModel('SeoCanonical', array('createOrSetUri'));
		$SeoCanonical->expects($this->once())
			->method('createOrSetUri')
			->will($this->returnValue(true));
		$this->assertTrue($SeoCanonical->beforeSave());
	}

/**
 * testFindByUri method
 *
 * @return void
 */
	public function testFindByUri() {
		$canonical = $this->SeoCanonical->findByUri('/');
		$this->assertEquals('/index', $canonical);
	}

}
