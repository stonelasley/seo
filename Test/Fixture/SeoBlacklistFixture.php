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
			'id' => '5313e5d1-ce10-41e3-8ca1-0bc5ccb469e7',
			'ip_range_start' => '2147483000',
			'ip_range_end' => '2147483000',
			'note' => '',
			'created' => '2014-03-02 19:15:45',
			'modified' => '2014-03-02 19:15:45',
			'is_active' => 1
		),
		array(
			'id' => '5313e5dc-9c70-4772-9484-0bc3ccb469e7',
			'ip_range_start' => '2147483001',
			'ip_range_end' => '2147483001',
			'note' => '',
			'created' => '2014-03-02 19:15:56',
			'modified' => '2014-03-02 19:15:56',
			'is_active' => 1
		),
		array(
			'id' => '5313e5ef-c128-47af-876b-0c06ccb469e7',
			'ip_range_start' => '2147483002',
			'ip_range_end' => '2147483002',
			'note' => '',
			'created' => '2014-03-02 19:16:15',
			'modified' => '2014-03-02 19:16:15',
			'is_active' => 1
		)
	);

}
