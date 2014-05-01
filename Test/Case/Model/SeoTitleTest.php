<?php
/* SeoTitle Test cases generated on: 2011-01-05 18:01:14 : 1294276514*/
App::import('Model', 'Seo.SeoTitle');

class SeoTitleTest extends CakeTestCase {

	public $fixtures = array(
		'plugin.seo.seo_title',
		'plugin.seo.seo_redirect',
		'plugin.seo.seo_uri',
		'plugin.seo.seo_meta_tag',
		'plugin.seo.seo_status_code',
		'plugin.seo.seo_canonical',
	);

/**
 * setup Test
 *
 * @return void
 */
	public function setup() {
		$this->SeoTitle = ClassRegistry::init('SeoTitle');
	}

/**
 * Test model Instance type
 *
 * @return void
 */
	public function testInstance() {
		$this->assertTrue(is_a($this->SeoTitle, 'SeoTitle'));
	}

/**
 * testBeforeSave method
 *
 * @return void
 */
	public function testBeforeSave() {
		$SeoTitle = $this->getMockForModel('SeoTitle', array('createOrSetUri'));
		$SeoTitle->expects($this->once())
			->method('createOrSetUri')
			->will($this->returnValue(true));
		$this->assertTrue($SeoTitle->beforeSave(array()));
	}

/**
 * Test model Instance type
 *
 * @return void
 */
	public function testFind() {
		$result = $this->SeoTitle->findTitleByUri('/');
		$this->assertTrue(isset($result['SeoTitle']));
		$this->assertTrue(isset($result['SeoTitle']['title']));
		$this->assertEquals('home page', $result['SeoTitle']['title']);
	}

	public function tearDown() {
		parent::tearDown();
		unset($this->SeoTitle);
		ClassRegistry::flush();
	}

}

