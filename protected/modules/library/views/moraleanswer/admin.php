<?php
/* @var $this MoraleanswerController */
/* @var $model Moraleanswer */

$this->breadcrumbs=array(
	'Moraleanswers'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Moraleanswer', 'url'=>array('index')),
	array('label'=>'Create Moraleanswer', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#moraleanswer-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Moraleanswers</h1>

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
	'id'=>'moraleanswer-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		array(
			'name'=>'user_search',
			'value'=>'$data->profile?$data->profile->employee_id:"None"',
			),
		// array(
		// 	'name'=>'mydiv',
		// 	'value'=>'$data->moraledivision?$data->moraledivision->division_id:"None"',
		// 	),
		array(
			'name'=>'division_name',
			'value'=>'$data->moraledivision->division?$data->moraledivision->division->division_name:"None"',
			),
		array(
			'name'=>'position',
			'value'=>'$data->moraleposition?$data->moraleposition->position_type:""',
			),
		// 'survey_id',
		// 'date',
		'question',
		array(
			'header'=>'question name',
			'value'=>function($data,$datacolumn) {
				 	echo Moraleanswer::model()->getQuestion($data->question);
				 },
			),
		// array(
		// 	'name'=>'question',
		// 	'value'=>'$data->moralequestion?$data->moralequestion->question:"None"',
		// 	),
		'answer',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
