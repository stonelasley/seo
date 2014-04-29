<?php
/**
 * SeoMetaTagFixture
 *
 */
class SeoMetaTagFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 36, 'key' => 'primary', 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'seo_uri_id' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 36, 'key' => 'index', 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'name' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'content' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'is_http_equiv' => array('type' => 'boolean', 'null' => false, 'default' => '0'),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'SEO_META_TAGS_SEO_URI_ID' => array('column' => 'seo_uri_id', 'unique' => 0)
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
			'id' => '535da751-922c-4089-8779-1173173cdfff',
			'seo_uri_id' => '535da751-0100-409c-9adb-1173173cdfff',
			'name' => 'description',
			'content' => 'home page description content',
			'is_http_equiv' => 1,
			'created' => '2014-04-27 18:56:49',
			'modified' => '2014-04-27 19:37:52'
		),
		array(
			'id' => '535da751-dc40-4991-a9a9-1173173cdfff',
			'seo_uri_id' => '535da751-0100-409c-9adb-1173173cdfff',
			'name' => 'keywords',
			'content' => 'home page keywords content',
			'is_http_equiv' => 1,
			'created' => '2014-04-27 18:56:49',
			'modified' => '2014-04-27 19:37:52'
		),
		array(
			'id' => '535da751-1524-42f9-a722-1173173cdfff',
			'seo_uri_id' => '535da751-0100-409c-9adb-1173173cdfff',
			'name' => 'robots',
			'content' => 'home page robots content',
			'is_http_equiv' => 1,
			'created' => '2014-04-27 18:56:49',
			'modified' => '2014-04-27 19:37:52'
		),
		array(
			'id' => '535f0b80-c814-4722-8344-066d173cdfff',
			'seo_uri_id' => '535f0b80-131c-486b-8069-066d173cdfff',
			'name' => 'description',
			'content' => 'about page description content',
			'is_http_equiv' => 0,
			'created' => '2014-04-28 20:16:32',
			'modified' => '2014-04-28 20:17:58'
		),
		array(
			'id' => '535f0b80-047c-4ab3-b121-066d173cdfff',
			'seo_uri_id' => '535f0b80-131c-486b-8069-066d173cdfff',
			'name' => 'keywords',
			'content' => 'about page keywords content',
			'is_http_equiv' => 0,
			'created' => '2014-04-28 20:16:32',
			'modified' => '2014-04-28 20:18:11'
		),
		array(
			'id' => '535f0b80-320c-4fbb-a487-066d173cdfff',
			'seo_uri_id' => '535f0b80-131c-486b-8069-066d173cdfff',
			'name' => 'robots',
			'content' => 'about page robots content',
			'is_http_equiv' => 0,
			'created' => '2014-04-28 20:16:32',
			'modified' => '2014-04-28 20:18:21'
		),
		array(
			'id' => '535f0bbe-a118-42fe-b49c-0bd0173cdfff',
			'seo_uri_id' => '535f0bbe-9c70-4442-95f0-0bd0173cdfff',
			'name' => 'description',
			'content' => 'contact page description content',
			'is_http_equiv' => 0,
			'created' => '2014-04-28 20:17:34',
			'modified' => '2014-04-28 20:17:34'
		),
		array(
			'id' => '535f0bbe-f554-4187-8830-0bd0173cdfff',
			'seo_uri_id' => '535f0bbe-9c70-4442-95f0-0bd0173cdfff',
			'name' => 'keywords',
			'content' => 'contact page keywords content',
			'is_http_equiv' => 0,
			'created' => '2014-04-28 20:17:34',
			'modified' => '2014-04-28 20:17:34'
		),
		array(
			'id' => '535f0bbe-3d10-4493-af47-0bd0173cdfff',
			'seo_uri_id' => '535f0bbe-9c70-4442-95f0-0bd0173cdfff',
			'name' => 'robots',
			'content' => 'contact page robots content',
			'is_http_equiv' => 0,
			'created' => '2014-04-28 20:17:34',
			'modified' => '2014-04-28 20:17:34'
		),
	);

}
