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
			'id' => '5313aa86-5eb0-44c1-9481-0bddccb469e7',
			'seo_uri_id' => '531288d1-4c4c-46ab-b1e2-0bc4ccb469e7',
			'status_code' => '205',
			'priority' => '1',
			'is_active' => 1,
			'created' => '2014-03-02 15:02:46',
			'modified' => '2014-03-02 15:05:30'
		),
	);

}
