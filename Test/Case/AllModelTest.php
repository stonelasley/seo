<?php
class AllModelsTests extends CakeTestSuite {

/**
 * Adds all test directories
 *
 * @return void
 */
	public static function suite() {
		$suite = new CakeTestSuite('All Tests');
		$path = dirname(__FILE__);
		$suite->addTestDirectoryRecursive($path . DS . 'Model');
		return $suite;
	}
}