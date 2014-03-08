<?php
/**
 * SeoABTestFixture
 *
 */
class SeoABTestFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 36, 'key' => 'primary', 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'seo_uri_id' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 36, 'key' => 'index', 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'is_active' => array('type' => 'boolean', 'null' => false, 'default' => '1', 'key' => 'index'),
		'slug' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 50, 'key' => 'unique', 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'roll' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 200, 'collate' => 'utf8_general_ci', 'comment' => 'int based roll or Model::function callback', 'charset' => 'utf8'),
		'priority' => array('type' => 'integer', 'null' => false, 'default' => '999', 'length' => 4, 'key' => 'index', 'comment' => 'lower the priority, the more priority it has over the other tests.'),
		'redmine' => array('type' => 'integer', 'null' => true, 'default' => null, 'comment' => 'redmine ticket id'),
		'description' => array('type' => 'text', 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'start_date' => array('type' => 'date', 'null' => true, 'default' => null, 'key' => 'index', 'comment' => 'if null, we ignore it.'),
		'end_date' => array('type' => 'date', 'null' => true, 'default' => null, 'key' => 'index', 'comment' => 'if null, we ignore it.'),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'SEO_AB_TEST_SLUG' => array('column' => 'slug', 'unique' => 1),
			'SEO_AB_TEST_SEO_URI_ID' => array('column' => 'seo_uri_id', 'unique' => 0),
			'SEO_AB_TEST_IS_ACTIVE' => array('column' => 'is_active', 'unique' => 0),
			'SEO_AB_TEST_PRIORITY' => array('column' => 'priority', 'unique' => 0),
			'SEO_AB_TEST_END_DATE' => array('column' => 'end_date', 'unique' => 0),
			'SEO_AB_TEST_START_DATE' => array('column' => 'start_date', 'unique' => 0)
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
			'id' => '53139bc7-ee10-4f5b-8c9f-0bddccb469e7',
			'seo_uri_id' => '531288d1-4c4c-46ab-b1e2-0bc4ccb469e7',
			'is_active' => 1,
			'slug' => 'home',
			'roll' => '25',
			'priority' => '100',
			'redmine' => null,
			'description' => 'description',
			'start_date' => '2014-03-02',
			'end_date' => '2014-03-02',
			'created' => '2014-03-02 13:59:51',
			'modified' => '2014-03-02 13:59:51'
		),
		array(
			'id' => '53139850-bacc-4141-8aeb-0bc5ccb469e7',
			'seo_uri_id' => '53139850-c644-4836-905c-0bc5ccb469e7',
			'is_active' => 1,
			'slug' => 'mickey',
			'roll' => '10',
			'priority' => '999',
			'redmine' => '12',
			'description' => 'mickey has a pink nose',
			'start_date' => '2014-03-02',
			'end_date' => '2014-03-02',
			'created' => '2014-03-02 13:45:04',
			'modified' => '2014-03-02 13:56:02'
		),
	);

}
