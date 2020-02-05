<?php
/* @var $this ReferDivisionController */
/* @var $data ReferDivision */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('refer_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->refer_id), array('view', 'id'=>$data->refer_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('division_code')); ?>:</b>
	<?php echo CHtml::encode($data->division_code); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('division_name')); ?>:</b>
	<?php echo CHtml::encode($data->division_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('assigned')); ?>:</b>
	<?php echo CHtml::encode($data->assigned); ?>
	<br />


</div>