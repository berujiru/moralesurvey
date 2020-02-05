<?php
/* @var $this MoraleconfigController */
/* @var $model Moraleconfig */

$this->breadcrumbs=array(
	'Moraleconfigs'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Moraleconfig', 'url'=>array('index')),
	array('label'=>'Manage Moraleconfig', 'url'=>array('admin')),
);
?>

<h1>Create Moraleconfig</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>