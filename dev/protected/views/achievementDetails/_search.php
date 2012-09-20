<div class="wide form">

<?php $form = $this->beginWidget('GxActiveForm', array(
	'action' => Yii::app()->createUrl($this->route),
	'method' => 'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model, 'ach_id'); ?>
		<?php echo $form->textField($model, 'ach_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'ach_name'); ?>
		<?php echo $form->textField($model, 'ach_name', array('maxlength' => 255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'ach_desc'); ?>
		<?php echo $form->textArea($model, 'ach_desc'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'earned'); ?>
		<?php echo $form->textField($model, 'earned', array('maxlength' => 5)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'applies_for'); ?>
		<?php echo $form->textField($model, 'applies_for', array('maxlength' => 5)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'in_row'); ?>
		<?php echo $form->textField($model, 'in_row', array('maxlength' => 3)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'category'); ?>
		<?php echo $form->textField($model, 'category', array('maxlength' => 255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'ach_con'); ?>
		<?php echo $form->textField($model, 'ach_con'); ?>
	</div>

	<div class="row buttons">
		<?php echo GxHtml::submitButton(Yii::t('app', 'Search')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->
