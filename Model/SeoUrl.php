<?php
App::uses('SeoUtil', 'Seo.Lib');
class SeoUrl extends SeoAppModel {

	public $name = 'SeoUrl';

	public $displayField = 'url';

	public $validate = array(
		'url' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Must not be empty',
			),
			'unique' => array(
				'rule' => array('isUnique'),
				'message' => 'Url already being used'
			)
		),
	);

/**
 * Default filter args for building search queries using the searchable behavior
 *import
 * @public array
 */
	public $filterArgs = array (
		'url' => array('type' => 'like'),
	);

/**
 * Configuration settings
 */
	public $settings = array();

/**
 * import
 *
 * Load the settings
 */
	public function __construct($id = false, $table = null, $ds = null) {
		parent::__construct($id, $table, $ds);
		$this->settings = SeoUtil::getConfig('levenshtein');
	}

/**
 * Import a set of valid URLS from a sitemap
 *
 * @param string $sitemapPath path to sitemap we want to parse defaults to webroot/site-map.xml
 * @param bool $clearAll
 * @param bool $verbose
 * @throws NotFoundException
 * @internal param \clear $boolean the set first, then import.
 * @internal param \verbose $boolean
 * @internal param \count $int of imported urls
 * @return int
 */
	public function import($sitemapPath = null, $clearAll = true, $verbose = false) {
		$count = 0;
		if ($this->settings['active']) {

			if (!file_exists($this->__getPathToSiteMap($sitemapPath))) {
				throw new NotFoundException("File not found.");
			}
			if ($clearAll) {
				$this->deleteAll(1);
			}

			$xml = simplexml_load_file($this->__getPathToSiteMap($sitemapPath));
			foreach ($xml->url as $url) {
				$this->clear();
				$saveData = array(
					'url' => parse_url((string)$url->loc, PHP_URL_PATH),
					'priority' => (string)$url->priority
				);
				if ($this->save($saveData)) {
					if ($verbose) {
						echo ".";
					}
					$count++;
				} elseif ($verbose) {
					echo "f";
					debug($this->validationErrors);
				}
			}
		}
		return $count;
	}
/**
 * Use levenshtein's distance to decide what "good" url is most closest to the incoming request
 *
 * @param string request
 * @return array of result 
 * - redirect the actually redirect to point to
 * - shortest how close this came
 */
	public function findRedirectByRequest($request) {
		if ($this->settings['active']) {
			$retval = array(
				'redirect' => '/',
				'shortest' => -1
			);

			//Run import if we have no urls to look at.
			if ($this->find('count') == 0) {
				if ($this->import() == 0) {
					return $retval;
				}
			}

			$urls = $this->find('all', array(
				'fields' => array('SeoUrl.url'),
				'recursive' => -1,
				'order' => 'SeoUrl.priority ASC'
			));

			foreach ($urls as $url) {
				//Less efficent to use constants, if they're all the same don't use them
				if ($this->settings['cost_add'] == $this->settings['cost_change'] && $this->settings['cost_change'] == $this->settings['cost_delete']) {
					$lev = levenshtein($request, $url['SeoUrl']['url']);
				} else {
					$lev = levenshtein($request, $url['SeoUrl']['url'], $this->settings['cost_add'], $this->settings['cost_change'], $this->settings['cost_delete']);
				}
				if ($lev <= $retval['shortest'] || $retval['shortest'] < 0) {
					$retval['redirect'] = $url['SeoUrl']['url'];
					$retval['shortest'] = $lev;
				}
				if ($retval['shortest'] < $this->settings['threshold'] || $lev == 0) {
					break;
				}
			}
			return $retval;
		}
		return false;
	}

/**
 * Get the file out of the source config
 *
 * @param $path
 * @return string file path to source.
 */
	private function __getPathToSiteMap($path) {
		if ($path === null) {
			return WWW_ROOT . DS . 'site-map.xml';
		} else {
			return $path;
		}
	}
}
