<div class="createheader">
<?php echo GxHtml::link(Yii::t('app', 'Create Game'), 'create', array('class' => 'create')); ?>
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
	$.fn.yiiGridView.update('game-details-grid', {
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
	'id' => 'game-details-grid',
	'dataProvider' => $model->search(),	
	'columns' => array(
		'game_id',
		array('name'=>'userone_id','value'=>'UserDetails::model()->find("user_id=".$data->userone_id)->user_name'),
		array('name'=>'usertwo_id','value'=>'UserDetails::model()->find("user_id=".$data->usertwo_id)->user_name'),
		'game_points',
		'game_video_url',
		'game_status',
		/*
		'game_round_one',
		'game_round_two',
		'game_time',
		'game_word',
		'game_hint',
		'game_category',
		*/
		array(
			'class' => 'CButtonColumn',
		),
	),
)); ?>