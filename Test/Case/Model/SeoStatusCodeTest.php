<?php
/* SeoStatusCode Test cases generated on: 2011-07-25 17:06:33 : 1311635193*/
App::import('Model', 'Seo.SeoStatusCode');
App::import('Component', 'Email');

class SeoStatusCodeTest extends CakeTestCase {

	public $fixtures = array(
		'plugin.seo.seo_redirect',
		'plugin.seo.seo_uri',
		'plugin.seo.seo_meta_tag',
		'plugin.seo.seo_title',
		'plugin.seo.seo_status_code',
		'plugin.seo.seo_canonical',
	);

	public function setUp() {
		$this->SeoStatusCode = ClassRegistry::init('Seo.SeoStatusCode');
	}

/**
 *
 *
 * @return void
 */
	public function testInstance() {
		$this->assertTrue(is_a($this->SeoStatusCode, 'SeoStatusCode'));
	}

	public function tearDown() {
		parent::tearDown();
		unset($this->SeoStatusCode);
		ClassRegistry::flush();
	}

}

