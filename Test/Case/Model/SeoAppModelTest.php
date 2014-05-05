<?php
App::import('Seo.Lib', 'SeoUtil');
App::uses('SeoUri', 'Seo.Model');
App::uses('SeoAppModel', 'Seo.Model');
class TestSeoAppModel extends SeoAppModel {

	public $useTable = false;
}

/**
 * SeoAppModel Test Case
 *
 */
class SeoAppModelTest extends CakeTestCase {

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->SeoAppModel = ClassRegistry::init('TestSeoAppModel');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->SeoAppModel);

		parent::tearDown();
	}

/**
 * testIsIp method on valid
 *
 * @return void
 */
	public function testIsIpOnValid() {
		$validIp = array('192.168.1.1');
		$nonArrayIp = '10.100.0.1';

		$this->assertTrue($this->SeoAppModel->isIp($validIp));
		$this->assertTrue($this->SeoAppModel->isIp($nonArrayIp));
	}

/**
 * testIsIp method on invalid
 *
 * @return void
 */
	public function testIsIpOnInvalid() {
		$invalidIp = array('100');
		$invalidIp2 = array('1000.10.10.1');

		$this->assertFalse($this->SeoAppModel->isIp($invalidIp));
		$this->assertFalse($this->SeoAppModel->isIp($invalidIp2));
	}

/**
 * afterFind method non Array
 *
 * @return void
 */
	public function testAfterFindWithNonArray() {
		$parameter = 'foo';

		$results = $this->SeoAppModel->afterFind($parameter);

		$this->assertEquals($parameter, $results);
	}

/**
 * testIsRegEx method
 * Just test that seoutil::isRegEx is being called
 *
 * @return void
 */
	public function testIsRegEx() {
		$SeoUtil = $this->getMockForModel('SeoUtil', array('isRegEx'));
		$SeoUtil::staticExpects($this->once())
			->method('isRegEx')
			->will($this->returnValue(true));

		$reflProp = new ReflectionProperty('SeoAppModel', '_seoUtilClass');
		$reflProp->setAccessible(true);
		$reflProp->setValue($this->SeoAppModel, $SeoUtil);

		$this->assertTrue($this->SeoAppModel->isRegex(''));
	}

/**
 * testGetConfig method
 * Just test that seoutil::getConfig is being called
 *
 * @return void
 */
	public function testGetConfig() {
		$SeoUtil = $this->getMockForModel('SeoUtil', array('getConfig'));
		$SeoUtil::staticExpects($this->once())
			->method('getConfig')
			->will($this->returnValue(true));

		$reflProp = new ReflectionProperty('SeoAppModel', '_seoUtilClass');
		$reflProp->setAccessible(true);
		$reflProp->setValue($this->SeoAppModel, $SeoUtil);

		$this->assertTrue($this->SeoAppModel->getConfig(''));
	}

/**
 * testRequestMatch method
 * Just test that seoutil::getConfig is being called
 *
 * @return void
 */
	public function testRequestMatch() {
		$SeoUtil = $this->getMockForModel('SeoUtil', array('requestMatch'));
		$SeoUtil::staticExpects($this->once())
			->method('requestMatch')
			->will($this->returnValue(true));

		$reflProp = new ReflectionProperty('SeoAppModel', '_seoUtilClass');
		$reflProp->setAccessible(true);
		$reflProp->setValue($this->SeoAppModel, $SeoUtil);

		$this->assertTrue($this->SeoAppModel->requestMatch(''));
	}

}
