<div class="createheader">
<?php echo GxHtml::link(Yii::t('app', 'Create User'), 'create', array('class' => 'create')); ?>
</div>

<?php

$this->menu = array(
		array('label'=>Yii::t('app', 'List') . ' ' . $model->label(2), 'url'=>array('index')),
		array('label'=>Yii::t('app', 'Create') . ' ' . $model->label(), 'url'=>array('create')),
	);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('user-details-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1><?php echo Yii::t('app', 'Manage') . ' ' . GxHtml::encode($model->label(2)); ?></h1>


<?php echo GxHtml::link(Yii::t('app', 'Advanced Search'), '#', array('class' => 'search-button')); ?>
<div class="search-form">
<?php $this->renderPartial('_search', array(
	'model' => $model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id' => 'user-details-grid',
	'dataProvider' => $model->search(),	
	'columns' => array(
		'user_id',
		'user_alternate_id',
		'user_email',
		//'user_password',
		'user_name',
		'user_points',
		/*
		'dynamite_number',
		'game_type',
		*/
		array(
			'class' => 'CButtonColumn',
		),
	),
)); ?>