<?php
/* @var $this MoralesurveyController */
/* @var $model Moralesurvey */

$this->breadcrumbs=array(
	'Moralesurveys'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Moralesurvey', 'url'=>array('index')),
	array('label'=>'Create Moralesurvey', 'url'=>array('create')),
	array('label'=>'View Moralesurvey', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Moralesurvey', 'url'=>array('admin')),
);
?>

<h1>Update Moralesurvey <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>