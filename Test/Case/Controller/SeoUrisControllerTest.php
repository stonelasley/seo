<?php
App::uses('SeoUrisController', 'Seo.Controller');


/**
 * SeoUrisController Test Case
 *
 */
class SeoUrisControllerTest extends ControllerTestCase {

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
		'plugin.seo.seo_uri',
		'plugin.seo.seo_meta_tag',
		'plugin.seo.seo_title',
		'plugin.seo.seo_redirect',
		'plugin.seo.seo_canonical',
		'plugin.seo.seo_status_code'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->mockController = $this->generate(
			'Seo.SeoUris', array (
				'models' => array ('Seo.SeoUri' => array ('saveAll', 'create', 'exists', 'delete')),
				'components' => array ('Session', 'Security')
			)
		);
		$this->testData = array(
			'SeoUri' => array(
				'id' => '535da751-0100-409c-9adb-1173173cdfff',
				'uri' => '/',
				'is_approved' => '1'
			),
			'SeoTitle' => array(
				'id' => '535dab35-c600-4721-8a78-1175173cdfff',
				'title' => 'home page'
			),
			'SeoMetaTag' => array(
				0 => array(
					'id' => '535da751-922c-4089-8779-1173173cdfff',
					'name' => 'description',
					'content' => 'home page description content',
					'is_http_equiv' => '1'
				),
				1 => array(
					'id' => '535da751-dc40-4991-a9a9-1173173cdfff',
					'name' => 'keywords',
					'content' => 'home page keywords content',
					'is_http_equiv' => '1'
				),
				2 => array(
					'id' => '535da751-1524-42f9-a722-1173173cdfff',
					'name' => 'robots',
					'content' => 'home page robots content',
					'is_http_equiv' => '1'
				)
			)
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
 * testAdminUrlencode method
 *
 * @return void
 */
	public function testAdminUrlencode() {
	}

/**
 * testAdminView method
 *
 * @return void
 */
	public function testAdminView() {
		$id = $this->testData['id'];
		$this->mockController->SeoUri->expects($this->once())
			->method('exists')
			->will($this->returnValue(true));

		$this->testAction(
			"admin/seo/seo_uris/view/$id",
			array('return' => 'vars')
		);
		$this->assertTrue(isset($this->vars['seoUri']));
		$this->assertEquals($this->vars['model'], 'SeoUri');
	}

/**
 * testAdminAdd method
 *
 * @return void
 */
	public function testAdminAdd() {
		$this->mockController->Session->expects($this->once())
			->method('setFlash')
			->with(__('The seo uri has been saved'), 'default');
		$this->mockController->SeoUri->expects($this->any())
			->method('create');
		$this->mockController->SeoUri->expects($this->once())
			->method('saveAll')
			->will($this->returnValue(true));
		unset($this->testData['id']);
		$this->testAction(
			'admin/seo/seo_uris/add',
			array (
				'data' => $this->testData,
				'method' => 'post'
			)
		);
		$this->assertTrue(isset($this->vars['model']));
		$this->assertEquals($this->vars['model'], 'SeoUri');
	}

/**
 * testAdminAddFail method
 *
 * @return void
 */
	public function testAdminAddFail() {
		$this->mockController->Session->expects($this->once())
			->method('setFlash')
			->with(__('The seo uri could not be saved. Please, try again.'), 'default');
		$this->mockController->SeoUri->expects($this->any())
			->method('create');
		$this->mockController->SeoUri->expects($this->once())
			->method('saveAll')
			->will($this->returnValue(false));
		unset($this->testData['id']);
		$result = $this->testAction(
			'admin/seo/seo_uris/add',
			array (
				'data' => $this->testData,
				'method' => 'post',
				'return' => 'vars'
			)
		);
		$this->assertTrue(isset($this->vars['model']));
		$this->assertEquals($this->vars['model'], 'SeoUri');
	}

/**
 * testAdminEditWithData method
 *
 * @return void
 */
	public function testAdminEditWithData() {
		$this->mockController->Session->expects($this->once())
			->method('setFlash')
			->with(__('The seo uri has been saved'), 'default');
		$this->mockController->SeoUri->expects($this->once())
			->method('saveAll')
			->will($this->returnValue(true));
		$this->testAction(
			'admin/seo/seo_uris/edit',
			array (
				'data' => $this->testData,
				'method' => 'post'
			)
		);
		$this->assertTrue(isset($this->vars['model']));
		$this->assertEquals($this->vars['model'], 'SeoUri');
	}

/**
 * testAdminEditWithNoId method
 *
 * @return void
 */
	public function testAdminEditWithNoId() {
		$this->mockController->Session->expects($this->once())
			->method('setFlash')
			->with(__('Invalid seo uri'), 'default');
		$this->testAction(
			'admin/seo/seo_uris/edit',
			array (
				'method' => 'get'
			)
		);
		$this->assertTrue(isset($this->vars['model']));
		$this->assertEquals($this->vars['model'], 'SeoUri');
	}

/**
 * testAdminEditSaveFail method
 *
 * @return void
 */
	public function testAdminEditSaveFail() {
		$this->mockController->Session->expects($this->once())
			->method('setFlash')
			->with(__('The seo uri could not be saved. Please, try again.'), 'default');
		$this->mockController->SeoUri->expects($this->once())
			->method('saveAll')
			->will($this->returnValue(false));
		$result = $this->testAction(
			'admin/seo/seo_uris/edit',
			array (
				'data' => $this->testData,
				'method' => 'post',
				'return' => 'vars'
			)
		);
		$this->assertTrue(isset($this->vars['model']));
		$this->assertEquals($this->vars['model'], 'SeoUri');
	}

/**
 * testAdminDelete method
 *
 * @return void
 */
	public function testAdminDelete() {
		$id = $this->testData['id'];
		$this->mockController->SeoUri->expects($this->once())
			->method('exists')
			->will($this->returnValue(true));
		$this->mockController->SeoUri->expects($this->once())
			->method('delete')
			->will($this->returnValue(true));
		$this->mockController->Session->expects($this->once())
			->method('setFlash')
			->with(__('The seo uri has been deleted.'), 'default');
		$this->testAction(
			"admin/seo/seo_uris/delete/$id",
			array('return' => 'vars')
		);

		$this->assertStringEndsWith('/admin/seo/seo_uris', $this->headers['Location']);
	}

/**
 * testAdminDeleteFails method
 *
 * @return void
 */
	public function testAdminDeleteFails() {
		$id = $this->testData['id'];
		$this->mockController->SeoUri->expects($this->once())
			->method('exists')
			->will($this->returnValue(true));
		$this->mockController->SeoUri->expects($this->once())
			->method('delete')
			->will($this->returnValue(false));
		$this->mockController->Session->expects($this->once())
			->method('setFlash')
			->with(__('The seo uri could not be deleted. Please, try again.'), 'default');
		$this->testAction(
			"admin/seo/seo_uris/delete/$id",
			array('return' => 'vars')
		);
		$this->assertStringEndsWith('/admin/seo/seo_uris', $this->headers['Location']);
	}

/**
 * testAdminDeleteInvalidId method
 *
 * @return void
 */
	public function testAdminDeleteInvalidId() {
		$id = 'Invalid';
		$this->mockController->SeoUri->expects($this->once())
			->method('exists')
			->will($this->returnValue(false));
		$this->setExpectedException('NotFoundException');
		$this->testAction(
			"admin/seo/seo_uris/delete/$id",
			array('return' => 'vars')
		);
		$this->assertStringEndsWith('/admin/seo/seo_uris', $this->headers['Location']);
	}

/**
 * testAdminApprove method
 *
 * @return void
 */
	public function testAdminApprove() {
	}

}
