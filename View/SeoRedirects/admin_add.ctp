<div class="seo_plugin">
	<?php echo $this->element('seo_view_head', array('plugin' => 'seo')); ?>
	<div class="seoRedirects form">
	<?php echo $this->Form->create('SeoRedirect');?>
		<fieldset>
			<legend><?php echo __('Admin Add Seo Redirect'); ?></legend>
			<?php echo $this->element('SeoRedirect/form'); ?>
		</fieldset>
	<?php echo $this->Form->end(__('Save Seo Redirect'));?>
	</div>
</div>