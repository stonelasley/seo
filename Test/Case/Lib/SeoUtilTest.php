<?php
App::uses('SeoUtil', 'Seo.Lib');
class SeoUtilTest extends CakeTestCase {

	public function testLoad() {
		$this->assertEquals(1, SeoUtil::loadSeoError());
	}

}
