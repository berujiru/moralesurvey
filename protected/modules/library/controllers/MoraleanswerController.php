	<?php

class MoraleanswerController extends RController
{
	public function filters()
	{
		return array(
			 // 'accessControl', // perform access control for CRUD operations
			 // 'postOnly + delete', // we only allow deletion via POST request
			'rights',
		);
	}

	public function actionIndex()
	{
		$model=new Moraleanswer;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		// if(isset($_POST['Moraleanswer']))
		// {
		// 	$model->attributes=$_POST['Moraleanswer'];
		// 	$model->user_id=Yii::app()->user->id;
		// 				if($model->save())
		// 		$this->redirect(array('view','id'=>$model->id));
		// }
		//gets the morale questions taht is active for this moment
		$criteria=new CDbCriteria;
		$criteria->condition = "status = 1";
		$questions=Moralequestions::model()->findAll($criteria);

		//gets the morale survey  effective for this time
		$criteria=new CDbCriteria;
		$criteria->condition = "datefrom <= '".date("Y-m-d")."' and dateto >= '".date("Y-m-d")."'";
		$moralesurvey=Moralesurvey::model()->find($criteria);

		if(!$moralesurvey){
			throw new CHttpException(404, 'Oops. Not found. or that Morale Survey is not set or already expired'); 
		}

		//get any record that the user already answered the some question
		$criteria=new CDbCriteria;
		$criteria->condition = 'user_id = '.Yii::app()->user->id.' and survey_id = '.$moralesurvey->id;
		$answered = Moraleanswer::model()->findAll($criteria);

		//print_r($moralesurvey);exit();
		if($moralesurvey){
			$this->render('index',array(
				'model'=>$model,
				'questions'=>$questions,
				'moralesurvey'=>$moralesurvey,
				'answered'=>$answered,
			));
		}else{
			echo "No active Morale Survey in this moment"; exit();
		}
		
	}

	public function actionAnswer($qid,$answer,$sid){
		//check if there is any existing record if true update if false then create new
		$record = Moraleanswer::model()->findbyAttributes(array('user_id'=>Yii::app()->user->id,'question'=>$qid,'survey_id'=>$sid));
		if($record){
			$record->answer=$answer;
			$record->date=date("Y-m-d");
			$record->save();
			echo "updated record";
		}else{
			$model=new Moraleanswer;
			$model->user_id = Yii::app()->user->id;
			$model->survey_id = $sid;
			$model->date=date("Y-m-d");
			$model->question=$qid;
			$model->answer=$answer;
			$model->save();
			echo "created new record";
		}
	}

	public function actionConsolidate()
	{
		$criteria=new CDbCriteria;
		$criteria->condition = "datefrom <= '".date("Y-m-d")."' and dateto >= '".date("Y-m-d")."'";
		$moralesurvey=Moralesurvey::model()->find($criteria);
		
		//get the pool of unit division position  but optional
		//$divisions = ReferDivision::model()->findAll();
		//$numquestion = Moralequestions::model()->getItems(); //get number of questions but optional
		$ord_ids=Moraleconfig::model()->getEmployee(7,'regular'); //ids under ord & regular
		$ords =Moraleconfig::model()->getEmployeeAR(7,'regular'); //AR for tabular view

		$fos_p_ids = Moraleconfig::model()->getEmployeeWS(5,'regular');//ids under fos & regular
		$fos_p=Moraleconfig::model()->getEmployeeARWS(5,'regular'); //AR for tabular view

		$fos_pb_ids = Moraleconfig::model()->getEmployee(5,'project_base');//ids under fos & project base
		$fos_pb=Moraleconfig::model()->getEmployeeAR(5,'project_base'); //AR for tabular view

		$fos_ids = Moraleconfig::model()->getEmployee(5,'');//ids under fos & all type of position
		
		$ts_p_ids = Moraleconfig::model()->getEmployee(4,'regular');//ids under ts & regular
		$ts_p=Moraleconfig::model()->getEmployeeAR(4,'regular'); //AR for tabular view

		$ts_pb_ids = Moraleconfig::model()->getEmployee(4,'project_base');//ids under ts & & project base
		$ts_pb=Moraleconfig::model()->getEmployeeAR(4,'project_base'); //AR for tabular view

		$ts_ids = Moraleconfig::model()->getEmployee(4,'');//ids under ts & all type of position

		$rstl_p_ids = Moraleconfig::model()->getEmployee(8,'regular');//ids under rstl & regular
		$rstl_p=Moraleconfig::model()->getEmployeeAR(8,'regular'); //AR for tabular view

		$rstl_pb_ids = Moraleconfig::model()->getEmployee(8,'project_base');//ids under rstl & & project base
		$rstl_pb=Moraleconfig::model()->getEmployeeAR(8,'project_base'); //AR for tabular view

		$rstl_ids = Moraleconfig::model()->getEmployee(8,'');//ids under rstl & all type of position

		$fass_p_ids = Moraleconfig::model()->getEmployee(1,'regular');//ids under fass & regular
		$fass_p=Moraleconfig::model()->getEmployeeAR(1,'regular'); //AR for tabular view

		$fass_c_ids = Moraleconfig::model()->getEmployee(1,'contractual');//ids under fass & & project base
		$fass_c=Moraleconfig::model()->getEmployeeAR(1,'contractual'); //AR for tabular view

		$fass_ids = Moraleconfig::model()->getEmployee(1,'');//ids under fass & all type of position

		$pstc_p_zds_ids = Moraleconfig::model()->getEmployee(9,'regular',1);//ids under pstc & regular
		$pstc_p_zds = Moraleconfig::model()->getEmployeeAR(9,'regular',1);//ids under pstc & regular

		$pstc_pb_zds_ids = Moraleconfig::model()->getEmployee(9,'project_base',1);//ids under pstc & project_base
		$pstc_pb_zds = Moraleconfig::model()->getEmployeeAR(9,'project_base',1);//ids under pstc & project_base

		$pstc_c_zds_ids = Moraleconfig::model()->getEmployee(9,'contractual',1);//ids under pstc & contractual
		$pstc_c_zds = Moraleconfig::model()->getEmployeeAR(9,'contractual',1);//ids under pstc & contractual

		$pstc_zds_ids = Moraleconfig::model()->getEmployee(9,'',1);//ids under fass & all type of position

		$pstc_p_zdn_ids = Moraleconfig::model()->getEmployee(9,'regular',2);//ids under pstc & regular
		$pstc_p_zdn = Moraleconfig::model()->getEmployeeAR(9,'regular',2);//ids under pstc & regular

		$pstc_pb_zdn_ids = Moraleconfig::model()->getEmployee(9,'project_base',2);//ids under pstc & project_base
		$pstc_pb_zdn = Moraleconfig::model()->getEmployeeAR(9,'project_base',2);//ids under pstc & project_base

		$pstc_c_zdn_ids = Moraleconfig::model()->getEmployee(9,'contractual',2);//ids under pstc & contractual
		$pstc_c_zdn = Moraleconfig::model()->getEmployeeAR(9,'contractual',2);//ids under pstc & contractual

		$pstc_zdn_ids = Moraleconfig::model()->getEmployee(9,'',2);//ids under fass & all type of position

		$pstc_p_zs_ids = Moraleconfig::model()->getEmployee(9,'regular',3);//ids under pstc & regular
		$pstc_p_zs = Moraleconfig::model()->getEmployeeAR(9,'regular',3);//ids under pstc & regular

		$pstc_pb_zs_ids = Moraleconfig::model()->getEmployee(9,'project_base',3);//ids under pstc & project_base
		$pstc_pb_zs = Moraleconfig::model()->getEmployeeAR(9,'project_base',3);//ids under pstc & project_base

		$pstc_c_zs_ids = Moraleconfig::model()->getEmployee(9,'contractual',3);//ids under pstc & contractual
		$pstc_c_zs = Moraleconfig::model()->getEmployeeAR(9,'contractual',3);//ids under pstc & contractual

		$pstc_zs_ids = Moraleconfig::model()->getEmployee(9,'',3);//ids under fass & all type of position


		$pstc_ids = Moraleconfig::model()->getEmployeeWS(9,'');//ids under fass & all type of position
		//print_r($ords); exit();


		$all_p_ids = Moraleconfig::model()->getAllEmployee('regular');
		$all_p = Moraleconfig::model()->getAllEmployeeAR('regular');

		$all_pb_ids = Moraleconfig::model()->getAllEmployee('project_base');
		$all_pb = Moraleconfig::model()->getAllEmployeeAR('project_base');

		$all_c_ids = Moraleconfig::model()->getAllEmployee('contractual');
		$all_c = Moraleconfig::model()->getAllEmployeeAR('contractual');

		$all_ids = Moraleconfig::model()->getAllEmployee('');
		//$all_c = Moraleconfig::model()->getAllEmployeeAR('contractual');


		$this->render('consolidate',array(
			'moralesurvey'=>$moralesurvey,
			//'divisions'=>$divisions,
			'ords'=>$ords,
			'ord_ids'=>$ord_ids,
			'fos_p_ids'=>$fos_p_ids,
			'fos_p'=>$fos_p,
			'fos_pb_ids'=>$fos_pb_ids,
			'fos_pb'=>$fos_pb,
			'fos_ids'=>$fos_ids,
			'ts_p_ids'=>$ts_p_ids,
			'ts_p'=>$ts_p,
			'ts_pb_ids'=>$ts_pb_ids,
			'ts_pb'=>$ts_pb,
			'ts_ids'=>$ts_ids,

			'rstl_p_ids'=>$rstl_p_ids,
			'rstl_p'=>$rstl_p,
			'rstl_pb_ids'=>$rstl_pb_ids,
			'rstl_pb'=>$rstl_pb,
			'rstl_ids'=>$rstl_ids,

			'fass_p_ids'=>$fass_p_ids,
			'fass_p'=>$fass_p,
			'fass_c_ids'=>$fass_c_ids,
			'fass_c'=>$fass_c,
			'fass_ids'=>$fass_ids,

			'pstc_p_zds_ids'=>$pstc_p_zds_ids,
			'pstc_p_zds'=>$pstc_p_zds,
			'pstc_pb_zds_ids'=>$pstc_pb_zds_ids,
			'pstc_pb_zds'=>$pstc_pb_zds,
			'pstc_c_zds_ids'=>$pstc_c_zds_ids,
			'pstc_c_zds'=>$pstc_c_zds,
			'pstc_zds_ids'=>$pstc_zds_ids,

			'pstc_p_zdn_ids'=>$pstc_p_zdn_ids,
			'pstc_p_zdn'=>$pstc_p_zdn,
			'pstc_pb_zdn_ids'=>$pstc_pb_zdn_ids,
			'pstc_pb_zdn'=>$pstc_pb_zdn,
			'pstc_c_zdn_ids'=>$pstc_c_zdn_ids,
			'pstc_c_zdn'=>$pstc_c_zdn,
			'pstc_zdn_ids'=>$pstc_zdn_ids,

			'pstc_p_zs_ids'=>$pstc_p_zs_ids,
			'pstc_p_zs'=>$pstc_p_zs,
			'pstc_pb_zs_ids'=>$pstc_pb_zs_ids,
			'pstc_pb_zs'=>$pstc_pb_zs,
			'pstc_c_zs_ids'=>$pstc_c_zs_ids,
			'pstc_c_zs'=>$pstc_c_zs,
			'pstc_zs_ids'=>$pstc_zs_ids,
			'pstc_ids'=>$pstc_ids,

			'all_p'=>$all_p,
			'all_p_ids'=>$all_p_ids,

			'all_pb'=>$all_pb,
			'all_pb_ids'=>$all_pb_ids,

			'all_c'=>$all_c,
			'all_c_ids'=>$all_c_ids,

			'all_ids'=>$all_ids,

		));
	}

	public function actionView(){
		$all = Moraleconfig::model()->getAllAR();
		//print_r($all); exit();
		$criteria=new CDbCriteria;
		$criteria->condition = "datefrom <= '".date("Y-m-d")."' and dateto >= '".date("Y-m-d")."'";
		$moralesurvey=Moralesurvey::model()->find($criteria);

		$this->render('view',array(
			'all'=>$all,
			'moralesurvey'=>$moralesurvey,
			));
	}


	public function actionViewperquestion(){
		//get all the active question
		// $all = Moralequestions::model()->find()->condition(['status'=>1]);
		$criteria=new CDbCriteria;
		$criteria->condition="status=1";

		$all = new CActiveDataProvider('Moralequestions', array(
			'criteria'=>$criteria,
			'pagination'=>false,
		));


		//print_r($all); exit();
		$criteria=new CDbCriteria;
		$criteria->condition = "datefrom <= '".date("Y-m-d")."' and dateto >= '".date("Y-m-d")."'";
		$moralesurvey=Moralesurvey::model()->find($criteria);

		$this->render('viewperquestion',array(
			'all'=>$all,
			'moralesurvey'=>$moralesurvey,
			));
	}


	public function actionViewbyyear($date){
		$all = Moraleconfig::model()->getAllAR();
		//print_r($all); exit();
		$criteria=new CDbCriteria;
		$criteria->condition = "datefrom <= '".$date."' and dateto >= '".$date."'";
		$moralesurvey=Moralesurvey::model()->find($criteria);

		$this->render('view',array(
			'all'=>$all,
			'moralesurvey'=>$moralesurvey,
			));
	}

	public function actionPrint(){
		$ord_ids=Moraleconfig::model()->getEmployee(7,'regular'); //ids under ord & regular
		$fos_ids = Moraleconfig::model()->getEmployee(5,'');//ids under fos & all type of position
		$ts_ids = Moraleconfig::model()->getEmployee(4,'');//ids under ts & all type of position
		$rstl_ids = Moraleconfig::model()->getEmployee(8,'');//ids under rstl & all type of position
		$fass_ids = Moraleconfig::model()->getEmployee(1,'');//ids under fass & all type of position
		$pstc_zds_ids = Moraleconfig::model()->getEmployee(9,'',1);//ids under fass & all type of position
		$pstc_zdn_ids = Moraleconfig::model()->getEmployee(9,'',2);//ids under fass & all type of position
		$pstc_zs_ids = Moraleconfig::model()->getEmployee(9,'',3);//ids under fass & all type of position
		$pstc_ids = Moraleconfig::model()->getEmployeeWS(9,'');//ids under fass & all type of position
		$all_p_ids = Moraleconfig::model()->getAllEmployee('regular');
		$all_pb_ids = Moraleconfig::model()->getAllEmployee('project_base');
		$all_c_ids = Moraleconfig::model()->getAllEmployee('contractual');
		$all_ids = Moraleconfig::model()->getAllEmployee('');


		$criteria=new CDbCriteria;
		$criteria->condition = "datefrom <= '".date("Y-m-d")."' and dateto >= '".date("Y-m-d")."'";
		$moralesurvey=Moralesurvey::model()->find($criteria);
		$msid = $moralesurvey->id;

		$model = new User();
		//$dataProvider=$model->searchByYearAward($start, $end);

		// Export it (note the way we define columns, the same as in CGridView, thanks to EExcelView)
			$this->widget('ext.EExcelView.EExcelViewReportMorale', array(

			//$this->widget('ext.EExcelview.EExcelView', array(
				'dataProvider'=>$model->getAllAR(),
				'rowCssClassExpression'=>'$data->color',
				//'htmlOptions'=>array('class'=>'grid-view padding0'),
				//'itemsCssClass'=>'table table-hover table-striped table-bordered table-condensed',
				//'mergeColumns' => array('moraleconfig.division'),
				'extraRowColumns' => array('moraleconfig.div.division_code'),
				//'extraRowExpression' => '"<font size=\"5\"><b>".strtoupper($data->moraleconfig->div->division_code)."</b></font>"',
				'title'=>"Morale Survey",
				'filename'=>"Morale Survey",
				'grid_mode'=>'export',
				'autoWidth'=>false,

				'moralesurvey'=>$moralesurvey,
				'ord_ids'=> Moraleanswer::model()->getAverage($ord_ids,$moralesurvey->id),
				'fos_ids'=>Moraleanswer::model()->getAverage($fos_ids,$moralesurvey->id) ,
				'ts_ids'=>Moraleanswer::model()->getAverage($ts_ids,$moralesurvey->id),
				'rstl_ids'=>Moraleanswer::model()->getAverage($rstl_ids,$moralesurvey->id),
				'fass_ids'=>Moraleanswer::model()->getAverage($fass_ids,$moralesurvey->id),
				'pstc_zds_ids'=>Moraleanswer::model()->getAverage($pstc_zds_ids,$moralesurvey->id),
				'pstc_zdn_ids'=>Moraleanswer::model()->getAverage($pstc_zdn_ids,$moralesurvey->id),
				'pstc_zs_ids'=>Moraleanswer::model()->getAverage($pstc_zs_ids,$moralesurvey->id),
				'pstc_ids'=>Moraleanswer::model()->getAverage($pstc_ids,$moralesurvey->id),
				'all_p_ids'=>Moraleanswer::model()->getAverage($all_p_ids,$moralesurvey->id) ,
				'all_pb_ids'=>Moraleanswer::model()->getAverage($all_pb_ids,$moralesurvey->id),
				'all_c_ids'=>Moraleanswer::model()->getAverage($all_c_ids,$moralesurvey->id),
				'all_ids'=>Moraleanswer::model()->getAverage($all_ids,$moralesurvey->id),


				'columns'=>array(
					array(
						'name'=>'id',
						'header'=>'#',
						'value'=>'$row+1',
						'filter'=>false,
						),
					//'id',
					// array(
			  //   		'name'=>'name',
					// 	'header'=>'Full name',
					// 	 'value'=>function($data){
					// 	 	return myhelper::getfullname($data->id);
					// 	 },
					// 	'filter'=>false,
			  //   		),
					//'moraleconfig.division',
					// array(
					// 		'name'=>'position.position_type',
					// 		'value'=>'$data->position->position_type',
					// 		'headerHtmlOptions' => array('style' => 'display: none'),
				 //            'htmlOptions' => array('style' => 'display: none'),
					// 		'footerHtmlOptions'=>array('style' => 'display: none'),
					// 		),
					//'position.position_type',
					array(
				    		'name'=>'dn',
							'header'=>'DN',
							//'value'=>'$data->id',
							//'value'=>Moraleanswer::model()->getAnswer($this->data->id,'DN'),
							'value'=>function($data,$datacolumn) use($msid){
							 	return Moraleanswer::model()->getAnswer($data->id,'DN',$msid);
							 },
							'filter'=>false,
							'htmlOptions'=>array('width'=>'40px'),
				    		),
			    	array(
			    		'name'=>'n',
						'header'=>'N',
						'value'=>function($data,$datacolumn) use($msid){
						 	return Moraleanswer::model()->getAnswer($data->id,'N',$msid);
						 },
						'filter'=>false,
						'htmlOptions'=>array('width'=>'40px'),
			    		),
			    	array(
			    		'name'=>'ns',
						'header'=>'NS',
						'value'=>function($data,$datacolumn) use($msid){
						 	return Moraleanswer::model()->getAnswer($data->id,'NS',$msid);
						 },
						'filter'=>false,
						'htmlOptions'=>array('width'=>'40px'),
			    		),
			    	array(
			    		'name'=>'y',
						'header'=>'Y',
						'value'=>function($data,$datacolumn) use($msid){
						 	return Moraleanswer::model()->getAnswer($data->id,'Y',$msid);
						 },
						'filter'=>false,
						'htmlOptions'=>array('width'=>'40px'),
			    		),
			    	array(
			    		'name'=>'dy',
						'header'=>'DY',
						'value'=>function($data,$datacolumn) use($msid){
						 	return Moraleanswer::model()->getAnswer($data->id,'DY',$msid);
						 },
						'filter'=>false,
						'htmlOptions'=>array('width'=>'40px'),
			    		),
			    	array(
			    		'name'=>'total',
						'header'=>'Total',
						'value'=>function($data,$datacolumn) use($msid){
						 	return Moraleanswer::model()->getTotalanswer($data->id,$msid);
						 },
						'filter'=>false,
						'htmlOptions'=>array('width'=>'40px'),
			    		),
			    	array(
			    		'name'=>'index',
						'header'=>'Index',
						'value'=>function($data,$datacolumn) use($msid){
						 	return Moraleanswer::model()->getIndex($data->id,$msid);
						 },
						'filter'=>false,
			    		),
					/*array(
						'name'=>'category.yearAwarded',	
						'headerHtmlOptions' => array('style' => 'display: none'),
						'htmlOptions' => array('style' => 'display: none'),
						'footerHtmlOptions'=>array('style' => 'display: none'),
						),*/
				),
			
			)
				//'Excel2007' // This is the default value, so you can omit it. You can export to CSV, PDF or HTML too
			);
		

	}



	public function actionPrintbyyear($date){
		$ord_ids=Moraleconfig::model()->getEmployee(7,'regular'); //ids under ord & regular
		$fos_ids = Moraleconfig::model()->getEmployee(5,'');//ids under fos & all type of position
		$ts_ids = Moraleconfig::model()->getEmployee(4,'');//ids under ts & all type of position
		$rstl_ids = Moraleconfig::model()->getEmployee(8,'');//ids under rstl & all type of position
		$fass_ids = Moraleconfig::model()->getEmployee(1,'');//ids under fass & all type of position
		$pstc_zds_ids = Moraleconfig::model()->getEmployee(9,'',1);//ids under fass & all type of position
		$pstc_zdn_ids = Moraleconfig::model()->getEmployee(9,'',2);//ids under fass & all type of position
		$pstc_zs_ids = Moraleconfig::model()->getEmployee(9,'',3);//ids under fass & all type of position
		$pstc_ids = Moraleconfig::model()->getEmployeeWS(9,'');//ids under fass & all type of position
		$all_p_ids = Moraleconfig::model()->getAllEmployee('regular');
		$all_pb_ids = Moraleconfig::model()->getAllEmployee('project_base');
		$all_c_ids = Moraleconfig::model()->getAllEmployee('contractual');
		$all_ids = Moraleconfig::model()->getAllEmployee('');


		$criteria=new CDbCriteria;
		$criteria->condition = "datefrom <= '".$date."' and dateto >= '".$date."'";
		$moralesurvey=Moralesurvey::model()->find($criteria);
		$msid = $moralesurvey->id;

		$model = new User();
		//$dataProvider=$model->searchByYearAward($start, $end);

		// Export it (note the way we define columns, the same as in CGridView, thanks to EExcelView)
			$this->widget('ext.EExcelView.EExcelViewReportMorale', array(

			//$this->widget('ext.EExcelview.EExcelView', array(
				'dataProvider'=>$model->getAllAR(),
				'rowCssClassExpression'=>'$data->color',
				//'htmlOptions'=>array('class'=>'grid-view padding0'),
				//'itemsCssClass'=>'table table-hover table-striped table-bordered table-condensed',
				//'mergeColumns' => array('moraleconfig.division'),
				'extraRowColumns' => array('moraleconfig.div.division_code'),
				//'extraRowExpression' => '"<font size=\"5\"><b>".strtoupper($data->moraleconfig->div->division_code)."</b></font>"',
				'title'=>"Morale Survey",
				'filename'=>"Morale Survey",
				'grid_mode'=>'export',
				'autoWidth'=>false,

				'moralesurvey'=>$moralesurvey,
				'ord_ids'=> Moraleanswer::model()->getAverage($ord_ids,$moralesurvey->id),
				'fos_ids'=>Moraleanswer::model()->getAverage($fos_ids,$moralesurvey->id) ,
				'ts_ids'=>Moraleanswer::model()->getAverage($ts_ids,$moralesurvey->id),
				'rstl_ids'=>Moraleanswer::model()->getAverage($rstl_ids,$moralesurvey->id),
				'fass_ids'=>Moraleanswer::model()->getAverage($fass_ids,$moralesurvey->id),
				'pstc_zds_ids'=>Moraleanswer::model()->getAverage($pstc_zds_ids,$moralesurvey->id),
				'pstc_zdn_ids'=>Moraleanswer::model()->getAverage($pstc_zdn_ids,$moralesurvey->id),
				'pstc_zs_ids'=>Moraleanswer::model()->getAverage($pstc_zs_ids,$moralesurvey->id),
				'pstc_ids'=>Moraleanswer::model()->getAverage($pstc_ids,$moralesurvey->id),
				'all_p_ids'=>Moraleanswer::model()->getAverage($all_p_ids,$moralesurvey->id) ,
				'all_pb_ids'=>Moraleanswer::model()->getAverage($all_pb_ids,$moralesurvey->id),
				'all_c_ids'=>Moraleanswer::model()->getAverage($all_c_ids,$moralesurvey->id),
				'all_ids'=>Moraleanswer::model()->getAverage($all_ids,$moralesurvey->id),


				'columns'=>array(
					array(
						'name'=>'id',
						'header'=>'#',
						'value'=>'$row+1',
						'filter'=>false,
						),
					//'id',
					// array(
			  //   		'name'=>'name',
					// 	'header'=>'Full name',
					// 	 'value'=>function($data){
					// 	 	return myhelper::getfullname($data->id);
					// 	 },
					// 	'filter'=>false,
			  //   		),
					//'moraleconfig.division',
					// array(
					// 		'name'=>'position.position_type',
					// 		'value'=>'$data->position->position_type',
					// 		'headerHtmlOptions' => array('style' => 'display: none'),
				 //            'htmlOptions' => array('style' => 'display: none'),
					// 		'footerHtmlOptions'=>array('style' => 'display: none'),
					// 		),
					//'position.position_type',
					array(
				    		'name'=>'dn',
							'header'=>'DN',
							//'value'=>'$data->id',
							//'value'=>Moraleanswer::model()->getAnswer($this->data->id,'DN'),
							'value'=>function($data,$datacolumn) use($msid){
							 	return Moraleanswer::model()->getAnswer($data->id,'DN',$msid);
							 },
							'filter'=>false,
							'htmlOptions'=>array('width'=>'40px'),
				    		),
			    	array(
			    		'name'=>'n',
						'header'=>'N',
						'value'=>function($data,$datacolumn) use($msid){
						 	return Moraleanswer::model()->getAnswer($data->id,'N',$msid);
						 },
						'filter'=>false,
						'htmlOptions'=>array('width'=>'40px'),
			    		),
			    	array(
			    		'name'=>'ns',
						'header'=>'NS',
						'value'=>function($data,$datacolumn) use($msid){
						 	return Moraleanswer::model()->getAnswer($data->id,'NS',$msid);
						 },
						'filter'=>false,
						'htmlOptions'=>array('width'=>'40px'),
			    		),
			    	array(
			    		'name'=>'y',
						'header'=>'Y',
						'value'=>function($data,$datacolumn) use($msid){
						 	return Moraleanswer::model()->getAnswer($data->id,'Y',$msid);
						 },
						'filter'=>false,
						'htmlOptions'=>array('width'=>'40px'),
			    		),
			    	array(
			    		'name'=>'dy',
						'header'=>'DY',
						'value'=>function($data,$datacolumn) use($msid){
						 	return Moraleanswer::model()->getAnswer($data->id,'DY',$msid);
						 },
						'filter'=>false,
						'htmlOptions'=>array('width'=>'40px'),
			    		),
			    	array(
			    		'name'=>'total',
						'header'=>'Total',
						'value'=>function($data,$datacolumn) use($msid){
						 	return Moraleanswer::model()->getTotalanswer($data->id,$msid);
						 },
						'filter'=>false,
						'htmlOptions'=>array('width'=>'40px'),
			    		),
			    	array(
			    		'name'=>'index',
						'header'=>'Index',
						'value'=>function($data,$datacolumn) use($msid){
						 	return Moraleanswer::model()->getIndex($data->id,$msid);
						 },
						'filter'=>false,
			    		),
					/*array(
						'name'=>'category.yearAwarded',	
						'headerHtmlOptions' => array('style' => 'display: none'),
						'htmlOptions' => array('style' => 'display: none'),
						'footerHtmlOptions'=>array('style' => 'display: none'),
						),*/
				),
			
			)
				//'Excel2007' // This is the default value, so you can omit it. You can export to CSV, PDF or HTML too
			);
		

	}


	public function actionAdmin()
    {
        $model=new Moraleanswer('search');
        $model->unsetAttributes();  // clear any default values
        if(isset($_GET['Moraleanswer']))
            $model->attributes=$_GET['Moraleanswer'];

        $this->render('admin',array(
            'model'=>$model,
        ));
    }





    public function actionConsolidatebyyear($date)
	{
		$criteria=new CDbCriteria;
		$criteria->condition = "datefrom <= '".$date."' and dateto >= '".$date."'";
		$moralesurvey=Moralesurvey::model()->find($criteria);
		
		//get the pool of unit division position  but optional
		//$divisions = ReferDivision::model()->findAll();
		//$numquestion = Moralequestions::model()->getItems(); //get number of questions but optional
		$ord_ids=Moraleconfig::model()->getEmployee(7,'regular'); //ids under ord & regular
		$ords =Moraleconfig::model()->getEmployeeAR(7,'regular'); //AR for tabular view

		$fos_p_ids = Moraleconfig::model()->getEmployeeWS(5,'regular');//ids under fos & regular
		$fos_p=Moraleconfig::model()->getEmployeeARWS(5,'regular'); //AR for tabular view

		$fos_pb_ids = Moraleconfig::model()->getEmployee(5,'project_base');//ids under fos & project base
		$fos_pb=Moraleconfig::model()->getEmployeeAR(5,'project_base'); //AR for tabular view

		$fos_ids = Moraleconfig::model()->getEmployee(5,'');//ids under fos & all type of position
		
		$ts_p_ids = Moraleconfig::model()->getEmployee(4,'regular');//ids under ts & regular
		$ts_p=Moraleconfig::model()->getEmployeeAR(4,'regular'); //AR for tabular view

		$ts_pb_ids = Moraleconfig::model()->getEmployee(4,'project_base');//ids under ts & & project base
		$ts_pb=Moraleconfig::model()->getEmployeeAR(4,'project_base'); //AR for tabular view

		$ts_ids = Moraleconfig::model()->getEmployee(4,'');//ids under ts & all type of position

		$rstl_p_ids = Moraleconfig::model()->getEmployee(8,'regular');//ids under rstl & regular
		$rstl_p=Moraleconfig::model()->getEmployeeAR(8,'regular'); //AR for tabular view

		$rstl_pb_ids = Moraleconfig::model()->getEmployee(8,'project_base');//ids under rstl & & project base
		$rstl_pb=Moraleconfig::model()->getEmployeeAR(8,'project_base'); //AR for tabular view

		$rstl_ids = Moraleconfig::model()->getEmployee(8,'');//ids under rstl & all type of position

		$fass_p_ids = Moraleconfig::model()->getEmployee(1,'regular');//ids under fass & regular
		$fass_p=Moraleconfig::model()->getEmployeeAR(1,'regular'); //AR for tabular view

		$fass_c_ids = Moraleconfig::model()->getEmployee(1,'contractual');//ids under fass & & project base
		$fass_c=Moraleconfig::model()->getEmployeeAR(1,'contractual'); //AR for tabular view

		$fass_ids = Moraleconfig::model()->getEmployee(1,'');//ids under fass & all type of position

		$pstc_p_zds_ids = Moraleconfig::model()->getEmployee(9,'regular',1);//ids under pstc & regular
		$pstc_p_zds = Moraleconfig::model()->getEmployeeAR(9,'regular',1);//ids under pstc & regular

		$pstc_pb_zds_ids = Moraleconfig::model()->getEmployee(9,'project_base',1);//ids under pstc & project_base
		$pstc_pb_zds = Moraleconfig::model()->getEmployeeAR(9,'project_base',1);//ids under pstc & project_base

		$pstc_c_zds_ids = Moraleconfig::model()->getEmployee(9,'contractual',1);//ids under pstc & contractual
		$pstc_c_zds = Moraleconfig::model()->getEmployeeAR(9,'contractual',1);//ids under pstc & contractual

		$pstc_zds_ids = Moraleconfig::model()->getEmployee(9,'',1);//ids under fass & all type of position

		$pstc_p_zdn_ids = Moraleconfig::model()->getEmployee(9,'regular',2);//ids under pstc & regular
		$pstc_p_zdn = Moraleconfig::model()->getEmployeeAR(9,'regular',2);//ids under pstc & regular

		$pstc_pb_zdn_ids = Moraleconfig::model()->getEmployee(9,'project_base',2);//ids under pstc & project_base
		$pstc_pb_zdn = Moraleconfig::model()->getEmployeeAR(9,'project_base',2);//ids under pstc & project_base

		$pstc_c_zdn_ids = Moraleconfig::model()->getEmployee(9,'contractual',2);//ids under pstc & contractual
		$pstc_c_zdn = Moraleconfig::model()->getEmployeeAR(9,'contractual',2);//ids under pstc & contractual

		$pstc_zdn_ids = Moraleconfig::model()->getEmployee(9,'',2);//ids under fass & all type of position

		$pstc_p_zs_ids = Moraleconfig::model()->getEmployee(9,'regular',3);//ids under pstc & regular
		$pstc_p_zs = Moraleconfig::model()->getEmployeeAR(9,'regular',3);//ids under pstc & regular

		$pstc_pb_zs_ids = Moraleconfig::model()->getEmployee(9,'project_base',3);//ids under pstc & project_base
		$pstc_pb_zs = Moraleconfig::model()->getEmployeeAR(9,'project_base',3);//ids under pstc & project_base

		$pstc_c_zs_ids = Moraleconfig::model()->getEmployee(9,'contractual',3);//ids under pstc & contractual
		$pstc_c_zs = Moraleconfig::model()->getEmployeeAR(9,'contractual',3);//ids under pstc & contractual

		$pstc_zs_ids = Moraleconfig::model()->getEmployee(9,'',3);//ids under fass & all type of position


		$pstc_ids = Moraleconfig::model()->getEmployeeWS(9,'');//ids under fass & all type of position
		//print_r($ords); exit();


		$all_p_ids = Moraleconfig::model()->getAllEmployee('regular');
		$all_p = Moraleconfig::model()->getAllEmployeeAR('regular');

		$all_pb_ids = Moraleconfig::model()->getAllEmployee('project_base');
		$all_pb = Moraleconfig::model()->getAllEmployeeAR('project_base');

		$all_c_ids = Moraleconfig::model()->getAllEmployee('contractual');
		$all_c = Moraleconfig::model()->getAllEmployeeAR('contractual');

		$all_ids = Moraleconfig::model()->getAllEmployee('');
		//$all_c = Moraleconfig::model()->getAllEmployeeAR('contractual');


		$this->render('consolidate',array(
			'moralesurvey'=>$moralesurvey,
			//'divisions'=>$divisions,
			'ords'=>$ords,
			'ord_ids'=>$ord_ids,
			'fos_p_ids'=>$fos_p_ids,
			'fos_p'=>$fos_p,
			'fos_pb_ids'=>$fos_pb_ids,
			'fos_pb'=>$fos_pb,
			'fos_ids'=>$fos_ids,
			'ts_p_ids'=>$ts_p_ids,
			'ts_p'=>$ts_p,
			'ts_pb_ids'=>$ts_pb_ids,
			'ts_pb'=>$ts_pb,
			'ts_ids'=>$ts_ids,

			'rstl_p_ids'=>$rstl_p_ids,
			'rstl_p'=>$rstl_p,
			'rstl_pb_ids'=>$rstl_pb_ids,
			'rstl_pb'=>$rstl_pb,
			'rstl_ids'=>$rstl_ids,

			'fass_p_ids'=>$fass_p_ids,
			'fass_p'=>$fass_p,
			'fass_c_ids'=>$fass_c_ids,
			'fass_c'=>$fass_c,
			'fass_ids'=>$fass_ids,

			'pstc_p_zds_ids'=>$pstc_p_zds_ids,
			'pstc_p_zds'=>$pstc_p_zds,
			'pstc_pb_zds_ids'=>$pstc_pb_zds_ids,
			'pstc_pb_zds'=>$pstc_pb_zds,
			'pstc_c_zds_ids'=>$pstc_c_zds_ids,
			'pstc_c_zds'=>$pstc_c_zds,
			'pstc_zds_ids'=>$pstc_zds_ids,

			'pstc_p_zdn_ids'=>$pstc_p_zdn_ids,
			'pstc_p_zdn'=>$pstc_p_zdn,
			'pstc_pb_zdn_ids'=>$pstc_pb_zdn_ids,
			'pstc_pb_zdn'=>$pstc_pb_zdn,
			'pstc_c_zdn_ids'=>$pstc_c_zdn_ids,
			'pstc_c_zdn'=>$pstc_c_zdn,
			'pstc_zdn_ids'=>$pstc_zdn_ids,

			'pstc_p_zs_ids'=>$pstc_p_zs_ids,
			'pstc_p_zs'=>$pstc_p_zs,
			'pstc_pb_zs_ids'=>$pstc_pb_zs_ids,
			'pstc_pb_zs'=>$pstc_pb_zs,
			'pstc_c_zs_ids'=>$pstc_c_zs_ids,
			'pstc_c_zs'=>$pstc_c_zs,
			'pstc_zs_ids'=>$pstc_zs_ids,
			'pstc_ids'=>$pstc_ids,

			'all_p'=>$all_p,
			'all_p_ids'=>$all_p_ids,

			'all_pb'=>$all_pb,
			'all_pb_ids'=>$all_pb_ids,

			'all_c'=>$all_c,
			'all_c_ids'=>$all_c_ids,

			'all_ids'=>$all_ids,

		));
	}

	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}?>

