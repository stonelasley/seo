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
			'id' => '5312c3aa-dc20-441c-984c-0c06ccb469e7',
			'seo_uri_id' => '531288d1-4c4c-46ab-b1e2-0bc4ccb469e7',
			'canonical' => '/index2',
			'is_active' => 1,
			'created' => '2014-03-01 22:37:46',
			'modified' => '2014-03-02 14:40:21'
		),
		array(
			'id' => '5312c3c0-691c-46c0-aa3a-0c05ccb469e7',
			'seo_uri_id' => '5312925f-d9e8-41c5-8d10-0bddccb469e7',
			'canonical' => '/puppies',
			'is_active' => 1,
			'created' => '2014-03-01 22:38:08',
			'modified' => '2014-03-01 22:38:08'
		),
		array(
			'id' => '5313a493-32a4-4b6f-a365-0bc2ccb469e7',
			'seo_uri_id' => '5313a493-7274-413e-aa8b-0bc2ccb469e7',
			'canonical' => '/big/dummy',
			'is_active' => 1,
			'created' => '2014-03-02 14:37:23',
			'modified' => '2014-03-02 14:37:23'
		),
		array(
			'id' => '5313a54c-8cd8-4ad3-a911-0bc2ccb469e7',
			'seo_uri_id' => '531288d1-4c4c-46ab-b1e2-0bc4ccb469e7',
			'canonical' => '/index',
			'is_active' => 1,
			'created' => '2014-03-02 14:40:28',
			'modified' => '2014-03-02 20:00:14'
		),
	);

}
