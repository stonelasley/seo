<?php
App::uses('SeoUtil', 'Seo.Lib');
App::uses('AppController', 'Controller');
class SeoAppController extends AppController {

	public $helpers = array('Time');

	public $components = array(
		'Paginator',
		'Security',
		'Search.Prg'
	);

/**
 * Constructor
 *
 * @param CakeRequest $request Request object for this controller. Can be null for testing,
 *  but expect that features that use the request parameters will not work.
 * @param CakeResponse $response Response object for this controller.
 */
	public function __construct($request, $response) {
		$this->_setupComponents();
		parent::__construct($request, $response);
	}

/**
 * beforeFilter callback
 *
 * @return void
 */
	public function beforeFilter() {
		parent::beforeFilter();
		$this->_setupAdminPagination();
		$this->set('model', $this->modelClass);
	}

/**
 * Setup components based on plugin availability
 *
 * @return void
 * @link https://github.com/CakeDC/search
 */
	protected function _setupComponents() {
		if ($this->_pluginLoaded('Search', false)) {
			$this->components[] = 'Search.Prg';
		}
	}

/**
 * Wrapper for CakePlugin::loaded()
 * *
 * @param string $plugin
 * @param bool $exception
 * @throws MissingPluginException
 * @return boolean
 */
	protected function _pluginLoaded($plugin, $exception = true) {
		$result = CakePlugin::loaded($plugin);
		if ($exception === true && $result === false) {
			throw new MissingPluginException(array('plugin' => $plugin));
		}
		return $result;
	}

/**
 * Sets the default pagination settings up
 *
 * Override this method or the index() action directly if you want to change
 * pagination settings. admin_index()
 *
 * @return void
 */
	protected function _setupAdminPagination() {
		$this->Paginator->settings = array(
			'limit' => 20,
			'order' => array(
				$this->modelClass . '.created' => 'desc'
			)
		);
	}
}