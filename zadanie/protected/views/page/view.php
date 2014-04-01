<?php
/* @var $this PageController */
/* @var $model Page */

$this->breadcrumbs=array(
	'Pages'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'Список твитов', 'url'=>array('index')),
	array('label'=>'Сделать твит', 'url'=>array('create')),
	array('label'=>'Обновить твит', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Удалить твит', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Уптавление твитами', 'url'=>array('admin')),
);
?>

<h1>Показываем твит: #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'title',
		'text',
	),
)); ?>
