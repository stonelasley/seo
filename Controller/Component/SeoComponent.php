<?php
App::uses('SeoTitle', 'Seo.Model');
App::uses('SeoBlacklist', 'Seo.Model');
App::uses('SeoHoneypotVisit', 'Seo.Model');
App::uses('SeoAppComponent', 'Seo.Controller/Component');
class SeoComponent extends SeoAppComponent {

/**
 * SeoTitle Model
 */
	public $SeoTitle = null;

/**
 * SeoMetaTag Model
 */
	public $SeoMetaTag = null;

/**
 * SeoHoneypotVisit Model
 */
	public $SeoHoneypotVisit = null;

/**
 * SeoBlacklist Model
 */
	public $SeoBlacklist = null;

/**
 * CakePHP based URL to the honeypot action setup in config
 */
	public $honeyPot = null;

/**
 * CakePHP based URL to redirect the banned uesr
 */
	public $redirect = array('admin' => false, 'plugin' => 'seo', 'controller' => 'seo_blacklists', 'action' => 'banned');

/**
 * Constructor
 *
 * @param ComponentCollection $collection A ComponentCollection this component can use to lazy load its components
 * @param array $settings Array of configuration settings.
 */
	public function __construct(ComponentCollection $collection, $settings = array()) {
		parent::__construct($collection, $settings);
		$this->SeoBlacklist = ClassRegistry::init('Seo.SeoBlacklist');
		$this->SeoMetaTag = ClassRegistry::init('Seo.SeoMetaTag');
		$this->SeoHoneypotVisit = ClassRegistry::init('Seo.SeoHoneypotVisit');
		$this->SeoTitle = ClassRegistry::init('Seo.SeoTitle');
		$this->SeoCanonical = ClassRegistry::init('Seo.SeoCanonical');
	}

/**
 * Initialize the component, set the settings
 *
 * @param Controller $controller
 * @return void
 */
	public function initialize(Controller $controller) {
		$this->Controller = $controller;
		if (isset($this->settings['blacklist']) && $this->settings['blacklist'] === true) {
			if (!$this->isBanned()) {
				$this->honeyPot = $this->getConfig('honeyPot');
				$this->handleIfHoneyPot();
			}
		}
	}

/**
 * startup callback
 *
 * @param Controller $controller
 * @return void
 */
	public function startup(Controller $controller) {
		parent::startup($controller);
		if (isset($this->settings['titles']) && $this->settings['titles'] === true) {
			$this->getTitle();
		}
		if (isset($this->settings['meta_tags']) && $this->settings['meta_tags'] === true) {
			$this->getMetaTags();
		}
		if (isset($this->settings['canonical']) && $this->settings['canonical'] === true) {
			$this->getCanonical();
		}
	}

/**
 * Handle the banned user, decide if banned,
 * if so, redirect the user.
 *
 * @return boolean
 */
	public function isBanned() {
		if ($this->SeoBlacklist->isBanned()) {
			if ($this->Controller->request->here != Router::url($this->redirect)) {
				$this->Controller->redirect($this->redirect);
			}
			return true;
		}
		return false;
	}

/**
 * Handle if honeypot action.
 *
 * @return void
 */
	public function handleIfHoneyPot() {
		if ($this->Controller->request->here == Router::url($this->honeyPot)) {
			$this->SeoHoneypotVisit->add();
			if ($this->SeoHoneypotVisit->isTriggered()) {
				$this->SeoBlacklist->addToBanned();
				$this->isBanned();
			} else {
				$this->Controller->redirect('/');
			}
		}
	}

/**
 * Get Page Title
 *
 * @return string
 */
	public function getTitle() {
		$seoTitle = $this->SeoTitle->findTitleByUri($this->Controller->request->here);
		if ($seoTitle) {
			$title = $seoTitle['SeoTitle']['title'];
			$this->Controller->set('seoTitle', $title);
		}
	}

/**
 * Get Page Meta Tags
 *
 * @return array()
 */
	public function getMetaTags() {
		$metaTags = $this->SeoMetaTag->findAllTagsByUri($this->Controller->request->here);
		$retval = array();
		foreach ($metaTags as $tag) {
			$data = array();
			if ($tag['SeoMetaTag']['is_http_equiv']) {
				$data['http-equiv'] = $tag['SeoMetaTag']['name'];
			} else {
				$data['name'] = $tag['SeoMetaTag']['name'];
			}
			$data['content'] = $tag['SeoMetaTag']['content'];
			array_push($retval, $data);
		}
		$this->Controller->set('seoMetaTags', $retval);
	}

/**
 * Get Canonical urls
 *
 * @return string
 */
	public function getCanonical() {
		$full = true; // add to config
		$canonical = $this->SeoCanonical->findByUri($this->Controller->request->here);
		if ($canonical) {
			$path = Router::url($canonical, $full);
			$this->Controller->set('seoCanonical', $path);
		}
	}
}