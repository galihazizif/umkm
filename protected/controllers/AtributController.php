<?php

class AtributController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
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
				'actions'=>array('create','update','admin','xdelete','createrekening'),
				'expression'=>'$user->isUmkm() OR $user->isSysAdmin',
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
		$model=new Atribut;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Atribut']))
		{
			$model->attributes=$_POST['Atribut'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->at_id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	public function actionCreateRekening()
	{
		$model=new Atribut;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Atribut']))
		{
			$model->attributes=$_POST['Atribut'];
			$model->at_umkm_id = Yii::app()->user->getUmkmId();
			if($model->save()){
				$model->unsetAttributes();
				Yii::app()->user->setFlash('info','Rekening berhasil ditambahkan');
				echo '<script>';
				echo 'window.location.hash="#trekening";';
				echo 'window.location.reload();';
				echo '</script>';
				exit();
			}
		}

		$daftarBanks = Kategoriatribut::model()->findAll(array('condition'=>'ka_id LIKE \'R.%\''));
		foreach ($daftarBanks as $row) {
			$daftarBank[$row->ka_id] = $row->ka_nama;	
		}

		$this->renderPartial('createrekening',array(
			'model'=>$model,
			'daftarBank'=>$daftarBank,
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

		if(isset($_POST['Atribut']))
		{
			$model->attributes=$_POST['Atribut'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->at_id));
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
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('controlpanel/index/#trekening'));
	}

	public function actionXdelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('controlpanel/index/#trekening'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Atribut');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Atribut('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Atribut']))
			$model->attributes=$_GET['Atribut'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Atribut the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Atribut::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Atribut $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='atribut-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
