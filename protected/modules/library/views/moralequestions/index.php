<?php
/* @var $this MoralequestionsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Moralequestions',
);

$this->menu=array(
	array('label'=>'Create Moralequestions', 'url'=>array('create')),
	array('label'=>'Manage Moralequestions', 'url'=>array('admin')),
);
?>

<h1>Moralequestions</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
