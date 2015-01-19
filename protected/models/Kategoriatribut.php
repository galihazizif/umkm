<?php

/**
 * This is the model class for table "kategoriatribut".
 *
 * The followings are the available columns in table 'kategoriatribut':
 * @property string $ka_id
 * @property string $ka_nama
 *
 * The followings are the available model relations:
 * @property Atribut[] $atributs
 * @property Pages[] $pages
 */
class Kategoriatribut extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'kategoriatribut';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ka_id, ka_nama', 'required'),
			array('ka_id', 'length', 'max'=>5),
			array('ka_id', 'unique'),
			array('ka_nama', 'length', 'max'=>45),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('ka_id, ka_nama', 'safe', 'on'=>'search'),
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
			'atributs' => array(self::HAS_MANY, 'Atribut', 'at_kategori_id'),
			'pages' => array(self::HAS_MANY, 'Pages', 'p_kategori'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ka_id' => 'Kode Kategori',
			'ka_nama' => 'Nama Kategori',
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

		$criteria->compare('ka_id',$this->ka_id,true);
		$criteria->compare('ka_nama',$this->ka_nama,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Kategoriatribut the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
