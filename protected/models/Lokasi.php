<?php

/**
 * This is the model class for table "lokasi".
 *
 * The followings are the available columns in table 'lokasi':
 * @property integer $lokasi_id
 * @property string $lokasi_kode
 * @property string $lokasi_nama
 * @property integer $lokasi_propinsi
 * @property string $lokasi_kabupatenkota
 * @property string $lokasi_kecamatan
 * @property string $lokasi_kelurahan
 *
 * The followings are the available model relations:
 * @property Umkm[] $umkms
 */
class Lokasi extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'lokasi';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('lokasi_propinsi, lokasi_kecamatan, lokasi_kelurahan', 'required'),
			array('lokasi_id, lokasi_propinsi', 'numerical', 'integerOnly'=>true),
			array('lokasi_kode', 'length', 'max'=>50),
			array('lokasi_nama', 'length', 'max'=>100),
			array('lokasi_kabupatenkota, lokasi_kecamatan', 'length', 'max'=>2),
			array('lokasi_kelurahan', 'length', 'max'=>4),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('lokasi_id, lokasi_kode, lokasi_nama, lokasi_propinsi, lokasi_kabupatenkota, lokasi_kecamatan, lokasi_kelurahan', 'safe', 'on'=>'search'),
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
			'umkms' => array(self::HAS_MANY, 'Umkm', 'umkm_lokasi_kode'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'lokasi_id' => 'Lokasi',
			'lokasi_kode' => 'Lokasi Kode',
			'lokasi_nama' => 'Lokasi Nama',
			'lokasi_propinsi' => 'Lokasi Propinsi',
			'lokasi_kabupatenkota' => 'Lokasi Kabupatenkota',
			'lokasi_kecamatan' => 'Lokasi Kecamatan',
			'lokasi_kelurahan' => 'Lokasi Kelurahan',
		);
	}


	public function getProvinsi(){
		$arr = array();
		$res = $this->findAll('lokasi_kabupatenkota = :kota AND lokasi_kecamatan = :kecamatan AND lokasi_kelurahan = :kelurahan',
			array(':kota'=>'00','kecamatan'=>'00',':kelurahan'=>'0000'));
		foreach ($res as $key => $value) {
			$arr[$value->lokasi_propinsi] = $value->lokasi_nama;
		}
		return $arr;
	}

	public function getKota($kodepropinsi){
		$arr = array();
		$res = $this->findAll('lokasi_propinsi = :provinsi AND lokasi_kabupatenkota != :kota AND lokasi_kecamatan = :kecamatan AND lokasi_kelurahan = :kelurahan',
			array(':provinsi'=> $kodepropinsi,':kota'=>'00','kecamatan'=>'00',':kelurahan'=>'0000'));
		foreach ($res as $key => $value) {
			$arr[$value->lokasi_id] = ucwords(strtolower($value->lokasi_nama));
		}
		return $arr;
	}

	public function getKecamatan($idkota){
		$row = $this->find('lokasi_id = ?',array($idkota));
		$kodepropinsi = $row->lokasi_propinsi;
		$kodekota = $row->lokasi_kabupatenkota;

		$arr = array();
		$res = $this->findAll('lokasi_propinsi = :provinsi AND lokasi_kabupatenkota = :kota AND lokasi_kelurahan = :kelurahan AND lokasi_kecamatan != :kecamatan',
			array(':provinsi'=> $kodepropinsi,':kota'=> $kodekota,':kecamatan'=>'00',':kelurahan'=>'0000'));
		foreach ($res as $key => $value) {
			$arr[$value->lokasi_id] = ucwords(strtolower($value->lokasi_nama));
		}
		return $arr;
	}

	public function getDesa($idkecamatan){
		$row = $this->find('lokasi_id = ?',array($idkecamatan));
		$kodepropinsi = $row->lokasi_propinsi;
		$kodekota = $row->lokasi_kabupatenkota;
		$kodekecamatan = $row->lokasi_kecamatan;

		$arr = array();
		$res = $this->findAll('lokasi_propinsi = :provinsi AND lokasi_kabupatenkota = :kota AND lokasi_kecamatan = :kecamatan AND lokasi_kelurahan != :kelurahan',
			array(':provinsi'=> $kodepropinsi,':kota'=> $kodekota,':kecamatan'=>$kodekecamatan,':kelurahan'=>'0000'));
		foreach ($res as $key => $value) {
			$arr[$value->lokasi_kode] = ucwords(strtolower($value->lokasi_nama));
		}
		return $arr;
	}

	public function namaProvinsi(){
		$mod = $this->find('lokasi_propinsi = ? AND lokasi_kabupatenkota = 0 AND lokasi_kecamatan = 0 AND lokasi_kelurahan = 0',array($this->lokasi_propinsi));
		return $mod->lokasi_nama;
	}

	public function namaKabupaten(){
		$mod = $this->find('lokasi_propinsi = ? AND lokasi_kabupatenkota = ? AND lokasi_kecamatan = 0 AND lokasi_kelurahan = 0',
								array($this->lokasi_propinsi,$this->lokasi_kabupatenkota));
		return $mod->lokasi_nama;	
	}

	public function namaKecamatan(){
		$mod = $this->find('lokasi_propinsi = ? AND lokasi_kabupatenkota = ? AND lokasi_kecamatan = ? AND lokasi_kelurahan = 0',
								array($this->lokasi_propinsi,$this->lokasi_kabupatenkota,$this->lokasi_kecamatan));
		return $mod->lokasi_nama;	
	}

	public function alamatLengkap($space=''){
		return "Desa ".ucwords(strtolower($this->lokasi_nama.",".$space." Kecamatan ".$this->namaKecamatan().", ".$this->namaKabupaten().", ".$space.$this->namaProvinsi()));
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

		$criteria->compare('lokasi_id',$this->lokasi_id);
		$criteria->compare('lokasi_kode',$this->lokasi_kode,true);
		$criteria->compare('lokasi_nama',$this->lokasi_nama,true);
		$criteria->compare('lokasi_propinsi',$this->lokasi_propinsi);
		$criteria->compare('lokasi_kabupatenkota',$this->lokasi_kabupatenkota,true);
		$criteria->compare('lokasi_kecamatan',$this->lokasi_kecamatan,true);
		$criteria->compare('lokasi_kelurahan',$this->lokasi_kelurahan,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Lokasi the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
