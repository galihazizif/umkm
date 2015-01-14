<?php

/**
 * This is the model class for table "pengunjung".
 *
 * The followings are the available columns in table 'pengunjung':
 * @property string $pgj_id
 * @property string $pgj_email
 * @property string $pgj_password
 * @property string $pgj_nama
 * @property string $pgj_nohp
 * @property string $pgj_alamat
 * @property string $pgj_lastlogin
 * @property string $pgj_ref
 * @property integer $pgj_status
 *
 * The followings are the available model relations:
 * @property Transaksi[] $transaksis
 */
class Pengunjung extends CActiveRecord
{

	public $emailconf;
	public $passconf;
	public $verifyCode;
	public $provinsi;
	public $kabupaten;
	public $kecamatan;
	public $desa;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'pengunjung';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('pgj_email, emailconf, pgj_password, passconf, pgj_nama, pgj_nohp, pgj_alamat, provinsi, kabupaten, kecamatan, desa', 'required'),
			array('pgj_email, pgj_password, pgj_alamat, pgj_ref', 'length', 'max'=>45),
			array('pgj_email','unique','message'=>'Alamat email ini sudah terpakai, silahkan ganti yang lain'),
			array('pgj_nohp','numerical'),
			array('pgj_nama', 'length', 'max'=>50),
			array('pgj_email','email'),
			array('pgj_email','compare','compareAttribute'=>'emailconf'),
			array('pgj_password','compare','compareAttribute'=>'passconf'),
			array('verifyCode', 'captcha', 'allowEmpty'=>!CCaptcha::checkRequirements()),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('pgj_id, pgj_email, pgj_password, pgj_nama, pgj_alamat, pgj_lastlogin, pgj_ref, pgj_status', 'safe', 'on'=>'search'),
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
			'transaksis' => array(self::HAS_MANY, 'Transaksi', 'trans_pgj_id'),
			'pgjLokasiKode' => array(self::BELONGS_TO, 'Lokasi', 'pgj_lokasi'),
		);
	}

	public function validatePassword($password){
		if($this->pgj_password == sha1($password)){
				$this->pgj_lastlogin = date('Y-m-d H:i:s');
				$this->save(false);
			return true;
		}
		return false;
	}

	protected function beforeSave(){
		if($this->isNewRecord){
			$pass = sha1($this->pgj_password);
			$this->pgj_password = $pass;	
		}
		return true;
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'pgj_id' => 'ID',
			'pgj_email' => 'Email',
			'emailconf'=>'Konfirmasi Email',
			'pgj_password' => 'Password',
			'passconf'=>'Konfirmasi Password',
			'pgj_nama' => 'Nama',
			'pgj_nohp' => 'Nomor Ponsel',
			'pgj_lokasi' => 'Alamat',
			'pgj_alamat' => 'Alamat Tambahan',
			'pgj_lastlogin' => 'Last Transaction',
			'pgj_ref' => 'Ref',
			'pgj_status' => 'Status',
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

		$criteria->compare('pgj_id',$this->pgj_id,true);
		$criteria->compare('pgj_email',$this->pgj_email,true);
		$criteria->compare('pgj_password',$this->pgj_password,true);
		$criteria->compare('pgj_nama',$this->pgj_nama,true);
		$criteria->compare('pgj_alamat',$this->pgj_alamat,true);
		$criteria->compare('pgj_lastlogin',$this->pgj_lastlogin,true);
		$criteria->compare('pgj_ref',$this->pgj_ref,true);
		$criteria->compare('pgj_status',$this->pgj_status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Pengunjung the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
