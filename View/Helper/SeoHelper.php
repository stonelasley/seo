<?php
/**
 * Seo Helper, handles title tags and meta tags
 * @author Nick Baker <nick@webtechnick.com>
 * @since 4.5
 * @license MIT
 */
App::uses('SeoUtil', 'Seo.Lib');
App::uses('SeoUri', 'Seo.Model');
App::uses('SeoTitle', 'Seo.Model');
App::uses('SeoCanonical', 'Seo.Model');
class SeoHelper extends AppHelper {

	public $helpers = array('Html');

	public $SeoTitle = null;

	public $SeoCanonical = null;

	public $SeoABTest = null;

	public $honeyPotId = 1;

/**
 * Show the meta tags designated for this uri
 * @param array of name => content meta tags to display
 * @return string of meta tags to show.
 */
	public function metaTags($metaData = array()) {
		$markup = '';
		if (!empty($metaData)) {
			foreach ($metaData as $tag) {
				$name = 'name';
				if (isset($tag['http-equiv'])) {
					$name = 'http-equiv';
				}
					$markup .= $this->Html->meta(array($name => $tag[$name], 'content' => $tag['content']));
			}
		}
		return $markup;
	}

/**
 * Return a canonical link tag for SEO purposes
 * Utility method
 * @param router friendly URL
 * @return HTMlElement of canonical link or empty string if none found/used
 */
	public function canonical($path = null) {
		if ($path) {
			return $this->Html->tag('link', null, array('rel' => 'canonical', 'href' => $path));
		}
		return '';
	}

/**
 * Show a honeypot link
 * to bait scrappers to click on for autobanning
 * @param string title for link
 * @param array of options
 * @return HtmlLink to honeypot action
 */
	public function honeyPot($title = 'Click Here', $options = array()) {
		$options = array_merge(
			array(
				'rel' => 'nofollow',
				'id' => 'honeypot-' . $this->nextId()
			),
			$options
		);

		$link = $this->Html->link(
			$title,
			SeoUtil::getConfig('honeyPot'),
			$options
		);

		$javascript = $this->Html->scriptBlock("
			document.getElementById('{$options['id']}').style.display = 'none';
			document.getElementById('{$options['id']}').style.zIndex = -1;
		");

		return $link . $javascript;
	}

/**
 * Find the title tag related to this request and output the result.
 * @param string default title tag
 * @return string title for requested uri
 */
	public function title($title = '') {
		return $this->Html->tag('title', $title);
	}

/**
 * Return the next Id to show.
 */
	public function nextId() {
		return $this->honeyPotId++;
	}

/**
 * Return the ABTest GA code on current request
 * @param mixed test to show code for (if null, will check the View for ABTest publiciable and use that.
 * @param array of options
 *  - publicname the publiciable named of the legacy pageTracker publiciable (default pageTracker). Only used when legacy is turn on in config
 *  - scriptBlock -- boolean if true will return scriptBlock of javascript (default false)
 * @return string ga script test, or null
 */
	public function getABTestJS($test = null, $options = array()) {
		$localOptions = array(
			'publicname' => 'pageTracker',
			'scriptBlock' => false,
		);
		$options = array_merge($localOptions, $options);

		debug($options);

		if ($test && isset($test['SeoABTest']['slug'])) {
			$category = $this->getConfig('abTesting.category');
			$scope = $this->getConfig('abTesting.scope');
			$slot = $this->getConfig('abTesting.slot');
			if ($this->getConfig('abTesting.legacy')) {
				$retval = "{$options['publicname']}._setCustompublic($slot,'$category','{$test['SeoABTest']['slug']}',$scope);";
			} else {
				$retval = "_gaq.push(['_setCustompublic',$slot,'$category','{$test['SeoABTest']['slug']}',$scope]);";
			}
			if ($options['scriptBlock']) {
				return $this->Html->scriptBlock($retval);
			}
			return $retval;
		}
		return null;
	}


/**
 * Redmine link helper
 *
 * @param null $ticketId
 * @return null
 */
	public function redmineLink($ticketId = null) {
		if ($ticketId) {
			return $this->Html->link($ticketId, $this->getConfig('abTesting.redmine') . $ticketId, array('class' => 'btn btn-mini btn-info', 'target' => '_blank'));
		}
		return null;
	}

/**
 * Wrapper for SeoUtil getConfig
 *
 * @param $key
 * @return mixed
 */
	public function getConfig($key) {
		return SeoUtil::getConfig($key);
	}

}