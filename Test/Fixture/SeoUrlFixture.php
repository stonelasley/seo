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
			'id' => '53126830-58dc-440a-96ae-0bc1ccb469e7',
			'url' => '/',
			'priority' => '1',
			'created' => '2014-03-01 16:07:28',
			'modified' => '2014-03-01 16:07:28'
		),
		array(
			'id' => '5312c1dc-5650-439f-b0e8-0c07ccb469e7',
			'url' => '/dogs',
			'priority' => '1',
			'created' => '2014-03-01 22:30:04',
			'modified' => '2014-03-02 15:50:22'
		),
		array(
			'id' => '5313b402-4834-4658-8b6b-0bddccb469e7',
			'url' => '/test',
			'priority' => '1',
			'created' => '2014-03-02 15:43:14',
			'modified' => '2014-03-02 15:43:14'
		),
	);

}
