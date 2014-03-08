<?php
/**
 * SeoRedirectFixture
 *
 */
class SeoRedirectFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 36, 'key' => 'primary', 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'seo_uri_id' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 36, 'key' => 'index', 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'redirect' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'priority' => array('type' => 'integer', 'null' => false, 'default' => '100'),
		'is_active' => array('type' => 'boolean', 'null' => false, 'default' => '1'),
		'callback' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'SEO_REDIRECTS_SEO_URL_ID' => array('column' => 'seo_uri_id', 'unique' => 0)
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
			'id' => '5313a8f2-c6d8-44c2-9e04-0bc3ccb469e7',
			'seo_uri_id' => '5312925f-d9e8-41c5-8d10-0bddccb469e7',
			'redirect' => '/puppies',
			'priority' => '1',
			'is_active' => 1,
			'callback' => '',
			'created' => '2014-03-02 14:56:02',
			'modified' => '2014-03-02 14:56:02'
		),
		array(
			'id' => '5313b3c4-cf4c-42ff-a6a8-0c06ccb469e7',
			'seo_uri_id' => '5313a904-ca7c-4cee-9aed-0c05ccb469e7',
			'redirect' => '/',
			'priority' => '1',
			'is_active' => 1,
			'callback' => '',
			'created' => '2014-03-02 15:42:12',
			'modified' => '2014-03-02 15:42:12'
		),
		array(
			'id' => '5313a950-9610-4e76-880a-0bc2ccb469e7',
			'seo_uri_id' => '5313a5c0-51f0-49a3-a68b-0c05ccb469e7',
			'redirect' => '/',
			'priority' => '2',
			'is_active' => 1,
			'callback' => '',
			'created' => '2014-03-02 14:57:36',
			'modified' => '2014-03-02 14:58:09'
		),
	);

}
