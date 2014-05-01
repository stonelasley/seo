<?php
App::uses('SeoUtil', 'Seo.Lib');
class SeoUtilTest extends CakeTestCase {

/**
 * Fixtures
 */
	public $fixtures = array(
		'plugin.seo.seo_blacklist'
	);

/**
 * testLoad
 *
 * @return void
 */
	public function testLoad() {
		$this->assertEquals(1, SeoUtil::loadSeoError());
	}

/**
 * testGetConfig
 *
 * @return void
 */
	public function testGetConfig() {
		$this->assertEquals('admin@example.com', SeoUtil::getConfig('approverEmail'));
	}

/**
 * testGetConfigWithInvalid
 *
 * @return void
 */
	public function testGetConfigWithInvalid() {
		$this->assertNull(SeoUtil::getConfig('invalid'));
	}

/**
 * testIsRegexWithValid
 *
 * @return void
 */
	public function testIsRegexWithValid() {
		$this->assertTrue(SeoUtil::isRegEx('#.valid#.check'));
	}

/**
 * testIsRegexWithInvalid
 *
 * @return void
 */
	public function testIsRegexWithInvalid() {
		$this->assertFalse(SeoUtil::isRegEx('invalid'));
	}

/**
 * Test isbanned
 *
 * @return void
 */
	public function testIsBanned() {
		$this->assertTrue(true, SeoUtil::isBanned('10.100.0.1'));
	}

}
