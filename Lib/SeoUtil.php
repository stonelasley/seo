<?php
/**
 * Helper class to preform some basic tasks. 
 *
 * @author Nick Baker
 * @since 2.0
 * @license MIT
 */
class SeoUtil extends Object {

/**
 * Seo configurations stored in
 * app/config/seo.php
 * @var array
 */
	public static $configs = array();

/**
 * Load the SeoAppError class
 */
	public static function loadSeoError() {
		return require_once (dirname(__FILE__) . DS . 'Error' . DS . 'SeoAppError.php');
	}

/**
 * Utility method to call Seo.SeoBlacklist::isBanned($ip);
 */
	public static function isBanned($ip = null) {
		App::import('Model', 'Seo.SeoBlacklist');
		return ClassRegistry::init('Seo.SeoBlacklist')->isBanned($ip);
	}

/**
 * Testing getting a configuration option.
 * @param to $key
 * @internal param \to $key search for
 * @return mixed result of configuration key.
 * @access public
 */
	public static function getConfig($key) {
		if (isset(self::$configs[$key])) {
			return self::$configs[$key];
		}
		//try load configuration file and try again.
		try{
			Configure::load('seo');
		} catch(ConfigureException $e) {
			Configure::load('Seo.seo');
		}
		self::$configs = Configure::read('Seo');
		if (self::$configs[$key] = Configure::read("Seo.$key")) {
			return self::$configs[$key];
		}

		return null;
	}

/**
 * Return if the incoming URI is a regular expression
 * @param string
 * @return boolean if is regular expression (as two # marks)
 */
	public static function isRegEx($uri) {
		return preg_match('/^#(.*)#(.*)/', $uri) === 1;
	}

/**
 * Given a request, see if the uri matches.
 * @param string request
 * @param string uri
 * @return boolean if request matches the URI given
 */
	public static function requestMatch($request, $uri = null) {
		if ($uri) {
			if (self::isRegEx($uri) && preg_match($uri, $request)) {
				//Many To Many --using regular expression
				return true;
			} elseif (strpos($uri, '*') !== false) {
				//Many to One -- Check for  * wildcard in uri, if present only match up to the  * in the request.
				$uri = str_replace('*', '', $uri);
				if (strpos($request, $uri) === 0) {
					return true;
				}
			} elseif (strtolower($uri) == strtolower($request)) {
				//One to One
				return true;
			}
		}
		return false;
	}

}