<?php
/**
 * CakePHP Seo Plugin
 * @link https://github.com/webtechnick/CakePHP-Seo-Plugin
 *
 * App Model
 */
App::import('Lib', 'Seo.SeoUtil');
class SeoAppModel extends AppModel {

/**
 * Always use Containable
 *
 * var array
 */
	public $actsAs = array('Containable', 'Search.Searchable');

/**
 * Always set recursive = 0
 * (we'd rather use containable for more control)
 *
 * var int
 */
	public $recursive = 0;

/**
 * Overwritable IP fields for database saving
 *
 * @var array
 */
	public $fieldsToLong = array();

/**
 * standard beforeSave() callback
 * Save string IPs as longs
 *
 * @param array $options
 * @return true
 */
	public function beforeSave($options = array()) {
		foreach ($this->fieldsToLong as $field) {
			if (isset($this->data[$this->alias][$field]) && !is_numeric($this->data[$this->alias][$field])) {
				$this->data[$this->alias][$field] = ip2long($this->data[$this->alias][$field]);
			}
		}
		return parent::beforeSave($options);
	}

/**
 * Show the IPs back out.
 *
 * @param mixed $results
 * @param bool $primary
 * @return formatted results
 */
	public function afterFind($results, $primary = false) {
		if (!is_array($results)) {
			return $results;
		}
		foreach ($results as $key => $val) {
			foreach ($this->fieldsToLong as $field) {
				if (isset($val[$this->alias][$field]) && is_numeric($val[$this->alias][$field])) {
					$results[$key][$this->alias][$field] = long2ip($val[$this->alias][$field]);
				}
			}
		}
		return $results;
	}

/**
 * Overwrite find so I can do some nice things with it.
 *
 * @param string find type
 * - last : find last record by created date
 * @param array of query
 * @return array
 */
	public function find($type = 'first', $query = array()) {
		switch($type) {
		case 'last':
				$query = array_merge(
					$query,
					array('order' => "{$this->alias}.{$this->primaryKey} DESC")
				);
			return parent::find('first', $query);
		default:
			return parent::find($type, $query);
		}
	}

/**
 * Custom validation.
 * Using CakePHP IP validation would be nice, but
 * since we're storing ips as longs in our database
 * we need a custom validation.
 *
 * @param field to check
 * @return boolean
 */
	public function isIp($check = null) {
		$ipToCheck = array_shift($check);
		return is_numeric(ip2long($ipToCheck));
	}

/**
 * Set or create the model, this is useful to find the URI
 *
 * @param string $model
 * @param string $field
 * @return bool
 * @retrun boolean
 */
	public function createOrSetUri($model = 'SeoUri', $field = 'uri') {
		$ModelName = Inflector::camelize($model);
		$modelUnderscore = Inflector::underscore($model);

		if (isset($this->data[$ModelName][$field])) {
			$this->$ModelName->contain();
			$this->$ModelName->recursive = -1;
			//Find the Model, and set the id.
			if ($associatedId = $this->$ModelName->field('id', array($field => $this->data[$ModelName][$field]))) {
				$this->data[$this->alias][$modelUnderscore . '_id'] = $associatedId;
			} else {
				$save = array();
				$save[$ModelName][$field] = $this->data[$ModelName][$field];
				$this->$ModelName->clear();
				$this->$ModelName->save($save);
				$this->data[$this->alias][$modelUnderscore . '_id'] = $this->$ModelName->id;
			}
		}
		return true;
	}

/**
 * Return if the incoming URI is a regular expression
 *
 * @param string $uri
 * @return boolean if is regular expression (as two # marks)
 */
	public function isRegEx($uri) {
		return SeoUtil::isRegEx($uri);
	}

/**
 * Returns the server IP based on values from the $_SERVER, etc
 *
 * @return string $ip of incoming/client IP
 */
	public function getIpFromServer() {
		$checkOrder = array(
			'HTTP_CLIENT_IP', //shared client
			'HTTP_X_FORWARDED_FOR', //proxy address (nginx, etc)
			'REMOTE_ADDR', //fail safe
			);
		foreach ($checkOrder as $key) {
			$ip = env($key);
			if (!empty($ip)) {
				return $ip;
			}
		}
	}

/**
 * This is what I want create to do, but without setting defaults.
 */
	public function clear() {
		$this->id = false;
		$this->data = array();
		$this->validationErrors = array();
		return $this->data;
	}
}
