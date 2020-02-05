<?php

class AdminController extends Controller
{
	public $defaultAction = 'admin';
	public $layout='//layouts/column2';
	
	private $_model;

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return CMap::mergeArray(parent::filters(),array(
			'accessControl', // perform access control for CRUD operations
		));
	}
	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete','create','update','view','getPosition'),
				'users'=>UserModule::getAdmins(),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new User('search');
        $model->unsetAttributes();  // clear any default values
        if(isset($_GET['User']))
            $model->attributes=$_GET['User'];

        $this->render('index',array(
            'model'=>$model,
        ));
		/*$dataProvider=new CActiveDataProvider('User', array(
			'pagination'=>array(
				'pageSize'=>Yii::app()->controller->module->user_page_size,
			),
		));

		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));//*/
	}


	/**
	 * Displays a particular model.
	 */
	public function actionView()
	{
		$model = $this->loadModel();
		$this->render('view',array(
			'model'=>$model,
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new User;
		$profile=new Profile;
		$position = new Position;
		$division = new Division;
		$this->performAjaxValidation(array($model,$profile,$position,$division));
		if(isset($_POST['User']))
		{
			$model->attributes=$_POST['User'];
			$model->activkey=Yii::app()->controller->module->encrypting(microtime().$model->password);
			$profile->attributes=$_POST['Profile'];
			$profile->user_id=0;
			$position->attributes=$_POST['Position'];
			$position->user_id=0;
			$division->attributes=$_POST['Division'];
			$division->user_id=0;
			if($model->validate()&&$profile->validate()&&$position->validate()&&$division->validate()) {
				$model->password=Yii::app()->controller->module->encrypting($model->password);
				if($model->save()) {
					$profile->user_id=$model->id;
					$profile->save();

					$position->user_id=$model->id;
					$position->save();

					$division->user_id=$model->id;
					$division->save();

					//added to assign default Role
					$authorizer = Yii::app()->getModule("rights")->getAuthorizer();
					//$authorizer->authManager->assign('Data Encoder', $model->id);
					$authorizer->authManager->assign($_POST['accesslevel'], $model->id);
				}
				$this->redirect(array('view','id'=>$model->id));
			} else if($profile->validate()){}
				else if($position->validate()){}
					else $division->validate();
		}

		$this->render('create',array(
			'model'=>$model,
			'profile'=>$profile,
			'position'=>$position,
			'division'=>$division,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionUpdate()
	{
		$model=$this->loadModel();
		$profile=$model->profile;
		$position = $model->position;
		$division = $model->division;
		$this->performAjaxValidation(array($model,$profile));
		if(isset($_POST['User']))
		{
			$model->attributes=$_POST['User'];
			$profile->attributes=$_POST['Profile'];
			$position->attributes=$_POST['Position'];
			$division->attributes=$_POST['Division'];
			
			if($model->validate()&&$profile->validate()&&$position->validate()&&$division->validate()) {
				$old_password = User::model()->notsafe()->findByPk($model->id);
				if ($old_password->password!=$model->password) {
					$model->password=Yii::app()->controller->module->encrypting($model->password);
					$model->activkey=Yii::app()->controller->module->encrypting(microtime().$model->password);
				}
				$model->save();
				$profile->save();
				$position->save();
				$division->save();
				$this->redirect(array('view','id'=>$model->id));
			} else $profile->validate();
		}

		$this->render('update',array(
			'model'=>$model,
			'profile'=>$profile,
			'position'=>$position,
			'division'=>$division,
		));
	}


	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 */
	public function actionDelete()
	{
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$model = $this->loadModel();
			$profile = Profile::model()->findByPk($model->id);
			$position = Position::model()->findbyAttributes(array('user_id'=>$model->id));
			$division = Division::model()->findbyAttributes(array('user_id'=>$model->id));

			$position->delete();
			$division->delete();
			$profile->delete();
			$model->delete();
			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_POST['ajax']))
				$this->redirect(array('/user/admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}
	
	/**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($validate)
    {
        if(isset($_POST['ajax']) && $_POST['ajax']==='user-form')
        {
            echo CActiveForm::validate($validate);
            Yii::app()->end();
        }
    }
	
	
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 */
	public function loadModel()
	{
		if($this->_model===null)
		{
			if(isset($_GET['id']))
				$this->_model=User::model()->notsafe()->findbyPk($_GET['id']);
			if($this->_model===null)
				throw new CHttpException(404,'The requested page does not exist.');
		}
		return $this->_model;
	}

	function actionGetPosition(){
	//please enter current controller name because yii send multi dim array 
		if(isset($_POST['Position']['position_type']))
			$posMethod = $_POST['Position']['position_type'];
		
		if(($posMethod=='contractual')||($posMethod=='project_base')){
			$dataThis = ReferPositionContract::model()->findAll(array('order'=>'position_name'));
		
			$data = CHtml::listData($dataThis,'refer_id','position_name');
		} elseif($posMethod=='regular') {
			$dataThis = ReferPositionPlantilla::model()->findAll(array('condition'=>'isOccupied=0','order'=>'plantillaItemNumber'));
		
			$data = CHtml::listData($dataThis,'plantillaItemNumber','plantillaItemNumber');
		}elseif($posMethod=='ojt') {
			$data = array('Ojt'=>'OJT');
		}
		 else{
			$data = array('Jo'=>'JobOrder');
		}


		
		//append blank
		echo CHtml::tag('option', array('value'=>''),CHtml::encode(null),true);
		
		foreach($data as $value=>$name)
		{
			echo CHtml::tag('option',
					   array('value'=>$value),CHtml::encode($name),true);
		}
	
	}
	
}