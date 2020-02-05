<?php
/* @var $this MoraleanswerController */

$this->breadcrumbs=array(
	'Moraleanswer',
);
?>
<style type="text/css">
b{
	color:#272727;
}	
</style>
<p>In our effort to achieve performance excellence, we want to maintain a strong and committed workforce within DOST-IX. We want to ensure that our employees’ needs and concerns are well addressed. We are therefore conducting this “Morale Survey” to assess the morale and satisfaction level of each employee. The results of this survey will definitely serve as valuable inputs for organizational improvement. Please answer each question as honestly as possible by ticking the appropriate box opposite each number. Thank you.</p>
<h3>LEGENDS : 
<b>D</b><i>efinitely</i> <b>N</b><i>o</i> /
<b>N</b><i>o</i> /
<b>N</b><i>ot</i> <b>S</b><i>ure</i> /
<b>Y</b>es /
<b>D</b><i>efinitely</i> <b>Y</b><i>es</i>
</h3>
<?php echo CHtml::link('See Consolidated report',$this->createUrl('/library/moraleanswer/consolidate'),array('class'=>'btn btn-success btn-large pull-right'));?> 
<h1><?php echo $moralesurvey->name?></h1>

<p class="alert alert-error">
	Effective from <b><?php echo Yii::app()->dateFormatter->format("y MMMM d",$moralesurvey->datefrom)?></b> to <b><?php echo Yii::app()->dateFormatter->format("y MMMM d",$moralesurvey->dateto)?></b>
</p>
<p class="alert alert-info">
	<b>Autosave</b> : Submissions are done automatically each time you click a button (button becomes blue), Make sure to fill up every question down here. Feel free to change your selections before the fill-up time expires :)
</p>

<?php

foreach ($questions as $question) {
	# code...
	echo "<div class='stat-block' id='block-".$question->id."'>";
	echo "<div style='font-size:20px' class='span8'>$question->question</div>";
	//echo "</p>";

	echo "<div class='span4'>";
	echo "<p class='pull-right'>";
	echo CHtml::ajaxSubmitButton(
			    'DN',
			    Yii::app()->createUrl('/library/moraleanswer/answer',array('qid'=>$question->id,'answer'=>'DN','sid'=>$moralesurvey->id)),
			    array(
			        'update'=>'#xyz',
			        'success'=>'js:function(data){
					    $("#btndn"+'.$question->id.').addClass("btn-info");
					    $("#btnn"+'.$question->id.').removeClass("btn-info");
					    $("#btnns"+'.$question->id.').removeClass("btn-info");
					    $("#btny"+'.$question->id.').removeClass("btn-info");
					    $("#btndy"+'.$question->id.').removeClass("btn-info");
					    $("#block-"+'.$question->id.').addClass("q-green");
		   			}',
			    ),
			    array(
			        'class'=>'btn btn-medium',
			        'id'=>'btndn'.$question->id,
			        //'confirm'=>'Are you sure you want to approve this request?',
			    )
			);
	
	echo CHtml::ajaxSubmitButton(
			    'N',
			    Yii::app()->createUrl('/library/moraleanswer/answer',array('qid'=>$question->id,'answer'=>'N','sid'=>$moralesurvey->id)),
			    array(
			        'update'=>'#xyz',
			        'success'=>'js:function(data){
						$("#btndn"+'.$question->id.').removeClass("btn-info");
					    $("#btnn"+'.$question->id.').addClass("btn-info");
					    $("#btnns"+'.$question->id.').removeClass("btn-info");
					    $("#btny"+'.$question->id.').removeClass("btn-info");
					    $("#btndy"+'.$question->id.').removeClass("btn-info");
					     $("#block-"+'.$question->id.').addClass("q-green");
		   			}',	
			    ),
			    array(
			        'class'=>'btn btn-medium',
			        'id'=>'btnn'.$question->id,
			        //'confirm'=>'Are you sure you want to approve this request?',
			    )
			);
	// echo "</p'>";
	// echo "<p class='stat-block span1'>";
	echo CHtml::ajaxSubmitButton(
			    'NS',
			    Yii::app()->createUrl('/library/moraleanswer/answer',array('qid'=>$question->id,'answer'=>'NS','sid'=>$moralesurvey->id)),
			    array(
			        'update'=>'#xyz',
			        'success'=>'js:function(data){
						$("#btndn"+'.$question->id.').removeClass("btn-info");
					    $("#btnn"+'.$question->id.').removeClass("btn-info");
					    $("#btnns"+'.$question->id.').addClass("btn-info");
					    $("#btny"+'.$question->id.').removeClass("btn-info");
					    $("#btndy"+'.$question->id.').removeClass("btn-info");
					    $("#block-"+'.$question->id.').addClass("q-green");
		   			}',	
			    ),
			    array(
			        'class'=>'btn btn-medium',
			        'id'=>'btnns'.$question->id,
			        //'confirm'=>'Are you sure you want to approve this request?',
			    )
			);
	// echo "</p'>";
	// echo "<p class='stat-block span1'>";
	echo CHtml::ajaxSubmitButton(
			    'Y',
			    Yii::app()->createUrl('/library/moraleanswer/answer',array('qid'=>$question->id,'answer'=>'Y','sid'=>$moralesurvey->id)),
			    array(
			        'update'=>'#xyz',
			        'success'=>'js:function(data){
						$("#btndn"+'.$question->id.').removeClass("btn-info");
					    $("#btnn"+'.$question->id.').removeClass("btn-info");
					    $("#btnns"+'.$question->id.').removeClass("btn-info");
					    $("#btny"+'.$question->id.').addClass("btn-info");
					    $("#btndy"+'.$question->id.').removeClass("btn-info");
					    $("#block-"+'.$question->id.').addClass("q-green");
		   			}',	
			    ),
			    array(
			        'class'=>'btn btn-medium',
			        'id'=>'btny'.$question->id,
			        //'confirm'=>'Are you sure you want to approve this request?',
			    )
			);
	// echo "</p'>";
	// echo "<p class='stat-block span1'>";
	echo CHtml::ajaxSubmitButton(
			    'DY',
			    Yii::app()->createUrl('/library/moraleanswer/answer',array('qid'=>$question->id,'answer'=>'DY','sid'=>$moralesurvey->id)),
			    array(
			        'update'=>'#xyz',
			        'success'=>'js:function(data){
						$("#btndn"+'.$question->id.').removeClass("btn-info");
					    $("#btnn"+'.$question->id.').removeClass("btn-info");
					    $("#btnns"+'.$question->id.').removeClass("btn-info");
					    $("#btny"+'.$question->id.').removeClass("btn-info");
					    $("#btndy"+'.$question->id.').addClass("btn-info");
					    $("#block-"+'.$question->id.').addClass("q-green");
		   			}',	
			    ),
			    array(
			        'class'=>'btn btn-medium',
			        'id'=>'btndy'.$question->id,
			        //'confirm'=>'Are you sure you want to approve this request?',
			    )
			);
	echo "</p>";
	echo "</div>";
echo "</div>";

}


if($answered){
	foreach ($answered as $ans) {
		if($ans->answer == 'DN'){
			echo '<script>$("#btndn"+'.$ans->question.').addClass("btn-info");
			$("#block-"+'.$ans->question.').addClass("q-green");</script>';
		}
		elseif($ans->answer == 'N'){
			echo '<script>$("#btnn"+'.$ans->question.').addClass("btn-info");
			$("#block-"+'.$ans->question.').addClass("q-green");</script>';
		}
		elseif($ans->answer == 'NS'){
			echo '<script>$("#btnns"+'.$ans->question.').addClass("btn-info");
			$("#block-"+'.$ans->question.').addClass("q-green");</script>';
		}
		elseif($ans->answer == 'Y'){
			echo '<script>$("#btny"+'.$ans->question.').addClass("btn-info");
			$("#block-"+'.$ans->question.').addClass("q-green");</script>';
		}
		elseif($ans->answer == 'DY'){
			echo '<script>$("#btndy"+'.$ans->question.').addClass("btn-info");
			$("#block-"+'.$ans->question.').addClass("q-green");</script>';
		}
	}
}

 ?>

