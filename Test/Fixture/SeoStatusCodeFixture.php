<?php
/**
 * SeoStatusCodeFixture
 *
 */
class SeoStatusCodeFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 36, 'key' => 'primary', 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'seo_uri_id' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 36, 'key' => 'index', 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'status_code' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 3),
		'priority' => array('type' => 'integer', 'null' => false, 'default' => '100', 'length' => 4),
		'is_active' => array('type' => 'boolean', 'null' => false, 'default' => '1'),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'SEO_STATUS_CODES_SEO_URI_ID' => array('column' => 'seo_uri_id', 'unique' => 0)
		),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'MyISAM')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => 'e55bf308-a6c2-486b-8504-d5baca9f9fee',
			'seo_uri_id' => '535f0ce3-bc44-4327-2345-066d173cdfff',
			'status_code' => 302,
			'priority' => 100,
			'is_active' => 1,
			'created' => '2011-07-25 17:06:20',
			'modified' => '2011-07-25 17:06:20'
		),
	);

}
