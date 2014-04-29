<?php
App::uses('SeoMetaTagsController', 'Seo.Controller');

/**
 * SeoMetaTagsController Test Case
 *
 */
class SeoMetaTagsControllerTest extends ControllerTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'plugin.seo.seo_meta_tag',
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
		$SeoMetaTags = $this->generate(
			'Seo.SeoMetaTags', array (
				'models' => array ('Seo.SeoMetaTag' => array ('save', 'create')),
				'components' => array ('Session', 'Security')
			)
		);
		$SeoMetaTags->Session->expects($this->once())
			->method('setFlash')
			->with(__('The seo meta tag has been saved'), 'default');
		$SeoMetaTags->SeoMetaTag->expects($this->once())
			->method('create');
		$SeoMetaTags->SeoMetaTag->expects($this->once())
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
		$SeoMetaTags = $this->generate(
			'Seo.SeoMetaTags', array (
				'models' => array ('Seo.SeoMetaTag' => array ('save', 'create')),
				'components' => array ('Session', 'Security')
			)
		);
		$SeoMetaTags->Session->expects($this->once())
			->method('setFlash')
			->with(__('The seo meta tag could not be saved. Please, try again.'), 'default');
		$SeoMetaTags->SeoMetaTag->expects($this->once())
			->method('create');
		$SeoMetaTags->SeoMetaTag->expects($this->once())
			->method('save')
			->will($this->returnValue(false));
		unset($this->testData['id']);
		$result = $this->testAction(
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
		$SeoMetaTags = $this->generate(
			'Seo.SeoMetaTags', array (
				'models' => array ('Seo.SeoMetaTag' => array ('save', 'create')),
				'components' => array ('Session', 'Security')
			)
		);
		$SeoMetaTags->Session->expects($this->once())
			->method('setFlash')
			->with(__('The seo meta tag has been saved'), 'default');
		$SeoMetaTags->SeoMetaTag->expects($this->once())
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
		$SeoMetaTags = $this->generate(
			'Seo.SeoMetaTags', array (
				'models' => array ('Seo.SeoMetaTag' => array ('save', 'create')),
				'components' => array ('Session', 'Security')
			)
		);
		$SeoMetaTags->Session->expects($this->once())
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
		$SeoMetaTags = $this->generate(
			'Seo.SeoMetaTags', array (
				'models' => array ('Seo.SeoMetaTag' => array ('save', 'create')),
				'components' => array ('Session', 'Security')
			)
		);
		$SeoMetaTags->Session->expects($this->once())
			->method('setFlash')
			->with(__('The seo meta tag could not be saved. Please, try again.'), 'default');
		$SeoMetaTags->SeoMetaTag->expects($this->once())
			->method('save')
			->will($this->returnValue(false));
		$result = $this->testAction(
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
	}

}
