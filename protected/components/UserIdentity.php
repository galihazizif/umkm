<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
	/**
	 * Authenticates a user.
	 * The example implementation makes sure if the username and password
	 * are both 'demo'.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 */
	public $tipe;
	private $xid;


	public function authenticate()
	{

		$username = strtolower($this->username);
		$password = $this->password;
		$tipe	  = $this->tipe;

		
		if($tipe == LevelLookup::ACCOUNT_UMKM){
			$user = Admin::model()->find('admin_email = ?',array($username));
		}else if($tipe == LevelLookup::ACCOUNT_SYSADMIN){
			$user = Sysadmin::model()->find('sys_email = ?',array($username));
		}else{
			$user = Pengunjung::model()->find('pgj_email = ?',array($username));
		}
		
		if($user === null){
			$this->errorCode=self::ERROR_USERNAME_INVALID;
		}
		elseif(!$user->validatePassword($password)){
			$this->errorCode=self::ERROR_PASSWORD_INVALID;
		}
		else{
				$this->errorCode=self::ERROR_NONE;
				
				switch ($tipe) {
					case 1: $this->xid = $tipe.'_'.$user->admin_id; break;
					case 2: $this->xid = $tipe.'_'.$user->sys_id; break;
					case 3: $this->xid = $tipe.'_'.$user->pgj_id; break;
				}
			}

		return !$this->errorCode;
	}

	public function getId(){
		return $this->xid;
	}
}