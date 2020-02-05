<?php
/* @var $this SuggestionController */
/* @var $data Suggestion */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('datefiled')); ?>:</b>
	<?php echo CHtml::encode($data->datefiled); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('suggestiontext')); ?>:</b>
	<?php echo CHtml::encode($data->suggestiontext); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('suggestby')); ?>:</b>
	<?php echo CHtml::encode($data->suggestby); ?>
	<br />


</div>