<?php

/**
 * This is the model class for table "sysadmin".
 *
 * The followings are the available columns in table 'sysadmin':
 * @property string $sys_id
 * @property string $sys_email
 * @property string $sys_alias
 * @property string $sys_password
 * @property string $sys_lastlogin
 * @property integer $sys_status
 */
class Sysadmin extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'sysadmin';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('sys_email, sys_password, sys_status', 'required'),
			array('sys_status', 'numerical', 'integerOnly'=>true),
			array('sys_email, sys_alias, sys_password', 'length', 'max'=>45),
			array('sys_lastlogin', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('sys_id, sys_email, sys_alias, sys_password, sys_lastlogin, sys_status', 'safe', 'on'=>'search'),
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

	public function validatePassword($password){
		if($this->sys_password == sha1($password))
			return true;
		return false;
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'sys_id' => 'Sys',
			'sys_email' => 'Sys Email',
			'sys_alias' => 'Sys Alias',
			'sys_password' => 'Sys Password',
			'sys_lastlogin' => 'Sys Lastlogin',
			'sys_status' => 'Sys Status',
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

		$criteria->compare('sys_id',$this->sys_id,true);
		$criteria->compare('sys_email',$this->sys_email,true);
		$criteria->compare('sys_alias',$this->sys_alias,true);
		$criteria->compare('sys_password',$this->sys_password,true);
		$criteria->compare('sys_lastlogin',$this->sys_lastlogin,true);
		$criteria->compare('sys_status',$this->sys_status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Sysadmin the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
