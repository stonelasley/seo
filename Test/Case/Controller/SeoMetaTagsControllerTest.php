<?php
App::uses('SeoMetaTagsController', 'Seo.Controller');

/**
 * SeoMetaTagsController Test Case
 *
 */
class SeoMetaTagsControllerTest extends ControllerTestCase {

/**
 * Mock Controller
 *
 */
	public $SeoMetaTags;

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'plugin.seo.seo_title',
		'plugin.seo.seo_meta_tag',
		'plugin.seo.seo_canonical',
		'plugin.seo.seo_uri',
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->SeoMetaTags = $this->generate(
			'Seo.SeoMetaTags', array (
				'models' => array ('Seo.SeoMetaTag' => array ('save', 'create', 'exists', 'delete')),
				'components' => array ('Session', 'Security')
			)
		);
		$this->testData = array (
			'id' => '535da751-922c-4089-8779-1173173cdfff',
			'seo_uri_id' => '535da751-0100-409c-9adb-1173173cdfff',
			'name' => 'description',
			'content' => 'home page description content',
			'is_http_equiv' => 1,
			'created' => '2014-04-27 18:56:49',
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
			"admin/seo/seo_meta_tags",
			array(
				'return' => 'vars',
				'method' => 'GET'
			)
		);
		$this->assertTrue(isset($this->vars['seoMetaTags']));
	}

/**
 * testAdminView method
 *
 * @return void
 */
	public function testAdminView() {
		$id = $this->testData['id'];
		$this->SeoMetaTags->SeoMetaTag->expects($this->once())
			->method('exists')
			->will($this->returnValue(true));

		$this->testAction(
			"admin/seo/seo_meta_tags/view/$id",
			array('return' => 'vars')
		);
		$this->assertTrue(isset($this->vars['seoMetaTag']));
		$this->assertEquals($this->vars['model'], 'SeoMetaTag');
	}

/**
 * testAdminViewInvalidId method
 *
 * @return void
 */
	public function testAdminViewInvalidId() {
		$id = 'Invalid';
		$this->SeoMetaTags->SeoMetaTag->expects($this->once())
			->method('exists')
			->will($this->returnValue(false));
		$this->setExpectedException('NotFoundException');
		$this->testAction(
			"admin/seo/seo_meta_tags/view/$id",
			array('return' => 'vars')
		);
	}
/**
 * testAdminAdd method
 *
 * @return void
 */
	public function testAdminAdd() {
		$this->SeoMetaTags->Session->expects($this->once())
			->method('setFlash')
			->with(__('The seo meta tag has been saved'), 'default');
		$this->SeoMetaTags->SeoMetaTag->expects($this->once())
			->method('create');
		$this->SeoMetaTags->SeoMetaTag->expects($this->once())
			->method('save')
			->will($this->returnValue(true));
		unset($this->testData['id']);
		$this->testAction(
			'admin/seo/seo_meta_tags/add',
			array (
				'data' => array ('SeoMetaTag' => $this->testData),
				'method' => 'post'
			)
		);
		$this->assertTrue(isset($this->vars['model']));
		$this->assertEquals($this->vars['model'], 'SeoMetaTag');
	}

/**
 * testAdminAddFail method
 *
 * @return void
 */
	public function testAdminAddFail() {
		$this->SeoMetaTags->Session->expects($this->once())
			->method('setFlash')
			->with(__('The seo meta tag could not be saved. Please, try again.'), 'default');
		$this->SeoMetaTags->SeoMetaTag->expects($this->once())
			->method('create');
		$this->SeoMetaTags->SeoMetaTag->expects($this->once())
			->method('save')
			->will($this->returnValue(false));
		unset($this->testData['id']);
		$this->testAction(
			'admin/seo/seo_meta_tags/add',
			array (
				'data' => array ('SeoMetaTag' => $this->testData),
				'method' => 'post',
				'return' => 'vars'
			)
		);
		$this->assertTrue(isset($this->vars['model']));
		$this->assertEquals($this->vars['model'], 'SeoMetaTag');
	}

/**
 * testAdminEditWithData method
 *
 * @return void
 */
	public function testAdminEditWithData() {
		$this->SeoMetaTags->Session->expects($this->once())
			->method('setFlash')
			->with(__('The seo meta tag has been saved'), 'default');
		$this->SeoMetaTags->SeoMetaTag->expects($this->once())
			->method('save')
			->will($this->returnValue(true));
		$this->testAction(
			'admin/seo/seo_meta_tags/edit',
			array (
				'data' => array ('SeoMetaTag' => $this->testData),
				'method' => 'post'
			)
		);
		$this->assertTrue(isset($this->vars['model']));
		$this->assertEquals($this->vars['model'], 'SeoMetaTag');
	}

/**
 * testAdminEditWithNoId method
 *
 * @return void
 */
	public function testAdminEditWithNoId() {
		$this->SeoMetaTags->Session->expects($this->once())
			->method('setFlash')
			->with(__('Invalid seo meta tag'), 'default');
		$this->testAction(
			'admin/seo/seo_meta_tags/edit',
			array (
				'method' => 'get'
			)
		);
		$this->assertTrue(isset($this->vars['model']));
		$this->assertEquals($this->vars['model'], 'SeoMetaTag');
	}

/**
 * testAdminEditSaveFail method
 *
 * @return void
 */
	public function testAdminEditSaveFail() {
		$this->SeoMetaTags->Session->expects($this->once())
			->method('setFlash')
			->with(__('The seo meta tag could not be saved. Please, try again.'), 'default');
		$this->SeoMetaTags->SeoMetaTag->expects($this->once())
			->method('save')
			->will($this->returnValue(false));
		$this->testAction(
			'admin/seo/seo_meta_tags/edit',
			array (
				'data' => array ('SeoMetaTag' => $this->testData),
				'method' => 'post',
				'return' => 'vars'
			)
		);
		$this->assertTrue(isset($this->vars['model']));
		$this->assertEquals($this->vars['model'], 'SeoMetaTag');
	}

/**
 * testAdminDelete method
 *
 * @return void
 */
	public function testAdminDelete() {
		$id = $this->testData['id'];
		$this->SeoMetaTags->SeoMetaTag->expects($this->once())
			->method('exists')
			->will($this->returnValue(true));
		$this->SeoMetaTags->SeoMetaTag->expects($this->once())
			->method('delete')
			->will($this->returnValue(true));
		$this->SeoMetaTags->Session->expects($this->once())
			->method('setFlash')
			->with(__('The seo meta tag has been deleted.'), 'default');
		$this->testAction(
			"admin/seo/seo_meta_tags/delete/$id",
			array('return' => 'vars')
		);

		$this->assertStringEndsWith('/admin/seo/seo_meta_tags', $this->headers['Location']);
	}

/**
 * testAdminDeleteFails method
 *
 * @return void
 */
	public function testAdminDeleteFails() {
		$id = $this->testData['id'];
		$this->SeoMetaTags->SeoMetaTag->expects($this->once())
			->method('exists')
			->will($this->returnValue(true));
		$this->SeoMetaTags->SeoMetaTag->expects($this->once())
			->method('delete')
			->will($this->returnValue(false));
		$this->SeoMetaTags->Session->expects($this->once())
			->method('setFlash')
			->with(__('The seo meta tag could not be deleted. Please, try again.'), 'default');
		$this->testAction(
			"admin/seo/seo_meta_tags/delete/$id",
			array('return' => 'vars')
		);
		$this->assertStringEndsWith('/admin/seo/seo_meta_tags', $this->headers['Location']);
	}

/**
 * testAdminDeleteInvalidId method
 *
 * @return void
 */
	public function testAdminDeleteInvalidId() {
		$id = 'Invalid';
		$this->SeoMetaTags->SeoMetaTag->expects($this->once())
			->method('exists')
			->will($this->returnValue(false));
		$this->setExpectedException('NotFoundException');
		$this->testAction(
			"admin/seo/seo_meta_tags/delete/$id",
			array('return' => 'vars')
		);
		$this->assertStringEndsWith('/admin/seo/seo_meta_tags', $this->headers['Location']);
	}

}
