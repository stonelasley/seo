<div class="seo_plugin">
	<?php echo $this->element('seo_view_head', array('plugin' => 'seo')); ?>
	<div class="seoBlacklists form">
	<?php echo $this->Form->create('SeoBlacklist');?>
		<fieldset>
			<legend><?php echo __('Admin Edit Seo Blacklist'); ?></legend>
			<?php echo $this->element('SeoBlacklist/form');?>
		</fieldset>
	<?php echo $this->Form->end(__('Submit'));?>
	<?php echo $this->Html->link(__('Delete'), array('action' => 'delete', $this->Form->value('SeoBlacklist.id')), null, sprintf(__('Are you sure you want to delete # %s?'), $this->Form->value('SeoBlacklist.id'))); ?>
	</div>
	<div class="actions">
		<h3><?php echo __('Actions'); ?></h3>
		<ul>
			<li><?php echo $this->Html->link(__('Delete'), array('action' => 'delete', $this->Form->value('SeoBlacklist.id')), null, sprintf(__('Are you sure you want to delete # %s?'), $this->Form->value('SeoBlacklist.id'))); ?></li>
			<li><?php echo $this->Html->link(__('New Seo Blacklist'), array('controller' => 'seo_blacklists', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>