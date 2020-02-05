<?php
/* @var $this MoralesurveyController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Moralesurveys',
);

$this->menu=array(
	array('label'=>'Create Moralesurvey', 'url'=>array('create')),
	array('label'=>'Manage Moralesurvey', 'url'=>array('admin')),
);
?>

<h1>Morale surveys</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
