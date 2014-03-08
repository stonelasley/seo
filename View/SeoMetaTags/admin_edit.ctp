<div class="seo_plugin">
	<?php echo $this->element('seo_view_head', array('plugin' => 'seo')); ?>
	<div class="seoMetaTags form">
		<?php echo $this->Form->create('SeoMetaTag');?>
		<fieldset>
			<legend><?php echo __('Admin Edit Seo Meta Tag'); ?></legend>
			<?php echo $this->element('SeoMetaTag/form'); ?>
		</fieldset>
		<?php echo $this->Form->end(__('Submit'));?>
		<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('SeoMetaTag.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('SeoMetaTag.id'))); ?>
	</div>
	<div class="actions">
		<h3><?php echo __('Actions'); ?></h3>
		<ul>
			<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('SeoMetaTag.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('SeoMetaTag.id'))); ?></li>
		</ul>
	</div>
</div>