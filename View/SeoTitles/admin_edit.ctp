<div class="seo_plugin">
	<?php echo $this->element('seo_view_head', array('plugin' => 'seo')); ?>
	<div class="seoTitles form">
		<?php echo $this->Form->create('SeoTitle');?>
		<fieldset>
			<legend><?php echo __('Admin Edit Seo Title'); ?></legend>
			<?php echo $this->element('SeoTitle/form'); ?>
		</fieldset>
		<?php echo $this->Form->end(__('Submit'));?>
	</div>
	<div class="actions">
		<h3><?php echo __('Actions'); ?></h3>
		<ul>
			<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('SeoTitle.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('SeoTitle.id'))); ?></li>
			<li><?php echo $this->Html->link(__('New Seo Title'), array('controller' => 'seo_title', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>