<?php
/* @var $this MoraleanswerController */

$this->breadcrumbs=array(
	'Moraleanswer->consolidate',
);
$baseUrl = Yii::app()->theme->baseUrl; 
?>
<h1><?php echo "Consolidated data of ".$moralesurvey->name?>
        <?php echo CHtml::link('<i class="icon icon-print"></i> Print per question',$this->createUrl('/library/moraleanswer/viewperquestion'),array('class'=>'btn btn-success btn-large text-center pull-right'));?>
        <?php echo CHtml::link('<i class="icon icon-print"></i> Print',$this->createUrl('/library/moraleanswer/view'),array('class'=>'btn btn-success btn-large text-center pull-right'));?>
</h1>

<p class="alert alert-error">
	Effective from <b><?php echo Yii::app()->dateFormatter->format("y MMMM d",$moralesurvey->datefrom)?></b> to <b><?php echo Yii::app()->dateFormatter->format("y MMMM d",$moralesurvey->dateto)?></b>
</p>
<div class="row-fluid">
	<div class="span3 sidebar-nav">
		

	<?php 


	//content is all types of leave
	$this->widget('zii.widgets.CMenu', array(
	/*'type'=>'list',*/
	'encodeLabel'=>false,
	'items'=>array(
	    // Include the operations menu
        array('label'=>'ORD RATING : '.Moraleanswer::model()->getAverage($ord_ids,$moralesurvey->id), 'url'=>"#",'itemOptions'=>array('class'=>'','onclick'=>'$("#ord").dialog("open"); return false;')),
        array('label'=>'FOS RATING : '.Moraleanswer::model()->getAverage($fos_ids,$moralesurvey->id), 'url'=>"#",'itemOptions'=>array('class'=>'','onclick'=>'$("#fos").dialog("open"); return false;')),
        array('label'=>'TS RATING : '.Moraleanswer::model()->getAverage($ts_ids,$moralesurvey->id), 'url'=>"#",'itemOptions'=>array('class'=>'','onclick'=>'$("#ts").dialog("open"); return false;')),
        array('label'=>'RSTL RATING : '.Moraleanswer::model()->getAverage($rstl_ids,$moralesurvey->id), 'url'=>"#",'itemOptions'=>array('class'=>'','onclick'=>'$("#rstl").dialog("open"); return false;')),
        array('label'=>'FASS RATING : '.Moraleanswer::model()->getAverage($fass_ids,$moralesurvey->id), 'url'=>"#",'itemOptions'=>array('class'=>'','onclick'=>'$("#fass").dialog("open"); return false;')),
        array('label'=>'PSTC ZDS RATING : '.Moraleanswer::model()->getAverage($pstc_zds_ids,$moralesurvey->id), 'url'=>"#",'itemOptions'=>array('class'=>'','onclick'=>'$("#pstc_zds").dialog("open"); return false;')),
        array('label'=>'PSTC ZDN RATING : '.Moraleanswer::model()->getAverage($pstc_zdn_ids,$moralesurvey->id), 'url'=>"#",'itemOptions'=>array('class'=>'','onclick'=>'$("#pstc_zdn").dialog("open"); return false;')),
        array('label'=>'PSTC ZS RATING : '.Moraleanswer::model()->getAverage($pstc_zs_ids,$moralesurvey->id), 'url'=>"#",'itemOptions'=>array('class'=>'','onclick'=>'$("#pstc_zs").dialog("open"); return false;')),
        )
	));

	?>



	</div>
	<div class="span9">
    <div class="row">
        <div class="pull-right">

            <?php echo CHtml::link('Permanent rating: '.Moraleanswer::model()->getAverage($all_p_ids,$moralesurvey->id),"#",array('class'=>'btn btn-warning btn-xlarge text-center','onclick'=>'$("#_all_p").dialog("open"); return false;'));?>
        
            <?php echo CHtml::link('Project Based rating: '.Moraleanswer::model()->getAverage($all_pb_ids,$moralesurvey->id),"#",array('class'=>'btn btn-warning btn-xlarge text-center','onclick'=>'$("#_all_pb").dialog("open"); return false;'));?>
        
        
            <?php echo CHtml::link('Contractual rating: '.Moraleanswer::model()->getAverage($all_c_ids,$moralesurvey->id),"#",array('class'=>'btn btn-warning btn-xlarge text-center','onclick'=>'$("#_all_c").dialog("open"); return false;'));?>
        </div>
    </div>

    <div class="row">
    <div class="hero-unit">
        <?php 
            echo "<h1>Overall Ratings : ".Moraleanswer::model()->getAverage($all_ids,$moralesurvey->id)."</h1>";


        ?>
       </div>
    </div>
	</div>
	
</div>




<?php
$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
    'id'=>'ord',
    // additional javascript options for the dialog plugin
    'options'=>array(
        'title'=>'Rates',
        'autoOpen'=>false,
        'show'=>'scale',
        'hide'=>'scale',                
        'width'=>'auto',
        'modal'=>true,
        'resizable'=>false,
    ),
));
 
$this->renderPartial('_ord_p',array( //ord P
	'ord_ids'=>$ord_ids,
	'ords'=>$ords,
    'msid'=>$moralesurvey->id,
));


$this->endWidget('zii.widgets.jui.CJuiDialog'); ?>

 


<?php
$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
    'id'=>'fos',
    // additional javascript options for the dialog plugin
    'options'=>array(
        'title'=>'Rates',
        'autoOpen'=>false,
        'show'=>'scale',
        'hide'=>'scale',                
        'width'=>'auto',
        'modal'=>true,
        'resizable'=>false,
    ),
));
 
 $this->renderPartial('_fos_p',array( //ord P
	'fos_p_ids'=>$fos_p_ids,
	'fos_p'=>$fos_p,
	'fos_pb_ids'=>$fos_pb_ids,
	'fos_pb'=>$fos_pb,
	'fos_ids'=>$fos_ids,
    'msid'=>$moralesurvey->id,
)); 


$this->endWidget('zii.widgets.jui.CJuiDialog'); ?>




<?php
$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
    'id'=>'ts',
    // additional javascript options for the dialog plugin
    'options'=>array(
        'title'=>'Rates',
        'autoOpen'=>false,
        'show'=>'scale',
        'hide'=>'scale',                
        'width'=>'auto',
        'modal'=>true,
        'resizable'=>false,
    ),
));
 
 $this->renderPartial('_ts_p',array( //ord P
	'ts_p_ids'=>$ts_p_ids,
	'ts_p'=>$ts_p,
	'ts_pb_ids'=>$ts_pb_ids,
	'ts_pb'=>$ts_pb,
	'ts_ids'=>$ts_ids,
    'msid'=>$moralesurvey->id,
)); 


$this->endWidget('zii.widgets.jui.CJuiDialog'); ?>



<?php
$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
    'id'=>'rstl',
    // additional javascript options for the dialog plugin
    'options'=>array(
        'title'=>'Rates',
        'autoOpen'=>false,
        'show'=>'scale',
        'hide'=>'scale',                
        'width'=>'auto',
        'modal'=>true,
        'resizable'=>false,
    ),
));
 
 $this->renderPartial('_rstl_p',array( //ord P
	'rstl_p_ids'=>$rstl_p_ids,
	'rstl_p'=>$rstl_p,
	'rstl_pb_ids'=>$rstl_pb_ids,
	'rstl_pb'=>$rstl_pb,
	'rstl_ids'=>$rstl_ids,
    'msid'=>$moralesurvey->id,
)); 


$this->endWidget('zii.widgets.jui.CJuiDialog'); ?>



<?php
$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
    'id'=>'fass',
    // additional javascript options for the dialog plugin
    'options'=>array(
        'title'=>'Rates',
        'autoOpen'=>false,
        'show'=>'scale',
        'hide'=>'scale',                
        'width'=>'auto',
        'modal'=>true,
        'resizable'=>false,
    ),
));
 
 $this->renderPartial('_fass_p',array( //ord P
	'fass_p_ids'=>$fass_p_ids,
	'fass_p'=>$fass_p,
	'fass_c_ids'=>$fass_c_ids,
	'fass_c'=>$fass_c,
	'fass_ids'=>$fass_ids,
    'msid'=>$moralesurvey->id,
)); 


$this->endWidget('zii.widgets.jui.CJuiDialog'); ?>






<?php
$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
    'id'=>'pstc_zds',
    // additional javascript options for the dialog plugin
    'options'=>array(
        'title'=>'Rates',
        'autoOpen'=>false,
        'show'=>'scale',
        'hide'=>'scale',                
        'width'=>'auto',
        'modal'=>true,
        'resizable'=>false,
    ),
));
 
 $this->renderPartial('_pstc_zds',array( //ord P
	'pstc_p_zds_ids'=>$pstc_p_zds_ids,
	'pstc_p_zds'=>$pstc_p_zds,
	'pstc_pb_zds_ids'=>$pstc_pb_zds_ids,
	'pstc_pb_zds'=>$pstc_pb_zds,
	'pstc_c_zds_ids'=>$pstc_c_zds_ids,
	'pstc_c_zds'=>$pstc_c_zds,
	'pstc_zds_ids'=>$pstc_zds_ids,
    'msid'=>$moralesurvey->id,
)); 


$this->endWidget('zii.widgets.jui.CJuiDialog'); ?>




<?php
$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
    'id'=>'pstc_zdn',
    // additional javascript options for the dialog plugin
    'options'=>array(
        'title'=>'Rates',
        'autoOpen'=>false,
        'show'=>'scale',
        'hide'=>'scale',                
        'width'=>'auto',
        'modal'=>true,
        'resizable'=>false,
    ),
));
 
 $this->renderPartial('_pstc_zdn',array( //ord P
	'pstc_p_zdn_ids'=>$pstc_p_zdn_ids,
	'pstc_p_zdn'=>$pstc_p_zdn,
	'pstc_pb_zdn_ids'=>$pstc_pb_zdn_ids,
	'pstc_pb_zdn'=>$pstc_pb_zdn,
	'pstc_c_zdn_ids'=>$pstc_c_zdn_ids,
	'pstc_c_zdn'=>$pstc_c_zdn,
	'pstc_zdn_ids'=>$pstc_zdn_ids,
    'msid'=>$moralesurvey->id,
)); 


$this->endWidget('zii.widgets.jui.CJuiDialog'); ?>



<?php
$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
    'id'=>'pstc_zs',
    // additional javascript options for the dialog plugin
    'options'=>array(
        'title'=>'Rates',
        'autoOpen'=>false,
        'show'=>'scale',
        'hide'=>'scale',                
        'width'=>'auto',
        'modal'=>true,
        'resizable'=>false,
    ),
));
 
 $this->renderPartial('_pstc_zs',array( //ord P
	'pstc_p_zs_ids'=>$pstc_p_zs_ids,
	'pstc_p_zs'=>$pstc_p_zs,
	'pstc_pb_zs_ids'=>$pstc_pb_zs_ids,
	'pstc_pb_zs'=>$pstc_pb_zs,
	'pstc_c_zs_ids'=>$pstc_c_zs_ids,
	'pstc_c_zs'=>$pstc_c_zs,
	'pstc_zs_ids'=>$pstc_zs_ids,
    'msid'=>$moralesurvey->id,
)); 


$this->endWidget('zii.widgets.jui.CJuiDialog'); ?>



<?php
$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
    'id'=>'_all_p',
    // additional javascript options for the dialog plugin
    'options'=>array(
        'title'=>'Rates',
        'autoOpen'=>false,
        'show'=>'scale',
        'hide'=>'scale',                
        'width'=>'auto',
        'modal'=>true,
        'resizable'=>false,
    ),
));
 
 $this->renderPartial('_all_p',array( //ord P
	'all_p'=>$all_p,
	'all_p_ids'=>$all_p_ids,
    'msid'=>$moralesurvey->id,
)); 


$this->endWidget('zii.widgets.jui.CJuiDialog'); ?>




<?php
$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
    'id'=>'_all_pb',
    // additional javascript options for the dialog plugin
    'options'=>array(
        'title'=>'Rates',
        'autoOpen'=>false,
        'show'=>'scale',
        'hide'=>'scale',                
        'width'=>'auto',
        'modal'=>true,
        'resizable'=>false,
    ),
));
 
 $this->renderPartial('_all_pb',array( //ord P
	'all_pb'=>$all_pb,
	'all_pb_ids'=>$all_pb_ids,
    'msid'=>$moralesurvey->id,
)); 


$this->endWidget('zii.widgets.jui.CJuiDialog'); ?>



<?php
$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
    'id'=>'_all_c',
    // additional javascript options for the dialog plugin
    'options'=>array(
        'title'=>'Rates',
        'autoOpen'=>false,
        'show'=>'scale',
        'hide'=>'scale',                
        'width'=>'auto',
        'modal'=>true,
        'resizable'=>false,
    ),
));
 
 $this->renderPartial('_all_c',array( //ord P
	'all_c'=>$all_c,
	'all_c_ids'=>$all_c_ids,
    'msid'=>$moralesurvey->id,
)); 


$this->endWidget('zii.widgets.jui.CJuiDialog'); ?>
<!-- 

	<?php

	$this->beginWidget('zii.widgets.CPortlet', array(
			'title'=>"OVERALL PSTC",
		));?>

		<div class="row-fluid">
			<div class="alert alert-success">
				<b>Overall pstc zs:</b>
			    <i class="badge badge-warning" title="DN"><?php echo Moraleanswer::model()->getSummary($pstc_ids,'DN',$moralesurvey->id); ?> DN</i>
			    <i class="badge badge-warning" title="N"><?php echo Moraleanswer::model()->getSummary($pstc_ids,'N',$moralesurvey->id); ?> N</i>
			    <i class="badge badge-warning" title="NS"><?php echo Moraleanswer::model()->getSummary($pstc_ids,'NS',$moralesurvey->id); ?> NS</i>
			    <i class="badge badge-warning" title="Y"><?php echo Moraleanswer::model()->getSummary($pstc_ids,'Y',$moralesurvey->id); ?> Y</i>
			    <i class="badge badge-warning" title="DY"><?php echo Moraleanswer::model()->getSummary($pstc_ids,'DY',$moralesurvey->id); ?> DY</i>
			    <br />
			    <div class="row-fluid">
			    <div class="summary">
		          <ul>
		          	<li>
		          		<span class="summary-icon">
		                	<img src="<?php echo $baseUrl ;?>/img/group.png" width="36" height="36" alt="Monthly Income">
		                </span>
		                <span class="summary-number"><?php echo Moraleanswer::model()->getAverage($pstc_ids,$moralesurvey->id); ?></span>
		                <span class="summary-title"> Rating</span>
		            </li>
		          </ul>
		         </div>

			   		
		    	</div>
	    	</div>
		</div>

	<?php $this->endWidget();?> -->