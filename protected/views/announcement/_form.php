<?php
/* @var $this AnnouncementController */
/* @var $model Announcement */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'announcement-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>
	<div>
		<?php echo $form->labelEx($model,'datedisplayfrom'); ?>
		<?php
	    $this->widget(
	    'ext.jui.EJuiDateTimePicker',
	    array(
	        'model'     => $model,
	        'attribute' => 'datedisplayfrom',
	        //'language'=> 'ru',//default Yii::app()->language
	        'mode'    => 'date',
	        'options'   => array(
	            'dateFormat' => 'yy-mm-dd',
	            //'timeFormat' => 'hh:mm',//'hh:mm tt' default
	            
	        ),
	    )
		);
	    ?>
	    <span id="d1"></span>
    	<?php echo $form->error($model,'datedisplayfrom'); ?>
	</div>

	<div>
		<?php echo $form->labelEx($model,'datedisplayto'); ?>
		<?php
	    $this->widget(
	    'ext.jui.EJuiDateTimePicker',
	    array(
	        'model'     => $model,
	        'attribute' => 'datedisplayto',
	        //'language'=> 'ru',//default Yii::app()->language
	        'mode'    => 'date',
	        'options'   => array(
	            'dateFormat' => 'yy-mm-dd',
	            //'timeFormat' => 'hh:mm',//'hh:mm tt' default
	        ),
	    )
		);
	    ?>
    	<?php echo $form->error($model,'datedisplayto'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'description'); ?>
		<?php echo $form->textArea($model,'description',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'description'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->