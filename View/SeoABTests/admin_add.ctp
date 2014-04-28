<div class="seo_plugin">
	<?php echo $this->element('seo_view_head', array('plugin' => 'seo')); ?>
	<div class="seoABTests form">
		<?php echo $this->Form->create('SeoABTest'); ?>
		<fieldset>
			<legend><?php echo __('Admin Add Seo A B Test'); ?></legend>
			<?php echo $this->element('SeoABTest/form'); ?>
		</fieldset>
		<?php echo $this->Form->end(__('Submit')); ?>
	</div>
</div>
