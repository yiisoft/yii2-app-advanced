<?php

namespace backend\modules\purchase\models;

/**
 * This is the model class for table "product_stock".
 *
 * @property integer $id_stock
 * @property integer $id_product
 * @property integer $id_periode
 * @property integer $id_warehouse
 * @property integer $status_closing
 * @property string $qty_stock
 * @property integer $id_uom
 * @property string $create_date
 * @property integer $create_by
 * @property string $update_date
 * @property integer $update_by
 *
 * @property Uom $idUom
 * @property AccPeriode $idPeriode
 * @property Product $idProduct
 * @property Warehouse $idWarehouse
 */
class ProductStock extends \yii\db\ActiveRecord
{
	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return 'product_stock';
	}

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['id_product', 'id_periode', 'id_warehouse', 'status_closing', 'qty_stock', 'id_uom'], 'required'],
			[['id_product', 'id_periode', 'id_warehouse', 'status_closing', 'id_uom'], 'integer'],
			[['qty_stock'], 'string']
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'id_stock' => 'Id Stock',
			'id_product' => 'Id Product',
			'id_periode' => 'Id Periode',
			'id_warehouse' => 'Id Warehouse',
			'status_closing' => 'Status Closing',
			'qty_stock' => 'Qty Stock',
			'id_uom' => 'Id Uom',
			'create_date' => 'Create Date',
			'create_by' => 'Create By',
			'update_date' => 'Update Date',
			'update_by' => 'Update By',
		];
	}

	/**
	 * @return \yii\db\ActiveRelation
	 */
	public function getIdUom()
	{
		return $this->hasOne(Uom::className(), ['id_uom' => 'id_uom']);
	}

	/**
	 * @return \yii\db\ActiveRelation
	 */
	public function getIdPeriode()
	{
		return $this->hasOne(AccPeriode::className(), ['id_periode' => 'id_periode']);
	}

	/**
	 * @return \yii\db\ActiveRelation
	 */
	public function getIdProduct()
	{
		return $this->hasOne(Product::className(), ['id_product' => 'id_product']);
	}

	/**
	 * @return \yii\db\ActiveRelation
	 */
	public function getIdWarehouse()
	{
		return $this->hasOne(Warehouse::className(), ['id_warehouse' => 'id_warehouse']);
	}
}
