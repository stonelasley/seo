<?php
App::uses('SeoABTest', 'Seo.Model');

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
			'slug' => 'slug\'with\'quotes',
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
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		parent::tearDown();
		unset($this->SeoABTest);
		ClassRegistry::flush();
}

	public function testBlank() {
	}

/**
 * testNoQuotesFalse method
 *
 * @return void
 */
	public function testNoQuotesFalse() {
		$data[$this->SeoABTest->alias]['slug'] = "slug'with'quote";
		$this->SeoABTest->set($data);
		$this->assertFalse($this->SeoABTest->noquotes());
	}

/**
 * testNoQuotesFalse method
 *
 * @return void
 */
	public function testNoQuotesTrue() {
		$data[$this->SeoABTest->alias]['slug'] = "slugwitoutquote";
		$this->SeoABTest->set($data);
		$this->assertTrue($this->SeoABTest->noquotes());
	}

/**
 * testRollorCallbackWithValidInteger method
 *
 * @return void
 */
	public function testRollorCallbackWithValidInteger() {
		$data[$this->SeoABTest->alias]['roll'] = 50;
		$this->SeoABTest->set($data);
		$this->assertTrue($this->SeoABTest->numberOrCallback());
	}

/**
 * testRollorCallbackWithInValidInteger method
 *
 * @return void
 */
	public function testRollorCallbackWithInValidInteger() {
		$data[$this->SeoABTest->alias]['roll'] = -1;
		$this->SeoABTest->set($data);
		$this->assertFalse($this->SeoABTest->numberOrCallback());
		$data[$this->SeoABTest->alias]['roll'] = 99999;
		$this->SeoABTest->set($data);
		$this->assertFalse($this->SeoABTest->numberOrCallback());
	}

/**
 * testRollorCallbackWithValidCallback method
 *
 * @return void
 */
	public function testRollorCallbackWithValidCallback() {
		$data[$this->SeoABTest->alias]['roll'] = 'Object::callback';
		$this->SeoABTest->set($data);
		$this->assertTrue($this->SeoABTest->numberOrCallback());
	}

/**
 * testRollorCallbackWithInValidCallback method
 *
 * @return void
 */
	public function testRollorCallbackWithInValidCallback() {
		$data = array(
			$this->SeoABTest->alias => array (
				'roll' => 'Object:callback'
			)
		);
		$this->SeoABTest->set($data);
		$this->assertFalse($this->SeoABTest->numberOrCallback());
	}

/**
 * testRollorCallbackWithNoRollData method
 *
 * @return void
 */
	public function testRollorCallbackWithNoRollData() {
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
				'testable' => 'SeoABTest::callBackMethod'
			)
		);
		$SeoABTest = $this->getMockForModel('SeoABTest', array('callbackMethod'));
		$SeoABTest->expects($this->once())
			->method('callbackMethod')
			->will($this->returnValue(true));
		$this->assertTrue($SeoABTest->isTestable($data));
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
		$SeoABTest = $this->getMockForModel('SeoABTest', array('callbackMethod'));
		$this->assertTrue($SeoABTest->isTestable($data));
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
 * testFindTestableWithRollNoValidTest method
 *
 * @return void
 */
	public function testFindTestableWithRollNoValidTest() {
		$SeoABTest = $this->getMockForModel('SeoABTest', array('findTestByUri'));
		$SeoABTest->expects($this->once())
			->method('findTestByUri')
			->will($this->returnValue(false));
		$this->assertFalse($SeoABTest->findTestableWithRoll());
	}

/**
 * testRoll
 *
 * @return void
 */
	public function testRollWithNonTestable() {
		$data = array(
			$this->SeoABTest->alias => array (
			)
		);
		$SeoABTest = $this->getMockForModel('SeoABTest', array('callbackMethod'));
		$this->assertTrue($SeoABTest->isTestable($data));
	}
}
