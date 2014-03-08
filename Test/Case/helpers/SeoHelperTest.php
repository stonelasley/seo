<?php
App::import('Helper', 'Html');
App::import('Model', 'Seo.SeoMetaTag');
App::import('Model', 'Seo.SeoCanonical');
//App::uses('Html', 'app.View/Helper');
App::uses('Controller', 'Controller');
App::uses('View', 'View');
App::uses('SeoHelper', 'Seo.View/Helper');

class SeoHelperTest extends CakeTestCase {

	public $fixtures = array(
		'plugin.seo.seo_meta_tag',
		'plugin.seo.seo_redirect',
		'plugin.seo.seo_uri',
		'plugin.seo.seo_title',
		'plugin.seo.seo_canonical',
		'plugin.seo.seo_a_b_test',
	);

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

	public function testGetABTestJS() {
		$result = $this->Seo->getABTestJS(array('SeoABTest' => array('slug' => 'test') ));
		$this->assertEquals('_gaq.push([\'_setCustompublic\',4,\'ABTest\',\'test\',3]);', $result);
	}

	public function testCanonical() {
		$result = $this->Seo->canonical('/example-url');
		$this->assertEquals('<link rel="canonical" href="http://localhost/example-url">', $result);

		$result = $this->Seo->canonical();
		$this->assertEquals('', $result);

		$_SERVER['REQUEST_URI'] = '/dogs';
		$result = $this->Seo->canonical();
		$this->assertEquals('<link rel="canonical" href="http://localhost/puppies">', $result);
	}

	public function testHoneyPot() {
		$result = $this->Seo->honeyPot();
		$this->assertTrue(!empty($result));
	}

	public function testMetaTags() {
		$_SERVER['REQUEST_URI'] = '/dogs';
		$result = $this->Seo->metaTags();
		$this->assertEquals('<meta http-equiv="description" content="MICKEY AND WESLEY ARE TERRIBLE" /><meta http-equiv="charset" content="UTF-8" /><meta name="cache-control" content="NO-CACHE" />', $result);

		$result = $this->Seo->metaTags(array('keywords' => 'ignore me'));
		$this->assertEquals('<meta http-equiv="description" content="MICKEY AND WESLEY ARE TERRIBLE" /><meta http-equiv="charset" content="UTF-8" /><meta name="cache-control" content="NO-CACHE" /><meta name="keywords" content="ignore me" />', $result);

		$result = $this->Seo->metaTags(array('no_ignore' => 'showme'));
		$this->assertEquals('<meta http-equiv="description" content="MICKEY AND WESLEY ARE TERRIBLE" /><meta http-equiv="charset" content="UTF-8" /><meta name="cache-control" content="NO-CACHE" /><meta name="no_ignore" content="showme" />', $result);
	}

	public function testMetaTagsWithHttpEquiv() {
		$_SERVER['REQUEST_URI'] = '/index';
		$result = $this->Seo->metaTags();
		$this->assertEquals('<meta http-equiv="Copyright" content="&amp;copy; 20014 Stone Lasley" />', $result);
	}

	public function testMetaTagsWithOutAny() {
		$_SERVER['REQUEST_URI'] = '/uri_has_no_meta';
		$result = $this->Seo->metaTags();
		$this->assertEquals('', $result);
	}

	public function testMetaTagsWithRegEx() {
		$_SERVER['REQUEST_URI'] = '/posts';
		$result = $this->Seo->metaTags();
		//$this->assertEquals('<meta name="default" content="content_default" /><meta name="description_default" content="content_default_2" />', $result);
	}

	public function testmetaTagsTagsDirectMatchShouldOverwrite() {
		$_SERVER['REQUEST_URI'] = '/doggies';
		$result = $this->Seo->metaTags();
		//$this->assertEquals('<meta name="direct_match" content="direct_match_content" />', $result);
	}

	public function testmetaTagsWithWildCard() {
		$_SERVER['REQUEST_URI'] = '/uri_for_meta_wild_card/wild_card';
		$result = $this->Seo->metaTags();
		//$this->assertEquals('<meta name="wild_card_match" content="wild_card_match_content" />', $result);
	}

	public function testTitleForUri() {
		$_SERVER['REQUEST_URI'] = '/doggies';
		$result = $this->Seo->title();
		$this->assertEquals('<title></title>', $result);
	}

	public function testTitleForUriWithDefault() {
		$_SERVER['REQUEST_URI'] = '/blahNotDefined';
		$results = $this->Seo->title('default');
		$this->assertEquals('<title>default</title>', $results);
	}

	public function tearDown() {
		parent::tearDown();
		unset($this->SeometaTagsTag);
		ClassRegistry::flush();
	}

}