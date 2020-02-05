<?php
/* @var $this ReferDivisionController */
/* @var $model ReferDivision */

$this->breadcrumbs=array(
	'Refer Divisions'=>array('index'),
	$model->refer_id=>array('view','id'=>$model->refer_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List ReferDivision', 'url'=>array('index')),
	array('label'=>'Create ReferDivision', 'url'=>array('create')),
	array('label'=>'View ReferDivision', 'url'=>array('view', 'id'=>$model->refer_id)),
	array('label'=>'Manage ReferDivision', 'url'=>array('admin')),
);
?>

<h1>Update ReferDivision <?php echo $model->refer_id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>