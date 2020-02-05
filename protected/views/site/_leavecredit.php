<?php
		$this->beginWidget('zii.widgets.CPortlet', array(
			'title'=>"<i class='icon-tag'></i> Leave Credits",
		));
		
	?>
	     <div class="view">
	    	<?php
	    	echo "<strong>".myhelper::getfullname($id)."</strong><br/>";
	    	//$data = ReferLeave::model()->findByAttributes(array('user_id'=>$id));
	    	$credits = ReferCredits::model()->findAllByAttributes(array('user_id'=>$id));
	    	//print_r($credits);
	    	foreach ($credits as $credit) {
	    		# code...
	    		echo CHtml::encode(myhelper::creditterm($credit->type)); 
	    		echo " : ";
	    		echo "<b>". CHtml::encode($credit->balance). "</b>";
	    		echo "<br/>";
	    	}

	    	?>
		</div>   
 <?php $this->endWidget();?>