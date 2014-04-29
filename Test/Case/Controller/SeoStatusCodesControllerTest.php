<?php
App::uses('SeoStatusCodesController', 'Seo.Controller');

/**
 * SeoStatusCodesController Test Case
 *
 */
class SeoStatusCodesControllerTest extends ControllerTestCase {

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
	}

/**
 * testAdminAdd method
 *
 * @return void
 */
	public function testAdminAdd() {
		$SeoStatusCodes = $this->generate(
			'Seo.SeoStatusCodes', array (
				'models' => array ('Seo.SeoStatusCode' => array ('save', 'create')),
				'components' => array ('Session', 'Security')
			)
		);
		$SeoStatusCodes->Session->expects($this->once())
			->method('setFlash')
			->with(__('The seo status code has been saved'), 'default');
		$SeoStatusCodes->SeoStatusCode->expects($this->once())
			->method('create');
		$SeoStatusCodes->SeoStatusCode->expects($this->once())
			->method('save')
			->will($this->returnValue(true)); //success
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
		$SeoStatusCodes = $this->generate(
			'Seo.SeoStatusCodes', array (
				'models' => array ('Seo.SeoStatusCode' => array ('save', 'create')),
				'components' => array ('Session', 'Security')
			)
		);
		$SeoStatusCodes->Session->expects($this->once())
			->method('setFlash')
			->with(__('The seo status code could not be saved. Please, try again.'), 'default');
		$SeoStatusCodes->SeoStatusCode->expects($this->once())
			->method('create');
		$SeoStatusCodes->SeoStatusCode->expects($this->once())
			->method('save')
			->will($this->returnValue(false)); //success
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
		$SeoStatusCodes = $this->generate(
			'Seo.SeoStatusCodes', array (
				'models' => array ('Seo.SeoStatusCode' => array ('save', 'create')),
				'components' => array ('Session', 'Security')
			)
		);
		$SeoStatusCodes->Session->expects($this->once())
			->method('setFlash')
			->with(__('The seo status code has been saved'), 'default');
		$SeoStatusCodes->SeoStatusCode->expects($this->once())
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
		$SeoStatusCodes = $this->generate(
			'Seo.SeoStatusCodes', array (
				'models' => array ('Seo.SeoStatusCode' => array ('save', 'create')),
				'components' => array ('Session', 'Security')
			)
		);
		$SeoStatusCodes->Session->expects($this->once())
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
		$SeoStatusCodes = $this->generate(
			'Seo.SeoStatusCodes', array (
				'models' => array ('Seo.SeoStatusCode' => array ('save', 'create')),
				'components' => array ('Session', 'Security')
			)
		);
		$SeoStatusCodes->Session->expects($this->once())
			->method('setFlash')
			->with(__('The seo status code could not be saved. Please, try again.'), 'default');
		$SeoStatusCodes->SeoStatusCode->expects($this->once())
			->method('save')
			->will($this->returnValue(false)); //success
		$result = $this->testAction(
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
	}

}
