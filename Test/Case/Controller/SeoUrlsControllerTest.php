<?php
App::uses('SeoUrlsController', 'Seo.Controller');

/**
 * SeoUrlsController Test Case
 *
 */
class SeoUrlsControllerTestCase extends ControllerTestCase {

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
		'plugin.seo.seo_url'
	);

/**
 * SeoUrls Controller Instance
 *
 * @return void
 */
	public $SeoUrls = null;

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
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
		$SeoUrls = $this->generate(
			'Seo.SeoUrls', array (
				'models' => array ('Seo.SeoUrl' => array ('save', 'create')),
				'components' => array ('Session', 'Security')
			)
		);
		$SeoUrls->Session->expects($this->once())
			->method('setFlash')
			->with(__('The seo url has been saved'), 'default');
		$SeoUrls->SeoUrl->expects($this->once())
			->method('create');
		$SeoUrls->SeoUrl->expects($this->once())
			->method('save')
			->will($this->returnValue(true)); //success
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
		$SeoUrls = $this->generate(
			'Seo.SeoUrls', array (
				'models' => array ('Seo.SeoUrl' => array ('save', 'create')),
				'components' => array ('Session', 'Security')
			)
		);
		$SeoUrls->Session->expects($this->once())
			->method('setFlash')
			->with(__('The seo url could not be saved. Please, try again.'), 'default');
		$SeoUrls->SeoUrl->expects($this->once())
			->method('create');
		$SeoUrls->SeoUrl->expects($this->once())
			->method('save')
			->will($this->returnValue(false));
		unset($this->testData['id']);
		$result = $this->testAction(
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
		$SeoUrls = $this->generate(
			'Seo.SeoUrls', array (
				'models' => array ('Seo.SeoUrl' => array ('save', 'create')),
				'components' => array ('Session', 'Security')
			)
		);
		$SeoUrls->Session->expects($this->once())
			->method('setFlash')
			->with(__('The seo url has been saved'), 'default');
		$SeoUrls->SeoUrl->expects($this->once())
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
		$SeoUrls = $this->generate(
			'Seo.SeoUrls', array (
				'models' => array ('Seo.SeoUrl' => array ('save', 'create')),
				'components' => array ('Session', 'Security')
			)
		);
		$SeoUrls->Session->expects($this->once())
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
		$SeoUrls = $this->generate(
			'Seo.SeoUrls', array (
				'models' => array ('Seo.SeoUrl' => array ('save', 'create')),
				'components' => array ('Session', 'Security')
			)
		);
		$SeoUrls->Session->expects($this->once())
			->method('setFlash')
			->with(__('The seo url could not be saved. Please, try again.'), 'default');
		$SeoUrls->SeoUrl->expects($this->once())
			->method('save')
			->will($this->returnValue(false)); //success
		$result = $this->testAction(
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
	}

/**
 * testAdminApprove method
 *
 * @return void
 */
	public function testAdminApprove() {
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
