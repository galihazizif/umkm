<?php

class SiteController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{

		$this->layout = '//layouts/single';$this->layout = '//layouts/single';
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'foreColor'=>0xff9c17,
				'offset'=>-1,
				'testLimit'=>1,

			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	public function filters(){
		return array(
			'accessControl', //
			'postOnly + delete', // 
			// array(
			// 	'COutputCache',
			// 	'duration'=>100,
			// 	'varyBySession'=>true),
		);
	}

	public function accessRules()
	{
		return array(
			array('deny', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('umkmresendemailconf'),
				//'expression'=>'$user->isSysAdmin()',
				'users'=> array('@'),
			),
		);
	}

	public function actionDirektori(){
		$this->layout = '//layouts/single';
		$criteria = new CDbCriteria;
		$criteria->select = array(
			'umkm_nama',
			'umkm_alamat',
			'umkm_lokasi_kode',
			'umkm_tanggal',
			'umkm_deskripsi',
			'umkm_telp',
			'umkm_alias',
			);
		$criteria->condition = 'umkm_status != '.Umkm::STATUS_SUSPENDED;
		$criteria->order = 'umkm_id DESC';
	

		if(isset($_GET['q'])){
			$q = trim($_GET['q']);
			$queries = explode(' ', $q);
			foreach ($queries as $key => $value) {
				$criteria->addSearchCondition('umkm_nama',$value);		
			}
		}

		

		// $dataProvider = new CActiveDataProvider('Umkm',
		// 	array(
		// 		'pagination'=>array(
		// 			'pageSize'=>5))
		// 	);

		$dependency = new CCacheDependency('select MAX(umkm_id) from umkm');
		$dataProvider = new CActiveDataProvider(
			Umkm::model()->cache(3600,$dependency,2),array(
				'pagination'=>array(
			 			'pageSize'=>5))
				);

		$dataProvider->setCriteria($criteria);
		$this->render('direktori',array('dataProvider'=>$dataProvider));
		
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		$this->layout = '//layouts/single';
		$criteria = new CDbCriteria(
			array(
					'with'=>array(
					'prodUmkm'=>array(
						'condition'=>'umkm_status != '.Umkm::STATUS_SUSPENDED)),
					'order'=>'prod_id DESC'));

		if(isset($_GET['q'])){
			$q = trim($_GET['q']);
			$criteria->addSearchCondition('prod_nama',$q);
		}

		$dependency = new CCacheDependency('SELECT MAX(prod_id) from produk');
		$produkModel = Produk::model()->cache(3600,$dependency);

		$dataProvider = new CActiveDataProvider($produkModel,
			array(
				'pagination'=>array(
					'pageSize'=>6),
				'criteria'=>$criteria)
			);

		$this->render('index',array('dataProvider'=>$dataProvider));

	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$this->layout = '//layouts/single';
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if(!Yii::app()->user->isGuest){
				$model->name = 'dummy';
				$model->email = 'dummy@dummy.dummy';
			}

			if($model->validate())
			{
				// $name='=?UTF-8?B?'.base64_encode($model->name).'?=';
				// $subject='=?UTF-8?B?'.base64_encode($model->subject).'?=';
				// $headers="From: $name <{$model->email}>\r\n".
				// 	"Reply-To: {$model->email}\r\n".
				// 	"MIME-Version: 1.0\r\n".
				// 	"Content-Type: text/plain; charset=UTF-8";

				$pesan = new Pesan;

				if(Yii::app()->user->isGuest){
					$pesan->pes_pengirimtipe = 0;
					$pesan->pes_pengirimid = 0;
					$pesan->pes_isi = $model->body.' | oleh '.$model->name.'&lt;'.$model->email.'&gt;';
					$pesan->pes_kategori = 'ME.00'; //Kategori untuk pengunjung yang tidak terdaftar mengirim ke Unyumas
				}else{
					$pesan->pes_pengirimtipe = Yii::app()->user->getTipe();
					$pesan->pes_pengirimid = Yii::app()->user->_getId();
					$pesan->pes_isi = $model->body;
					$pesan->pes_kategori = 'ME.01';
				}


				$pesan->pes_tanggal = date('Y-m-d H:i:s');
				$pesan->pes_tujuantipe = LevelLookup::ACCOUNT_SYSADMIN;
				$pesan->pes_tujuanid = 1;
				$pesan->pes_judul = $model->subject;
				
				if($pesan->save()){

				}else{
					print_r($pesan->getErrors());
					exit();
				}
				// mail(Yii::app()->params['adminEmail'],$subject,$model->body,$headers);
				Yii::app()->user->setFlash('info','Terimakasih telah menghubungi kami, pesan anda telah disimpan didalam database dan akan diproses secepatnya '.Yii::app()->name);
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}



	public function actionLevel(){
		print Yii::app()->user->isUmkm();
	}


	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		if(!Yii::app()->user->isGuest)
			$this->redirect(Yii::app()->user->returnUrl);

		$model=new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login()){
				if(Yii::app()->user->isUmkm()){ //jika user yang login adalah admin umkm
					if(Yii::app()->user->isUmkmEmailVerified()){
							// $this->redirect(Yii::app()->user->returnUrl);
							$this->redirect($this->createUrl('controlpanel/index'));
					}else{
						Yii::app()->user->logout();
						$msg = "Email anda belum terverifikasi, silahkan periksa INBOX / SPAM akun email anda, atau klik ".CHtml::link('ini',$this->createUrl('site/umkmresendemailconf'))." untuk mengirimkan ulang kode verifikasi.";
						Yii::app()->user->setFlash('info',$msg);
					}
				}else if(Yii::app()->user->isPengunjung()){
					Yii::app()->user->setFlash('info','Selamat datang, selamat menjelajah.');
					$this->redirect(Yii::app()->user->returnUrl);
				}else if(Yii::app()->user->isSysAdmin()){
					Yii::app()->user->setFlash('info','Selamat datang SysAdmin');
					$this->redirect(Yii::app()->user->returnUrl);
				}
			}
				
		}
		// display the login form
		$this->layout = '//layouts/single';
		$model->unsetAttributes(array('password'));
		$this->render('login',array('model'=>$model));
	}

	public function actionXLogin(){
		$tab['umkm'] = $tab['visitor'] = $tab['sys'] = '';
		if(isset($_GET['tab'])){
			$tab[$_GET['tab']] = 'active';
		}

		if(!Yii::app()->user->isGuest){
			// if(Yii::app()->user->isUmkm())
			 Yii::app()->user->logout();

			// print '<script>';
			// print 'window.location.href="'.Yii::app()->user->returnUrl.'"';
			// print '</script>';
			// exit();
		}

		$model=new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{

			switch($_POST['LoginForm']['tipe']){
				case LevelLookup::ACCOUNT_UMKM: $tab['umkm'] = 'active'; break;
				case LevelLookup::ACCOUNT_SYSADMIN : $tab['sys'] = 'active'; break;
				case LevelLookup::ACCOUNT_VISITOR: $tab['visitor'] = 'active'; break;
			}

			$model->attributes=$_POST['LoginForm'];

			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login()){
				if(Yii::app()->user->isUmkm()){ //jika user yang login adalah admin umkm
					if(Yii::app()->user->isUmkmEmailVerified()){
						print "<script>";
						print "loadingIcon('#myModal');";
						print "window.location.href=\"".$this->createUrl('controlpanel/index')."\"";
						print "</script>";
					}else{
						Yii::app()->user->logout();
						$msg = "Email anda belum terverifikasi, silahkan periksa INBOX / SPAM akun email anda, atau klik ".CHtml::link('ini',$this->createUrl('site/umkmresendemailconf'))." untuk mengirimkan ulang kode verifikasi.";
						Yii::app()->user->setFlash('info',$msg);
						print "<script>";
						print "loadingIcon('#myModal');";
						print "window.location.href=\"".Yii::app()->user->returnUrl."\"";
						print "</script>";
						exit();
					}
				}
				else if(Yii::app()->user->isPengunjung()){
					Yii::app()->user->setFlash('info',"Selamat datang, selamat menjelajah di ".Yii::app()->name);

					$url = (Yii::app()->user->hasFlash('url')) ? Yii::app()->user->getFlash('url') : Yii::app()->user->returnUrl;

					print "<script>";
					print "loadingIcon('#myModal');";
					print "window.location.href=\"".Yii::app()->user->returnUrl."\"";
					print "</script>";
				}
				else if(Yii::app()->user->isSysAdmin()){
					print "<script>";
					print "loadingIcon('#myModal');";
					print "window.location.href=\"".$this->createUrl('controlpanel/index')."\"";
					print "</script>";	
				}
			}
				
		}
		// display the login form
		$this->layout = '//layouts/single';
		$model->unsetAttributes(array('password'));
		$this->renderPartial('xlogin',array('model'=>$model,'tab'=>$tab));

	}

	/*
	Metod untuk menambahkan akun email tambahan untuk UMKM
	*/
	public function actionXAddUmkmEmail(){
		// sleep(1);
		$model = new EmailWithConfirmForm;
		if(isset($_POST['EmailWithConfirmForm'])){

			$model->attributes = $_POST['EmailWithConfirmForm'];
			if($model->validate()){
				if(!Admin::model()->isExist($model->email)){
					$admin = new Admin;
					$admin->admin_email = $model->email;
					$admin->admin_password = sha1($model->password);
					$admin->admin_regdate = date('Y-m-d H:i:s');
					$admin->admin_umkm_id = Yii::app()->user->getUmkmId();
					$admin->save();
					Yii::app()->user->setFlash('info',$admin->admin_email.' telah ditambahkan sebagai salah satu pengelola di akun UMKM anda.');
					$this->renderPartial('xumkmemail',array('model'=>$model,'act'=>'success'),false,false);
					Yii::app()->end();
				}else{
					$model->unsetAttributes();
					$model->addError('email','Email sudah terpakai.');
				}
			}
		}

		$this->renderPartial('xumkmemail',array('model'=>$model,'act'=>'create'),false,false);
	}

	public function actionXDeleteUmkmEmail(){
		$model = Admin::model()->find('admin_id = ?',array($_GET['id']));
		if(($model->admin_umkm_id == Yii::app()->user->getUmkmId()) || Yii::app()->user->isSysAdmin()){
			$model->delete();
			Yii::app()->user->setFlash('info','Perubahan tersimpan.');
		}

		$this->redirect(array('controlpanel/index'));
	}


	public function actionRegisterUmkm(){
		if(!Yii::app()->user->isGuest)
			$this->redirect(Yii::app()->user->returnUrl);

		$model	= new RegisterUmkmForm;
		$umkm 	= new Umkm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='register-umkm-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		if (isset($_POST['RegisterUmkmForm'])) {
			$model->attributes=$_POST['RegisterUmkmForm'];
			if($model->validate()){
				if(!Umkm::model()->isExist($model->umkm_email)){
					$umkm->attributes = $model->attributes;
					$umkm->umkm_lokasi_kode = $model->desa;
					$umkm->umkm_tanggal = date('Y-m-d H:i:s');
					// print_r($model->attributes);
					// print_r($umkm->attributes);;
					// exit();
					if($umkm->save()){
						$admin = new Admin();
						$admin->admin_umkm_id 	= $umkm->umkm_id;
						$admin->admin_email 	= $umkm->umkm_email;
						$admin->admin_password 	= sha1($model->umkm_password);
						$admin->admin_regdate	= date('Y-m-d H:i:s');
						$admin->admin_isowner 	= 1;

						$umkmEmailConf = array(
							'destination_email'=> $umkm->umkm_email,
							'destination_name' => $umkm->umkm_nama,
							'body' => sha1($admin->admin_regdate.'-'.$umkm->umkm_id)
							);
						$admin->save();

						$this->umkmSendEmailConfirmation($umkmEmailConf);

						Yii::app()->user->setFlash('info','Akun berhasil disimpan, silahkan ikuti petunjuk pada email yang kami kirimkan ke email anda. Jika email tidak ada pada inbox periksa kotak spam. Terimakasih');
						$this->redirect(Yii::app()->createUrl('site/login'));	
					}
					
				}else{
					$model->addError('umkm_email','Email sudah dipakai, silahakan gunakan yang lain');
				}
				
				
			}
		}
		
		$listProvinsi 	= Lokasi::model()->getProvinsi();
		$listKota 		= ($model->provinsi)? Lokasi::model()->getKota($model->provinsi): array('Pilih Kabupaten/Kota');
		$listKecamatan	= ($model->kabupaten)? Lokasi::model()->getKecamatan($model->kabupaten) : array('Pilih Kecamatan');
		$listDesa 		= ($model->kecamatan)? Lokasi::model()->getDesa($model->kecamatan): array('Pilih Desa/Kelurahan');

		$this->layout = '//layouts/single';
		$model->unsetAttributes(array('umkm_password','cpassword','verifyCode'));
		$this->render('registerumkm',array(
			'model'=>$model,
			'umkm'=>$umkm,
			'listProvinsi'=>$listProvinsi,
			'listKota' =>$listKota,
			'listKecamatan'=>$listKecamatan,
			'listDesa'=>$listDesa));
	}

	public function actionUpdateKota(){
		// $prov = isset($_POST['RegisterUmkmForm']['provinsi']) ? $_POST['RegisterUmkmForm']['provinsi']; $_POST['Pengunjung']['provinsi'];
		$prov = $_POST[key($_POST)]['provinsi'];
		$res = Lokasi::model()->getKota($prov);
		foreach ($res as $key => $value) {
			print '<option value="'.$key.'">'.$value.'</option>';
		}

	}

	public function actionUpdateKecamatan(){
		// $kab = isset($_POST['RegisterUmkmForm']['kabupaten']) ? $_POST['RegisterUmkmForm']['kabupaten'] : $_POST['Pengunjung']['kabupaten'];
		$kab = $_POST[key($_POST)]['kabupaten'];
		$res = Lokasi::model()->getKecamatan($kab);
		foreach ($res as $key => $value) {
			print '<option value="'.$key.'">'.$value.'</option>';
		}

	}

	public function actionUpdateDesa(){
		// $kec = isset($_POST['RegisterUmkmForm']['kecamatan']) ? $_POST['RegisterUmkmForm']['kecamatan'] : $_POST['Pengunjung']['kecamatan'];
		$kec = $_POST[key($_POST)]['kecamatan'];
		$res = Lokasi::model()->getDesa($kec);	
		foreach ($res as $key => $value) {
			print '<option value="'.$key.'">'.$value.'</option>';
		}	

	}

	private function umkmSendEmailConfirmation($obj){
		// *subject
		// *body
		// *destination_email
		// *destination_name

		$obj['subject'] = 'Konfirmasi pendafataran UMKM';
		$obj['body'] = 'Selamat bergabung '.$obj['destination_name'].', untuk mengaktifkan akun anda di UMKM, klik link berikut '.CController::createAbsoluteUrl('site/umkmemailconf',array('cfcd'=>$obj['body'],'sbj'=>urlencode($obj['destination_email'])));

		$mail = new SendMail();
		return ($mail->kirim($obj)) ? true : false;

	}

	public function actionUmkmResendEmailConf(){
		$model = new EmailForm;
		if(isset($_POST['EmailForm'])){
			$model->attributes = $_POST['EmailForm'];
			if($model->validate()){
				$admin = Admin::model()->find('admin_email = ?',array($model->email));
				if($admin != null){

						$umkmEmailConf = array(
							'destination_email'=> $admin->admin_email,
							'destination_name' => $admin->adminUmkm->umkm_nama,
							'body' => sha1($admin->admin_regdate.'-'.$admin->adminUmkm->umkm_id)
							);
						
						try{
							if($this->umkmSendEmailConfirmation($umkmEmailConf))
								Yii::app()->user->setFlash('info','Email konfirmasi pendaftaran telah dikirim ke '.$admin->admin_email.'. Terimakasih');
							else
								Yii::app()->user->setFlash('info','Email konfirmasi pendaftaran GAGAL dikirim ke '.$admin->admin_email.'. Terimakasih');
							$model->unsetAttributes();
						}	

						catch(Exception $e){
							print_r($e->getMessage());
						}
				}
				else{
					$model->addError('email','Email tidak ditemukan.');	
				}
				
			}			
		}

		$this->render('umkmresendemailconf',array('model'=> $model));
	}

	public function actionUmkmEmailConf(){
		if(isset($_GET['cfcd']) && isset($_GET['sbj'])){
			$cfcd 		= $_GET['cfcd'];
			$email  	= urldecode($_GET['sbj']);
			// sha1($admin->admin_regdate.'-'.$umkm->umkm_id)
			$model = Admin::model()->find('admin_email = ?',array($email));
			if($model){
				if(sha1($model->admin_regdate.'-'.$model->admin_umkm_id) == $cfcd){
					$model->admin_status = 1;
					$model->save();
					Yii::app()->user->setFlash('info','Email berhasil diverifikasi, silahkan login.');
					$this->redirect($this->createUrl('site/login'));
				}

				Yii::app()->user->setFlash('info','Kode verifikasi salah.');
				$this->redirect($this->createUrl('site/UmkmResendEmailConf'));

			}else{
				Yii::app()->user->setFlash('info','Maaf, email tidak ditemukan.');
				$this->redirect($this->createUrl('site/login'));
			}

		}
	}

	protected function login($username,$password,$tipe){

		$model = new LoginForm;
		$model->username = $username;
		$model->password = $password;
		$model->tipe = $tipe;
		$model->rememberMe = false;

		if($model->validate() && $model->login()){
			$this->redirect(Yii::app()->user->returnUrl);

		}else{
			print_r($model->getErrors());
			exit();
		}

		
	}

	public function actionRegisterpengunjung()
	{
		$model=new Pengunjung;

		if(isset($_POST['Pengunjung']))
		{
			$model->attributes=$_POST['Pengunjung'];
			if($model->validate())
			{ 
				$model->pgj_lokasi = $_POST['Pengunjung']['desa'];
         		if($model->save(false)){
         			Yii::app()->user->setFlash('info','Registrasi berhasil, akun anda telah dibuat');
         			$this->login($model->pgj_email, $_POST['Pengunjung']['pgj_password'], LevelLookup::ACCOUNT_VISITOR);
     //     			print_r($model->attributes);
					// exit();
         		}else{
         			print_r($model->getErrors());
         			exit();
         		}

			}
		}

		$listProvinsi 	= Lokasi::model()->getProvinsi();
		$listKota 		= ($model->provinsi)? Lokasi::model()->getKota($model->provinsi): array('Pilih Kabupaten/Kota');
		$listKecamatan	= ($model->kabupaten)? Lokasi::model()->getKecamatan($model->kabupaten) : array('Pilih Kecamatan');
		$listDesa 		= ($model->kecamatan)? Lokasi::model()->getDesa($model->kecamatan): array('Pilih Desa/Kelurahan');

		$model->unsetAttributes(array('verifyCode'));

		$this->layout = '//layouts/single';
		$this->render('registerpengunjung',array(
			'model'=>$model,
			'listProvinsi'=>$listProvinsi,
			'listKota' =>$listKota,
			'listKecamatan'=>$listKecamatan,
			'listDesa'=>$listDesa));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}

	public function actionJajal(){
		print Yii::app()->baseUrl;
	}

	public function actionResetPasswordUmkm(){
		$model = new EmailForm;
		if(isset($_POST['EmailForm'])){
			$model->attributes = $_POST['EmailForm'];
			if($model->validate()){
				$umkm = Admin::model()->find('admin_email = ?',array($model->email));
				if($umkm !== null){
					$this->resetPasswordUmkm($umkm);
					Yii::app()->user->setFlash('info','Sebuah email telah dikirimkan ke email anda untuk mengatur ulang kata sandi / password.');
					$this->redirect('login');
				}else{
					$model->addError('email','Email '.$model->email.' tidak terdaftar. Silahkan lakukan registrasi jika anda belum terdaftar');
				}
			}
			$model->unsetAttributes(array('verifyCode'));
		}

		$this->render('resetpasswordumkm',array('model'=>$model));
	}

	public function actionResetPasswordPgj(){
		$model = new EmailForm;
		if(isset($_POST['EmailForm'])){
			$model->attributes = $_POST['EmailForm'];
			if($model->validate()){
				$pengunjung = Pengunjung::model()->find('pgj_email = ?',array($model->email));
				if($pengunjung !== null){
					$this->resetPasswordPgj($pengunjung);
					Yii::app()->user->setFlash('info','Sebuah email telah dikirimkan ke email anda untuk mengatur ulang kata sandi / password.');
					$this->redirect('login');

				}else{
					$model->addError('email','Email '.$model->email.' tidak terdaftar. Silahkan lakukan registrasi jika anda belum terdaftar');
				}
			}
			$model->unsetAttributes(array('verifyCode'));
		}

		$this->render('resetpasswordpgj',array('model'=>$model));
	}

	public function resetPasswordUmkm($umkm){
		$model = new Verifikasiemail;
		$model->ver_cfcd = sha1(time().microtime().$umkm->admin_id);
		$model->ver_akuntipe = LevelLookup::ACCOUNT_UMKM;
		$model->ver_akunid = $umkm->admin_id;
		$model->save();
		$mail = new SendMail;
		$mail->isHTML(true);
		$obj['subject'] = 'Reset akun UMKM';
		$obj['destination_email'] = $umkm->admin_email;
		$obj['destination_name'] = '';
		$obj['body'] = 'Untuk mengatur ulang kata sandi akun UMKM anda silahkan klik tautan berikut ini';
		$obj['body'] .= "<a href='".$this->createAbsoluteUrl('site/confirmresetpasswordumkm',array('cfcd'=>$model->ver_cfcd))."'> Reset</a>";
		return $mail->kirim($obj);

	}

	public function resetPasswordPgj($pengunjung){
		/*Sebelumnya harus dipastikan dahulu kalau USER Pengunjung ybs VALID*/
		$model = new Verifikasiemail;
		$model->ver_cfcd = sha1(time().microtime().$pengunjung->pgj_id);
		$model->ver_akuntipe = LevelLookup::ACCOUNT_VISITOR;
		$model->ver_akunid = $pengunjung->pgj_id;
		$model->save();
		$mail = new SendMail;
		$mail->isHTML(true);
		$obj['subject'] = 'Reset akun pengunjung';
		$obj['destination_email'] = $pengunjung->pgj_email;
		$obj['destination_name'] = '';
		$obj['body'] = 'Untuk mengatur ulang kata sandi akun anda silahkan klik tautan berikut ini';
		$obj['body'] .= "<a href='".$this->createAbsoluteUrl('site/confirmresetpasswordpgj',array('cfcd'=>$model->ver_cfcd))."'> Reset</a>";
		return $mail->kirim($obj);
		
	}

	public function actionConfirmResetPasswordUmkm(){
		$model = Verifikasiemail::model()->find('ver_cfcd = :cfcd AND ver_status = 0 AND ver_akuntipe = '.LevelLookup::ACCOUNT_UMKM,array(':cfcd'=>$_GET['cfcd']));
		$passModel = new PasswordForm;
		if($model === null)
			throw new CHttpException(403,"Link sudah tidak berlaku.");
		if(isset($_POST['PasswordForm'])){
			$passModel->attributes = $_POST['PasswordForm'];
			if($passModel->validate()){
				if(Admin::model()->updateByPk($model->ver_akunid,array('admin_password'=>sha1($passModel->password))) > 0){
					$model->ver_status = 1;
					$model->save();
					Yii::app()->user->setFlash('info','Password telah diubah, silahkan login menggunakan password yang baru.');
					$this->redirect('login');
				}
				else
					throw new CHttpException(444,"Password gagal diubah karena satu dan lain hal yang kemungkinan besar halaman error ini kecil munculnya");
					
			}
		}

		$this->render('confirmresetpassword',array('passModel'=>$passModel));
					
	}

	public function actionConfirmResetPasswordPgj(){
		$model = Verifikasiemail::model()->find('ver_cfcd = :cfcd AND ver_status = 0 AND ver_akuntipe = '.LevelLookup::ACCOUNT_VISITOR,array('cfcd'=>$_GET['cfcd']));
		$passModel = new PasswordForm;
		if($model === null)
			throw new CHttpException(403,"Link sudah tidak berlaku.");
		if(isset($_POST['PasswordForm'])){
			$passModel->attributes = $_POST['PasswordForm'];
			if($passModel->validate()){
				if(Pengunjung::model()->updateByPk($model->ver_akunid,array('pgj_password'=>sha1($passModel->password))) > 0){
					$model->ver_status = 1;
					$model->save();
					Yii::app()->user->setFlash('info','Password telah diubah, silahkan login menggunakan password yang baru.');
					$this->redirect('login');
				}
				else
					throw new CHttpException(444,"Password gagal diubah karena satu dan lain hal yang kemungkinan besar halaman error ini kecil munculnya");
					
			}
		}

		$this->render('confirmresetpassword',array('passModel'=>$passModel));
					
	}

}