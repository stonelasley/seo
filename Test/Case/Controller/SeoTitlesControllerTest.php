<?php
App::uses('SeoTitlesController', 'Seo.Controller');

/**
 * SeoTitlesController Test Case
 *
 */
class SeoTitlesControllerTest extends ControllerTestCase {

/**
 * Mock Controller
 *
 */
	public $SeoTitles;

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'plugin.seo.seo_title',
		'plugin.seo.seo_meta_tag',
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
		$this->SeoTitles = $this->generate(
			'Seo.SeoTitles', array (
				'models' => array ('Seo.SeoTitle' => array ('save', 'create', 'exists', 'delete')),
				'components' => array ('Session', 'Security')
			)
		);
		$this->testData = array (
			'id' => '535dab35-c600-4721-8a78-1175173cdfff',
			'seo_uri_id' => '535da751-0100-409c-9adb-1173173cdfff',
			'title' => 'home page',
			'created' => '2014-04-27 19:13:25',
			'modified' => '2014-04-27 19:37:52'
		);
	}

/**
 * testAdminIndex method
 *
 * @return void
 */
	public function testAdminIndex() {
		$this->testAction(
			"admin/seo/seo_titles",
			array(
				'return' => 'vars',
				'method' => 'GET'
			)
		);
		$this->assertTrue(isset($this->vars['seoTitles']));
	}

/**
 * testAdminView method
 *
 * @return void
 */
	public function testAdminView() {
		$id = $this->testData['id'];
		$this->SeoTitles->SeoTitle->expects($this->once())
			->method('exists')
			->will($this->returnValue(true));

		$this->testAction(
			"admin/seo/seo_titles/view/$id",
			array('return' => 'vars')
		);
		$this->assertTrue(isset($this->vars['seoTitle']));
		$this->assertEquals($this->vars['model'], 'SeoTitle');
	}

/**
 * testAdminViewInvalidId method
 *
 * @return void
 */
	public function testAdminViewInvalidId() {
		$id = 'Invalid';
		$this->SeoTitles->SeoTitle->expects($this->once())
			->method('exists')
			->will($this->returnValue(false));
		$this->setExpectedException('NotFoundException');
		$this->testAction(
			"admin/seo/seo_titles/view/$id",
			array('return' => 'vars')
		);
	}
/**
 * testAdminAdd method
 *
 * @return void
 */
	public function testAdminAdd() {
		$this->SeoTitles->Session->expects($this->once())
			->method('setFlash')
			->with(__('The seo title has been saved'), 'default');
		$this->SeoTitles->SeoTitle->expects($this->once())
			->method('create');
		$this->SeoTitles->SeoTitle->expects($this->once())
			->method('save')
			->will($this->returnValue(true));
		unset($this->testData['id']);
		$this->testAction(
			'admin/seo/seo_titles/add',
			array (
				'data' => array ('SeoTitle' => $this->testData),
				'method' => 'post'
			)
		);
		$this->assertTrue(isset($this->vars['model']));
		$this->assertEquals($this->vars['model'], 'SeoTitle');
	}

/**
 * testAdminAddFail method
 *
 * @return void
 */
	public function testAdminAddFail() {
		$this->SeoTitles->Session->expects($this->once())
			->method('setFlash')
			->with(__('The seo title could not be saved. Please, try again.'), 'default');
		$this->SeoTitles->SeoTitle->expects($this->once())
			->method('create');
		$this->SeoTitles->SeoTitle->expects($this->once())
			->method('save')
			->will($this->returnValue(false));
		unset($this->testData['id']);
		$result = $this->testAction(
			'admin/seo/seo_titles/add',
			array (
				'data' => array ('SeoTitle' => $this->testData),
				'method' => 'post',
				'return' => 'vars'
			)
		);
		$this->assertTrue(isset($this->vars['model']));
		$this->assertEquals($this->vars['model'], 'SeoTitle');
	}

/**
 * testAdminEditWithData method
 *
 * @return void
 */
	public function testAdminEditWithData() {
		$this->SeoTitles->Session->expects($this->once())
			->method('setFlash')
			->with(__('The seo title has been saved'), 'default');
		$this->SeoTitles->SeoTitle->expects($this->once())
			->method('save')
			->will($this->returnValue(true));
		$this->testAction(
			'admin/seo/seo_titles/edit',
			array (
				'data' => array ('SeoTitle' => $this->testData),
				'method' => 'post'
			)
		);
		$this->assertTrue(isset($this->vars['model']));
		$this->assertEquals($this->vars['model'], 'SeoTitle');
	}

/**
 * testAdminEditWithNoId method
 *
 * @return void
 */
	public function testAdminEditWithNoId() {
		$this->SeoTitles->Session->expects($this->once())
			->method('setFlash')
			->with(__('Invalid seo title'), 'default');
		$this->testAction(
			'admin/seo/seo_titles/edit',
			array (
				'method' => 'get'
			)
		);
		$this->assertTrue(isset($this->vars['model']));
		$this->assertEquals($this->vars['model'], 'SeoTitle');
	}

/**
 * testAdminEditSaveFail method
 *
 * @return void
 */
	public function testAdminEditSaveFail() {
		$this->SeoTitles->Session->expects($this->once())
			->method('setFlash')
			->with(__('The seo title could not be saved. Please, try again.'), 'default');
		$this->SeoTitles->SeoTitle->expects($this->once())
			->method('save')
			->will($this->returnValue(false));
		$this->testAction(
			'admin/seo/seo_titles/edit',
			array (
				'data' => array ('SeoTitle' => $this->testData),
				'method' => 'post',
				'return' => 'vars'
			)
		);
		$this->assertTrue(isset($this->vars['model']));
		$this->assertEquals($this->vars['model'], 'SeoTitle');
	}

/**
 * testAdminDelete method
 *
 * @return void
 */
	public function testAdminDelete() {
		$id = $this->testData['id'];
		$this->SeoTitles->SeoTitle->expects($this->once())
			->method('exists')
			->will($this->returnValue(true));
		$this->SeoTitles->SeoTitle->expects($this->once())
			->method('delete')
			->will($this->returnValue(true));
		$this->SeoTitles->Session->expects($this->once())
			->method('setFlash')
			->with(__('The seo title has been deleted.'), 'default');
		$this->testAction(
			"admin/seo/seo_titles/delete/$id",
			array('return' => 'vars')
		);

		$this->assertStringEndsWith('/admin/seo/seo_titles', $this->headers['Location']);
	}

/**
 * testAdminDeleteFails method
 *
 * @return void
 */
	public function testAdminDeleteFails() {
		$id = $this->testData['id'];
		$this->SeoTitles->SeoTitle->expects($this->once())
			->method('exists')
			->will($this->returnValue(true));
		$this->SeoTitles->SeoTitle->expects($this->once())
			->method('delete')
			->will($this->returnValue(false));
		$this->SeoTitles->Session->expects($this->once())
			->method('setFlash')
			->with(__('The seo title could not be deleted. Please, try again.'), 'default');
		$this->testAction(
			"admin/seo/seo_titles/delete/$id",
			array('return' => 'vars')
		);
		$this->assertStringEndsWith('/admin/seo/seo_titles', $this->headers['Location']);
	}

/**
 * testAdminDeleteInvalidId method
 *
 * @return void
 */
	public function testAdminDeleteInvalidId() {
		$id = 'Invalid';
		$this->SeoTitles->SeoTitle->expects($this->once())
			->method('exists')
			->will($this->returnValue(false));
		$this->setExpectedException('NotFoundException');
		$this->testAction(
			"admin/seo/seo_titles/delete/$id",
			array('return' => 'vars')
		);
		$this->assertStringEndsWith('/admin/seo/seo_titles', $this->headers['Location']);
	}

}
