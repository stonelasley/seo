<?php
App::uses('SeoCanonicalsController', 'Seo.Controller');

/**
 * SeoCanonicalsController Test Case
 *
 */
class SeoCanonicalsControllerTest extends ControllerTestCase {

/**
 * Mock Controller
 *
 */
	public $mockController;

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'plugin.seo.seo_canonical',
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
			'Seo.SeoCanonicals', array (
				'models' => array ('Seo.SeoCanonical' => array ('save', 'create', 'exists', 'delete')),
				'components' => array ('Session', 'Security')
			)
		);
		$this->testData = array (
			'id' => '535dac20-60b4-46de-b842-19b8173cdfff',
			'seo_uri_id' => '535da751-0100-409c-9adb-1173173cdfff',
			'canonical' => '/index',
			'is_active' => 1,
			'created' => '2014-04-27 19:17:20',
			'modified' => '2014-04-27 19:17:20'
		);
	}

/**
 * testAdminIndex method
 *
 * @return void
 */
	public function testAdminIndex() {
	}

/**
 * testAdminView method
 *
 * @return void
 */
	public function testAdminView() {
		$id = $this->testData['id'];
		$this->mockController->SeoCanonical->expects($this->once())
			->method('exists')
			->will($this->returnValue(true));

		$this->testAction(
			"admin/seo/seo_canonicals/view/$id",
			array('return' => 'vars')
		);
		$this->assertTrue(isset($this->vars['seoCanonical']));
		$this->assertEquals($this->vars['model'], 'SeoCanonical');
	}

/**
 * testAdminView method
 *
 * @return void
 */
	public function testAdminViewInvalidId() {
		$id = 'Invalid';
		$this->mockController->SeoCanonical->expects($this->once())
			->method('exists')
			->will($this->returnValue(false));
		$this->setExpectedException('NotFoundException');
		$this->testAction(
			"admin/seo/seo_canonicals/view/$id",
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
			->with(__('The seo canonical has been saved'), 'default');
		$this->mockController->SeoCanonical->expects($this->once())
			->method('create');
		$this->mockController->SeoCanonical->expects($this->once())
			->method('save')
			->will($this->returnValue(true));
		unset($this->testData['id']);
		$this->testAction(
			'admin/seo/seo_canonicals/add',
			array (
				'data' => array ('SeoCanonical' => $this->testData),
				'method' => 'post'
			)
		);
		$this->assertTrue(isset($this->vars['model']));
		$this->assertEquals($this->vars['model'], 'SeoCanonical');
	}

/**
 * testAdminAddFail method
 *
 * @return void
 */
	public function testAdminAddFail() {
		$this->mockController->Session->expects($this->once())
			->method('setFlash')
			->with(__('The seo canonical could not be saved. Please, try again.'), 'default');
		$this->mockController->SeoCanonical->expects($this->once())
			->method('create');
		$this->mockController->SeoCanonical->expects($this->once())
			->method('save')
			->will($this->returnValue(false));
		unset($this->testData['id']);
		$this->testAction(
			'admin/seo/seo_canonicals/add',
			array (
				'data' => array ('SeoCanonical' => $this->testData),
				'method' => 'post',
				'return' => 'vars'
			)
		);
		$this->assertTrue(isset($this->vars['model']));
		$this->assertEquals($this->vars['model'], 'SeoCanonical');
	}

/**
 * testAdminEditWithData method
 *
 * @return void
 */
	public function testAdminEditWithData() {
		$this->mockController->Session->expects($this->once())
			->method('setFlash')
			->with(__('The seo canonical has been saved'), 'default');
		$this->mockController->SeoCanonical->expects($this->once())
			->method('save')
			->will($this->returnValue(true));
		$this->testAction(
			'admin/seo/seo_canonicals/edit',
			array (
				'data' => array ('SeoCanonical' => $this->testData),
				'method' => 'post'
			)
		);
		$this->assertTrue(isset($this->vars['model']));
		$this->assertEquals($this->vars['model'], 'SeoCanonical');
	}

/**
 * testAdminEditWithNoId method
 *
 * @return void
 */
	public function testAdminEditWithNoId() {
		$this->mockController->Session->expects($this->once())
			->method('setFlash')
			->with(__('Invalid seo canonical'), 'default');
		$this->testAction(
			'admin/seo/seo_canonicals/edit',
			array (
				'method' => 'get'
			)
		);
		$this->assertTrue(isset($this->vars['model']));
		$this->assertEquals($this->vars['model'], 'SeoCanonical');
	}

/**
 * testAdminEditSaveFail method
 *
 * @return void
 */
	public function testAdminEditSaveFail() {
		$this->mockController->Session->expects($this->once())
			->method('setFlash')
			->with(__('The seo canonical could not be saved. Please, try again.'), 'default');
		$this->mockController->SeoCanonical->expects($this->once())
			->method('save')
			->will($this->returnValue(false));
		$this->testAction(
			'admin/seo/seo_canonicals/edit',
			array (
				'data' => array ('SeoCanonical' => $this->testData),
				'method' => 'post',
				'return' => 'vars'
			)
		);
		$this->assertTrue(isset($this->vars['model']));
		$this->assertEquals($this->vars['model'], 'SeoCanonical');
	}

/**
 * testAdminDelete method
 *
 * @return void
 */
	public function testAdminDelete() {
		$id = $this->testData['id'];
		$this->mockController->SeoCanonical->expects($this->once())
			->method('exists')
			->will($this->returnValue(true));
		$this->mockController->SeoCanonical->expects($this->once())
			->method('delete')
			->will($this->returnValue(true));
		$this->mockController->Session->expects($this->once())
			->method('setFlash')
			->with(__('The seo canonical has been deleted.'), 'default');
		$this->testAction(
			"admin/seo/seo_canonicals/delete/$id",
			array('return' => 'vars')
		);

		$this->assertStringEndsWith('/admin/seo/seo_canonicals', $this->headers['Location']);
	}

/**
 * testAdminDeleteFails method
 *
 * @return void
 */
	public function testAdminDeleteFails() {
		$id = $this->testData['id'];
		$this->mockController->SeoCanonical->expects($this->once())
			->method('exists')
			->will($this->returnValue(true));
		$this->mockController->SeoCanonical->expects($this->once())
			->method('delete')
			->will($this->returnValue(false));
		$this->mockController->Session->expects($this->once())
			->method('setFlash')
			->with(__('The seo canonical could not be deleted. Please, try again.'), 'default');
		$this->testAction(
			"admin/seo/seo_canonicals/delete/$id",
			array('return' => 'vars')
		);
	}

/**
 * testAdminDelete method
 *
 * @return void
 */
	public function testAdminDeleteInvalidId() {
		$id = 'Invalid';
		$this->mockController->SeoCanonical->expects($this->once())
			->method('exists')
			->will($this->returnValue(false));
		$this->setExpectedException('NotFoundException');
		$this->testAction(
			"admin/seo/seo_canonicals/delete/$id",
			array('return' => 'vars')
		);
	}

}
