<div class="form">


<?php $form = $this->beginWidget('GxActiveForm', array(
	'id' => 'achievement-details-form',
	'enableAjaxValidation' => false,
));
?>

	<p class="note">
		<?php echo Yii::t('app', 'Fields with'); ?> <span class="required">*</span> <?php echo Yii::t('app', 'are required'); ?>.
	</p>

	<?php echo $form->errorSummary($model); ?>

		<div class="row">
		<?php echo $form->labelEx($model,'ach_name'); ?>
		<?php echo $form->textField($model, 'ach_name', array('maxlength' => 255)); ?>
		<?php echo $form->error($model,'ach_name'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'ach_desc'); ?>
		<?php echo $form->textArea($model, 'ach_desc'); ?>
		<?php echo $form->error($model,'ach_desc'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'earned'); ?>
		<?php echo $form->textField($model, 'earned', array('maxlength' => 5)); ?>
		<?php echo $form->error($model,'earned'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'applies_for'); ?>
		<?php echo $form->textField($model, 'applies_for', array('maxlength' => 5)); ?>
		<?php echo $form->error($model,'applies_for'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'in_row'); ?>
		<?php echo $form->textField($model, 'in_row', array('maxlength' => 3)); ?>
		<?php echo $form->error($model,'in_row'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'category'); ?>
		<?php echo $form->textField($model, 'category', array('maxlength' => 255)); ?>
		<?php echo $form->error($model,'category'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'ach_con'); ?>
		<?php echo $form->textField($model, 'ach_con'); ?>
		<?php echo $form->error($model,'ach_con'); ?>
		</div><!-- row -->


<?php
echo GxHtml::submitButton(Yii::t('app', 'Save'));
$this->endWidget();
?>
</div><!-- form -->