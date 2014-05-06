<?php
/* SeoUri Test cases generated on: 2011-01-03 10:01:08 : 1294074608*/
App::import('Model', 'Seo.SeoUri');
App::import('Component', 'Email');

class SeoUriTest extends CakeTestCase {

	public $fixtures = array(
		'plugin.seo.seo_a_b_test',
		'plugin.seo.seo_uri',
		'plugin.seo.seo_meta_tag',
		'plugin.seo.seo_redirect',
		'plugin.seo.seo_title',
		'plugin.seo.seo_status_code',
		'plugin.seo.seo_canonical',
	);

	public function setup() {
		$this->SeoUri = ClassRegistry::init('Seo.SeoUri');
		$this->SeoUri->Email
			= $this->getMock('EmailComponent', array('renew'), array(), '', false);
	}

/**
 *
 *
 * @return void
 */
	public function testInstance() {
		$this->assertTrue(is_a($this->SeoUri, 'SeoUri'));
	}

	public function testUrlEncode() {
		$uri = $this->SeoUri->findById('535da751-0100-409c-9adb-1173173cdfff');
		$this->assertEquals('/', $uri['SeoUri']['uri']);
		$this->SeoUri->urlEncode('535da751-0100-409c-9adb-1173173cdfff');
		$result = $this->SeoUri->findById('535da751-0100-409c-9adb-1173173cdfff');
		$this->assertEquals('/', $result['SeoUri']['uri']);

		$uri = $this->SeoUri->findById('535f0ce3-bc44-4327-2345-066d173cdfff');
		$this->assertEquals('/about us', $uri['SeoUri']['uri']);
		$this->SeoUri->urlEncode('535f0ce3-bc44-4327-2345-066d173cdfff');
		$result = $this->SeoUri->findById('535f0ce3-bc44-4327-2345-066d173cdfff');
		$this->assertEquals('/about%20us', $result['SeoUri']['uri']);
	}

/**
 * test setApproved method
 */
	public function testSetApproved() {
		$this->SeoUri->id = '535f0ce3-bc44-4327-2345-066d173cdfff';
		$this->assertFalse((bool)$this->SeoUri->field('is_approved'));
		$this->SeoUri->setApproved();
		$this->assertTrue((bool)$this->SeoUri->field('is_approved'));
	}

/**
 * test setApproved withID
 */
	public function testSetApprovedWithId() {
		$id = '535f0ce3-bc44-4327-2345-066d173cdfff';
		$this->SeoUri2 = ClassRegistry::init('Seo.SeoUri');
		$this->SeoUri2->id = 'invalidid';
		$this->assertFalse((bool)$this->SeoUri->field('is_approved'));
		$this->SeoUri2->setApproved($id);
		$this->assertTrue((bool)$this->SeoUri->field('is_approved'));
	}

	//	public function testSendNotification() {
	//		$this->SeoUri->id = '5313a904-ca7c-4cee-9aed-0c05ccb469e7';
	//		//$this->SeoUri->Email->expectOnce('send');
	//		$this->SeoUri->sendNotification();
	//		$this->assertEquals('301 Redirect: #(.*)#i to / needs approval', $this->SeoUri->Email->subject);
	//		$this->assertEquals('html', $this->SeoUri->Email->sendAs);
	//	}

	public function testDeleteUriDeletesMeta() {
		$this->assertTrue($this->SeoUri->SeoMetaTag->hasAny(array('id' => '535da751-922c-4089-8779-1173173cdfff')));
		$this->assertTrue($this->SeoUri->SeoMetaTag->hasAny(array('id' => '535da751-dc40-4991-a9a9-1173173cdfff')));
		$this->SeoUri->delete('535da751-0100-409c-9adb-1173173cdfff');
		$this->assertFalse($this->SeoUri->SeoMetaTag->hasAny(array('id' => '535da751-922c-4089-8779-1173173cdfff')));
		$this->assertFalse($this->SeoUri->SeoMetaTag->hasAny(array('id' => '535da751-dc40-4991-a9a9-1173173cdfff')));
	}

	public function testDeleteUriDeleteRedirect() {
		$this->assertTrue($this->SeoUri->SeoRedirect->hasAny(array('id' => '535f0cbe-cd64-4ca6-ae77-066f173cdfff')));
		$this->SeoUri->delete('535f0cbe-ba00-4403-a69d-066f173cdfff');
		$this->assertFalse($this->SeoUri->SeoRedirect->hasAny(array('id' => '535f0cbe-cd64-4ca6-ae77-066f173cdfff')));
	}

/**
 * test requestMatch method
 */
	public function testRequestMatch() {
		$result = $this->SeoUri->requestMatch('/regexer', '535f0ce3-bc44-3456-5234-066d173cdfff');

		$this->assertTrue($result);
	}

/**
 * test clearAssociatesIfEmpty method
 */
	public function testClearAssociatesIfEmpty() {
		$data = array(
			'SeoUri' => array(
				'id' => '536073fb-f8ac-49b5-9c0e-0e57173cdfff',
				'uri' => '/',
				'is_approved' => '1'
			),
			'SeoTitle' => array(
				'id' => '536073fb-8014-442e-bbc6-0e57173cdfff',
				'title' => 'home page'
			),
			'SeoMetaTag' => array(
				0 => array(
					'id' => '536073fb-c1f4-47f7-8f7b-0e57173cdfff',
					'name' => 'one',
					'content' => 'one',
					'is_http_equiv' => '1'
				),
				1 => array(
					'id' => '536073fb-fd30-4171-8ace-0e57173cdfff',
					'name' => '',
					'content' => 'two',
					'is_http_equiv' => '1'
				),
				2 => array(
					'id' => '536073fb-16d4-421b-9349-0e57173cdfff',
					'name' => 'three',
					'content' => 'three',
					'is_http_equiv' => '1'
				)
			)
		);

		$this->SeoUri->set($data);
		$this->SeoUri->clearAssociatesIfEmpty();

		$this->assertEquals(count($data) - 1, count($this->SeoUri->data['SeoMetaTag']));
	}

/**
 * test clearAssociatesIfEmpty method with no tags
 */
	public function testClearAssociatesIfEmptyWithNoTags() {
		$data = array(
			'SeoUri' => array(
				'id' => '536073fb-f8ac-49b5-9c0e-0e57173cdfff',
				'uri' => '/',
				'is_approved' => '1'
			),
			'SeoTitle' => array(
				'id' => '536073fb-8014-442e-bbc6-0e57173cdfff',
				'title' => 'home page'
			),
		);

		$this->SeoUri->set($data);
		$this->SeoUri->clearAssociatesIfEmpty();

		$this->assertEquals($data, $this->SeoUri->data);
	}

/**
 * test clearAssociatesIfEmpty method with blank title
 */
	public function testClearAssociatesIfEmptyWithBlankTitle() {
		$data = array(
			'SeoUri' => array(
				'id' => '536073fb-f8ac-49b5-9c0e-0e57173cdfff',
				'uri' => '/',
				'is_approved' => '1'
			),
			'SeoTitle' => array(
				'id' => '536073fb-8014-442e-bbc6-0e57173cdfff',
				'title' => ''
			),
			'SeoMetaTag' => array(
				0 => array(
					'id' => '536073fb-c1f4-47f7-8f7b-0e57173cdfff',
					'name' => 'one',
					'content' => 'one',
					'is_http_equiv' => '1'
				),
				1 => array(
					'id' => '536073fb-fd30-4171-8ace-0e57173cdfff',
					'name' => 'two',
					'content' => 'two',
					'is_http_equiv' => '1'
				),
				2 => array(
					'id' => '536073fb-16d4-421b-9349-0e57173cdfff',
					'name' => 'three',
					'content' => 'three',
					'is_http_equiv' => '1'
				)
			)
		);

		$this->SeoUri->set($data);
		$this->SeoUri->clearAssociatesIfEmpty();

		$this->assertFalse(isset($this->SeoUri->data['Seotitle']));
	}

/**
 * test clearAssociatesIfEmpty method with no title
 */
	public function testClearAssociatesIfEmptyWithNoTitle() {
		$data = array(
			'SeoUri' => array(
				'id' => '536073fb-f8ac-49b5-9c0e-0e57173cdfff',
				'uri' => '/',
				'is_approved' => '1'
			),
			'SeoTitle' => array(),
			'SeoMetaTag' => array(
				0 => array(
					'id' => '536073fb-c1f4-47f7-8f7b-0e57173cdfff',
					'name' => 'one',
					'content' => 'one',
					'is_http_equiv' => '1'
				),
				1 => array(
					'id' => '536073fb-fd30-4171-8ace-0e57173cdfff',
					'name' => 'two',
					'content' => 'two',
					'is_http_equiv' => '1'
				),
				2 => array(
					'id' => '536073fb-16d4-421b-9349-0e57173cdfff',
					'name' => 'three',
					'content' => 'three',
					'is_http_equiv' => '1'
				)
			)
		);

		$this->SeoUri->set($data);
		$this->SeoUri->clearAssociatesIfEmpty();

		$this->assertFalse(isset($this->SeoUri->data['Seotitle']));
	}

/**
 * test findForViewById method
 */
	public function testFindForViewById() {
		$result = $this->SeoUri->findForViewById('535f0ce3-bc44-4327-2345-066d173cdfff');

		$this->assertTrue(isset($result[$this->SeoUri->alias]));
	}

/**
 * test findIdByUri method
 */
	public function testFindIdByUri() {
		$result = $this->SeoUri->findIdByUri('/');

		$this->assertTextEquals('535da751-0100-409c-9adb-1173173cdfff', $result);
	}

/**
 * test findRegexUri method
 */
	public function testFindRegexUriWithWildCard() {
		Cache::clear();

		$result = $this->SeoUri->findRegexUri('/wildcard*');

		$this->assertFalse(empty($result));
		$this->assertEquals('535f0ce3-bc44-3456-2353-066d173cdfff', $result[0]);
	}

/**
 * test findRegexUri method
 */
	public function testFindRegexUriWithRegex() {
		Cache::clear();
		$expected = '535f0ce3-bc44-3456-5234-066d173cdfff';

		$result1 = $this->SeoUri->findRegexUri('/regexer');
		$result2 = $this->SeoUri->findRegexUri('/regexing');
		$result3 = $this->SeoUri->findRegexUri('/regexed');
		$result4 = $this->SeoUri->findRegexUri('/regexs');

		$this->assertFalse(empty($result1));
		$this->assertFalse(empty($result2));
		$this->assertFalse(empty($result3));
		$this->assertFalse(empty($result4));

		$this->assertEquals($expected, $result1[0]);
		$this->assertEquals($expected, $result2[0]);
		$this->assertEquals($expected, $result3[0]);
		$this->assertEquals($expected, $result4[0]);
	}

/**
 * test findAllRegexUris method
 */
	public function testFindAllRegexUris() {
		$this->SeoUri = $this->getMockForModel('SeoUri', array('getConfig'));
		$this->SeoUri->expects($this->once())
			->method('getConfig')
			->will($this->returnValue('default'));
		Cache::clear();

		$result = $this->SeoUri->findAllRegexUris();

		$this->assertEquals('#\bregex(er|ing|ed|s)?\b#', $result[0][$this->SeoUri->alias]['uri']);
		$this->assertEquals('/wildcard*', $result[1][$this->SeoUri->alias]['uri']);
	}

	public function tearDown() {
		parent::tearDown();
		unset($this->SeoUri);
		ClassRegistry::flush();
	}

}