<?php
echo $this->Form->hidden('id');
echo $this->Form->input('SeoUri.uri', array('after' => 'The URL or URI expression you want this test to run on.'));
echo $this->Form->input('slug', array('after' => 'The slug for the your GA custom variable. Cannot contain a \' mark.'));
echo $this->Form->input('roll', array('after' => 'The roll must be a number between 1 and 100 (100 being 100% roll success), or a callback function with Model::function syntax.'));
echo $this->Form->input('priority');
echo $this->Form->input('redmine', array('after' => 'The Redmine ticket ID'));
echo $this->Form->input('description');
echo $this->Form->input('start_date');
echo $this->Form->input('end_date');
echo $this->Form->input('is_active');