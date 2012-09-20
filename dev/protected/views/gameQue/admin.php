<div class="createheader">
<?php echo GxHtml::link(Yii::t('app', 'Create Game que'), 'create', array('class' => 'create')); ?>
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
	$.fn.yiiGridView.update('game-que-grid', {
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
));  ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id' => 'game-que-grid',
	'dataProvider' => $model->search(),	
	'columns' => array(
		'que_id',                
                array('name'=>'user_id','value'=>'!empty($data->user_id)?UserDetails::model()->find("user_id=".$data->user_id)->user_name:"not user";'),
		'que_status',
		'que_time',
		'game_count',
		array(
			'class' => 'CButtonColumn',
		),
	),
));
?>