<?php

/**
 * This is the model class for table "admin".
 *
 * The followings are the available columns in table 'admin':
 * @property string $admin_id
 * @property string $admin_email
 * @property string $admin_password
 * @property string $admin_regdate
 * @property string $admin_lastlogin
 * @property integer $admin_umkm_id
 * @property integer $admin_status
 *
 * The followings are the available model relations:
 * @property Umkm $adminUmkm
 */
class Admin extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */

	public function tableName()
	{
		return 'admin';
	}

	public function getStatusLabel(){
		if($this->admin_status == 1){
			return 'Email Terverifikasi';
		}
		else{
			return 'Email Belum Terverifikasi';	
		}
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			// array('admin_email, admin_umkm_id', 'required'),
			array('admin_umkm_id, admin_status', 'numerical', 'integerOnly'=>true),
			array('admin_email, admin_password, admin_regdate, admin_lastlogin', 'length', 'max'=>45),
			array('admin_email','unique'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('admin_id, admin_email, admin_password, admin_regdate, admin_lastlogin, admin_umkm_id, admin_status', 'safe', 'on'=>'search'),
		);
	}

	public function isExist($email){
		$email = $this->find('admin_email = ?',array($email));
		if(isset($email))
			return true;
		return false;
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'adminUmkm' => array(self::BELONGS_TO, 'Umkm', 'admin_umkm_id'),
		);
	}

	public function validatePassword($password){
		if($this->admin_password == sha1($password)){
			$this->admin_lastlogin = date('Y-m-d H:i:s');
			$this->save();
			return true;
		}
		return false;
	}

	/**
	 * @return array customized attribute labels (name=>label)	
	 */

	public function ownerShip(){
		if($this->admin_isowner == 1)
			return 'Pemilik';
		else
			return 'Bukan Pemilik';
	}

	public function attributeLabels()
	{
		return array(
			'admin_id' => 'ID Admin',
			'admin_email' => 'Email',
			'admin_password' => 'Password',
			'admin_regdate' => 'Tanggal Registrasi',
			'admin_lastlogin' => 'Login Terakhir',
			'admin_umkm_id' => 'UMKM',
			'admin_isowner' => 'Kepemilikan',
			'admin_status' => 'Status',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('admin_id',$this->admin_id,true);
		$criteria->compare('admin_email',$this->admin_email,true);
		$criteria->compare('admin_password',$this->admin_password,true);
		$criteria->compare('admin_regdate',$this->admin_regdate,true);
		$criteria->compare('admin_lastlogin',$this->admin_lastlogin,true);
		$criteria->compare('admin_umkm_id',$this->admin_umkm_id);
		$criteria->compare('admin_status',$this->admin_status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	
	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Admin the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
