<?php

/**
 * This is the model class for table "kategoriproduk".
 *
 * The followings are the available columns in table 'kategoriproduk':
 * @property string $kat_id
 * @property string $kat_nama
 * @property integer $kat_status
 *
 * The followings are the available model relations:
 * @property Produk[] $produks
 */

class Kategoriproduk extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'kategoriproduk';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('kat_id, kat_nama', 'required'),
			array('kat_status', 'numerical', 'integerOnly'=>true),
			array('kat_id', 'length', 'max'=>7),
			array('kat_nama', 'length', 'max'=>45),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('kat_id, kat_nama, kat_status', 'safe', 'on'=>'search'),
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
			'produks' => array(self::HAS_MANY, 'Produk', 'prod_kat_id'),
		);
	}

	const STATUS_AKTIF = 1;
	const STATUS_TDK_AKTIF = 0;


	function getStatusLabel(){
		switch ($this->kat_status) {
			case self::STATUS_AKTIF:
				return 'Aktif';
				break;
			case self::STATUS_TDK_AKTIF:
				return 'Tidak Aktif';
				break;
		}
	}
	function getListAsArray(){
		$arr = array();
		$res = $this->findAll('kat_status = ?',array(self::STATUS_AKTIF));
		foreach ($res as $row) {
			$arr[$row->kat_id] = $row->kat_nama;
		}

		return $arr;
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'kat_id' => 'Kode Kategori',
			'kat_nama' => 'Nama Kategori',
			'kat_status' => 'Status',
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

		$criteria->compare('kat_id',$this->kat_id,true);
		$criteria->compare('kat_nama',$this->kat_nama,true);
		$criteria->compare('kat_status',$this->kat_status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Kategoriproduk the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
