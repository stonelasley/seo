<?php
App::uses('SeoRedirectsController', 'Seo.Controller');

/**
 * SeoRedirectsController Test Case
 *
 */
class SeoRedirectsControllerTest extends ControllerTestCase {

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
	}

/**
 * testAdminAdd method
 *
 * @return void
 */
	public function testAdminAdd() {
		$SeoRedirects = $this->generate(
			'Seo.SeoRedirects', array (
				'models' => array ('Seo.SeoRedirect' => array ('save', 'create')),
				'components' => array ('Session', 'Security')
			)
		);
		$SeoRedirects->Session->expects($this->once())
			->method('setFlash')
			->with(__('The seo redirect has been saved'), 'default');
		$SeoRedirects->SeoRedirect->expects($this->once())
			->method('create');
		$SeoRedirects->SeoRedirect->expects($this->once())
			->method('save')
			->will($this->returnValue(true)); //success
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
		$SeoRedirects = $this->generate(
			'Seo.SeoRedirects', array (
				'models' => array ('Seo.SeoRedirect' => array ('save', 'create')),
				'components' => array ('Session', 'Security')
			)
		);
		$SeoRedirects->Session->expects($this->once())
			->method('setFlash')
			->with(__('The seo redirect could not be saved. Please, try again.'), 'default');
		$SeoRedirects->SeoRedirect->expects($this->once())
			->method('create');
		$SeoRedirects->SeoRedirect->expects($this->once())
			->method('save')
			->will($this->returnValue(false)); //success
		unset($this->testData['id']);
		$result = $this->testAction(
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
		$SeoRedirects = $this->generate(
			'Seo.SeoRedirects', array (
				'models' => array ('Seo.SeoRedirect' => array ('save', 'create')),
				'components' => array ('Session', 'Security')
			)
		);
		$SeoRedirects->Session->expects($this->once())
			->method('setFlash')
			->with(__('The seo redirect has been saved'), 'default');
		$SeoRedirects->SeoRedirect->expects($this->once())
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
		$SeoRedirects = $this->generate(
			'Seo.SeoRedirects', array (
				'models' => array ('Seo.SeoRedirect' => array ('save', 'create')),
				'components' => array ('Session', 'Security')
			)
		);
		$SeoRedirects->Session->expects($this->once())
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
		$SeoRedirects = $this->generate(
			'Seo.SeoRedirects', array (
				'models' => array ('Seo.SeoRedirect' => array ('save', 'create')),
				'components' => array ('Session', 'Security')
			)
		);
		$SeoRedirects->Session->expects($this->once())
			->method('setFlash')
			->with(__('The seo redirect could not be saved. Please, try again.'), 'default');
		$SeoRedirects->SeoRedirect->expects($this->once())
			->method('save')
			->will($this->returnValue(false)); //success
		$result = $this->testAction(
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
	}

}
