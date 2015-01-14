<?php

/**
 * This is the model class for table "pesan".
 *
 * The followings are the available columns in table 'pesan':
 * @property string $pes_id
 * @property string $pes_tanggal
 * @property string $pes_kategori
 * @property integer $pes_pengirimtipe
 * @property integer $pes_pengirimid
 * @property integer $pes_tujuantipe
 * @property integer $pes_tujuanid
 * @property string $pes_judul
 * @property string $pes_isi
 *
 * The followings are the available model relations:
 * @property Kategoriatribut $pesKategori
 */
class Pesan extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'pesan';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('pes_isi', 'required'),
			array('pes_pengirimtipe, pes_pengirimid, pes_tujuantipe, pes_tujuanid', 'numerical', 'integerOnly'=>true),
			array('pes_id', 'length', 'max'=>10),
			array('pes_kategori', 'length', 'max'=>5),
			array('pes_judul', 'length', 'max'=>45),
			array('pes_isi', 'length', 'max'=>350),

			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('pes_id, pes_tanggal, pes_kategori, pes_pengirimtipe, pes_pengirimid, pes_tujuantipe, pes_tujuanid, pes_judul, pes_isi', 'safe', 'on'=>'search'),
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
			'pesKategori' => array(self::BELONGS_TO, 'Kategoriatribut', 'pes_kategori'),
			'pesPengirimUmkm' => array(self::BELONGS_TO, 'Admin', 'pes_pengirimid'),
			'pesPengirimPengunjung' => array(self::BELONGS_TO, 'Pengunjung', 'pes_pengirimid'),
			'pesPengirimSysAdmin' => array(self::BELONGS_TO, 'Sysadmin', 'pes_pengirimid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'pes_id' => 'Pes',
			'pes_tanggal' => 'Pes Tanggal',
			'pes_kategori' => 'Pes Kategori',
			'pes_pengirimtipe' => 'Pes Pengirimtipe',
			'pes_pengirimid' => 'Pes Pengirimid',
			'pes_tujuantipe' => 'Pes Tujuantipe',
			'pes_tujuanid' => 'Pes Tujuanid',
			'pes_judul' => 'Judul',
			'pes_isi' => 'Pesan',
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

		$criteria->compare('pes_id',$this->pes_id,true);
		$criteria->compare('pes_tanggal',$this->pes_tanggal,true);
		$criteria->compare('pes_kategori',$this->pes_kategori,true);
		$criteria->compare('pes_pengirimtipe',$this->pes_pengirimtipe);
		$criteria->compare('pes_pengirimid',$this->pes_pengirimid);
		$criteria->compare('pes_tujuantipe',$this->pes_tujuantipe);
		$criteria->compare('pes_tujuanid',$this->pes_tujuanid);
		$criteria->compare('pes_judul',$this->pes_judul,true);
		$criteria->compare('pes_isi',$this->pes_isi,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Pesan the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
