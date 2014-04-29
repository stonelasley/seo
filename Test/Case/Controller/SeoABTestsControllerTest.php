<?php
App::uses('SeoABTestsController', 'Seo.Controller');

/**
 * SeoABTestsController Test Case
 *
 */
class SeoABTestsControllerTest extends ControllerTestCase {

	public $mockController;

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
		$this->mockController = $this->generate(
			'Seo.SeoABTests', array (
				'models' => array ('Seo.SeoABTest' => array ('save', 'create', 'exists')),
				'components' => array ('Session', 'Security')
			)
		);
		$this->testData = array (
			'id' => '535dda88-f5bc-4942-b9b2-1174173cdfff',
			'uri' => '/',
			'slug' => 'slug',
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
 * testAdminView method
 *
 * @return void
 */
	public function testAdminView() {
		$id = $this->testData['id'];
		$this->mockController->SeoABTest->expects($this->once())
			->method('exists')
			->will($this->returnValue(true));

		$this->testAction(
			"admin/seo/seo_a_b_tests/view/$id",
			array('return' => 'vars')
		);
		$this->assertTrue(isset($this->vars['seoABTest']));
		$this->assertTrue(isset($this->vars['slots']));
		$this->assertEquals($this->vars['model'], 'SeoABTest');
	}

/**
 * testAdminView method
 *
 * @return void
 */
	public function testAdminViewInvalidId() {
		$id = 'Invalid';
		$this->mockController->SeoABTest->expects($this->once())
			->method('exists')
			->will($this->returnValue(false));
		$this->setExpectedException('NotFoundException');
		$this->testAction(
			"admin/seo/seo_a_b_tests/view/$id",
			array('return' => 'vars')
		);
	}

/**
 * testAdminAdd method
 *
 * @return void
 */
	public function testAdminAdd() {
		$this->mockController->Session->expects($this->once())
			->method('setFlash')
			->with(__('The seo AB Test has been saved'), 'default');
		$this->mockController->SeoABTest->expects($this->once())
			->method('create');
		$this->mockController->SeoABTest->expects($this->once())
			->method('save')
			->will($this->returnValue(true)); //success
		unset($this->testData['id']);
		$this->testAction(
			'admin/seo/seo_a_b_tests/add',
			array (
				'data' => array ('SeoABTest' => $this->testData),
				'method' => 'post'
			)
		);
		$this->assertTrue(isset($this->vars['slots']));
		$this->assertEquals($this->vars['model'], 'SeoABTest');
	}

/**
 * testAdminAddFail method
 *
 * @return void
 */
	public function testAdminAddFail() {
		$this->mockController->Session->expects($this->once())
			->method('setFlash')
			->with(__('The seo AB Test could not be saved. Please, try again.'), 'default');
		$this->mockController->SeoABTest->expects($this->once())
			->method('create');
		$this->mockController->SeoABTest->expects($this->once())
			->method('save')
			->will($this->returnValue(false)); //success
		unset($this->testData['id']);
		$result = $this->testAction(
			'admin/seo/seo_a_b_tests/add',
			array (
				'data' => array ('SeoABTest' => $this->testData),
				'method' => 'post',
				'return' => 'vars'
			)
		);
		$this->assertTrue(isset($this->vars['slots']));
		$this->assertEquals($this->vars['model'], 'SeoABTest');
	}

/**
 * testAdminEditWithData method
 *
 * @return void
 */
	public function testAdminEditWithData() {
		$this->mockController->Session->expects($this->once())
			->method('setFlash')
			->with(__('The seo AB Test has been saved'), 'default');
		$this->mockController->SeoABTest->expects($this->once())
			->method('save')
			->will($this->returnValue(true)); //success
		$this->testAction(
			'admin/seo/seo_a_b_tests/edit',
			array (
				'data' => array ('SeoABTest' => $this->testData),
				'method' => 'post'
			)
		);
		$this->assertTrue(isset($this->vars['slots']));
		$this->assertEquals($this->vars['model'], 'SeoABTest');
	}

/**
 * testAdminEditWithNoId method
 *
 * @return void
 */
	public function testAdminEditWithNoId() {
		$this->mockController->Session->expects($this->once())
			->method('setFlash')
			->with(__('Invalid seo AB Test'), 'default');
		$this->testAction(
			'admin/seo/seo_a_b_tests/edit',
			array (
				'method' => 'get'
			)
		);
		$this->assertTrue(isset($this->vars['slots']));
		$this->assertEquals($this->vars['model'], 'SeoABTest');
	}

/**
 * testAdminEditSaveFail method
 *
 * @return void
 */
	public function testAdminEditSaveFail() {
		$this->mockController->Session->expects($this->once())
			->method('setFlash')
			->with(__('The seo AB Test could not be saved. Please, try again.'), 'default');
		$this->mockController->SeoABTest->expects($this->once())
			->method('save')
			->will($this->returnValue(false)); //success
		$this->testAction(
			'admin/seo/seo_a_b_tests/edit',
			array (
				'data' => array ('SeoABTest' => $this->testData),
				'method' => 'post',
				'return' => 'vars'
			)
		);
		$this->assertTrue(isset($this->vars['slots']));
		$this->assertEquals($this->vars['model'], 'SeoABTest');
	}

/**
 * testAdminDelete method
 *
 * @return void
 */
	public function testAdminDelete() {
	}

}
