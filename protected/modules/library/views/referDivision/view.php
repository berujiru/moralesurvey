<?php
/* @var $this ReferDivisionController */
/* @var $model ReferDivision */

$this->breadcrumbs=array(
	'Refer Divisions'=>array('index'),
	$model->refer_id,
);

$this->menu=array(
	array('label'=>'List ReferDivision', 'url'=>array('index')),
	array('label'=>'Create ReferDivision', 'url'=>array('create')),
	array('label'=>'Update ReferDivision', 'url'=>array('update', 'id'=>$model->refer_id)),
	array('label'=>'Delete ReferDivision', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->refer_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ReferDivision', 'url'=>array('admin')),
);
?>

<h1>View ReferDivision #<?php echo $model->refer_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'refer_id',
		'division_code',
		'division_name',
		'assigned',
	),
)); ?>
