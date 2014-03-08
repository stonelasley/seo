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
			'id' => '53129048-060c-4241-bfb3-0c07ccb469e7',
			'seo_uri_id' => '531288d1-4c4c-46ab-b1e2-0bc4ccb469e7',
			'title' => 'THIS IS MY TITLE',
			'created' => '2014-03-01 18:58:32',
			'modified' => '2014-03-01 18:58:32'
		),
		array(
			'id' => '5312925f-fe7c-44d9-a6c6-0bddccb469e7',
			'seo_uri_id' => '5312925f-d9e8-41c5-8d10-0bddccb469e7',
			'title' => 'MICK AND WESS!!',
			'created' => '2014-03-01 19:07:27',
			'modified' => '2014-03-01 19:07:27'
		),
		array(
			'id' => '5313ac12-d390-4dba-b78a-0c05ccb469e7',
			'seo_uri_id' => '5313a493-7274-413e-aa8b-0bc2ccb469e7',
			'title' => 'Pondy is funny',
			'created' => '2014-03-02 15:09:22',
			'modified' => '2014-03-02 15:09:22'
		),
		array(
			'id' => '5313b3d2-56b4-41ae-a7a8-0bc1ccb469e7',
			'seo_uri_id' => '5313a904-ca7c-4cee-9aed-0c05ccb469e7',
			'title' => 'MICKEY AND WESLEY',
			'created' => '2014-03-02 15:42:26',
			'modified' => '2014-03-02 15:42:26'
		),
	);

}
