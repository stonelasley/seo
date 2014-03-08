<?php echo $this->Html->script('/seo/js/clear_default'); ?>
<div id="admin_filter">
	<?php
	$model = isset($model) ? $model : false;

	if ($model) {
		echo $this->Form->create($model);
		echo $this->element("$model/search");
		echo $this->Form->end(array('label' => '/seo/img/search_button.gif', 'formnovalidate' => true));
	}
	?>
</div>