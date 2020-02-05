<?php
/* @var $this MoraleanswerController */

$this->breadcrumbs=array(
	'Moraleanswer->consolidate',
);
$baseUrl = Yii::app()->theme->baseUrl; 
?>
<h1><?php echo "Consolidated data of ".$moralesurvey->name?></h1>

<p class="alert alert-error">
	Effective from <b><?php echo Yii::app()->dateFormatter->format("y MMMM d",$moralesurvey->datefrom)?></b> to <b><?php echo Yii::app()->dateFormatter->format("y MMMM d",$moralesurvey->dateto)?></b>
</p>
<?php 


	$this->beginWidget('zii.widgets.CPortlet', array(
			'title'=>"Office of the Regional Director (ORD)",
		));
		?>
		<div class="row">
		<div class="span8">
	<?php $this->widget('zii.widgets.grid.CGridView', array(
	    'dataProvider'=>$ords,
	    'htmlOptions'=>array('width'=>'310px'),
	    'columns'=>array(
	    	array(
	    		'name'=>'id',
				'header'=>'#',
				'value'=>'$row+1',
				'filter'=>false,
				'htmlOptions'=>array('width'=>'20px'),
	    		),
	    	array(
	    		'name'=>'name',
				'header'=>'name',
				//'value'=>'$data->user_id',
				//'value'=>Moraleanswer::model()->getAnswer($this->data->user_id,'DN'),
				 'value'=>function($data){
				 	echo myhelper::getfullname($data->user_id);
				 },
				'filter'=>false,
	    		),
	    	array(
	    		'name'=>'dn',
				'header'=>'DN',
				//'value'=>'$data->user_id',
				//'value'=>Moraleanswer::model()->getAnswer($this->data->user_id,'DN'),
				 'value'=>function($data){
				 	echo Moraleanswer::model()->getAnswer($data->user_id,'DN');
				 },
				'filter'=>false,
				'htmlOptions'=>array('width'=>'40px'),
	    		),
	    	array(
	    		'name'=>'n',
				'header'=>'N',
				'value'=>function($data){
				 	echo Moraleanswer::model()->getAnswer($data->user_id,'N');
				 },
				'filter'=>false,
				'htmlOptions'=>array('width'=>'40px'),
	    		),
	    	array(
	    		'name'=>'ns',
				'header'=>'NS',
				'value'=>function($data){
				 	echo Moraleanswer::model()->getAnswer($data->user_id,'NS');
				 },
				'filter'=>false,
				'htmlOptions'=>array('width'=>'40px'),
	    		),
	    	array(
	    		'name'=>'y',
				'header'=>'Y',
				'value'=>function($data){
				 	echo Moraleanswer::model()->getAnswer($data->user_id,'Y');
				 },
				'filter'=>false,
				'htmlOptions'=>array('width'=>'40px'),
	    		),
	    	array(
	    		'name'=>'dy',
				'header'=>'DY',
				'value'=>function($data){
				 	echo Moraleanswer::model()->getAnswer($data->user_id,'DY');
				 },
				'filter'=>false,
				'htmlOptions'=>array('width'=>'40px'),
	    		),
	    	array(
	    		'name'=>'total',
				'header'=>'Total',
				'value'=>function($data){
				 	echo Moraleanswer::model()->getTotalanswer($data->user_id);
				 },
				'filter'=>false,
				'htmlOptions'=>array('width'=>'40px'),
	    		),
	    	array(
	    		'name'=>'index',
				'header'=>'Index',
				'value'=>function($data){
				 	echo Moraleanswer::model()->getIndex($data->user_id);
				 },
				'filter'=>false,
				'htmlOptions'=>array('width'=>'50px'),
	    		),
	    ),
	)); ?>
	</div>
	<div class="span4  alert alert-success">
		<b>Overall ORD:</b>
	    <i class="badge badge-warning" title="DN"><?php echo Moraleanswer::model()->getSummary($ord_ids,'DN'); ?> DN</i>
	    <i class="badge badge-warning" title="N"><?php echo Moraleanswer::model()->getSummary($ord_ids,'N'); ?> N</i>
	    <i class="badge badge-warning" title="NS"><?php echo Moraleanswer::model()->getSummary($ord_ids,'NS'); ?> NS</i>
	    <i class="badge badge-warning" title="Y"><?php echo Moraleanswer::model()->getSummary($ord_ids,'Y'); ?> Y</i>
	    <i class="badge badge-warning" title="DY"><?php echo Moraleanswer::model()->getSummary($ord_ids,'DY'); ?> DY</i>
	    <br />
	    <div class="row-fluid">
	    <div class="summary">
          <ul>
          	<li>
          		<span class="summary-icon">
                	<img src="<?php echo $baseUrl ;?>/img/group.png" width="36" height="36" alt="Monthly Income">
                </span>
                <span class="summary-number"><?php echo Moraleanswer::model()->getAverage($ord_ids); ?></span>
                <span class="summary-title"> Rating</span>
            </li>
          </ul>
         </div>

	   		
    	</div>
    </div>
	</div>
	<?php $this->endWidget();



	$this->beginWidget('zii.widgets.CPortlet', array(
			'title'=>"Field Operation Services (FOS)",
		));
		?>
	<div class="row">
		<div class="span8">
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
	    	array(
	    		'name'=>'name',
				'header'=>'name',
				//'value'=>'$data->user_id',
				//'value'=>Moraleanswer::model()->getAnswer($this->data->user_id,'DN'),
				 'value'=>function($data){
				 	echo myhelper::getfullname($data->user_id);
				 },
				'filter'=>false,
	    		),
	    	array(
	    		'name'=>'dn',
				'header'=>'DN',
				//'value'=>'$data->user_id',
				//'value'=>Moraleanswer::model()->getAnswer($this->data->user_id,'DN'),
				 'value'=>function($data){
				 	echo Moraleanswer::model()->getAnswer($data->user_id,'DN');
				 },
				'filter'=>false,
				'htmlOptions'=>array('width'=>'40px'),
	    		),
	    	array(
	    		'name'=>'n',
				'header'=>'N',
				'value'=>function($data){
				 	echo Moraleanswer::model()->getAnswer($data->user_id,'N');
				 },
				'filter'=>false,
				'htmlOptions'=>array('width'=>'40px'),
	    		),
	    	array(
	    		'name'=>'ns',
				'header'=>'NS',
				'value'=>function($data){
				 	echo Moraleanswer::model()->getAnswer($data->user_id,'NS');
				 },
				'filter'=>false,
				'htmlOptions'=>array('width'=>'40px'),
	    		),
	    	array(
	    		'name'=>'y',
				'header'=>'Y',
				'value'=>function($data){
				 	echo Moraleanswer::model()->getAnswer($data->user_id,'Y');
				 },
				'filter'=>false,
				'htmlOptions'=>array('width'=>'40px'),
	    		),
	    	array(
	    		'name'=>'dy',
				'header'=>'DY',
				'value'=>function($data){
				 	echo Moraleanswer::model()->getAnswer($data->user_id,'DY');
				 },
				'filter'=>false,
				'htmlOptions'=>array('width'=>'40px'),
	    		),
	    	array(
	    		'name'=>'total',
				'header'=>'Total',
				'value'=>function($data){
				 	echo Moraleanswer::model()->getTotalanswer($data->user_id);
				 },
				'filter'=>false,
				'htmlOptions'=>array('width'=>'40px'),
	    		),
	    	array(
	    		'name'=>'index',
				'header'=>'Index',
				'value'=>function($data){
				 	echo Moraleanswer::model()->getIndex($data->user_id);
				 },
				'filter'=>false,
				'htmlOptions'=>array('width'=>'50px'),
	    		),
	    ),
	)); ?>
	</div>
	<div class="span4  alert alert-warning">
		<b>Summary:</b>
	    <i class="badge badge-warning" title="DN"><?php echo Moraleanswer::model()->getSummary($fos_p_ids,'DN'); ?> DN</i>
	    <i class="badge badge-warning" title="N"><?php echo Moraleanswer::model()->getSummary($fos_p_ids,'N'); ?> N</i>
	    <i class="badge badge-warning" title="NS"><?php echo Moraleanswer::model()->getSummary($fos_p_ids,'NS'); ?> NS</i>
	    <i class="badge badge-warning" title="Y"><?php echo Moraleanswer::model()->getSummary($fos_p_ids,'Y'); ?> Y</i>
	    <i class="badge badge-warning" title="DY"><?php echo Moraleanswer::model()->getSummary($fos_p_ids,'DY'); ?> DY</i>
	    <br />
	    <div class="row-fluid">
	    <div class="summary">
          <ul>
          	<li>
          		<span class="summary-icon">
                	<img src="<?php echo $baseUrl ;?>/img/group.png" width="36" height="36" alt="Monthly Income">
                </span>
                <span class="summary-number"><?php echo Moraleanswer::model()->getAverage($fos_p_ids); ?></span>
                <span class="summary-title"> Rating</span>
            </li>
          </ul>
         </div>

	   		
    	</div>
    </div>
	</div>
	<hr/>
	<div class="row">
		<div class="span8">
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
	    	array(
	    		'name'=>'name',
				'header'=>'name',
				//'value'=>'$data->user_id',
				//'value'=>Moraleanswer::model()->getAnswer($this->data->user_id,'DN'),
				 'value'=>function($data){
				 	echo myhelper::getfullname($data->user_id);
				 },
				'filter'=>false,
	    		),
	    	array(
	    		'name'=>'dn',
				'header'=>'DN',
				//'value'=>'$data->user_id',
				//'value'=>Moraleanswer::model()->getAnswer($this->data->user_id,'DN'),
				 'value'=>function($data){
				 	echo Moraleanswer::model()->getAnswer($data->user_id,'DN');
				 },
				'filter'=>false,
				'htmlOptions'=>array('width'=>'40px'),
	    		),
	    	array(
	    		'name'=>'n',
				'header'=>'N',
				'value'=>function($data){
				 	echo Moraleanswer::model()->getAnswer($data->user_id,'N');
				 },
				'filter'=>false,
				'htmlOptions'=>array('width'=>'40px'),
	    		),
	    	array(
	    		'name'=>'ns',
				'header'=>'NS',
				'value'=>function($data){
				 	echo Moraleanswer::model()->getAnswer($data->user_id,'NS');
				 },
				'filter'=>false,
				'htmlOptions'=>array('width'=>'40px'),
	    		),
	    	array(
	    		'name'=>'y',
				'header'=>'Y',
				'value'=>function($data){
				 	echo Moraleanswer::model()->getAnswer($data->user_id,'Y');
				 },
				'filter'=>false,
				'htmlOptions'=>array('width'=>'40px'),
	    		),
	    	array(
	    		'name'=>'dy',
				'header'=>'DY',
				'value'=>function($data){
				 	echo Moraleanswer::model()->getAnswer($data->user_id,'DY');
				 },
				'filter'=>false,
				'htmlOptions'=>array('width'=>'40px'),
	    		),
	    	array(
	    		'name'=>'total',
				'header'=>'Total',
				'value'=>function($data){
				 	echo Moraleanswer::model()->getTotalanswer($data->user_id);
				 },
				'filter'=>false,
				'htmlOptions'=>array('width'=>'40px'),
	    		),
	    	array(
	    		'name'=>'index',
				'header'=>'Index',
				'value'=>function($data){
				 	echo Moraleanswer::model()->getIndex($data->user_id);
				 },
				'filter'=>false,
				'htmlOptions'=>array('width'=>'50px'),
	    		),
	    ),
	)); ?>
	</div>
	<div class="span4  alert alert-warning">
		<b>Summary:</b>
	    <i class="badge badge-warning" title="DN"><?php echo Moraleanswer::model()->getSummary($fos_pb_ids,'DN'); ?> DN</i>
	    <i class="badge badge-warning" title="N"><?php echo Moraleanswer::model()->getSummary($fos_pb_ids,'N'); ?> N</i>
	    <i class="badge badge-warning" title="NS"><?php echo Moraleanswer::model()->getSummary($fos_pb_ids,'NS'); ?> NS</i>
	    <i class="badge badge-warning" title="Y"><?php echo Moraleanswer::model()->getSummary($fos_pb_ids,'Y'); ?> Y</i>
	    <i class="badge badge-warning" title="DY"><?php echo Moraleanswer::model()->getSummary($fos_pb_ids,'DY'); ?> DY</i>
	    <br />
	    <div class="row-fluid">
	    <div class="summary">
          <ul>
          	<li>
          		<span class="summary-icon">
                	<img src="<?php echo $baseUrl ;?>/img/group.png" width="36" height="36" alt="Monthly Income">
                </span>
                <span class="summary-number"><?php echo Moraleanswer::model()->getAverage($fos_pb_ids); ?></span>
                <span class="summary-title"> Rating</span>
            </li>
          </ul>
         </div>

	   		
    	</div>
    </div>
	</div>
	<hr/>
	<div class="row">
		<div class="span8">
			
		</div>
		<div class="span4 alert alert-success">
			<b>Overall FOS:</b>
		    <i class="badge badge-warning" title="DN"><?php echo Moraleanswer::model()->getSummary($fos_ids,'DN'); ?> DN</i>
		    <i class="badge badge-warning" title="N"><?php echo Moraleanswer::model()->getSummary($fos_ids,'N'); ?> N</i>
		    <i class="badge badge-warning" title="NS"><?php echo Moraleanswer::model()->getSummary($fos_ids,'NS'); ?> NS</i>
		    <i class="badge badge-warning" title="Y"><?php echo Moraleanswer::model()->getSummary($fos_ids,'Y'); ?> Y</i>
		    <i class="badge badge-warning" title="DY"><?php echo Moraleanswer::model()->getSummary($fos_ids,'DY'); ?> DY</i>
		    <br />
		    <div class="row-fluid">
		    <div class="summary">
	          <ul>
	          	<li>
	          		<span class="summary-icon">
	                	<img src="<?php echo $baseUrl ;?>/img/group.png" width="36" height="36" alt="Monthly Income">
	                </span>
	                <span class="summary-number"><?php echo Moraleanswer::model()->getAverage($fos_ids); ?></span>
	                <span class="summary-title"> Rating</span>
	            </li>
	          </ul>
	         </div>

		   		
	    	</div>
		</div>
	</div>
	<?php $this->endWidget();


	$this->beginWidget('zii.widgets.CPortlet', array(
			'title'=>"Technical Services (TS)",
		));
		?>
	<div class="row">
		<div class="span8">
	<p>Regular</p>
	<?php $this->widget('zii.widgets.grid.CGridView', array(
	    'dataProvider'=>$ts_p,
	    'htmlOptions'=>array('width'=>'310px'),
	    'columns'=>array(
	    	array(
	    		'name'=>'id',
				'header'=>'#',
				'value'=>'$row+1',
				'filter'=>false,
				'htmlOptions'=>array('width'=>'20px'),
	    		),

	    	'user_id',
	    	array(
	    		'name'=>'name',
				'header'=>'name',
				//'value'=>'$data->user_id',
				//'value'=>Moraleanswer::model()->getAnswer($this->data->user_id,'DN'),
				 'value'=>function($data){
				 	echo myhelper::getfullname($data->user_id);
				 },
				'filter'=>false,
	    		),
	    	array(
	    		'name'=>'dn',
				'header'=>'DN',
				//'value'=>'$data->user_id',
				//'value'=>Moraleanswer::model()->getAnswer($this->data->user_id,'DN'),
				 'value'=>function($data){
				 	echo Moraleanswer::model()->getAnswer($data->user_id,'DN');
				 },
				'filter'=>false,
				'htmlOptions'=>array('width'=>'40px'),
	    		),
	    	array(
	    		'name'=>'n',
				'header'=>'N',
				'value'=>function($data){
				 	echo Moraleanswer::model()->getAnswer($data->user_id,'N');
				 },
				'filter'=>false,
				'htmlOptions'=>array('width'=>'40px'),
	    		),
	    	array(
	    		'name'=>'ns',
				'header'=>'NS',
				'value'=>function($data){
				 	echo Moraleanswer::model()->getAnswer($data->user_id,'NS');
				 },
				'filter'=>false,
				'htmlOptions'=>array('width'=>'40px'),
	    		),
	    	array(
	    		'name'=>'y',
				'header'=>'Y',
				'value'=>function($data){
				 	echo Moraleanswer::model()->getAnswer($data->user_id,'Y');
				 },
				'filter'=>false,
				'htmlOptions'=>array('width'=>'40px'),
	    		),
	    	array(
	    		'name'=>'dy',
				'header'=>'DY',
				'value'=>function($data){
				 	echo Moraleanswer::model()->getAnswer($data->user_id,'DY');
				 },
				'filter'=>false,
				'htmlOptions'=>array('width'=>'40px'),
	    		),
	    	array(
	    		'name'=>'total',
				'header'=>'Total',
				'value'=>function($data){
				 	echo Moraleanswer::model()->getTotalanswer($data->user_id);
				 },
				'filter'=>false,
				'htmlOptions'=>array('width'=>'40px'),
	    		),
	    	array(
	    		'name'=>'index',
				'header'=>'Index',
				'value'=>function($data){
				 	echo Moraleanswer::model()->getIndex($data->user_id);
				 },
				'filter'=>false,
				'htmlOptions'=>array('width'=>'50px'),
	    		),
	    ),
	)); ?>
	</div>
	<div class="span4  alert alert-warning">
		<b>Summary:</b>
	    <i class="badge badge-warning" title="DN"><?php echo Moraleanswer::model()->getSummary($ts_p_ids,'DN'); ?> DN</i>
	    <i class="badge badge-warning" title="N"><?php echo Moraleanswer::model()->getSummary($ts_p_ids,'N'); ?> N</i>
	    <i class="badge badge-warning" title="NS"><?php echo Moraleanswer::model()->getSummary($ts_p_ids,'NS'); ?> NS</i>
	    <i class="badge badge-warning" title="Y"><?php echo Moraleanswer::model()->getSummary($ts_p_ids,'Y'); ?> Y</i>
	    <i class="badge badge-warning" title="DY"><?php echo Moraleanswer::model()->getSummary($ts_p_ids,'DY'); ?> DY</i>
	    <br />
	    <div class="row-fluid">
	    <div class="summary">
          <ul>
          	<li>
          		<span class="summary-icon">
                	<img src="<?php echo $baseUrl ;?>/img/group.png" width="36" height="36" alt="Monthly Income">
                </span>
                <span class="summary-number"><?php echo Moraleanswer::model()->getAverage($ts_p_ids); ?></span>
                <span class="summary-title"> Rating</span>
            </li>
          </ul>
         </div>

	   		
    	</div>
    </div>
	</div>
	<hr/>
	<div class="row">
		<div class="span8">
	<p>Project Base</p>
	<?php $this->widget('zii.widgets.grid.CGridView', array(
	    'dataProvider'=>$ts_pb,
	    'htmlOptions'=>array('width'=>'310px'),
	    'columns'=>array(
	    	array(
	    		'name'=>'id',
				'header'=>'#',
				'value'=>'$row+1',
				'filter'=>false,
				'htmlOptions'=>array('width'=>'20px'),
	    		),
	    	array(
	    		'name'=>'name',
				'header'=>'name',
				//'value'=>'$data->user_id',
				//'value'=>Moraleanswer::model()->getAnswer($this->data->user_id,'DN'),
				 'value'=>function($data){
				 	echo myhelper::getfullname($data->user_id);
				 },
				'filter'=>false,
	    		),
	    	array(
	    		'name'=>'dn',
				'header'=>'DN',
				//'value'=>'$data->user_id',
				//'value'=>Moraleanswer::model()->getAnswer($this->data->user_id,'DN'),
				 'value'=>function($data){
				 	echo Moraleanswer::model()->getAnswer($data->user_id,'DN');
				 },
				'filter'=>false,
				'htmlOptions'=>array('width'=>'40px'),
	    		),
	    	array(
	    		'name'=>'n',
				'header'=>'N',
				'value'=>function($data){
				 	echo Moraleanswer::model()->getAnswer($data->user_id,'N');
				 },
				'filter'=>false,
				'htmlOptions'=>array('width'=>'40px'),
	    		),
	    	array(
	    		'name'=>'ns',
				'header'=>'NS',
				'value'=>function($data){
				 	echo Moraleanswer::model()->getAnswer($data->user_id,'NS');
				 },
				'filter'=>false,
				'htmlOptions'=>array('width'=>'40px'),
	    		),
	    	array(
	    		'name'=>'y',
				'header'=>'Y',
				'value'=>function($data){
				 	echo Moraleanswer::model()->getAnswer($data->user_id,'Y');
				 },
				'filter'=>false,
				'htmlOptions'=>array('width'=>'40px'),
	    		),
	    	array(
	    		'name'=>'dy',
				'header'=>'DY',
				'value'=>function($data){
				 	echo Moraleanswer::model()->getAnswer($data->user_id,'DY');
				 },
				'filter'=>false,
				'htmlOptions'=>array('width'=>'40px'),
	    		),
	    	array(
	    		'name'=>'total',
				'header'=>'Total',
				'value'=>function($data){
				 	echo Moraleanswer::model()->getTotalanswer($data->user_id);
				 },
				'filter'=>false,
				'htmlOptions'=>array('width'=>'40px'),
	    		),
	    	array(
	    		'name'=>'index',
				'header'=>'Index',
				'value'=>function($data){
				 	echo Moraleanswer::model()->getIndex($data->user_id);
				 },
				'filter'=>false,
				'htmlOptions'=>array('width'=>'50px'),
	    		),
	    ),
	)); ?>
	</div>
	<div class="span4  alert alert-warning">
		<b>Summary:</b>
	    <i class="badge badge-warning" title="DN"><?php echo Moraleanswer::model()->getSummary($ts_pb_ids,'DN'); ?> DN</i>
	    <i class="badge badge-warning" title="N"><?php echo Moraleanswer::model()->getSummary($ts_pb_ids,'N'); ?> N</i>
	    <i class="badge badge-warning" title="NS"><?php echo Moraleanswer::model()->getSummary($ts_pb_ids,'NS'); ?> NS</i>
	    <i class="badge badge-warning" title="Y"><?php echo Moraleanswer::model()->getSummary($ts_pb_ids,'Y'); ?> Y</i>
	    <i class="badge badge-warning" title="DY"><?php echo Moraleanswer::model()->getSummary($ts_pb_ids,'DY'); ?> DY</i>
	    <br />
	    <div class="row-fluid">
	    <div class="summary">
          <ul>
          	<li>
          		<span class="summary-icon">
                	<img src="<?php echo $baseUrl ;?>/img/group.png" width="36" height="36" alt="Monthly Income">
                </span>
                <span class="summary-number"><?php echo Moraleanswer::model()->getAverage($ts_pb_ids); ?></span>
                <span class="summary-title"> Rating</span>
            </li>
          </ul>
         </div>

	   		
    	</div>
    </div>
	</div>
	<hr/>
	<div class="row">
		<div class="span8">
			
		</div>
		<div class="span4 alert alert-success">
			<b>Overall ts:</b>
		    <i class="badge badge-warning" title="DN"><?php echo Moraleanswer::model()->getSummary($ts_ids,'DN'); ?> DN</i>
		    <i class="badge badge-warning" title="N"><?php echo Moraleanswer::model()->getSummary($ts_ids,'N'); ?> N</i>
		    <i class="badge badge-warning" title="NS"><?php echo Moraleanswer::model()->getSummary($ts_ids,'NS'); ?> NS</i>
		    <i class="badge badge-warning" title="Y"><?php echo Moraleanswer::model()->getSummary($ts_ids,'Y'); ?> Y</i>
		    <i class="badge badge-warning" title="DY"><?php echo Moraleanswer::model()->getSummary($ts_ids,'DY'); ?> DY</i>
		    <br />
		    <div class="row-fluid">
		    <div class="summary">
	          <ul>
	          	<li>
	          		<span class="summary-icon">
	                	<img src="<?php echo $baseUrl ;?>/img/group.png" width="36" height="36" alt="Monthly Income">
	                </span>
	                <span class="summary-number"><?php echo Moraleanswer::model()->getAverage($ts_ids); ?></span>
	                <span class="summary-title"> Rating</span>
	            </li>
	          </ul>
	         </div>

		   		
	    	</div>
		</div>
	</div>

	<?php $this->endWidget();


	$this->beginWidget('zii.widgets.CPortlet', array(
			'title'=>"Regional Standards & Testing Laboratory (RSTL)",
		));

		?>

	<div class="row">
		<div class="span8">
	<p>Regular</p>
	<?php $this->widget('zii.widgets.grid.CGridView', array(
	    'dataProvider'=>$rstl_p,
	    'htmlOptions'=>array('width'=>'310px'),
	    'columns'=>array(
	    	array(
	    		'name'=>'id',
				'header'=>'#',
				'value'=>'$row+1',
				'filter'=>false,
				'htmlOptions'=>array('width'=>'20px'),
	    		),
	    	
	    	'user_id',
	    	array(
	    		'name'=>'name',
				'header'=>'name',
				//'value'=>'$data->user_id',
				//'value'=>Moraleanswer::model()->getAnswer($this->data->user_id,'DN'),
				 'value'=>function($data){
				 	echo myhelper::getfullname($data->user_id);
				 },
				'filter'=>false,
	    		),
	    	array(
	    		'name'=>'dn',
				'header'=>'DN',
				//'value'=>'$data->user_id',
				//'value'=>Moraleanswer::model()->getAnswer($this->data->user_id,'DN'),
				 'value'=>function($data){
				 	echo Moraleanswer::model()->getAnswer($data->user_id,'DN');
				 },
				'filter'=>false,
				'htmlOptions'=>array('width'=>'40px'),
	    		),
	    	array(
	    		'name'=>'n',
				'header'=>'N',
				'value'=>function($data){
				 	echo Moraleanswer::model()->getAnswer($data->user_id,'N');
				 },
				'filter'=>false,
				'htmlOptions'=>array('width'=>'40px'),
	    		),
	    	array(
	    		'name'=>'ns',
				'header'=>'NS',
				'value'=>function($data){
				 	echo Moraleanswer::model()->getAnswer($data->user_id,'NS');
				 },
				'filter'=>false,
				'htmlOptions'=>array('width'=>'40px'),
	    		),
	    	array(
	    		'name'=>'y',
				'header'=>'Y',
				'value'=>function($data){
				 	echo Moraleanswer::model()->getAnswer($data->user_id,'Y');
				 },
				'filter'=>false,
				'htmlOptions'=>array('width'=>'40px'),
	    		),
	    	array(
	    		'name'=>'dy',
				'header'=>'DY',
				'value'=>function($data){
				 	echo Moraleanswer::model()->getAnswer($data->user_id,'DY');
				 },
				'filter'=>false,
				'htmlOptions'=>array('width'=>'40px'),
	    		),
	    	array(
	    		'name'=>'total',
				'header'=>'Total',
				'value'=>function($data){
				 	echo Moraleanswer::model()->getTotalanswer($data->user_id);
				 },
				'filter'=>false,
				'htmlOptions'=>array('width'=>'40px'),
	    		),
	    	array(
	    		'name'=>'index',
				'header'=>'Index',
				'value'=>function($data){
				 	echo Moraleanswer::model()->getIndex($data->user_id);
				 },
				'filter'=>false,
				'htmlOptions'=>array('width'=>'50px'),
	    		),
	    ),
	)); ?>
	</div>
	<div class="span4  alert alert-warning">
		<b>Summary:</b>
	    <i class="badge badge-warning" title="DN"><?php echo Moraleanswer::model()->getSummary($rstl_p_ids,'DN'); ?> DN</i>
	    <i class="badge badge-warning" title="N"><?php echo Moraleanswer::model()->getSummary($rstl_p_ids,'N'); ?> N</i>
	    <i class="badge badge-warning" title="NS"><?php echo Moraleanswer::model()->getSummary($rstl_p_ids,'NS'); ?> NS</i>
	    <i class="badge badge-warning" title="Y"><?php echo Moraleanswer::model()->getSummary($rstl_p_ids,'Y'); ?> Y</i>
	    <i class="badge badge-warning" title="DY"><?php echo Moraleanswer::model()->getSummary($rstl_p_ids,'DY'); ?> DY</i>
	    <br />
	    <div class="row-fluid">
	    <div class="summary">
          <ul>
          	<li>
          		<span class="summary-icon">
                	<img src="<?php echo $baseUrl ;?>/img/group.png" width="36" height="36" alt="Monthly Income">
                </span>
                <span class="summary-number"><?php echo Moraleanswer::model()->getAverage($rstl_p_ids); ?></span>
                <span class="summary-title"> Rating</span>
            </li>
          </ul>
         </div>

	   		
    	</div>
    </div>
	</div>
	<hr/>
	<div class="row">
		<div class="span8">
	<p>Project Base</p>
	<?php $this->widget('zii.widgerstl.grid.CGridView', array(
	    'dataProvider'=>$rstl_pb,
	    'htmlOptions'=>array('width'=>'310px'),
	    'columns'=>array(
	    	array(
	    		'name'=>'id',
				'header'=>'#',
				'value'=>'$row+1',
				'filter'=>false,
				'htmlOptions'=>array('width'=>'20px'),
	    		),
	    	array(
	    		'name'=>'name',
				'header'=>'name',
				//'value'=>'$data->user_id',
				//'value'=>Moraleanswer::model()->getAnswer($this->data->user_id,'DN'),
				 'value'=>function($data){
				 	echo myhelper::getfullname($data->user_id);
				 },
				'filter'=>false,
	    		),
	    	array(
	    		'name'=>'dn',
				'header'=>'DN',
				//'value'=>'$data->user_id',
				//'value'=>Moraleanswer::model()->getAnswer($this->data->user_id,'DN'),
				 'value'=>function($data){
				 	echo Moraleanswer::model()->getAnswer($data->user_id,'DN');
				 },
				'filter'=>false,
				'htmlOptions'=>array('width'=>'40px'),
	    		),
	    	array(
	    		'name'=>'n',
				'header'=>'N',
				'value'=>function($data){
				 	echo Moraleanswer::model()->getAnswer($data->user_id,'N');
				 },
				'filter'=>false,
				'htmlOptions'=>array('width'=>'40px'),
	    		),
	    	array(
	    		'name'=>'ns',
				'header'=>'NS',
				'value'=>function($data){
				 	echo Moraleanswer::model()->getAnswer($data->user_id,'NS');
				 },
				'filter'=>false,
				'htmlOptions'=>array('width'=>'40px'),
	    		),
	    	array(
	    		'name'=>'y',
				'header'=>'Y',
				'value'=>function($data){
				 	echo Moraleanswer::model()->getAnswer($data->user_id,'Y');
				 },
				'filter'=>false,
				'htmlOptions'=>array('width'=>'40px'),
	    		),
	    	array(
	    		'name'=>'dy',
				'header'=>'DY',
				'value'=>function($data){
				 	echo Moraleanswer::model()->getAnswer($data->user_id,'DY');
				 },
				'filter'=>false,
				'htmlOptions'=>array('width'=>'40px'),
	    		),
	    	array(
	    		'name'=>'total',
				'header'=>'Total',
				'value'=>function($data){
				 	echo Moraleanswer::model()->getTotalanswer($data->user_id);
				 },
				'filter'=>false,
				'htmlOptions'=>array('width'=>'40px'),
	    		),
	    	array(
	    		'name'=>'index',
				'header'=>'Index',
				'value'=>function($data){
				 	echo Moraleanswer::model()->getIndex($data->user_id);
				 },
				'filter'=>false,
				'htmlOptions'=>array('width'=>'50px'),
	    		),
	    ),
	)); ?>
	</div>
	<div class="span4  alert alert-warning">
		<b>Summary:</b>
	    <i class="badge badge-warning" title="DN"><?php echo Moraleanswer::model()->getSummary($rstl_pb_ids,'DN'); ?> DN</i>
	    <i class="badge badge-warning" title="N"><?php echo Moraleanswer::model()->getSummary($rstl_pb_ids,'N'); ?> N</i>
	    <i class="badge badge-warning" title="NS"><?php echo Moraleanswer::model()->getSummary($rstl_pb_ids,'NS'); ?> NS</i>
	    <i class="badge badge-warning" title="Y"><?php echo Moraleanswer::model()->getSummary($rstl_pb_ids,'Y'); ?> Y</i>
	    <i class="badge badge-warning" title="DY"><?php echo Moraleanswer::model()->getSummary($rstl_pb_ids,'DY'); ?> DY</i>
	    <br />
	    <div class="row-fluid">
	    <div class="summary">
          <ul>
          	<li>
          		<span class="summary-icon">
                	<img src="<?php echo $baseUrl ;?>/img/group.png" width="36" height="36" alt="Monthly Income">
                </span>
                <span class="summary-number"><?php echo Moraleanswer::model()->getAverage($rstl_pb_ids); ?></span>
                <span class="summary-title"> Rating</span>
            </li>
          </ul>
         </div>

	   		
    	</div>
    </div>
	</div>
	<hr/>
	<div class="row">
		<div class="span8">
			
		</div>
		<div class="span4 alert alert-success">
			<b>Overall rstl:</b>
		    <i class="badge badge-warning" title="DN"><?php echo Moraleanswer::model()->getSummary($rstl_ids,'DN'); ?> DN</i>
		    <i class="badge badge-warning" title="N"><?php echo Moraleanswer::model()->getSummary($rstl_ids,'N'); ?> N</i>
		    <i class="badge badge-warning" title="NS"><?php echo Moraleanswer::model()->getSummary($rstl_ids,'NS'); ?> NS</i>
		    <i class="badge badge-warning" title="Y"><?php echo Moraleanswer::model()->getSummary($rstl_ids,'Y'); ?> Y</i>
		    <i class="badge badge-warning" title="DY"><?php echo Moraleanswer::model()->getSummary($rstl_ids,'DY'); ?> DY</i>
		    <br />
		    <div class="row-fluid">
		    <div class="summary">
	          <ul>
	          	<li>
	          		<span class="summary-icon">
	                	<img src="<?php echo $baseUrl ;?>/img/group.png" width="36" height="36" alt="Monthly Income">
	                </span>
	                <span class="summary-number"><?php echo Moraleanswer::model()->getAverage($rstl_ids); ?></span>
	                <span class="summary-title"> Rating</span>
	            </li>
	          </ul>
	         </div>

		   		
	    	</div>
		</div>
	</div>

	<?php $this->endWidget();



	$this->beginWidget('zii.widgets.CPortlet', array(
			'title'=>"Finance Administrative Support Services (FASS)",
		));

	?>

	<div class="row">
		<div class="span8">
	<p>Regular</p>
	<?php $this->widget('zii.widgets.grid.CGridView', array(
	    'dataProvider'=>$fass_p,
	    'htmlOptions'=>array('width'=>'310px'),
	    'columns'=>array(
	    	array(
	    		'name'=>'id',
				'header'=>'#',
				'value'=>'$row+1',
				'filter'=>false,
				'htmlOptions'=>array('width'=>'20px'),
	    		),
	    	
	    	'user_id',
	    	array(
	    		'name'=>'name',
				'header'=>'name',
				//'value'=>'$data->user_id',
				//'value'=>Moraleanswer::model()->getAnswer($this->data->user_id,'DN'),
				 'value'=>function($data){
				 	echo myhelper::getfullname($data->user_id);
				 },
				'filter'=>false,
	    		),
	    	array(
	    		'name'=>'dn',
				'header'=>'DN',
				//'value'=>'$data->user_id',
				//'value'=>Moraleanswer::model()->getAnswer($this->data->user_id,'DN'),
				 'value'=>function($data){
				 	echo Moraleanswer::model()->getAnswer($data->user_id,'DN');
				 },
				'filter'=>false,
				'htmlOptions'=>array('width'=>'40px'),
	    		),
	    	array(
	    		'name'=>'n',
				'header'=>'N',
				'value'=>function($data){
				 	echo Moraleanswer::model()->getAnswer($data->user_id,'N');
				 },
				'filter'=>false,
				'htmlOptions'=>array('width'=>'40px'),
	    		),
	    	array(
	    		'name'=>'ns',
				'header'=>'NS',
				'value'=>function($data){
				 	echo Moraleanswer::model()->getAnswer($data->user_id,'NS');
				 },
				'filter'=>false,
				'htmlOptions'=>array('width'=>'40px'),
	    		),
	    	array(
	    		'name'=>'y',
				'header'=>'Y',
				'value'=>function($data){
				 	echo Moraleanswer::model()->getAnswer($data->user_id,'Y');
				 },
				'filter'=>false,
				'htmlOptions'=>array('width'=>'40px'),
	    		),
	    	array(
	    		'name'=>'dy',
				'header'=>'DY',
				'value'=>function($data){
				 	echo Moraleanswer::model()->getAnswer($data->user_id,'DY');
				 },
				'filter'=>false,
				'htmlOptions'=>array('width'=>'40px'),
	    		),
	    	array(
	    		'name'=>'total',
				'header'=>'Total',
				'value'=>function($data){
				 	echo Moraleanswer::model()->getTotalanswer($data->user_id);
				 },
				'filter'=>false,
				'htmlOptions'=>array('width'=>'40px'),
	    		),
	    	array(
	    		'name'=>'index',
				'header'=>'Index',
				'value'=>function($data){
				 	echo Moraleanswer::model()->getIndex($data->user_id);
				 },
				'filter'=>false,
				'htmlOptions'=>array('width'=>'50px'),
	    		),
	    ),
	)); ?>
	</div>
	<div class="span4  alert alert-warning">
		<b>Summary:</b>
	    <i class="badge badge-warning" title="DN"><?php echo Moraleanswer::model()->getSummary($fass_p_ids,'DN'); ?> DN</i>
	    <i class="badge badge-warning" title="N"><?php echo Moraleanswer::model()->getSummary($fass_p_ids,'N'); ?> N</i>
	    <i class="badge badge-warning" title="NS"><?php echo Moraleanswer::model()->getSummary($fass_p_ids,'NS'); ?> NS</i>
	    <i class="badge badge-warning" title="Y"><?php echo Moraleanswer::model()->getSummary($fass_p_ids,'Y'); ?> Y</i>
	    <i class="badge badge-warning" title="DY"><?php echo Moraleanswer::model()->getSummary($fass_p_ids,'DY'); ?> DY</i>
	    <br />
	    <div class="row-fluid">
	    <div class="summary">
          <ul>
          	<li>
          		<span class="summary-icon">
                	<img src="<?php echo $baseUrl ;?>/img/group.png" width="36" height="36" alt="Monthly Income">
                </span>
                <span class="summary-number"><?php echo Moraleanswer::model()->getAverage($fass_p_ids); ?></span>
                <span class="summary-title"> Rating</span>
            </li>
          </ul>
         </div>

	   		
    	</div>
    </div>
	</div>
	<hr/>
	<div class="row">
		<div class="span8">
	<p>Contractual</p>
	<?php $this->widget('zii.widgefass.grid.CGridView', array(
	    'dataProvider'=>$fass_c,
	    'htmlOptions'=>array('width'=>'310px'),
	    'columns'=>array(
	    	array(
	    		'name'=>'id',
				'header'=>'#',
				'value'=>'$row+1',
				'filter'=>false,
				'htmlOptions'=>array('width'=>'20px'),
	    		),
	    	array(
	    		'name'=>'name',
				'header'=>'name',
				//'value'=>'$data->user_id',
				//'value'=>Moraleanswer::model()->getAnswer($this->data->user_id,'DN'),
				 'value'=>function($data){
				 	echo myhelper::getfullname($data->user_id);
				 },
				'filter'=>false,
	    		),
	    	array(
	    		'name'=>'dn',
				'header'=>'DN',
				//'value'=>'$data->user_id',
				//'value'=>Moraleanswer::model()->getAnswer($this->data->user_id,'DN'),
				 'value'=>function($data){
				 	echo Moraleanswer::model()->getAnswer($data->user_id,'DN');
				 },
				'filter'=>false,
				'htmlOptions'=>array('width'=>'40px'),
	    		),
	    	array(
	    		'name'=>'n',
				'header'=>'N',
				'value'=>function($data){
				 	echo Moraleanswer::model()->getAnswer($data->user_id,'N');
				 },
				'filter'=>false,
				'htmlOptions'=>array('width'=>'40px'),
	    		),
	    	array(
	    		'name'=>'ns',
				'header'=>'NS',
				'value'=>function($data){
				 	echo Moraleanswer::model()->getAnswer($data->user_id,'NS');
				 },
				'filter'=>false,
				'htmlOptions'=>array('width'=>'40px'),
	    		),
	    	array(
	    		'name'=>'y',
				'header'=>'Y',
				'value'=>function($data){
				 	echo Moraleanswer::model()->getAnswer($data->user_id,'Y');
				 },
				'filter'=>false,
				'htmlOptions'=>array('width'=>'40px'),
	    		),
	    	array(
	    		'name'=>'dy',
				'header'=>'DY',
				'value'=>function($data){
				 	echo Moraleanswer::model()->getAnswer($data->user_id,'DY');
				 },
				'filter'=>false,
				'htmlOptions'=>array('width'=>'40px'),
	    		),
	    	array(
	    		'name'=>'total',
				'header'=>'Total',
				'value'=>function($data){
				 	echo Moraleanswer::model()->getTotalanswer($data->user_id);
				 },
				'filter'=>false,
				'htmlOptions'=>array('width'=>'40px'),
	    		),
	    	array(
	    		'name'=>'index',
				'header'=>'Index',
				'value'=>function($data){
				 	echo Moraleanswer::model()->getIndex($data->user_id);
				 },
				'filter'=>false,
				'htmlOptions'=>array('width'=>'50px'),
	    		),
	    ),
	)); ?>
	</div>
	<div class="span4  alert alert-warning">
		<b>Summary:</b>
	    <i class="badge badge-warning" title="DN"><?php echo Moraleanswer::model()->getSummary($fass_c_ids,'DN'); ?> DN</i>
	    <i class="badge badge-warning" title="N"><?php echo Moraleanswer::model()->getSummary($fass_c_ids,'N'); ?> N</i>
	    <i class="badge badge-warning" title="NS"><?php echo Moraleanswer::model()->getSummary($fass_c_ids,'NS'); ?> NS</i>
	    <i class="badge badge-warning" title="Y"><?php echo Moraleanswer::model()->getSummary($fass_c_ids,'Y'); ?> Y</i>
	    <i class="badge badge-warning" title="DY"><?php echo Moraleanswer::model()->getSummary($fass_c_ids,'DY'); ?> DY</i>
	    <br />
	    <div class="row-fluid">
	    <div class="summary">
          <ul>
          	<li>
          		<span class="summary-icon">
                	<img src="<?php echo $baseUrl ;?>/img/group.png" width="36" height="36" alt="Monthly Income">
                </span>
                <span class="summary-number"><?php echo Moraleanswer::model()->getAverage($fass_c_ids); ?></span>
                <span class="summary-title"> Rating</span>
            </li>
          </ul>
         </div>

	   		
    	</div>
    </div>
	</div>
	<hr/>
	<div class="row">
		<div class="span8">
			
		</div>
		<div class="span4 alert alert-success">
			<b>Overall fass:</b>
		    <i class="badge badge-warning" title="DN"><?php echo Moraleanswer::model()->getSummary($fass_ids,'DN'); ?> DN</i>
		    <i class="badge badge-warning" title="N"><?php echo Moraleanswer::model()->getSummary($fass_ids,'N'); ?> N</i>
		    <i class="badge badge-warning" title="NS"><?php echo Moraleanswer::model()->getSummary($fass_ids,'NS'); ?> NS</i>
		    <i class="badge badge-warning" title="Y"><?php echo Moraleanswer::model()->getSummary($fass_ids,'Y'); ?> Y</i>
		    <i class="badge badge-warning" title="DY"><?php echo Moraleanswer::model()->getSummary($fass_ids,'DY'); ?> DY</i>
		    <br />
		    <div class="row-fluid">
		    <div class="summary">
	          <ul>
	          	<li>
	          		<span class="summary-icon">
	                	<img src="<?php echo $baseUrl ;?>/img/group.png" width="36" height="36" alt="Monthly Income">
	                </span>
	                <span class="summary-number"><?php echo Moraleanswer::model()->getAverage($fass_ids); ?></span>
	                <span class="summary-title"> Rating</span>
	            </li>
	          </ul>
	         </div>

		   		
	    	</div>
		</div>
	</div>

	<?php

	$this->endWidget();


	$this->beginWidget('zii.widgets.CPortlet', array(
			'title'=>"Provincial Science & Technology Center (PSTC)",
		));

	echo "sample";

	$this->endWidget();



	

//print_r($ords);
// foreach ($ord_ids as $id) {
	//	echo $id->user_id," ,";
	# code...
//}
?>

