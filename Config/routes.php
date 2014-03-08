<?php
Router::connect(
	'/admin/seo/:controller',
	array('plugin' => 'Seo', 'prefix' => 'admin')
);

Router::connect(
	'/admin/seo/:controller/:action/',
	array('plugin' => 'Seo', 'prefix' => 'admin')
);

Router::connect(
	'/admin/seo/:controller/:action/*',
	array('plugin' => 'Seo', 'prefix' => 'admin')
);