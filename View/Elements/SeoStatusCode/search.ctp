<?php
echo $this->Form->input('uri');
echo $this->Form->input('status_code', array('type' => 'select', 'options' => $status_codes));
echo $this->Form->input('is_active');