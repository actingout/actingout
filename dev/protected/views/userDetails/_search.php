<div class="wide form">

<?php $form = $this->beginWidget('GxActiveForm', array(
	'action' => Yii::app()->createUrl($this->route),
	'method' => 'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model, 'user_id'); ?>
		<?php echo $form->textField($model, 'user_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'user_alternate_id'); ?>
		<?php echo $form->textField($model, 'user_alternate_id', array('maxlength' => 255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'user_email'); ?>
		<?php echo $form->textField($model, 'user_email', array('maxlength' => 255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'user_name'); ?>
		<?php echo $form->textField($model, 'user_name', array('maxlength' => 255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'user_points'); ?>
		<?php echo $form->textField($model, 'user_points', array('maxlength' => 255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'dynamite_number'); ?>
		<?php echo $form->textField($model, 'dynamite_number'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'game_type'); ?>
		<?php echo $form->textField($model, 'game_type', array('maxlength' => 4)); ?>
	</div>

	<div class="row buttons">
		<?php echo GxHtml::submitButton(Yii::t('app', 'Search')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->
