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

/**
 *testFindCodeList
 *
 * @return void
 */
	public function testFindCodeList() {
		$list = $this->SeoStatusCode->findCodeList();
		$this->assertEquals(21, count($list));
		$this->assertTrue(isset($list[200]));
		$this->assertEquals('200 : OK', $list[200]);
	}

/**
 *testFindCodeList
 *
 * @return void
 */
	public function testFindStatusCodeListByPriority() {
		$list = $this->SeoStatusCode->findStatusCodeListByPriority();
		$this->assertEquals(3, count($list));
		$this->assertTrue(isset($list[0]['SeoStatusCode']));
		$this->assertTrue(isset($list[0]['SeoUri']));
	}

	public function tearDown() {
		parent::tearDown();
		unset($this->SeoStatusCode);
		ClassRegistry::flush();
	}

}

