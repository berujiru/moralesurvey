<?php
/* @var $this ReferDivisionController */
/* @var $model ReferDivision */

$this->breadcrumbs=array(
	'Refer Divisions'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List ReferDivision', 'url'=>array('index')),
	array('label'=>'Create ReferDivision', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#refer-division-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Refer Divisions</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'refer-division-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'refer_id',
		'division_code',
		'division_name',
		//'assigned',
		array(
			'name'=>'user_search',
			'value'=>'$data->profile?$data->profile->employee_id:"None"'
			),
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
