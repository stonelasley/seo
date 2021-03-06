<?php
App::uses('SeoAppModel', 'Seo.Model');
class SeoHoneypotVisit extends SeoAppModel {

	public $name = 'SeoHoneypotVisit';

	public $displayField = 'ip';

	public $validate = array(
		'ip' => array(
			'numeric' => array(
				'rule' => array('isIp'),
				'message' => 'Specify valid IP',
			),
		),
	);

/**
 * Fields to IP
 */
	public $fieldsToLong = array(
		'ip'
	);

/**
 * HoneyPot visit triggered, log the visit in the database.
 * @param string ip
 * @return boolean success
 */
	public function add($ip = null) {
		if (!$ip) {
			return false;
		}

		$this->clear();
		return $this->save(array(
			$this->alias => array(
				'ip' => $ip
			)
		));
	}

/**
 * Decide if the trap should be triggered
 * @param string ip to check (default current IP)
 * @return boolean
 */
	public function isTriggered($ip = null) {
		if (!$ip) {
			return false;
		}
		$ipQuery = is_numeric($ip) ? $ip : ip2long($ip);

		//Clear the database of old trigger count
		$this->clear();

		//Find the count of triggers within the (not allowed) time frame
		$count = $this->find('count', array(
			'conditions' => array(
				"{$this->alias}.ip" => $ipQuery
			)
		));

		return ($this->getConfig('triggerCount') <= $count);
	}

/**
 * Clear the list of old visits baesd on the current time.
 * @return boolean success
 */
	public function clear() {
		$cutoff = time() - $this->getConfig('timeBetweenTriggers');
		return $this->deleteAll(array(
			"{$this->alias}.created <=" => date('Y-m-d g:i:s', $cutoff)
		));
	}
}