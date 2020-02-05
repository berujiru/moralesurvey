<?php

/**
 * This is the model class for table "moraleconfig".
 *
 * The followings are the available columns in table 'moraleconfig':
 * @property integer $id
 * @property integer $user_id
 * @property integer $status
 * @property integer $division
 */
class Moraleconfig extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'moraleconfig';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, status, division', 'required'),
			array('user_id, status, division', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, user_id, status, division', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			//'position'=>array(self::BELONGS_TO,'Position','user_id'),
			'div' => array(self::BELONGS_TO, 'ReferDivision', 'division'),
			'user'=>array(self::BELONGS_TO,'User','user_id'),
			 //'user' = array(self::HAS_ONE, 'User', 'user_id'),
			 //'user'=>array(self::BELONGS_TO, 'User', 'user_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'user_id' => 'User',
			'status' => 'Status',
			'division' => 'Division',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('status',$this->status);
		$criteria->compare('division',$this->division);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Moraleconfig the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function getEmployee($divid,$status,$station = "4"){
		$ords=new CDbCriteria();
		$ords->select = "id";
		$ords->with=array("position","division","moraleconfig");
		$ords->condition="moraleconfig.division=".$divid." and position.position_type LIKE '%".$status."%' and moraleconfig.status=1 and division.station_id =".$station."";
		$ord_ids=User::model()->findAll($ords);
		return $ord_ids;
	}

	public function getEmployeeAR($divid,$status,$station = "4"){

		$ords=new CActiveDataProvider('User', array(
			'criteria'=>array(
				'with'=>array("position","moraleconfig","division"),
				'select'=>"id",
		        'condition'=>"`moraleconfig`.`division`=".$divid." and `position`.`position_type` LIKE '%".$status."%' and `moraleconfig`.`status`=1 and `division`.`station_id` =".$station."",
		    ),
		    'pagination'=>array(
		        'pageSize'=>100,
		    ),
		));


		// $ords=new CActiveDataProvider('Moraleconfig', array(
		// 	'criteria'=>array(
		// 		'with'=>array("position","divstation"),
		// 		'select'=>"user_id",
		//         'condition'=>"division=".$divid." and `position`.`position_type` LIKE '%".$status."%' and status=1 and `divstation`.`station_id` =".$station."",
		//     ),
		//     'pagination'=>array(
		//         'pageSize'=>50,
		//     ),
		// ));
		return $ords;
	}

	public function getEmployeeWS($divid,$status){
		$ords=new CDbCriteria();
		$ords->select = "id";
		$ords->with=array("position","moraleconfig");
		$ords->condition="moraleconfig.division=".$divid." and position.position_type = '".$status."' and moraleconfig.status=1";
		$ord_ids=User::model()->findAll($ords);
		return $ord_ids;
	} 


	public function getEmployeeARWS($divid,$status){

		$ords=new CActiveDataProvider('User', array(
			'criteria'=>array(
				'with'=>array("position","moraleconfig"),
				'select'=>"id",
		        'condition'=>"`moraleconfig`.`division`=".$divid." and `position`.`position_type` LIKE '%".$status."%' and `moraleconfig`.`status`=1",
		    ),
		    'pagination'=>array(
		        'pageSize'=>100,
		    ),
		));

		
		return $ords;
	}

	public function getAllEmployee($status){

		$ords=new CDbCriteria();
		$ords->select = "id";
		$ords->with=array("position","moraleconfig");
		$ords->condition="position.position_type like '%".$status."%' and moraleconfig.status=1";
		$ord_ids=User::model()->findAll($ords);
		return $ord_ids;
	}

	public function getAllEmployeeAR($status){
		$ords=new CActiveDataProvider('User', array(
			'criteria'=>array(
				'with'=>array("position","moraleconfig"),
				'select'=>"id",
		        'condition'=>"`position`.`position_type` LIKE '%".$status."%' and `moraleconfig`.`status`=1",
		    ),
		    'pagination'=>array(
		        'pageSize'=>100,
		    ),
		));
		return $ords;
	}


	public function getAllAR(){
		


		$criteria=new CDbCriteria;
		$criteria->with=array(
							'position','moraleconfig','moraleconfig.div');
		$criteria->together=true;
		//$criteria->group='moraleconfig.division';
		//$criteria->compare('t.id',$this->id);
		$criteria->order='moraleconfig.division ASC,position.position_type DESC';
		$criteria->condition="moraleconfig.status=1";
		//$criteria->pagination=false;

		return new CActiveDataProvider('User', array(
			'criteria'=>$criteria,
			'pagination'=>false,
		));


	}

	
}
