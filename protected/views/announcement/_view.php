<?php
/* @var $this AnnouncementController */
/* @var $data Announcement */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('datefiled')); ?>:</b>
	<?php echo CHtml::encode($data->datefiled); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('datedisplayfrom')); ?>:</b>
	<?php echo CHtml::encode($data->datedisplay); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('datedisplayto')); ?>:</b>
	<?php echo CHtml::encode($data->datedisplay); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('description')); ?>:</b>
	<?php echo CHtml::encode($data->description); ?>
	<br />


</div>