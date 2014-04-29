<?php
/**
 * SeoUriFixture
 *
 */
class SeoUriFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 36, 'key' => 'primary', 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'uri' => array('type' => 'string', 'null' => true, 'default' => null, 'key' => 'unique', 'collate' => 'utf8_bin', 'charset' => 'utf8'),
		'is_approved' => array('type' => 'boolean', 'null' => false, 'default' => '1', 'key' => 'index'),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'SEO_URIS_UNIQUE_URI' => array('column' => 'uri', 'unique' => 1),
			'SEO_URIS_IS_APPROVED' => array('column' => 'is_approved', 'unique' => 0)
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
			'id' => '535da751-0100-409c-9adb-1173173cdfff',
			'uri' => '/',
			'is_approved' => 1,
			'created' => '2014-04-27 18:56:49',
			'modified' => '2014-04-27 19:37:52'
		),
		array(
			'id' => '535f0b80-131c-486b-8069-066d173cdfff',
			'uri' => '/about',
			'is_approved' => 1,
			'created' => '2014-04-28 20:16:32',
			'modified' => '2014-04-28 20:16:32'
		),
		array(
			'id' => '535f0bbe-9c70-4442-95f0-0bd0173cdfff',
			'uri' => '/contact',
			'is_approved' => 1,
			'created' => '2014-04-28 20:17:34',
			'modified' => '2014-04-28 20:17:34'
		),
		array(
			'id' => '535f0cbe-ba00-4403-a69d-066f173cdfff',
			'uri' => '/about_us',
			'is_approved' => 1,
			'created' => '2014-04-28 20:21:50',
			'modified' => '2014-04-28 20:21:50'
		),
		array(
			'id' => '535f0cce-de10-4496-9950-066e173cdfff',
			'uri' => '/contact_us',
			'is_approved' => 1,
			'created' => '2014-04-28 20:22:06',
			'modified' => '2014-04-28 20:22:06'
		),
		array(
			'id' => '535f0ce3-bc44-4327-91c6-066d173cdfff',
			'uri' => '/index',
			'is_approved' => 1,
			'created' => '2014-04-28 20:22:27',
			'modified' => '2014-04-28 20:22:27'
		),
	);

}
