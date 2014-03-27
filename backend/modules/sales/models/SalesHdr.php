<?php

namespace backend\modules\sales\models;

use backend\modules\master\models\Warehouse;
use backend\modules\master\models\Customer;

/**
 * This is the model class for table "sales_hdr".
 *
 * @property integer $id_sales_hdr
 * @property string $sales_num
 * @property integer $id_warehouse
 * @property integer $id_customer
 * @property integer $update_by
 * @property string $update_date
 * @property integer $create_by
 * @property string $create_date
 * @property string $sales_date
 *
 * @property SalesDtl[] $salesDtls
 * @property Customer $idCustomer
 * @property Warehouse $idWarehouse
 */
class SalesHdr extends \yii\db\ActiveRecord
{
	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return 'sales_hdr';
	}

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['sales_num', 'id_warehouse', 'id_customer', 'update_by', 'update_date', 'create_by', 'create_date', 'sales_date'], 'required'],
			[['id_warehouse', 'id_customer', 'update_by', 'create_by'], 'integer'],
			[['update_date', 'create_date', 'sales_date'], 'string'],
			[['sales_num'], 'string', 'max' => 16]
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'id_sales_hdr' => 'Id Sales Hdr',
			'sales_num' => 'Sales Num',
			'id_warehouse' => 'Id Warehouse',
			'id_customer' => 'Id Customer',
			'update_by' => 'Update By',
			'update_date' => 'Update Date',
			'create_by' => 'Create By',
			'create_date' => 'Create Date',
			'sales_date' => 'Sales Date',
		];
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getSalesDtls()
	{
		return $this->hasMany(SalesDtl::className(), ['id_sales_hdr' => 'id_sales_hdr']);
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getIdCustomer()
	{
		return $this->hasOne(Customer::className(), ['id_customer' => 'id_customer']);
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getIdWarehouse()
	{
		return $this->hasOne(Warehouse::className(), ['id_warehouse' => 'id_warehouse']);
	}
}
