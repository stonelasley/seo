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

	public function setup() {
		$this->SeoTitle = ClassRegistry::init('SeoTitle');
	}

/**
 *
 *
 * @return void
 */
	public function testInstance() {
		$this->assertTrue(is_a($this->SeoTitle, 'SeoTitle'));
	}

	public function tearDown() {
		parent::tearDown();
		unset($this->SeoTitle);
		ClassRegistry::flush();
	}

}

