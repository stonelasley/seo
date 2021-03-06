<div class="seo_plugin">
	<?php echo $this->element('seo_view_head', array('plugin' => 'seo')); ?>
	<div class="seoUrls form">
		<?php echo $this->Form->create('SeoUrl');?>
		<fieldset>
			<legend><?php echo __('Admin Edit Seo Url'); ?></legend>
			<?php echo $this->element('SeoUrl/form'); ?>
		</fieldset>
		<?php echo $this->Form->end(__('Save All'));?>
	</div>
	<div class="actions">
		<h3><?php echo __('Actions'); ?></h3>
		<ul>
			<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('SeoUrl.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('SeoUrl.id'))); ?></li>
			<li><?php echo $this->Html->link(__('New Seo Url'), array('controller' => 'seo_urls', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>