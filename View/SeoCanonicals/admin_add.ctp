<div class="seo_plugin">
	<?php echo $this->element('seo_view_head', array('plugin' => 'seo')); ?>
	<div class="seoCanonicals form">
		<?php echo $this->Form->create('SeoCanonical');?>
		<fieldset>
			<legend><?php echo __('Admin Add Seo Canonical'); ?></legend>
			<?php echo $this->element('SeoCanonical/form'); ?>
		</fieldset>
		<?php echo $this->Form->end(__('Submit'));?>
	</div>
</div>