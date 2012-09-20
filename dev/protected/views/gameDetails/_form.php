<div class="form">


<?php $form = $this->beginWidget('GxActiveForm', array(
	'id' => 'game-details-form',
	'enableAjaxValidation' => false,
));
?>

	<p class="note">
		<?php echo Yii::t('app', 'Fields with'); ?> <span class="required">*</span> <?php echo Yii::t('app', 'are required'); ?>.
	</p>

	<?php echo $form->errorSummary($model); ?>

		<div class="row">
		<?php echo $form->labelEx($model,'userone_id'); ?>
		<?php echo $form->textField($model, 'userone_id'); ?>
		<?php echo $form->error($model,'userone_id'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'usertwo_id'); ?>
		<?php echo $form->textField($model, 'usertwo_id'); ?>
		<?php echo $form->error($model,'usertwo_id'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'game_points'); ?>
		<?php echo $form->textField($model, 'game_points'); ?>
		<?php echo $form->error($model,'game_points'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'game_video_url'); ?>
		<?php echo $form->textField($model, 'game_video_url', array('maxlength' => 255)); ?>
		<?php echo $form->error($model,'game_video_url'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'game_status'); ?>
		<?php echo $form->textField($model, 'game_status', array('maxlength' => 15)); ?>
		<?php echo $form->error($model,'game_status'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'game_round_one'); ?>
		<?php echo $form->textField($model, 'game_round_one'); ?>
		<?php echo $form->error($model,'game_round_one'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'game_round_two'); ?>
		<?php echo $form->textField($model, 'game_round_two'); ?>
		<?php echo $form->error($model,'game_round_two'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'game_time'); ?>
		<?php echo $form->textField($model, 'game_time'); ?>
		<?php echo $form->error($model,'game_time'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'game_word'); ?>
		<?php echo $form->textField($model, 'game_word', array('maxlength' => 255)); ?>
		<?php echo $form->error($model,'game_word'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'game_hint'); ?>
		<?php echo $form->textField($model, 'game_hint', array('maxlength' => 255)); ?>
		<?php echo $form->error($model,'game_hint'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'game_category'); ?>
		<?php echo $form->textField($model, 'game_category', array('maxlength' => 255)); ?>
		<?php echo $form->error($model,'game_category'); ?>
		</div><!-- row -->


<?php
echo GxHtml::submitButton(Yii::t('app', 'Save'));
$this->endWidget();
?>
</div><!-- form -->