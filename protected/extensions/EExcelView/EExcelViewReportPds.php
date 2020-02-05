<?php
	Yii::import('zii.widgets.grid.CGridView');

	/**
	* @author Nikola Kostadinov
	* @license MIT License
	* @version 0.3
	*/	
	class EExcelViewReportPds extends CGridView
	{

		//put models here to pass tp this class
		public $user_id;
		public $Profile;
		public $Children;
		public $UsersP;
		public $Edus;
		public $Exams;
		public $Works;
		public $Trains;
		public $Voluns;
		public $Skills;
		public $recognition;
		public $association;
		public $Refs;
		public $Legal;
		public $Pledge;
		public $personID;
		public $position_type;
		public $positiondata;
		public $salarydata;





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
				//modified here
				//$this->objPHPExcel = new PHPExcel();
				$this->objPHPExcel = PHPExcel_IOFactory::load("./protected/data/PDS.xlsx");
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


			// $a=0;
			// foreach($this->columns as $column)
			// {
			// 	$a=$a+1;
			// 	if($column instanceof CButtonColumn)
			// 		$head = $column->header;
			// 	elseif($column->header===null && $column->name!==null)
			// 	{
			// 		if($column->grid->dataProvider instanceof CActiveDataProvider)
			// 			$head = $column->grid->dataProvider->model->getAttributeLabel($column->name);
			// 		else
			// 			$head = $column->name;
			// 	} else
			// 		$head =trim($column->header)!=='' ? $column->header : $column->grid->blankDisplay;

			// 	$cell = $this->objPHPExcel->getActiveSheet()->setCellValue($this->columnName($a)."1" ,$head, true);
			// 	if(is_callable($this->onRenderHeaderCell))
			// 		call_user_func_array($this->onRenderHeaderCell, array($cell, $head));				
			// }			
		}

		public function renderBody()
		{
			//if($this->disablePaging) //if needed disable paging to export all data
				//$this->dataProvider->pagination = false;
			// $data=$this->dataProvider->getData();
			// $n=count($data);

			// if($n>0)
			// {
				// for($row=0;$row<$n;++$row)
				 	$this->renderRow(0);
			//}

			//$this->objPHPExcel->getCell('A1')->setValue('John');
            return 0;
		}

		public function renderRow($row)
		{
			//main profile

			$this->objPHPExcel->setActiveSheetIndex(0);
			//usersP holds the profile_toher data
			$lnlenght = strlen(strtoupper($this->Profile->lastname));
			$i=0;
			$newstr=null;
			while($i<=$lnlenght){
				$newstr .= "  |  ";
				$newstr .= substr($this->Profile->lastname, $i, 1);
				$i++;
			}
			//$newstr.= "    |      |      |      |      |      |      |      |      |      |      |      |      |      |      |      |      |      |      |      |      |      |      |      |      |";
			//lastname
			$this->objPHPExcel->getActiveSheet()->setCellValue('C7',strtoupper($newstr ));
			$this->objPHPExcel->getActiveSheet()->getStyle('C7')->getAlignment()->setWrapText(true);

			$lnlenght = strlen(strtoupper($this->Profile->firstname));
			$i=0;
			$newstr=null;
			while($i<=$lnlenght){
				$newstr .= "  |  ";
				$newstr .= substr($this->Profile->firstname, $i, 1);
				$i++;
			}
			//$newstr.= "    |      |      |      |      |      |      |      |      |      |      |      |      |      |      |      |      |      |      |      |      |      |      |      |      |";

			//firstname
			$this->objPHPExcel->getActiveSheet()->setCellValue('C8',strtoupper($newstr));
			$this->objPHPExcel->getActiveSheet()->getStyle('C8')->getAlignment()->setWrapText(true);

			$lnlenght = strlen(strtoupper($this->Profile->middlename));
			$i=0;
			$newstr=null;
			while($i<=$lnlenght){
				$newstr .= "  |  ";
				$newstr .= substr($this->Profile->middlename, $i, 1);
				$i++;
			}
			//$newstr.= "   |      |      |      |      |      |      |      |      |      |      |      |      |      |      |      |      |      |      |      |      |";

			//middlename
			$this->objPHPExcel->getActiveSheet()->setCellValue('C9',strtoupper($newstr));
			$this->objPHPExcel->getActiveSheet()->getStyle('C9')->getAlignment()->setWrapText(true);

			//name extension
			$this->objPHPExcel->getActiveSheet()->setCellValue('N9',strtoupper($this->Profile->nameextension));
			//sex
			if($this->Profile->sex==="Male"){
				
				$temp = $this->objPHPExcel->getActiveSheet()->getCell('C12')->getValue();
				$this->objPHPExcel->getActiveSheet()->setCellValue('C12','✓   '.$temp);
				$this->objPHPExcel->getActiveSheet()->getStyle("C12")->getFont()->setBold(true);}
			elseif($this->Profile->sex==="Female"){
				$temp = $this->objPHPExcel->getActiveSheet()->getCell('E12')->getValue();
				$this->objPHPExcel->getActiveSheet()->setCellValue('E12','✓   '.$temp);
				$this->objPHPExcel->getActiveSheet()->getStyle("E12")->getFont()->setBold(true);
			}

			//left part
			
			$this->objPHPExcel->getActiveSheet()->setCellValue('C11',$this->UsersP->birthPlace);

			//$this->objPHPExcel->getActiveSheet()->setCellValue('C13',$this->UsersP->civilStatus);

			switch($this->UsersP->civilStatus){
				case "single" : 
					$temp = $this->objPHPExcel->getActiveSheet()->getCell('D13')->getValue();
					$this->objPHPExcel->getActiveSheet()->setCellValue('D13','✓   '.$temp);
					$this->objPHPExcel->getActiveSheet()->getStyle("D13")->getFont()->setBold(true);
				break;
				case "widowed" : 
					$temp = $this->objPHPExcel->getActiveSheet()->getCell('E13')->getValue();
					$this->objPHPExcel->getActiveSheet()->setCellValue('E13','✓   '.$temp);
					$this->objPHPExcel->getActiveSheet()->getStyle("E13")->getFont()->setBold(true);
				break;
				case "married" : 
					$temp = $this->objPHPExcel->getActiveSheet()->getCell('D14')->getValue();
					$this->objPHPExcel->getActiveSheet()->setCellValue('D14','✓   '.$temp);
					$this->objPHPExcel->getActiveSheet()->getStyle("D14")->getFont()->setBold(true);
				break;
				case "separated" : 
					$temp = $this->objPHPExcel->getActiveSheet()->getCell('E14')->getValue();
					$this->objPHPExcel->getActiveSheet()->setCellValue('E14','✓   '.$temp);
					$this->objPHPExcel->getActiveSheet()->getStyle("E14")->getFont()->setBold(true);
				break;
				case "complicated" : 
					$temp = $this->objPHPExcel->getActiveSheet()->getCell('D15')->getValue();
					$this->objPHPExcel->getActiveSheet()->setCellValue('D15','✓   '.$temp);
					$this->objPHPExcel->getActiveSheet()->getStyle("D15")->getFont()->setBold(true);
				break;
			}

			$this->objPHPExcel->getActiveSheet()->setCellValue('C16',$this->UsersP->citizenship);
			$this->objPHPExcel->getActiveSheet()->setCellValue('C17',$this->UsersP->height);
			$this->objPHPExcel->getActiveSheet()->setCellValue('C18',$this->UsersP->weight);
			$this->objPHPExcel->getActiveSheet()->setCellValue('C19',$this->UsersP->bloodType);
			$this->objPHPExcel->getActiveSheet()->setCellValue('C20',$this->UsersP->gsisNumber);
			$this->objPHPExcel->getActiveSheet()->setCellValue('C22',$this->UsersP->philHealthNumber);
			$this->objPHPExcel->getActiveSheet()->setCellValue('C23',$this->UsersP->sssNumber);
			$this->objPHPExcel->getActiveSheet()->setCellValue('C21',$this->UsersP->pagibigNumber);

			//right part
			$this->objPHPExcel->getActiveSheet()->setCellValue('I10',$this->UsersP->residentialAddress);
			$this->objPHPExcel->getActiveSheet()->setCellValue('I13',$this->UsersP->zipCode1);
			$this->objPHPExcel->getActiveSheet()->setCellValue('I14',$this->UsersP->telephone1);
			$this->objPHPExcel->getActiveSheet()->setCellValue('I15',$this->UsersP->permanentAddress);
			$this->objPHPExcel->getActiveSheet()->setCellValue('I18',$this->UsersP->zipCode2);
			$this->objPHPExcel->getActiveSheet()->setCellValue('I19',$this->UsersP->telephone2);
			$this->objPHPExcel->getActiveSheet()->setCellValue('I20',$user = Yii::app()->getModule('user')->user($this->user_id)->email);
			//$userinfo =$user = Yii::app()->getModule('user')->user($personID);
			$this->objPHPExcel->getActiveSheet()->setCellValue('I21',$this->UsersP->mobile);
			$this->objPHPExcel->getActiveSheet()->setCellValue('I22',$this->Profile->employee_id);
			$this->objPHPExcel->getActiveSheet()->setCellValue('I23',$this->UsersP->tin);

			//family background
			$this->objPHPExcel->getActiveSheet()->setCellValue('C25',$this->UsersP->spouse_lname);
			$this->objPHPExcel->getActiveSheet()->setCellValue('C26',$this->UsersP->spouse_fname);
			$this->objPHPExcel->getActiveSheet()->setCellValue('C27',$this->UsersP->spouse_mname);
			$this->objPHPExcel->getActiveSheet()->setCellValue('C28',$this->UsersP->spouseWork);
			$this->objPHPExcel->getActiveSheet()->setCellValue('C29',$this->UsersP->spouseBusName);
			$this->objPHPExcel->getActiveSheet()->setCellValue('C30',$this->UsersP->spouseBusAddress);
			$this->objPHPExcel->getActiveSheet()->setCellValue('C31',$this->UsersP->spouseTelephone);


			//father
			$this->objPHPExcel->getActiveSheet()->setCellValue('D33',$this->UsersP->father_lname);
			$this->objPHPExcel->getActiveSheet()->setCellValue('D34',$this->UsersP->father_fname);
			$this->objPHPExcel->getActiveSheet()->setCellValue('D35',$this->UsersP->father_mname);

			//mother
			$this->objPHPExcel->getActiveSheet()->setCellValue('D37',$this->UsersP->mother_lname);
			$this->objPHPExcel->getActiveSheet()->setCellValue('D38',$this->UsersP->mother_fname);
			$this->objPHPExcel->getActiveSheet()->setCellValue('D39',$this->UsersP->mother_mname);

			$tempchildren = $this->Children;
			$startrow =26;
			foreach ($tempchildren as $child) {
				$this->objPHPExcel->getActiveSheet()->setCellValue('H'.$startrow,$child->childName);
				$this->objPHPExcel->getActiveSheet()->setCellValue('M'.$startrow,$child->childBirthDate);
				$startrow++;
			}

			$tempedus = $this->Edus;
			$startrow =44;
			foreach ($tempedus as $edu) {
				$this->objPHPExcel->getActiveSheet()->setCellValue('A'.$startrow,$edu->level);
				$this->objPHPExcel->getActiveSheet()->setCellValue('C'.$startrow,$edu->schoolName);
				$this->objPHPExcel->getActiveSheet()->setCellValue('F'.$startrow,$edu->course->degreeCode);
				$this->objPHPExcel->getActiveSheet()->setCellValue('H'.$startrow,$edu->dateTo);
				$this->objPHPExcel->getActiveSheet()->setCellValue('I'.$startrow,$edu->unitsEarned);
				$this->objPHPExcel->getActiveSheet()->setCellValue('L'.$startrow,$edu->dateFrom);
				$this->objPHPExcel->getActiveSheet()->setCellValue('M'.$startrow,$edu->dateTo);
				$this->objPHPExcel->getActiveSheet()->setCellValue('N'.$startrow,$edu->honorsRecieve);
				$startrow++;
			}

			$this->objPHPExcel->setActiveSheetIndex(1);
			$tempexam = $this->Exams;
			$startrow =5;
			foreach ($tempexam as $exam) {
				$this->objPHPExcel->getActiveSheet()->setCellValue('A'.$startrow,$exam->examTitle);
				$this->objPHPExcel->getActiveSheet()->setCellValue('F'.$startrow,$exam->examRating);
				$this->objPHPExcel->getActiveSheet()->setCellValue('G'.$startrow,$exam->examDate);
				$this->objPHPExcel->getActiveSheet()->setCellValue('I'.$startrow,$exam->examPlace);
				$this->objPHPExcel->getActiveSheet()->setCellValue('L'.$startrow,$exam->licenseNumber);
				$this->objPHPExcel->getActiveSheet()->setCellValue('M'.$startrow,$exam->dateRelease);
				$startrow++;
			}

			$tempwork = $this->Works;
			$startrow =13;
			foreach ($tempwork as $work) {
				$this->objPHPExcel->getActiveSheet()->setCellValue('A'.$startrow,$work->dateFrom);
				$this->objPHPExcel->getActiveSheet()->setCellValue('C'.$startrow,$work->dateTo);
				$this->objPHPExcel->getActiveSheet()->setCellValue('D'.$startrow,$work->positionTitle);
				$this->objPHPExcel->getActiveSheet()->setCellValue('G'.$startrow,$work->agency);
				$this->objPHPExcel->getActiveSheet()->setCellValue('J'.$startrow,$work->monthlySalary);
				$this->objPHPExcel->getActiveSheet()->setCellValue('K'.$startrow,$work->sgstep);
				$this->objPHPExcel->getActiveSheet()->setCellValue('L'.$startrow,$work->isgov);
				//$this->objPHPExcel->getActiveSheet()->setCellValue('M'.$startrow,$work->dateRelease);
				$startrow++;
			}
			
			$this->objPHPExcel->setActiveSheetIndex(2);
			$tempVoluns = $this->Voluns;
			$startrow =6;
			foreach ($tempVoluns as $Volun) {
				$this->objPHPExcel->getActiveSheet()->setCellValue('A'.$startrow,$Volun->name.$Volun->address);
				$this->objPHPExcel->getActiveSheet()->setCellValue('E'.$startrow,$Volun->dateFrom);
				$this->objPHPExcel->getActiveSheet()->setCellValue('F'.$startrow,$Volun->dateTo);
				$this->objPHPExcel->getActiveSheet()->setCellValue('G'.$startrow,$Volun->numberHours);
				$this->objPHPExcel->getActiveSheet()->setCellValue('H'.$startrow,$Volun->position);
				//$this->objPHPExcel->getActiveSheet()->setCellValue('M'.$startrow,$work->dateRelease);
				$startrow++;
			}

			

			$tempTrains = $this->Trains;
			$startrow =16;
			foreach ($tempTrains as $Train) {
				$this->objPHPExcel->getActiveSheet()->setCellValue('A'.$startrow,$Train->trainingTitle);
				$this->objPHPExcel->getActiveSheet()->setCellValue('E'.$startrow,$Train->dateFrom);
				$this->objPHPExcel->getActiveSheet()->setCellValue('F'.$startrow,$Train->dateTo);
				$this->objPHPExcel->getActiveSheet()->setCellValue('G'.$startrow,$Train->trainingHours);
				$this->objPHPExcel->getActiveSheet()->setCellValue('H'.$startrow,$Train->trainingby);
				//$this->objPHPExcel->getActiveSheet()->setCellValue('M'.$startrow,$work->dateRelease);
				$startrow++;
			}

			

			$tempSkills = $this->Skills;
			$startrow =31;
			foreach ($tempSkills as $Skl) {
				$this->objPHPExcel->getActiveSheet()->setCellValue('A'.$startrow,$Skl->skills);
				//$this->objPHPExcel->getActiveSheet()->setCellValue('M'.$startrow,$work->dateRelease);
				$startrow++;
			}


			
			$temprecognition= $this->recognition;
			$startrow =31;
			foreach ($temprecognition as $recog) {
				$this->objPHPExcel->getActiveSheet()->setCellValue('C'.$startrow,$recog->recognition);
				//$this->objPHPExcel->getActiveSheet()->setCellValue('M'.$startrow,$work->dateRelease);
				$startrow++;
			}
			

			$tempassociation= $this->association;
			$startrow =31;
			foreach ($tempassociation as $assoc) {
				$this->objPHPExcel->getActiveSheet()->setCellValue('H'.$startrow,$assoc->association);
				//$this->objPHPExcel->getActiveSheet()->setCellValue('M'.$startrow,$work->dateRelease);
				$startrow++;
			}

			$this->objPHPExcel->setActiveSheetIndex(3);

			$tempRefs= $this->Refs;
			$startrow =41;
			foreach ($tempRefs as $Ref) {
				$this->objPHPExcel->getActiveSheet()->setCellValue('B'.$startrow,$Ref->name);
				$this->objPHPExcel->getActiveSheet()->setCellValue('D'.$startrow,$Ref->address);
				$this->objPHPExcel->getActiveSheet()->setCellValue('E'.$startrow,$Ref->telephone);
				$startrow++;
			}

			//legal informations
			if($this->Legal->relatedThirdDegree==="yes"){


				$temp = $this->objPHPExcel->getActiveSheet()->getCell('F4')->getValue();
				$this->objPHPExcel->getActiveSheet()->setCellValue('F4','✓   '.$temp);
				$this->objPHPExcel->getActiveSheet()->getStyle("F4")->getFont()->setBold(true);}
			else{
				$temp = $this->objPHPExcel->getActiveSheet()->getCell('H4')->getValue();
				$this->objPHPExcel->getActiveSheet()->setCellValue('H4','✓   '.$temp);
				$this->objPHPExcel->getActiveSheet()->getStyle("H4")->getFont()->setBold(true);
			}


			if($this->Legal->relatedFourthDegree==="yes"){


				$temp = $this->objPHPExcel->getActiveSheet()->getCell('F8')->getValue();
				$this->objPHPExcel->getActiveSheet()->setCellValue('F8','✓   '.$temp);
				$this->objPHPExcel->getActiveSheet()->getStyle("F8")->getFont()->setBold(true);}
			else{
				$temp = $this->objPHPExcel->getActiveSheet()->getCell('H8')->getValue();
				$this->objPHPExcel->getActiveSheet()->setCellValue('H8','✓   '.$temp);
				$this->objPHPExcel->getActiveSheet()->getStyle("H8")->getFont()->setBold(true);
			}
			$this->objPHPExcel->getActiveSheet()->setCellValue('E10',$this->Legal->relatedParticulars);


			if($this->Legal->charge==="yes"){


				$temp = $this->objPHPExcel->getActiveSheet()->getCell('F12')->getValue();
				$this->objPHPExcel->getActiveSheet()->setCellValue('F12','✓   '.$temp);
				$this->objPHPExcel->getActiveSheet()->getStyle("F12")->getFont()->setBold(true);}
			else{
				$temp = $this->objPHPExcel->getActiveSheet()->getCell('H12')->getValue();
				$this->objPHPExcel->getActiveSheet()->setCellValue('H12','✓   '.$temp);
				$this->objPHPExcel->getActiveSheet()->getStyle("H12")->getFont()->setBold(true);
			}
			$this->objPHPExcel->getActiveSheet()->setCellValue('H13',$this->Legal->chargeParticulars);

			if($this->Legal->guilty==="yes"){


				$temp = $this->objPHPExcel->getActiveSheet()->getCell('F14')->getValue();
				$this->objPHPExcel->getActiveSheet()->setCellValue('F14','✓   '.$temp);
				$this->objPHPExcel->getActiveSheet()->getStyle("F14")->getFont()->setBold(true);}
			else{
				$temp = $this->objPHPExcel->getActiveSheet()->getCell('H14')->getValue();
				$this->objPHPExcel->getActiveSheet()->setCellValue('H14','✓   '.$temp);
				$this->objPHPExcel->getActiveSheet()->getStyle("H14")->getFont()->setBold(true);
			}
			$this->objPHPExcel->getActiveSheet()->setCellValue('E16',$this->Legal->guiltyParticulars);

			if($this->Legal->crime==="yes"){


				$temp = $this->objPHPExcel->getActiveSheet()->getCell('F18')->getValue();
				$this->objPHPExcel->getActiveSheet()->setCellValue('F18','✓   '.$temp);
				$this->objPHPExcel->getActiveSheet()->getStyle("F18")->getFont()->setBold(true);}
			else{
				$temp = $this->objPHPExcel->getActiveSheet()->getCell('H18')->getValue();
				$this->objPHPExcel->getActiveSheet()->setCellValue('H18','✓   '.$temp);
				$this->objPHPExcel->getActiveSheet()->getStyle("H18")->getFont()->setBold(true);
			}
			$this->objPHPExcel->getActiveSheet()->setCellValue('E20',$this->Legal->crimeParticulars);


			if($this->Legal->forceResign==="yes"){


				$temp = $this->objPHPExcel->getActiveSheet()->getCell('F23')->getValue();
				$this->objPHPExcel->getActiveSheet()->setCellValue('F23','✓   '.$temp);
				$this->objPHPExcel->getActiveSheet()->getStyle("F23")->getFont()->setBold(true);}
			else{
				$temp = $this->objPHPExcel->getActiveSheet()->getCell('H23')->getValue();
				$this->objPHPExcel->getActiveSheet()->setCellValue('H23','✓   '.$temp);
				$this->objPHPExcel->getActiveSheet()->getStyle("H23")->getFont()->setBold(true);
			}
			$this->objPHPExcel->getActiveSheet()->setCellValue('E25',$this->Legal->forceResignParticulars);

			if($this->Legal->candidate==="yes"){


				$temp = $this->objPHPExcel->getActiveSheet()->getCell('F26')->getValue();
				$this->objPHPExcel->getActiveSheet()->setCellValue('F26','✓   '.$temp);
				$this->objPHPExcel->getActiveSheet()->getStyle("F26")->getFont()->setBold(true);}
			else{
				$temp = $this->objPHPExcel->getActiveSheet()->getCell('H26')->getValue();
				$this->objPHPExcel->getActiveSheet()->setCellValue('H26','✓   '.$temp);
				$this->objPHPExcel->getActiveSheet()->getStyle("H26")->getFont()->setBold(true);
			}
			$this->objPHPExcel->getActiveSheet()->setCellValue('E28',$this->Legal->candidateParticulars);

			if($this->Legal->indigenous==="yes"){


				$temp = $this->objPHPExcel->getActiveSheet()->getCell('F32')->getValue();
				$this->objPHPExcel->getActiveSheet()->setCellValue('F32','✓   '.$temp);
				$this->objPHPExcel->getActiveSheet()->getStyle("F32")->getFont()->setBold(true);}
			else{
				$temp = $this->objPHPExcel->getActiveSheet()->getCell('H32')->getValue();
				$this->objPHPExcel->getActiveSheet()->setCellValue('H32','✓   '.$temp);
				$this->objPHPExcel->getActiveSheet()->getStyle("H32")->getFont()->setBold(true);
			}
			$this->objPHPExcel->getActiveSheet()->setCellValue('H33',$this->Legal->indigenousParticulars);

			if($this->Legal->indigenous==="yes"){


				$temp = $this->objPHPExcel->getActiveSheet()->getCell('F34')->getValue();
				$this->objPHPExcel->getActiveSheet()->setCellValue('F34','✓   '.$temp);
				$this->objPHPExcel->getActiveSheet()->getStyle("F34")->getFont()->setBold(true);}
			else{
				$temp = $this->objPHPExcel->getActiveSheet()->getCell('H34')->getValue();
				$this->objPHPExcel->getActiveSheet()->setCellValue('H34','✓   '.$temp);
				$this->objPHPExcel->getActiveSheet()->getStyle("H34")->getFont()->setBold(true);
			}
			$this->objPHPExcel->getActiveSheet()->setCellValue('H35',$this->Legal->indigenousParticulars);

			if($this->Legal->indigenous==="yes"){


				$temp = $this->objPHPExcel->getActiveSheet()->getCell('F36')->getValue();
				$this->objPHPExcel->getActiveSheet()->setCellValue('F36','✓   '.$temp);
				$this->objPHPExcel->getActiveSheet()->getStyle("F36")->getFont()->setBold(true);}
			else{
				$temp = $this->objPHPExcel->getActiveSheet()->getCell('H36')->getValue();
				$this->objPHPExcel->getActiveSheet()->setCellValue('H36','✓   '.$temp);
				$this->objPHPExcel->getActiveSheet()->getStyle("H36")->getFont()->setBold(true);
			}
			$this->objPHPExcel->getActiveSheet()->setCellValue('H37',$this->Legal->indigenousParticulars);

		
			//$data=$this->dataProvider->getData();

			
			// $a=0;
			// foreach($this->columns as $n=>$column)
			// {
			// 	if($column instanceof CLinkColumn)
			// 	{
			// 		if($column->labelExpression!==null)
			// 			$value=$column->evaluateExpression($column->labelExpression,array('data'=>$data[$row],'row'=>$row));
			// 		else
			// 			$value=$column->label;
			// 	} elseif($column instanceof CButtonColumn)
			// 		$value = ""; //Dont know what to do with buttons
			// 	elseif($column->value!==null) 
			// 		$value=$this->evaluateExpression($column->value ,array('data'=>$data[$row]));
			// 	elseif($column->name!==null) { 
			// 		//$value=$data[$row][$column->name];
			// 		$value= CHtml::value($data[$row], $column->name);
			// 	    $value=$value===null ? "" : $column->grid->getFormatter()->format($value,'raw');
   //              }             

			// 	$a++;
			// 	$cell = $this->objPHPExcel->getActiveSheet()->setCellValue($this->columnName($a).($row+2) , strip_tags($value), true);				
			// 	if(is_callable($this->onRenderDataCell))
			// 		call_user_func_array($this->onRenderDataCell, array($cell, $data[$row], $value));
			// }			
			//$this->objPHPExcel->getActiveSheet()->setCellValue('H19',$data->destination,true);
			
			
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