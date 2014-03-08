<div class="seo_plugin">
	<?php echo $this->element('seo_view_head', array('plugin' => 'seo')); ?>
	<div class="seoUris form">
		<?php echo $this->Form->create('SeoUrl');?>
		<fieldset>
			<legend><?php echo __('Admin Add Seo Uri'); ?></legend>
			<?php echo $this->element('SeoUrl/form'); ?>
		</fieldset>
		<?php echo $this->Form->end(__('Save All'));?>
	</div>
</div>