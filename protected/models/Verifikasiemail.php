<?php

/**
 * This is the model class for table "verifikasiemail".
 *
 * The followings are the available columns in table 'verifikasiemail':
 * @property string $ver_id
 * @property string $ver_cfcd
 * @property integer $ver_akuntipe
 * @property integer $ver_akunid
 * @property string $ver_status
 */
class Verifikasiemail extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'verifikasiemail';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			// array('ver_cfcd, ver_akuntipe, ver_status', 'required'),
			array('ver_akuntipe, ver_akunid', 'numerical', 'integerOnly'=>true),
			array('ver_cfcd', 'length', 'max'=>50),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('ver_id, ver_cfcd, ver_akuntipe, ver_akunid, ver_status', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ver_id' => 'Ver',
			'ver_cfcd' => 'Ver Cfcd',
			'ver_akuntipe' => 'Ver Akuntipe',
			'ver_akunid' => 'Ver Akunid',
			'ver_status' => 'Ver Status',
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

		$criteria->compare('ver_id',$this->ver_id,true);
		$criteria->compare('ver_cfcd',$this->ver_cfcd,true);
		$criteria->compare('ver_akuntipe',$this->ver_akuntipe);
		$criteria->compare('ver_akunid',$this->ver_akunid);
		$criteria->compare('ver_status',$this->ver_status,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Verifikasiemail the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
