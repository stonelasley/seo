<?php
App::uses('SeoBlacklistsController', 'Seo.Controller');

/**
 * SeoBlacklistsController Test Case
 *
 */
class SeoBlacklistsControllerTest extends ControllerTestCase {

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
		$this->testData = array (
			'id' => '535dda88-f5bc-4942-b9b2-1174173cdfff',
			'ip_range_start' => '10.100.0.1',
			'ip_range_end' => '10.100.0.2',
			'note' => 50,
			'is_active' => true
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
		$SeoBlacklists = $this->generate(
			'Seo.SeoBlacklists', array (
				'models' => array ('Seo.SeoBlacklist' => array ('save', 'create')),
				'components' => array ('Session', 'Security')
			)
		);
		$SeoBlacklists->Session->expects($this->once())
			->method('setFlash')
			->with(__('The seo blacklist has been saved'), 'default');
		$SeoBlacklists->SeoBlacklist->expects($this->once())
			->method('create');
		$SeoBlacklists->SeoBlacklist->expects($this->once())
			->method('save')
			->will($this->returnValue(true)); //success
		unset($this->testData['id']);
		$this->testAction(
			'admin/seo/seo_a_b_tests/add',
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
		$SeoBlacklists = $this->generate(
			'Seo.SeoBlacklists', array (
				'models' => array ('Seo.SeoBlacklist' => array ('save', 'create')),
				'components' => array ('Session', 'Security')
			)
		);
		$SeoBlacklists->Session->expects($this->once())
			->method('setFlash')
			->with(__('The seo blacklist could not be saved. Please, try again.'), 'default');
		$SeoBlacklists->SeoBlacklist->expects($this->once())
			->method('create');
		$SeoBlacklists->SeoBlacklist->expects($this->once())
			->method('save')
			->will($this->returnValue(false)); //success
		unset($this->testData['id']);
		$result = $this->testAction(
			'admin/seo/seo_a_b_tests/add',
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
		$SeoBlacklists = $this->generate(
			'Seo.SeoBlacklists', array (
				'models' => array ('Seo.SeoBlacklist' => array ('save', 'create')),
				'components' => array ('Session', 'Security')
			)
		);
		$SeoBlacklists->Session->expects($this->once())
			->method('setFlash')
			->with(__('The seo blacklist has been saved'), 'default');
		$SeoBlacklists->SeoBlacklist->expects($this->once())
			->method('save')
			->will($this->returnValue(true)); //success
		$this->testAction(
			'admin/seo/seo_a_b_tests/edit',
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
		$SeoBlacklists = $this->generate(
			'Seo.SeoBlacklists', array (
				'models' => array ('Seo.SeoBlacklist' => array ('save', 'create')),
				'components' => array ('Session', 'Security')
			)
		);
		$SeoBlacklists->Session->expects($this->once())
			->method('setFlash')
			->with(__('Invalid seo blacklist'), 'default');
		$this->testAction(
			'admin/seo/seo_a_b_tests/edit',
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
	}

}
