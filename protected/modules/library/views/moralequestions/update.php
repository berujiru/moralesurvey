<?php
/* @var $this MoralequestionsController */
/* @var $model Moralequestions */

$this->breadcrumbs=array(
	'Moralequestions'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Moralequestions', 'url'=>array('index')),
	array('label'=>'Create Moralequestions', 'url'=>array('create')),
	array('label'=>'View Moralequestions', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Moralequestions', 'url'=>array('admin')),
);
?>

<h1>Update Moralequestions <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>