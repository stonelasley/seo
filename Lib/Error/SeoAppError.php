<?php

App::uses('SeoUtil', 'Seo.Lib');
App::uses('CakeLog', 'Log');
App::uses('Controller', 'Controller');
App::uses('CakeResponse', 'Network');
App::uses('SeoUri', 'Seo.Model');

class SeoAppError {

	public $SeoRedirect = null;

	public $SeoStatusCode = null;

	public $SeoUrl = null;

	public $SeoUri = null;

/**
 * Overload constructor so we can test it properly
 */
	public function __construct($test = false) {
		$this->controller = new Controller(null, new CakeResponse);
	}

/**
 * Helper method for use in the application to catch 404 errors if needed
 * $this->cakeError('catch404');
 */
	public function catch404() {
		$this->__uriToStatusCode();
		$this->__uriToRedirect();
	}

/**
 * Update to levenshtien
 */
	public function runLevenshtein() {
		$this->__uriToLevenshtein();
	}

/**
 * Returns if the incomming request matches the seo_uri defined.
 * @param incomming request
 * @param uri
 * @return boolean
 */
	public function requestMatch($request, $uri) {
		return SeoUtil::requestMatch($request, $uri);
	}

/**
 * Go through the uri to StatusCode database and see if we've hit a match that we've setup
 * @param bool $test
 * @internal param \testing $if , return the status code instead of setting it.
 * @return mixed void normally, status code in testing mode
 */
	private function __uriToStatusCode($test = false) {
		$this->__loadModel('SeoStatusCode');
		$request = env('REQUEST_URI');
		$seoStatusCodes = $this->SeoStatusCode->findStatusCodeListByPriority();
		if (empty($seoStatusCodes) || !is_array($seoStatusCodes)) {
			return;
		}
		foreach ($seoStatusCodes as $statusCode) {
			$code = $statusCode['SeoStatusCode']['status_code'];
			$uri = $statusCode['SeoUri']['uri'];
			$updateHeader = $this->requestMatch($request, $uri);

			//Update the status code and exit
			if ($updateHeader) {
				if ($test) {
					return $code;
				}
				Configure::write('debug', 0);
				header("Status: $code " . $this->SeoStatusCode->codes[$code], true, $code);
				if ($code == 200) {
					echo '<!doctype html> 
					<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
						<head>
							<title>&nbsp;</title>
							<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
							<meta name="robots" content="noindex" />
						</head>
						<body></body>
					</html>';
				}
				die();
			}
		}
	}

/**
 * Go through the uri to redirect database and see if we've hit a 
 * 301 that we've setup.
 * @return void
 */
	private function __uriToRedirect() {
		$this->__loadModel('SeoRedirect');
		$request = env('REQUEST_URI');
		$seoRedirects = $this->SeoRedirect->findRedirectListByPriority();
		if (empty($seoRedirects) || !is_array($seoRedirects)) {
			return;
		}
		$runRedirects = false;
		foreach ($seoRedirects as $seoRedirect) {
			$uri = $seoRedirect['SeoUri']['uri'];
			$redirect = $seoRedirect['SeoRedirect']['redirect'];
			$callback = $seoRedirect['SeoRedirect']['callback'];

			if ($this->requestMatch($request, $uri)) {
				$runRedirects = true;
				if ($this->SeoRedirect->isRegEx($uri)) {
					$redirect = preg_replace($uri, $redirect, $request);
				}
			}

			//Run callback if we have one
			if ($runRedirects && isset($callback) && $callback) {
				if (strpos($callback, '::') !== false) {
					list($model, $method) = explode('::', $callback);
				} else {
					$method = $callback;
					$model = 'SeoRedirect';
				}
				$callbackRetVal = ClassRegistry::init($model)->$method($request);
				if ($callbackRetVal !== false) {
					$redirect = str_replace('{callback}', $callbackRetVal, $redirect);
				} else { //if we have false as the retval, do NOT run the redirect
					$runRedirects = false;
				}
			}

			//Run the redirect if we have one, and its not the same as it was coming in.
			if ($runRedirects) {
				if ($redirect != $request) {
					if (SeoUtil::getConfig('log')) {
						CakeLog::write('seo_redirects', "SeoRedirect ID {$seoRedirect['SeoRedirect']['id']} : $request matched $uri redirecting to $redirect");
					}
					$this->controller->redirect($redirect, 301);
				} else {
					if (SeoUtil::getConfig('log')) {
						CakeLog::write('seo_redirects', "Redirect loop detected! request:\n $request\n	uri: $uri\n	redirect: $redirect\n	callback: $callback\n");
					}
				}
				return;
			}
		}
	}

/**
 * Go through the uri to levenshtein url database and find the closest redirect based in sitemap 
 * @return void
 */
	private function __uriToLevenshtein() {
		$levconfig = SeoUtil::getConfig('levenshtein');
		if (!$levconfig['active']) {
			return;
		}

		$this->__loadModel('SeoUrl');
		$request = env('REQUEST_URI');
		$redirect = $this->SeoUrl->findRedirectByRequest($request);
		if ($redirect['redirect'] != $request) {
			if (SeoUtil::getConfig('log')) {
				CakeLog::write('seo_levenshtein', "Levenshtein Redirect $request to {$redirect['redirect']} score {$redirect['shortest']}");
			}
			$this->controller->redirect($redirect['redirect'], 301);
		}
	}

/**
 * Load the SeoRedirect Model if it's not already loaded.
 * @param $model
 * @return void
 */
	private function __loadModel($model) {
		if (!$this->$model) {
			$this->$model = ClassRegistry::init("Seo.$model");
		}
	}

}

/**
 * SeoExceptionHandler
 * @version 6.0
 * @author Nick Baker
 */
class SeoExceptionHandler extends HttpException {

	public static function handle($error, $message = null) {
		$SeoAppError = new SeoAppError();
		$SeoAppError->catch404();
		if ($error->code == 404) {
			$SeoAppError->runLevenshtein();
		}

		$text = $message ? $message : $error->message;
		CakeLog::write('error' . $error->code, $text . '\n\r' . $error->getTraceAsString());
		ErrorHandler::handleException($error);
	}
}
