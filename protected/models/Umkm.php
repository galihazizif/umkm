<?php

/**
 * This is the model class for table "umkm".
 *
 * The followings are the available columns in table 'umkm':
 * @property integer $umkm_id
 * @property string $umkm_nama
 * @property string $umkm_deskripsi
 * @property string $umkm_telp
 * @property string $umkm_alamat
 * @property string $umkm_email
 * @property string $umkm_lokasi_kode
 * @property string $umkm_noreg
 * @property string $umkm_pemilik
 * @property string $umkm_pemilik_idcard
 * @property integer $umkm_status
 *
 * The followings are the available model relations:
 * @property Admin[] $admins
 * @property Kustomisasi $kustomisasi
 * @property Produk[] $produks
 * @property Lokasi $umkmLokasiKode
 */
class Umkm extends CActiveRecord
{

	public $provinsi;
	public $kabupaten;
	public $kecamatan;
	public $desa;

	const STATUS_REGISTERED = 0;
	const STATUS_VERIFIED = 1;
	const STATUS_SUSPENDED = 9;

	public function getStatusLabel(){
		switch ($this->umkm_status) {
			case self::STATUS_REGISTERED:
				return 'Belum Terverifikasi';
				break;
			case self::STATUS_VERIFIED:
				return 'Terverifikasi';
				break;
			case self::STATUS_SUSPENDED:
				return 'Tidak Aktif';
				break;
		}
	}
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'umkm';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('umkm_nama,umkm_lokasi_kode,umkm_email,provinsi,kabupaten,kecamatan,desa','required'),
			array('umkm_nama, umkm_telp, umkm_email, umkm_noreg, umkm_pemilik, umkm_pemilik_idcard', 'length', 'max'=>45),
			array('umkm_telp','numerical'),
			array('umkm_email','unique'),
			array('umkm_imgurl','file','types'=>"jpg,png,jpeg",'maxSize'=>400000,'allowEmpty'=>true),
			array('umkm_alias','unique','message'=>'Alias UMKM sudah dipakai, silahkan gunakan yang lain'),
			array('umkm_deskripsi', 'length', 'max'=>255),
			array('umkm_alamat', 'length', 'max'=>100),
			array('umkm_lokasi_kode', 'length', 'max'=>50),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('umkm_id, umkm_nama, umkm_deskripsi, umkm_telp, umkm_alamat, umkm_email, umkm_lokasi_kode, umkm_noreg, umkm_pemilik, umkm_pemilik_idcard, umkm_status', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'admins' => array(self::HAS_MANY, 'Admin', 'admin_umkm_id'),
			'kustomisasi' => array(self::HAS_ONE, 'Kustomisasi', 'kus_umkm_id'),
			'produks' => array(self::HAS_MANY, 'Produk', 'prod_umkm_id'),
			'atributs' => array(self::HAS_MANY, 'Atribut', 'at_umkm_id'),
			'umkmLokasiKode' => array(self::BELONGS_TO, 'Lokasi', 'umkm_lokasi_kode'),
		);
	}

	protected function afterSave(){
		if($this->isNewRecord){
			$kus = new Kustomisasi;
			$kus->kus_umkm_id = $this->umkm_id;
			$kus->save();	
		}
		
		return true;
	}

	protected function beforeSave(){
		if($this->umkm_alias == ''){
			$this->umkm_alias = substr(sha1(time().microtime()),0,15);
		}else{
			$_umkm = $this->umkm_alias;
				$this->umkm_alias = preg_replace('/[^a-zA-Z0-9\.]/','',$_umkm);
		}
		return true;
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'umkm_id' => 'Umkm',
			'umkm_nama' => 'Nama UMKM',
			'umkm_deskripsi' => 'Deskripsi',
			'umkm_telp' => 'Telepon Utama',
			'umkm_alamat' => 'Alamat Tambahan',
			'umkm_email' => 'Email',
			'umkm_lokasi_kode' => 'Lokasi',
			'umkm_noreg' => 'Nomor Registrasi (Optional)',
			'umkm_pemilik' => 'Nama Pemilik',
			'umkm_pemilik_idcard' => 'ID Pemilik',
			'umkm_imgurl'=>'Avatar',
			'umkm_status' => 'Status',
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

	public function isExist($email){
		$email = $this->find('umkm_email = ?',array($email));
		if(isset($email))
			return true;
		return false;
	}

	public function isAliasExist($alias){
		$model = $this->find('umkm_alias = ?',array($alias));
		if(isset($model))
			return true;
		return false;
	}



	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('umkm_id',$this->umkm_id);
		$criteria->compare('umkm_nama',$this->umkm_nama,true);
		$criteria->compare('umkm_deskripsi',$this->umkm_deskripsi,true);
		$criteria->compare('umkm_telp',$this->umkm_telp,true);
		$criteria->compare('umkm_alamat',$this->umkm_alamat,true);
		$criteria->compare('umkm_email',$this->umkm_email,true);
		$criteria->compare('umkm_lokasi_kode',$this->umkm_lokasi_kode,true);
		$criteria->compare('umkm_noreg',$this->umkm_noreg,true);
		$criteria->compare('umkm_pemilik',$this->umkm_pemilik,true);
		$criteria->compare('umkm_pemilik_idcard',$this->umkm_pemilik_idcard,true);
		$criteria->compare('umkm_status',$this->umkm_status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function getUrl(){
		if($this->umkm_alias != null){
			return CController::createUrl('u/1',array('a'=>$this->umkm_alias));
		}else{
			return CController::createUrl('u/1',array('id'=>$this->umkm_id));
		}
	}

	// protected function afterSave(){

			
	// 		return true;
	// }


	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Umkm the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
