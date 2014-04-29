<?php
/**
 * SeoUrlFixture
 *
 */
class SeoUrlFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 36, 'key' => 'primary', 'collate' => 'utf8_bin', 'charset' => 'utf8'),
		'url' => array('type' => 'string', 'null' => false, 'default' => null, 'key' => 'unique', 'collate' => 'utf8_bin', 'charset' => 'utf8'),
		'priority' => array('type' => 'float', 'null' => false, 'default' => null, 'key' => 'index'),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'SEO_URLS_UNIQUE_URL' => array('column' => 'url', 'unique' => 1),
			'SEO_URLS_PRIORITY' => array('column' => 'priority', 'unique' => 0)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_bin', 'engine' => 'MyISAM')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => '535f2962-efd0-4ae7-80c5-066c173cdfff',
			'url' => '/products',
			'priority' => '1',
			'created' => '2014-04-28 22:24:02',
			'modified' => '2014-04-28 22:24:39'
		),
		array(
			'id' => '535f2976-b820-46f9-b874-066f173cdfff',
			'url' => '/recipes',
			'priority' => '2',
			'created' => '2014-04-28 22:24:22',
			'modified' => '2014-04-28 22:24:22'
		),
		array(
			'id' => '535f2980-7f64-4a48-940e-066e173cdfff',
			'url' => '/categories',
			'priority' => '3',
			'created' => '2014-04-28 22:24:32',
			'modified' => '2014-04-28 22:24:32'
		),
	);

}
