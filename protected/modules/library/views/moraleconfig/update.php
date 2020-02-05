<?php
/* @var $this MoraleconfigController */
/* @var $model Moraleconfig */

$this->breadcrumbs=array(
	'Moraleconfigs'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Moraleconfig', 'url'=>array('index')),
	array('label'=>'Create Moraleconfig', 'url'=>array('create')),
	array('label'=>'View Moraleconfig', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Moraleconfig', 'url'=>array('admin')),
);
?>

<h1>Update Moraleconfig <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>