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

	public function testSetApproved() {
		$this->SeoUri->id = '535f0ce3-bc44-4327-2345-066d173cdfff';
		$this->assertFalse($this->SeoUri->field('is_approved'));
		$this->SeoUri->setApproved();
		$this->assertTrue($this->SeoUri->field('is_approved'));
	}

	//@TODO get this puppy running
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

	public function tearDown() {
		parent::tearDown();
		unset($this->SeoUri);
		ClassRegistry::flush();
	}

}