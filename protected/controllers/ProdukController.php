<?php

class ProdukController extends Controller
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
				'actions'=>array('index','view','create','admin','delete','update','items','edititem'),
				'expression'=>'$user->isSysAdmin() OR $user->isUmkm()',
				),
			array('allow',
				'actions'=>array('addToCart','PreCheckOut','checkout','removefromcart','removeitemfromcart'),
				'users'=>array('*')
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
		$model=new Produk;
		$item = new Items;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Produk']))
		{
			$model->attributes=$_POST['Produk'];
			$model->prod_umkm_id = Yii::app()->user->getUmkmId();
			
	 		
			if($model->save()){
				$uploadedFile = CUploadedFile::getInstance($model,'prod_img');
				if($uploadedFile !== null){ 
					$ext = $uploadedFile->getExtensionName();					
					if($ext == 'jpg' || $ext == 'png' || $ext == 'jpeg'){
						$uploadedFile->saveAs('./data/'.$model->prod_umkm_id.$model->prod_kat_id.$model->prod_id.'.'.$ext);
						$model->prod_img = $model->prod_umkm_id.$model->prod_kat_id.$model->prod_id.'.'.$ext;
						$model->save();
					}else{
						$model->addError('prod_img','Gambar harus berformat jpeg/png');
						$this->render('create',array(
							'model'=>$model,
							'kategori'=>$kategori,));
						exit;
					}
				}

				Yii::app()->user->setFlash('info','Produk telah disimpan');
				$this->redirect(array('view','id'=>$model->prod_id));
			}
		}

		$kategori = Kategoriproduk::model()->getListAsArray();

		$this->render('create',array(
			'model'=>$model,
			'kategori'=>$kategori,
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
		if($model->prod_umkm_id != Yii::app()->user->getUmkmId())
		{
			Yii::app()->user->setFlash('info','Unauthorized Access, redirected.');
			$this->redirect($this->createUrl('produk/admin'));
			Yii::app()->end();
		}

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Produk']))
		{
			if($_POST['Produk']['prod_img'] == '')
				unset($_POST['Produk']['prod_img']);
			
			$model->attributes=$_POST['Produk'];
			if($model->save())
				$uploadedFile = CUploadedFile::getInstance($model,'prod_img');
			if($uploadedFile !== null){ 
				if($uploadedFile->getExtensionName() == 'jpg' || $uploadedFile->getExtensionName() == 'png' || $uploadedFile->getExtensionName() == 'jpeg'){
					$uploadedFile->saveAs('./data/'.$model->prod_umkm_id.$model->prod_kat_id.$model->prod_id.'.'.$uploadedFile->getExtensionName());
					$model->prod_img = $model->prod_umkm_id.$model->prod_kat_id.$model->prod_id.'.'.$uploadedFile->getExtensionName();
					$model->save();
				}else{
					$model->addError('prod_img','Gambar harus berformat jpeg/png');
					$this->render('create',array(
						'model'=>$model,
						'kategori'=>$kategori,));
					exit;
				}
			}


			Yii::app()->user->setFlash('info','Produk telah disimpan');
			$this->redirect(array('view','id'=>$model->prod_id));
		}

		$kategori = Kategoriproduk::model()->getListAsArray();

		$this->render('update',array(
			'model'=>$model,
			'kategori'=>$kategori,
			));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$model = $this->loadModel($id);
		if($model->prod_umkm_id == Yii::app()->user->getUmkmId()){
			try{
				$model->delete();
			}
			catch(CDbException $e){
				throw new CHttpException(500,"Produk ini tidak bisa dihapus karena telah ditransaksikan	");

			}
		}else if(Yii::app()->user->isSysAdmin()){
			try{
				$model->delete();
			}
			catch(CDbException $e){
				throw new CHttpException(500,"Produk ini tidak bisa dihapus karena telah ditransaksikan	");

			}
		}

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Produk');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
			));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Produk('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Produk']))
			$model->attributes=$_GET['Produk'];

		$this->render('admin',array(
			'model'=>$model,
			));
	}

	public function actionItems(){
		$model=new Items('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Items']))
			$model->attributes=$_GET['Items'];

		$this->render('items',array(
			'model'=>$model,
			));
	}

	public function actionEditItem(){
		if(isset($_GET['id'])){
			$model = Items::model()->with(
				array(
					'itemProd'=>array(
						'condition'=>'prod_umkm_id='.Yii::app()->user->getUmkmId())))->findByPk($_GET['id']);	
			if($model === null)
				throw new CHttpException(404, "Produk Not Found");	

			if(isset($_POST['Items']['item_stok'])){
				$model->item_stok = $_POST['Items']['item_stok'];
				if($model->save()){
					print '<script>';
					print '$.fn.yiiGridView.update("produk-grid");';
					print '$(\'#myModal\').modal(\'hide\');';
					print '</script>';
					exit();
				}
			}

			$this->renderPartial('_edititem',array('model'=>$model));	
		}
	}

	public function actionAddToCart(){
		$cart = new Keranjang;
		$umkmCart = new umkmCart;

		if(isset($_GET['id'])){
			$model = Produk::model()->findByPk($_GET['id']);	
			if($model === null)
				throw new CHttpException(404, "Produk Not Found");	
		}else if(isset($_POST['item_qty'])){

			$model = Produk::model()->findByPk($_POST['item_prod_id']);	

			$cart->krj_item_id = $_POST['item_prod_id'];
			$cart->krj_qty = $_POST['item_qty'];
			$cart->krj_session = $umkmCart->getCartCookie();
			if($cart->save()){
				Yii::app()->user->setFlash('info','Produk telah ditambahkan kedalam keranjang.');
				print '<script type="text/javascript"> location.reload(); </script>';
				Yii::app()->end();
			}
			else{
				$this->renderPartial('addtocart',array('model'=>$model,'cart'=>$cart,''));
				Yii::app()->end();	
			}
		}
		else{
			throw new CHttpException(212, "Very bad request, don't trick me");
		}
		
		$this->renderPartial('addtocart',array('model'=>$model,'cart'=>$cart,''));
	}

	public function actionPreCheckout(){
		// sleep(1);
		// $criteria = new CDbCriteria;
		// $criteria->alias = 'k';
		// $criteria->join = 'JOIN produk p ON p.prod_id = k.krj_item_id JOIN umkm u ON u.umkm_id = p.prod_umkm_id';
		// $criteria->group = 'u.umkm_id';
		// $criteria->condition = 'k.krj_session = \''.$this->cart.'\'';
		// $criteria->select = array('u.umkm_id','u.umkm_nama','SUM(k.krj_qty) as qty');

		$status = Keranjang::STATUS_ADD;
		$conn = Yii::app()->db;
		$sql = 'SELECT u.umkm_nama,u.umkm_id,SUM(k.krj_qty) as qty FROM `keranjang` `k` JOIN produk p ON p.prod_id = k.krj_item_id JOIN umkm u ON u.umkm_id = p.prod_umkm_id WHERE k.krj_session = :session AND k.krj_status = :status GROUP BY u.umkm_id';
		$command = $conn->createCommand($sql);
		$command->bindParam(':session',$this->cart);
		$command->bindParam(':status', $status);
		$model = $command->query();


		//$model = Keranjang::model()->findAll('krj_session = :cookie',array(':cookie'=>$this->cart));
		//$model = Keranjang::model()->findAll($criteria);
		$this->renderPartial('precheckout',array('model'=>$model));
	}

	public function actionCheckOut($id=null){
		/*
			Menampilkan daftar produk yang berada dikeranjang yang berasal dari satu umkm saja, jadi produk dikeranjang di checkout per umum, karena tiap umkm memiliki mekanisme pembayaran yang bisa saja unik
		*/

		$id = ($id !== null)? $id : $_GET['id'];
		// $id = (isset($_GET['id']))? $_GET['id'] : $id;

		$umkm = Umkm::model()->findByPk($id);
		if($umkm === null)
			throw new CHttpException(404,"Maaf, halaman yang anda cari tidak ditemukan :(");
			

		$status = Keranjang::STATUS_ADD;
		$conn = Yii::app()->db;
		$sql = 'SELECT k.krj_id,k.krj_item_id, p.prod_nama, u.umkm_id, SUM(k.krj_qty) as qty FROM `keranjang` `k` JOIN produk p ON p.prod_id = k.krj_item_id JOIN umkm u ON u.umkm_id = p.prod_umkm_id WHERE k.krj_session = :session AND u.umkm_id = :umkmid AND k.krj_status = :status GROUP BY k.krj_item_id';
		$command = $conn->createCommand($sql);
		$command->bindParam(':session',$this->cart);
		$command->bindParam(':umkmid',$id);
		$command->bindParam(':status', $status);
		$model = $command->query();

		$this->renderPartial('checkout',array('model'=>$model,'umkm'=>$umkm));
	}

	public function checkOut(){
		
	}

	public function actionRemoveFromCart(){
		if(isset($_GET['id']))
			$this->removeFromCart(trim($_GET['id']));
		else
			throw new CHttpException(212,"Error Processing Request");
			
	}

	public function actionRemoveItemFromCart(){
		$id = (isset($_GET['id'])? trim($_GET['id']): null);
		$this->removeItemFromCart($id);
		$this->actionCheckOut($_GET['umkmid']);
	}

	private function removeItemFromCart($id=null){
		// $id disini krj_item_id
		$status = Keranjang::STATUS_CANCELED;
		Keranjang::model()->updateAll(array('krj_status'=> $status),'krj_item_id = :id AND krj_session = :session',array(
			':id'=>$id,
			':session'=>$this->cart));
		return true;
	}

	private function removeFromCart($id=null){
		// $id disini adalah umkm_id
		$conn = Yii::app()->db;
		$sql = 'SELECT k.krj_id,k.krj_item_id, p.prod_nama FROM `keranjang` `k` JOIN produk p ON p.prod_id = k.krj_item_id JOIN umkm u ON u.umkm_id = p.prod_umkm_id WHERE k.krj_session = :session AND u.umkm_id = :umkmid AND k.krj_status = :status';

		$arrId 	 = array();
		$status = Keranjang::STATUS_ADD;
		$command = $conn->createCommand($sql);
		$command->bindParam(':session',$this->cart);
		$command->bindParam(':umkmid',$id);
		$command->bindParam(':status',$status);
		$model = $command->query();
		if($model->count() <= 0)
			throw new CHttpException(444,"Please don't trick me. :P");

		foreach ($model as $key => $value) {
			$arrId[] = $value['krj_id'];
		}

		$criteria = new CDbCriteria;
		$criteria->addInCondition('krj_id',$arrId);
		$krj = Keranjang::model()->updateAll(array('krj_status'=> Keranjang::STATUS_CANCELED), $criteria);
		$this->actionPreCheckOut($id);

	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Produk the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Produk::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Produk $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='produk-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
