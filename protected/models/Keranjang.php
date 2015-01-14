<?php

/**
 * This is the model class for table "keranjang".
 *
 * The followings are the available columns in table 'keranjang':
 * @property string $krj_id
 * @property string $krj_session
 * @property string $krj_pgj_id
 * @property string $krj_item_id
 * @property integer $krj_qty
 *
 * The followings are the available model relations:
 * @property Pengunjung $krjPgj
 * @property Items $krjItem
 */
class Keranjang extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */

	const STATUS_ADD = 0;
	const STATUS_CHECKEDOUT = 1;
	const STATUS_CANCELED = 9;


	public function tableName()
	{
		return 'keranjang';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('krj_session, krj_item_id', 'required'),
			array('krj_qty', 'numerical', 'integerOnly'=>true),
			array('krj_qty','numerical','min'=>1),
			array('krj_session', 'length', 'max'=>80),
			array('krj_pgj_id, krj_item_id', 'length', 'max'=>10),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('krj_id, krj_session, krj_pgj_id, krj_item_id, krj_qty', 'safe', 'on'=>'search'),
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
			'krjPgj' => array(self::BELONGS_TO, 'Pengunjung', 'krj_pgj_id'),
			'krjItem' => array(self::BELONGS_TO, 'Items', 'krj_item_id'),
			'krjProduk' => array(self::BELONGS_TO, 'Produk', 'krj_item_id'), /*additional, tidak ada constraint di DB*/
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'krj_id' => 'Krj',
			'krj_session' => 'Krj Session',
			'krj_pgj_id' => 'Krj Pgj',
			'krj_item_id' => 'Krj Item',
			'krj_qty' => 'Krj Qty',
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

		$criteria->compare('krj_id',$this->krj_id,true);
		$criteria->compare('krj_session',$this->krj_session,true);
		$criteria->compare('krj_pgj_id',$this->krj_pgj_id,true);
		$criteria->compare('krj_item_id',$this->krj_item_id,true);
		$criteria->compare('krj_qty',$this->krj_qty);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Keranjang the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
