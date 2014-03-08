<?php
class SeoBlacklist extends SeoAppModel {

	public $name = 'SeoBlacklist';

	public $displayField = 'note';

	public $validate = array(
		'ip_range_start' => array(
			'numeric' => array(
				'rule' => array('isIp'),
				'message' => 'Please specify a valid IP start range',
			),
		),
		'ip_range_end' => array(
			'numeric' => array(
				'rule' => array('isIp'),
				'message' => 'Please specify a valid IP end range',
			),
		),
	);

/**
 * Default filter args for building search queries using the searchable behavior
 *
 * @var array
 */
	public $filterArgs = array (
		//@ip searching doesn't work.
		'ip' => array('type' => 'expression', 'method' => 'makeRangeCondition', 'field' => 'SeoBlacklist.ip_range_start <= ?'),
		'is_active' => array ('type' => 'value', 'empty' => false)
	);

/**
 * Fields to IP
 */
	public $fieldsToLong = array(
		'ip_range_start',
		'ip_range_end'
	);

/**
 * Add the IP to the banned list.
 * @param null $ip
 * @param string $note
 * @param null $isActive
 * @internal param \ip $string to ban
 * @internal param \note $string to add to this ban
 * @return boolean success of save
 */
	public function addToBanned($ip = null, $note = "AutoBanned", $isActive = null) {
		if (!$ip) {
			$ip = $this->getIpFromServer();
		}

		if ($isActive === null) {
			$isActive = SeoUtil::getConfig('aggressive');
		}

		return $this->save(array(
			$this->alias => array(
				'ip_range_start' => $ip,
				'ip_range_end' => $ip,
				'note' => $note,
				'is_active' => $isActive
			)
		));
	}

/**
 * Return true depending on the incomming IP
 * @param string $ip to check if banned
 * @return boolean true or false
 */
	public function isBanned($ip = null) {
		if (!$ip) {
			$ip = $this->getIpFromServer();
		}
		$ipQuery = is_numeric($ip) ? $ip : ip2long($ip);

		//Check if exists in blacklist
		return $this->hasAny(array(
			"{$this->alias}.ip_range_start <=" => $ipQuery,
			"{$this->alias}.ip_range_end >=" => $ipQuery,
			"{$this->alias}.is_active" => true
		));
	}
}