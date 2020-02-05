<?php
/* @var $this ReferDivisionController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Refer Divisions',
);

$this->menu=array(
	array('label'=>'Create ReferDivision', 'url'=>array('create')),
	array('label'=>'Manage ReferDivision', 'url'=>array('admin')),
);
?>

<h1>Refer Divisions</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
