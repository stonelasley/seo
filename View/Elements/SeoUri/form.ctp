
<?php
echo $this->Form->hidden('SeoUri.id');
echo $this->Form->input('SeoUri.uri');
echo $this->Form->input('SeoUri.is_approved');
?>
<div class="clear"></div>
<h2>Title Tag</h2>
<?php echo $this->element('SeoTitle/form', array('index' => 0)); ?>
<div class="clear"></div>
<h2>Meta Tags</h2>
<fieldset>
	<?php
	for ($i = 0; $i < 3; $i++) {
		echo $this->element('SeoMetaTag/form', array('index' => $i));
	}
	?>
</fieldset>