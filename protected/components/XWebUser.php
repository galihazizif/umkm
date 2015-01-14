<?php
	class XWebUser extends CWebUser{
		protected $_id,$_model;
		public $tipe;

		function __construct(){
				$this->_model = $this->loadUser();
			// $this->ohh();
		}


		/*ATTENTION
		
		Level / TIPE Pengunjung, ini tidak terdapat dalam database, tapi mekanismenya ada di session:
		1. Admin UMKM.
		2. Sys Admin.
		3. Pengunjung.

		Status umkm sendiri dibagi menjadi 3, status tercatat pada `umkm.umkm_status`
		0. Not-Verified
		1. Verified
		9. Suspended.

		Status admin umkm, `admin.admin_status`:
		0. Email Registered
		1. Email Verified
		9. Suspended.

		Status pengunjung/pembeli, ada di `pengunjung.pgj_status`
		0. Email Registered
		1. Email Verified
		9. Suspended.


		*/


		function getEmail(){
			if(!$this->_model)
				$this->_model = $this->loadUser();

			switch($this->tipe){
				case 1: return $this->_model->admin_email; break;
				case 2: return $this->_model->sys_email; break;
				case 3: return $this->_model->pgj_email; break;
			}
		}

		function levelCheck(){

		 	self::__construct();
			if($this->_model){
				print "Tipe: ".$this->tipe;
				print "ID: ".$this->_id;
			}
		}	

		function getUmkmId(){
			self::__construct();
			if($this->isUmkm()){
				return $this->_model->admin_umkm_id;
			}
			return false;
		}

		/*Digunakan untuk memeriksa apakah email admin umkm sudah diverifikasi*/
		function isUmkmEmailVerified(){
			self::__construct();
			if($this->isUmkm()){
				return ($this->_model->admin_status == 1);
			}
			return false;
		}

		function isUmkmOwner(){
			self::__construct();
			if($this->isUmkm()){
				return ($this->_model->admin_isowner == 1);
			}
			return false;	
		}

		function isPgjEmailVerified(){
			self::__construct();
			if($this->isPengunjung()){
				return ($this->_model->pgj_status == 1);
			}
		}

		function getTipe(){
			self::__construct();
			return $this->tipe;
		}

		function _getId(){
			self::__construct();
			return $this->_id;
		}

		function isUmkm(){
			self::__construct();
			return ($this->tipe == 1);
		}

		function isSysAdmin(){
			self::__construct();
			return ($this->tipe == 2);
		}

		function isPengunjung(){
			self::__construct();
			return ($this->tipe == 3);
		}


		protected function loadUser(){
			if($this->isGuest)
				return false;

			$arr		 	= explode('_',$this->id);
			$this->tipe 	= $arr[0];
			$this->_id		= $arr[1];

			if(Yii::app()->cache->get($this->id) === false){
				switch($this->tipe){
					case 1: $user = Admin::model()->findByPk($this->_id); break;
					case 2: $user = Sysadmin::model()->findByPk($this->_id); break;
					case 3: $user = Pengunjung::model()->findByPk($this->_id); break;
				}
				Yii::app()->cache->set($this->id,$user,86400);
			}else{
				$user = Yii::app()->cache->get($this->id);
			}

			

			return $user;
			// $this->_model = $user;

		}

	}


?>