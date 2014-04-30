<?php
App::uses('SeoUrlsController', 'Seo.Controller');

/**
 * SeoUrlsController Test Case
 *
 */
class SeoUrlsControllerTestCase extends ControllerTestCase {

/**
 * Mock Controller
 *
 */
	public $SeoUrls;

/**
 * Name
 *
 * @var string
 */
	public $name = 'SeoUrls';

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'plugin.seo.seo_url',
		'plugin.seo.seo_uri',
		'plugin.seo.seo_title'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->SeoUrls = $this->generate(
			'Seo.SeoUrls', array (
				'models' => array ('Seo.SeoUrl' => array ('save', 'create', 'exists', 'delete', 'setApproved')),
				'components' => array ('Session', 'Security')
			)
		);
		$this->testData = array (
			'id' => '535f2962-efd0-4ae7-80c5-066c173cdfff',
			'url' => '/products',
			'priority' => '1',
			'created' => '2014-04-28 22:24:02',
			'modified' => '2014-04-28 22:24:39'
		);
	}

/**
 * testAdminIndex method
 *
 * @return void
 */
	public function testAdminIndex() {
		$this->testAction(
			"admin/seo/seo_urls",
			array(
				'return' => 'vars',
				'method' => 'GET'
			)
		);
		$this->assertTrue(isset($this->vars['seoUrls']));
	}

/**
 * testAdminView method
 *
 * @return void
 */
	public function testAdminView() {
		$id = $this->testData['id'];
		$this->SeoUrls->SeoUrl->expects($this->once())
			->method('exists')
			->will($this->returnValue(true));

		$this->testAction(
			"admin/seo/seo_urls/view/$id",
			array('return' => 'vars')
		);
		$this->assertTrue(isset($this->vars['seoUrl']));
		$this->assertEquals($this->vars['model'], 'SeoUrl');
	}

/**
 * testAdminAdd method
 *
 * @return void
 */
	public function testAdminAdd() {
		$this->SeoUrls->Session->expects($this->once())
			->method('setFlash')
			->with(__('The seo url has been saved'), 'default');
		$this->SeoUrls->SeoUrl->expects($this->once())
			->method('create');
		$this->SeoUrls->SeoUrl->expects($this->once())
			->method('save')
			->will($this->returnValue(true));
		unset($this->testData['id']);
		$this->testAction(
			'admin/seo/seo_Urls/add',
			array (
				'data' => array ('SeoUrl' => $this->testData),
				'method' => 'post'
			)
		);
		$this->assertTrue(isset($this->vars['model']));
		$this->assertEquals($this->vars['model'], 'SeoUrl');
	}

/**
 * testAdminAddFail method
 *
 * @return void
 */
	public function testAdminAddFail() {
		$this->SeoUrls->Session->expects($this->once())
			->method('setFlash')
			->with(__('The seo url could not be saved. Please, try again.'), 'default');
		$this->SeoUrls->SeoUrl->expects($this->once())
			->method('create');
		$this->SeoUrls->SeoUrl->expects($this->once())
			->method('save')
			->will($this->returnValue(false));
		unset($this->testData['id']);
		$this->testAction(
			'admin/seo/seo_Urls/add',
			array (
				'data' => array ('SeoUrl' => $this->testData),
				'method' => 'post',
				'return' => 'vars'
			)
		);
		$this->assertTrue(isset($this->vars['model']));
		$this->assertEquals($this->vars['model'], 'SeoUrl');
	}

/**
 * testAdminEditWithData method
 *
 * @return void
 */
	public function testAdminEditWithData() {
		$this->SeoUrls->Session->expects($this->once())
			->method('setFlash')
			->with(__('The seo url has been saved'), 'default');
		$this->SeoUrls->SeoUrl->expects($this->once())
			->method('save')
			->will($this->returnValue(true));
		$this->testAction(
			'admin/seo/seo_Urls/edit',
			array (
				'data' => array ('SeoUrl' => $this->testData),
				'method' => 'post'
			)
		);
		$this->assertTrue(isset($this->vars['model']));
		$this->assertEquals($this->vars['model'], 'SeoUrl');
	}

/**
 * testAdminEditWithNoId method
 *
 * @return void
 */
	public function testAdminEditWithNoId() {
		$this->SeoUrls->Session->expects($this->once())
			->method('setFlash')
			->with(__('Invalid seo url'), 'default');
		$this->testAction(
			'admin/seo/seo_Urls/edit',
			array (
				'method' => 'get'
			)
		);
		$this->assertTrue(isset($this->vars['model']));
		$this->assertEquals($this->vars['model'], 'SeoUrl');
	}

/**
 * testAdminEditSaveFail method
 *
 * @return void
 */
	public function testAdminEditSaveFail() {
		$this->SeoUrls->Session->expects($this->once())
			->method('setFlash')
			->with(__('The seo url could not be saved. Please, try again.'), 'default');
		$this->SeoUrls->SeoUrl->expects($this->once())
			->method('save')
			->will($this->returnValue(false));
		$this->testAction(
			'admin/seo/seo_Urls/edit',
			array (
				'data' => array ('SeoUrl' => $this->testData),
				'method' => 'post',
				'return' => 'vars'
			)
		);
		$this->assertTrue(isset($this->vars['model']));
		$this->assertEquals($this->vars['model'], 'SeoUrl');
	}

/**
 * testAdminDelete method
 *
 * @return void
 */
	public function testAdminDelete() {
		$id = $this->testData['id'];
		$this->SeoUrls->SeoUrl->expects($this->once())
			->method('exists')
			->will($this->returnValue(true));
		$this->SeoUrls->SeoUrl->expects($this->once())
			->method('delete')
			->will($this->returnValue(true));
		$this->SeoUrls->Session->expects($this->once())
			->method('setFlash')
			->with(__('The seo url has been deleted.'), 'default');
		$this->testAction(
			"admin/seo_urls/delete/$id",
			array('return' => 'vars')
		);

		$this->assertStringEndsWith('/admin/seo_urls', $this->headers['Location']);
	}

/**
 * testAdminDeleteFails method
 *
 * @return void
 */
	public function testAdminDeleteFails() {
		$id = $this->testData['id'];
		$this->SeoUrls->SeoUrl->expects($this->once())
			->method('exists')
			->will($this->returnValue(true));
		$this->SeoUrls->SeoUrl->expects($this->once())
			->method('delete')
			->will($this->returnValue(false));
		$this->SeoUrls->Session->expects($this->once())
			->method('setFlash')
			->with(__('The seo url could not be deleted. Please, try again.'), 'default');
		$this->testAction(
			"admin/seo_urls/delete/$id",
			array('return' => 'vars')
		);
		$this->assertStringEndsWith('/admin/seo_urls', $this->headers['Location']);
	}

/**
 * testAdminDeleteInvalidId method
 *
 * @return void
 */
	public function testAdminDeleteInvalidId() {
		$id = 'Invalid';
		$this->SeoUrls->SeoUrl->expects($this->once())
			->method('exists')
			->will($this->returnValue(false));
		$this->setExpectedException('NotFoundException');
		$this->testAction(
			"admin/seo_urls/delete/$id",
			array('return' => 'vars')
		);
		$this->assertStringEndsWith('/admin/seo_urls', $this->headers['Location']);
	}

/**
 * testAdminApprove method
 *
 * @return void
 */
	public function testAdminApprove() {
		$id = $this->testData['id'];
		$this->SeoUrls->SeoUrl->expects($this->once())
			->method('exists')
			->will($this->returnValue(true));
		$this->SeoUrls->SeoUrl->expects($this->once())
			->method('setApproved')
			->will($this->returnValue(true));
		$this->SeoUrls->Session->expects($this->once())
			->method('setFlash')
			->with(__('The seo url has been approved.'), 'default');
		$this->testAction(
			"admin/seo/seo_urls/approve/$id",
			array('return' => 'vars')
		);

		$this->assertStringEndsWith('/admin/seo/seo_urls', $this->headers['Location']);
	}

/**
 * testAdminApproveInvalidId method
 *
 * @return void
 */
	public function testAdminApproveInvalidId() {
		$id = 'invalid';
		$this->SeoUrls->SeoUrl->expects($this->once())
			->method('exists')
			->will($this->returnValue(false));
		$this->setExpectedException('NotFoundException');
		$this->testAction(
			"admin/seo/seo_urls/approve/$id",
			array('return' => 'vars')
		);

		$this->assertStringEndsWith('/admin/seo/seo_urls', $this->headers['Location']);
	}

/**
 * testAdminApprove method
 *
 * @return void
 */
	public function testAdminApproveFails() {
		$id = $this->testData['id'];
		$this->SeoUrls->SeoUrl->expects($this->once())
			->method('exists')
			->will($this->returnValue(true));
		$this->SeoUrls->SeoUrl->expects($this->once())
			->method('setApproved')
			->will($this->returnValue(false));
		$this->SeoUrls->Session->expects($this->once())
			->method('setFlash')
			->with(__('The seo url could not be approved. Please, try again.'), 'default');
		$this->testAction(
			"admin/seo/seo_urls/approve/$id",
			array('return' => 'vars')
		);

		$this->assertStringEndsWith('/admin/seo/seo_urls', $this->headers['Location']);
	}

/**
 * tearDown
 *
 * @return void
 */
	public function tearDown() {
		parent::tearDown();
		unset($this->SeoUrls);
	}

}
