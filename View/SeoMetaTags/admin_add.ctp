<div class="seo_plugin">
	<?php echo $this->element('seo_view_head', array('plugin' => 'seo')); ?>
	<div class="seoMetaTags form">
		<?php echo $this->Form->create('SeoMetaTag');?>
		<fieldset>
			<legend><?php echo __('Admin Add Seo Meta Tag'); ?></legend>
			<?php echo $this->element('SeoMetaTag/form'); ?>
		</fieldset>
		<?php echo $this->Form->end(__('Submit'));?>
	</div>
</div>