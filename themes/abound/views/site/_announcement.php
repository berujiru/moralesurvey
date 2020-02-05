 <?php
 Yii::app()->clientScript->scriptMap = array(
    'all.js' => false
);
//$btn = CHtml::link('<i class="icon icon-plus"></i>',$this->createUrl('/announcement/create'),array('class'=>'btn btn-info','style'=>'float:right;position:fixed;'));
 $this->beginWidget('zii.widgets.CPortlet', array(
                        'title'=>"<i class='icon-bell'></i><strong>MEMO and ANNOUNCEMENT</strong>",
                    )
 					,array('class'=>'portletbold announcewindow'));
 echo CHtml::link('Post New Announcement',$this->createUrl('/announcement/create'),array('class'=>'btn btn-info btn-medium'));
 echo "</br><b> (note: you can click the announcement to stop from moving)</b>";                   
?>
<!-- <h3><strong>-No Announcement Yet-</strong></h3> -->

<div style="margin-top:5px;border-top:2px solid #d3d3d3;border-bottom:2px solid #d3d3d3;">
	<marquee direction="up" behavior="scroll"  class="announce" height="400px"  onmousedown="this.stop();" onmouseup="this.start();">
		<div class="list-view lead">
		<?php
		//call all the announcements
		$all = Announcement::model()->findAll(array('condition'=>'datedisplayfrom <= "'.date("Y-m-d").'" and datedisplayto >= "'.date("Y-m-d").'"','order'=>'datefiled DESC','limit'=>'5'));
		if(!$all)
			echo "No Announcement Yet";
		foreach ($all as $one) {
			echo "<div class='view code_preview well'>";
			echo "<b class='label label-important'>$one->datefiled</b>";
			echo "<br/>";
			echo nl2br("<p>$one->description</p>");
			
			if($one->profile){
				echo "<br/>";
				echo "<i class='label label-info'>-".$one->profile->firstname." ".$one->profile->lastname."</i>";
			}
			echo "<br/>";
			echo "</div>";
		}
		?>
		</div>
	</marquee>
</div>

<?php 
$this->endWidget();?> 
