<?php
App::uses('SeoStatusCodesController', 'Seo.Controller');

/**
 * SeoStatusCodesController Test Case
 *
 */
class SeoStatusCodesControllerTest extends ControllerTestCase {

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
		'plugin.seo.seo_status_code',
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
			'Seo.SeoStatusCodes', array (
				'models' => array ('Seo.SeoStatusCode' => array ('save', 'create', 'exists', 'delete')),
				'components' => array ('Session', 'Security')
			)
		);
		$this->testData = array (
			'id' => 'e55bf308-a6c2-486b-8504-d5baca9f9fee',
			'seo_uri_id' => '535f0ce3-bc44-4327-2345-066d173cdfff',
			'status_code' => 302,
			'priority' => 100,
			'is_active' => 1,
			'created' => '2011-07-25 17:06:20',
			'modified' => '2011-07-25 17:06:20'
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
		$this->mockController->SeoStatusCode->expects($this->once())
			->method('exists')
			->will($this->returnValue(true));

		$this->testAction(
			"admin/seo/seo_status_codes/view/$id",
			array('return' => 'vars')
		);
		$this->assertTrue(isset($this->vars['seoStatusCode']));
		$this->assertEquals($this->vars['model'], 'SeoStatusCode');
	}

/**
 * testAdminAdd method
 *
 * @return void
 */
	public function testAdminAdd() {
		$this->mockController->Session->expects($this->once())
			->method('setFlash')
			->with(__('The seo status code has been saved'), 'default');
		$this->mockController->SeoStatusCode->expects($this->once())
			->method('create');
		$this->mockController->SeoStatusCode->expects($this->once())
			->method('save')
			->will($this->returnValue(true));
		unset($this->testData['id']);
		$this->testAction(
			'admin/seo/seo_status_codes/add',
			array (
				'data' => array ('SeoStatusCode' => $this->testData),
				'method' => 'post'
			)
		);
		$this->assertTrue(isset($this->vars['model']));
		$this->assertEquals($this->vars['model'], 'SeoStatusCode');
	}

/**
 * testAdminAddFail method
 *
 * @return void
 */
	public function testAdminAddFail() {
		$this->mockController->Session->expects($this->once())
			->method('setFlash')
			->with(__('The seo status code could not be saved. Please, try again.'), 'default');
		$this->mockController->SeoStatusCode->expects($this->once())
			->method('create');
		$this->mockController->SeoStatusCode->expects($this->once())
			->method('save')
			->will($this->returnValue(false));
		unset($this->testData['id']);
		$result = $this->testAction(
			'admin/seo/seo_status_codes/add',
			array (
				'data' => array ('SeoStatusCode' => $this->testData),
				'method' => 'post',
				'return' => 'vars'
			)
		);
		$this->assertTrue(isset($this->vars['model']));
		$this->assertEquals($this->vars['model'], 'SeoStatusCode');
	}

/**
 * testAdminEditWithData method
 *
 * @return void
 */
	public function testAdminEditWithData() {
		$this->mockController->Session->expects($this->once())
			->method('setFlash')
			->with(__('The seo status code has been saved'), 'default');
		$this->mockController->SeoStatusCode->expects($this->once())
			->method('save')
			->will($this->returnValue(true));
		$this->testAction(
			'admin/seo/seo_status_codes/edit',
			array (
				'data' => array ('SeoStatusCode' => $this->testData),
				'method' => 'post'
			)
		);
		$this->assertTrue(isset($this->vars['model']));
		$this->assertEquals($this->vars['model'], 'SeoStatusCode');
	}

/**
 * testAdminEditWithNoId method
 *
 * @return void
 */
	public function testAdminEditWithNoId() {
		$this->mockController->Session->expects($this->once())
			->method('setFlash')
			->with(__('Invalid seo status code'), 'default');
		$this->testAction(
			'admin/seo/seo_status_codes/edit',
			array (
				'method' => 'get'
			)
		);
		$this->assertTrue(isset($this->vars['model']));
		$this->assertEquals($this->vars['model'], 'SeoStatusCode');
	}

/**
 * testAdminEditSaveFail method
 *
 * @return void
 */
	public function testAdminEditSaveFail() {
		$this->mockController->Session->expects($this->once())
			->method('setFlash')
			->with(__('The seo status code could not be saved. Please, try again.'), 'default');
		$this->mockController->SeoStatusCode->expects($this->once())
			->method('save')
			->will($this->returnValue(false));
		$this->testAction(
			'admin/seo/seo_status_codes/edit',
			array (
				'data' => array ('SeoStatusCode' => $this->testData),
				'method' => 'post',
				'return' => 'vars'
			)
		);
		$this->assertTrue(isset($this->vars['model']));
		$this->assertEquals($this->vars['model'], 'SeoStatusCode');
	}

/**
 * testAdminDelete method
 *
 * @return void
 */
	public function testAdminDelete() {
		$id = $this->testData['id'];
		$this->mockController->SeoStatusCode->expects($this->once())
			->method('exists')
			->will($this->returnValue(true));
		$this->mockController->SeoStatusCode->expects($this->once())
			->method('delete')
			->will($this->returnValue(true));
		$this->mockController->Session->expects($this->once())
			->method('setFlash')
			->with(__('The seo status code has been deleted.'), 'default');
		$this->testAction(
			"admin/seo_status_codes/delete/$id",
			array('return' => 'vars')
		);

		$this->assertStringEndsWith('/admin/seo_status_codes', $this->headers['Location']);
	}

/**
 * testAdminDeleteFails method
 *
 * @return void
 */
	public function testAdminDeleteFails() {
		$id = $this->testData['id'];
		$this->mockController->SeoStatusCode->expects($this->once())
			->method('exists')
			->will($this->returnValue(true));
		$this->mockController->SeoStatusCode->expects($this->once())
			->method('delete')
			->will($this->returnValue(false));
		$this->mockController->Session->expects($this->once())
			->method('setFlash')
			->with(__('The seo status code could not be deleted. Please, try again.'), 'default');
		$this->testAction(
			"admin/seo_status_codes/delete/$id",
			array('return' => 'vars')
		);
		$this->assertStringEndsWith('/admin/seo_status_codes', $this->headers['Location']);
	}

/**
 * testAdminDeleteInvalidId method
 *
 * @return void
 */
	public function testAdminDeleteInvalidId() {
		$id = 'Invalid';
		$this->mockController->SeoStatusCode->expects($this->once())
			->method('exists')
			->will($this->returnValue(false));
		$this->setExpectedException('NotFoundException');
		$this->testAction(
			"admin/seo_status_codes/delete/$id",
			array('return' => 'vars')
		);
		$this->assertStringEndsWith('/admin/seo_status_codes', $this->headers['Location']);
	}

}
