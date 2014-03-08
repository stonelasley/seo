<div class="seo_plugin">
	<?php echo $this->element('seo_view_head', array('plugin' => 'seo')); ?>
	<div class="seoUris form">
		<?php echo $this->Form->create('SeoUri');?>
		<fieldset>
		<?php echo $this->element('SeoUri/form'); ?>
		</fieldset>
		<?php echo $this->Form->end(__('Save All'));?>
	</div>
</div>