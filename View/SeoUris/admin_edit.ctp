<div class="seo_plugin">
	<?php echo $this->element('seo_view_head', array('plugin' => 'seo')); ?>
	<div class="seoUris form">
		<?php echo $this->Form->create('SeoUri');?>
		<fieldset>
		<?php echo $this->element('SeoUri/form'); ?>
		</fieldset>
		<?php echo $this->Form->end(__('Save All'));?>
	</div>
	<div class="actions">
		<h3><?php echo __('Actions'); ?></h3>
		<ul>
			<li><?php echo $this->Html->link(__('URL Encode'), array('action' => 'urlencode', $this->Form->value('SeoUri.id')), null, __('Are you sure you want to url encode # %s?', $this->Form->value('SeoUri.id'))); ?></li>
			<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('SeoUri.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('SeoUri.id'))); ?></li>
		</ul>
	</div>
</div>