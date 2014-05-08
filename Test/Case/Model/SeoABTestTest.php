<?php
App::uses('SeoABTest', 'Seo.Model');
App::uses('SeoTitle', 'Seo.Model');

/**
 * SeoABTest Test Case
 *
 */
class SeoABTestTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'plugin.seo.seo_a_b_test',
		'plugin.seo.seo_uri'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->SeoABTest = ClassRegistry::init('Seo.SeoABTest');
		$this->data = array (
			'id' => '535dda88-f5bc-4942-b9b2-1174173cdfff',
			'uri' => '/',
			'slug' => 'home',
			'title' => 'test_title',
			'roll' => 50,
			'priority' => 1,
			'description' => 'abtest description',
			'start_date' => '2012-04-15',
			'end_date' => '2033-04-15',
			'is_active' => true
		);
	}
/**
 * Test Instance
 *
 * @return void
 */
	public function testInstance() {
		$this->assertTrue(is_a($this->SeoABTest, 'SeoABTest'));
	}

/**
 * testNoquotesWithQuotedSlug method
 *
 * @return void
 */
	public function testNoquotesWithQuotedSlug() {
		$data = array(
			$this->SeoABTest->alias => array (
				'slug' => "slug'with'quote"
			)
		);
		$this->SeoABTest->set($data);
		$this->assertFalse($this->SeoABTest->noquotes());
	}

/**
 * testNoquotesWithUnQuotedSlug method
 *
 * @return void
 */
	public function testNoquotesWithUnQuotedSlug() {
		$data[$this->SeoABTest->alias]['slug'] = "slugwitoutquote";
		$this->SeoABTest->set($data);
		$this->assertTrue($this->SeoABTest->noquotes());
	}

/**
 * testNumberOrCallbackWithValidInteger method
 *
 * @return void
 */
	public function testNumberOrCallbackWithValidInteger() {
		$data = array(
			$this->SeoABTest->alias => array (
				'roll' => 50
			)
		);
		$this->SeoABTest->set($data);
		$this->assertTrue($this->SeoABTest->numberOrCallback());
	}

/**
 * testNumberOrCallbackWithInvalidInteger method
 *
 * @return void
 */
	public function testNumberOrCallbackWithInvalidInteger() {
		$data = array(
			$this->SeoABTest->alias => array (
				'roll' => -1
			)
		);
		$this->SeoABTest->set($data);
		$this->assertFalse($this->SeoABTest->numberOrCallback());
		$data = array(
			$this->SeoABTest->alias => array (
				'roll' => 9999
			)
		);
		$this->SeoABTest->set($data);
		$this->assertFalse($this->SeoABTest->numberOrCallback());
	}

/**
 * testNumberOrCallbackWithValidCallback method
 *
 * @return void
 */
	public function testNumberOrCallbackWithValidCallback() {
		$data = array(
			$this->SeoABTest->alias => array (
				'roll' => 'Object::callback'
			)
		);
		$this->SeoABTest->set($data);
		$this->assertTrue($this->SeoABTest->numberOrCallback());
	}

/**
 * testNumberOrCallbackWithInvalidCallback method
 *
 * @return void
 */
	public function testNumberOrCallbackWithInvalidCallback() {
		$data = array(
			$this->SeoABTest->alias => array (
				'roll' => 'Object:callback'
			)
		);
		$this->SeoABTest->set($data);
		$this->assertFalse($this->SeoABTest->numberOrCallback());
	}

/**
 * testNumberOrCallbackWithNoRollData method
 *
 * @return void
 */
	public function testNumberOrCallbackWithNoRollData() {
		$data = array($this->SeoABTest->alias);
		$this->SeoABTest->set($data);
		$this->assertTrue($this->SeoABTest->numberOrCallback());
	}

/**
 * testBeforeSave method
 *
 * @return void
 */
	public function testBeforeSave() {
		$SeoABTest = $this->getMockForModel('SeoABTest', array('createOrSetUri'));
		$SeoABTest->expects($this->once())
			->method('createOrSetUri')
			->will($this->returnValue(true));
		$this->assertTrue($SeoABTest->beforeSave(array()));
	}

/**
 * testIsTestable method
 *
 * @return void
 */
	public function testIsTestable() {
		$data = array(
			$this->SeoABTest->alias => array (
				'testable' => 'SeoTitle::callbackMethod'
			)
		);
		$SeoTitle = $this->getMockForModel('Seo.SeoTitle', array('callbackMethod'));
		$SeoTitle->expects($this->once())
			->method('callbackMethod')
			->will($this->returnValue(true));

		$this->assertTrue($this->SeoABTest->isTestable($data));
	}

/**
 * testIsTestableWithNonTestable model
 *
 * @return void
 */
	public function testIsTestableWithNonTestable() {
		$data = array(
			$this->SeoABTest->alias => array (
			)
		);
		$SeoTitle = $this->getMockForModel('Seo.SeoTitle', array('callbackMethod'));
		$SeoTitle->expects($this->never())
			->method('callbackMethod');
		$this->assertTrue($this->SeoABTest->isTestable($data));
	}

/**
 * testFindTestableWithRoll method
 *
 * @return void
 */
	public function testFindTestableWithRoll() {
		$SeoABTest = $this->getMockForModel('SeoABTest', array('findTestByUri', 'isTestable', 'roll'));
		$SeoABTest->expects($this->once())
			->method('findTestByUri')
			->will($this->returnValue(true));
		$SeoABTest->expects($this->once())
			->method('isTestable')
			->will($this->returnValue(true));
		$SeoABTest->expects($this->once())
			->method('roll')
			->will($this->returnValue(true));
		$this->assertTrue($SeoABTest->findTestableWithRoll());
	}

/**
 * testFindTestableWithRollWithInvalid method
 *
 * @return void
 */
	public function testFindTestableWithRollWithInvalid() {
		$SeoABTest = $this->getMockForModel('SeoABTest', array('findTestByUri'));
		$SeoABTest->expects($this->once())
			->method('findTestByUri')
			->will($this->returnValue(false));
		$this->assertFalse($SeoABTest->findTestableWithRoll());
	}

/**
 * testRollWithRoll
 *
 * @return void
 */
	public function testRollWithRoll() {
		$roll = array(
			$this->SeoABTest->alias => array (
				'roll' => 50
			)
		);
		$this->assertInternalType("bool", $this->SeoABTest->roll($roll));
	}

/**
 * testRollWithCallback
 *
 * @return void
 */
	public function testRollWithCallback() {
		$roll = array(
			$this->SeoABTest->alias => array (
				'roll' => "SeoABTest::callback"
			)
		);
		$SeoABTest = $this->getMockForModel('SeoABTest', array('callback'));
		$SeoABTest->expects($this->once())
			->method('callback')
			->will($this->returnValue(true));
		$this->assertTrue($SeoABTest->roll($roll));
	}

/**
 * testRollWithEmpty
 *
 * @return void
 */
	public function testRollWithEmpty() {
		$roll = array(
		);
		$this->assertFalse($this->SeoABTest->roll($roll));
	}

/**
 * testTestableValidationWithValidCallback model
 *
 * @return void
 */
	public function testTestableValidationWithValidCallback() {
		$data = array(
			$this->SeoABTest->alias => array (
				'testable' => 'SeoABTest::callBackMethod'
			)
		);
		$this->SeoABTest->set($data);
		$this->assertTrue($this->SeoABTest->testableValidation());
	}

/**
 * testTestableValidationWithValidCallback model
 *
 * @return void
 */
	public function testTestableValidationWithInvalidCallback() {
		$data = array(
			$this->SeoABTest->alias => array (
				'testable' => 'callBackMethod'
			)
		);
		$this->SeoABTest->set($data);
		$this->assertFalse($this->SeoABTest->testableValidation());
	}

/**
 * testTestableValidationWithEmpty model
 *
 * @return void
 */
	public function testTestableValidationWithEmpty() {
		$data = array(
		);
		$this->SeoABTest->set($data);
		$this->assertTrue($this->SeoABTest->testableValidation());
	}

/**
 * test findTestByUri method
 *
 * @return void
 */
	public function testFindTestByUriWithNoRequest() {
		$this->assertFalse($this->SeoABTest->findTestByUri(null, false));
	}

/**
 * test findTestByUri method
 *
 * @return void
 */
	public function testFindTestByUri() {
		$result = $this->SeoABTest->findTestByUri('/', false);

		$this->assertTrue(isset($result[$this->SeoABTest->alias]));
		$this->assertTrue(isset($result['SeoUri']));
		$this->assertEquals('home', $result[$this->SeoABTest->alias]['slug']);
		$this->assertEquals('/', $result['SeoUri']['uri']);
	}

/**
 * test findTestByUri method with cache
 *
 * @return void
 */
	public function testFindTestByUriCached() {
		Cache::clear();
		$this->SeoABTest = $this->getMockForModel('SeoABTest', array('getConfig'));
		$this->SeoABTest->expects($this->once())
			->method('getConfig')
			->will($this->returnValue(''));
		$result = $this->SeoABTest->findTestByUri('/notfound', false);

		$this->assertFalse($result);
	}

/**
 * test findTestByUri method with requestMatch
 *
 * @return void
 */
	public function testFindTestByUriWithRequestMatch() {
		Cache::clear();
		$this->SeoABTest = $this->getMockForModel('SeoABTest', array('requestMatch', 'getConfig'));
		$this->SeoABTest->expects($this->once())
			->method('getConfig')
			->will($this->returnValue('default'));
		$this->SeoABTest->expects($this->once())
			->method('requestMatch')
			->will($this->returnValue(true));

		$result = $this->SeoABTest->findTestByUri('/notfound', false);

		$this->assertTrue(isset($result[$this->SeoABTest->alias]));
		$this->assertTrue(isset($result['SeoUri']));
		$this->assertEquals('home', $result[$this->SeoABTest->alias]['slug']);
		$this->assertEquals('/', $result['SeoUri']['uri']);
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		parent::tearDown();
		unset($this->SeoABTest);
		ClassRegistry::flush();
	}
}
