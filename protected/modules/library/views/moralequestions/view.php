<?php
/* @var $this MoralequestionsController */
/* @var $model Moralequestions */

$this->breadcrumbs=array(
	'Moralequestions'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Moralequestions', 'url'=>array('index')),
	array('label'=>'Create Moralequestions', 'url'=>array('create')),
	array('label'=>'Update Moralequestions', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Moralequestions', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Moralequestions', 'url'=>array('admin')),
);
?>

<h1>View Moralequestions #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'question',
		'status',
	),
)); ?>
