<?php
//pretected/components/myhelper.php

class myhelper
{
	public static function appliedDays(){
		return 'hello its working!!';
	}

	public static function getfullname($id){
		$getprof=Profile::model()->findByPk($id);
		$fullname=null;
		if($getprof)
			$fullname=$getprof->firstname." ".$getprof->middlename." ".$getprof->lastname;
		return ($fullname);
	}

	public static function checkleave($dateFrom,$dateTo,$isWholeDay="wholeday")
	{
		$currentTime = strtotime($dateFrom);
		$endTime = strtotime($dateTo);
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
		//get the credits
		
		return $leaveday;
		
	}

	public static function getleavedates($dateFrom,$dateTo)
	{
		$currentTime = strtotime($dateFrom);
		$endTime = strtotime($dateTo);
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
		$workingdays=array();
		//among working days count if there are any holiday
		foreach($result as $hol){
			$temphol = ReferHolidays::model()->findByAttributes(array('holiday_date'=>$hol));
			if(!$temphol)
				$workingdays[]=$hol;
		}
		
		
		return $workingdays;

	}

	public static function getmonthworkingdays($month,$year,$id)
	{
		$startdate = $year."-".$month."-01";
		$findate = date("Y-m-t", strtotime($startdate));
		$currentdate = strtotime($startdate);
		//$currentdate = strtotime('-1 day', $currentdate);
		$enddate = strtotime($findate);
		//$enddate = strtotime('-1 day',$enddate);
		$workingdays=0;
		// Loop until we reach the last day and counts all the working days
		$result = array();
		while ($currentdate <= $enddate) {
		    if (date('N', $currentdate) < 6) {
		        $workingdays++;
		        $result[] = date('Y-m-d', $currentdate);
		    }
		    $currentdate = strtotime('+1 day', $currentdate);
		}

		$holiday=0; //counts number of holiday
		$absent_ctr=0; //counts absent
		$totalLAteUndertime=0;// store total of late and undertime
		$inAMLate=0;//store morning late
		$outAMUndertime=0;//store morning undertime
		$inPMLate=0;//store morning late
		$outPMUnertime=0;//store morning undertime
		$abset_date=array();
		$tempdiv = Division::model()->findByAttributes(array('user_id'=>$id)); //get the station of the employee
		
		foreach($result as $hol){
			$checkhol = false;
			//the $result now holds the complete working date of this month
			$temphol = ReferHolidays::model()->findByAttributes(array('holiday_date'=>$hol));
			if($temphol){
				if($temphol->target!=NULL){
					//check if the target is in
					$targets = unserialize($temphol->target);
					foreach ($targets as $target) {
						if($target===$tempdiv->station_id){
							$holiday++;	
							$checkhol = true;			
						}
					}
				}
				else{
					$holiday++;
					$checkhol = true;
				}
			}


			//among working days count if there are any holiday
			if($checkhol){
				//there was a holiday found but we need to check whether this holiday is applicable for in his location
				
				
				//$workingdays--;
			}
			else{
				if(strtotime($hol)<=strtotime(date("Y-m-d"))){
					//check if the user has an attendance of this working date
					$checkattendance = Dtr::model()->findByAttributes(array('date'=>$hol,'user_id'=>$id));
					if($checkattendance){
						//the employee is present so check if it is complete
						if($checkattendance->inAM==NULL)
							if($checkattendance->outAM==NULL){

								//before consider to be absent , check first wether if OB leave or soon
								//if(($checkattendance->inAM!=0)||($checkattendance->outAM!=0)){
									$absent_ctr=$absent_ctr+0.5; //add a halday absent
									$abset_date[]=$hol;//save the absent date
								//}
							}

						if($checkattendance->inPM==NULL)
							if($checkattendance->outPM==NULL){
								//if(($checkattendance->inPM!=0)||($checkattendance->outPM!=0)){
									$absent_ctr=$absent_ctr+0.5;//add a halday absent
									$abset_date[]=$hol;//save the absent date
								//}
							}

						//the code below counts all the late and undertime

						//for AM late
						if($checkattendance->inAM&&(strtotime($checkattendance->date . $checkattendance->inAM)>strtotime($checkattendance->date . "8:00"))){
							//does not count late if the time is ob
							if($checkattendance->inAM!=0) 
								$inAMLate+= strtotime($checkattendance->date . $checkattendance->inAM) - strtotime($checkattendance->date . "8:00");
						}

						//for AM undertime
						if($checkattendance->outAM&&(strtotime($checkattendance->date . $checkattendance->outAM)<strtotime($checkattendance->date . "12:00"))){
							if($checkattendance->outAM!=0) 
								$outAMUndertime+=strtotime($checkattendance->date . "12:00") - strtotime($checkattendance->date . $checkattendance->outAM);
						}

						//for PM late
						if($checkattendance->inPM&&(strtotime($checkattendance->date . $checkattendance->inPM)>strtotime($checkattendance->date . "13:00"))){
							if($checkattendance->inPM!=0) 
								$inPMLate+= strtotime($checkattendance->date . $checkattendance->inPM) - strtotime($checkattendance->date . "13:00");
						}

						//for PM undertime
						if($checkattendance->outPM&&(strtotime($checkattendance->date . $checkattendance->outPM)<strtotime($checkattendance->date . "17:00"))){
							if($checkattendance->outPM!=0) 
								$outPMUnertime+=strtotime($checkattendance->date . "17:00") - strtotime($checkattendance->date . $checkattendance->outPM);
						}

						//sum up all the late and UT
						$totalLAteUndertime=$inAMLate+$outAMUndertime+$inPMLate+$outPMUnertime;
						//convert the strtotime to number of hours
						$totalLAteUndertime=$totalLAteUndertime/60;
						//round to two decimal places
						$totalLAteUndertime=round($totalLAteUndertime,2);
						
					}
					else{
						//counts the absent
						$abset_date[]=$hol;
						$absent_ctr++;
					}
				}
			}
		}

		//$workingdays=$workingdays-$holiday;

		//returtn a json file
		//the content is working days , dates absent, total absent, total late/undertime,total days AWOL
		//header('Content-type: application/json');
		$data = array( 'workingdays' => $workingdays, 'absent_dates' => $abset_date, 'absentNo' => $absent_ctr,'lateUTNo'=>$totalLAteUndertime);
		return json_encode( $data );
		//return $workingdays;
	}

	//saves leave transaction that is used/approve for sickleave
	public static function trackLeaveSL($appliedDays,$transacdata){
		$temp = new TrackLeaveSl();
		$temp->user_id=$transacdata->user_id;
		$temp->date=date('Y-m-d');
		$temp->leaveUsed=$appliedDays;
		$temp->leaveLeft=$transacdata->SL;
		$temp->save();
	}

	//saves leave transaction that is used/approve for vacation leave
	public static function trackLeaveVL($appliedDays,$transacdata){
		$temp = new TrackLeaveVl();
		$temp->user_id=$transacdata->user_id;
		$temp->date=date('Y-m-d');
		$temp->leaveUsed=$appliedDays;
		$temp->leaveLeft=$transacdata->VL;
		$temp->save();
	}

	public static function combiField($d1,$d2){
		return ($d1.' '.$d2);
	}

	//this will do the dtr 
	public static function performDTR($id,$time){
		$checkrec = Dtr::model()->findByAttributes(array('user_id'=>$id,'date'=>date('Y-m-d')));
		if($checkrec){
			$saveTime = Dtr::model()->findByPk($checkrec->id);
			if($time=="inam"){
				if(!$saveTime->inAM){
					//if(strtotime(date("Y-m-d") . date("G:i:s"))<=strtotime(date("Y-m-d") . "12:00:00")){
						
						$saveTime->inAM=time();
						if($saveTime->saveAttributes(array('inAM')))
							echo "Goodmorning! ";
						else
							echo "<strong style='color:red;'>Your Transaction wasn't save :( <br> Try again...</strong>";
					 // }
					 // else{
					 // 	echo "<strong style='color:red;'>Sorry<br> You cannot (AM) Log in with this time</strong>";
					 // }
				}
				else{
					echo "<strong style='color:red;'>Sorry<br> You cannot overwrite existing time record</strong>";
				}
			}
			elseif($time=="outam"){
				if(!$saveTime->outAM){
					//if(strtotime(date("Y-m-d") . date("G:i:s"))>=strtotime(date("Y-m-d") . "08:00:00")){
						$saveTime->outAM=time();
						if($saveTime->saveAttributes(array('outAM')))
							echo "Happy Lunch! ";
						else
							echo "<strong style='color:red;'>Your Transaction wasn't save :( <br> Try again...</strong>";
					 // }
					 // else{
						// echo "<strong style='color:red;'>Sorry<br> You cannot (AM) Log out with this time</strong>";
					 // }
				}
				else{
					echo "<strong style='color:red;'>Sorry<br> You cannot overwrite existing time record</strong>";
				}
			}
			elseif($time=="inpm"){
				if(!$saveTime->inPM){
					//if(strtotime(date("Y-m-d") . date("G:i:s"))<=strtotime(date("Y-m-d") . "17:00:00")){
						$saveTime->inPM=time();
						if($saveTime->saveAttributes(array('inPM')))
							echo "Good Afternoon! ";
						else
							echo "<strong style='color:red;'>Your Transaction wasn't save :( <br> Try again...</strong>";
					// }
					//  else{
					//  	echo "<strong style='color:red;'>Sorry<br> You cannot (PM) Log in with this time</strong>";
					//  }
				}
				else{
					echo "<strong style='color:red;'>Sorry<br> You cannot overwrite existing time record</strong>";
				}
			}
			elseif($time=="outpm"){
				if(!$saveTime->outPM){
					//if(strtotime(date("Y-m-d") . date("G:i:s"))>=strtotime(date("Y-m-d") . "13:00:00")){
						$saveTime->outPM=time();
						if($saveTime->saveAttributes(array('outPM')))
							echo "Bye Bye! ";
						else
							echo "<strong style='color:red;'>Your Transaction wasn't save :( <br> Try again...</strong>";
					 // }
					 // else{
					 // 	echo "<strong style='color:red;'>Sorry<br> You cannot (PM) Log out with this time</strong>";
					 // }
				}
				else{
					echo "<strong style='color:red;'>Sorry<br> You cannot overwrite existing time record</strong>";
				}
			}
			elseif($time=="inot"){
				if(!$saveTime->inOT){
					//check if they are authorized to have an OT
					$getauthorizedot = ReferOt::model()->findByAttributes(array('user_id'=>$id,'date'=>date('Y-m-d'))); 
					if($getauthorizedot){
						$saveTime->inOT=time();
						if($saveTime->saveAttributes(array('inOT')))
							echo "Happy Overtime :) ";
						else
							echo "<strong style='color:red;'>Your Transaction wasn't save :( <br> Try again...</strong>";
					}
					else{
						echo "<strong style='color:red;'>Sorry<br> You are not authorized to have an OT for today</strong>";
					}
				}
				else{
					echo "<strong style='color:red;'>Sorry<br> You cannot overwrite existing time record</strong>";
				}
			}
			elseif($time=="outot"){
				if(!$saveTime->outOT){
					//check if they are authorized to have an OT
					$getauthorizedot = ReferOt::model()->findByAttributes(array('user_id'=>$id,'date'=>date('Y-m-d'))); 
					if($getauthorizedot){
						$saveTime->outOT=time();
						if($saveTime->saveAttributes(array('outOT')))
							echo "Good Bye :) ";
						else
							echo "<strong style='color:red;'>Your Transaction wasn't save :( <br> Try again...</strong>";
					}
					else{
						echo "<strong style='color:red;'>Sorry<br> You are not authorized to have an OT for today</strong>";
					}
				}
				else{
					echo "<strong style='color:red;'>Sorry<br> You cannot overwrite existing time record</strong>";
				}
			}

		}
		else{
			$saveTime = new Dtr();
			$saveTime->user_id=$id;
			$saveTime->date=date('Y-m-d');
			//has to create new
			if($time=="inam"){
				//if(strtotime(date("Y-m-d") . date("G:i:s"))<=strtotime(date("Y-m-d") . "12:00:00")){
					$saveTime->inAM=time();
					if($saveTime->save())
						echo "Goodmorning! ";
					else
						echo "<strong style='color:red;'>Your Transaction wasn't save :( <br> Try again...</strong>";
				 // }
				 // else{
				 // 	echo "<strong style='color:red;'>Sorry<br> You cannot (AM) Log in with this time</strong>";
				 // }
			}
			elseif($time=="outam"){
				//if(strtotime(date("Y-m-d") . date("G:i:s"))>=strtotime(date("Y-m-d") . "08:00:00")){
					$saveTime->outAM=time();
					if($saveTime->save())
						echo "Happy Lunch! ";
					else
						echo "<strong style='color:red;'>Your Transaction wasn't save :( <br> Try again...</strong>";
				 // }
				 // else{
				 // 	echo "<strong style='color:red;'>Sorry<br> You cannot (AM) Log out with this time</strong>";
				 // }
			}
			elseif($time=="inpm"){
				//if(strtotime(date("Y-m-d") . date("G:i:s"))<=strtotime(date("Y-m-d") . "17:00:00")){
					$saveTime->inPM=time();
					if($saveTime->save())
						echo "Good Afternoon! ";
					else
						echo "<strong style='color:red;'>Your Transaction wasn't save :( <br> Try again...</strong>";
				 // }
				 // else{
				 // 	echo "<strong style='color:red;'>Sorry<br> You cannot (PM) Log in with this time</strong>";
				 // }
			}
			elseif($time=="outpm"){
				//if(strtotime(date("Y-m-d") . date("G:i:s"))>=strtotime(date("Y-m-d") . "13:00:00")){
					$saveTime->outPM=time();
					if($saveTime->save())
						echo "Bye Bye! ";
					else
						echo "<strong style='color:red;'>Your Transaction wasn't save :( <br> Try again...</strong>";
				 // }
				 // else{
				 // 	echo "<strong style='color:red;'>Sorry<br> You cannot (PM) Log out with this time</strong>";
				 // }
			}
			elseif($time=="inot"){
				if(!$saveTime->inOT){
					//check if they are authorized to have an OT
					$getauthorizedot = ReferOt::model()->findByAttributes(array('user_id'=>$id,'date'=>date('Y-m-d'))); 
					if($getauthorizedot){
						$saveTime->inOT=time();
						if($saveTime->save())
							echo "Happy Overtime :) ";
						else
							echo "<strong style='color:red;'>Your Transaction wasn't save :( <br> Try again...</strong>";
					}
					else{
						echo "<strong style='color:red;'>Sorry<br> You are not authorized to have an OT for today</strong>";
					}
				}
				else{
					echo "<strong style='color:red;'>Sorry<br> You cannot overwrite existing time record</strong>";
				}
			}
			elseif($time=="outot"){
				if(!$saveTime->outOT){
					//check if they are authorized to have an OT
					$getauthorizedot = ReferOt::model()->findByAttributes(array('user_id'=>$id,'date'=>date('Y-m-d'))); 
					if($getauthorizedot){
						$saveTime->outOT=time();
						if($saveTime->save())
							echo "Good Bye :) ";
						else
							echo "<strong style='color:red;'>Your Transaction wasn't save :( <br> Try again...</strong>";
					}
					else{
						echo "<strong style='color:red;'>Sorry<br> You are not authorized to have an OT for today</strong>";
					}
				}
				else{
					echo "<strong style='color:red;'>Sorry<br> You cannot overwrite existing time record</strong>";
				}
			}
		}
	}

	public static function test(){
		echo "employee detected";
	}

	public static function days_in_month($month, $year) 
	{ 
	// calculate number of days in a month 
	return $month == 2 ? ($year % 4 ? 28 : ($year % 100 ? 29 : ($year % 400 ? 28 : 29))) : (($month - 1) % 7 % 2 ? 30 : 31); 
	} 

	public static function joinTwoCol($first,$last){
		return $first." ".$last;
	}

	public static function getOwnerLeave(){
		$data = ReferLeave::model()->findByAttributes(array('user_id'=>Yii::app()->user->id));
		if($data)
			return $data;
		else
			return null;
	}

	public static function convertwhoswith($ids){
		$name=null;
		if($ids){
			foreach($ids as $id) {
				if($id){
				 $data = Profile::model()->findByPk($id);
				 $name = $name ." ".$data->firstname." ".$data->lastname.","; 
				}
			}
		}

		return $name;
		
	}

	public static function callaudit($module,$description){
		$audit = new Audit();
		$audit->module=$module;
		$audit->description=$description;
		$audit->save();
	}

	public static function creditterm($val){
		switch ($val) {
			case 1:
				# code...
				return "CTO";
				break;

			case 2:
				# code...
				return "Mandatory/Forced Leave";
				break;

			case 3:
				# code...
				return "Maternity/Paternity Leave";
				break;

			case 4:
				# code...
				return "Privelede/Special Leave";
				break;

			case 5:
				# code...
				return "Sick Leave";
				break;

			case 6:
				# code...
				return "Vacation Leave";
				break;
			
			default:
				# code...
				return "Error type of credit";
				break;
		}
	}
}
?>