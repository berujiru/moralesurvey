<?php
	Yii::import('zii.widgets.grid.CGridView');

	/**
	* @author Nikola Kostadinov
	* @license MIT License
	* @version 0.3
	*/	
	class EExcelViewReportMorale extends CGridView
	{
		//Document properties
		//public $creator = 'Nikola Kostadinov';
		public $creator = 'DOST-IX Scholarship Management Information System';
		public $title = null;
		public $subject = 'Subject';
		public $description = '';
		public $category = '';
		
		//the PHPExcel object
		public $objPHPExcel = null;
		public $libPath = 'ext.phpexcel.Classes.PHPExcel'; //the path to the PHP excel lib

		//config
		public $autoWidth = true;
		//public $exportType = 'Excel5';
		public $exportType = 'Excel2007';
		public $disablePaging = true;
		public $filename = null; //export FileName
		public $stream = true; //stream to browser
		public $grid_mode = 'grid'; //Whether to display grid ot export it to selected format. Possible values(grid, export)
		public $grid_mode_var = 'grid_mode'; //GET var for the grid mode
		
		public $moralesurvey;
		public $ord_ids;
		public $fos_ids;
		public $ts_ids;
		public $rstl_ids;
		public $fass_ids;
		public $pstc_zds_ids;
		public $pstc_zdn_ids;
		public $pstc_zs_ids;
		public $pstc_ids;
		public $all_p_ids;
		public $all_pb_ids;
		public $all_c_ids;
		public $all_ids;

		//modified:: patterned from GroupGridView extension
		public $mergeColumns = array();
		//list of columns on which change extrarow will be triggered
		public $extraRowColumns = array(); //used for group header
		//determine row where header will change
		public $rowChanges=array();

		//additional document config
		//public $semester;
		public $region;
		public $scholarshipProgram;
		
		//buttons config
		public $exportButtonsCSS = 'summary';
		public $exportButtons = array('Excel2007');
		public $exportText = 'Export to: ';

		//callbacks
		public $onRenderHeaderCell = null;
		public $onRenderDataCell = null;
		public $onRenderFooterCell = null;
		
		//mime types used for streaming
		public $mimeTypes = array(
			'Excel5'	=> array(
				'Content-type'=>'application/vnd.ms-excel',
				'extension'=>'xls',
				'caption'=>'Excel(*.xls)',
			),
			'Excel2007'	=> array(
				'Content-type'=>'application/vnd.ms-excel',
				'extension'=>'xlsx',
				'caption'=>'Excel(*.xlsx)',				
			),
			'PDF'		=>array(
				'Content-type'=>'application/pdf',
				'extension'=>'pdf',
				'caption'=>'PDF(*.pdf)',								
			),
			'HTML'		=>array(
				'Content-type'=>'text/html',
				'extension'=>'html',
				'caption'=>'HTML(*.html)',												
			),
			'CSV'		=>array(
				'Content-type'=>'application/csv',			
				'extension'=>'csv',
				'caption'=>'CSV(*.csv)',												
			)
		);

		public function init()
		{
			if(isset($_GET[$this->grid_mode_var]))
				$this->grid_mode = $_GET[$this->grid_mode_var];
			if(isset($_GET['exportType']))
				$this->exportType = $_GET['exportType'];
				
			$lib = Yii::getPathOfAlias($this->libPath).'.php';
			if($this->grid_mode == 'export' and !file_exists($lib)) {
				$this->grid_mode = 'grid';
				Yii::log("PHP Excel lib not found($lib). Export disabled !", CLogger::LEVEL_WARNING, 'EExcelview');
			}
				
			if($this->grid_mode == 'export')
			{			
				$this->title = $this->title ? $this->title : Yii::app()->getController()->getPageTitle();
				$this->initColumns();
				//parent::init();
				//Autoload fix
				spl_autoload_unregister(array('YiiBase','autoload'));             
				Yii::import($this->libPath, true);
				$this->objPHPExcel = new PHPExcel();
				//$this->activeSheet = $this->objPHPExcel->getActiveSheet();
				
				spl_autoload_register(array('YiiBase','autoload'));  
				// Creating a workbook
				$this->objPHPExcel->getProperties()->setCreator($this->creator);
				$this->objPHPExcel->getProperties()->setTitle($this->title);
				$this->objPHPExcel->getProperties()->setSubject($this->subject);
				$this->objPHPExcel->getProperties()->setDescription($this->description);
				$this->objPHPExcel->getProperties()->setCategory($this->category);
			} else
				parent::init();
		}

		public function renderHeader()
		{
			$a=0;
			foreach($this->columns as $column)
			{
				$a=$a+1;
				if($column instanceof CButtonColumn)
					$head = $column->header;
				elseif($column->header===null && $column->name!==null)
				{
					if($column->grid->dataProvider instanceof CActiveDataProvider)
						$head = $column->grid->dataProvider->model->getAttributeLabel($column->name);
					else
						$head = $column->name;
				} else
					$head =trim($column->header)!=='' ? $column->header : $column->grid->blankDisplay;
				
				// $this->objPHPExcel->getActiveSheet()->setCellValue( "A1" , "RGN-REPO2");
				// $this->objPHPExcel->getActiveSheet()->setCellValue( "C1" , $this->title);
				//$this->objPHPExcel->getActiveSheet()->setCellValue( "A2" , "Semester/Term");
				//$this->objPHPExcel->getActiveSheet()->setCellValue( "C2" , Yii::app()->user->semester);				
				// $this->objPHPExcel->getActiveSheet()->setCellValue( "A3" , "Scholarship Program");
				// $this->objPHPExcel->getActiveSheet()->setCellValue( "C3" , $this->scholarshipProgram);
				// $this->objPHPExcel->getActiveSheet()->setCellValue( "A4" , "Region");
				// $this->objPHPExcel->getActiveSheet()->setCellValue( "C4" , $this->region);
				// $this->objPHPExcel->getActiveSheet()->getStyle('C1:C4')->getFont()->setBold(true);
								
				//set style: alignment 
				// $this->objPHPExcel->getActiveSheet()->getStyle('A6:G6')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);	
				// $this->objPHPExcel->getActiveSheet()->getStyle('A6:G6')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
				// $this->objPHPExcel->getActiveSheet()->getStyle('A6:G6')->getFont()->setBold(true);
				//$this->objPHPExcel->getActiveSheet()->getStyle('A7:G7')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);	
				//$this->objPHPExcel->getActiveSheet()->getStyle('A7:G7')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
				//$this->objPHPExcel->getActiveSheet()->getStyle('A7:G7')->getFont()->setBold(true);
				
				//set style: border								
				//$this->objPHPExcel->getActiveSheet()->getStyle($this->columnName($a)."7:".$this->columnName($a)."8")->applyFromArray($this->borderArrayOutline());
				// $this->objPHPExcel->getActiveSheet()->getStyle($this->columnName($a)."6")->applyFromArray($this->borderArrayOutline());
					
				
				//$cell = $this->objPHPExcel->getActiveSheet()->setCellValue($this->columnName($a)."1" ,$head, true);
				//modified
				$cell = $this->objPHPExcel->getActiveSheet()->setCellValue($this->columnName($a)."6" ,$head, true);
				$this->objPHPExcel->getActiveSheet()->getColumnDimension($this->columnName($a))->setWidth(18);
				
				if(is_callable($this->onRenderHeaderCell))
					call_user_func_array($this->onRenderHeaderCell, array($cell, $head));				
			}			
		}

		public function renderBody()
		{
			if($this->disablePaging) //if needed disable paging to export all data
				$this->dataProvider->pagination = false;

			$data=$this->dataProvider->getData();
			$n=count($data);

			if($n>0)
			{
				for($row=0;$row<$n;++$row){
					$this->renderRow($row);
					
					//modified here
					foreach($this->extraRowColumns as $key=>$colName){

						if($row==0){
							$currentValue = CHtml::encode(CHtml::value($data[$row], $colName));
							$this->rowChanges[] = array('rowNum'=>0, 'value'=>$currentValue);

						}else{
							$currentValue = CHtml::encode(CHtml::value($data[$row], $colName));
							$rowChange=$this->rowChangeOccured($row-1, $colName, $currentValue);
						}
						
	
					}
					// if($row==0)
					// 	$rowChange['rowNum']==-1;
					//array_push($this->rowChanges, $rowChange);
					if(!empty($rowChange)){
						array_push($this->rowChanges, $rowChange);
					}
					// $prevValue = CHtml::encode(CHtml::value($data[$row], $colName));

					// if($row==0){
					// 	$prevValue = "";
					// }
					

					

					// if($colName!=$prevValue){
					// 	array_push($this->rowChanges, array('rowNum'=>$row, 'value'=>$currentValue));
					// }

				}
			}
            return $n;
		}

		public function renderRow($row)
		{
			$data=$this->dataProvider->getData();			

			$a=0;
			foreach($this->columns as $n=>$column)
			{
				if($column instanceof CLinkColumn)
				{
					if($column->labelExpression!==null)
						$value=$column->evaluateExpression($column->labelExpression,array('data'=>$data[$row],'row'=>$row));
					else
						$value=$column->label;
				} elseif($column instanceof CButtonColumn)
					$value = ""; //Dont know what to do with buttons
				elseif($column->value!==null) 
					$value=$this->evaluateExpression($column->value ,array('data'=>$data[$row],'row'=>$row));
				elseif($column->name!==null) { 
					//$value=$data[$row][$column->name];
					$value= CHtml::value($data[$row], $column->name);
				    $value=$value===null ? "" : $column->grid->getFormatter()->format($value,'raw');
                }             

				$a++;
				//$cell = $this->objPHPExcel->getActiveSheet()->setCellValue($this->columnName($a).($row+2) , strip_tags($value), true);
				//modified				
				$cell = $this->objPHPExcel->getActiveSheet()->setCellValue($this->columnName($a).($row+7) , strip_tags($value), true);
				
				//set first two columns alignment CENTER
				//$this->objPHPExcel->getActiveSheet()->getStyle('A'.($row+9))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);			
				//$this->objPHPExcel->getActiveSheet()->getStyle('B'.($row+9))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);			
				
				//number formats:: set comma separated with two decimals
				//except first two columns						
				//$this->objPHPExcel->getActiveSheet()->getStyle($this->columnName($a+2).($row+7))->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
				
				//apply borders::LEFT AND RIGHT						
				$this->objPHPExcel->getActiveSheet()->getStyle($this->columnName($a).($row+7))->applyFromArray($this->borderArray());

				if(CHtml::value($data[$row],'position.position_type')=="regular"){
					$this->objPHPExcel->getActiveSheet()->getStyle($this->columnName($a).($row+7))->getFill()
					->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('C1FFC1');
				}else if(CHtml::value($data[$row],'position.position_type')=="project_base"){
					$this->objPHPExcel->getActiveSheet()->getStyle($this->columnName($a).($row+7))->getFill()
					->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('f2dede');
				}else if(CHtml::value($data[$row],'position.position_type')=="contractual"){
					$this->objPHPExcel->getActiveSheet()->getStyle($this->columnName($a).($row+7))->getFill()
					->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('ffff00');
				}
				

				if(is_callable($this->onRenderDataCell))
					call_user_func_array($this->onRenderDataCell, array($cell, $data[$row], $value));
			}

		}

		public function renderFooter($row)
		{
			$a=0;
			foreach($this->columns as $n=>$column)
			{
				$a=$a+1;
                if($column->footer OR $column->footer==0)
				//to make sure 0 values of footer will not be evaluated as FALSE
                {
					//$footer =trim($column->footer)!=='' ? $column->footer : $column->grid->blankDisplay;
					//$footer =trim($column->footer)!=='' ? $column->footer : $column->grid->blankDisplay;
					$footer =trim($column->footer)!=='' ? $column->footer : '';

				    //$cell = $this->objPHPExcel->getActiveSheet()->setCellValue($this->columnName($a).($row+2) ,$footer, true);
					//modified
					$cell = $this->objPHPExcel->getActiveSheet()->setCellValue($this->columnName($a).($row+7) ,$footer, true);
										
					//apply borders
					//$this->objPHPExcel->getActiveSheet()->getStyle($this->columnName($a).($row+9))->applyFromArray($this->borderArray());
					
				    if(is_callable($this->onRenderFooterCell))
					    call_user_func_array($this->onRenderFooterCell, array($cell, $footer));				
                }
			}
			$this->objPHPExcel->getActiveSheet()->mergeCells("A1:H1");
			$this->objPHPExcel->getActiveSheet()->setCellValue('A1',$this->moralesurvey->name);
			$this->objPHPExcel->getActiveSheet()->mergeCells("A2:H2");
			$this->objPHPExcel->getActiveSheet()->setCellValue('A2',$this->moralesurvey->datefrom." - ".$this->moralesurvey->dateto);

			$this->objPHPExcel->getActiveSheet()->getStyle("A1:H1")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);	
			$this->objPHPExcel->getActiveSheet()->getStyle("A1:H1")->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
			$this->objPHPExcel->getActiveSheet()->getStyle("A1:H1")->getFont()->setBold(true);
			$this->objPHPExcel->getActiveSheet()->getStyle("A1:H1")->getFont()->setSize(14);					//$this->objPHPExcel->getActiveSheet()->setCellValue("B5", '=SUM(B6:B10)');
			$this->objPHPExcel->getActiveSheet()->getStyle("A2:H2")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);	
			$this->objPHPExcel->getActiveSheet()->getStyle("A2:H2")->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
			$this->objPHPExcel->getActiveSheet()->getStyle("A2:H2")->getFont()->setBold(true);
			$this->objPHPExcel->getActiveSheet()->getStyle("A2:H2")->getFont()->setSize(10);		

			$this->objPHPExcel->getActiveSheet()->setCellValue('A'.($row+9),'ORD rating:');
			$this->objPHPExcel->getActiveSheet()->setCellValue('A'.($row+10),'FOS rating');
			$this->objPHPExcel->getActiveSheet()->setCellValue('A'.($row+11),'TS rating');
			$this->objPHPExcel->getActiveSheet()->setCellValue('A'.($row+12),'FASS rating');
			$this->objPHPExcel->getActiveSheet()->setCellValue('A'.($row+13),'RSTL rating');
			$this->objPHPExcel->getActiveSheet()->setCellValue('A'.($row+14),'PSTC ZS rating');
			$this->objPHPExcel->getActiveSheet()->setCellValue('A'.($row+15),'PSTC ZDS rating');
			$this->objPHPExcel->getActiveSheet()->setCellValue('A'.($row+16),'PSTC ZDN rating');
			$this->objPHPExcel->getActiveSheet()->setCellValue('A'.($row+17),'OVERALL PSTC rating');
			$this->objPHPExcel->getActiveSheet()->setCellValue('A'.($row+18),'OVERALL PERMANENT rating');
			$this->objPHPExcel->getActiveSheet()->setCellValue('A'.($row+19),'OVERALL PROJECT BASE rating');
			$this->objPHPExcel->getActiveSheet()->setCellValue('A'.($row+20),'OVERALL CONTRACTUAL rating');
			$this->objPHPExcel->getActiveSheet()->setCellValue('A'.($row+21),'OVERALL rating');

			$this->objPHPExcel->getActiveSheet()->setCellValue('C'.($row+9),$this->ord_ids);
			$this->objPHPExcel->getActiveSheet()->setCellValue('C'.($row+10),$this->fos_ids);
			$this->objPHPExcel->getActiveSheet()->setCellValue('C'.($row+11),$this->ts_ids);
			$this->objPHPExcel->getActiveSheet()->setCellValue('C'.($row+12),$this->fass_ids);
			$this->objPHPExcel->getActiveSheet()->setCellValue('C'.($row+13),$this->rstl_ids);
			$this->objPHPExcel->getActiveSheet()->setCellValue('C'.($row+14),$this->pstc_zs_ids);
			$this->objPHPExcel->getActiveSheet()->setCellValue('C'.($row+15),$this->pstc_zds_ids);
			$this->objPHPExcel->getActiveSheet()->setCellValue('C'.($row+16),$this->pstc_zdn_ids);
			$this->objPHPExcel->getActiveSheet()->setCellValue('C'.($row+17),$this->pstc_ids);
			$this->objPHPExcel->getActiveSheet()->setCellValue('C'.($row+18),$this->all_p_ids);
			$this->objPHPExcel->getActiveSheet()->setCellValue('C'.($row+19),$this->all_pb_ids);
			$this->objPHPExcel->getActiveSheet()->setCellValue('C'.($row+20),$this->all_c_ids);
			$this->objPHPExcel->getActiveSheet()->setCellValue('C'.($row+21),$this->all_ids);

			$this->objPHPExcel->getActiveSheet()->getStyle('A'.($row+21).":C".($row+21))->getFill()
				->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('c4d79b');



			
			$this->objPHPExcel->getActiveSheet()->setCellValue('A'.($row+25),'Prepared By:');
			$this->objPHPExcel->getActiveSheet()->setCellValue('C'.($row+25),myhelper::getfullname(Yii::app()->user->id));
			
			$this->objPHPExcel->getActiveSheet()->setCellValue('E'.($row+25),'Noted By:');
			$this->objPHPExcel->getActiveSheet()->setCellValue('F'.($row+25),myhelper::getfullname(Yii::app()->user->id));

			//$this->objPHPExcel->getActiveSheet()->setCellValue('A'.($row+18),'Approved By:');
			//$this->objPHPExcel->getActiveSheet()->setCellValue('E'.($row+18),'Verified Correct:');	
			//$this->objPHPExcel->getActiveSheet()->setCellValue('E'.($row+19),'Original DV Supporting Documents Submitted to COA');
			
			//set cell value for signatories
			//using values from system settings
			// $this->objPHPExcel->getActiveSheet()->setCellValue('A'.($row+12),mb_strtoupper(Yii::app()->params['Manager']['name']));
			// $this->objPHPExcel->getActiveSheet()->setCellValue('A'.($row+13),Yii::app()->params['Manager']['position']);			
			// $this->objPHPExcel->getActiveSheet()->setCellValue('E'.($row+12),mb_strtoupper(Yii::app()->params['ArdTs']['name']));
			// $this->objPHPExcel->getActiveSheet()->setCellValue('E'.($row+13),Yii::app()->params['ArdTs']['position']);
			//$this->objPHPExcel->getActiveSheet()->setCellValue('A'.($row+22),mb_strtoupper(Yii::app()->params['Director']['name']));
			//$this->objPHPExcel->getActiveSheet()->setCellValue('A'.($row+23),Yii::app()->params['Director']['position']);			
			//$this->objPHPExcel->getActiveSheet()->setCellValue('E'.($row+22),mb_strtoupper(Yii::app()->params['Auditor']['name']));
			//$this->objPHPExcel->getActiveSheet()->setCellValue('E'.($row+23),Yii::app()->params['Auditor']['position']);
			
			//set bold for names
			$this->objPHPExcel->getActiveSheet()->getStyle('A'.($row+12).':'.'H'.($row+12))->getFont()->setBold(true);
			//$this->objPHPExcel->getActiveSheet()->getStyle('A'.($row+22).':'.'G'.($row+22))->getFont()->setBold(true);
				
		}		

		public function run()
		{
			if($this->grid_mode == 'export')
			{
				$this->renderHeader();
				$row = $this->renderBody();
				$this->renderFooter($row);

				$countRow=0;//initialize number of rows inserted
				$prevRow=0;//initialize previous row number before change occurred
				$countCols=count($this->columns);
				$numRowChanges=count($this->rowChanges);
				$totalRows=$row+7; //+7 since we started at row no. 7

				


				foreach($this->rowChanges as $change)
				{
					$rowNum=$change['rowNum'];
					$rowValue=$change['value'];
					$currentRow=$rowNum+$countRow+7; //+7 since we started at row no. 7
					$this->objPHPExcel->getActiveSheet()->insertNewRowBefore($currentRow, 1);
					
					//insert roman numeral values before the heading row values
					$num=$countRow+1;
					//refer to component folder Controller Class
					//$romanNumeral=Yii::app()->Controller->romanNumerals($num);
					//insert values
					//$this->objPHPExcel->getActiveSheet()->setCellValue("A".$currentRow, $romanNumeral.". ".mb_strtoupper($rowValue));
					$this->objPHPExcel->getActiveSheet()->setCellValue("A".$currentRow, $rowValue);
					//merge columns for rowChange
					$this->objPHPExcel->getActiveSheet()->mergeCells("A".$currentRow.":H".$currentRow);
					//apply fill for merged
					$this->objPHPExcel->getActiveSheet()->getStyle("A".$currentRow)->getFill()
					->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('b8cce4');
								
					//set style: alignment 
					$this->objPHPExcel->getActiveSheet()->getStyle("A".$currentRow.":F".$currentRow)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);	
					$this->objPHPExcel->getActiveSheet()->getStyle("A".$currentRow.":F".$currentRow)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
					$this->objPHPExcel->getActiveSheet()->getStyle("A".$currentRow.":F".$currentRow)->getFont()->setBold(true);
					$this->objPHPExcel->getActiveSheet()->getStyle("A".$currentRow.":F".$currentRow)->getFont()->setSize(14);					//$this->objPHPExcel->getActiveSheet()->setCellValue("B5", '=SUM(B6:B10)');
					
					//apply styles
					//$this->objPHPExcel->getActiveSheet()->getStyle("A".$currentRow.':'.$this->columnName($countCols).$currentRow)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_GENERAL);	
					//$this->objPHPExcel->getActiveSheet()->getStyle("A".$currentRow.':'.$this->columnName($countCols).$currentRow)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
					//$this->objPHPExcel->getActiveSheet()->getStyle("A".$currentRow.':'.$this->columnName($countCols).$currentRow)->getAlignment()->setWrapText(true);
					//$this->objPHPExcel->getActiveSheet()->getStyle("A".$currentRow.':'.$this->columnName($countCols).$currentRow)->applyFromArray($this->borderArrayOutline());
					//$this->objPHPExcel->getActiveSheet()->getStyle("A".$currentRow.':'.$this->columnName($countCols).$currentRow)->getFont()->setBold(true);
					//$this->objPHPExcel->getActiveSheet()->getStyle("A".$currentRow.':'.$this->columnName($countCols).$currentRow)->getFont()->setSize(11);
					//use this format to enclosed in parenthesis negative values
					//$this->objPHPExcel->getActiveSheet()->getStyle("A".$currentRow.':'.$this->columnName($countCols).$currentRow)->getNumberFormat()->setFormatCode("#,##0.00;(#,##0.00)");
					//$this->objPHPExcel->getActiveSheet()->getStyle("A".$currentRow.':'.$this->columnName($countCols).$currentRow)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
					$this->objPHPExcel->getActiveSheet()->getRowDimension($currentRow)->setRowHeight(16);									
					$countRow++;// increment number of rows already inserted
					//$rowChanged.=$rowNum;
					//difference of row change;
					$diffRowChange=$currentRow-$prevRow;
					$first=$prevRow+1;
					$last=$prevRow+$diffRowChange-1;

					//$this->objPHPExcel->getActiveSheet()->setCellValue("B".$prevRow, "=SUM(B".$first.":B".$last.")");
					//$this->objPHPExcel->getActiveSheet()->setCellValue("C".$prevRow, "=SUM(C".$first.":C".$last.")");
					//$this->objPHPExcel->getActiveSheet()->setCellValue("D".$prevRow, "=SUM(D".$first.":D".$last.")");
					//$this->objPHPExcel->getActiveSheet()->setCellValue("E".$prevRow, "=SUM(E".$first.":E".$last.")");

					//use this format to enclosed in parenthesis negative values
					//$this->objPHPExcel->getActiveSheet()->getStyle("B".$prevRow)->getNumberFormat()->setFormatCode("#,##0.00;(#,##0.00)");
					//$this->objPHPExcel->getActiveSheet()->getStyle("C".$prevRow)->getNumberFormat()->setFormatCode("#,##0.00;(#,##0.00)");
					//$this->objPHPExcel->getActiveSheet()->getStyle("D".$prevRow)->getNumberFormat()->setFormatCode("#,##0.00;(#,##0.00)");
					//$this->objPHPExcel->getActiveSheet()->getStyle("E".$prevRow)->getNumberFormat()->setFormatCode("#,##0.00;(#,##0.00)");
					$prevRow=$currentRow;
					
					//at the end of the loop, if $num==$numRowChanges
					if($num==$numRowChanges){
						$first=$currentRow+1;
						$last=$totalRows+$countRow-1;
						/*$this->objPHPExcel->getActiveSheet()->setCellValue("B".$currentRow, "=SUM(B".$first.":B".$last.")");
						$this->objPHPExcel->getActiveSheet()->setCellValue("C".$currentRow, "=SUM(C".$first.":C".$last.")");
						$this->objPHPExcel->getActiveSheet()->setCellValue("D".$currentRow, "=SUM(D".$first.":D".$last.")");
						$this->objPHPExcel->getActiveSheet()->setCellValue("E".$currentRow, "=SUM(E".$first.":E".$last.")");
						//use this format to enclosed in parenthesis negative values
						$this->objPHPExcel->getActiveSheet()->getStyle("B".$currentRow)->getNumberFormat()->setFormatCode("#,##0.00;(#,##0.00)");
						$this->objPHPExcel->getActiveSheet()->getStyle("C".$currentRow)->getNumberFormat()->setFormatCode("#,##0.00;(#,##0.00)");
						$this->objPHPExcel->getActiveSheet()->getStyle("D".$currentRow)->getNumberFormat()->setFormatCode("#,##0.00;(#,##0.00)");
						$this->objPHPExcel->getActiveSheet()->getStyle("E".$currentRow)->getNumberFormat()->setFormatCode("#,##0.00;(#,##0.00)");*/
					}
				}
				//set row height of header
				$this->objPHPExcel->getActiveSheet()->getRowDimension(6)->setRowHeight(25);
				
				//# column::set width
				$this->objPHPExcel->getActiveSheet()->getColumnDimension("A")->setWidth(6);
				//Fullname column::set width
				$this->objPHPExcel->getActiveSheet()->getColumnDimension("B")->setWidth(10);
				//Remarks column::set width
				$this->objPHPExcel->getActiveSheet()->getColumnDimension("C")->setWidth(10);
				$this->objPHPExcel->getActiveSheet()->getColumnDimension("D")->setWidth(10);
				$this->objPHPExcel->getActiveSheet()->getColumnDimension("E")->setWidth(10);
				$this->objPHPExcel->getActiveSheet()->getColumnDimension("F")->setWidth(10);
				$this->objPHPExcel->getActiveSheet()->getColumnDimension("G")->setWidth(10);
				$this->objPHPExcel->getActiveSheet()->getColumnDimension("H")->setWidth(10);
				
				//$objPHPExcel->getActiveSheet()->getStyle('A6:G6')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
				//$objPHPExcel->getActiveSheet()->getStyle('A6:G6')->getFill()->getStartColor()->setARGB('FFFF0000');
				
				$this->objPHPExcel->getActiveSheet()->getStyle('A6:H6')->getFill()
				->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('c4d79b');


				$this->objPHPExcel->getActiveSheet()->getPageSetup()->setRowsToRepeatAtTopByStartAndEnd(6, 6);
				
				$this->objPHPExcel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
				$this->objPHPExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);
				$this->objPHPExcel->getActiveSheet()->getPageSetup()->setHorizontalCentered(true);
				$this->objPHPExcel->getActiveSheet()->getPageMargins()->setLeft(0.3);
				$this->objPHPExcel->getActiveSheet()->getPageMargins()->setRight(0.3);
				
				$this->objPHPExcel->getActiveSheet()->getHeaderFooter()->setOddFooter('&L&8ScholarshipMIS/&D '. '&R&8'.$this->objPHPExcel->getProperties()->getTitle().' Page &P of &N');
				$this->objPHPExcel->getActiveSheet()->getHeaderFooter()->setEvenFooter('&L&8&D ' . $this->objPHPExcel->getProperties()->getTitle() . '&R&8Page &P of &N');
				
				//set auto width
				if($this->autoWidth)
					foreach($this->columns as $n=>$column)
						$this->objPHPExcel->getActiveSheet()->getColumnDimension($this->columnName($n+1))->setAutoSize(true);
				//create writer for saving
				$objWriter = PHPExcel_IOFactory::createWriter($this->objPHPExcel, $this->exportType);
				if(!$this->stream)
					$objWriter->save($this->filename);
				else //output to browser
				{
					if(!$this->filename)
						$this->filename = $this->title;
					$this->cleanOutput();
					header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
					header('Pragma: public');
					header('Content-type: '.$this->mimeTypes[$this->exportType]['Content-type']);
					header('Content-Disposition: attachment; filename="'.$this->filename.'.'.$this->mimeTypes[$this->exportType]['extension'].'"');
					header('Cache-Control: max-age=0');	
					ob_end_clean();			
					$objWriter->save('php://output');			
					Yii::app()->end();
				}
			} else
				parent::run();
		}
		
		public function borderArrayOutline()
		{
			//Set borders around a rectangular selection of a certain range
			$styleArrayOutline = array(
				'borders' => array(
					'outline' => array(
					'style' => PHPExcel_Style_Border::BORDER_THIN,
					'color' => array('argb' => 'D9D9D9'),
					),							
				),
			);
			return $styleArrayOutline;
		}

		public function borderArrayLeftRight()
		{
			//Set borders around a rectangular selection of a certain range::LEFT&RIGHT
			$styleArrayLeftRight = array(
				'borders' => array(
					'left' => array(
						'style' => PHPExcel_Style_Border::BORDER_THIN,
						'color' => array('argb' => 'D9D9D9'),
					),
					'right' => array(
						'style' => PHPExcel_Style_Border::BORDER_THIN,
						'color' => array('argb' => 'D9D9D9'),
					),																	
				),
			);
			return $styleArrayLeftRight;
		}		
		
		public function borderArray()
		{
			//Set borders around each cell if given a range
			$styleArray = array(
				'borders' => array(
					'allborders' => array(
						'style' => PHPExcel_Style_Border::BORDER_THIN,
						'color' => array('argb' => 'D9D9D9'),
						),							
				),
			);
			return $styleArray;
		}
		/**
		* Returns the coresponding excel column.(Abdul Rehman from yii forum)
		* 
		* @param int $index
		* @return string
		*/
		public function columnName($index)
		{
			--$index;
			if($index >= 0 && $index < 26)
				return chr(ord('A') + $index);
			else if ($index > 25)
				return ($this->columnName($index / 26)).($this->columnName($index%26 + 1));
				else
					throw new Exception("Invalid Column # ".($index + 1));
		}		
		
		public function renderExportButtons()
		{
			foreach($this->exportButtons as $key=>$button)
			{
				$item = is_array($button) ? CMap::mergeArray($this->mimeTypes[$key], $button) : $this->mimeTypes[$button];
				$type = is_array($button) ? $key : $button;
				$url = parse_url(Yii::app()->request->requestUri);
				//$content[] = CHtml::link($item['caption'], '?'.$url['query'].'exportType='.$type.'&'.$this->grid_mode_var.'=export');
				if (key_exists('query', $url))
				    $content[] = CHtml::link($item['caption'], '?'.$url['query'].'&exportType='.$type.'&'.$this->grid_mode_var.'=export');          
				else
				    $content[] = CHtml::link($item['caption'], '?exportType='.$type.'&'.$this->grid_mode_var.'=export');				
			}
			if($content)
				echo CHtml::tag('div', array('class'=>$this->exportButtonsCSS), $this->exportText.implode(', ',$content));	

		}			
		
		/**
		* Performs cleaning on mutliple levels.
		* 
		* From le_top @ yiiframework.com
		* 
		*/
		private static function cleanOutput() 
		{
            for($level=ob_get_level();$level>0;--$level)
            {
                @ob_end_clean();
            }
        }
			
		public function rowChangeOccured($prevRow, $colName, $currentValue)
		{
			$data = $this->dataProvider->getData();
			//if($prevRow<0)
			//	$prevValue = "";
			//else
			$prevValue = CHtml::encode(CHtml::value($data[$prevRow], $colName));
		
			if($currentValue!=$prevValue){
					return array('rowNum'=>$prevRow+1, 'value'=>$currentValue); //row number where change occured and value
			}
		}

	}