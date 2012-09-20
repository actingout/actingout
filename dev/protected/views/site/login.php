<?php
$this->pageTitle=Yii::app()->name . ' - Login';
$this->breadcrumbs=array(
	'Login',
);
?>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'form_login',
    'htmlOptions'=>array('class'=>'formEl sepH_c','style'=>'margin-left:30px;'),
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>
<p style="color:red;"><?php if(isset($msg)){echo $msg['password']['0'];} ?></p>
	<div class="sepH_a">
		<?php echo $form->labelEx($model,'username',array('class'=>'lbl_a')); ?>
		<?php echo $form->textField($model,'username', array('class'=>'inpt_a')); ?>
		<?php echo $form->error($model,'username'); ?>
	</div>

	<div class="sepH_a">
		<?php echo $form->labelEx($model,'password',array('class'=>'lbl_a')); ?>
		<?php echo $form->passwordField($model,'password', array('class'=>'inpt_a')); ?>
		<?php echo $form->error($model,'password'); ?>
	</div>
<?php echo $form->hiddenField($model,'manage_accounts', array('value'=>'0')); ?>
	<div class="row rememberMe">
		<?php echo $form->checkBox($model,'rememberMe'); ?>
		<?php echo $form->label($model,'rememberMe'); ?>
		<?php echo $form->error($model,'rememberMe'); ?>
	</div>

	<div class="sepH_a">
		<?php echo CHtml::submitButton('Login',array('class'=>'btn_a btn')); ?>
	</div>

<?php $this->endWidget(); ?>
