<?php
App::uses('SeoABTestsController', 'Seo.Controller');

/**
 * SeoABTestsController Test Case
 *
 */
class SeoABTestsControllerTest extends ControllerTestCase {

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
	}

/**
 * testAdminAdd method
 *
 * @return void
 */
	public function testAdminAdd() {
		$SeoABTests = $this->generate(
			'Seo.SeoABTests', array (
				'models' => array ('Seo.SeoABTest' => array ('save', 'create')),
				'components' => array ('Session', 'Security')
			)
		);
		$SeoABTests->Session->expects($this->once())
			->method('setFlash')
			->with(__('The seo AB Test has been saved'), 'default');
		$SeoABTests->SeoABTest->expects($this->once())
			->method('create');
		$SeoABTests->SeoABTest->expects($this->once())
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
		$SeoABTests = $this->generate(
			'Seo.SeoABTests', array (
				'models' => array ('Seo.SeoABTest' => array ('save', 'create')),
				'components' => array ('Session', 'Security')
			)
		);
		$SeoABTests->Session->expects($this->once())
			->method('setFlash')
			->with(__('The seo AB Test could not be saved. Please, try again.'), 'default');
		$SeoABTests->SeoABTest->expects($this->once())
			->method('create');
		$SeoABTests->SeoABTest->expects($this->once())
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
		$SeoABTests = $this->generate(
			'Seo.SeoABTests', array (
				'models' => array ('Seo.SeoABTest' => array ('save', 'create')),
				'components' => array ('Session', 'Security')
			)
		);
		$SeoABTests->Session->expects($this->once())
			->method('setFlash')
			->with(__('The seo AB Test has been saved'), 'default');
		$SeoABTests->SeoABTest->expects($this->once())
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
		$SeoABTests = $this->generate(
			'Seo.SeoABTests', array (
				'models' => array ('Seo.SeoABTest' => array ('save', 'create')),
				'components' => array ('Session', 'Security')
			)
		);
		$SeoABTests->Session->expects($this->once())
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
		$SeoABTests = $this->generate(
			'Seo.SeoABTests', array (
				'models' => array ('Seo.SeoABTest' => array ('save', 'create')),
				'components' => array ('Session', 'Security')
			)
		);
		$SeoABTests->Session->expects($this->once())
			->method('setFlash')
			->with(__('The seo AB Test could not be saved. Please, try again.'), 'default');
		$SeoABTests->SeoABTest->expects($this->once())
			->method('save')
			->will($this->returnValue(false)); //success
		$result = $this->testAction(
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
