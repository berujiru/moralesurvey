<?php

class topdf 
{
	public static function createLeavePdf($req_id)
	{

		$pdf = Yii::createComponent('application.extensions.tcpdf.mypdf', 
		                            'P', 'cm', 'A4', true, 'UTF-8');
		$temp = Requests::model()->findByPk($req_id);

		
		$pdf = new mypdf(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

		// set document information
		$pdf->SetCreator(PDF_CREATOR);
		$pdf->SetAuthor('Nicola Asuni');
		$pdf->SetTitle('TCPDF Example 001');
		$pdf->SetSubject('TCPDF Tutorial');
		$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

		// set default header data
		$pdf->setPrintHeader(true);
		$pdf->setPrintFooter(false);

		// set header and footer fonts
		$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
		$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

		// set default monospaced font
		$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

		// set margins
		$pdf->SetMargins(10, 20, 10);
		$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
		$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

		// set auto page breaks
		$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

		// set image scale factor
		$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

		// set some language-dependent strings (optional)
		if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
			require_once(dirname(__FILE__).'/lang/eng.php');
			$pdf->setLanguageArray($l);
		}

		// ---------------------------------------------------------

		// set default font subsetting mode
		$pdf->setFontSubsetting(true);

		// Set font
		// dejavusans is a UTF-8 Unicode font, if you only need to
		// print standard ASCII chars, you can use core fonts like
		// times or times to reduce file size.
		//$pdf->SetFont('dejavusans', '', 14, '', true);

		// Add a page
		// This method has several options, check the source code documentation for more information.
		$pdf->AddPage();

		// set text shadow effect
		// set font
		
		// ---------------------------------------------------------
		$pdf->SetFont('times', '', 8);
		$txt = "REF:".$temp->track_num;
		$pdf->writeHTMLCell(45,3,0,45,$txt,0,1,false,true,'C',false);
		

		$pdf->SetFont('times', 'B', 9);
		$txt = "APPLICATION FOR LEAVE";
		$pdf->writeHTMLCell(45,3,83,50,$txt,'B',1,false,true,'C',false);
		
		$pdf->SetFont('times', '', 8);
		$txt = "C.S. Form 6";
		$pdf->writeHTMLCell(40,3,10,52,$txt,0,1,false,true,'L',false);
		$txt = "Revised 1985";
		$pdf->writeHTMLCell(40,3,10,55,$txt,0,1,false,true,'L',false);

		//************************AGENCY****************************
		$pdf->writeHTMLCell(0,20,10,59,"",1,1,false,true,'L',false);
		$txt = "1. AGENCY/OFFICE:";
		$pdf->writeHTMLCell(70,8,10,59,$txt,1,1,false,true,'L',false);

		$txt = "DOST 9";
		$pdf->writeHTMLCell(70,4,10,63,$txt,0,1,false,true,'L',false);

		//************************Name****************************
		$txt = "2. NAME (LAST) (FIRST) (M)";
		$pdf->writeHTMLCell(0,8,80,59,$txt,1,1,false,true,'L',false);

		//GET THE Userpersonal'S NAME
		//$name = Yii::app()->getModule('user')->user()->profile;
		$name = profile::model()->findByPk($temp->user_id);
		$txt = $name->lastname.' , '.$name->firstname.' '.$name->middlename;
		$pdf->writeHTMLCell(0,4,80,63,$txt,0,1,false,true,'L',false);

		//************************date of filing****************************
		$txt = "3. DATE OF FILING";
		$pdf->writeHTMLCell(70,8,10,67,$txt,1,1,false,true,'L',false);

		$txt = Yii::app()->dateFormatter->format("d MMM y",strtotime($temp->dateFiled));
		$pdf->writeHTMLCell(70,4,10,71,$txt,0,1,false,true,'L',false);

		//************************Position and basic salary****************************
		$txt = "4.POSITION";
		$pdf->writeHTMLCell(0,8,80,67,$txt,1,1,false,true,'L',false);

		$pos = Position::model()->findByAttributes(array('user_id'=>Yii::app()->user->id));
		if($pos->position_type=="regular"){
			$tempposition=ReferPositionPlantilla::model()->findByPk($pos->position_id);
			$pos_name=$tempposition->plantillaName;
			$getbasicsalary=ReferSalarySchedule::model()->findByPk($tempposition->sal_id);
			$basicSalary=$getbasicsalary->basicSalary;
		}
		else{
			$tempposition=ReferPositionContract::model()->findByPk($pos->position_id);
			$pos_name=$tempposition->position_name;
			$basicSalary=$tempposition->basicSalary;
		}

		if($pos_name)
			$txt = $pos_name;
		else
			$txt = "No position assigned yet";
		$pdf->writeHTMLCell(0,4,80,71,$txt,0,1,false,true,'L',false);


		//***********************prints basic salary*************************
		$txt = "5. BASIC SALARY";
		$pdf->writeHTMLCell(60,8,135,67,$txt,0,1,false,true,'L',false);

		//get basic salary
		if($basicSalary)
			$txt = "$basicSalary";
		else
			$txt="No Basic Salary assigned yet";
		$pdf->writeHTMLCell(60,4,135,71,$txt,0,1,false,true,'L',false);

		$pdf->writeHTMLCell(70,20,10,59,'','R',1,false,true,'L',false);

		// ---------------------------------------------------------
		$pdf->SetFont('times', 'B', 11);
		$txt = "6. DETAILS OF APPLICATION";
		$pdf->writeHTMLCell(80,3,65,80,$txt,0,1,false,true,'C',false);

		$pdf->SetFont('times', '', 10);
		$pdf->writeHTMLCell(0,70,10,85,"",1,1,false,true,'L',false);
		$pdf->writeHTMLCell(70,70,10,85,'','R',1,false,true,'L',false);

		$txt = "6. a) TYPE OF LEAVE<br />
				&nbsp;&nbsp;&nbsp; $temp->requestType";
		$pdf->writeHTMLCell(70,33,10,85,$txt,0,1,false,true,'L',false);

		//get the leave for forced leave and count he days
		if($temp->req_path==="Leaveforce"){
			$leaveData = Leaveforce::model()->findByPk($temp->req);
			$days =myhelper::checkleave($leaveData->leaveFrom,$leaveData->leaveTo,$leaveData->isWholeDay);
		}
		if($temp->req_path==="Leavematernity"){
			$leaveData = Leavematernity::model()->findByPk($temp->req);
			$days =myhelper::checkleave($leaveData->leaveFrom,$leaveData->leaveTo,"");
		}
		//get the leave for preveledge leave and count the days
		if($temp->req_path==="Leavepriveledge"){
			$leaveData = Leavepriveledge::model()->findByPk($temp->req);
			$days =myhelper::checkleave($leaveData->leaveFrom,$leaveData->leaveTo,$leaveData->dayType);
		}
		//get the leave for sick leave and count the days
		if($temp->req_path==="Leavesick"){
			$leaveData = Leavesick::model()->findByPk($temp->req);
			$days =myhelper::checkleave($leaveData->leaveFrom,$leaveData->leaveTo,$leaveData->dayType);
		}
		//get the leave for vacation leave and count the days
		if($temp->req_path==="Leavevacation"){
			$leaveData = Leavevacation::model()->findByPk($temp->req);
			$days =myhelper::checkleave($leaveData->leaveFrom,$leaveData->leaveTo,$leaveData->dayType);
		}
		//get the leave for vacation leave and count the days
		if($temp->req_path==="Leavesoloparent"){
			$leaveData = Leavesoloparent::model()->findByPk($temp->req);
			$days =myhelper::checkleave($leaveData->leaveFrom,$leaveData->leaveTo,$leaveData->dayType);
		}

		//get the working days
		$txt = "6. c) No. of working days	<br />
				&nbsp;&nbsp;&nbsp; Applied for:$days			 	<br />
				&nbsp;&nbsp;&nbsp; Inclusive Dates:			";
		$pdf->writeHTMLCell(70,33,10,98,$txt,0,1,false,true,'L',false);

		//get the dates
		$daystemp=myhelper::getleavedates($leaveData->leaveFrom,$leaveData->leaveTo);
		$txt="";
		foreach ($daystemp as $aday) {
			$txt.="&nbsp;&nbsp;&nbsp; $aday <br/>";
		}
		$pdf->writeHTMLCell(70,39,10,111,$txt,0,1,false,true,'L',false);

		$txt = "6. b) Where leave will be spent";
		$pdf->writeHTMLCell(70,33,80,85,$txt,0,1,false,true,'L',false);

		//**********************incase of vacation or sick leave***********************8
		if($temp->req_path==="Empreqleavesick"){
			$txt ="In case of sick leave:";
			$txt = $txt."$leaveData->incaseofleave <br/>";
			$txt=$txt."specify __________________________";
			$pdf->writeHTMLCell(70,20,85,90,$txt,0,1,false,true,'L',false);
		}
		if($temp->req_path==="Empreqleavevacation"){
			$txt ="In case of vacation leave:";
			$txt = $txt."$leaveData->incaseofleave <br/>";
			$txt=$txt."specify __________________________";
			$pdf->writeHTMLCell(70,20,85,90,$txt,0,1,false,true,'L',false);
		}

		$txt = "6. d) Commutation";
		$pdf->writeHTMLCell(70,33,80,118,$txt,0,1,false,true,'L',false);
		$pdf->SetFont('times', 'B', 11);

		$txt = "Signature of Applicant";
		$pdf->writeHTMLCell(40,5,140,145,$txt,'T',1,false,true,'C',false);

		$pdf->writeHTMLCell(0,4,10,150,'',1,1,false,true,'L',false);

		// ---------------------------------------------------------
		$pdf->SetFont('times', 'B', 11);
		$txt = "7. DETAILS OF ACTION ON APPLICATION";
		$pdf->writeHTMLCell(100,3,55,155,$txt,0,1,false,true,'C',false);
		$pdf->SetFont('times', '', 11);

		$pdf->SetFont('times', '', 10);
		$pdf->writeHTMLCell(0,60,10,160,"",1,1,false,true,'L',false);
		$pdf->writeHTMLCell(100,60,10,160,'','R',1,false,true,'L',false);

		$txt = "7. a) Certification of leave credits as of";
		$pdf->writeHTMLCell(100,15,10,160,$txt,1,1,false,true,'L',false);

		//**********************get the AS OF leave***************************
		//get the leave data
		$leaveTemp=ReferLeave::model()->findByAttributes(array('user_id'=>$temp->user_id));
		$asofDate=$temp->dateFiled;
		$asofDate=strtotime($asofDate);
		$asofDate=strtotime('-1 month', $asofDate);
		$asofDate=date("t M Y", $asofDate);

		if(($temp->req_path==="Empreqleaveforce")){
			$asofDate=$asofDate.' '.$temp->requestType.'('.(5-$leaveTemp->FL).' of 5.00)';
		}
		else if($temp->req_path==="Empreqleavepriveledge"){
			$asofDate=$asofDate.' '.$temp->requestType.'('.(3-$leaveTemp->SPCL).' of 3.00)';
		}
		$asofDate="&nbsp;&nbsp;&nbsp;".$asofDate;
		$pdf->writeHTMLCell(100,20,10,165,$asofDate,0,1,false,true,'L',false);

		//get the amount of leave for the deduction
		//the amount use to deduct leave is stored in var $days

		$txt = "Vacation";
		$pdf->writeHTMLCell(34,10,10,175,$txt,1,1,false,true,'C',false);

		$pdf->writeHTMLCell(34,10,10,185,"Days:".$leaveTemp->asofVL,1,1,false,true,'C',false);
		$txt = "Sick";
		$pdf->writeHTMLCell(33,10,44,175,$txt,1,1,false,true,'C',false);

		$pdf->writeHTMLCell(33,10,44,185,"Days:".$leaveTemp->asofSL,1,1,false,true,'C',false);
		$txt = "Total";
		$pdf->writeHTMLCell(33,10,77,175,$txt,1,1,false,true,'C',false);

		$pdf->writeHTMLCell(33,10,77,185,"Days:".($leaveTemp->asofVL+$leaveTemp->asofSL),1,1,false,true,'C',false);

		//check if whwat divisioon this employee is under
		$checkdivision=Division::model()->findByAttributes(array('user_id'=>Yii::app()->user->id));

		//get assigned empployee 
		$assigned =Profile::model()->findByPk($checkdivision->division->assigned);
		$txt = $assigned->firstname." ".$assigned->lastname;
		$pdf->writeHTMLCell(40,5,40,210,$txt,0,1,false,true,'C',false);

		//$txt=$checkdivision->division->division_code;
		$txt = "ARD, FASTS";
		$pdf->writeHTMLCell(40,5,40,215,$txt,'T',1,false,true,'C',false);

		$txt = "7. b) Recomendation:<br />&nbsp;&nbsp;&nbsp;&nbsp;Approved";
		$pdf->writeHTMLCell(0,15,110,160,$txt,0,1,false,true,'L',false);

		//get assigned empployee of HR as of NOW *Thisis just temporary as of now		
		$getpersonAssigned=ReferDivision::model()->findByPk(1);

		$assigned =Profile::model()->findByPk($getpersonAssigned->assigned);
		$txt = $assigned->firstname." ".$assigned->lastname;

		$txt = $assigned->firstname." ".$assigned->lastname;
		$pdf->writeHTMLCell(40,5,138,205,$txt,0,1,false,true,'C',false);
		$txt="ARD, ".$checkdivision->division->division_code;
		$pdf->writeHTMLCell(40,5,138,210,$txt,'T',1,false,true,'C',false);

		// ---------------------------------------------------------
		$txt = "7. c) Approved for<br />
				______day with pay<br />
				______days without pay<br />
				______others (specify)";
		$pdf->writeHTMLCell(50,3,10,220,$txt,0,1,false,true,'L',false);

		$txt = "7. d) Disapproved due to:<br />
				__________________________<br/ >
				__________________________<br/ >
				__________________________.";
		$pdf->writeHTMLCell(50,3,110,220,$txt,0,1,false,true,'L',false);

		$pdf->SetFont('times', 'B', 12);
		$txt = "BRENDA L. NAZARETH-MANZANO";
		$pdf->writeHTMLCell(80,5,65,245,$txt,'B',1,false,true,'C',false);

		$pdf->SetFont('times', 'B', 11);
		$txt = "Regional Director";
		$pdf->writeHTMLCell(40,5,85,250,$txt,0,1,false,true,'C',false);
		
		// Close and output PDF document
		// This method has several options, check the source code documentation for more information.
		$pdf->Output('LeaveForm.pdf', 'I');
	}
	
}

?>