<?php
/**
 * SeoBlacklistFixture
 *
 */
class SeoBlacklistFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 36, 'key' => 'primary', 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'ip_range_start' => array('type' => 'biginteger', 'null' => false, 'default' => null, 'key' => 'index'),
		'ip_range_end' => array('type' => 'biginteger', 'null' => false, 'default' => null, 'key' => 'index'),
		'note' => array('type' => 'text', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'is_active' => array('type' => 'boolean', 'null' => false, 'default' => '1'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'SEO_BLACKLISTS_IP_START' => array('column' => 'ip_range_start', 'unique' => 0),
			'SEO_BLACKLISTS_IP_END' => array('column' => 'ip_range_end', 'unique' => 0)
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
			'id' => '535f0ae0-29a4-4034-b44e-0bd0173cdfff',
			'ip_range_start' => '174325761',
			'ip_range_end' => '174325762',
			'note' => 'blacklist one',
			'created' => '2014-04-28 20:13:52',
			'modified' => '2014-04-28 20:13:52',
			'is_active' => 1
		),
		array(
			'id' => '535f0af9-8130-4081-89dc-066b173cdfff',
			'ip_range_start' => '174325763',
			'ip_range_end' => '174325764',
			'note' => 'blacklist two',
			'created' => '2014-04-28 20:14:17',
			'modified' => '2014-04-28 20:14:17',
			'is_active' => 1
		),
		array(
			'id' => '535f0b14-8ef4-44a0-a214-066c173cdfff',
			'ip_range_start' => '174325764',
			'ip_range_end' => '174325765',
			'note' => 'Blacklist three',
			'created' => '2014-04-28 20:14:44',
			'modified' => '2014-04-28 20:14:44',
			'is_active' => 1
		),
	);

}
