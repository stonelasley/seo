<?php
/* SeoUrl Test cases generated on: 2011-10-10 16:42:55 : 1318286575*/
App::import('Model', 'Seo.SeoUrl');

class SeoUrlTest extends CakeTestCase {

	public $fixtures = array(
		'plugin.seo.seo_url'
	);

	public function setUp() {
		parent::setUp();
		$this->SeoUrl = ClassRegistry::init('SeoUrl');
	}

/**
 * test findRedirectByRequest method
 */
	public function testFindRedirectByRequest() {
		$this->SeoUrl->settings['active'] = true;
		$this->SeoUrl->settings['cost_add'] = 1;
		$this->SeoUrl->settings['cost_change'] = 1;
		$this->SeoUrl->settings['cost_delete'] = 1;

		$result = $this->SeoUrl->findRedirectByRequest("/products_url");

		$this->assertEquals($result, array('redirect' => '/products', 'shortest' => 4));

		$result = $this->SeoUrl->findRedirectByRequest("/invalid_categories");

		$this->assertEquals($result, array('redirect' => '/categories', 'shortest' => 8));

		$result = $this->SeoUrl->findRedirectByRequest("/recipes_with_some_other");

		$this->assertEquals($result, array('redirect' => '/recipes', 'shortest' => 16));
	}

/**
 * test findRedirectByRequest method with higher cost
 */
	public function testFindRedirectByRequestWithHigherCost() {
		$this->SeoUrl->settings['active'] = true;
		$this->SeoUrl->settings['cost_add'] = 1;
		$this->SeoUrl->settings['cost_change'] = 2;
		$this->SeoUrl->settings['cost_delete'] = 3;

		$result = $this->SeoUrl->findRedirectByRequest("/");

		$this->assertEquals(
			array(
				'redirect' => '/recipes',
				'shortest' => 7
			),
			$result
		);
	}

/**
 * test findRedirectByRequest method with inactive
 */
	public function testFindRedirectByRequestWithInactive() {
		$this->SeoUrl->settings['active'] = false;

		$result = $this->SeoUrl->findRedirectByRequest("/");

		$this->assertFalse($result);
	}

/**
 * test findRedirectByRequest method
 */
	public function testFindRedirectByRequestWithNoMatches() {
		$this->SeoUrl = $this->getMockForModel('SeoUrl', array('find', 'import'));
		$this->SeoUrl->settings['active'] = true;
		$this->SeoUrl->expects($this->once())
			->method('find')
			->will($this->returnValue(0));
		$this->SeoUrl->expects($this->once())
			->method('import')
			->will($this->returnValue(0));

		$result = $this->SeoUrl->findRedirectByRequest("/");

		$this->assertEquals(
			array(
				'redirect' => '/',
				'shortest' => -1
			),
			$result
		);
	}

	public function testLevenshtien() {
		$request = "/content/Hearing-loss/Treatment";
		$add = 1;
		$change = 2;
		$delete = 3;

		$lev1 = levenshtein($request, "/content/Hearing-loss/Treatments", $add, $change, $delete);
		$this->assertEquals(1, $lev1);

		$lev2 = levenshtein($request, "/content/articles/Hearing-loss/Protection/30207-Attention-couch-potatoes-time", $add, $change, $delete);
		$this->assertEquals(52, $lev2);
	}

/**
 * Test missing sitemap
 *
 * @expectedException NotFoundException
 *
 */
	public function testMissingSitemapImport() {
		$this->SeoUrl->settings['active'] = true;

		$result = $this->SeoUrl->import('invalid-map.xml');

		$this->assertEquals('269', $result);
	}

/**
 * Test import method
 */
	public function testImport() {
		$testMap = dirname(__FILE__) . DS . 'site-map.xml';
		$this->SeoUrl->settings['active'] = true;

		$result = $this->SeoUrl->import($testMap);

		$this->assertEquals('23', $result);
	}

/**
 * Test import method with verbose
 */
	public function testImportWithVerbose() {
		$testMap = dirname(__FILE__) . DS . 'site-map.xml';
		$this->SeoUrl->settings['active'] = true;

		$result = $this->SeoUrl->import($testMap, false, true);

		$this->assertEquals('23', $result);
	}

/**
 * Test import method with verbose failed save
 */
	public function testImportWithVerboseFailedSave() {
		$this->SeoUrl = $this->getMockForModel('SeoUrl', array('create', 'save'));
		$this->SeoUrl->settings['active'] = true;
		$this->SeoUrl->expects($this->atLeastOnce())
			->method('create')
			->will($this->returnValue(true));
		$this->SeoUrl->expects($this->atLeastOnce())
			->method('save')
			->will($this->returnValue(false));
		$testMap = dirname(__FILE__) . DS . 'site-map.xml';

		$result = $this->SeoUrl->import($testMap, false, true);
		$this->assertEquals(0, $result);
	}

/**
 * Test getPathToSiteMap method
 */
	public function testGetPathToSiteMap() {
		$method = new ReflectionMethod('SeoUrl', '__getPathToSiteMap');
		$method->setAccessible(true);

		$result = $method->invoke($this->SeoUrl);

		$this->assertStringEndsWith('webroot/site-map.xml', $result);
	}

	public function tearDown() {
		parent::tearDown();
		unset($this->SeoUrl);
		ClassRegistry::flush();
	}

}

