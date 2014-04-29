<?php
App::uses('SeoUrisController', 'Seo.Controller');


/**
 * SeoUrisController Test Case
 *
 */
class SeoUrisControllerTest extends ControllerTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
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
			'SeoUri' => array(
				'id' => '535da751-0100-409c-9adb-1173173cdfff',
				'uri' => '/',
				'is_approved' => 1,
				'created' => '2014-04-27 18:56:49',
				'modified' => '2014-04-27 19:37:52',
			),
			'SeoMetaTag' => array(),
			'SeoTitle' => array()
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
	}

/**
 * testAdminAdd method
 *
 * @return void
 */
	public function testAdminAdd() {
		$SeoUris = $this->generate(
			'Seo.SeoUris', array (
				'methods' => array ('__clearAssociatesIfEmpty'),
				'models' => array ('Seo.SeoUri' => array ('save', 'create')),
				'components' => array ('Session', 'Security')
			)
		);
		$SeoUris->Session->expects($this->once())
			->method('setFlash')
			->with(__('The seo uri has been saved'), 'default');
		$SeoUris->expects($this->once())
			->method('__clearAssociatesIfEmpty');
		$SeoUris->SeoUri->expects($this->any())
			->method('create');
		$SeoUris->SeoUri->expects($this->once())
			->method('save')
			->will($this->returnValue(true));
		unset($this->testData['id']);
		$this->testAction(
			'admin/seo/seo_uris/add',
			array (
				'data' => array ($this->testData),
				'method' => 'post'
			)
		);
		debug($this);
		$this->assertTrue(isset($this->vars['model']));
		$this->assertEquals($this->vars['model'], 'SeoUri');
	}

/**
 * testAdminAddFail method
 *
 * @return void
 */
	public function testAdminAddFail() {
		$SeoUris = $this->generate(
			'Seo.SeoUris', array (
				'methods' => array ('__clearAssociatesIfEmpty'),
				'models' => array ('Seo.SeoUri' => array ('save', 'create')),
				'components' => array ('Session', 'Security')
			)
		);
		$SeoUris->Session->expects($this->once())
			->method('setFlash')
			->with(__('The seo uri could not be saved. Please, try again.'), 'default');
		$SeoUris->expects($this->once())
			->method('__clearAssociatesIfEmpty')

			->with($this->equalTo('something'));
		$SeoUris->SeoUri->expects($this->any())
			->method('create');
		$SeoUris->SeoUri->expects($this->once())
			->method('save')
			->will($this->returnValue(false)); //success
		unset($this->testData['id']);
		$result = $this->testAction(
			'admin/seo/seo_uris/add',
			array (
				'data' => array ($this->testData),
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
		$SeoUris = $this->generate(
			'Seo.SeoUris', array (
				'models' => array ('Seo.SeoUri' => array ('save', 'create')),
				'components' => array ('Session', 'Security')
			)
		);
		$SeoUris->Session->expects($this->once())
			->method('setFlash')
			->with(__('The seo uri has been saved'), 'default');
		$SeoUris->SeoUri->expects($this->once())
			->method('save')
			->will($this->returnValue(true));
		$this->testAction(
			'admin/seo/seo_uris/edit',
			array (
				'data' => array ($this->testData),
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
		$SeoUris = $this->generate(
			'Seo.SeoUris', array (
				'models' => array ('Seo.SeoUri' => array ('save', 'create')),
				'components' => array ('Session', 'Security')
			)
		);
		$SeoUris->Session->expects($this->once())
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
		$SeoUris = $this->generate(
			'Seo.SeoUris', array (
				'models' => array ('Seo.SeoUri' => array ('save', 'create')),
				'components' => array ('Session', 'Security')
			)
		);
		$SeoUris->Session->expects($this->once())
			->method('setFlash')
			->with(__('The seo uri could not be saved. Please, try again.'), 'default');
		$SeoUris->SeoUri->expects($this->once())
			->method('save')
			->will($this->returnValue(false)); //success
		$result = $this->testAction(
			'admin/seo/seo_uris/edit',
			array (
				'data' => array ('SeoUri' => $this->testData),
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
	}

/**
 * testAdminApprove method
 *
 * @return void
 */
	public function testAdminApprove() {
	}

}
