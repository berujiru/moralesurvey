<?php
/* @var $this MoralestatusController */

$this->breadcrumbs=array(
	'Moraleconfig',
);
?>
<h1>Morale Config</h1>


<?php
$ctr = 0 ;
foreach ($Users as $User) {
	$ctr +=1;
	# code...
	echo "<div class='stat-block' id='block-".$User->id."'>";
	echo "<div style='font-size:20px' class='span8'>$ctr. ". myhelper::getfullname($User->id)." (ID:$User->id ) </div>";
	//echo "</p>";

	echo "<div class='span4'>";
	$uid = $User->id;
			 $this->widget('ext.ESelect2.ESelect2',array(        
                   // 'model'=>Profile::model(),
                   // 'attribute' =>'user_id',
                   'data'=>CHtml::listData(ReferDivision::model()->findAll(),'refer_id','division_name'),
                   'id'=>'div-'.$User->id,
                   'name'=>'div-'.$User->id,
                   'value'=>$User->moraleconfig?$User->moraleconfig->division:" ",
                   'options'  => array(
                       'placeholder'=>'Select Division',
                       'width'=>'200px',
                       ),
                    'htmlOptions'=>array(
				        'onChange'=>CHtml::ajax(array('type'=>'POST',
				                'url'=>$this->createUrl('/library/moraleconfig/division',array('user_id'=>$User->id)),
				                //"js:$(this).serialize()+ '&customer_id='+customer_id",
				                 'data'=> "js:'&division='+$(this).val()",
				                //'data'=> "js:$(this).serialize()",
				                'type'=>'post',
				                'success'=>'function(data)
				                {

				                alert(data);
				                }',
				                
				                )),
				        ),
            ));



        




			

		 	


	echo "<p class='pull-right'>";
	echo CHtml::ajaxSubmitButton(
			    'Inactive',
			    Yii::app()->createUrl('/library/moraleconfig/answer',array('user_id'=>$User->id,'status'=>'0')),
			    array(
			        //'update'=>'#xyz',
			        'success'=>'js:function(data){
					    $("#btninactive"+'.$User->id.').addClass("btn-info");
					    $("#btnactive"+'.$User->id.').removeClass("btn-info");
					    $("#block-"+'.$User->id.').removeClass("q-green");
					    $("#block-"+'.$User->id.').addClass("q-red");
		   			}',
			    ),
			    array(
			        'class'=>'btn btn-medium',
			        'id'=>'btninactive'.$User->id,
			        //'confirm'=>'Are you sure you want to approve this request?',
			    )
			);
	

	echo CHtml::ajaxSubmitButton(
			    'Active',
			    Yii::app()->createUrl('/library/moraleconfig/answer',array('user_id'=>$User->id,'status'=>'1')),
			    array(
			        //'update'=>'#xyz',
			        'success'=>'js:function(data){
						$("#btninactive"+'.$User->id.').removeClass("btn-info");
					    $("#btnactive"+'.$User->id.').addClass("btn-info");
					    $("#block-"+'.$User->id.').removeClass("q-red");
					    $("#block-"+'.$User->id.').addClass("q-green");
		   			}',	
			    ),
			    array(
			        'class'=>'btn btn-medium',
			        'id'=>'btnactive'.$User->id,
			        //'confirm'=>'Are you sure you want to approve this request?',
			    )
			);
	// echo "</p'>";
	
	
	echo "</p>";
	echo "</div>";
echo "</div>";

}


if($configs){
	foreach ($configs as $config) {
		if($config->status == '0'){
			echo '<script>$("#btninactive"+'.$config->user_id.').addClass("btn-info");
			$("#block-"+'.$config->user_id.').addClass("q-red");</script>';
		}
		elseif($config->status == '1'){
			echo '<script>$("#btnactive"+'.$config->user_id.').addClass("btn-info");
			$("#block-"+'.$config->user_id.').addClass("q-green");</script>';
		}
		
	}
}




 ?>
