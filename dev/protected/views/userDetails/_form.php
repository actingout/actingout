<div class="form">


<?php $form = $this->beginWidget('GxActiveForm', array(
	'id' => 'user-details-form',
	'enableAjaxValidation' => false,
));
?>

	<p class="note">
		<?php echo Yii::t('app', 'Fields with'); ?> <span class="required">*</span> <?php echo Yii::t('app', 'are required'); ?>.
	</p>

	<?php echo $form->errorSummary($model); ?>

		<div class="row">
		<?php echo $form->labelEx($model,'user_alternate_id'); ?>
		<?php echo $form->textField($model, 'user_alternate_id', array('maxlength' => 255)); ?>
		<?php echo $form->error($model,'user_alternate_id'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'user_email'); ?>
		<?php echo $form->textField($model, 'user_email', array('maxlength' => 255)); ?>
		<?php echo $form->error($model,'user_email'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'user_password'); ?>
		<?php echo $form->passwordField($model, 'user_password', array('maxlength' => 255)); ?>
		<?php echo $form->error($model,'user_password'); ?>
		</div><!-- row -->
                <div class="row">
		<?php echo $form->labelEx($model,'repeat_password'); ?>
		<?php echo $form->passwordField($model, 'repeat_password', array('maxlength' => 255)); ?>
		<?php echo $form->error($model,'repeat_password'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'user_name'); ?>
		<?php echo $form->textField($model, 'user_name', array('maxlength' => 255)); ?>
		<?php echo $form->error($model,'user_name'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'user_points'); ?>
		<?php echo $form->textField($model, 'user_points', array('maxlength' => 255)); ?>
		<?php echo $form->error($model,'user_points'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'dynamite_number'); ?>
		<?php echo $form->textField($model, 'dynamite_number'); ?>
		<?php echo $form->error($model,'dynamite_number'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'game_type'); ?>
		<?php echo $form->textField($model, 'game_type', array('maxlength' => 4)); ?>
		<?php echo $form->error($model,'game_type'); ?>
		</div><!-- row -->


<?php
echo GxHtml::submitButton(Yii::t('app', 'Save'));
$this->endWidget();
?>
</div><!-- form -->