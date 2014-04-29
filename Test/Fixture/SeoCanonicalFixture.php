<?php
/**
 * SeoCanonicalFixture
 *
 */
class SeoCanonicalFixture extends CakeTestFixture {

	/**
	 * Fields
	 *
	 * @var array
	 */
	public $fields = array(
		'id' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 36, 'key' => 'primary', 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'seo_uri_id' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 36, 'key' => 'index', 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'canonical' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'is_active' => array('type' => 'boolean', 'null' => false, 'default' => '1'),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'SEO_CANONICALS_SEO_URI_ID' => array('column' => 'seo_uri_id', 'unique' => 0)
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
			'id' => '535dac20-60b4-46de-b842-19b8173cdfff',
			'seo_uri_id' => '535da751-0100-409c-9adb-1173173cdfff',
			'canonical' => '/index',
			'is_active' => 1,
			'created' => '2014-04-27 19:17:20',
			'modified' => '2014-04-27 19:17:20'
		),
		array(
			'id' => '535f0c92-36d8-4e7b-99d4-066c173cdfff',
			'seo_uri_id' => '535f0b80-131c-486b-8069-066d173cdfff',
			'canonical' => 'about_us',
			'is_active' => 1,
			'created' => '2014-04-28 20:21:06',
			'modified' => '2014-04-28 20:21:06'
		),
		array(
			'id' => '535f0c9f-c6a0-4136-ada5-0dfb173cdfff',
			'seo_uri_id' => '535f0bbe-9c70-4442-95f0-0bd0173cdfff',
			'canonical' => '/contact_us',
			'is_active' => 1,
			'created' => '2014-04-28 20:21:19',
			'modified' => '2014-04-28 20:21:19'
		),
	);

}
