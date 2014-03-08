<?php
class SeoUrlsShell extends AppShell {

	public $uses = array('Seo.SeoUrl');

	public function main() {
		$this->out("SeoUrl Shell");
		$this->hr();
		$this->help();
	}

	public function help() {
		$this->out(" cake seo_urls import                  Import from the source in config");
		$this->out(" cake seo_urls add <url> <priorty>     Add a url to use as levenshtien");
	}

	public function import() {
		$this->out("Importing.");
		$count = $this->SeoUrl->import(null, true, true);
		$this->out();
		$this->out("Import finished. $count Imported.");
	}

	public function add() {
		$url = array_shift($this->args);
		$priority = array_shift($this->args);
		if (!$url) {
			$this->_errorAndExit("Url not set, please set a url.");
		}
		if (!$priority) {
			$this->_errorAndExit("Priority not set, please set a priority.\n\n cake seo_urls add $url 1");
		}
		$saveData = array(
			'url' => $url,
			'priority' => $priority
		);
		if ($this->SeoUrl->hasAny(array('SeoUrl.url' => $url))) {
			$saveData['id'] = $this->SeoUrl->field('id', array('SeoUrl.url' => $url));
		}
		$this->SeoUrl->clear();
		if ($this->SeoUrl->save($saveData)) {
			$this->out("$url $priority added.");
		} else {
			$this->out("Errors");
			print_r($this->SeoUrl->validationErrors);
			$this->out();
		}
	}

/**
 * Private method to output the error and exit(1)
 * @param string message to output
 * @return void
 * @access private
 */
	protected function _errorAndExit($message) {
		$this->out("Error: $message");
		exit(1);
	}
}