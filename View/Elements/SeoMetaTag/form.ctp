<?php
$prefix = null;
if(isset($index)){
	$prefix = "SeoMetaTag.$index.";
	$oneBased = $index + 1;
	echo '<h3>' . __("Tag $oneBased") . '</h3>';
}
echo $this->Form->hidden($prefix . 'id');
if (!isset($index)) {
	echo $this->Form->input($prefix . 'SeoUri.uri');
}
echo $this->Form->input($prefix . 'name');
echo $this->Form->input($prefix . 'content');
echo $this->Form->input($prefix . 'is_http_equiv');
