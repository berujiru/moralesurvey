
<h1><?php echo "Consolidated data of ".$moralesurvey->name?>
        <?php echo CHtml::link('<i class="icon icon-print"></i> Print',$this->createUrl('/library/moraleanswer/print'),array('class'=>'btn btn-success btn-large text-center pull-right'));?>
</h1>
<p class="alert alert-error">
	Effective from <b><?php echo Yii::app()->dateFormatter->format("y MMMM d",$moralesurvey->datefrom)?></b> to <b><?php echo Yii::app()->dateFormatter->format("y MMMM d",$moralesurvey->dateto)?></b>
</p>	
<div>
    <span class="badge" style="background:#ffff66;color:#232323;">Contractual</span>
    <span class="badge" style="background:#ffcccc;color:#232323;">Project_base</span>
    <span class="badge" style="background:#C1FFC1;color:#232323;">Regular</span>
</div>
<?php 

$msid = $moralesurvey->id;

$this->widget('ext.groupgridview.GroupGridView', array(
	//'id'=>'scholar-grid',
	//'enableHistory'=>true,
	//'summaryText'=>false,
	'rowCssClassExpression'=>'$data->color',
	'htmlOptions'=>array('class'=>'grid-view padding0'),
	//'itemsCssClass'=>'table table-hover table-striped table-bordered table-condensed',
	//'mergeColumns' => array('moraleconfig.division'),
	'extraRowColumns' => array('moraleconfig.division'),
	'extraRowExpression' => '"<font size=\"5\"><b>".strtoupper($data->moraleconfig->div->division_code)."</b></font>"',
	//'rowHtmlOptionsExpression' => 'array("title" => "Click to update", "class"=>"link-hand")',
	//'hiddenColumns' => 1, //modified by RBG at source code of extension
	'dataProvider'=>$all,
	//'filter'=>$model,
	'columns'=>array(
		//'id',
		array(
			'name'=>'id',
			'header'=>'#',
			'value'=>'$this->grid->dataProvider->getPagination()+$row+1',
			'filter'=>false,
			),

		array(
	    		'name'=>'name',
				'header'=>'Full name',
				//'value'=>'$data->user_id',
				//'value'=>Moraleanswer::model()->getAnswer($this->data->user_id,'DN'),
				 'value'=>function($data){
				 	echo myhelper::getfullname($data->id);
				 },
				'filter'=>false,
	    		),
		
		array(
			'name'=>'moraleconfig.division',
			'headerHtmlOptions' => array('style' => 'display: none'),
            'htmlOptions' => array('style' => 'display: none'),
			'footerHtmlOptions'=>array('style' => 'display: none'),
			),
		//'position.position_type',
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
				//'htmlOptions'=>array('width'=>'50px'),
	    		),
		//'program.programId',
		/*array(
			'name'=>'categoryName',
			'type'=>'raw',
			'filter'=>CHtml::listData(ScholarshipCategory::model()->findAll(), 'id', 'name'),
			'value'=>'ScholarshipCategory::model()->findByAttributes(array("id"=>$data->category->categoryId))->name',
			'htmlOptions'=>array('style'=>'width:80px')
			),*/
		//'',
		//'program.status.type',
		//'school.school.name',
				
	),
));