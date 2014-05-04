<?php
App::uses('Seo.Lib', 'SeoUtil');
App::uses('Component', 'Controller');
class SeoAppComponent extends Component {

/**
 * Read Configuration
 */
	public function getConfig($value = '') {
		return SeoUtil::getConfig($value);
	}
}