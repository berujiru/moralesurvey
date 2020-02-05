<?php

/**
 * This is the model class for table "announcement".
 *
 * The followings are the available columns in table 'announcement':
 * @property integer $id
 * @property string $datefiled
 * @property string $datedisplayfrom
 * @property string $datedisplayto
 * @property string $description
 * @property integer $announceby
 */
class Announcement extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'announcement';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('datedisplayfrom, datedisplayto, description', 'required'),
			array('announceby', 'numerical', 'integerOnly'=>true),
			array('datefiled', 'length', 'max'=>50),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, datefiled, datedisplayfrom, datedisplayto, description, announceby', 'safe', 'on'=>'search'),
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
			'profile'=>array(self::BELONGS_TO,'Profile','announceby'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'datefiled' => 'Datefiled',
			'datedisplayfrom' => 'Date display from',
			'datedisplayto' => 'Date display to',
			'description' => 'Description',
			'announceby' => 'Announceby',
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
		$criteria->compare('datefiled',$this->datefiled,true);
		$criteria->compare('datedisplayfrom',$this->datedisplayfrom,true);
		$criteria->compare('datedisplayto',$this->datedisplayto,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('announceby',$this->announceby);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Announcement the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function beforeSave()
	{
	    $this->announceby = Yii::app()->user->id;
	    $this->datefiled = new CDbExpression('NOW()');

    	return parent::beforeSave();
	}
}
