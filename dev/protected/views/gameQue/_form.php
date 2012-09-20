<div class="form">


<?php $form = $this->beginWidget('GxActiveForm', array(
	'id' => 'game-que-form',
	'enableAjaxValidation' => false,
));
?>

	<p class="note">
		<?php echo Yii::t('app', 'Fields with'); ?> <span class="required">*</span> <?php echo Yii::t('app', 'are required'); ?>.
	</p>

	<?php echo $form->errorSummary($model); ?>

		<div class="row">
		<?php echo $form->labelEx($model,'user_id'); ?>
		<?php echo $form->textField($model, 'user_id'); ?>
		<?php echo $form->error($model,'user_id'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'que_status'); ?>
		<?php echo $form->textField($model, 'que_status', array('maxlength' => 4)); ?>
		<?php echo $form->error($model,'que_status'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'que_time'); ?>
		<?php echo $form->textField($model, 'que_time'); ?>
		<?php echo $form->error($model,'que_time'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'game_count'); ?>
		<?php echo $form->textField($model, 'game_count'); ?>
		<?php echo $form->error($model,'game_count'); ?>
		</div><!-- row -->


<?php
echo GxHtml::submitButton(Yii::t('app', 'Save'));
$this->endWidget();
?>
</div><!-- form -->