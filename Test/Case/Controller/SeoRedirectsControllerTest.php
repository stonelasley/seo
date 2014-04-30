<?php
App::uses('SeoRedirectsController', 'Seo.Controller');

/**
 * SeoRedirectsController Test Case
 *
 */
class SeoRedirectsControllerTest extends ControllerTestCase {

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
		'plugin.seo.seo_redirect',
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
			'Seo.SeoRedirects', array (
				'models' => array ('Seo.SeoRedirect' => array ('save', 'create', 'exists', 'delete')),
				'components' => array ('Session', 'Security')
			)
		);
		$this->testData = array (
			'id' => '535f0cbe-cd64-4ca6-ae77-066f173cdfff',
			'seo_uri_id' => '535f0cbe-ba00-4403-a69d-066f173cdfff',
			'redirect' => '/about',
			'priority' => '1',
			'is_active' => true,
			'callback' => '',
			'created' => '2014-04-28 20:21:50',
			'modified' => '2014-04-28 20:21:50'
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
		$this->mockController->SeoRedirect->expects($this->once())
			->method('exists')
			->will($this->returnValue(true));

		$this->testAction(
			"admin/seo/seo_redirects/view/$id",
			array('return' => 'vars')
		);
		$this->assertTrue(isset($this->vars['seoRedirect']));
		$this->assertEquals($this->vars['model'], 'SeoRedirect');
	}

/**
 * testAdminAdd method
 *
 * @return void
 */
	public function testAdminAdd() {
		$this->mockController->Session->expects($this->once())
			->method('setFlash')
			->with(__('The seo redirect has been saved'), 'default');
		$this->mockController->SeoRedirect->expects($this->once())
			->method('create');
		$this->mockController->SeoRedirect->expects($this->once())
			->method('save')
			->will($this->returnValue(true));
		unset($this->testData['id']);
		$this->testAction(
			'admin/seo/seo_redirects/add',
			array (
				'data' => array ('SeoRedirect' => $this->testData),
				'method' => 'post'
			)
		);
		$this->assertTrue(isset($this->vars['model']));
		$this->assertEquals($this->vars['model'], 'SeoRedirect');
	}

/**
 * testAdminAddFail method
 *
 * @return void
 */
	public function testAdminAddFail() {
		$this->mockController->Session->expects($this->once())
			->method('setFlash')
			->with(__('The seo redirect could not be saved. Please, try again.'), 'default');
		$this->mockController->SeoRedirect->expects($this->once())
			->method('create');
		$this->mockController->SeoRedirect->expects($this->once())
			->method('save')
			->will($this->returnValue(false));
		unset($this->testData['id']);
		$this->testAction(
			'admin/seo/seo_redirects/add',
			array (
				'data' => array ('SeoRedirect' => $this->testData),
				'method' => 'post',
				'return' => 'vars'
			)
		);
		$this->assertTrue(isset($this->vars['model']));
		$this->assertEquals($this->vars['model'], 'SeoRedirect');
	}

/**
 * testAdminEditWithData method
 *
 * @return void
 */
	public function testAdminEditWithData() {
		$this->mockController->Session->expects($this->once())
			->method('setFlash')
			->with(__('The seo redirect has been saved'), 'default');
		$this->mockController->SeoRedirect->expects($this->once())
			->method('save')
			->will($this->returnValue(true));
		$this->testAction(
			'admin/seo/seo_redirects/edit',
			array (
				'data' => array ('SeoRedirect' => $this->testData),
				'method' => 'post'
			)
		);
		$this->assertTrue(isset($this->vars['model']));
		$this->assertEquals($this->vars['model'], 'SeoRedirect');
	}

/**
 * testAdminEditWithNoId method
 *
 * @return void
 */
	public function testAdminEditWithNoId() {
		$this->mockController->Session->expects($this->once())
			->method('setFlash')
			->with(__('Invalid seo redirect'), 'default');
		$this->testAction(
			'admin/seo/seo_redirects/edit',
			array (
				'method' => 'get'
			)
		);
		$this->assertTrue(isset($this->vars['model']));
		$this->assertEquals($this->vars['model'], 'SeoRedirect');
	}

/**
 * testAdminEditSaveFail method
 *
 * @return void
 */
	public function testAdminEditSaveFail() {
		$this->mockController->Session->expects($this->once())
			->method('setFlash')
			->with(__('The seo redirect could not be saved. Please, try again.'), 'default');
		$this->mockController->SeoRedirect->expects($this->once())
			->method('save')
			->will($this->returnValue(false));
		$this->testAction(
			'admin/seo/seo_redirects/edit',
			array (
				'data' => array ('SeoRedirect' => $this->testData),
				'method' => 'post',
				'return' => 'vars'
			)
		);
		$this->assertTrue(isset($this->vars['model']));
		$this->assertEquals($this->vars['model'], 'SeoRedirect');
	}

/**
 * testAdminDelete method
 *
 * @return void
 */
	public function testAdminDelete() {
		$id = $this->testData['id'];
		$this->mockController->SeoRedirect->expects($this->once())
			->method('exists')
			->will($this->returnValue(true));
		$this->mockController->SeoRedirect->expects($this->once())
			->method('delete')
			->will($this->returnValue(true));
		$this->mockController->Session->expects($this->once())
			->method('setFlash')
			->with(__('The seo redirect has been deleted.'), 'default');
		$this->testAction(
			"admin/seo/seo_redirects/delete/$id",
			array('return' => 'vars')
		);

		$this->assertStringEndsWith('/admin/seo/seo_redirects', $this->headers['Location']);
	}

/**
 * testAdminDeleteFails method
 *
 * @return void
 */
	public function testAdminDeleteFails() {
		$id = $this->testData['id'];
		$this->mockController->SeoRedirect->expects($this->once())
			->method('exists')
			->will($this->returnValue(true));
		$this->mockController->SeoRedirect->expects($this->once())
			->method('delete')
			->will($this->returnValue(false));
		$this->mockController->Session->expects($this->once())
			->method('setFlash')
			->with(__('The seo redirect could not be deleted. Please, try again.'), 'default');
		$this->testAction(
			"admin/seo/seo_redirects/delete/$id",
			array('return' => 'vars')
		);
		$this->assertStringEndsWith('/admin/seo/seo_redirects', $this->headers['Location']);
	}

/**
 * testAdminDeleteInvalidId method
 *
 * @return void
 */
	public function testAdminDeleteInvalidId() {
		$id = 'Invalid';
		$this->mockController->SeoRedirect->expects($this->once())
			->method('exists')
			->will($this->returnValue(false));
		$this->setExpectedException('NotFoundException');
		$this->testAction(
			"admin/seo/seo_redirects/delete/$id",
			array('return' => 'vars')
		);
		$this->assertStringEndsWith('/admin/seo/seo_redirects', $this->headers['Location']);
	}

}
