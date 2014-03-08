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

	public function testFindRedirectByRequest() {
		$this->SeoUrl->settings['active'] = true;
		$this->SeoUrl->settings['cost_add'] = 1;
		$this->SeoUrl->settings['cost_change'] = 1;
		$this->SeoUrl->settings['cost_delete'] = 1;
		$result1 = $this->SeoUrl->findRedirectByRequest("/puppies");
		$this->assertEquals($result1, array('redirect' => '/test', 'shortest' => 6));

		$result2 = $this->SeoUrl->findRedirectByRequest("/some_other_blah");
		$this->assertEquals($result2, array('redirect' => '/test', 'shortest' => 13));

		$result3 = $this->SeoUrl->findRedirectByRequest("/some_other");
		$this->assertEquals($result3, array('redirect' => '/test', 'shortest' => 8));
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
 * Test sitemap import
 */
	public function testImport() {
		$testMap = dirname(__FILE__) . DS . 'site-map.xml';
		$this->SeoUrl->settings['active'] = true;
		$result = $this->SeoUrl->import($testMap);
		$this->assertEquals('23', $result);
	}

	public function tearDown() {
		parent::tearDown();
		unset($this->SeoUrl);
		ClassRegistry::flush();
	}

}

