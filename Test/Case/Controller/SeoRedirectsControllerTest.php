<?php
App::uses('SeoRedirectsController', 'Seo.Controller');
App::uses('Session', 'Controller/Component');

/**
 * SeoRedirectsController Test Case
 *
 */
class SeoRedirectsControllerTest extends ControllerTestCase {

/**
 * Mock Controller
 *
 */
	public $SeoRedirects;

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'plugin.seo.seo_title',
		'plugin.seo.seo_meta_tag',
		'plugin.seo.seo_canonical',
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
		$this->SeoRedirects = $this->generate(
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
		$this->testAction(
			"admin/seo/seo_redirects",
			array(
				'return' => 'vars',
				'method' => 'GET'
			)
		);
		$this->assertTrue(isset($this->vars['seoRedirects']));
	}

/**
 * testAdminView method
 *
 * @return void
 */
	public function testAdminView() {
		$id = $this->testData['id'];
		$this->SeoRedirects->SeoRedirect->expects($this->once())
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
 * testAdminViewInvalidId method
 *
 * @return void
 */
	public function testAdminViewInvalidId() {
		$id = 'Invalid';
		$this->SeoRedirects->SeoRedirect->expects($this->once())
			->method('exists')
			->will($this->returnValue(false));
		$this->setExpectedException('NotFoundException');
		$this->testAction(
			"admin/seo/seo_redirects/view/$id",
			array('return' => 'vars')
		);
	}
/**
 * testAdminAdd method
 *
 * @return void
 */
	public function testAdminAdd() {
		$this->SeoRedirects->Session->expects($this->once())
			->method('setFlash')
			->with(__('The seo redirect has been saved'), 'default');
		$this->SeoRedirects->SeoRedirect->expects($this->once())
			->method('create');
		$this->SeoRedirects->SeoRedirect->expects($this->once())
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
		$this->SeoRedirects->Session->expects($this->once())
			->method('setFlash')
			->with(__('The seo redirect could not be saved. Please, try again.'), 'default');
		$this->SeoRedirects->SeoRedirect->expects($this->once())
			->method('create');
		$this->SeoRedirects->SeoRedirect->expects($this->once())
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
		$this->SeoRedirects->Session->expects($this->once())
			->method('setFlash')
			->with(__('The seo redirect has been saved'), 'default');
		$this->SeoRedirects->SeoRedirect->expects($this->once())
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
		$this->SeoRedirects->Session->expects($this->once())
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
		$this->SeoRedirects->Session->expects($this->once())
			->method('setFlash')
			->with(__('The seo redirect could not be saved. Please, try again.'), 'default');
		$this->SeoRedirects->SeoRedirect->expects($this->once())
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
		$this->SeoRedirects->SeoRedirect->expects($this->once())
			->method('exists')
			->will($this->returnValue(true));
		$this->SeoRedirects->SeoRedirect->expects($this->once())
			->method('delete')
			->will($this->returnValue(true));
		$this->SeoRedirects->Session->expects($this->once())
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
		$this->SeoRedirects->SeoRedirect->expects($this->once())
			->method('exists')
			->will($this->returnValue(true));
		$this->SeoRedirects->SeoRedirect->expects($this->once())
			->method('delete')
			->will($this->returnValue(false));
		$this->SeoRedirects->Session->expects($this->once())
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
		$this->SeoRedirects->SeoRedirect->expects($this->once())
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
