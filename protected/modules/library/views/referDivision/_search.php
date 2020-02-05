<?php
/* @var $this ReferDivisionController */
/* @var $model ReferDivision */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'refer_id'); ?>
		<?php echo $form->textField($model,'refer_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'division_code'); ?>
		<?php echo $form->textField($model,'division_code',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'division_name'); ?>
		<?php echo $form->textField($model,'division_name',array('size'=>60,'maxlength'=>200)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'assigned'); ?>
		<?php echo $form->textField($model,'assigned'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->