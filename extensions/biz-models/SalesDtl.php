<?php

namespace biz\models;

use Yii;

/**
 * This is the model class for table "sales_dtl".
 *
 * @property integer $id_sales_dtl
 * @property integer $id_sales
 * @property integer $id_product
 * @property integer $id_uom
 * @property integer $id_warehouse
 * @property string $sales_price
 * @property string $sales_qty
 * @property string $discount
 * @property string $cogs
 * @property string $tax
 *
 * @property Uom $idUom
 * @property SalesHdr $idSales
 * @property Product $idProduct
 * @property Cogs $idCogs
 * @property Warehouse $idWarehouse
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
            [['discount'],'default'],
            [['id_sales', 'id_product', 'id_uom', 'id_warehouse', 'sales_price', 'sales_qty', 'cogs'], 'required'],
            [['id_sales', 'id_product', 'id_uom', 'id_warehouse'], 'integer'],
            [['sales_price', 'sales_qty', 'discount', 'cogs', 'tax'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_sales_dtl' => 'Id Sales Dtl',
            'id_sales' => 'Id Sales',
            'id_product' => 'Id Product',
            'id_uom' => 'Id Uom',
            'id_warehouse' => 'Id Warehouse',
            'sales_price' => 'Sales Price',
            'sales_qty' => 'Sales Qty',
            'discount' => 'Discount',
            'cogs' => 'Cogs',
            'tax' => 'Tax',
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
    public function getIdSales()
    {
        return $this->hasOne(SalesHdr::className(), ['id_sales' => 'id_sales']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdCogs()
    {
        return $this->hasOne(Cogs::className(), ['id_product' => 'id_product']);
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
}