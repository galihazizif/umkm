<?php

/**
 * This is the model class for table "pages".
 *
 * The followings are the available columns in table 'pages':
 * @property integer $p_id
 * @property string $p_judul
 * @property string $p_alias
 * @property string $p_isi
 * @property integer $p_umkm_id
 * @property integer $p_status
 * @property string $p_kategori
 *
 * The followings are the available model relations:
 * @property Kategoriatribut $pKategori
 * @property Umkm $pUmkm
 */
class Pages extends CActiveRecord
{

	const STATUS_UNPUBLISHED = 0;
	const STATUS_PUBLISHED = 1;
	const STATUS_BLOCKED = 9;

	public function getStatusLabel(){
		switch ($this->p_status) {
			case self::STATUS_UNPUBLISHED:
				return 'Unpublished';
				break;
			case self::STATUS_PUBLISHED:
				return 'Published';
				break;
			case self::STATUS_BLOCKED:
				return 'Blocked';
				break;
		}
	}

	/**
	 * @return string the associated database table name
	 */

	public function tableName()
	{
		return 'pages';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('p_judul, p_isi', 'required'),
			array('p_umkm_id, p_status', 'numerical', 'integerOnly'=>true),
			array('p_judul', 'length', 'max'=>70),
			array('p_alias', 'length', 'max'=>45),
			array('p_kategori', 'length', 'max'=>5),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('p_id, p_judul, p_alias, p_isi, p_umkm_id, p_status, p_kategori', 'safe', 'on'=>'search'),
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
			'pKategori' => array(self::BELONGS_TO, 'Kategoriatribut', 'p_kategori'),
			'pUmkm' => array(self::BELONGS_TO, 'Umkm', 'p_umkm_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'p_judul' => 'Judul',
			'p_alias' => 'Alias',
			'p_isi' => 'Isi',
			'p_status' => 'Status',
			'p_kategori' => 'Kategori',
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
		$criteria->addCondition('p_umkm_id = '.Yii::app()->user->getUmkmId());
		$criteria->select = array('p_id','p_judul','p_alias','p_status');

		$criteria->compare('p_id',$this->p_id);
		$criteria->compare('p_judul',$this->p_judul,true);
		$criteria->compare('p_alias',$this->p_alias,true);
		$criteria->compare('p_umkm_id',$this->p_umkm_id);
		$criteria->compare('p_status',$this->p_status);
		$criteria->compare('p_kategori',$this->p_kategori,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function searchAll()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;
		$criteria->select = array('p_id','p_judul','p_alias','p_status');
		$criteria->with = array('pUmkm'=>array(
			'joinType'=>'INNER JOIN'));

		$criteria->compare('p_id',$this->p_id);
		$criteria->compare('p_judul',$this->p_judul,true);
		$criteria->compare('p_alias',$this->p_alias,true);
		$criteria->compare('p_umkm_id',$this->p_umkm_id);
		$criteria->compare('p_status',$this->p_status);
		$criteria->compare('p_kategori',$this->p_kategori,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Pages the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
