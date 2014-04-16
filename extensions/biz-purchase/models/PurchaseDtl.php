<?php

namespace biz\purchase\models;

use Yii;
use biz\master\models\Product;
use biz\master\models\Uom;
use biz\master\models\Warehouse;

/**
 * This is the model class for table "purchase_dtl".
 *
 * @property integer $id_purchase_dtl
 * @property integer $id_purchase
 * @property integer $id_product
 * @property integer $id_warehouse
 * @property integer $id_uom
 * @property string $purch_qty
 * @property string $purch_price
 * @property string $selling_price
 *
 * @property Uom $idUom
 * @property PurchaseHdr $idPurchase
 * @property Product $idProduct
 * @property Warehouse $idWarehouse
 */
class PurchaseDtl extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'purchase_dtl';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_purchase', 'id_product', 'id_warehouse', 'id_uom', 'purch_qty', 'selling_price'], 'required'],
            [['id_purchase', 'id_product', 'id_warehouse', 'id_uom'], 'integer'],
            [['purch_qty', 'purch_price', 'selling_price'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_purchase_dtl' => 'Id Purchase Dtl',
            'id_purchase' => 'Id Purchase',
            'id_product' => 'Id Product',
            'id_warehouse' => 'Id Warehouse',
            'id_uom' => 'Id Uom',
            'purch_qty' => 'Purch Qty',
            'purch_price' => 'Purch Price',
            'selling_price' => 'Selling Price',
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
    public function getIdPurchase()
    {
        return $this->hasOne(PurchaseHdr::className(), ['id_purchase' => 'id_purchase']);
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
