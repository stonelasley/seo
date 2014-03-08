<?php
/**
 * SeoUriFixture
 *
 */
class SeoUriFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 36, 'key' => 'primary', 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'uri' => array('type' => 'string', 'null' => true, 'default' => null, 'key' => 'unique', 'collate' => 'utf8_bin', 'charset' => 'utf8'),
		'is_approved' => array('type' => 'boolean', 'null' => false, 'default' => '1', 'key' => 'index'),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'SEO_URIS_UNIQUE_URI' => array('column' => 'uri', 'unique' => 1),
			'SEO_URIS_IS_APPROVED' => array('column' => 'is_approved', 'unique' => 0)
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
			'id' => '531288d1-4c4c-46ab-b1e2-0bc4ccb469e7',
			'uri' => '/',
			'is_approved' => 1,
			'created' => '2014-03-01 18:26:41',
			'modified' => '2014-03-01 18:58:32'
		),
		array(
			'id' => '5312925f-d9e8-41c5-8d10-0bddccb469e7',
			'uri' => '/dogs',
			'is_approved' => 1,
			'created' => '2014-03-01 19:07:27',
			'modified' => '2014-03-01 19:07:27'
		),
		array(
			'id' => '53139850-c644-4836-905c-0bc5ccb469e7',
			'uri' => '/mickey boy',
			'is_approved' => 1,
			'created' => '2014-03-02 13:45:04',
			'modified' => '2014-03-02 13:45:04'
		),
		array(
			'id' => '5313a493-7274-413e-aa8b-0bc2ccb469e7',
			'uri' => '/pond',
			'is_approved' => 1,
			'created' => '2014-03-02 14:37:23',
			'modified' => '2014-03-02 14:37:23'
		),
		array(
			'id' => '5313a5c0-51f0-49a3-a68b-0c05ccb469e7',
			'uri' => '/index',
			'is_approved' => 1,
			'created' => '2014-03-02 14:42:24',
			'modified' => '2014-03-02 14:42:24'
		),
		array(
			'id' => '5313a904-ca7c-4cee-9aed-0c05ccb469e7',
			'uri' => '/doggies',
			'is_approved' => 0,
			'created' => '2014-03-02 14:56:20',
			'modified' => '2014-03-02 15:31:34'
		),
		array(
			'id' => '5313a904-abcd-4cee-9aed-0c05ccb469e7',
			'uri' => '/posts',
			'is_approved' => 0,
			'created' => '2014-03-02 14:56:20',
			'modified' => '2014-03-02 15:31:34'
		),
	);

}
