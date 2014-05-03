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
	public $SeoBlacklists;

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'plugin.seo.seo_title',
		'plugin.seo.seo_meta_tag',
		'plugin.seo.seo_canonical',
		'plugin.seo.seo_blacklist'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->SeoBlacklists = $this->generate(
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
		$this->testAction(
			"seo/seo_blacklists/banned",
			array(
				'return' => 'contents',
				'method' => 'GET'
			)
		);
		$this->assertContains('<h1>You are BANNED!</h1>', $this->contents);
	}

/**
 * testAdminIndex method
 *
 * @return void
 */
	public function testAdminIndex() {
		$this->testAction(
			"admin/seo/seo_blacklists",
			array(
				'return' => 'vars',
				'method' => 'GET'
			)
		);
		$this->assertTrue(isset($this->vars['seoBlacklists']));
	}

/**
 * testAdminView method
 *
 * @return void
 */
	public function testAdminView() {
		$id = $this->testData['id'];
		$this->SeoBlacklists->SeoBlacklist->expects($this->once())
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
		$this->SeoBlacklists->SeoBlacklist->expects($this->once())
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
		$this->SeoBlacklists->Session->expects($this->once())
			->method('setFlash')
			->with(__('The seo blacklist has been saved'), 'default');
		$this->SeoBlacklists->SeoBlacklist->expects($this->once())
			->method('create');
		$this->SeoBlacklists->SeoBlacklist->expects($this->once())
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
		$this->SeoBlacklists->Session->expects($this->once())
			->method('setFlash')
			->with(__('The seo blacklist could not be saved. Please, try again.'), 'default');
		$this->SeoBlacklists->SeoBlacklist->expects($this->once())
			->method('create');
		$this->SeoBlacklists->SeoBlacklist->expects($this->once())
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
		$this->SeoBlacklists->Session->expects($this->once())
			->method('setFlash')
			->with(__('The seo blacklist has been saved'), 'default');
		$this->SeoBlacklists->SeoBlacklist->expects($this->once())
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
		$this->SeoBlacklists->Session->expects($this->once())
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
 * testAdminEditFail method
 *
 * @return void
 */
	public function testAdminEditFail() {
		$this->SeoBlacklists->Session->expects($this->once())
			->method('setFlash')
			->with(__('The seo blacklist could not be saved. Please, try again.'), 'default');
		$this->SeoBlacklists->SeoBlacklist->expects($this->once())
			->method('save')
			->will($this->returnValue(false));
		unset($this->testData['id']);
		$this->testAction(
			'admin/seo/seo_blacklists/edit',
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
 * testAdminDelete method
 *
 * @return void
 */
	public function testAdminDelete() {
		$id = $this->testData['id'];
		$this->SeoBlacklists->SeoBlacklist->expects($this->once())
			->method('exists')
			->will($this->returnValue(true));
		$this->SeoBlacklists->SeoBlacklist->expects($this->once())
			->method('delete')
			->will($this->returnValue(true));
		$this->SeoBlacklists->Session->expects($this->once())
			->method('setFlash')
			->with(__('The seo blacklist has been deleted.'), 'default');
		$this->testAction(
			"admin/seo/seo_blacklists/delete/$id",
			array('return' => 'vars')
		);

		$this->assertStringEndsWith('/admin/seo/seo_blacklists', $this->headers['Location']);
	}

/**
 * testAdminDeleteFails method
 *
 * @return void
 */
	public function testAdminDeleteFails() {
		$id = $this->testData['id'];
		$this->SeoBlacklists->SeoBlacklist->expects($this->once())
			->method('exists')
			->will($this->returnValue(true));
		$this->SeoBlacklists->SeoBlacklist->expects($this->once())
			->method('delete')
			->will($this->returnValue(false));
		$this->SeoBlacklists->Session->expects($this->once())
			->method('setFlash')
			->with(__('The seo blacklist could not be deleted. Please, try again.'), 'default');
		$this->testAction(
			"admin/seo/seo_blacklists/delete/$id",
			array('return' => 'vars')
		);
	}

/**
 * testAdminDelete method
 *
 * @return void
 */
	public function testAdminDeleteInvalidId() {
		$id = 'Invalid';
		$this->SeoBlacklists->SeoBlacklist->expects($this->once())
			->method('exists')
			->will($this->returnValue(false));
		$this->setExpectedException('NotFoundException');
		$this->testAction(
			"admin/seo/seo_blacklists/delete/$id",
			array('return' => 'vars')
		);
		$this->assertStringEndsWith('/admin/seo/seo_blacklists', $this->headers['Location']);
	}

}
