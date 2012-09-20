<div class="wide form">

<?php $form = $this->beginWidget('GxActiveForm', array(
	'action' => Yii::app()->createUrl($this->route),
	'method' => 'get',
)); ?>

    
	<div class="row">
		<?php echo $form->label($model, 'game_id'); ?>
		<?php echo $form->textField($model, 'game_id'); ?>
	</div>
    
	<div class="row">
		<?php echo $form->label($model, 'game_points'); ?>
		<?php echo $form->textField($model, 'game_points'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'game_video_url'); ?>
		<?php echo $form->textField($model, 'game_video_url', array('maxlength' => 255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'game_status'); ?>
		<?php echo $form->textField($model, 'game_status', array('maxlength' => 15)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'game_round_one'); ?>
		<?php echo $form->textField($model, 'game_round_one'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'game_round_two'); ?>
		<?php echo $form->textField($model, 'game_round_two'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'game_time'); ?>
		<?php echo $form->textField($model, 'game_time'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'game_word'); ?>
		<?php echo $form->textField($model, 'game_word', array('maxlength' => 255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'game_hint'); ?>
		<?php echo $form->textField($model, 'game_hint', array('maxlength' => 255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'game_category'); ?>
		<?php echo $form->textField($model, 'game_category', array('maxlength' => 255)); ?>
	</div>

	<div class="row buttons">
		<?php echo GxHtml::submitButton(Yii::t('app', 'Search')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->
