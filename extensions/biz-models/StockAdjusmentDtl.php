<?php

namespace biz\models;

use Yii;

/**
 * This is the model class for table "stock_adjusment_dtl".
 *
 * @property integer $id_adjustment
 * @property integer $id_product
 * @property integer $id_uom
 * @property string $qty
 * @property string $item_value
 *
 * @property Uom $idUom
 * @property Product $idProduct
 * @property StockAdjustment $idAdjustment
 */
class StockAdjusmentDtl extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'stock_adjusment_dtl';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_adjustment', 'id_product', 'id_uom', 'qty', 'item_value'], 'required'],
            [['id_adjustment', 'id_product', 'id_uom'], 'integer'],
            [['qty', 'item_value'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_adjustment' => 'Id Adjustment',
            'id_product' => 'Id Product',
            'id_uom' => 'Id Uom',
            'qty' => 'Qty',
            'item_value' => 'Item Value',
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
    public function getIdAdjustment()
    {
        return $this->hasOne(StockAdjustment::className(), ['id_adjustment' => 'id_adjustment']);
    }
}