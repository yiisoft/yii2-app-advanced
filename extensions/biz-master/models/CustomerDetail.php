<?php

namespace biz\master\models;

/**
 * This is the model class for table "customer_detail".
 *
 * @property integer $id_customer
 * @property integer $id_distric
 * @property string $addr1
 * @property string $addr2
 * @property string $latitude
 * @property string $longtitude
 * @property integer $id_kab
 * @property integer $id_kec
 * @property integer $id_kel
 * @property string $file_name
 * @property string $file_type
 * @property string $create_date
 * @property integer $create_by
 * @property string $update_date
 * @property integer $update_by
 * @property integer $file_size
 *
 * @property Customer $idCustomer
 */
class CustomerDetail extends \yii\db\ActiveRecord
{
	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return 'customer_detail';
	}

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['id_customer', 'id_distric', 'addr1'], 'required'],
			[['id_customer', 'id_distric', 'id_kab', 'id_kec', 'id_kel', 'file_size'], 'integer'],
			[['latitude', 'longtitude'], 'string'],
			[['addr1', 'addr2'], 'string', 'max' => 128],
			[['file_name'], 'string', 'max' => 64],
			[['file_type'], 'string', 'max' => 32]
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'id_customer' => 'Id Customer',
			'id_distric' => 'Id Distric',
			'addr1' => 'Addr1',
			'addr2' => 'Addr2',
			'latitude' => 'Latitude',
			'longtitude' => 'Longtitude',
			'id_kab' => 'Id Kab',
			'id_kec' => 'Id Kec',
			'id_kel' => 'Id Kel',
			'file_name' => 'File Name',
			'file_type' => 'File Type',
			'create_date' => 'Create Date',
			'create_by' => 'Create By',
			'update_date' => 'Update Date',
			'update_by' => 'Update By',
			'file_size' => 'File Size',
		];
	}

	/**
	 * @return \yii\db\ActiveRelation
	 */
	public function getIdCustomer()
	{
		return $this->hasOne(Customer::className(), ['id_customer' => 'id_customer']);
	}

	public function behaviors()
	{
		return [
			'timestamp' => [
				'class' => 'app\tools\AutoTimestamp',
			],
			'changeUser' => [
				'class' => 'app\tools\AutoUser',
			]
		];
	}
}
