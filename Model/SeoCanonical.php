<?php
class SeoCanonical extends SeoAppModel {

	public $name = 'SeoCanonical';

	public $displayField = 'canonical';

	public $validate = array(
		'seo_uri_id' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Uri required',
			),
		),
		'canonical' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'A canonical link must be entered',
			),
		),
		'is_active' => array(
			'boolean' => array(
				'rule' => array('boolean'),
				'message' => 'Your custom message here',
			),
		),
	);

/**
 * Default filter args for building search queries using the searchable behavior
 *
 * @var array
 */
	public $filterArgs = array (
		'canonical' => array ('type' => 'like'),
		'uri' => array('type' => 'like', 'field' => 'SeoUri.uri', 'encode' => true),
		'is_active' => array('type' => 'value', 'empty' => false),
	);

	public $belongsTo = array(
		'SeoUri' => array(
			'className' => 'Seo.SeoUri',
			'foreignKey' => 'seo_uri_id',
		)
	);

/**
 * Assign or create the url.
 */
	public function beforeSave($options = array()) {
		$this->createOrSetUri();
		return true;
	}

/**
 * Find the first canonical link that matches this requesting URI
 * @param string incoming reuqest uri
 * @return the first canonical link to match
 */
	public function findByUri($request = null) {
		return $this->field('canonical', array(
			"{$this->SeoUri->alias}.uri" => $request,
			"{$this->SeoUri->alias}.is_approved" => true,
			"{$this->alias}.is_active" => true,
		));
	}
}
