<?php
/* @var $this MoralesurveyController */
/* @var $model Moralesurvey */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'moralesurvey-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'datefrom'); ?>

		<?php
	    $this->widget(
	    'ext.jui.EJuiDateTimePicker',
	    array(
	        'model'     => $model,
	        'attribute' => 'datefrom',
	        //'language'=> 'ru',//default Yii::app()->language
	        'mode'    => 'date',
	        'options'   => array(
	            'dateFormat' => 'yy.mm.dd',
	            //'timeFormat' => 'hh:mm tt',//'hh:mm tt' default
	        ),
	    )
		);
	    ?>
		<?php echo $form->error($model,'datefrom'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'dateto'); ?>
		<?php
	    $this->widget(
	    'ext.jui.EJuiDateTimePicker',
	    array(
	        'model'     => $model,
	        'attribute' => 'dateto',
	        //'language'=> 'ru',//default Yii::app()->language
	        'mode'    => 'date',
	        'options'   => array(
	            'dateFormat' => 'yy.mm.dd',
	            //'timeFormat' => 'hh:mm tt',//'hh:mm tt' default
	        ),
	    )
		);
	    ?>
		<?php echo $form->error($model,'dateto'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->