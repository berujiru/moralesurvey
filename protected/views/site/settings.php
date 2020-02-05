<h1>Settings</h1>
<?php if(Yii::app()->user->hasFlash('settings')): ?>
<div class="confirmation" class="flash-success">
        <?php $message =  Yii::app()->user->getFlash('settings');
        echo '<div id="xyzsms" class="flash-success">' . $message . "</div>\n"; ?>
</div>
<?php endif;?>

<?php echo CHtml::errorSummary($settings); ?>

<div class="form span6 offset4">
<?php echo CHtml::beginForm('','post',array('enctype'=>'multipart/form-data')); ?>


  <div class="row span6 ">
          <?php echo CHtml::activeLabel($settings,'oic'); ?>
          <?php
          $this->widget('ext.ESelect2.ESelect2',array(
                 'model'=>$settings,
                 'attribute' => 'oic',
                 'data'=>CHtml::listData(
                     Division::model()->findAll(), 'user_id', 'profile.employee_id','division.division_name'),
                 'options'  => array(
                     'placeholder'=>'Select oic',
                     'width'=>'250px',
                 ),
          ));

          ?>
          <?php echo CHtml::error($settings,'oic'); ?>
  </div>


<div class="row">
        <?php echo CHtml::submitButton('Save',array('class'=>'btn btn-success')); ?>
</div>

<?php echo CHtml::endForm(); ?>

</div>