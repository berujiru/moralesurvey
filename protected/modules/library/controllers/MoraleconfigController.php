<?php

class MoraleconfigController extends RController
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column1';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			// 'accessControl', // perform access control for CRUD operations
			// 'postOnly + delete', // we only allow deletion via POST request
			'rights',
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
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Moraleconfig;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Moraleconfig']))
		{
			$model->attributes=$_POST['Moraleconfig'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Moraleconfig']))
		{
			$model->attributes=$_POST['Moraleconfig'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		// $dataProvider=new CActiveDataProvider('Moraleconfig');
		// $this->render('index',array(
		// 	'dataProvider'=>$dataProvider,
		// ));
		$Users = User::model()->with(array('moraleconfig'))->findAll(); //fetch all user

		$configs = Moraleconfig::model()->findAll(); //fetch all the morale config of users


		$this->render('index',array(
		 	'Users'=>$Users,
		 	'configs'=>$configs,
		 ));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Moraleconfig('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Moraleconfig']))
			$model->attributes=$_GET['Moraleconfig'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Moraleconfig the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Moraleconfig::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Moraleconfig $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='moraleconfig-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

	public function actionAnswer($user_id,$status){
		//check if there is any existing record if true update if false then create new
		$record = Moraleconfig::model()->findbyAttributes(array('user_id'=>$user_id));
		if($record){
			$record->status=$status;
			$record->save(false);
			echo "updated record";
		}else{
			$model=new Moraleconfig;
			$model->user_id = $user_id;
			$model->status = $status;
			$model->division = 3;
			$model->save(false);
			echo "created new record, please select the division again (for  php7+ version)";
		}
	}

	public function actionDivision($user_id){
		//check if there is any existing record if true update if false then create new
		// var_dump($_POST); exit;
		
		//echo $division;
		$record = Moraleconfig::model()->findbyAttributes(array('user_id'=>$user_id));
		if($record){
			$division = $_POST['division'];
			$record->division=$division;
			$record->save(false);
			echo "Record updated";
		}else{
			$model=new Moraleconfig;
			$model->user_id = $user_id;
			$model->division = 3;
			$model->status =1;
			$model->save(false);
			echo "created new record, please select the division again (for  php7+ version)";
		}
	}
}
