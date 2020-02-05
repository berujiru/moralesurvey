<?php
/* @var $this MoraleconfigController */
/* @var $model Moraleconfig */

$this->breadcrumbs=array(
	'Moraleconfigs'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Moraleconfig', 'url'=>array('index')),
	array('label'=>'Create Moraleconfig', 'url'=>array('create')),
	array('label'=>'Update Moraleconfig', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Moraleconfig', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Moraleconfig', 'url'=>array('admin')),
);
?>

<h1>View Moraleconfig #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'user_id',
		'status',
		'division',
	),
)); ?>
