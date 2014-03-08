<div class="seoABTests form">
<?php echo $this->Form->create('SeoABTest'); ?>
	<fieldset>
		<legend><?php echo __('Admin Add Seo A B Test'); ?></legend>
		<?php echo $this->element('SeoABTest/form'); ?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Seo A B Tests'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Seo Uris'), array('controller' => 'seo_uris', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Seo Uri'), array('controller' => 'seo_uris', 'action' => 'add')); ?> </li>
	</ul>
</div>
