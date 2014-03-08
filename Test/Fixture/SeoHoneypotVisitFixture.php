<?php
/**
 * SeoHoneypotVisitFixture
 *
 */
class SeoHoneypotVisitFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 36, 'key' => 'primary', 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'ip' => array('type' => 'biginteger', 'null' => false, 'default' => null, 'key' => 'index'),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'SEO_HONEYPOT_IP' => array('column' => 'ip', 'unique' => 0)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'MyISAM')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => '09BDB786-A287-11E3-AFBA-13071D5D46B0',
			'ip' => 174328420,
			'created' => '2014-01-01 19:03:42'
		),
		array(
			'id' => '0E7101C0-A287-11E3-A490-15071D5D46B0',
			'ip' => 1276839996,
			'created' => '2014-01-01 06:03:42'
		),
		array(
			'id' => '14CC8AD0-A287-11E3-8DBF-17071D5D46B0',
			'ip' => 3232235876,
			'created' => '2014-01-01 09:03:42'
		),
	);

}
