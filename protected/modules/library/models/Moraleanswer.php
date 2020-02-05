<?php

/**
 * This is the model class for table "moraleanswer".
 *
 * The followings are the available columns in table 'moraleanswer':
 * @property integer $id
 * @property integer $user_id
 * @property integer $survey_id
 * @property string $date
 * @property integer $question
 * @property string $answer
 */
class Moraleanswer extends CActiveRecord
{
	public $user_search;
	public $myquestion;
	public $mydiv;
	public $division_name;
	public $position;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'moraleanswer';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, survey_id, date, question, answer', 'required'),
			array('user_id, survey_id, question', 'numerical', 'integerOnly'=>true),
			array('answer', 'length', 'max'=>5),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, user_search, position, division_name, mydiv, myquestion, user_id, survey_id, date, question, answer', 'safe', 'on'=>'search'),
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
			'user'=>array(self::BELONGS_TO,'User','user_id'),
			'profile' => array(self::BELONGS_TO, 'Profile', 'user_id'),
			'moraleposition' => array(self::BELONGS_TO, 'Position', '', 'on'=>'t.user_id = moraleposition.user_id'),
			//'moralequestion' => array(self::BELONGS_TO, 'Moralequestions', 'question'),
			'moraledivision'=>array(self::BELONGS_TO, 'Division', '', 'on'=>'t.user_id = moraledivision.user_id'),
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
			'survey_id' => 'Survey',
			'date' => 'Date',
			'question' => 'Question',
			'answer' => 'Answer',
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
		// $criteria->with = array( 'profile','moralequestion','moraledivision','moraledivision.division','moraleposition' );
		$criteria->with = array( 'profile','moraledivision','moraledivision.division','moraleposition' );
		$criteria->compare('id',$this->id);
		$criteria->compare('profile.employee_id', $this->user_search, true );
		$criteria->compare('moraleposition.position_type', $this->position, true );
		$criteria->compare('moraledivision.division_id', $this->mydiv, true );
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('survey_id',$this->survey_id);
		$criteria->compare('date',$this->date,true);
		$criteria->compare('question',$this->question);
		//$criteria->compare('moralequestion.question', $this->myquestion, true );
		$criteria->compare('division.division_name',$this->division_name,true);
		$criteria->compare('answer',$this->answer);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Moraleanswer the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function getAnswer($kid,$key,$msId){
		//return $kid;
		$num = Moraleanswer::model()->findAllByAttributes(array('answer'=>$key,'user_id'=>$kid,'survey_id'=>$msId));
		//print_r($num); exit();
		$num = count($num);
		return $num;
	}

	public function getTotalanswer($kid,$msId){
		//return $kid;
		$num = Moraleanswer::model()->findAllByAttributes(array('user_id'=>$kid,'survey_id'=>$msId));
		//print_r($num); exit();
		$num = count($num);
		return $num;
	}

	public function getIndex($kid,$msId){
		$num = Moraleanswer::model()->findAllByAttributes(array('user_id'=>$kid,'survey_id'=>$msId));
		$total = count($num)*4;
		$num = Moraleanswer::model()->findAllByAttributes(array('user_id'=>$kid,'answer'=>'N','survey_id'=>$msId));
		$n = count($num)*1;
		$num = Moraleanswer::model()->findAllByAttributes(array('user_id'=>$kid,'answer'=>'NS','survey_id'=>$msId));
		$ns = count($num)*2;
		$num = Moraleanswer::model()->findAllByAttributes(array('user_id'=>$kid,'answer'=>'Y','survey_id'=>$msId));
		$y = count($num)*3;
		$num = Moraleanswer::model()->findAllByAttributes(array('user_id'=>$kid,'answer'=>'DY','survey_id'=>$msId));
		$dy =count($num)*4;
		
		if($total==0){
			return 0;
		}
		else{
			$index = (($n + $ns + $y + $dy)/$total)*100;
			return $index;
		}
		
	}

	public function getSummary($ids,$key,$msId){
		//print_r($ids); exit();
		$ctr = 0;
		foreach ($ids as $pid) {
			$num = Moraleanswer::model()->findAllByAttributes(array('user_id'=>$pid->id,'answer'=>$key,'survey_id'=>$msId));
			$ctr += count($num);
		}
		return $ctr;
	}

	public function getAverage($ids,$msId){
		//print_r($ids); exit();
		$ctr = 0;
		$num = 0;
		foreach ($ids as $pid) {
			//return $this->getIndex($pid->user_id); 
			$ctr++;
			$num += $this->getIndex($pid->id,$msId);
		}
		if($ctr==0)
			return 0;
		else{
			$num = $num / $ctr;
			// return round($ctr, 2);
		}

		return round($num,2);
		// return ($num / $ctr);
	}

	public  function getQuestion($id){
		//echo $id;
		$myquestion = Moralequestions::model()->findByPk($id);
		if($myquestion)
			return $myquestion->question;
		else
			return false;
	}
	
}
