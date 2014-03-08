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
			'id' => '53129048-f904-4a25-9f0d-0c07ccb469e7',
			'seo_uri_id' => '531288d1-4c4c-46ab-b1e2-0bc4ccb469e7',
			'name' => 'description',
			'content' => 'THIS IS THE DESCRIPTION TAG',
			'is_http_equiv' => 1,
			'created' => '2014-03-01 18:58:32',
			'modified' => '2014-03-01 18:58:32'
		),
		array(
			'id' => '53129048-ebfc-49d0-a2b2-0c07ccb469e7',
			'seo_uri_id' => '531288d1-4c4c-46ab-b1e2-0bc4ccb469e7',
			'name' => 'keywords',
			'content' => 'KEY WORDS HERE',
			'is_http_equiv' => 1,
			'created' => '2014-03-01 18:58:32',
			'modified' => '2014-03-01 18:58:32'
		),
		array(
			'id' => '53129048-c84c-4e8b-a2d8-0c07ccb469e7',
			'seo_uri_id' => '531288d1-4c4c-46ab-b1e2-0bc4ccb469e7',
			'name' => 'author',
			'content' => 'THE AUTHOR TAG',
			'is_http_equiv' => 1,
			'created' => '2014-03-01 18:58:32',
			'modified' => '2014-03-01 18:58:32'
		),
		array(
			'id' => '5312925f-e1d4-454f-830e-0bddccb469e7',
			'seo_uri_id' => '5312925f-d9e8-41c5-8d10-0bddccb469e7',
			'name' => 'description',
			'content' => 'MICKEY AND WESLEY ARE TERRIBLE',
			'is_http_equiv' => 1,
			'created' => '2014-03-01 19:07:27',
			'modified' => '2014-03-02 14:42:06'
		),
		array(
			'id' => '5312925f-9f48-466a-9965-0bddccb469e7',
			'seo_uri_id' => '5312925f-d9e8-41c5-8d10-0bddccb469e7',
			'name' => 'charset',
			'content' => 'UTF-8',
			'is_http_equiv' => 1,
			'created' => '2014-03-01 19:07:27',
			'modified' => '2014-03-01 19:07:27'
		),
		array(
			'id' => '5312925f-4e48-439b-bb30-0bddccb469e7',
			'seo_uri_id' => '5312925f-d9e8-41c5-8d10-0bddccb469e7',
			'name' => 'cache-control',
			'content' => 'NO-CACHE',
			'is_http_equiv' => 0,
			'created' => '2014-03-01 19:07:27',
			'modified' => '2014-03-01 19:07:27'
		),
		array(
			'id' => '5313a5c0-efc0-4738-b307-0c05ccb469e7',
			'seo_uri_id' => '5313a5c0-51f0-49a3-a68b-0c05ccb469e7',
			'name' => 'Copyright',
			'content' => '&copy; 20014 Stone Lasley',
			'is_http_equiv' => 1,
			'created' => '2014-03-02 14:42:24',
			'modified' => '2014-03-02 14:42:24'
		),
		array(
			'id' => '5313b146-55d8-46a8-890a-0c05ccb469e7',
			'seo_uri_id' => '5313a904-ca7c-4cee-9aed-0c05ccb469e7',
			'name' => 'EXPIRES',
			'content' => 'Mon, 22 Jul 20014 11:12:01 GMT',
			'is_http_equiv' => 1,
			'created' => '2014-03-02 15:31:34',
			'modified' => '2014-03-02 15:31:34'
		),
		array(
			'id' => '5313b146-fa28-490c-a0b0-0c05ccb469e7',
			'seo_uri_id' => '5313a904-ca7c-4cee-9aed-0c05ccb469e7',
			'name' => 'ROBOTS',
			'content' => 'ALL',
			'is_http_equiv' => 1,
			'created' => '2014-03-02 15:31:34',
			'modified' => '2014-03-02 15:31:34'
		),
		array(
			'id' => '5313b146-074c-42a2-b85c-0c05ccb469e7',
			'seo_uri_id' => '5313a904-ca7c-4cee-9aed-0c05ccb469e7',
			'name' => 'GOOGLEBOT',
			'content' => 'NOARCHIVE',
			'is_http_equiv' => 1,
			'created' => '2014-03-02 15:31:34',
			'modified' => '2014-03-02 15:31:34'
		),
		array(
			'id' => '5313b146-111-42a2-b85c-0c05ccb469e7',
			'seo_uri_id' => '5313a904-abcd-4cee-9aed-0c05ccb469e7',
			'name' => 'GOOGLEBOT',
			'content' => 'NOARCHIVE',
			'is_http_equiv' => 1,
			'created' => '2014-03-02 15:31:34',
			'modified' => '2014-03-02 15:31:34'
		),
	);

}
