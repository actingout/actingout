<div class="wide form">

<?php $form = $this->beginWidget('GxActiveForm', array(
	'action' => Yii::app()->createUrl($this->route),
	'method' => 'get',
)); ?>
    

	<div class="row">
		<?php echo $form->label($model, 'que_id'); ?>
		<?php echo $form->textField($model, 'que_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'user_id'); ?>
		<?php echo $form->textField($model, 'user_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'que_status'); ?>
		<?php echo $form->textField($model, 'que_status', array('maxlength' => 4)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'que_time'); ?>
		<?php echo $form->textField($model, 'que_time'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'game_count'); ?>
		<?php echo $form->textField($model, 'game_count'); ?>
	</div>

	<div class="row buttons">
		<?php echo GxHtml::submitButton(Yii::t('app', 'Search')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->
