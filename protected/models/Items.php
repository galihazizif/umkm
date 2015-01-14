<?php

/**
 * This is the model class for table "items".
 *
 * The followings are the available columns in table 'items':
 * @property integer $item_prod_id
 * @property integer $item_status
 * @property integer $item_stok
 * @property string $item_lastupdated
 *
 * The followings are the available model relations:
 * @property Produk $itemProd
 * @property Keranjang[] $keranjangs
 * @property Transaksi[] $transaksis
 */
class Items extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'items';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('item_status', 'required'),
			array('item_status, item_stok', 'numerical', 'integerOnly'=>true),
			array('item_lastupdated', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('item_prod_id, item_status, item_stok, item_lastupdated', 'safe', 'on'=>'search'),
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
			'itemProd' => array(self::BELONGS_TO, 'Produk', 'item_prod_id'),
			'keranjangs' => array(self::HAS_MANY, 'Keranjang', 'krj_item_id'),
			'transaksis' => array(self::HAS_MANY, 'Transaksi', 'trans_item_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'item_prod_id' => 'Item Prod',
			'item_status' => 'Item Status',
			'item_stok' => 'Stok',
			'item_lastupdated' => 'Item Lastupdated',
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

		$criteria->compare('item_prod_id',$this->item_prod_id,true);
		$criteria->compare('item_status',$this->item_status);
		$criteria->compare('item_stok',$this->item_stok);
		$criteria->compare('item_lastupdated',$this->item_lastupdated,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function onlyThisUmkm($umkmId){
		$criteria=new CDbCriteria;
		$criteria->join = 'JOIN produk ON produk.prod_id=item_prod_id';
		$criteria->addCondition(array(
			'condition'=>'produk.prod_umkm_id='.$umkmId,));
		return new CActiveDataProvider($this, array(
			'pagination'=>array(
				'pageSize'=>5),
			'criteria'=>$criteria,
		));		
	}

	public function loadModel($id){
		$model = $this->findByPk($id);
		if($model === null){
			$model = new Items();
		}
		return $model;
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Items the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
