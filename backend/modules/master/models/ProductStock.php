<?php

namespace backend\modules\master\models;

/**
 * This is the model class for table "product_stock".
 *
 * @property integer $id_stock
 * @property integer $id_periode
 * @property integer $id_warehouse
 * @property integer $id_product
 * @property integer $id_uom
 * @property string $qty_stock
 * @property integer $status_closing
 * @property string $create_date
 * @property integer $create_by
 * @property string $update_date
 * @property integer $update_by
 *
 * @property AccPeriode $idPeriode
 * @property Uom $idUom
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
			[['id_periode', 'id_warehouse', 'id_product', 'id_uom', 'qty_stock', 'status_closing'], 'required'],
			[['id_periode', 'id_warehouse', 'id_product', 'id_uom', 'status_closing'], 'integer'],
			[['qty_stock'], 'number']
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'id_stock' => 'Id Stock',
			'id_periode' => 'Id Periode',
			'id_warehouse' => 'Id Warehouse',
			'id_product' => 'Id Product',
			'id_uom' => 'Id Uom',
			'qty_stock' => 'Qty Stock',
			'status_closing' => 'Status Closing',
			'create_date' => 'Create Date',
			'create_by' => 'Create By',
			'update_date' => 'Update Date',
			'update_by' => 'Update By',
		];
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getIdPeriode()
	{
		return $this->hasOne(AccPeriode::className(), ['id_periode' => 'id_periode']);
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getIdUom()
	{
		return $this->hasOne(Uom::className(), ['id_uom' => 'id_uom']);
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getIdProduct()
	{
		return $this->hasOne(Product::className(), ['id_product' => 'id_product']);
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getIdWarehouse()
	{
		return $this->hasOne(Warehouse::className(), ['id_warehouse' => 'id_warehouse']);
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
