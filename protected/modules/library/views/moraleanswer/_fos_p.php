<?php $this->beginWidget('zii.widgets.CPortlet', array(
			'title'=>"Field Operation Services (FOS)",
		));
		?>
	<div class="row-fluid">
		<div class="span8 q-green">
	<p>Regular</p>
	<?php $this->widget('zii.widgets.grid.CGridView', array(
	    'dataProvider'=>$fos_p,
	    'htmlOptions'=>array('width'=>'310px'),
	    'columns'=>array(
	    	array(
	    		'name'=>'id',
				'header'=>'#',
				'value'=>'$row+1',
				'filter'=>false,
				'htmlOptions'=>array('width'=>'20px'),
	    		),
	   //  	array(
	   //  		'name'=>'name',
				// 'header'=>'name',
				// //'value'=>'$data->id',
				// //'value'=>Moraleanswer::model()->getAnswer($this->data->id,'DN'),
				//  'value'=>function($data){
				//  	echo myhelper::getfullname($data->id);
				//  },
				// 'filter'=>false,
	   //  		),
	    	array(
	    		'name'=>'dn',
				'header'=>'DN',
				//'value'=>'$data->id',
				//'value'=>Moraleanswer::model()->getAnswer($this->data->id,'DN'),
				'value'=>function($data,$datacolumn) use($msid){
				 	echo Moraleanswer::model()->getAnswer($data->id,'DN',$msid);
				 },
				'filter'=>false,
				'htmlOptions'=>array('width'=>'40px'),
	    		),
	    	array(
	    		'name'=>'n',
				'header'=>'N',
				'value'=>function($data,$datacolumn) use($msid){
				 	echo Moraleanswer::model()->getAnswer($data->id,'N',$msid);
				 },
				'filter'=>false,
				'htmlOptions'=>array('width'=>'40px'),
	    		),
	    	array(
	    		'name'=>'ns',
				'header'=>'NS',
				'value'=>function($data,$datacolumn) use($msid){
				 	echo Moraleanswer::model()->getAnswer($data->id,'NS',$msid);
				 },
				'filter'=>false,
				'htmlOptions'=>array('width'=>'40px'),
	    		),
	    	array(
	    		'name'=>'y',
				'header'=>'Y',
				'value'=>function($data,$datacolumn) use($msid){
				 	echo Moraleanswer::model()->getAnswer($data->id,'Y',$msid);
				 },
				'filter'=>false,
				'htmlOptions'=>array('width'=>'40px'),
	    		),
	    	array(
	    		'name'=>'dy',
				'header'=>'DY',
				'value'=>function($data,$datacolumn) use($msid){
				 	echo Moraleanswer::model()->getAnswer($data->id,'DY',$msid);
				 },
				'filter'=>false,
				'htmlOptions'=>array('width'=>'40px'),
	    		),
	    	array(
	    		'name'=>'total',
				'header'=>'Total',
				'value'=>function($data,$datacolumn) use($msid){
				 	echo Moraleanswer::model()->getTotalanswer($data->id,$msid);
				 },
				'filter'=>false,
				'htmlOptions'=>array('width'=>'40px'),
	    		),
	    	array(
	    		'name'=>'index',
				'header'=>'Index',
				'value'=>function($data,$datacolumn) use($msid){
				 	echo Moraleanswer::model()->getIndex($data->id,$msid);
				 },
				'filter'=>false,
				'htmlOptions'=>array('width'=>'50px'),
	    		),
	    ),
	)); ?>
	</div>
	<div class="span4 q-red">
		<b>Summary:</b>
	    <i class="badge badge-warning" title="DN"><?php echo Moraleanswer::model()->getSummary($fos_p_ids,'DN',$msid); ?> DN</i>
	    <i class="badge badge-warning" title="N"><?php echo Moraleanswer::model()->getSummary($fos_p_ids,'N',$msid); ?> N</i>
	    <i class="badge badge-warning" title="NS"><?php echo Moraleanswer::model()->getSummary($fos_p_ids,'NS',$msid); ?> NS</i>
	    <i class="badge badge-warning" title="Y"><?php echo Moraleanswer::model()->getSummary($fos_p_ids,'Y',$msid); ?> Y</i>
	    <i class="badge badge-warning" title="DY"><?php echo Moraleanswer::model()->getSummary($fos_p_ids,'DY',$msid); ?> DY</i>
	    
		<h2><?php echo Moraleanswer::model()->getAverage($fos_p_ids,$msid); ?></h2>
         
    </div>
	</div>
	<hr/>
	<div class="row-fluid">
		<div class="span8 q-green">
	<p>Project Base</p>
	<?php $this->widget('zii.widgets.grid.CGridView', array(
	    'dataProvider'=>$fos_pb,
	    'htmlOptions'=>array('width'=>'310px'),
	    'columns'=>array(
	    	array(
	    		'name'=>'id',
				'header'=>'#',
				'value'=>'$row+1',
				'filter'=>false,
				'htmlOptions'=>array('width'=>'20px'),
	    		),
	   //  	array(
	   //  		'name'=>'name',
				// 'header'=>'name',
				// //'value'=>'$data->id',
				// //'value'=>Moraleanswer::model()->getAnswer($this->data->id,'DN'),
				//  'value'=>function($data){
				//  	echo myhelper::getfullname($data->id);
				//  },
				// 'filter'=>false,
	   //  		),
	    	array(
	    		'name'=>'dn',
				'header'=>'DN',
				//'value'=>'$data->id',
				//'value'=>Moraleanswer::model()->getAnswer($this->data->id,'DN'),
				'value'=>function($data,$datacolumn) use($msid){
				 	echo Moraleanswer::model()->getAnswer($data->id,'DN',$msid);
				 },
				'filter'=>false,
				'htmlOptions'=>array('width'=>'40px'),
	    		),
	    	array(
	    		'name'=>'n',
				'header'=>'N',
				'value'=>function($data,$datacolumn) use($msid){
				 	echo Moraleanswer::model()->getAnswer($data->id,'N',$msid);
				 },
				'filter'=>false,
				'htmlOptions'=>array('width'=>'40px'),
	    		),
	    	array(
	    		'name'=>'ns',
				'header'=>'NS',
				'value'=>function($data,$datacolumn) use($msid){
				 	echo Moraleanswer::model()->getAnswer($data->id,'NS',$msid);
				 },
				'filter'=>false,
				'htmlOptions'=>array('width'=>'40px'),
	    		),
	    	array(
	    		'name'=>'y',
				'header'=>'Y',
				'value'=>function($data,$datacolumn) use($msid){
				 	echo Moraleanswer::model()->getAnswer($data->id,'Y',$msid);
				 },
				'filter'=>false,
				'htmlOptions'=>array('width'=>'40px'),
	    		),
	    	array(
	    		'name'=>'dy',
				'header'=>'DY',
				'value'=>function($data,$datacolumn) use($msid){
				 	echo Moraleanswer::model()->getAnswer($data->id,'DY',$msid);
				 },
				'filter'=>false,
				'htmlOptions'=>array('width'=>'40px'),
	    		),
	    	array(
	    		'name'=>'total',
				'header'=>'Total',
				'value'=>function($data,$datacolumn) use($msid){
				 	echo Moraleanswer::model()->getTotalanswer($data->id,$msid);
				 },
				'filter'=>false,
				'htmlOptions'=>array('width'=>'40px'),
	    		),
	    	array(
	    		'name'=>'index',
				'header'=>'Index',
				'value'=>function($data,$datacolumn) use($msid){
				 	echo Moraleanswer::model()->getIndex($data->id,$msid);
				 },
				'filter'=>false,
				'htmlOptions'=>array('width'=>'50px'),
	    		),
	    ),
	)); ?>
	</div>
	<div class="span4 q-red">
		<b>Summary:</b>
	    <i class="badge badge-warning" title="DN"><?php echo Moraleanswer::model()->getSummary($fos_pb_ids,'DN',$msid); ?> DN</i>
	    <i class="badge badge-warning" title="N"><?php echo Moraleanswer::model()->getSummary($fos_pb_ids,'N',$msid); ?> N</i>
	    <i class="badge badge-warning" title="NS"><?php echo Moraleanswer::model()->getSummary($fos_pb_ids,'NS',$msid); ?> NS</i>
	    <i class="badge badge-warning" title="Y"><?php echo Moraleanswer::model()->getSummary($fos_pb_ids,'Y',$msid); ?> Y</i>
	    <i class="badge badge-warning" title="DY"><?php echo Moraleanswer::model()->getSummary($fos_pb_ids,'DY',$msid); ?> DY</i>
	    
        <h2><?php echo Moraleanswer::model()->getAverage($fos_pb_ids,$msid); ?></h2>
              
    </div>
	</div>
	<hr/>
	<div class="row-fluid">
		
		<div class=" q-red">
			<b>Overall FOS:</b>
		    <i class="badge badge-warning" title="DN"><?php echo Moraleanswer::model()->getSummary($fos_ids,'DN',$msid); ?> DN</i>
		    <i class="badge badge-warning" title="N"><?php echo Moraleanswer::model()->getSummary($fos_ids,'N',$msid); ?> N</i>
		    <i class="badge badge-warning" title="NS"><?php echo Moraleanswer::model()->getSummary($fos_ids,'NS',$msid); ?> NS</i>
		    <i class="badge badge-warning" title="Y"><?php echo Moraleanswer::model()->getSummary($fos_ids,'Y',$msid); ?> Y</i>
		    <i class="badge badge-warning" title="DY"><?php echo Moraleanswer::model()->getSummary($fos_ids,'DY',$msid); ?> DY</i>
		    
	        <h2><?php echo Moraleanswer::model()->getAverage($fos_ids,$msid); ?></h2>
	              

		   		
	    	
		</div>
	</div>
	<?php $this->endWidget();