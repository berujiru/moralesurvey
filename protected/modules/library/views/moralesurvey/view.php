<?php
/* @var $this MoralesurveyController */
/* @var $model Moralesurvey */

$this->breadcrumbs=array(
	'Moralesurveys'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Moralesurvey', 'url'=>array('index')),
	array('label'=>'Create Moralesurvey', 'url'=>array('create')),
	array('label'=>'Update Moralesurvey', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Moralesurvey', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Moralesurvey', 'url'=>array('admin')),
);
?>

<h1>View Moralesurvey #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'datefrom',
		'dateto',
	),
)); ?>
