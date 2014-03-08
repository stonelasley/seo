<?php
class InitializeSeoTables extends CakeMigration {

/**
 * Migration description
 *
 * @var string
 * @access public
 */
	public $description = '';

/**
 * Actions to be performed
 *
 * @var array $migration
 * @access public
 */
	public $migration = array (
		'up' => array (
			'create_table' => array (
				'seo_a_b_tests' => array (
					'id' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 36, 'key' => 'primary'),
					'seo_uri_id' => array ('type' => 'string', 'null' => false, 'default' => null, 'length' => 36, 'key' => 'index'),
					'is_active' => array ('type' => 'boolean', 'null' => false, 'default' => '1', 'key' => 'index'),
					'slug' => array ('type' => 'string', 'null' => false, 'default' => null, 'length' => 50, 'key' => 'unique', 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
					'roll' => array ('type' => 'string', 'null' => false, 'default' => null, 'length' => 200, 'collate' => 'utf8_general_ci', 'comment' => 'int based roll or Model::function callback', 'charset' => 'utf8'),
					'priority' => array ('type' => 'integer', 'null' => false, 'default' => '999', 'length' => 4, 'key' => 'index', 'comment' => 'lower the priority, the more priority it has over the other tests.'),
					'redmine' => array ('type' => 'integer', 'null' => true, 'default' => null, 'comment' => 'redmine ticket id'),
					'description' => array ('type' => 'text', 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
					'start_date' => array ('type' => 'date', 'null' => true, 'default' => null, 'key' => 'index', 'comment' => 'if null, we ignore it.'),
					'end_date' => array ('type' => 'date', 'null' => true, 'default' => null, 'key' => 'index', 'comment' => 'if null, we ignore it.'),
					'created' => array ('type' => 'datetime', 'null' => true, 'default' => null),
					'modified' => array ('type' => 'datetime', 'null' => true, 'default' => null),
					'indexes' => array (
						'PRIMARY' => array ('column' => 'id', 'unique' => 1),
						'SEO_AB_TEST_SLUG' => array ('column' => 'slug', 'unique' => 1),
						'SEO_AB_TEST_SEO_URI_ID' => array ('column' => 'seo_uri_id', 'unique' => 0),
						'SEO_AB_TEST_IS_ACTIVE' => array ('column' => 'is_active', 'unique' => 0),
						'SEO_AB_TEST_PRIORITY' => array ('column' => 'priority', 'unique' => 0),
						'SEO_AB_TEST_END_DATE' => array ('column' => 'end_date', 'unique' => 0),
						'SEO_AB_TEST_START_DATE' => array ('column' => 'start_date', 'unique' => 0)
					),
					'tableParameters' => array ('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'MyISAM')
				),
				'seo_blacklists' => array (
					'id' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 36, 'key' => 'primary'),
					'ip_range_start' => array ('type' => 'biginteger', 'null' => false, 'default' => null, 'key' => 'index'),
					'ip_range_end' => array ('type' => 'biginteger', 'null' => false, 'default' => null, 'key' => 'index'),
					'note' => array ('type' => 'text', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
					'created' => array ('type' => 'datetime', 'null' => true, 'default' => null),
					'modified' => array ('type' => 'datetime', 'null' => true, 'default' => null),
					'is_active' => array ('type' => 'boolean', 'null' => false, 'default' => '1'),
					'indexes' => array (
						'PRIMARY' => array ('column' => 'id', 'unique' => 1),
						'SEO_BLACKLISTS_IP_START' => array ('column' => 'ip_range_start', 'unique' => 0),
						'SEO_BLACKLISTS_IP_END' => array ('column' => 'ip_range_end', 'unique' => 0)
					),
					'tableParameters' => array ('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'MyISAM')
				),
				'seo_canonicals' => array (
					'id' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 36, 'key' => 'primary'),
					'seo_uri_id' => array ('type' => 'string', 'null' => false, 'default' => null, 'length' => 36, 'key' => 'index'),
					'canonical' => array ('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
					'is_active' => array ('type' => 'boolean', 'null' => false, 'default' => '1'),
					'created' => array ('type' => 'datetime', 'null' => true, 'default' => null),
					'modified' => array ('type' => 'datetime', 'null' => true, 'default' => null),
					'indexes' => array (
						'PRIMARY' => array ('column' => 'id', 'unique' => 1),
						'SEO_CANONICALS_SEO_URI_ID' => array ('column' => 'seo_uri_id', 'unique' => 0)
					),
					'tableParameters' => array ('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'MyISAM')
				),
				'seo_honeypot_visits' => array (
					'id' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 36, 'key' => 'primary'),
					'ip' => array ('type' => 'biginteger', 'null' => false, 'default' => null, 'key' => 'index'),
					'created' => array ('type' => 'datetime', 'null' => true, 'default' => null),
					'indexes' => array (
						'PRIMARY' => array ('column' => 'id', 'unique' => 1),
						'SEO_HONEYPOT_IP' => array ('column' => 'ip', 'unique' => 0)
					),
					'tableParameters' => array ('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'MyISAM')
				),
				'seo_meta_tags' => array (
					'id' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 36, 'key' => 'primary'),
					'seo_uri_id' => array ('type' => 'string', 'null' => false, 'default' => null, 'length' => 36, 'key' => 'index'),
					'name' => array ('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
					'content' => array ('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
					'is_http_equiv' => array ('type' => 'boolean', 'null' => false, 'default' => '0'),
					'created' => array ('type' => 'datetime', 'null' => true, 'default' => null),
					'modified' => array ('type' => 'datetime', 'null' => true, 'default' => null),
					'indexes' => array (
						'PRIMARY' => array ('column' => 'id', 'unique' => 1),
						'SEO_META_TAGS_SEO_URI_ID' => array ('column' => 'seo_uri_id', 'unique' => 0)
					),
					'tableParameters' => array ('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'MyISAM')
				),
				'seo_redirects' => array (
					'id' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 36, 'key' => 'primary'),
					'seo_uri_id' => array ('type' => 'string', 'null' => false, 'default' => null, 'length' => 36, 'key' => 'index'),
					'redirect' => array ('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
					'priority' => array ('type' => 'integer', 'null' => false, 'default' => '100'),
					'is_active' => array ('type' => 'boolean', 'null' => false, 'default' => '1'),
					'callback' => array ('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
					'created' => array ('type' => 'datetime', 'null' => true, 'default' => null),
					'modified' => array ('type' => 'datetime', 'null' => true, 'default' => null),
					'indexes' => array (
						'PRIMARY' => array ('column' => 'id', 'unique' => 1),
						'SEO_REDIRECTS_SEO_URL_ID' => array ('column' => 'seo_uri_id', 'unique' => 0)
					),
					'tableParameters' => array ('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'MyISAM')
				),
				'seo_search_terms' => array (
					'id' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 36, 'key' => 'primary'),
					'term' => array ('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => 'The term found by Google', 'charset' => 'utf8'),
					'uri' => array ('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => 'The URL this term points to', 'charset' => 'utf8'),
					'count' => array ('type' => 'integer', 'null' => false, 'default' => null, 'comment' => 'how many times this term has been searched for'),
					'created' => array ('type' => 'datetime', 'null' => true, 'default' => null),
					'indexes' => array (
						'PRIMARY' => array ('column' => 'id', 'unique' => 1)
					),
					'tableParameters' => array ('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'MyISAM')
				),
				'seo_status_codes' => array (
					'id' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 36, 'key' => 'primary'),
					'seo_uri_id' => array ('type' => 'string', 'null' => false, 'default' => null, 'length' => 36, 'key' => 'index'),
					'status_code' => array ('type' => 'integer', 'null' => false, 'default' => null, 'length' => 3),
					'priority' => array ('type' => 'integer', 'null' => false, 'default' => '100', 'length' => 4),
					'is_active' => array ('type' => 'boolean', 'null' => false, 'default' => '1'),
					'created' => array ('type' => 'datetime', 'null' => true, 'default' => null),
					'modified' => array ('type' => 'datetime', 'null' => true, 'default' => null),
					'indexes' => array (
						'PRIMARY' => array ('column' => 'id', 'unique' => 1),
						'SEO_STATUS_CODES_SEO_URI_ID' => array ('column' => 'seo_uri_id', 'unique' => 0)
					),
					'tableParameters' => array ('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'MyISAM')
				),
				'seo_titles' => array (
					'id' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 36, 'key' => 'primary'),
					'seo_uri_id' => array ('type' => 'string', 'null' => false, 'default' => null, 'length' => 36, 'key' => 'index'),
					'title' => array ('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
					'created' => array ('type' => 'datetime', 'null' => true, 'default' => null),
					'modified' => array ('type' => 'datetime', 'null' => true, 'default' => null),
					'indexes' => array (
						'PRIMARY' => array ('column' => 'id', 'unique' => 1),
						'SEO_TITLES_SEO_URI_ID' => array ('column' => 'seo_uri_id', 'unique' => 1)
					),
					'tableParameters' => array ('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'MyISAM')
				),
				'seo_uris' => array (
					'id' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 36, 'key' => 'primary'),
					'uri' => array ('type' => 'string', 'null' => true, 'default' => null, 'key' => 'unique', 'collate' => 'utf8_bin', 'charset' => 'utf8'),
					'is_approved' => array ('type' => 'boolean', 'null' => false, 'default' => '1', 'key' => 'index'),
					'created' => array ('type' => 'datetime', 'null' => true, 'default' => null),
					'modified' => array ('type' => 'datetime', 'null' => true, 'default' => null),
					'indexes' => array (
						'PRIMARY' => array ('column' => 'id', 'unique' => 1),
						'SEO_URIS_UNIQUE_URI' => array ('column' => 'uri', 'unique' => 1),
						'SEO_URIS_IS_APPROVED' => array ('column' => 'is_approved', 'unique' => 0)
					),
					'tableParameters' => array ('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'MyISAM')
				),
				'seo_urls' => array (
					'id' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 36, 'key' => 'primary'),
					'url' => array ('type' => 'string', 'null' => false, 'default' => null, 'key' => 'unique', 'collate' => 'utf8_bin', 'charset' => 'utf8'),
					'priority' => array ('type' => 'float', 'null' => false, 'default' => null, 'key' => 'index'),
					'created' => array ('type' => 'datetime', 'null' => true, 'default' => null),
					'modified' => array ('type' => 'datetime', 'null' => true, 'default' => null),
					'indexes' => array (
						'PRIMARY' => array ('column' => 'id', 'unique' => 1),
						'SEO_URLS_UNIQUE_URL' => array ('column' => 'url', 'unique' => 1),
						'SEO_URLS_PRIORITY' => array ('column' => 'priority', 'unique' => 0)
					),
					'tableParameters' => array ('charset' => 'utf8', 'collate' => 'utf8_bin', 'engine' => 'MyISAM')
				),
			)
		),
		'down' => array (
			'drop_table' => array (
				'seo_a_b_tests',
				'seo_blacklists',
				'seo_canonicals',
				'seo_honeypot_visits',
				'seo_meta_tags',
				'seo_redirects',
				'seo_search_terms',
				'seo_status_codes',
				'seo_titles',
				'seo_uris',
				'seo_urls'
			),
		)
	);

/**
 * Before migration callback
 *
 * @param string $direction, up or down direction of migration process
 *
 * @return boolean Should process continue
 * @access public
 */
	public function before($direction) {
		return true;
	}

/**
 * After migration callback
 *
 * @param string $direction, up or down direction of migration process
 *
 * @return boolean Should process continue
 * @access public
 */
	public function after($direction) {
		return true;
	}
}
