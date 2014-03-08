<?php
	echo $this->Form->hidden('id');
	echo $this->Form->input('SeoUri.uri');
	echo $this->Form->input('canonical', array('label' => 'Canonical Link'));
	echo $this->Form->input('is_active');