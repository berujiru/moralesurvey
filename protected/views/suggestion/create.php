<?php
/* @var $this SuggestionController */
/* @var $model Suggestion */

$this->breadcrumbs=array(
	'Suggestions'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Suggestion', 'url'=>array('index')),
	array('label'=>'Manage Suggestion', 'url'=>array('admin')),
);
?>

<h1>Create Suggestion</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>