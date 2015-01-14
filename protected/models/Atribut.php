<?php

/**
 * This is the model class for table "atribut".
 *
 * The followings are the available columns in table 'atribut':
 * @property integer $at_id
 * @property string $at_kategori_id
 * @property integer $at_umkm_id
 * @property string $at_text
 *
 * The followings are the available model relations:
 * @property Kategoriatribut $atKategori
 * @property Umkm $atUmkm
 */
class Atribut extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'atribut';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('at_kategori_id, at_umkm_id, at_text', 'required'),
			array('at_umkm_id', 'numerical', 'integerOnly'=>true),
			array('at_kategori_id', 'length', 'max'=>5),
			array('at_text', 'length', 'max'=>45),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('at_id, at_kategori_id, at_umkm_id, at_text', 'safe', 'on'=>'search'),
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
			'atKategori' => array(self::BELONGS_TO, 'Kategoriatribut', 'at_kategori_id'),
			'atUmkm' => array(self::BELONGS_TO, 'Umkm', 'at_umkm_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'at_id' => 'At',
			'at_kategori_id' => 'At Kategori',
			'at_umkm_id' => 'At Umkm',
			'at_text' => 'At Text',
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

		$criteria->compare('at_id',$this->at_id);
		$criteria->compare('at_kategori_id',$this->at_kategori_id,true);
		$criteria->compare('at_umkm_id',$this->at_umkm_id);
		$criteria->compare('at_text',$this->at_text,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Atribut the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
