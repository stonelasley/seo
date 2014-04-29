<?php
App::uses('SeoCanonicalsController', 'Seo.Controller');

/**
 * SeoCanonicalsController Test Case
 *
 */
class SeoCanonicalsControllerTest extends ControllerTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
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
		$this->testData = array (
			'id' => '535dac20-60b4-46de-b842-19b8173cdfff',
			'seo_uri_id' => '535da751-0100-409c-9adb-1173173cdfff',
			'canonical' => '/index',
			'is_active' => 1,
			'created' => '2014-04-27 19:17:20',
			'modified' => '2014-04-27 19:17:20'
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
		$SeoCanonicals = $this->generate(
			'Seo.SeoCanonicals', array (
				'models' => array ('Seo.SeoCanonical' => array ('save', 'create')),
				'components' => array ('Session', 'Security')
			)
		);
		$SeoCanonicals->Session->expects($this->once())
			->method('setFlash')
			->with(__('The seo canonical has been saved'), 'default');
		$SeoCanonicals->SeoCanonical->expects($this->once())
			->method('create');
		$SeoCanonicals->SeoCanonical->expects($this->once())
			->method('save')
			->will($this->returnValue(true)); //success
		unset($this->testData['id']);
		$this->testAction(
			'admin/seo/seo_canonicals/add',
			array (
				'data' => array ('SeoCanonical' => $this->testData),
				'method' => 'post'
			)
		);
		$this->assertTrue(isset($this->vars['model']));
		$this->assertEquals($this->vars['model'], 'SeoCanonical');
	}

/**
 * testAdminAddFail method
 *
 * @return void
 */
	public function testAdminAddFail() {
		$SeoCanonicals = $this->generate(
			'Seo.SeoCanonicals', array (
				'models' => array ('Seo.SeoCanonical' => array ('save', 'create')),
				'components' => array ('Session', 'Security')
			)
		);
		$SeoCanonicals->Session->expects($this->once())
			->method('setFlash')
			->with(__('The seo canonical could not be saved. Please, try again.'), 'default');
		$SeoCanonicals->SeoCanonical->expects($this->once())
			->method('create');
		$SeoCanonicals->SeoCanonical->expects($this->once())
			->method('save')
			->will($this->returnValue(false)); //success
		unset($this->testData['id']);
		$result = $this->testAction(
			'admin/seo/seo_canonicals/add',
			array (
				'data' => array ('SeoCanonical' => $this->testData),
				'method' => 'post',
				'return' => 'vars'
			)
		);
		$this->assertTrue(isset($this->vars['model']));
		$this->assertEquals($this->vars['model'], 'SeoCanonical');
	}

/**
 * testAdminEditWithData method
 *
 * @return void
 */
	public function testAdminEditWithData() {
		$SeoCanonicals = $this->generate(
			'Seo.SeoCanonicals', array (
				'models' => array ('Seo.SeoCanonical' => array ('save', 'create')),
				'components' => array ('Session', 'Security')
			)
		);
		$SeoCanonicals->Session->expects($this->once())
			->method('setFlash')
			->with(__('The seo canonical has been saved'), 'default');
		$SeoCanonicals->SeoCanonical->expects($this->once())
			->method('save')
			->will($this->returnValue(true));
		$this->testAction(
			'admin/seo/seo_canonicals/edit',
			array (
				'data' => array ('SeoCanonical' => $this->testData),
				'method' => 'post'
			)
		);
		$this->assertTrue(isset($this->vars['model']));
		$this->assertEquals($this->vars['model'], 'SeoCanonical');
	}

/**
 * testAdminEditWithNoId method
 *
 * @return void
 */
	public function testAdminEditWithNoId() {
		$SeoCanonicals = $this->generate(
			'Seo.SeoCanonicals', array (
				'models' => array ('Seo.SeoCanonical' => array ('save', 'create')),
				'components' => array ('Session', 'Security')
			)
		);
		$SeoCanonicals->Session->expects($this->once())
			->method('setFlash')
			->with(__('Invalid seo canonical'), 'default');
		$this->testAction(
			'admin/seo/seo_canonicals/edit',
			array (
				'method' => 'get'
			)
		);
		$this->assertTrue(isset($this->vars['model']));
		$this->assertEquals($this->vars['model'], 'SeoCanonical');
	}

/**
 * testAdminEditSaveFail method
 *
 * @return void
 */
	public function testAdminEditSaveFail() {
		$SeoCanonicals = $this->generate(
			'Seo.SeoCanonicals', array (
				'models' => array ('Seo.SeoCanonical' => array ('save', 'create')),
				'components' => array ('Session', 'Security')
			)
		);
		$SeoCanonicals->Session->expects($this->once())
			->method('setFlash')
			->with(__('The seo canonical could not be saved. Please, try again.'), 'default');
		$SeoCanonicals->SeoCanonical->expects($this->once())
			->method('save')
			->will($this->returnValue(false)); //success
		$result = $this->testAction(
			'admin/seo/seo_canonicals/edit',
			array (
				'data' => array ('SeoCanonical' => $this->testData),
				'method' => 'post',
				'return' => 'vars'
			)
		);
		$this->assertTrue(isset($this->vars['model']));
		$this->assertEquals($this->vars['model'], 'SeoCanonical');
	}

/**
 * testAdminDelete method
 *
 * @return void
 */
	public function testAdminDelete() {
	}

}
