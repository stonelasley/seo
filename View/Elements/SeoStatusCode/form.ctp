<?php
echo $this->Form->hidden('id');
echo $this->Form->input('SeoUri.uri');
echo $this->Form->input('status_code', array('type' => 'select', 'options' => $status_codes));
echo $this->Form->input('priority');
echo $this->Form->input('is_active');
