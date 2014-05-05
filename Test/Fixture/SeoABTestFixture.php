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
			'id' => '535dda88-f5bc-4942-b9b2-1174173cdfff',
			'seo_uri_id' => '535da751-0100-409c-9adb-1173173cdfff',
			'is_active' => true,
			'slug' => 'home',
			'roll' => '50',
			'priority' => '1',
			'redmine' => null,
			'description' => 'home test description',
			'start_date' => '2014-04-27',
			'end_date' => '2034-04-27',
			'created' => '2014-04-27 22:35:20',
			'modified' => '2014-04-28 20:20:17'
		),
		array(
			'id' => '535f0c1d-daec-444d-9958-066e173cdfff',
			'seo_uri_id' => '535f0b80-131c-486b-8069-066d173cdfff',
			'is_active' => true,
			'slug' => 'about_slug',
			'roll' => '25',
			'priority' => '1',
			'redmine' => null,
			'description' => 'about test description',
			'start_date' => '2014-04-28',
			'end_date' => '2034-04-28',
			'created' => '2014-04-28 20:19:09',
			'modified' => '2014-04-28 20:20:29'
		),
		array(
			'id' => '535f0c52-a2e0-4808-be00-066d173cdfff',
			'seo_uri_id' => '535f0bbe-9c70-4442-95f0-0bd0173cdfff',
			'is_active' => true,
			'slug' => 'contact_slug',
			'roll' => '75',
			'priority' => '1',
			'redmine' => null,
			'description' => 'contact test description',
			'start_date' => '2014-04-28',
			'end_date' => '2034-04-28',
			'created' => '2014-04-28 20:20:02',
			'modified' => '2014-04-28 20:20:37'
		),
	);

}
