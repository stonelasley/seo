<?php

/**
 * AllTests class
 *
 * This test group will run all tests.
 *
 */
class AllTests extends CakeTestSuite {

/**
 * Adds all test directories
 *
 * @return void
 */
	public static function suite() {
		$suite = new CakeTestSuite('All Seo Tests');
		$path = dirname(__FILE__);
		$suite->addTestDirectoryRecursive($path . DS . 'Controller');
		$suite->addTestDirectoryRecursive($path . DS . 'Model');
		$suite->addTestDirectoryRecursive($path . DS . 'Lib');
		$suite->addTestDirectoryRecursive($path . DS . 'helpers');
		return $suite;
	}
}