<?php

/**
 * This is the model class for table "produk".
 *
 * The followings are the available columns in table 'produk':
 * @property string $prod_id
 * @property string $prod_nama
 * @property string $prod_deskripsi
 * @property string $prod_kat_id
 * @property string $prod_harga
 * @property string $prod_satuan
 * @property string $prod_img
 * @property integer $prod_umkm_id
 * @property integer $prod_status
 *
 * The followings are the available model relations:
 * @property Items $items
 * @property Kategoriproduk $prodKat
 * @property Umkm $prodUmkm
 */
class Produk extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */

	public $stok;

	public function tableName()
	{
		return 'produk';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('prod_nama, prod_kat_id, prod_harga, prod_umkm_id', 'required'),
			array('prod_umkm_id, prod_status, stok', 'numerical', 'integerOnly'=>true),
			array('prod_nama', 'length', 'max'=>45),
			array('prod_deskripsi', 'length', 'max'=>255),
			array('prod_kat_id', 'length', 'max'=>7),
			array('prod_harga', 'length', 'max'=>10),
			array('prod_satuan', 'length', 'max'=>25),
			array('prod_img', 'length', 'max'=>200),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('prod_id, prod_nama, prod_deskripsi, prod_kat_id, prod_harga, prod_satuan, prod_img, prod_umkm_id, prod_status', 'safe', 'on'=>'search'),
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
			'items' => array(self::HAS_ONE, 'Items', 'item_prod_id'),
			'prodKat' => array(self::BELONGS_TO, 'Kategoriproduk', 'prod_kat_id'),
			'prodUmkm' => array(self::BELONGS_TO, 'Umkm', 'prod_umkm_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'prod_id' => 'Prod',
			'prod_nama' => 'Nama Produk',
			'prod_deskripsi' => 'Deskripsi',
			'prod_kat_id' => 'Kategori',
			'prod_harga' => 'Harga Satuan',
			'prod_img'=>'Gambar',
			'stok'=>'Jumlah Barang',
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

		$criteria->compare('prod_id',$this->prod_id,true);
		$criteria->compare('prod_nama',$this->prod_nama,true);
		$criteria->compare('prod_deskripsi',$this->prod_deskripsi,true);
		$criteria->compare('prod_kat_id',$this->prod_kat_id,true);
		$criteria->compare('prod_harga',$this->prod_harga,true);
		$criteria->compare('prod_satuan',$this->prod_satuan,true);
		$criteria->compare('prod_img',$this->prod_img,true);
		$criteria->compare('prod_umkm_id',$this->prod_umkm_id);
		$criteria->compare('prod_status',$this->prod_status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	protected function beforeDelete(){
		$item = Items::model()->loadModel($this->prod_id);
		return $item->delete();
	}

	protected function afterSave(){
			$item = Items::model()->loadModel($this->prod_id);
			$item->item_prod_id = $this->prod_id;
			$item->item_status = 1;
			$item->item_stok = $this->stok;
			$item->item_lastupdated = date('Y-m-d H:i:s');
			$item->save();
			return true;
	}

	public function onlyThisUmkm($umkmId){
		$criteria=new CDbCriteria;
		$criteria->addSearchCondition('prod_nama',$this->prod_nama,true,'OR');
		$criteria->addSearchCondition('prod_deskripsi',$this->prod_nama,true,'OR');
		$criteria->addCondition('prod_umkm_id = '.$umkmId);
		return new CActiveDataProvider($this, array(
			'pagination'=>array(
				'pageSize'=>10),
			'criteria'=>$criteria,
		));		
	}


	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Produk the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
