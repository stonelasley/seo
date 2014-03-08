<?php
/**
 * All CakePHP-Seo-Plugin plugin tests
 */
class AllCakePHPSeoPluginTest extends CakeTestCase {

/**
 * Suite define the tests for this plugin
 *
 * @return void
 */
	public static function suite() {
		$suite = new CakeTestSuite('All CakePHP-Seo-Plugin test');

		$path = CakePlugin::path('Seo') . 'Test' . DS . 'Case' . DS;
		$suite->addTestDirectoryRecursive($path);

		return $suite;
	}

}
