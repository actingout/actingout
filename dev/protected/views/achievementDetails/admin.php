<div class="createheader">
<?php echo GxHtml::link(Yii::t('app', 'Create Achievement'), 'create', array('class' => 'create')); ?>
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
	$.fn.yiiGridView.update('achievement-details-grid', {
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
	'id' => 'achievement-details-grid',
	'dataProvider' => $model->search(),	
	'columns' => array(
		'ach_id',
		'ach_name',
		'ach_desc',
		'earned',
		'applies_for',
		'in_row',
		/*
		'category',
		'ach_con',
		*/
		array(
			'class' => 'CButtonColumn',
		),
	),
)); ?>