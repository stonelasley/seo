<?php
App::uses('SeoUtil', 'Seo.Lib');
class BlackListComponent extends Component {

/**
 * CakePHP based URL to redirect the banned uesr
 */
	public $redirect = array('admin' => false, 'plugin' => 'seo', 'controller' => 'seo_blacklists', 'action' => 'banned');

/**
 * CakePHP based URL to the honeypot action setup in config
 */
	public $honeyPot = null;

/**
 * Error log
 */
	public $errors = array();

/**
 * Placeholder for the SeoBlacklist Model
 */
	public $SeoBlacklist = null;

/**
 * Placeholder for the SeoHoneypotVisit Model
 */
	public $SeoHoneypotVisit = null;

/**
 * Initialize the component, set the settings
 */
	public function initialize(Controller $controller) {
		$this->Controller = $controller;
		$this->honeyPot = SeoUtil::getConfig('honeyPot');

		if (!$this->isBanned()) {
			$this->handleIfHoneyPot();
		}
	}

/**
 * Handle the banned user, decide if banned,
 * if so, redirect the user.
 */
	public function isBanned() {
		$this->__loadModel('SeoBlacklist');
		if ($this->SeoBlacklist->isBanned()) {
			if ($this->Controller->here != Router::url($this->redirect)) {
				$this->Controller->redirect($this->redirect);
			}
			return true;
		}
		return false;
	}

/**
 * Handle if honeypot action.
 */
	public function handleIfHoneyPot() {
		if ($this->Controller->here == Router::url($this->honeyPot)) {
			$this->__loadModel('SeoHoneypotVisit');
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
 * Load a plugin model 
 * @param string modelname
 * @return void
 */
	private function __loadModel($model = null) {
		if ($model && $this->$model == null) {
			App::import('Model', "Seo.$model");
			$this->$model = ClassRegistry::init("Seo.$model");
		}
	}
}