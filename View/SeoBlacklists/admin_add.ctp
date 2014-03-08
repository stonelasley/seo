<div class="seo_plugin">
	<?php echo $this->element('seo_view_head', array('plugin' => 'seo')); ?>
	<div class="seoBlacklists form">
	<?php echo $this->Form->create('SeoBlacklist');?>
		<fieldset>
			<legend><?php echo __('Admin Add Seo Blacklist'); ?></legend>
			<?php echo $this->element('SeoBlacklist/form');?>
		</fieldset>
	<?php echo $this->Form->end(__('Save BlackList'));?>
	</div>
</div>