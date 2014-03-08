[![Build Status](https://travis-ci.org/stonelasley/seo.png?branch=master)](https://travis-ci.org/stonelasley/seo) [![Coverage Status](https://coveralls.io/repos/stonelasley/CakePHP-Seo-Plugin/badge.png?branch=master)](https://coveralls.io/r/stonelasley/seo?branch=master) [![Total Downloads](https://poser.pugx.org/stonelasley/seo/d/total.png)](https://packagist.org/packages/stonelasley/seo) [![Latest Stable Version](https://poser.pugx.org/stonelasley/CakePHP-Seo-Plugin/v/stable.png)](https://packagist.org/packages/stonelasley/seo)

# CakePHP-Seo-Plugin
 * Authors: Nick Baker, Alan Blount, Stone Lasley
 * Originally forked from [Using [https://github.com/webtechnick/CakePHP-Seo-Plugin](https://github.com/webtechnick/CakePHP-Seo-Plugin)]

## Requirements

* CakePHP 2.x
* PHP 5.3+

## Installation

_[Using [Composer](http://getcomposer.org/)]_

Add the plugin to your project's `composer.json` - something like this:

```composer
  {
    "require": {
      "stonelasley/seo": "dev-master"
    }
  }
```

Because this plugin has the type `cakephp-plugin` set in its own `composer.json`, Composer will install it inside your `/Plugins` directory, rather than in the usual vendors file. It is recommended that you add `/Plugins/CakePHP-Seo-Plugin` to your .gitignore file. (Why? [read this](http://getcomposer.org/doc/faqs/should-i-commit-the-dependencies-in-my-vendor-directory.md).)

_[Manual]_

* Download this: [http://github.com/stonelasley/CakePHP-Seo-Plugin/zipball/master](http://github.com/stonelasley/CakePHP-Seo-Plugin/zipball/master)
* Unzip that download.
* Copy the resulting folder to `app/Plugin`
* Rename the folder you just copied to `CakePHP-Seo-Plugin`

_[GIT Submodule]_

In your app directory type:

```bash
  git submodule add -b master git://github.com/stonelasley/seo.git Plugin/Seo
  git submodule init
  git submodule update
```

_[GIT Clone]_

In your `Plugin` directory type:

    git clone -b master git://github.com/stonelasley/seo.git Seo

### Enable plugin

In 2.0 you need to enable the plugin in your `app/Config/bootstrap.php` file:

    CakePlugin::load('CakePHP-Seo-Plugin');

If you are already using `CakePlugin::loadAll();`, then this is not necessary.


## Features

Complete tool for all your CakePHP Search Engine Optimization needs

* Easy yet powerful 301 redirect tools only loaded when a 404 would otherwise occur
* Highly configurable and intelligent 404 deep url guessing utilizing levenshtein's distance and your sitemap.xml
* Highly configurable and customizable Meta Tags for any incoming URI
* Title tag overwrites based on URI
* Custom Status Codes based on URI
* Scrapper Banning administration, complete with honeyPot baiting for scrappers to ban themselves.
* Google Analytics AB Testing Management based on URIs

	
## Setup

Create the file `app/config/seo.php` with the following configurations like so:

	<?php
	$config = array(
		'Seo' => array(
			'approverEmail' => 'nick@example.com',
			'replyEmail' => 'noreply@example.com',
			'parentDomain' => 'http://www.example.com',
			'triggerCount' => 2,
			'timeBetweenTriggers' => 60 * 60 * 24, //seconds
			'aggressive' => true, //if false, log affenders for later review instead of autobanning
			'honeyPot' => array('admin' => false, 'plugin' => 'seo', 'controller' => 'seo_blacklists', 'action' => 'honeypot'),
			'log' => true,
			'cacheEngine' => false, // optionally cache things to save on DB requests - eg: 'default'
			'levenshtein' => array(
				'active' => false,
				'threshold' => 5, //-1 to always find the closest match
				'cost_add' => 1, //cost to add a character, higher the amount the less you can add to find a match
				'cost_change' => 1, //cost to change a character, higher the amount the less you can change to find a match
				'cost_delete' => 1, //cost to delete a character, higher the ammount the less you can delete to find a match 
				'source' => '/sitemap.xml' //URL to list of urls, a sitemap
			),
			'abTesting' => array(
				'category' => 'ABTest', //Category for your ABTesting in Google Analytics
				'scope' => 3, //Scope for your ABTesting in Google Analytics
				'legacy' => false, //Uses Legacy verion of Google Analytics JS code pageTracker._setCustomVar(...)
				'session' => true, //Uses CakeSession to serve same test to uses who have seen them.
			)
		)
	);
	?>

## Usage

## SEO Redirect/Status Code Quick Start
update file `app/Config/core.php` with the following:

	<?php
		Configure::write('Exception', array(
				'handler' => 'SeoExceptionHandler::handle',
				'renderer' => 'ExceptionRenderer',
				'log' => true
		));
	?>
	
update file `app/Config/bootstrap.php` with the following:

	require_once(APP . 'Plugin' . DS . 'Seo' . DS . 'Lib' . DS . 'Error' . DS . 'SeoAppError.php');
	
	
	
### Add Redirects	
`http://www.example.com/admin/seo/seo_redirects/`

### Add Status Code
`http://www.example.com/admin/seo/seo_status_codes/`

NOTE: Special case Status Code 200 will return minimum bandwidth noindex robots page, for alternative url killing (410 alternative)


## SEO Meta Tags Quick Start

Include the `Seo.Seo` Helper to your `AppController.php`:

	var $helpers = array('Seo.Seo');

Alter your layout to include the Seo Meta Tags in the head of your layout

	<head>
		<!-- other head items -->
		<?php echo $this->Seo->metaTags(); ?>
	</head>

### Add Meta Tags

`http://www.example.com/admin/seo/seo_meta_tags`


## SEO Titles Quick Start

Include the `Seo.Seo` Helper to your `AppController.php`:

  var $helpers = array('Seo.Seo');

Alter your layout to include the Seo Title in the head of your layout

	<head>
		<!-- other head items -->
		<?php echo $this->Seo->title($title_for_layout); ?>
	</head>

### Add Title Tags

`http://www.example.com/admin/seo/seo_titles`


## SEO Canonical Quick Start

Include the `Seo.Seo` Helper to your `AppController.php`:

  var $helpers = array('Seo.Seo');

Alter your layout to include the Seo Canonical in the head of your layout

	<head>
		<!-- other head items -->
		<?php echo $this->Seo->canonical(); ?>
	</head>

### Add Canonical Links

`http://www.example.com/admin/seo/seo_canonicals`

## SEO BlackList Quick Start

Include The `Seo.BlackList` Component in your `AppController.php`:

	var $components = array('Seo.BlackList');

Start adding honeypot links in and around your application to bait malicious content grabbers

	<?php echo $this->Seo->honeyPot(); ?>

Update your `robots.txt` to exclude `/seo/` from being spidered.  All legitimate spiders will ignore the honeyPot

	User-agent: *
	Disallow: /seo/

### Add/Manage Banned IPs

`http://www.example.com/admin/seo/seo_blacklists`


## SEO AB Testing Quick Start

Include the `Seo.Seo` Helper and the `Seo.ABTest` Component to your `AppController.php`: 

	var $helpers = array('Seo.Seo');
	var $components = array('Seo.ABTest');

In your GA code on your site add the line like so:

	<script type="text/javascript">
		<!-- GA Items -->
		var pageTracker = _gat._getTracker('UA-SOMEKEY');
		<?php echo $this->Seo->getABTestJS(); ?>
	</script>
	
In your `AppController.php`, to test if you're on a testable page and serve it do something like this:

	public function beforeFilter(){
		if($test = $this->ABTest->getTest()){
			//Do things specific to this test
			$this->set('ABTest', $test);
			$this->view = $test['SeoABTest']['slug'];
		}
		return parent::beforeFilter();
	}
	
ProTip: For debuging in your controller before going live in GA set the debug flag to true, this will return tests that aren't active yet.

	$test = $this->SeoABTest->getTest(array('debug' => true));

### Add AB Tests

`http://www.example.com/admin/seo/seo_a_b_tests`

ProTip: By setting the ABTest to debug, it will return true in your controller, but you won't be tracking the GA code.

 ## TODO

 ## License

 The MIT License (MIT)

 Permission is hereby granted, free of charge, to any person obtaining a copy
 of this software and associated documentation files (the "Software"), to deal
 in the Software without restriction, including without limitation the rights
 to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 copies of the Software, and to permit persons to whom the Software is
 furnished to do so, subject to the following conditions:

 The above copyright notice and this permission notice shall be included in
 all copies or substantial portions of the Software.

 THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 THE SOFTWARE.

