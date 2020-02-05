<?php
	Yii::import('zii.widgets.grid.CGridView');

	/**
	* @author Nikola Kostadinov
	* @license MIT License
	* @version 0.3
	*/	
	class EExcelViewDtr extends CGridView
	{
		//Document properties
		public $creator = 'Nikola Kostadinov';
		public $title = null;
		public $subject = 'Subject';
		public $description = '';
		public $category = '';

		//the PHPExcel object
		public $objPHPExcel = null;
		public $libPath = 'ext.PHPExcel.Classes.PHPExcel'; //the path to the PHP excel lib

		//config
		public $autoWidth = true;
		public $exportType = 'Excel5';
		public $disablePaging = true;
		public $filename = null; //export FileName
		public $stream = true; //stream to browser
		public $grid_mode = 'grid'; //Whether to display grid ot export it to selected format. Possible values(grid, export)
		public $grid_mode_var = 'grid_mode'; //GET var for the grid mode

		//user defined
		public $dtr_array;
		public $name;
		public $monthyear;
		public $empposition;
		
		//buttons config
		public $exportButtonsCSS = 'summary';
		public $exportButtons = array('Excel2008');
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
			'Excel2008'	=> array(
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
				//$this->objPHPExcel = new PHPExcel();
				if($this->empposition==="regular"){
					$this->objPHPExcel = PHPExcel_IOFactory::load("./protected/modules/dtr/dtrform_reg.xlsx");
				}
				else{
					$this->objPHPExcel = PHPExcel_IOFactory::load("./protected/modules/dtr/dtrform.xlsx");
				}
				
				$this->objPHPExcel->setActiveSheetIndex(1 );
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

				$cell = $this->objPHPExcel->getActiveSheet()->setCellValue($this->columnName($a)."1" ,$head, true);
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
				for($row=0;$row<$n;++$row)
					$this->renderRow($row);
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
					$value=$this->evaluateExpression($column->value ,array('data'=>$data[$row]));
				elseif($column->name!==null) { 
					//$value=$data[$row][$column->name];
					$value= CHtml::value($data[$row], $column->name);
				    $value=$value===null ? "" : $column->grid->getFormatter()->format($value,'raw');
                }             

				$a++;
				$cell = $this->objPHPExcel->getActiveSheet()->setCellValue($this->columnName($a).($row+2) , strip_tags($value), true);				
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
                if($column->footer)
                {
					$footer =trim($column->footer)!=='' ? $column->footer : $column->grid->blankDisplay;

				    $cell = $this->objPHPExcel->getActiveSheet()->setCellValue($this->columnName($a).($row+2) ,$footer, true);
				    if(is_callable($this->onRenderFooterCell))
					    call_user_func_array($this->onRenderFooterCell, array($cell, $footer));				
                }
			}  
		}

		public function run()
		{
			if($this->grid_mode == 'export')
			{
				$this->renderHeader();
				$row = $this->renderBody();
				$this->renderFooter($row);

				//set auto width
				if($this->autoWidth)
					foreach($this->columns as $n=>$column)
						$this->objPHPExcel->getActiveSheet()->getColumnDimension($this->columnName($n+1))->setAutoSize(true);
				
				$this->objPHPExcel->setActiveSheetIndex(0);
				$this->objPHPExcel->getActiveSheet()->setCellValue('A3',$this->name);
				$this->objPHPExcel->getActiveSheet()->setCellValue('D4',$this->monthyear);
				if($this->empposition!="regular"){
					$this->objPHPExcel->getActiveSheet()->setCellValue('I3',$this->name);
					$this->objPHPExcel->getActiveSheet()->setCellValue('L4',$this->monthyear);
				}
				
				
				
				//custom code for dtr data targeting
				if($this->dtr_array){
					foreach($this->dtr_array as $dtrday){
						$theday = date("d",strtotime($dtrday->date));
						$holiday = ReferHolidays::model()->findByAttributes(array('holiday_date'=>$dtrday->date));
						if(($theday<=15)||($this->empposition==="regular")){
									if(($dtrday->inAM)||($dtrday->inAM=="0"))
										$this->objPHPExcel->getActiveSheet()->setCellValue('B'.($theday+8),$dtrday->inAM=="0"?"OB":$dtrday->inAM);
									elseif($holiday)
										$this->objPHPExcel->getActiveSheet()->setCellValue('B'.($theday+8),"Holiday");

									if(($dtrday->outAM)||($dtrday->outAM=="0"))
										$this->objPHPExcel->getActiveSheet()->setCellValue('C'.($theday+8),$dtrday->outAM=="0"?"OB":$dtrday->outAM);
									elseif($holiday)
										$this->objPHPExcel->getActiveSheet()->setCellValue('C'.($theday+8),"Holiday");

									if(($dtrday->inPM)||($dtrday->inPM=="0"))
										$this->objPHPExcel->getActiveSheet()->setCellValue('D'.($theday+8),$dtrday->inPM=="0"?"OB":$dtrday->inPM);
									elseif($holiday)
										$this->objPHPExcel->getActiveSheet()->setCellValue('D'.($theday+8),"Holiday");

									if(($dtrday->outPM)||($dtrday->outPM=="0"))
										$this->objPHPExcel->getActiveSheet()->setCellValue('E'.($theday+8),$dtrday->outPM=="0"?"OB":$dtrday->outPM);
									elseif($holiday)
										$this->objPHPExcel->getActiveSheet()->setCellValue('E'.($theday+8),"Holiday");

									//if(($dtrday->inOT)||($dtrday->inOT=="0"))
										$this->objPHPExcel->getActiveSheet()->setCellValue('F'.($theday+8),$dtrday->inOT=="0"?"OB":$dtrday->inOT);
									// else
									// 	$this->objPHPExcel->getActiveSheet()->setCellValue('F'.($theday+3),"Holiday");

									//if(($dtrday->inOT)||($dtrday->inOT=="0"))
										$this->objPHPExcel->getActiveSheet()->setCellValue('G'.($theday+8),$dtrday->outOT=="0"?"OB":$dtrday->outOT);
									// else
									// 	$this->objPHPExcel->getActiveSheet()->setCellValue('G'.($theday+3),"Holiday");
						}
						else{

									if(($dtrday->inAM)||($dtrday->inAM=="0"))
										$this->objPHPExcel->getActiveSheet()->setCellValue('J'.($theday+8),$dtrday->inAM=="0"?"OB":$dtrday->inAM);
									elseif($holiday)
										$this->objPHPExcel->getActiveSheet()->setCellValue('J'.($theday+8),"Holiday");

									if(($dtrday->outAM)||($dtrday->outAM=="0"))
										$this->objPHPExcel->getActiveSheet()->setCellValue('K'.($theday+8),$dtrday->outAM=="0"?"OB":$dtrday->outAM);
									elseif($holiday)
										$this->objPHPExcel->getActiveSheet()->setCellValue('K'.($theday+8),"Holiday");

									if(($dtrday->inPM)||($dtrday->inPM=="0"))
										$this->objPHPExcel->getActiveSheet()->setCellValue('L'.($theday+8),$dtrday->inPM=="0"?"OB":$dtrday->inPM);
									elseif($holiday)
										$this->objPHPExcel->getActiveSheet()->setCellValue('L'.($theday+8),"Holiday");

									if(($dtrday->outPM)||($dtrday->outPM=="0"))
										$this->objPHPExcel->getActiveSheet()->setCellValue('M'.($theday+8),$dtrday->outPM=="0"?"OB":$dtrday->outPM);
									elseif($holiday)
										$this->objPHPExcel->getActiveSheet()->setCellValue('M'.($theday+8),"Holiday");

									//if(($dtrday->inOT)||($dtrday->inOT=="0"))
										$this->objPHPExcel->getActiveSheet()->setCellValue('N'.($theday+8),$dtrday->inOT=="0"?"OB":$dtrday->inOT);
									// else
									// 	$this->objPHPExcel->getActiveSheet()->setCellValue('F'.($theday+3),"Holiday");

									//if(($dtrday->inOT)||($dtrday->inOT=="0"))
										$this->objPHPExcel->getActiveSheet()->setCellValue('N'.($theday+8),$dtrday->outOT=="0"?"OB":$dtrday->outOT);
									// else
									// 	$this->objPHPExcel->getActiveSheet()->setCellValue('G'.($theday+3),"Holiday");



						}
					}
				}
				$this->objPHPExcel->getActiveSheet()->getProtection()->setSheet(true);
				$this->objPHPExcel->getActiveSheet()->getProtection()->setSort(true);
				$this->objPHPExcel->getActiveSheet()->getProtection()->setInsertRows(true);
				$this->objPHPExcel->getActiveSheet()->getProtection()->setFormatCells(true);

				$this->objPHPExcel->getActiveSheet()->getProtection()->setPassword('Einhander');

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
					$objWriter->save('php://output');			
					Yii::app()->end();
				}
			} else
				parent::run();
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


	}