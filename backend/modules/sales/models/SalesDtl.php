<?php

namespace backend\modules\sales\models;

/**
 * This is the model class for table "sales_dtl".
 *
 * @property integer $id_sales_dtl
 * @property integer $id_sales_hdr
 * @property integer $id_product
 * @property integer $id_uom
 * @property string $sales_price
 * @property string $sales_qty
 * @property string $discon
 * @property string $create_date
 * @property integer $create_by
 * @property string $update_date
 * @property integer $update_by
 *
 * @property Uom $idUom
 * @property Product $idProduct
 * @property SalesHdr $idSalesHdr
 */
class SalesDtl extends \yii\db\ActiveRecord
{
	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return 'sales_dtl';
	}

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['id_sales_hdr', 'id_product', 'id_uom', 'sales_price', 'sales_qty', 'create_date', 'create_by', 'update_date', 'update_by'], 'required'],
			[['id_sales_hdr', 'id_product', 'id_uom', 'create_by', 'update_by'], 'integer'],
			[['sales_price', 'sales_qty', 'discon', 'create_date', 'update_date'], 'string']
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'id_sales_dtl' => 'Id Sales Dtl',
			'id_sales_hdr' => 'Id Sales Hdr',
			'id_product' => 'Id Product',
			'id_uom' => 'Id Uom',
			'sales_price' => 'Sales Price',
			'sales_qty' => 'Sales Qty',
			'discon' => 'Discon',
			'create_date' => 'Create Date',
			'create_by' => 'Create By',
			'update_date' => 'Update Date',
			'update_by' => 'Update By',
		];
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
	public function getIdSalesHdr()
	{
		return $this->hasOne(SalesHdr::className(), ['id_sales_hdr' => 'id_sales_hdr']);
	}
}
