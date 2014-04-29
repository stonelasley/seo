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
			'id' => '535f0cbe-cd64-4ca6-ae77-066f173cdfff',
			'seo_uri_id' => '535f0cbe-ba00-4403-a69d-066f173cdfff',
			'redirect' => '/about',
			'priority' => '1',
			'is_active' => 1,
			'callback' => '',
			'created' => '2014-04-28 20:21:50',
			'modified' => '2014-04-28 20:21:50'
		),
		array(
			'id' => '535f0cce-f4f8-488b-ba69-066e173cdfff',
			'seo_uri_id' => '535f0cce-de10-4496-9950-066e173cdfff',
			'redirect' => '/contact',
			'priority' => '1',
			'is_active' => 1,
			'callback' => '',
			'created' => '2014-04-28 20:22:06',
			'modified' => '2014-04-28 20:22:06'
		),
		array(
			'id' => '535f0ce3-ccec-4a19-80b5-066d173cdfff',
			'seo_uri_id' => '535f0ce3-bc44-4327-91c6-066d173cdfff',
			'redirect' => '/',
			'priority' => '1',
			'is_active' => 1,
			'callback' => '',
			'created' => '2014-04-28 20:22:27',
			'modified' => '2014-04-28 20:22:27'
		),
	);

}
