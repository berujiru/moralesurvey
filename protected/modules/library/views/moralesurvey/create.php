<?php
/* @var $this MoralesurveyController */
/* @var $model Moralesurvey */

$this->breadcrumbs=array(
	'Moralesurveys'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Moralesurvey', 'url'=>array('index')),
	array('label'=>'Manage Moralesurvey', 'url'=>array('admin')),
);
?>

<h1>Create Morale survey</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>