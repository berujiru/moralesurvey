<?php

/**
 * This is the model class for table "refer_division".
 *
 * The followings are the available columns in table 'refer_division':
 * @property integer $refer_id
 * @property string $division_code
 * @property string $division_name
 * @property integer $assigned
 */
class ReferDivision extends CActiveRecord
{
	public $user_search;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'refer_division';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('division_code, division_name, assigned', 'required'),
			array('assigned', 'numerical', 'integerOnly'=>true),
			array('division_code', 'length', 'max'=>20),
			array('division_name', 'length', 'max'=>200),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('refer_id, division_code, division_name, user_search', 'safe', 'on'=>'search'),
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
			'profile'=>array(self::BELONGS_TO,'Profile','assigned'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'refer_id' => 'Refer',
			'division_code' => 'Division Code',
			'division_name' => 'Division Name',
			'assigned' => 'Assigned',
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
		$criteria->with = array( 'profile' );
		$criteria->compare('refer_id',$this->refer_id);
		$criteria->compare('division_code',$this->division_code,true);
		$criteria->compare('division_name',$this->division_name,true);
		// $criteria->compare('assigned',$this->assigned);
		//$criteria->compare('profile.employee_id',$this->user_search,true);
		$criteria->compare( 'profile.employee_id', $this->user_search, true );
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'sort'=>array(
		        'attributes'=>array(
		            'salary_search'=>array(
		                'asc'=>'profile.employee_id',
		                'desc'=>'profile.employee_id DESC',
		            ),
		            '*',
		        ),
		    ),
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ReferDivision the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
