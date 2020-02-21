
<h1><?php echo "Consolidated data of ".$moralesurvey->name?>
       
</h1>
<p class="alert alert-error">
	Effective from <b><?php echo Yii::app()->dateFormatter->format("y MMMM d",$moralesurvey->datefrom)?></b> to <b><?php echo Yii::app()->dateFormatter->format("y MMMM d",$moralesurvey->dateto)?></b>
</p>	

<?php 

$msid = $moralesurvey->id;


$this->widget('ext.groupgridview.GroupGridView', array(
	//'id'=>'scholar-grid',
	//'enableHistory'=>true,
	//'summaryText'=>false,
	// 'rowCssClassExpression'=>'$data->color',
	'htmlOptions'=>array('class'=>'grid-view padding0'),
	//'itemsCssClass'=>'table table-hover table-striped table-bordered table-condensed',
	// 'mergeColumns' => array('moraleconfig.division'),
	// 'extraRowColumns' => array('moraleconfig.division'),
	'extraRowExpression' => '"<font size=\"5\"><b>".strtoupper($data->moraleconfig->div->division_code)."</b></font>"',
	//'rowHtmlOptionsExpression' => 'array("title" => "Click to update", "class"=>"link-hand")',
	//'hiddenColumns' => 1, //modified by RBG at source code of extension
	'dataProvider'=>$all,
	//'filter'=>$model,
	'columns'=>array(
		// 'id',
		array(
			'name'=>'id',
			'header'=>'#',
			'value'=>'$row+1',
			'filter'=>false,
			),
		'question',
		array(
	    		'name'=>'dn',
				'header'=>'DN',
				//'value'=>'$data->id',
				//'value'=>Moraleanswer::model()->getAnswer($this->data->id,'DN'),
				'value'=>function($data,$datacolumn) use($msid){
				 	// echo Moraleanswer::model()->getAnswer($data->id,'DN',$msid);
				 	//$num = Moraleanswer::model()->findAllByAttributes(array('answer'=>'DN','survey_id'=>$msid,'question'=>$data->id));

				 	$num = Yii::app()->db->createCommand()
				    ->from('Moraleanswer a')
				    ->join('moraleconfig c', 'a.user_id=c.user_id')
				    ->where('c.status=1 and a.answer="DN" and a.survey_id='.$msid.' and question='.$data->id)
				    ->queryAll();



					//print_r($num); exit();
					$num = count($num);
					return $num;
				 },
				'filter'=>false,
				'htmlOptions'=>array('width'=>'40px'),
	    		),
	    	array(
	    		'name'=>'n',
				'header'=>'N',
				'value'=>function($data,$datacolumn) use($msid){
				 	// echo Moraleanswer::model()->getAnswer($data->id,'N',$msid);
				 	// $num = Moraleanswer::model()->findAllByAttributes(array('answer'=>'N','survey_id'=>$msid,'question'=>$data->id));

				 	$num = Yii::app()->db->createCommand()
				    ->from('Moraleanswer a')
				    ->join('moraleconfig c', 'a.user_id=c.user_id')
				    ->where('c.status=1 and a.answer="N" and a.survey_id='.$msid.' and question='.$data->id)
				    ->queryAll();

					//print_r($num); exit();
					$num = count($num);
					return $num;
				 },
				'filter'=>false,
				'htmlOptions'=>array('width'=>'40px'),
	    		),
	    	array(
	    		'name'=>'ns',
				'header'=>'NS',
				'value'=>function($data,$datacolumn) use($msid){
				 	// echo Moraleanswer::model()->getAnswer($data->id,'NS',$msid);
				 	// $num = Moraleanswer::model()->findAllByAttributes(array('answer'=>'NS','survey_id'=>$msid,'question'=>$data->id));
					//print_r($num); exit();

					$num = Yii::app()->db->createCommand()
				    ->from('Moraleanswer a')
				    ->join('moraleconfig c', 'a.user_id=c.user_id')
				    ->where('c.status=1 and a.answer="NS" and a.survey_id='.$msid.' and question='.$data->id)
				    ->queryAll();


					$num = count($num);
					return $num;
				 },
				'filter'=>false,
				'htmlOptions'=>array('width'=>'40px'),
	    		),
	    	array(
	    		'name'=>'y',
				'header'=>'Y',
				'value'=>function($data,$datacolumn) use($msid){
				 	// echo Moraleanswer::model()->getAnswer($data->id,'Y',$msid);
				 	// $num = Moraleanswer::model()->findAllByAttributes(array('answer'=>'Y','survey_id'=>$msid,'question'=>$data->id));

				 	$num = Yii::app()->db->createCommand()
				    ->from('Moraleanswer a')
				    ->join('moraleconfig c', 'a.user_id=c.user_id')
				    ->where('c.status=1 and a.answer="Y" and a.survey_id='.$msid.' and question='.$data->id)
				    ->queryAll();


					//print_r($num); exit();
					$num = count($num);
					return $num;
				 },
				'filter'=>false,
				'htmlOptions'=>array('width'=>'40px'),
	    		),
	    	array(
	    		'name'=>'dy',
				'header'=>'DY',
				'value'=>function($data,$datacolumn) use($msid){
				 	// echo Moraleanswer::model()->getAnswer($data->id,'DY',$msid);
				 	// $num = Moraleanswer::model()->findAllByAttributes(array('answer'=>'DY','survey_id'=>$msid,'question'=>$data->id));

				 	$num = Yii::app()->db->createCommand()
				    ->from('Moraleanswer a')
				    ->join('moraleconfig c', 'a.user_id=c.user_id')
				    ->where('c.status=1 and a.answer="DY" and a.survey_id='.$msid.' and question='.$data->id)
				    ->queryAll();

					//print_r($num); exit();
					$num = count($num);
					return $num;
				 },
				'filter'=>false,
				'htmlOptions'=>array('width'=>'40px'),
	    		),
	    	array(
	    		'name'=>'total',
				'header'=>'Total',
				'value'=>function($data,$datacolumn) use($msid){
				 	// echo Moraleanswer::model()->getTotalanswer($data->id,$msid);
				 	// $num = Moraleanswer::model()->findAllByAttributes(array('survey_id'=>$msid,'question'=>$data->id));

				 	$num = Yii::app()->db->createCommand()
				    ->from('Moraleanswer a')
				    ->join('moraleconfig c', 'a.user_id=c.user_id')
				    ->where('c.status=1 and a.survey_id='.$msid.' and question='.$data->id)
				    ->queryAll();


					//print_r($num); exit();
					$num = count($num);
					return $num;
				 },
				'filter'=>false,
				'htmlOptions'=>array('width'=>'40px'),
	    		),
	    	array(
	    		'name'=>'index',
				'header'=>'Index',
				'value'=>function($data,$datacolumn) use($msid){
				 	// echo Moraleanswer::model()->getIndex($data->id,$msid);
				 	// $num = Moraleanswer::model()->findAllByAttributes(array('survey_id'=>$msid,'question'=>$data->id));

				 	$num = Yii::app()->db->createCommand()
				    ->from('Moraleanswer a')
				    ->join('moraleconfig c', 'a.user_id=c.user_id')
				    ->where('c.status=1 and a.survey_id='.$msid.' and question='.$data->id)
				    ->queryAll();


					$total = count($num)*4;
					// $num = Moraleanswer::model()->findAllByAttributes(array('answer'=>'N','survey_id'=>$msid,'question'=>$data->id));

					$num = Yii::app()->db->createCommand()
				    ->from('Moraleanswer a')
				    ->join('moraleconfig c', 'a.user_id=c.user_id')
				    ->where('c.status=1 and a.answer="N" and a.survey_id='.$msid.' and question='.$data->id)
				    ->queryAll();


					$n = count($num)*1;
					//$num = Moraleanswer::model()->findAllByAttributes(array('answer'=>'NS','survey_id'=>$msid,'question'=>$data->id));

					$num = Yii::app()->db->createCommand()
				    ->from('Moraleanswer a')
				    ->join('moraleconfig c', 'a.user_id=c.user_id')
				    ->where('c.status=1 and a.answer="NS" and a.survey_id='.$msid.' and question='.$data->id)
				    ->queryAll();


					$ns = count($num)*2;
					//$num = Moraleanswer::model()->findAllByAttributes(array('answer'=>'Y','survey_id'=>$msid,'question'=>$data->id));

					$num = Yii::app()->db->createCommand()
				    ->from('Moraleanswer a')
				    ->join('moraleconfig c', 'a.user_id=c.user_id')
				    ->where('c.status=1 and a.answer="Y" and a.survey_id='.$msid.' and question='.$data->id)
				    ->queryAll();

					$y = count($num)*3;
					// $num = Moraleanswer::model()->findAllByAttributes(array('answer'=>'DY','survey_id'=>$msid,'question'=>$data->id));

					$num = Yii::app()->db->createCommand()
				    ->from('Moraleanswer a')
				    ->join('moraleconfig c', 'a.user_id=c.user_id')
				    ->where('c.status=1 and a.answer="DY" and a.survey_id='.$msid.' and question='.$data->id)
				    ->queryAll();

					$dy =count($num)*4;
					
					if($total==0){
						return 0;
					}
					else{
						$index = (($n + $ns + $y + $dy)/$total)*100;
						return $index;
					}
				 },
				'filter'=>false,
				//'htmlOptions'=>array('width'=>'50px'),
	    		),

				
	),
));