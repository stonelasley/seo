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
		$uri = $this->SeoUri->findById('5312925f-d9e8-41c5-8d10-0bddccb469e7');
		$this->assertEquals('/dogs', $uri['SeoUri']['uri']);
		$this->SeoUri->urlEncode('5312925f-d9e8-41c5-8d10-0bddccb469e7');
		$result = $this->SeoUri->findById('5312925f-d9e8-41c5-8d10-0bddccb469e7');
		$this->assertEquals('/dogs', $result['SeoUri']['uri']);

		$uri = $this->SeoUri->findById('53139850-c644-4836-905c-0bc5ccb469e7');
		$this->assertEquals('/mickey boy', $uri['SeoUri']['uri']);
		$this->SeoUri->urlEncode('53139850-c644-4836-905c-0bc5ccb469e7');
		$result = $this->SeoUri->findById('53139850-c644-4836-905c-0bc5ccb469e7');
		$this->assertEquals('/mickey%20boy', $result['SeoUri']['uri']);
	}

	public function testSetApproved() {
		$this->SeoUri->id = '5313a904-ca7c-4cee-9aed-0c05ccb469e7';
		$this->assertFalse($this->SeoUri->field('is_approved'));
		$this->SeoUri->setApproved();
		$this->assertTrue($this->SeoUri->field('is_approved'));
	}

	//	public function testSendNotification() {
	//		$this->SeoUri->id = '5313a904-ca7c-4cee-9aed-0c05ccb469e7';
	//		//$this->SeoUri->Email->expectOnce('send');
	//		$this->SeoUri->sendNotification();
	//		$this->assertEquals('301 Redirect: #(.*)#i to / needs approval', $this->SeoUri->Email->subject);
	//		$this->assertEquals('html', $this->SeoUri->Email->sendAs);
	//	}

	public function testDeleteUriDeletesMeta() {
		$this->assertTrue($this->SeoUri->SeoMetaTag->hasAny(array('id' => '53129048-f904-4a25-9f0d-0c07ccb469e7')));
		$this->assertTrue($this->SeoUri->SeoMetaTag->hasAny(array('id' => '53129048-ebfc-49d0-a2b2-0c07ccb469e7')));
		$this->SeoUri->delete('531288d1-4c4c-46ab-b1e2-0bc4ccb469e7');
		$this->assertFalse($this->SeoUri->SeoMetaTag->hasAny(array('id' => '53129048-f904-4a25-9f0d-0c07ccb469e7')));
		$this->assertFalse($this->SeoUri->SeoMetaTag->hasAny(array('id' => '53129048-ebfc-49d0-a2b2-0c07ccb469e7')));
	}

	public function testDeleteUriDeleteRedirect() {
		$this->assertTrue($this->SeoUri->SeoRedirect->hasAny(array('id' => '5313b3c4-cf4c-42ff-a6a8-0c06ccb469e7')));
		$this->SeoUri->delete('5313a904-ca7c-4cee-9aed-0c05ccb469e7');
		$this->assertFalse($this->SeoUri->SeoRedirect->hasAny(array('id' => '5313b3c4-cf4c-42ff-a6a8-0c06ccb469e7')));
	}

	public function tearDown() {
		parent::tearDown();
		unset($this->SeoUri);
		ClassRegistry::flush();
	}

}