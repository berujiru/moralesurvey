<?php

class SiteController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
	public function filters()
	{
		return array(
			 'accessControl', // perform access control for CRUD operations
			 'postOnly + delete', // we only allow deletion via POST request
			
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view','contact','error','login','logout','manageApprove','manageDisapprove','print','printcto','getProfile','refreshLeave','refreshreqinfo','printto','manageCancel','settings','printpds','getWorkingDays'),
				'users'=>array('*'),
			),
			 array('allow',
                'actions' => array('dtrboard'),
                'ips' => array('210.213.201.135'), //ip here for the dtr board //exclusive only
            ),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}


	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		$this->render('index');
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$name='=?UTF-8?B?'.base64_encode($model->name).'?=';
				$subject='=?UTF-8?B?'.base64_encode($model->subject).'?=';
				$headers="From: $name <{$model->email}>\r\n".
					"Reply-To: {$model->email}\r\n".
					"MIME-Version: 1.0\r\n".
					"Content-Type: text/plain; charset=UTF-8";

				mail(Yii::app()->params['adminEmail'],$subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$model=new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
				$this->redirect(Yii::app()->user->returnUrl);
		}
		// display the login form
		$this->render('login',array('model'=>$model));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}

	public function actionManageApprove($id)
	{
		//check access if the user is ahs the right
		//we need to check it manually because its in sitecontroller
		$security = false;

		$roles=Rights::getAssignedRoles(Yii::app()->user->Id);
    	foreach($roles as $role){
       		//echo $role->name."<br />";
       		if(($role->name=='HR employee')||($role->name=='Admin')){
       			$security = true;
       		}
       	}

       	if(!$security){
       		echo "<div class='flash-error'>You cannot approve this request</div>"; exit();
       	}


		$appliedDays=0;
		$req=Requests::model()->findByPk($id);
		if(strtolower($req->remark)!="pending"){
			echo "<div class='flash-error'>You already $req->remark this ".$req->requestType." request!</div>";
			Yii::app()->end();
		}
		


		switch ($req->req_path) {
			case 'Leavecto':
				# code...
				//get the data of cto leave request
				$leaveinfo = Leavecto::model()->findByPk($req->req);
				if($leaveinfo){
					//get the applied days
					//$appliedDays=myhelper::checkleave($leaveinfo->leaveFrom,$leaveinfo->leaveTo,$leaveinfo->isWholeDay);
					$appliedDays=count(explode(",",$leaveinfo->leaveDate));
				}else{
					echo "<div class='flash-error'>Cannot find this request</div>";
					Yii::app()->end();
				}
				//edit here to direct to credits
				$leave_credit=ReferCredits::model()->findByAttributes(array('user_id'=>$req->user_id,'type'=>1));
				
				break;

			case 'Leaveforce':
				# code...
				//get the data of cto leave request
				$leaveinfo = Leaveforce::model()->findByPk($req->req);
				if($leaveinfo){
					//get the applied days
					$appliedDays=count(explode(",",$leaveinfo->leaveDate));

				}else{
					echo "<div class='flash-error'>Cannot find this request</div>";
					Yii::app()->end();
				}
				//edit here to direct to credits
				$leave_credit=ReferCredits::model()->findByAttributes(array('user_id'=>$req->user_id,'type'=>2));
				
				break;

			case 'Leavematernity':
				# code...
				//get the data of cto leave request
				$leaveinfo = Leavematernity::model()->findByPk($req->req);
				if($leaveinfo){
					//get the applied days
					$appliedDays=myhelper::checkleave($leaveinfo->leaveFrom,$leaveinfo->leaveTo,"");
				}else{
					echo "<div class='flash-error'>Cannot find this request</div>";
					Yii::app()->end();
				}
				//edit here to direct to credits
				$leave_credit=ReferCredits::model()->findByAttributes(array('user_id'=>$req->user_id,'type'=>3));
				
				break;

			case 'Leavepriveledge':
				# code...
				//get the data of cto leave request
				$leaveinfo = Leavepriveledge::model()->findByPk($req->req);
				if($leaveinfo){
					//get the applied days
					$appliedDays=count(explode(",",$leaveinfo->leaveDate));
				}else{
					echo "<div class='flash-error'>Cannot find this request</div>";
					Yii::app()->end();
				}
				//edit here to direct to credits
				$leave_credit=ReferCredits::model()->findByAttributes(array('user_id'=>$req->user_id,'type'=>4));
				
				break;

			case 'Leavesick':
				# code...
				//get the data of cto leave request
				$leaveinfo = Leavesick::model()->findByPk($req->req);
				if($leaveinfo){
					//get the applied days
					$appliedDays=count(explode(",",$leaveinfo->leaveDate));
				}else{
					echo "<div class='flash-error'>Cannot find this request</div>";
					Yii::app()->end();
				}
				//edit here to direct to credits
				$leave_credit=ReferCredits::model()->findByAttributes(array('user_id'=>$req->user_id,'type'=>5));
				
				break;

			case 'Leavevacation':
				# code...
				//get the data of cto leave request
				$leaveinfo = Leavevacation::model()->findByPk($req->req);
				if($leaveinfo){
					//get the applied days
					$appliedDays=count(explode(",",$leaveinfo->leaveDate));
				}else{
					echo "<div class='flash-error'>Cannot find this request</div>";
					Yii::app()->end();
				}
				//edit here to direct to credits
				$leave_credit=ReferCredits::model()->findByAttributes(array('user_id'=>$req->user_id,'type'=>6));
				
				break;


			default:
				# code...

				if($req->req_path=='RequestVehicle'){
					$req->remark="Approved";
					$req->actionby=Yii::app()->user->id;
					$req->date_modified = new CDbExpression('NOW()');
					$req->reason = "";
					$req->save(false);


					$model2 = RequestVehicle::model()->findByPk($req->req);

					//sends email
					$body = "Good Day ".myhelper::getfullname($model2->user_id) ."! <br> Your Vehicle Reservation is already approve. <br> Here are some info". $model2->dates.", ". $model2->vehicles->name .", ".myhelper::getfullname($model2->driver);
						
					//send email to their email addresses
					$getuser = User::model()->findByPk($model2->user_id);
					

					$email=CHtml::encode($getuser->email);
					$message = new YiiMailMessage;
			           //this points to the file test.php inside the view path
			        $message->view = "mail";
			        $params  = array('myMail'=>$body);
			        $message->subject    = 'DOST-IX Vehicle Reservation';
			        $message->setBody($params, 'text/html');                
			        $message->addTo($email);
			        $message->from ='dost9ict@gmail.com';  
			        
			        Yii::app()->mail->send($message); 




					echo "<div class='flash-success'>Successfully Approved a ".$req->requestType." request!</div>";
					Yii::app()->end();
				}





			//this is temporary
				// 	if($req->req_path=='ReqTravelorder'){
				// 	//those in whowith will have an ob

				// 	//get the request's data
				// 	$travelrequest = ReqTravelorder::model()->findByPk($req->req);
				// 	//make  referOT record/s for the dtr to validate
				// 	$persons=myhelper::convertwhoswith($travelrequest->whosWithYou);
				// 	//print_r($persons); exit();

				// 	//get the start and end date
				// 	$start_date =strtotime($travelrequest->dateFrom);
				// 	$end_date = strtotime($travelrequest->dateTo);

				// 	while ($start_date <= $end_date) {
				// 	    if (date('N', $start_date) < 6) {
				// 	        //loop to each employee that is in the request
				// 	        if($travelrequest->whosWithYou){
				// 	        	//echo Yii::app()->dateFormatter->format("y-MM-dd",$start_date);
				// 		    	foreach ($travelrequest->whosWithYou as $person) {
				// 		    		# code...
				// 		    		//if an employee has dtr on this day then update time to ob if not yet then create a record
				// 		    		$dtr = Dtr::model()->findByAttributes(array('user_id'=>$person,'date'=>Yii::app()->dateFormatter->format("y-MM-dd",$start_date)));
				// 		    		if($dtr){
				// 		    			if(!$dtr->inAM)
				// 		    				$dtr->inAM=0;
				// 		    			else
				// 		    				$dtr->inAM=strtotime($dtr->date . $dtr->inAM);

				// 		    			if(!$dtr->outAM)
				// 		    				$dtr->outAM=0;
				// 		    			else
				// 		    				$dtr->outAM=strtotime($dtr->date . $dtr->outAM);

				// 		    			if(!$dtr->inPM)
				// 		    				$dtr->inPM=0;
				// 		    			else
				// 		    				$dtr->inPM=strtotime($dtr->date . $dtr->inPM);

				// 		    			if(!$dtr->outPM)
				// 		    				$dtr->outPM=0;
				// 		    			else
				// 		    				$dtr->outPM=strtotime($dtr->date . $dtr->outPM);

				// 		    			$dtr->save(false);
				// 		    		}
				// 		    		else{
				// 		    			$dtr = new Dtr();
				// 						$dtr->user_id = $person;
				// 						$dtr->date = Yii::app()->dateFormatter->format("y-MM-dd",$start_date);
				// 						$dtr->inAM=0;
				// 		    			$dtr->outAM=0;
				// 		    			$dtr->inPM=0;
				// 		    			$dtr->outPM=0;
				// 		    			$dtr->save(false);
				// 		    		}
				// 		    	}
				// 	    	}
				// 	    }
				// 	    $start_date = strtotime('+1 day', $start_date);
				// 	}
				// 	//exit();
				// 	echo "<div class='flash-success'>Successfully Approved a ".$req->requestType." request!</div>";
				// 	Yii::app()->end();
				// }

				
					echo "<div class='flash-error'>Cannot find this request</div>";
					Yii::app()->end();
				break;
		}


		if($leave_credit){
			if(($leave_credit->balance-$appliedDays)<0){
				//notice lack of credits
				echo "<div class='flash-error'>Not enough credits left. Requesting $appliedDays out of $leave_credit->balance</div>";
				Yii::app()->end();
			}
			else{

				//if forced leave check if the employee has enough amount of vacation leave
					if($req->req_path=="Leaveforce"){
						$vacationleave_credit=ReferCredits::model()->findByAttributes(array('user_id'=>$req->user_id,'type'=>6));
						if(($vacationleave_credit->balance-$appliedDays)<0){
							echo "<div class='flash-error'>Not enough vacation leave credits left. Requesting $appliedDays out of $vacationleave_credit->balance</div>";
							Yii::app()->end();
						}
					}


				//edit here to put logs after saving
				$leave_credit->balance=$leave_credit->balance-$appliedDays;
				if($leave_credit->save(false)){

					//if forced leave, also subtract the days applied to vacation leave credits to allocate the forced leave
					if($req->req_path=="Leaveforce"){
						$vacationleave_credit=ReferCredits::model()->findByAttributes(array('user_id'=>$req->user_id,'type'=>6));
						$vacationleave_credit->balance = $vacationleave_credit->balance - $appliedDays;
						$vacationleave_credit->save(false);
					}

					//put a log here
					$log = new ReferCreditsLogs;
					$log->date = new CDbExpression('NOW()');
					$log->updateby = Yii::app()->user->id;
					$log->updateto =  $req->user_id;
					$log->request_type = $leave_credit->type;
					$log->transac_type = 1; //1 mean subtract
					$log->quantity = $appliedDays;
					$log->save(false);
				}

				$req->remark="Approved";
				$req->actionby=Yii::app()->user->id;
				$req->date_modified = new CDbExpression('NOW()');
				$req->reason = "";
				$req->save(false);

				echo "<div class='flash-success'>Successfully Approved a ".$req->requestType." request!</div>";
			}
		}else{

			echo "<div class='flash-error'>No leave credits found</div>";
			Yii::app()->end();
		}	
	}

	//this will do if the request has been disapproved
	public function actionManageDisapprove($id)
	{
		
		$req=Requests::model()->findByPk($id);
		if(strtolower($req->remark)=="pending"){
			$req->remark="Disapproved";
			$req->actionby=Yii::app()->user->id;
			// Uncomment the following line if AJAX validation is needed
			// $this->performAjaxValidation($model);
			$req->reason = $_POST['reason'];
			$req->date_modified = new CDbExpression('NOW()');
			$req->save();
			//Yii::app()->user->setFlash('success','Successfully Disapproved a "'.$req->requestType.'" request!');
			echo "<div class='flash-success'>Successfully Disapproved a ".$req->requestType." request!</div>";
		}
		else{
			echo "<div class='flash-error'>Cannot be altered, You already $req->remark this ".$req->requestType." request!</div>";
		}
	}

	public function actionPrint($req_id){
		leavepdf::createLeavePdf($req_id);
	}

	public function actionPrintcto($req_id){
		leavepdf::createLeavePdf($req_id);
	}

	public function actionGetProfile()
	{
		if(isset($_POST['emp_code'])&&isset($_POST['radio_time'])){
			//getr the profile data of the employee
			$getprof = Profile::model()->findByAttributes(array('employee_id'=>$_POST['emp_code']));
			if($getprof){
				$time = strtolower($_POST['radio_time']);
				myhelper::performDTR($getprof->user_id,$time);
				echo "<br/>".$getprof->firstname." ".$getprof->middlename." ".$getprof->lastname;
			}
			else
				echo "<strong style='color:red;'>Employee Not Found.<br/> Please report to admin</strong>";
		}
		else{
			echo "<strong style='color:red;'>Select time type and please scan your ID again.</strong>";
		}
	}

	

	public function actionRefreshLeave(){
		if(isset($_POST["id"])){
			$id = $_POST["id"];
			echo $this->renderPartial('_leavecredit', array('id'=>$id));
		}
		else
			echo "not available";
		
	}

	public function actionRefreshreqinfo(){
		if(isset($_POST["id"])){
			$id = $_POST["id"];
			//get the request data
			$data =Requests::model()->findByPk($id); 
			$remark = $data->remark;
			if($remark)
				echo $remark;
			else
				echo "Something went wrong";
		}
		else
			echo "not available";
		
	}

	public function actionPrintto($to_id){
		//get the to's data
		//$dataProvider = ReqTravelorder::model()->findByPk($to_id);

		//$to_id = 1000;
		$dataProvider=new CActiveDataProvider('ReqTravelorder', array(
			'criteria'=>array(
		        'condition'=>'id='.$to_id,
		    ),
		));

		//$dataProvider=new CActiveDataProvider('ReferCourse');
		$this->widget('ext.EExcelView.EExcelViewReportTO', array(
		    'dataProvider'=> $dataProvider,
		    'title'=>'Travel Request',
			'filename'=>'Travel Request_'.$dataProvider->id,
			'grid_mode'=>'export',
			'autoWidth'=>false,
			'columns'=>array( 
				//pass all the data so i commented the prarameter columns
				'destination'
			),
		));
	}


	public function actionManageCancel($id)
	{
		$req=Requests::model()->findByPk($id);
		if($req->remark=="pending"){
			$req->remark="cancelled";
			if($req->save())
				echo "Request cancelled!";
			else
				echo "Failed to cancel request!";
		}
		else{
			echo "Cant cancel this request";
		}
	}


	 public function actionSettings(){
                $settings = new OICForm;
                $settings->load();
                if (isset($_POST['OICForm'])){
                        $settings->attributes=$_POST['OICForm'];
                        if ($settings->validate()){
                                $settings->save();
                                Yii::app()->user->setFlash('settings', 'Site settings has been successfully saved.');
                        }
                }
                
                $this->render('settings', array('settings'=>$settings));
        }

    public function actionPrintpds($id){

    	//<!---------GATHER DATA OF THE EMPLOYEE VIA ID -->
    	//<----------START ----->

    	//$id = $idraw->empid;
        //query the 201 file of the user
        $userCriteria = new CDbCriteria();
        $userCriteria->select="*";
        $userCriteria->condition="`user_id`=".$id;
		$profile_other=ProfileOtherdata::model()->find($userCriteria);
		$profileCriteria=Profile::model()->findByPk($id);
		
		$crit=new CDbCriteria;
		$crit->limit=1;
		$crit->condition='user_id=:userId';
		$crit->params=array(':userId'=>$id);
		
  
        $childCriteria=Children::model()->findAll(array('condition'=>'user_id='.$id,'limit'=>13));

		$educriteria=Education::model()->findAll(array('condition'=>'user_id='.$id,'limit'=>7));

		$examcriteria=Exam::model()->findAll(array('condition'=>'user_id='.$id,'limit'=>3,'order'=>'examDate Desc'));
		


		$workcriteria = Work::model()->findAll(array('condition'=>'user_id='.$id,'limit'=>22,'order'=>'dateTo Desc'));
		
		$traincriteria = Training::model()->findAll(array('condition'=>'user_id='.$id,'limit'=>12,'order'=>'dateTo Desc'));

		

		$voluntarycriteria=Voluntary::model()->findAll(array('condition'=>'user_id='.$id,'limit'=>5,'order'=>'dateTo Desc'));
		
		$skillcriteria=Skills::model()->findAll(array('condition'=>'user_id='.$id,'limit'=>5));
		
		$recognitioncriteria=Recognition::model()->findAll(array('condition'=>'user_id='.$id,'limit'=>5));
		
		$associationcriteria=Association::model()->findAll(array('condition'=>'user_id='.$id,'limit'=>5));
		
		$refcriteria=Reference::model()->findAll(array('condition'=>'user_id='.$id,'limit'=>3));
		
		$legalcriteria=Legal::model()->find(array('condition'=>'user_id='.$id));
		// $legalcriteria=new CDbCriteria();
		// $legalcriteria->condition="`user_id`=".$id;
		// $legaldata=Legal::model()->find($legalcriteria);

		// $pledgecriteria=new CDbCriteria();
		// $pledgecriteria->select="*";
		// $pledgecriteria->condition="`user_id`=".$id;
		// $pledgedata=Pledge::model()->find($pledgecriteria);

		// //get the position data
		// //$posdata = Position::model()->findByPk($id);
		// $posdata = Position::model()->findByAttributes(array('user_id'=>$id));
		// $posdata2=null;
		// $salarydata=null;
		// if($posdata){
		// 	if($posdata->position_type==="regular"){
		// 		//get from plantilla tbl
		// 		$posdata2=ReferPositionPlantilla::model()->findByPk($posdata->position_id);
		// 		//also get the salary data
		// 		if($posdata2){
		// 			$salarydata=ReferSalarySchedule::model()->findByPk($posdata2->sal_id);
		// 		}
		// 	}
		// 	elseif($posdata->position_type==="contractual"){
		// 		//get form contractual tbl
		// 		$posdata2=ReferPositionContract::model()->findByPk($posdata->position_id);
		// 	}
		// }
    	//<!---------END-------->

		//the variables
		// 'user_id'=>$id,
		// 'Profile'=>$profileCriteria,
		// 'Children'=>$childCriteria,
		// 'UsersP'=>$profile_other,
		// 'Edus'=>$educriteria,
		// 'Exams'=>$examcriteria,
		// 'Works'=>$workcriteria,
		// 'Trains'=>$traincriteria,
		// 'Voluns'=>$voluntarycriteria,
		// 'Skills'=>$skillcriteria,
		// 'recognition'=>$recognitioncriteria,
		// 'association'=>$associationcriteria,
		// 'Refs'=>$refcriteria,
		// 'Legal'=>$legalcriteria,
		// 'Pledge'=>$pledgedata,
		// 'personID'=>$id,
		// 'position_type'=>$posdata,
		// 'positiondata'=>$posdata2,
		// 'salarydata'=>$salarydata

											
		//$dataProvider=new CActiveDataProvider('ReferCourse');
		$this->widget('ext.EExcelView.EExcelViewReportPds', array(
		    'dataProvider'=> "",
		    'title'=>'Travel Request',
			'filename'=>'PDS_',
			'grid_mode'=>'export',
			'autoWidth'=>false,
			'Children'=>$childCriteria,
			'UsersP'=>$profile_other,
			'Profile'=>$profileCriteria,
			'user_id'=>$id,
			'Edus'=>$educriteria,
			'Exams'=>$examcriteria,
			'Works'=>$workcriteria,
			'Voluns'=>$voluntarycriteria,
			'Trains'=>$traincriteria,
			'Skills'=>$skillcriteria,
		    'recognition'=>$recognitioncriteria,
		    'association'=>$associationcriteria,
		    'Refs'=>$refcriteria,
		    'Legal'=>$legalcriteria,
		));
	}

	public function actionDtrboard(){
		
		$this->render('_dtrwindow');
	}


	public function actionGetWorkingDays(){
		if(isset($_POST["startDate"],$_POST["endDate"],$_POST["daytype"])){
			$isWholeDay = $_POST["daytype"];
			$currentTime = strtotime($_POST["startDate"]);
			$endTime = strtotime($_POST["endDate"]);
			$leave = $_POST["leave"];
			if($currentTime&&$endTime&&$leave){
				$leaveday=0;

				// Loop until we reach the last day and counts all the working days
				$result = array();
				while ($currentTime <= $endTime) {
				    if (date('N', $currentTime) < 6) {
				        $leaveday++;
				        $result[] = date('Y-m-d', $currentTime);
				    }
				    $currentTime = strtotime('+1 day', $currentTime);
				}

				$holiday=0;
				//among working days count if there are any holiday
				foreach($result as $hol){
					$temphol = ReferHolidays::model()->findByAttributes(array('holiday_date'=>$hol));
					if($temphol)
						$holiday++;
				}

				//get the exact working day that is not holiday
				$leaveday=$leaveday-$holiday;
				//check if whole day or nahh
				if($isWholeDay=='halfday')
					$leaveday=$leaveday/2;

				$type=0;
				//modify here
				if($leave=='fl')
					$type=2;
				elseif($leave=='ml')
					$type=3;
				elseif($leave=='spl')
					$type=4;
				elseif($leave=='skl')
					$type=5;
				elseif($leave=='vl')
					$type=6;
				elseif($leave=='cto')
					$type=1;
				
				// elseif($leave=='sol')
				// 	$compare_var=$leave_credit->SOLO;

				$leave_credit=ReferCredits::model()->findByAttributes(array('user_id'=>Yii::app()->user->id,'type'=>$type));

				if(!$leave_credit){
					echo "<i class='label label-important'>  No ".myhelper::creditterm($type)." credit/s yet.</i>";
				}else{
					if($leaveday>$leave_credit->balance){
						echo "<i class='label label-important'>  ".$leaveday." days</i>";
					}else{
						echo "<i class='label label-success'>  ".$leaveday." days</i>";
					}
				}
			}

		}
		else
			echo "not available";
	}
}