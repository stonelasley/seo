<?php
/* SeoMetaTag Test cases generated on: 2011-01-03 10:01:23 : 1294074563*/
App::import('Model', 'Seo.SeoMetaTag');
App::import('Component', 'Email');

class SeoMetaTagTest extends CakeTestCase {

	public $fixtures = array(
		'plugin.seo.seo_meta_tag',
		'plugin.seo.seo_redirect',
		'plugin.seo.seo_uri',
		'plugin.seo.seo_title',
		'plugin.seo.seo_status_code',
		'plugin.seo.seo_canonical',
	);

	public function setUp() {
		parent::setUp();
		$this->SeoMetaTag = ClassRegistry::init('SeoMetaTag');
		$this->SeoMetaTag->SeoUri->Email
		= $this->getMock('EmailComponent', array('renew'), array(), '', false);
	}

/**
 *
 *
 * @return void
 */
	public function testInstance() {
		$this->assertTrue(is_a($this->SeoMetaTag, 'SeoMetaTag'));
	}

	public function testFindAllTagsByUri() {
		$results = $this->SeoMetaTag->findAllTagsByUri('/');
		$this->assertEquals(3, count($results));
	}

	public function testFindAllTagsByUriRegEx() {
		$results = $this->SeoMetaTag->findAllTagsByUri('/uri_for_meta_reg_ex/regex');
		$this->assertEquals(0, count($results));
	}

	public function testFindAllTagsByUriWildCard() {
		$results = $this->SeoMetaTag->findAllTagsByUri('/uri_for_meta_wild_card/wild');
		$this->assertEquals(0, count($results));
	}

	public function testBeforeSaveShouldLinkToExistinUri() {
		$this->SeoMetaTag->data = array(
			'SeoMetaTag' => array(
				'name' => 'New',
				'content' => 'Content'
			),
			'SeoUri' => array(
				'uri' => '/uri_for_meta',
			)
		);

		$count = $this->SeoMetaTag->SeoUri->find('count');
		$this->assertNotEquals(false, $this->SeoMetaTag->save());
		$this->assertEquals($count, $this->SeoMetaTag->SeoUri->find('count'));
		$results = $this->SeoMetaTag->find('last');
		$this->assertEquals('New', $results['SeoMetaTag']['name']);
		$this->assertEquals('Content', $results['SeoMetaTag']['content']);
	}

	public function testBeforeSaveShouldLinkToCreatUri() {
		$this->SeoMetaTag->data = array(
			'SeoMetaTag' => array(
				'name' => 'New',
				'content' => 'Content'
			),
			'SeoUri' => array(
				'uri' => '/new_uri',
			)
		);

		$count = $this->SeoMetaTag->SeoUri->find('count');
		$this->assertNotEquals(false, $this->SeoMetaTag->save());
		$this->assertEquals($count, $this->SeoMetaTag->SeoUri->find('count'));
		$results = $this->SeoMetaTag->find('last');
		$this->assertEquals('New', $results['SeoMetaTag']['name']);
		$this->assertEquals('Content', $results['SeoMetaTag']['content']);
	}

	public function tearDown() {
		parent::tearDown();
		unset($this->SeoMetaTag);
		ClassRegistry::flush();
	}

}

