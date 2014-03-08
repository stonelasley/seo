<div class="seo_plugin">
	<?php echo $this->element('seo_view_head', array('plugin' => 'seo')); ?>
	<div class="seoStatusCodes form">
	<?php echo $this->Form->create('SeoStatusCode');?>
		<fieldset>
			<legend><?php echo __('Admin Edit Seo Status Code'); ?></legend>
			<?php echo $this->element('SeoStatusCode/form'); ?>
		</fieldset>
	<?php echo $this->Form->end(__('Submit'));?>
	</div>
	<div class="actions">
		<h3><?php echo __('Actions'); ?></h3>
		<ul>
			<li><?php echo $this->Html->link(__('Delete'), array('action' => 'delete', $this->Form->value('SeoStatusCode.id')), null, sprintf(__('Are you sure you want to delete # %s?'), $this->Form->value('SeoStatusCode.id'))); ?></li>
		</ul>
	</div>
</div>