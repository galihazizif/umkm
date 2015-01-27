<?php

class UController extends Controller
{	
	public $styler = array();
	protected $halaman;

	public $layout = '//layouts/single.uview';

	public function init(){

		//karena init di override maka manggil fungsi buat generate cookie id lagi
		$c = new umkmCart();
		$this->cart = $c->getCartCookie();

		$this->halaman = Pages::model()->with(array(
			'pUmkm'=>array(
				'condition'=>'umkm_alias = \''.$_GET['a'].'\'',
				'select'=>false)))->findAll(array(
		'select'=>array('p_judul','p_alias'),
		'condition'=>'p_status = '.Pages::STATUS_PUBLISHED));
		$style = Kustomisasi::model()->with(array(
			'kusUmkm'=>array(
				'condition'=>'umkm_alias = \''.$_GET['a'].'\'',
				'select'=>false)))->find(array(
		'select'=>array('kus_background')));

		$this->styler = $style->kus_background;
	
	}

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
				'actions'=>array('finalcheckout'),
				'expression'=>'$user->isPengunjung()',
				),
			array('deny',  // deny all users
				'actions'=>array('finalcheckout'),
				'users'=>array('*'),
				),
			);
	}

	public function actionSearch(){

		if(isset($_GET['a'])){
			$umkm = Umkm::model()->find('umkm_alias = ? AND umkm_status != '.Umkm::STATUS_SUSPENDED,array($_GET['a']));
			if($umkm === null){
				throw new CHttpException(404,'Produk tidak ditemukan');
				Yii::app()->end();
			}
		}

		$criteria=new CDbCriteria;

		if(isset($_GET['q'])){
			$q = trim($_GET['q']);
			$queries = explode(' ',$q);

			/*Metode searching al-watoniyah*/
			$criteria->addSearchCondition('prod_nama',$q,true,'OR');
			$criteria->addSearchCondition('prod_deskripsi',$q,true,'OR');		
			foreach ($queries as $key => $value) {
				$criteria->addSearchCondition('prod_nama',$value,true,'OR');								
			}
		}

		$criteria->addCondition("prod_umkm_id =".$umkm->umkm_id);
		$criteria->order = "prod_id DESC";

		if(isset($_GET['q'])){
			if(trim($_GET['q']) == '')
				$criteria->condition = "prod_nama = ''";
		}

		$dp = new CActiveDataProvider('Produk', array(
			'criteria'=>$criteria,
			'pagination'=>array(
				'pageSize'=>4)
		));	

		$this->render('search',array('dataProvider'=>$dp,'umkm'=>$umkm,'q'=>$q));		
		
	}

	public function action1(){
		if(isset($_GET['a'])){
			$umkm = Umkm::model()->find('umkm_alias = ? AND umkm_status !='.Umkm::STATUS_SUSPENDED,array($_GET['a']));
			if($umkm === null){
				throw new CHttpException(404,'UMKM tidak ditemukan');
				Yii::app()->end();
			}
		}else{
			$umkm = null;
			throw new CHttpException(404,'Produk tidak ditemukan');
			Yii::app()->end();
		}

			$dataProvider = new CActiveDataProvider('Produk',
			array(
				'pagination'=>array(
					'pageSize'=>4),
				'criteria'=>array(
					'order'=>'prod_id DESC',
					'condition'=>'prod_umkm_id = '.$umkm->umkm_id))
			);

		$this->render('search',array('umkm'=>$umkm,'dataProvider'=>$dataProvider));		
	}

	public function actionDetail(){

		if(isset($_GET['a'])){
			$umkm = Umkm::model()->find('umkm_alias = ? AND umkm_status !='.Umkm::STATUS_SUSPENDED,array($_GET['a']));
			if($umkm === null){
				throw new CHttpException(404,"UMKM tidak ditemukan");
				Yii::app()->end();
			}
		}

		$model = Produk::model()->find('prod_id = :id AND prod_umkm_id = :umkm',array(
			':id'=>$_GET['detail'],
			':umkm'=> $umkm->umkm_id,));
		if($model === null)
			throw new CHttpException(404,'Produk tidak ditemukan');
			

		$this->render('detail',array('umkm'=>$umkm,'model'=>$model));			


	}

	public function actionPages(){		
		$id = $_GET['a'];
		$page = urldecode($_GET['p']);
		$umkm = Umkm::model()->find('umkm_alias = ? AND umkm_status !='.Umkm::STATUS_SUSPENDED,array($id));
		if($umkm === null)
			throw new CHttpException(404,"Maaf, halaman yang anda cari tidak ditemukan :(");

		$model = Pages::model()->with(array(
			'pUmkm'=>array(
				'condition'=>'umkm_alias = \''.$id.'\'')))->find('p_alias = ?',array($page));

		
		$this->render('page',array('umkm'=>$umkm, 'model'=>$model));
	}

	public function actionCheckOut($id=null){
		$id = ($id !== null)? $id : $_GET['a'];
		// $id = (isset($_GET['id']))? $_GET['id'] : $id;

		$umkm = Umkm::model()->find('umkm_alias = ? AND umkm_status !='.Umkm::STATUS_SUSPENDED,array($id));
		if($umkm === null)
			throw new CHttpException(404,"Maaf, halaman yang anda cari tidak ditemukan :(");
			

		$status = 0;
		$conn = Yii::app()->db;
		$sql = 'SELECT k.krj_id,k.krj_item_id, i.item_stok - SUM(k.krj_qty) as sisa, i.item_stok, p.prod_nama, p.prod_harga, p.prod_satuan, (SUM(k.krj_qty) * p.prod_harga) as jumlah_harga, p.prod_satuan, u.umkm_id, SUM(k.krj_qty) as qty FROM `keranjang` `k` JOIN produk p ON p.prod_id = k.krj_item_id JOIN items i ON p.prod_id = i.item_prod_id JOIN umkm u ON u.umkm_id = p.prod_umkm_id WHERE k.krj_session = :session AND u.umkm_alias = :umkmid AND k.krj_status = :status GROUP BY k.krj_item_id';
		$command = $conn->createCommand($sql);
		$command->bindParam(':session',$this->cart);
		$command->bindParam(':umkmid',$id);
		$command->bindParam(':status', $status);
		$model = $command->query();

		$sql1 = 'SELECT (SUM(k.krj_qty) * p.prod_harga) as harga_total FROM `keranjang` `k` JOIN produk p ON p.prod_id = k.krj_item_id JOIN umkm u ON u.umkm_id = p.prod_umkm_id WHERE k.krj_session = :session AND u.umkm_alias = :umkmid AND k.krj_status = :status GROUP BY k.krj_item_id';

		$command1 = $conn->createCommand($sql1);
		$command1->bindParam(':session',$this->cart);
		$command1->bindParam(':umkmid',$id);
		$command1->bindParam(':status', $status);
		$model1 = $command1->query();

		$jml = 0;
		foreach ($model1->readAll() as $key => $value) {
			$jml = $value['harga_total'] + $jml;
		}

		$visitor = null;
		if(Yii::app()->user->isPengunjung()){
			$visitor = Pengunjung::model()->findByPk(Yii::app()->user->_getId());	
		}

		// Karena arsitektur aplikasi mandan acak2, jadi buat simpan url pake flash
		Yii::app()->user->setFlash('url',$this->createUrl('u/checkout',array('a'=>$umkm->umkm_alias)));
		Yii::app()->user->setReturnUrl($this->createUrl('u/checkout',array('a'=>$umkm->umkm_alias)));

		$this->render('checkout',array('model'=>$model,'umkm'=>$umkm,'harga_total'=>$jml,'visitor'=>$visitor));
	}

	public function actionFinalCheckOut($id=null){

		$id = ($id !== null)? $id : $_GET['a'];
		// $id = (isset($_GET['id']))? $_GET['id'] : $id;

		$umkm = Umkm::model()->find('umkm_alias = ?',array($id));
		if($umkm === null)
			throw new CHttpException(404,"Maaf, halaman yang anda cari tidak ditemukan :(");

		$stat_akhir = Keranjang::STATUS_CHECKEDOUT;
		$stat_awal  = Keranjang::STATUS_ADD;
		$pgj_id 	= Yii::app()->user->_getId();

		$conn = Yii::app()->db;

		$kodetrans = time().substr(microtime(),2,4).'-'.$pgj_id;

		$trans = $conn->beginTransaction();
		try{
			//mengapa diperlukan juga umkm id, karena setiap checkout hanya untuk 1 umkm.
			$sql = 'UPDATE keranjang k,produk p, umkm u SET k.krj_status = :newstatus WHERE p.prod_id = k.krj_item_id AND u.umkm_id = p.prod_umkm_id AND k.krj_session = :session AND u.umkm_alias = :umkmid AND k.krj_status = :status';
			// $sql2 = 'INSERT INTO transaksi (trans_pgj_id,trans_item_id,trans_tanggal,trans_status,trans_qty) SELECT :pgjid,k.krj_item_id, :tanggal, 1, IF(i.item_stok - SUM(k.krj_qty) < 0, i.item_stok, SUM(k.krj_qty)) as qty FROM `keranjang` `k` JOIN produk p ON p.prod_id = k.krj_item_id JOIN items i ON p.prod_id = i.item_prod_id JOIN umkm u ON u.umkm_id = p.prod_umkm_id WHERE k.krj_session = :session AND u.umkm_alias = :umkmid AND k.krj_status = :status GROUP BY k.krj_item_id';
			$sql2 = 'INSERT INTO transaksi (
					trans_kodetrans,
					trans_pgj_id,
					trans_item_id,
					trans_tanggal,
					trans_status,
					trans_qty
				) 
			SELECT 
					:kodetrans,
					:pgjid,
					k.krj_item_id,
					:tanggal,
					1, 
					SUM(k.krj_qty) as qty 
				FROM `keranjang` `k` 
				JOIN produk p ON p.prod_id = k.krj_item_id 
				JOIN umkm u ON u.umkm_id = p.prod_umkm_id 
				WHERE k.krj_session = :session AND u.umkm_alias = :umkmid AND k.krj_status = :status 
				GROUP BY k.krj_item_id';

			$command = $conn->createCommand($sql);
			$command2 = $conn->createCommand($sql2);

			$command->bindParam(':session',$this->cart);
			$command->bindParam(':umkmid',$id);
			$command->bindParam(':status', $stat_awal);
			$command->bindParam(':newstatus',$stat_akhir);

			$command2->bindParam(':kodetrans',$kodetrans);
			$command2->bindParam(':pgjid',$pgj_id);
			$command2->bindParam(':tanggal',date('Y-m-d H:i:s'));
			$command2->bindParam(':session',$this->cart);
			$command2->bindParam(':umkmid',$id);
			$command2->bindParam(':status', $stat_awal);
			
			$command2->execute();
			$command->execute();
			
			$trans->commit();
			Yii::app()->user->setFlash('info','Transaksi telah berhasil dilakukan. Silahkan tunggu email dari kami untuk konfirmasi alamat dan biaya pengiriman');

		}catch(Exception $e){
			$trans->rollback();
			Yii::app()->user->setFlash('info','Transaksi GAGAL.');
		}

		$message = 'Seorang pengunjung melakukan pemesanan pada UMKM anda. Silahkan klik link 
		<a href="'.$this->createAbsoluteUrl('controlpanel/transaksi',array('q'=>$kodetrans)).'">berikut ini</a> 
		untuk melihat rincian.';

		foreach($umkm->admins as $admin){
			$maildestination[] = $admin->admin_email;
		}

		
		
			$mail = new SendMail();
			$mailobj = array(
							'destination_email'=> $maildestination,
							'destination_name' => 'Pengelola '.$umkm->umkm_nama,
							'subject'=>'Seorang pengunjung memesan produk pada UMKM anda.',
							'body' => $message,
						);
			if(!$mail->kirim($mailobj))
				throw new CHttpException(400,"Koneksi ke SMTP gagal.");

		$this->redirect(Yii::app()->user->returnUrl);

		// $sql = 'UPDATE keranjang k SET k.krj_status = :newstatus WHERE `keranjang` `k` JOIN produk p ON p.prod_id = k.krj_item_id JOIN umkm u ON u.umkm_id = p.prod_umkm_id WHERE k.krj_session = :session AND u.umkm_alias = :umkmid AND k.krj_status = :status';

	}

	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}