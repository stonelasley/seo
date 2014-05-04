<?php
App::import('Helper', 'Html');
App::import('Model', 'Seo.SeoMetaTag');
App::import('Model', 'Seo.SeoCanonical');
App::uses('Controller', 'Controller');
App::uses('View', 'View');
App::uses('SeoHelper', 'Seo.View/Helper');

class SeoHelperTest extends CakeTestCase {

/**
 * fixtures
 */
	public $fixtures = array(
		'plugin.seo.seo_meta_tag',
		'plugin.seo.seo_redirect',
		'plugin.seo.seo_uri',
		'plugin.seo.seo_title',
		'plugin.seo.seo_canonical',
		'plugin.seo.seo_a_b_test',
	);

/**
 * setup
 */
	public function setUp() {
		parent::setUp();
		$Controller = new Controller();
		$View = new View($Controller);
		$this->Seo = new SeoHelper($View);
		$this->Seo->Html = new HtmlHelper($View);
		$cacheEngine = SeoUtil::getConfig('cacheEngine');
		if (!empty($cacheEngine)) {
			Cache::clear($cacheEngine);
		}
	}

/**
 * testGetABTestJS
 */
	public function testGetABTestJS() {
		$result = $this->Seo->getABTestJS(array('SeoABTest' => array('slug' => 'home') ));
		$this->assertEquals('_gaq.push([\'_setCustompublic\',4,\'ABTest\',\'home\',3]);', $result);
	}

/**
 * testCanonicalWithEmpty test rendering of canonical link
 */
	public function testCanonical() {
		$path = 'http://localhost/';
		$result = $this->Seo->canonical($path);
		$this->assertEquals('<link rel="canonical" href="http://localhost/">', $result);
	}

/**
 * testCanonicalWithEmpty test rendering of canonical link with no variable
 */
	public function testCanonicalWithEmpty() {
		$result = $this->Seo->canonical();
		$this->assertTrue(empty($result));
	}

/**
 * testHoneyPot
 */
	public function testHoneyPot() {
		$result = $this->Seo->honeyPot();
		$this->assertTrue(!empty($result));
	}

/**
 * testMetaTags test rendering of meta tags
 */
	public function testMetaTags() {
		$tags = array(
			0 => array(
				'name' => 'description',
				'content' => 'about page description content'
			),
			1 => array(
				'name' => 'keywords',
				'content' => 'about page keywords content'
			),
			2 => array(
				'name' => 'robots',
				'content' => 'about page robots content'
			)
		);
		$result = $this->Seo->metaTags($tags);
		$this->assertEquals('<meta name="description" content="about page description content" /><meta name="keywords" content="about page keywords content" /><meta name="robots" content="about page robots content" />', $result);
	}

/**
 * testMetaTags test rendering of meta tags with http-equiv
 */
	public function testMetaTagsWithHttpEquiv() {
		$tags = array(
			0 => array(
				'http-equiv' => 'description',
				'content' => 'home page description content'
			),
			1 => array(
				'http-equiv' => 'keywords',
				'content' => 'home page keywords content'
			),
			2 => array(
				'http-equiv' => 'robots',
				'content' => 'home page robots content'
			)
		);
		$result = $this->Seo->metaTags($tags);
		$this->assertEquals('<meta http-equiv="description" content="home page description content" /><meta http-equiv="keywords" content="home page keywords content" /><meta http-equiv="robots" content="home page robots content" />', $result);
	}

/**
 * testMetaTags test rendering of meta tags with no variable
 */
	public function testMetaTagsWithEmpty() {
		$result = $this->Seo->metaTags();
		$this->assertEquals('', $result);
	}

/**
 * testTitleWithEmpty test rendering of title with no variable
 */
	public function testTitleWithEmpty() {
		$result = $this->Seo->title();
		$this->assertEquals('<title></title>', $result);
	}

/**
 * testTitleWithEmpty test rendering of title with value
 */
	public function testTitleWithDefault() {
		$results = $this->Seo->title('default');
		$this->assertEquals('<title>default</title>', $results);
	}

/**
 * tear down test
 */
	public function tearDown() {
		parent::tearDown();
		unset($this->SeometaTagsTag);
		ClassRegistry::flush();
	}

}