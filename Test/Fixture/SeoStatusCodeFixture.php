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
			'id' => '53630383-ca24-475f-a4d0-0e57173cdfff',
			'seo_uri_id' => '536073fb-f8ac-49b5-9c0e-0e57173cdfff',
			'status_code' => '200',
			'priority' => '1',
			'is_active' => true,
			'created' => '2014-05-01 20:31:31',
			'modified' => '2014-05-01 20:31:31'
		),
		array(
			'id' => '53630396-fdec-467b-8718-0e5c173cdfff',
			'seo_uri_id' => '536073fb-f8ac-49b5-9c0e-0e57173cdfff',
			'status_code' => '409',
			'priority' => '5',
			'is_active' => true,
			'created' => '2014-05-01 20:31:50',
			'modified' => '2014-05-01 20:31:50'
		),
		array(
			'id' => '536303a9-49ec-4abb-bfdd-0e58173cdfff',
			'seo_uri_id' => '536073fb-f8ac-49b5-9c0e-0e57173cdfff',
			'status_code' => '402',
			'priority' => '10',
			'is_active' => true,
			'created' => '2014-05-01 20:32:09',
			'modified' => '2014-05-01 20:32:09'
		),
	);

}
