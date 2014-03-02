<?php

namespace backend\modules\master\models;

/**
 * This is the model class for table "customer".
 *
 * @property integer $id_customer
 * @property string $cd_cust
 * @property string $nm_cust
 * @property integer $id_cclass
 * @property string $contact_name
 * @property string $contact_number
 * @property string $status
 * @property string $create_date
 * @property integer $create_by
 * @property string $update_date
 * @property integer $update_by
 *
 * @property CustomerDetail $customerDetail
 */
class Customer extends \yii\db\ActiveRecord
{
	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return 'customer';
	}

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['cd_cust', 'nm_cust', 'id_cclass'], 'required'],
			[['id_cclass'], 'integer'],
			[['status'], 'string'],
			[['cd_cust'], 'string', 'max' => 13],
			[['nm_cust', 'contact_name', 'contact_number'], 'string', 'max' => 64],
			[['cd_cust'], 'unique']
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'id_customer' => 'Id Customer',
			'cd_cust' => 'Cd Cust',
			'nm_cust' => 'Nm Cust',
			'id_cclass' => 'Id Cclass',
			'contact_name' => 'Contact Name',
			'contact_number' => 'Contact Number',
			'status' => 'Status',
			'create_date' => 'Create Date',
			'create_by' => 'Create By',
			'update_date' => 'Update Date',
			'update_by' => 'Update By',
		];
	}

	/**
	 * @return \yii\db\ActiveRelation
	 */
	public function getCustomerDetail()
	{
		return $this->hasOne(CustomerDetail::className(), ['id_customer' => 'id_customer']);
	}

	public function behaviors()
	{
		return [
			'timestamp' => [
				'class' => 'backend\components\AutoTimestamp',
			],
			'changeUser' => [
				'class' => 'backend\components\AutoUser',
			]
		];
	}
}
