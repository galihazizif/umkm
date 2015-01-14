<?php

class ControlpanelController extends Controller
{
	public function filters(){
		return array(
			'accessControl',
			'postOnly + delete');
	}

	public function actions()
	{

		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'foreColor'=>0xff9c17,
				'offset'=>1,
				'testLimit'=>1,

			),
		);
	}

	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array(
					'index',
					'updateumkmpassword',
					'transaksi',
					'transaksidetail',
					'transaksidetailfinal',
					'transaksiPayment',
					'transaksipaid',
					'transaksiinfo',
					'transaksiabort',
					'editumkm',
					'cekpesan',
					'viewpesan',
					'balaspesan',
					'cekunreadmessage'),
				'expression'=>'$user->isSysAdmin() OR $user->isUmkm()',
			),
			array('allow',
				'actions'=>array(
					'index',
					'vtransaksi',
					'transaksiinfo',
					'editpengunjung',
					'vupdatepassword',
					'cekpesan',
					'viewpesan',
					'balaspesan',
					'cekunreadmessage'),
				'expression'=>'$user->isPengunjung()'),
			array('allow',
				'actions'=>array(
					'captcha'),
				'users'=>array('*')),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	public function actionIndex()
	{	
		if(Yii::app()->user->isUmkm()){
			$model = Admin::model()->find('admin_email = :email',array('email'=> Yii::app()->user->getEmail()));
			$this->render('index',array('model'=>$model));
			exit();
		}else if(Yii::app()->user->isPengunjung()){
			$model = Pengunjung::model()->find('pgj_id = :id',array(':id'=> Yii::app()->user->_getId()));
			$this->render('vindex',array('model'=>$model));
			exit();
		}else if(Yii::app()->user->isSysAdmin()){
			$umkm = Umkm::model()->findAll(array(
				'limit'=>7,
				'order'=>'umkm_id DESC'));
			$produk = Produk::model()->findAll(array(
				'limit'=>7,
				'order'=>'prod_id DESC'));
			$pengunjung = Pengunjung::model()->findAll(array(
				'limit'=>7,
				'order'=>'pgj_id DESC'));
			$transaksi = Transaksi::model()->findAll(array(
				'limit'=>7,
				'order'=>'trans_id DESC'));
			$this->render('sysindex',array(
				'umkm'=>$umkm,
				'produk'=>$produk,
				'pengunjung'=>$pengunjung,
				'transaksi'=>$transaksi
				)
			);
		}
	}

	public function actionUpdateUmkmPassword(){
		$model = new PasswordForm;

		if(isset($_POST['PasswordForm'])){
			$model->attributes = $_POST['PasswordForm'];
			if($model->validate()){
				$user = Admin::model()->findByPk(Yii::app()->user->_getId());
				$user->admin_password = sha1($model->password);
				$user->save();
				Yii::app()->user->setFlash('info','Password telah diubah.');
				$this->renderPartial('updateumkmpassword',array('model'=>$model,'act'=>'success'));
			}
		}
		
		$this->renderPartial('updateumkmpassword',array('model'=>$model,'act'=>'form'));
	}

	public function actionVUpdatePassword(){
		$model = new PasswordForm;

		if(isset($_POST['PasswordForm'])){
			$model->attributes = $_POST['PasswordForm'];
			if($model->validate()){
				$pengunjung = Pengunjung::model()->findByPk(Yii::app()->user->_getId());
				$pengunjung->pgj_password = sha1($model->password);
				$pengunjung->save(false);
				Yii::app()->user->setFlash('info','Password anda telah diubah.');
				echo '<script>';
				echo 'loadingIcon(\'#myModal\');';
				echo 'window.location.href="'.$this->createUrl('controlpanel/index').'";';
				echo '</script>';
				exit();


			}
		}
		
		$this->renderPartial('vupdatepassword',array('model'=>$model,'act'=>'form'));
	}

	public function actionTransaksi(){
		$criteria = new CDbCriteria;
		$criteria->with = array(
			'transItem.itemProd.prodUmkm'=>array(
				'joinType'=>'INNER JOIN',
				'condition'=>'umkm_id = '.Yii::app()->user->getUmkmId()),
			'transPgj'=>array(
				'joinType'=>'INNER JOIN')
			);
		$criteria->order = 'trans_status,trans_tanggal DESC';
		$criteria->group = 'trans_kodetrans';

		if(isset($_GET['q'])){

			$queries = explode(' ', trim($_GET['q']));
			// $criteria->addSearchCondition('trans_kodetrans',trim($_GET['q']),true);
			// $criteria->addSearchCondition('pgj_nama',trim($_GET['q']),true,'OR');

			foreach ($queries as $key => $value) {
				$criteria->addSearchCondition('trans_kodetrans',$value,true,'OR');	
				$criteria->addSearchCondition('pgj_nama',$value,true,'OR');
			}
		}

		$count = Transaksi::model()->count($criteria);
		$pages = new CPagination($count);
		$pages->pageSize = 10;
		$pages->applyLimit($criteria);

		$model = Transaksi::model()->findAll($criteria);


		$this->render('transaksi',array('model'=>$model,'pages'=>$pages));

	}

	public function actionTransaksiDetail($kodetrans = null){

		$kodetrans = ($kodetrans != null) ? $kodetrans : $_GET['kodetrans'];
		$model = Transaksi::model()->findAll(array(
			'with'=>array(
				'transItem.itemProd.prodUmkm'=>array(
					'joinType'=>'INNER JOIN',
					'select'=>false,
					'condition'=>'umkm_id = '.Yii::app()->user->getUmkmId())),
		'condition'=>'trans_kodetrans = \''.$kodetrans .'\' AND trans_status = '.Transaksi::STATUS_ADD));

		if(isset($_POST['transaksiDetail']['biayaTambahan'])){
			if(is_numeric($_POST['transaksiDetail']['biayaTambahan'])){
				$biaya = $_POST['transaksiDetail']['biayaTambahan'];
				Yii::app()->user->setFlash('biaya',$biaya);
				$this->renderPartial('transaksidetailconfirm',array('model'=>$model,'biaya'=>$biaya));
				Yii::app()->end();				
					
			}
		}

		$this->renderPartial('transaksidetail',array('model'=>$model));
	}

	public function actionTransaksiPayment($kodetrans=null){

		$kodetrans = ($kodetrans != null) ? $kodetrans : $_GET['kodetrans'];		

		if(isset($_GET['do'])){
			//Ubah status transaksi dari APPROVED ke PAID
			if($_GET['do'] == 'paid'){
				$model = Transaksi::model()->with(
					array('transItem.itemProd'=>array(
						'condition'=>'prod_umkm_id='.Yii::app()->user->getUmkmId(),
						)
					))->updateAll(array(
					'trans_status'=>Transaksi::STATUS_PAID,
					'trans_tanggal'=> date('Y-m-d H:i:s'),
					),'trans_kodetrans = :kodetrans',array(
					':kodetrans'=> $kodetrans,
					));

					$model = Transaksi::model()->findAll(array(
						'with'=>array(
							'transItem.itemProd.prodUmkm'=>array(
								'joinType'=>'INNER JOIN',
								'select'=>false,
								'condition'=>'umkm_id = '.Yii::app()->user->getUmkmId())),
						'condition'=>'trans_kodetrans = \''.$kodetrans .'\' AND trans_status = '.Transaksi::STATUS_PAID));

					$this->renderPartial('transaksipaid',array('model'=>$model));
					Yii::app()->end();
			}		
		}
		else{
			$model = Transaksi::model()->findAll(array(
			'with'=>array(
				'transItem.itemProd.prodUmkm'=>array(
					'joinType'=>'INNER JOIN',
					'select'=>false,
					'condition'=>'umkm_id = '.Yii::app()->user->getUmkmId())),
			'condition'=>'trans_kodetrans = \''.$kodetrans .'\' AND trans_status = '.Transaksi::STATUS_APPROVED));
		}

		$this->renderPartial('transaksipayment',array('model'=>$model));
	}

	public function actionTransaksiPaid($kodetrans=null){
		$kodetrans = ($kodetrans != null) ? $kodetrans : $_GET['kodetrans'];		
		$model = Transaksi::model()->findAll(array(
			'with'=>array(
				'transItem.itemProd.prodUmkm'=>array(
					'joinType'=>'INNER JOIN',
					'select'=>false,
					'condition'=>'umkm_id = '.Yii::app()->user->getUmkmId())),
			'condition'=>'trans_kodetrans = \''.$kodetrans .'\' AND trans_status = '.Transaksi::STATUS_PAID));

		if(isset($_POST['Transaksi']['trans_keterangan'])){
			$model = Transaksi::model()->with(
					array('transItem.itemProd'=>array(
						'condition'=>'prod_umkm_id='.Yii::app()->user->getUmkmId(),
						)
					))->updateAll(array(
					'trans_status'=>Transaksi::STATUS_SENT,
					'trans_tanggal'=> date('Y-m-d H:i:s'),
					'trans_keterangan'=>$_POST['Transaksi']['trans_keterangan'],
					),'trans_kodetrans = :kodetrans',array(
					':kodetrans'=> $kodetrans,
					));

			Yii::app()->user->setFlash('info','Transaksi '.$kodetrans.' telah ditandai sebagai pesanan yang sudah dikirim');
			print "<script>";
			print "loadingIcon('#myModal');";
			print "window.location.href=\"".$this->createUrl('controlpanel/transaksi')."\"";
			print "</script>";
			exit();

		}

		$this->renderPartial('transaksipaid',array('model'=>$model));
	}

	public function actionTransaksiDetailFinal($kodetrans = null){
		$kodetrans = ($kodetrans != null) ? $kodetrans : $_GET['kodetrans'];
		$biaya =  Yii::app()->user->getFlash('biaya');

		//untuk menampilkan transaksi yang nantinya akan diupdate statusnya jadi approved, setelah diperiksa ketersediaan barang
		$model2 = Transaksi::model()->findAll(array(
			'with'=>array(
				'transItem.itemProd.prodUmkm'=>array(
					'joinType'=>'INNER JOIN',
					'select'=>false,
					'condition'=>'umkm_id = '.Yii::app()->user->getUmkmId())),
		'condition'=>'trans_kodetrans = \''.$kodetrans .'\' AND trans_status = '.Transaksi::STATUS_ADD));

		//update transaksi yang akan diappprove statusnya
		$model = Transaksi::model()->updateAll(array(
			'trans_status'=>Transaksi::STATUS_APPROVED,
			'trans_biayatambahan'=> $biaya,
			),'trans_kodetrans = :kodetrans',array(
			':kodetrans'=> $kodetrans));
		if($model < 1)
			throw new CHttpException(212,"Error Processing Request");
		
		
		//Me return halaman tagihan untuk pemesan | bukan render ke browser
		$x = $this->renderPartial('transaksidetailfinal',array('model'=>$model2,'biaya'=>$biaya),true);
		$mail = new SendMail();
		$mail->isHTML(true);
		$obj['subject'] = 'Tagihan UMKM';
		$obj['body'] = $x;

		$obj['destination_email'] = $model2[0]->transPgj->pgj_email;
		$obj['destination_name'] = $model2[0]->transPgj->pgj_nama;;
		$mail->kirim($obj);
		print "<script>";
		print "loadingIcon('#myModal');";
		print "window.location.href=\"".$this->createUrl('controlpanel/transaksi')."\"";
		print "</script>";
		
	}

	public function actionJajal(){
		$mail = new SendMail();
		$mail->isHTML(true);
		$obj['subject'] = '';

		$obj['destination_email'] = 'galihazizy@gmail.com';
		$obj['destination_name'] = 'Mas Galih Azizi';
		$mail->kirim($obj);
		
	}

	public function actionTransaksiInfo($kodetrans=null){
		$kodetrans = ($kodetrans != null) ? $kodetrans : $_GET['kodetrans'];
		$model = Transaksi::model()->findAll(array(
			'with'=>array(
				'transItem.itemProd.prodUmkm'=>array(
					'joinType'=>'INNER JOIN',
					'select'=>false,
					// 'condition'=>'umkm_id = '.Yii::app()->user->getUmkmId()
					)),
		'condition'=>'trans_kodetrans = \''.$kodetrans.'\''));
		$this->renderPartial('transaksiinfo',array('model'=>$model));
	}

	public function actionTransaksiAbort($kodetrans=null){
		$kodetrans = ($kodetrans != null) ? $kodetrans : $_GET['kodetrans'];
		$model = Transaksi::model()->findAll(array(
			'with'=>array(
				'transItem.itemProd.prodUmkm'=>array(
					'joinType'=>'INNER JOIN',
					'select'=>false,
					'condition'=>'umkm_id = '.Yii::app()->user->getUmkmId())),
		'condition'=>'trans_kodetrans=\''.$kodetrans.'\''));

		if(isset($_POST['Transaksi']['trans_keterangan'])){
			$criteria = new CDbCriteria;
			$criteria->with = array('transItem.itemProd'=>array(
				'condition'=>'prod_umkm_id = '.Yii::app()->user->getUmkmId())
			);

			$criteria->addCondition('trans_kodetrans=\''.$kodetrans.'\'');

			$model = Transaksi::model()->updateAll(array(
				'trans_keterangan'=> $_POST['Transaksi']['trans_keterangan'],
				'trans_tanggal' => date('Y-m-d H:i:s'),
				'trans_status' => Transaksi::STATUS_ABORTED),$criteria);
			
			Yii::app()->user->setFlash('info','Transaksi dengan kode '.$kodetrans.' telah dibatalkan.');

			print "<script>";
			print "loadingIcon('#myModal');";
			print "window.location.href=\"".$this->createUrl('controlpanel/transaksi')."\"";
			print "</script>";
			exit();
		}

		$this->renderPartial('transaksiabort',array('model'=>$model));	
	}

	public function actionEditUmkm(){
		$model = Umkm::model()->findByPk(Yii::app()->user->getUmkmId());
		//kalo status umkm sudah terverifikasi tidak bisa dirubah profilnya, kalo mau diubah harus hubungi pengelola dulu.
		if($model->umkm_status != Umkm::STATUS_REGISTERED)
			throw new CHttpException(500,"Anda tidak diizinkan mengubah profil jika status UMKM anda sudah terverifikasi, silahkan hubungi administrator");
		if(isset($_POST['Umkm'])){
			unset($_POST['Umkm']['umkm_email']);
			unset($_POST['Umkm']['umkm_lokasi_kode']);
			$model->umkm_lokasi_kode = $_POST['Umkm']['desa'];
			$model->attributes = $_POST['Umkm'];
			$uploaded = CUploadedFile::getInstance($model,'umkm_imgurl');
			if($model->save()){
				if($uploaded !== null){
					$uploaded->saveAs('./data/avatar/'.$model->umkm_id.'.'.$uploaded->extensionName);
					$model->umkm_imgurl = $model->umkm_id.'.'.$uploaded->extensionName;
					$model->save(false);
				}
				Yii::app()->user->setFlash('info','Perubahan telah disimpan');
				$this->redirect($this->createUrl('controlpanel/index'));
			}
		}else{
			$selProvinsi	= substr($model->umkm_lokasi_kode,0,2).'.00.00.0000';
			$selKabupaten 	= substr($model->umkm_lokasi_kode,0,2).'.'.substr($model->umkm_lokasi_kode,3,2).'.00.0000';
			$selKecamatan 	= substr($model->umkm_lokasi_kode,0,2).'.'.substr($model->umkm_lokasi_kode,3,2).'.'.substr($model->umkm_lokasi_kode,6,2).'.0000';

			$model->provinsi	= Lokasi::model()->find('lokasi_kode = ?',array($selProvinsi))->lokasi_propinsi;
			$model->kabupaten	= Lokasi::model()->find('lokasi_kode = ?',array($selKabupaten))->lokasi_id;
			$model->kecamatan	= Lokasi::model()->find('lokasi_kode = ?',array($selKecamatan))->lokasi_id;
			$model->desa 		= $model->umkm_lokasi_kode;


		}

		$listProvinsi 	= Lokasi::model()->getProvinsi();
		$listKota 		= ($model->provinsi)? Lokasi::model()->getKota($model->provinsi): array('Pilih Kabupaten/Kota');
		$listKecamatan	= ($model->kabupaten)? Lokasi::model()->getKecamatan($model->kabupaten) : array('Pilih Kecamatan');
		$listDesa 		= ($model->kecamatan)? Lokasi::model()->getDesa($model->kecamatan): array('Pilih Desa/Kelurahan');
		$this->render('editumkm',array(
			'model'=>$model,
			'listProvinsi'=>$listProvinsi,
			'listKota'=>$listKota,
			'listKecamatan'=>$listKecamatan,
			'listDesa'=>$listDesa));
	}

	public function actionEditPengunjung(){
		$model = Pengunjung::model()->findByPk(Yii::app()->user->_getId());
		//kalo status umkm sudah terverifikasi tidak bisa dirubah profilnya, kalo mau diubah harus hubungi pengelola dulu.
		if(isset($_POST['Pengunjung'])){
			$model->verifyCode = Yii::app()->getController()->createAction("captcha")->verifyCode;
			unset($_POST['Pengunjung']['pgj_lokasi']);
			$model->pgj_lokasi = $_POST['Pengunjung']['desa'];
			$model->attributes = $_POST['Pengunjung'];
			$model->passconf = $model->pgj_password;
			if($model->save()){
				Yii::app()->user->setFlash('info','Perubahan data anda telah disimpan.');
				$this->redirect($this->createUrl('controlpanel/index'));
			}
		}else{
			$selProvinsi	= substr($model->pgj_lokasi,0,2).'.00.00.0000';
			$selKabupaten 	= substr($model->pgj_lokasi,0,2).'.'.substr($model->pgj_lokasi,3,2).'.00.0000';
			$selKecamatan 	= substr($model->pgj_lokasi,0,2).'.'.substr($model->pgj_lokasi,3,2).'.'.substr($model->pgj_lokasi,6,2).'.0000';

			$model->provinsi	= Lokasi::model()->find('lokasi_kode = ?',array($selProvinsi))->lokasi_propinsi;
			$model->kabupaten	= Lokasi::model()->find('lokasi_kode = ?',array($selKabupaten))->lokasi_id;
			$model->kecamatan	= Lokasi::model()->find('lokasi_kode = ?',array($selKecamatan))->lokasi_id;
			$model->desa 		= $model->pgj_lokasi;


		}

		// $c = new CCaptchaAction($this,'oeu');
		$model->emailconf = $model->pgj_email;


		$listProvinsi 	= Lokasi::model()->getProvinsi();
		$listKota 		= ($model->provinsi)? Lokasi::model()->getKota($model->provinsi): array('Pilih Kabupaten/Kota');
		$listKecamatan	= ($model->kabupaten)? Lokasi::model()->getKecamatan($model->kabupaten) : array('Pilih Kecamatan');
		$listDesa 		= ($model->kecamatan)? Lokasi::model()->getDesa($model->kecamatan): array('Pilih Desa/Kelurahan');
		$this->render('editpengunjung',array(
			'model'=>$model,
			'listProvinsi'=>$listProvinsi,
			'listKota'=>$listKota,
			'listKecamatan'=>$listKecamatan,
			'listDesa'=>$listDesa));
	}

	public function actionVTransaksi(){
		//visitorTransactionList
		$criteria = new CDbCriteria;
		$criteria->with = array(
			'transItem.itemProd.prodUmkm'=>array(
				'joinType'=>'INNER JOIN',
				'select'=>'umkm_nama',
			)
		);
		$criteria->condition = 'trans_pgj_id='.Yii::app()->user->_getId();
		$criteria->order = 'trans_status,trans_tanggal DESC';
		$criteria->group = 'trans_kodetrans';

		if(isset($_GET['q'])){
			$criteria->addSearchCondition('trans_kodetrans',trim($_GET['q']));
		}

		//Pagination
		$count = Transaksi::model()->count($criteria);
		$pages = new CPagination($count);
		$pages->pageSize = 10;
		$pages->applyLimit($criteria);

		$model = Transaksi::model()->findAll($criteria);
		$this->render('vtransaksi',array('model'=>$model,'pages'=>$pages));
	}

	public function actionCekPesan(){
		$tipe = Yii::app()->user->getTipe();
		$id = Yii::app()->user->_getId();
		$criteria = new CDbCriteria;
		$criteria->condition = 'pes_tujuantipe = '.$tipe.' AND pes_tujuanid = '.$id;
		$criteria->order = 'pes_tanggal DESC';

		$count = Pesan::model()->count($criteria);
		$pagination = new CPagination($count);
		$pagination->pageSize = 10;
		$pagination->applyLimit($criteria);
		$model = Pesan::model()->findAll($criteria);
		
		$this->render('cekpesan',array(
			'model'=>$model,
			'pagination'=>$pagination,
			)
		);
	}

	public function actionViewPesan($idpesan = null){	
		
		if($idpesan == null)
			throw new CHttpException(403,"Pesan tidak ditemukan / Anda tidak diizinkan melihatnya");

		$tipe = Yii::app()->user->getTipe();
		$id = Yii::app()->user->_getId();
		$criteria = new CDbCriteria;
		$criteria->condition = 'pes_tujuantipe = '.$tipe.' AND pes_tujuanid = '.$id.' AND pes_id = '.$idpesan;
		
		$model = Pesan::model()->find($criteria);
		if($model === null)
			throw new CHttpException(403,"Pesan tidak ditemukan / Anda tidak diizinkan melihatnya");
			
		if($model->pes_status == 0){
			$model->pes_status = 1;
			$model->save();	
		}
		
		$this->render('viewpesan',array(
			'model'=>$model,
			)
		);
	}

	public function actionBalasPesan($idpesan = null){
		if($idpesan == null)
			throw new CHttpException(403,"Pesan tidak ditemukan / Anda tidak diizinkan melihatnya");
		if($idpesan == null)
			throw new CHttpException(403,"Pesan tidak ditemukan / Anda tidak diizinkan melihatnya");

		$tipe = Yii::app()->user->getTipe();
		$id = Yii::app()->user->_getId();
		$criteria = new CDbCriteria;
		$criteria->condition = 'pes_tujuantipe = '.$tipe.' AND pes_tujuanid = '.$id.' AND pes_id = '.$idpesan;
		
		$model = Pesan::model()->find($criteria);
		if($model === null)
			throw new CHttpException(403,"Pesan tidak ditemukan / Anda tidak diizinkan melihatnya");

		$balasan = new Pesan;
			
		if($model->pes_status == 0){
				$model->pes_status = 1;
				$model->save();	
		}
		
		if(isset($_POST['Pesan'])){
			$balasan->pes_tujuantipe = $model->pes_pengirimtipe;
			$balasan->pes_tujuanid = $model->pes_pengirimid;
			$balasan->pes_pengirimtipe = Yii::app()->user->getTipe();
			$balasan->pes_pengirimid = Yii::app()->user->_getId();
			$balasan->pes_judul = $_POST['Pesan']['pes_judul'];
			$balasan->pes_isi = $_POST['Pesan']['pes_isi'];
			$balasan->pes_tanggal = date('Y-m-d H:i:s');
			$balasan->pes_kategori = 'ME.01'; //kategori pesan antar admin/ sysadmin/ pengunjung yang terdaftar
			if($balasan->save()){
				Yii::app()->user->setFlash('info','Pesan Telah terikirim.');
				$this->redirect($this->createUrl('controlpanel/cekpesan'));
			}
			else
				Yii::app()->user->setFlash('info','Pesan GAGAL.');	
		}

		$this->render('viewpesan',array(
			'model'=>$model,
			'balasan'=>$balasan,
			)
		);

	}

	public function actionCekUnreadMessage(){
		$tipe = Yii::app()->user->getTipe();
		$id = Yii::app()->user->_getId();
		echo $this->unreadMessage($tipe,$id);
	}

	public function unreadMessage($tipe,$uid){
		return Pesan::model()->count('pes_tujuantipe = :tipe AND pes_tujuanid =:id AND pes_status = :status',
			array(
				':tipe'=>$tipe,
				':id'=>$uid,
				':status'=>'0')
			);
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