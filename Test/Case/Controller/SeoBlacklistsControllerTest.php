<?php
App::uses('SeoBlacklistsController', 'Seo.Controller');

/**
 * SeoBlacklistsController Test Case
 *
 */
class SeoBlacklistsControllerTest extends ControllerTestCase {

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
		'plugin.seo.seo_blacklist'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->mockController = $this->generate(
			'Seo.SeoBlacklists', array (
				'models' => array ('Seo.SeoBlacklist' => array ('save', 'create', 'exists', 'delete')),
				'components' => array ('Session', 'Security')
			)
		);
		$this->testData = array (
			'id' => '535f0ae0-29a4-4034-b44e-0bd0173cdfff',
			'ip_range_start' => '174325761',
			'ip_range_end' => '174325762',
			'note' => 'blacklist one',
			'created' => '2014-04-28 20:13:52',
			'modified' => '2014-04-28 20:13:52',
			'is_active' => 1
		);
	}
/**
 * testBanned method
 *
 * @return void
 */
	public function testBanned() {
	}

/**
 * testAdminView method
 *
 * @return void
 */
	public function testAdminView() {
		$id = $this->testData['id'];
		$this->mockController->SeoBlacklist->expects($this->once())
			->method('exists')
			->will($this->returnValue(true));

		$this->testAction(
			"admin/seo/seo_blacklists/view/$id",
			array('return' => 'vars')
		);
		$this->assertTrue(isset($this->vars['seoBlacklist']));
		$this->assertEquals($this->vars['model'], 'SeoBlacklist');
	}

/**
 * testAdminView method
 *
 * @return void
 */
	public function testAdminViewInvalidId() {
		$id = 'Invalid';
		$this->mockController->SeoBlacklist->expects($this->once())
			->method('exists')
			->will($this->returnValue(false));
		$this->setExpectedException('NotFoundException');
		$this->testAction(
			"admin/seo/seo_blacklists/view/$id",
			array('return' => 'vars')
		);
	}

/**
 * testAdminAdd method
 *
 * @return void
 */
	public function testAdminAdd() {

		$this->mockController->Session->expects($this->once())
			->method('setFlash')
			->with(__('The seo blacklist has been saved'), 'default');
		$this->mockController->SeoBlacklist->expects($this->once())
			->method('create');
		$this->mockController->SeoBlacklist->expects($this->once())
			->method('save')
			->will($this->returnValue(true));
		unset($this->testData['id']);
		$this->testAction(
			'admin/seo/seo_blacklists/add',
			array (
				'data' => array ('SeoBlacklist' => $this->testData),
				'method' => 'post'
			)
		);
		$this->assertTrue(isset($this->vars));
		$this->assertEquals($this->vars['model'], 'SeoBlacklist');
	}

/**
 * testAdminAddFail method
 *
 * @return void
 */
	public function testAdminAddFail() {
		$this->mockController->Session->expects($this->once())
			->method('setFlash')
			->with(__('The seo blacklist could not be saved. Please, try again.'), 'default');
		$this->mockController->SeoBlacklist->expects($this->once())
			->method('create');
		$this->mockController->SeoBlacklist->expects($this->once())
			->method('save')
			->will($this->returnValue(false));
		unset($this->testData['id']);
		$this->testAction(
			'admin/seo/seo_blacklists/add',
			array (
				'data' => array ('SeoBlacklist' => $this->testData),
				'method' => 'post',
				'return' => 'vars'
			)
		);
		$this->assertTrue(isset($this->vars));
		$this->assertEquals($this->vars['model'], 'SeoBlacklist');
	}

/**
 * testAdminEditWithData method
 *
 * @return void
 */
	public function testAdminEditWithData() {
		$this->mockController->Session->expects($this->once())
			->method('setFlash')
			->with(__('The seo blacklist has been saved'), 'default');
		$this->mockController->SeoBlacklist->expects($this->once())
			->method('save')
			->will($this->returnValue(true));
		$this->testAction(
			'admin/seo/seo_blacklists/edit',
			array (
				'data' => array ('SeoBlacklist' => $this->testData),
				'method' => 'post'
			)
		);
		$this->assertTrue(isset($this->vars));
		$this->assertEquals($this->vars['model'], 'SeoBlacklist');
	}

/**
 * testAdminEditWithNoId method
 *
 * @return void
 */
	public function testAdminEditWithNoId() {
		$this->mockController->Session->expects($this->once())
			->method('setFlash')
			->with(__('Invalid seo blacklist'), 'default');
		$this->testAction(
			'admin/seo/seo_blacklists/edit',
			array (
				'method' => 'get'
			)
		);
		$this->assertTrue(isset($this->vars));
		$this->assertEquals($this->vars['model'], 'SeoBlacklist');
	}

/**
 * testAdminDelete method
 *
 * @return void
 */
	public function testAdminDelete() {
		$id = $this->testData['id'];
		$this->mockController->SeoBlacklist->expects($this->once())
			->method('exists')
			->will($this->returnValue(true));
		$this->mockController->SeoBlacklist->expects($this->once())
			->method('delete')
			->will($this->returnValue(true));
		$this->mockController->Session->expects($this->once())
			->method('setFlash')
			->with(__('The seo blacklist has been deleted.'), 'default');
		$this->testAction(
			"admin/seo/seo_blacklists/delete/$id",
			array('return' => 'vars')
		);

		$this->assertStringEndsWith('/admin/seo/seo_blacklists', $this->headers['Location']);
	}

/**
 * testAdminDelete methodSeo blacklist was not deleted
 *
 * @return void
 */
	public function testAdminDeleteInvalidId() {
		$id = 'Invalid';
		$this->mockController->SeoBlacklist->expects($this->once())
			->method('exists')
			->will($this->returnValue(false));
		$this->setExpectedException('NotFoundException');
		$this->testAction(
			"admin/seo/seo_blacklists/delete/$id",
			array('return' => 'vars')
		);
	}

}
