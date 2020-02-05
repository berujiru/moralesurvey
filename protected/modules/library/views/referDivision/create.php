<?php
/* @var $this ReferDivisionController */
/* @var $model ReferDivision */

$this->breadcrumbs=array(
	'Refer Divisions'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List ReferDivision', 'url'=>array('index')),
	array('label'=>'Manage ReferDivision', 'url'=>array('admin')),
);
?>

<h1>Create ReferDivision</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>