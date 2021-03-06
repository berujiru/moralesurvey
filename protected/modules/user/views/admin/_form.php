<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-form',
	'enableAjaxValidation'=>true,
	'htmlOptions' => array('enctype'=>'multipart/form-data'),
));
?>

	<p class="note"><?php echo UserModule::t('Fields with <span class="required">*</span> are required.'); ?></p>

	<?php echo $form->errorSummary(array($model,$profile,$position,$division)); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'username'); ?>
		<?php echo $form->textField($model,'username',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'username'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'password'); ?>
		<?php echo $form->passwordField($model,'password',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'password'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'superuser'); ?>
		<?php echo $form->dropDownList($model,'superuser',User::itemAlias('AdminStatus')); ?>
		<?php echo $form->error($model,'superuser'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'status'); ?>
		<?php echo $form->dropDownList($model,'status',User::itemAlias('UserStatus')); ?>
		<?php echo $form->error($model,'status'); ?>
	</div>
<?php 
		$profileFields=$profile->getFields();
		if ($profileFields) {
			foreach($profileFields as $field) {
			?>
	<div class="row">
		<?php echo $form->labelEx($profile,$field->varname); ?>
		<?php 
		if ($widgetEdit = $field->widgetEdit($profile)) {
			echo $widgetEdit;
		} elseif ($field->range) {
			echo $form->dropDownList($profile,$field->varname,Profile::range($field->range));
		} elseif ($field->field_type=="TEXT") {
			echo CHtml::activeTextArea($profile,$field->varname,array('rows'=>6, 'cols'=>50));
		} else {
			echo $form->textField($profile,$field->varname,array('size'=>60,'maxlength'=>(($field->field_size)?$field->field_size:255)));
		}
		 ?>
		<?php echo $form->error($profile,$field->varname); ?>
	</div>
			<?php
			}
		}
?>
	<div class="row">
		<?php echo $form->labelEx($position,'position_type'); ?>
		<?php 	$this->widget('ext.ESelect2.ESelect2',array(
				//'name' => 'position_type',
				'model'=>$position,
				'attribute'=>'position_type',
				'options'=>array(
					'width'=>'200px',
					'placeholder'=>'Select Type : ',
				),
				'data' => array(
					'contractual' => 'Contractual',
					'dole-gip' => 'DOLE-GIP',
					'job_order' => 'Job Order',
					'ojt' => 'On-The-Job Training',
					'project_base' => 'Project Based',
					'regular' => 'Regular',
				),
				'htmlOptions'=>array(
					'ajax'=>array( 
						'type'=>'POST',
						'url'=>$this->createUrl('admin/getPosition'),
						//'update'=>'#methodrefs',
						'update'=>'#Position_position_id',
					),
				),
			));
		?>
		
		<?php echo $form->error($position,'position_type'); ?>
	</div>
	

	<div class="row">
		<?php echo $form->labelEx($division,'division_id'); ?>
		<?php 	$this->widget('ext.ESelect2.ESelect2',array(
				'model'=>$division,
				'attribute'=>'division_id',
				//'data'=>$testname,
				//'data'=>Testname::listDataBySampleType(),
				'data'=>CHtml::listData(ReferDivision::model()->findAll(),'refer_id','division_name'),
				'options'=>array(
					'width'=>'400px',
					'placeholder'=>'Select Division : ',
				),
			));
		?>

		<?php echo $form->error($division,'division_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($division,'station_id'); ?>
		<?php 	$this->widget('ext.ESelect2.ESelect2',array(
				'model'=>$division,
				'attribute'=>'station_id',
				//'data'=>$testname,
				//'data'=>Testname::listDataBySampleType(),
				'data'=>CHtml::listData(Station::model()->findAll(),'id','description'),
				'options'=>array(
					'width'=>'400px',
					'placeholder'=>'Select Station : ',
				),
			));
		?>

		<?php echo $form->error($division,'station_id'); ?>
	</div>

	<?php
	
	if (Yii::app()->user->isSuperuser) {
		   Yii::app()->getModule("rights")->getAuthorizer()->getSuperusers();
	       $all_roles=new RAuthItemDataProvider('roles', array( 
		'type'=>2,
		));
	      $data=$all_roles->fetchData();
	?>
    <div>
		<?php 
			// $roles=Rights::getAssignedRoles(Yii::app()->user->Id);
   //  		foreach($roles as $role)
    		
   //     		echo $role->name."<br />";
		?>
        <label for="type_id">Type</label>
        <?php echo CHtml::dropDownList("accesslevel",'',CHtml::listData($data,'name','name'));?> 
    </div>
<?php
}
?>


	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? UserModule::t('Create') : UserModule::t('Save')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->