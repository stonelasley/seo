<?php
/* SeoBlacklist Test cases generated on: 2011-02-02 11:19:50 : 1296670790*/
App::import('Model', 'Seo.SeoBlacklist');

class SeoBlacklistTest extends CakeTestCase {

	public $fixtures = array('plugin.seo.seo_blacklist');

	public function setUp() {
		parent::setUp();
		$this->SeoBlacklist = ClassRegistry::init('SeoBlacklist');
	}

/**
 * testAddToBannedNoIP
 *
 * @return void
 */
	public function testAddToBannedNoIP() {
		$SeoBlacklist = $this->getMockForModel('SeoBlacklist', array('getIpFromServer'));
		$SeoBlacklist->expects($this->once())
			->method('getIpFromServer')
			->will($this->returnValue('192.168.1.1'));
		$result = $SeoBlacklist->addToBanned(null, null, true);
		$this->assertTrue(isset($result[$this->SeoBlacklist->alias]));
		$this->assertEquals('3232235777', $result[$this->SeoBlacklist->alias]['ip_range_start']);
	}

/**
 * testAddToBannedNoIPWithAggressive
 *
 * @return void
 */
	public function testAddToBannedNoIPWithAggressive() {
		$SeoBlacklist = $this->getMockForModel('SeoBlacklist', array('getIpFromServer'));
		$SeoBlacklist->expects($this->once())
			->method('getIpFromServer')
			->will($this->returnValue('192.168.1.1'));
		$result = $SeoBlacklist->addToBanned();
		$this->assertTrue(isset($result[$this->SeoBlacklist->alias]));
		$this->assertEquals('3232235777', $result[$this->SeoBlacklist->alias]['ip_range_start']);
	}
/**
 *
 *
 * @return void
 */
	public function testInstance() {
		$this->assertTrue(is_a($this->SeoBlacklist, 'SeoBlacklist'));
	}

	public function testIpValidCheck() {
		$this->assertTrue($this->SeoBlacklist->isIp(array('192.168.1.100')));
		$this->assertFalse($this->SeoBlacklist->isIp(array('100')));
	}

	public function testSaveShouldLongTheIP() {
		$data = array(
			'SeoBlacklist' => array(
				'ip_range_start' => '127.255.253.220',
				'ip_range_end' => '127.255.253.222',
				'note' => 'this is my note',
				'is_active' => '0'
			)
		);
		$this->SeoBlacklist->set($data);

		$count = $this->SeoBlacklist->find('count');
		$this->SeoBlacklist->save();
		$result = $this->SeoBlacklist->find('last');

		$this->assertEquals($count + 1, $this->SeoBlacklist->find('count'));
		$this->assertEquals('127.255.253.220', $result['SeoBlacklist']['ip_range_start']);
		$this->assertEquals('127.255.253.222', $result['SeoBlacklist']['ip_range_end']);
	}

	public function testIsBannedByIp() {
		$this->assertTrue($this->SeoBlacklist->isBanned('10.100.0.1'));
		$this->assertTrue($this->SeoBlacklist->isBanned('10.100.0.2'));
		$this->assertTrue($this->SeoBlacklist->isBanned('10.100.0.3'));
		$this->assertFalse($this->SeoBlacklist->isBanned('10.100.0.10'));
	}

	public function testIsBannedNoIp() {
		$SeoBlacklist = $this->getMockForModel('SeoBlacklist', array('getIpFromServer'));
		$SeoBlacklist->expects($this->once())
			->method('getIpFromServer')
			->will($this->returnValue('10.100.0.1'));
		$this->assertTrue($result = $SeoBlacklist->isBanned());
	}

	public function testIsBannedByInt() {
		$this->assertTrue($this->SeoBlacklist->isBanned(174325761));
		$this->assertTrue($this->SeoBlacklist->isBanned(174325762));
		$this->assertTrue($this->SeoBlacklist->isBanned(174325763));
		$this->assertFalse($this->SeoBlacklist->isBanned(174325775));
		$this->assertFalse($this->SeoBlacklist->isBanned(3232235828));
	}

	public function testAddSingleIp() {
		$this->assertFalse($this->SeoBlacklist->isBanned('127.255.253.125'));
		$this->SeoBlacklist->addToBanned('127.255.253.125', "note", true);
		$this->assertTrue($this->SeoBlacklist->isBanned('127.255.253.125'));
	}

	public function testAddSingleIpIfNotAggressive() {
		$this->assertFalse($this->SeoBlacklist->isBanned('127.255.253.125'));
		$this->SeoBlacklist->addToBanned('127.255.253.125', "note", false);
		$this->assertFalse($this->SeoBlacklist->isBanned('127.255.253.125'));
	}

	public function testGetIpFromServer() {
		$_SERVER['HTTP_CLIENT_IP'] = 'client';
		$_SERVER['HTTP_X_FORWARDED_FOR'] = 'forwarded';
		$_SERVER['REMOTE_ADDR'] = 'remote';

		$this->assertEquals('client', $this->SeoBlacklist->getIpFromServer());
		unset($_SERVER['HTTP_CLIENT_IP']);
		$this->assertEquals('forwarded', $this->SeoBlacklist->getIpFromServer());
		unset($_SERVER['HTTP_X_FORWARDED_FOR']);
		$this->assertEquals('remote', $this->SeoBlacklist->getIpFromServer());
	}

	public function tearDown() {
		parent::tearDown();
		unset($this->SeoBlacklist);
		ClassRegistry::flush();
	}

}