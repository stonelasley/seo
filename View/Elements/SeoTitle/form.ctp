<?php

$prefix = null;
if(isset($index)){
	$prefix = "SeoTitle.";
}
echo $this->Form->hidden($prefix . 'id');
if (!isset($index)) {
	echo $this->Form->input($prefix . 'SeoUri.uri');
}
echo $this->Form->input($prefix . 'title');
