<?php
/**
 * SeoTitleFixture
 *
 */
class SeoTitleFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 36, 'key' => 'primary', 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'seo_uri_id' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 36, 'key' => 'unique', 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'title' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'SEO_TITLES_SEO_URI_ID' => array('column' => 'seo_uri_id', 'unique' => 1)
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
			'id' => '535dab35-c600-4721-8a78-1175173cdfff',
			'seo_uri_id' => '535da751-0100-409c-9adb-1173173cdfff',
			'title' => 'home page',
			'created' => '2014-04-27 19:13:25',
			'modified' => '2014-04-27 19:37:52'
		),
		array(
			'id' => '535f0b80-86fc-4068-8a37-066d173cdfff',
			'seo_uri_id' => '535f0b80-131c-486b-8069-066d173cdfff',
			'title' => 'about page',
			'created' => '2014-04-28 20:16:32',
			'modified' => '2014-04-28 20:16:32'
		),
		array(
			'id' => '535f0bbe-0df8-4464-8327-0bd0173cdfff',
			'seo_uri_id' => '535f0bbe-9c70-4442-95f0-0bd0173cdfff',
			'title' => 'contact page',
			'created' => '2014-04-28 20:17:34',
			'modified' => '2014-04-28 20:17:34'
		),
	);

}
