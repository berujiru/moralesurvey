<?php
/* @var $this MoralequestionsController */
/* @var $model Moralequestions */

$this->breadcrumbs=array(
	'Moralequestions'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Moralequestions', 'url'=>array('index')),
	array('label'=>'Manage Moralequestions', 'url'=>array('admin')),
);
?>

<h1>Create Moralequestions</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>