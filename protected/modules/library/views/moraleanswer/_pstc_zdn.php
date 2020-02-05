
<?php


	$this->beginWidget('zii.widgets.CPortlet', array(
			'title'=>"Provincial Science & Technology Center (PSTC ZDN)",
		));

	?>
	<div class="row-fluid">
		<div class="span8 q-green">
	<p>Regular</p>
	<?php $this->widget('zii.widgets.grid.CGridView', array(
	    'dataProvider'=>$pstc_p_zdn,
	    'htmlOptions'=>array('width'=>'310px'),
	    'columns'=>array(
	    	array(
	    		'name'=>'id',
				'header'=>'#',
				'value'=>'$row+1',
				'filter'=>false,
				'htmlOptions'=>array('width'=>'20px'),
	    		),
	    	
	    //	'id',
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
	<div class="span4  q-red">
		<b>Summary:</b>
	    <i class="badge badge-warning" title="DN"><?php echo Moraleanswer::model()->getSummary($pstc_p_zdn_ids,'DN',$msid); ?> DN</i>
	    <i class="badge badge-warning" title="N"><?php echo Moraleanswer::model()->getSummary($pstc_p_zdn_ids,'N',$msid); ?> N</i>
	    <i class="badge badge-warning" title="NS"><?php echo Moraleanswer::model()->getSummary($pstc_p_zdn_ids,'NS',$msid); ?> NS</i>
	    <i class="badge badge-warning" title="Y"><?php echo Moraleanswer::model()->getSummary($pstc_p_zdn_ids,'Y',$msid); ?> Y</i>
	    <i class="badge badge-warning" title="DY"><?php echo Moraleanswer::model()->getSummary($pstc_p_zdn_ids,'DY',$msid); ?> DY</i>
	    
        <h2><?php echo Moraleanswer::model()->getAverage($pstc_p_zdn_ids,$msid); ?></h2>
               
    </div>
	</div>
	<hr/>
	<div class="row-fluid">
		<div class="span8 q-green">
	<p>Contractual</p>
	<?php $this->widget('zii.widgefass.grid.CGridView', array(
	    'dataProvider'=>$pstc_c_zdn,
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
				'value'=>function($data,$msid){
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
	<div class="span4  q-red">
		<b>Summary:</b>
	    <i class="badge badge-warning" title="DN"><?php echo Moraleanswer::model()->getSummary($pstc_c_zdn_ids,'DN',$msid); ?> DN</i>
	    <i class="badge badge-warning" title="N"><?php echo Moraleanswer::model()->getSummary($pstc_c_zdn_ids,'N',$msid); ?> N</i>
	    <i class="badge badge-warning" title="NS"><?php echo Moraleanswer::model()->getSummary($pstc_c_zdn_ids,'NS',$msid); ?> NS</i>
	    <i class="badge badge-warning" title="Y"><?php echo Moraleanswer::model()->getSummary($pstc_c_zdn_ids,'Y',$msid); ?> Y</i>
	    <i class="badge badge-warning" title="DY"><?php echo Moraleanswer::model()->getSummary($pstc_c_zdn_ids,'DY',$msid); ?> DY</i>
	   
        <h2><?php echo Moraleanswer::model()->getAverage($pstc_c_zdn_ids,$msid); ?></h2>
               
    </div>
	</div>
	<hr/>
	<div class="row-fluid">
	<div class="span8 q-green">
	<p>Project Base</p>
	<?php $this->widget('zii.widgefass.grid.CGridView', array(
	    'dataProvider'=>$pstc_pb_zdn,
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
	    <i class="badge badge-warning" title="DN"><?php echo Moraleanswer::model()->getSummary($pstc_pb_zdn_ids,'DN',$msid); ?> DN</i>
	    <i class="badge badge-warning" title="N"><?php echo Moraleanswer::model()->getSummary($pstc_pb_zdn_ids,'N',$msid); ?> N</i>
	    <i class="badge badge-warning" title="NS"><?php echo Moraleanswer::model()->getSummary($pstc_pb_zdn_ids,'NS',$msid); ?> NS</i>
	    <i class="badge badge-warning" title="Y"><?php echo Moraleanswer::model()->getSummary($pstc_pb_zdn_ids,'Y',$msid); ?> Y</i>
	    <i class="badge badge-warning" title="DY"><?php echo Moraleanswer::model()->getSummary($pstc_pb_zdn_ids,'DY',$msid); ?> DY</i>
	    
        <h2><?php echo Moraleanswer::model()->getAverage($pstc_pb_zdn_ids,$msid); ?></h2>
    </div>
	</div>
	<hr/>
	<div class="row-fluid">
		<div class=" q-red">
			<b>Overall pstc zdn:</b>
		    <i class="badge badge-warning" title="DN"><?php echo Moraleanswer::model()->getSummary($pstc_zdn_ids,'DN',$msid); ?> DN</i>
		    <i class="badge badge-warning" title="N"><?php echo Moraleanswer::model()->getSummary($pstc_zdn_ids,'N',$msid); ?> N</i>
		    <i class="badge badge-warning" title="NS"><?php echo Moraleanswer::model()->getSummary($pstc_zdn_ids,'NS',$msid); ?> NS</i>
		    <i class="badge badge-warning" title="Y"><?php echo Moraleanswer::model()->getSummary($pstc_zdn_ids,'Y',$msid); ?> Y</i>
		    <i class="badge badge-warning" title="DY"><?php echo Moraleanswer::model()->getSummary($pstc_zdn_ids,'DY',$msid); ?> DY</i>
	        <h2><?php echo Moraleanswer::model()->getAverage($pstc_zdn_ids,$msid); ?></h2>
	               
		</div>
	</div>
	<?php $this->endWidget();