<div class="seo_plugin">
	<?php echo $this->element('seo_view_head', array('plugin' => 'seo')); ?>
	<div class="seoCanonicals form">
		<?php echo $this->Form->create('SeoCanonical');?>
		<fieldset>
			<legend><?php echo __('Admin Edit Seo Canonical'); ?></legend>
			<?php echo $this->element('SeoCanonical/form'); ?>
		</fieldset>
		<?php echo $this->Form->end(__('Submit'));?>
	</div>
	<div class="actions">
		<h3><?php echo __('Actions'); ?></h3>
		<ul>
			<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('SeoCanonical.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('SeoCanonical.id'))); ?></li>
		</ul>
	</div>
</div>