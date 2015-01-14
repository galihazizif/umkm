<?php

class StylerController extends Controller
{	

	public $layout = '//layouts/main';

	public function actionKustomisasi()
	{
		// $this->styler = array('body'=>array('background'=>$umkm->kustomisasi->kus_background));

		$umkm = Umkm::model()->findByPk(Yii::app()->user->getUmkmId());	
		$kustomisasi = Kustomisasi::model()->findByPk(Yii::app()->user->getUmkmId());
		if(isset($_POST['background-type'])){

			if($_POST['background-type'] == 'color'){
				$bg = $_POST['bg-color'];
			}else{
				$umkmId = Yii::app()->user->getUmkmId();
				$mod 	= CUploadedFile::getInstanceByName('bg-image');
				$ext 	= $mod->getExtensionName();
				$size  	= $mod->getSize();
				$type 	= $mod->getType();
				if($mod !== null){
					if($ext == 'jpg' || $ext == 'png' || $ext == 'jpeg' || $ext == 'gif'){
						if($size < 400000){
							$mod->saveAs('./data/background/'.$umkmId.'.'.$ext);
							$bg = 'url(\''.Yii::app()->baseUrl.'/data/background/'.$umkmId.'.'.$ext.'\') '.$_POST['bg-image-repeat'];							
						}
						else{
							$error['size'] = "Ukuran file harus dibawah 400 kB,";
						}
					}
					else{
					 $error['ext'] = "File harus berjenis .jpg, jpeg, .gif atau .png";
					}
				}
				if(isset($error)){
					$err = '';
					foreach ($error as $key => $value) {
						$err .= $value;
					}
					Yii::app()->user->setFlash('info','GAGAL! '.$err);
					$this->render('kustomisasi',array('umkm'=>$umkm));
					exit();
				}
			}

			$cssarray = array(
				'.well'=>array('background'=>$_POST['scheme-background'],'color'=>$_POST['scheme-foreground']),
				'body'=>array('background'=>$bg,'color'=>$_POST['scheme-font-color']),
				'a,a:hover,.footer div li a'=>array('color'=>$_POST['scheme-link']),
				'.footer div'=>array('color'=>$_POST['scheme-font-color']),
				'.x-media'=>array('border-color'=>$_POST['scheme-link']),
				);
			
			$st = '';
			foreach ($cssarray as $key => $value) {
				$st .= $key.' { ';
				foreach ($value as $key2 => $value2) {
					$st .= $key2.': '.$value2.'; ';
				}
				$st .= '} ';
			}

			$kustomisasi->kus_background = $st;
			$kustomisasi->save();
			Yii::app()->user->setFlash('info','Perubahan telah disimpan.');
		}

		$this->render('kustomisasi',array('umkm'=>$umkm));
	}

	public function actionCacheManifest(){
		header('Content-type:text/cache-manifest');
		echo 'CACHE MANIFEST'.PHP_EOL;
		echo '';
		echo Yii::app()->request->baseUrl.'/assets/8fad649/jquery.js'.PHP_EOL;
		echo Yii::app()->request->baseUrl.'/assets/281c8336/listview/styles.css '.PHP_EOL;
		echo Yii::app()->request->baseUrl.'/assets/b05c85c0/pager.css'.PHP_EOL;
		echo Yii::app()->request->baseUrl.'/assets/8fad649/jquery.ba-bbq.js'.PHP_EOL;
		echo Yii::app()->request->baseUrl.'/public/assets/js/bootstrap.js'.PHP_EOL;
		echo Yii::app()->request->baseUrl.'/public/assets/js/bootstrap-collapse.js'.PHP_EOL;
		echo Yii::app()->request->baseUrl.'/public/assets/js/bootstrap-tab.js'.PHP_EOL;
		echo Yii::app()->request->baseUrl.'/public/assets/js/bootstrap-modal.js'.PHP_EOL;
		echo Yii::app()->request->baseUrl.'/public/assets/js/bootstrap-transition.js'.PHP_EOL;
		echo Yii::app()->request->baseUrl.'/public/assets/css/bootstrap.css'.PHP_EOL;
		echo Yii::app()->request->baseUrl.'/public/assets/css/bootstrap-responsive.css'.PHP_EOL;
		echo Yii::app()->request->baseUrl.'/public/assets/css/override.css'.PHP_EOL;
		echo 'NETWORK:'.PHP_EOL;
		echo '*';
	
	}

	public function filters(){
		return array(
			'accessControl', //
		);
	}

	public function accessRules()
	{
		return array(
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('kustomisasi'),
				'expression'=>'$user->isUmkm()',
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('cachemanifest'),
				'users'=>array('*'),
			),
			array('deny', // allow admin user to perform 'admin' and 'delete' actions
				'users'=>array('*'),
			),
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