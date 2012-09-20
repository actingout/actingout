<div class="createheader">
<?php echo GxHtml::link(Yii::t('app', 'Create Admin'), 'create', array('class' => 'admin-create')); ?>
</div>

<?php
Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('admins-grid', {
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
	'id' => 'admins-grid',
	'dataProvider' => $model->search(),	
	'columns' => array(
		'id',
		'username',
		//'password',
		'email',
		'createdate',
		'lastdate',
		
		array(
			'class' => 'CButtonColumn',
		),
	),
)); ?>