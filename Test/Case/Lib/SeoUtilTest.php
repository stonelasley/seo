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
		$expected = 1;

		$result = SeoUtil::loadSeoError();

		$this->assertEquals($expected, $result);
	}

/**
 * testGetConfig
 *
 * @return void
 */
	public function testGetConfig() {
		$expected = 'admin@example.com';

		$result = SeoUtil::getConfig('approverEmail');

		$this->assertEquals($expected, $result);
	}

/**
 * testGetConfig with local setting
 *
 * @return void
 */
	public function testGetConfigWithLocalSetting() {
		$result = SeoUtil::getConfig('aggressive');

		$this->assertTrue($result);
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
 * test isRegexWithValid
 *
 * @return void
 */
	public function testIsRegexWithValid() {
		$this->assertTrue(SeoUtil::isRegEx('#.valid#.check'));
	}

/**
 * test isRegexWithInvalid
 *
 * @return void
 */
	public function testIsRegexWithInvalid() {
		$this->assertFalse(SeoUtil::isRegEx('invalid'));
	}

/**
 * test requestMatch
 *
 * @return void
 */
	public function testRequestMatch() {
		$result = SeoUtil::requestMatch('/home', '/home');

		$this->assertTrue($result);
	}

/**
 * test requestMatch with regex
 *
 * @return void
 */
	public function testRequestMatchWithRegex() {
		$result = SeoUtil::requestMatch('/regex', '#\bregex(er|ing|ed|s)?\b#');

		$this->assertTrue($result);
	}

/**
 * test requestMatch with wildcard
 *
 * @return void
 */
	public function testRequestMatchWithWildcart() {
		$result = SeoUtil::requestMatch('/wildcard/awwyiss', '/wildcard*');

		$this->assertTrue($result);
	}

/**
 * test requestMatch
 *
 * @return void
 */
	public function testRequestMatchNoUri() {
		$this->assertFalse(SeoUtil::requestMatch('/invalid'));
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
