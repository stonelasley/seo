<div class="seo_plugin">
	<?php echo $this->element('seo_view_head', array('plugin' => 'seo')); ?>
	<div class="seoStatusCodes form">
	<?php echo $this->Form->create('SeoStatusCode');?>
		<fieldset>
			<legend><?php echo __('Admin Add Seo Status Code'); ?></legend>
			<?php echo $this->element('SeoStatusCode/form'); ?>
		</fieldset>
	<?php echo $this->Form->end(__('Save Seo Status Code'));?>
	</div>
</div>