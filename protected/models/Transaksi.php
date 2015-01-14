<?php

/**
 * This is the model class for table "transaksi".
 *
 * The followings are the available columns in table 'transaksi':
 * @property string $trans_id
 * @property string $trans_pgj_id
 * @property string $trans_item_id
 * @property string $trans_tanggal
 * @property integer $trans_status
 * @property string $trans_qty
 *
 * The followings are the available model relations:
 * @property Items $transItem
 * @property Pengunjung $transPgj
 */
class Transaksi extends CActiveRecord
{

		const STATUS_ADD = 1;
		const STATUS_APPROVED = 2;
		const STATUS_PAID = 3;
		const STATUS_SENT = 4;
		const STATUS_ABORTED = 9;


	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'transaksi';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('trans_pgj_id, trans_item_id, trans_status', 'required'),
			array('trans_status', 'numerical', 'integerOnly'=>true),
			array('trans_pgj_id, trans_item_id, trans_qty', 'length', 'max'=>10),
			array('trans_tanggal', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('trans_id, trans_pgj_id, trans_item_id, trans_tanggal, trans_status, trans_qty', 'safe', 'on'=>'search'),
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
			'transItem' => array(self::BELONGS_TO, 'Items', 'trans_item_id'),
			'transPgj' => array(self::BELONGS_TO, 'Pengunjung', 'trans_pgj_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'trans_id' => 'Trans',
			'trans_pgj_id' => 'Trans Pgj',
			'trans_item_id' => 'Trans Item',
			'trans_tanggal' => 'Trans Tanggal',
			'trans_status' => 'Trans Status',
			'trans_qty' => 'Trans Qty',
		);
	}

	public function getStatusLabel(){
		switch ($this->trans_status) {
			case self::STATUS_ADD:
				return 'Belum Dikonfirmasi';
				break;
			case self::STATUS_APPROVED:
				return 'Menunggu Pembayaran';
				break;
			case self::STATUS_PAID:
				return 'Sudah Dibayar';
				break;
			case self::STATUS_SENT:
				return 'Sudah Dikirim';
				break;
			case self::STATUS_ABORTED:
				return 'Batal';
				break;
		}
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
		$criteria->group = "trans_kodetrans";

		$criteria->compare('trans_id',$this->trans_id,true);
		$criteria->compare('trans_pgj_id',$this->trans_pgj_id,true);
		$criteria->compare('trans_item_id',$this->trans_item_id,true);
		$criteria->compare('trans_tanggal',$this->trans_tanggal,true);
		$criteria->compare('trans_status',$this->trans_status);
		$criteria->compare('trans_qty',$this->trans_qty,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Transaksi the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
