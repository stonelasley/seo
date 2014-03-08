<?php
/* SeoHoneypotVisit Test cases generated on: 2011-02-02 19:03:49 : 1296698629*/
App::import('Model', 'Seo.SeoHoneypotVisit');

class SeoHoneypotVisitTest extends CakeTestCase {

	public $fixtures = array('plugin.seo.seo_honeypot_visit');

	public function setUp() {
		parent::setUp();
		$this->SeoHoneypotVisit = ClassRegistry::init('SeoHoneypotVisit');
	}

/**
 *
 *
 * @return void
 */
	public function testInstance() {
		$this->assertTrue(is_a($this->SeoHoneypotVisit, 'SeoHoneypotVisit'));
	}

	public function testAdd() {
		$ip = '127.255.253.120';
		$this->SeoHoneypotVisit->add($ip);
		$visit = $this->SeoHoneypotVisit->findByIp(ip2long($ip));
		$this->assertEquals($ip, $visit['SeoHoneypotVisit']['ip']);
	}

	public function testClear() {
		$this->assertEquals(3, $this->SeoHoneypotVisit->find('count'));
		$this->assertTrue($this->SeoHoneypotVisit->clear());
		$this->assertEquals(0, $this->SeoHoneypotVisit->find('count'));
	}

	public function testClearAfterAdding() {
		$this->assertEquals(3, $this->SeoHoneypotVisit->find('count'));
		$this->SeoHoneypotVisit->add('255.255.123.120');
		$this->SeoHoneypotVisit->add('255.255.123.120');
		$this->assertTrue($this->SeoHoneypotVisit->clear());
		$this->assertEquals(1, $this->SeoHoneypotVisit->find('count'));
	}

	public function testIsTriggered() {
		$this->assertFalse($this->SeoHoneypotVisit->isTriggered('127.255.253.120'));
		$this->SeoHoneypotVisit->add('127.255.253.120');
		$this->SeoHoneypotVisit->add('127.255.253.120');
		$this->SeoHoneypotVisit->add('127.255.253.120');
		$this->SeoHoneypotVisit->add('127.255.253.120');
		$this->SeoHoneypotVisit->add('127.255.253.120');
		$this->SeoHoneypotVisit->add('127.255.253.120');
		$this->assertTrue($this->SeoHoneypotVisit->isTriggered('127.255.253.120'));
	}

	public function tearDown() {
		parent::tearDown();
		unset($this->SeoHoneypotVisit);
		ClassRegistry::flush();
	}

}