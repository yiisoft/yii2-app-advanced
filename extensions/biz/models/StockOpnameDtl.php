<?php

namespace biz\models;

use Yii;

/**
 * This is the model class for table "stock_opname_dtl".
 *
 * @property integer $id_opname
 * @property integer $id_product
 * @property integer $id_uom
 * @property string $qty
 *
 * @property Uom $idUom
 * @property Product $idProduct
 * @property StockOpname $idOpname
 */
class StockOpnameDtl extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'stock_opname_dtl';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_opname', 'id_product', 'id_uom', 'qty'], 'required'],
            [['id_opname', 'id_product', 'id_uom'], 'integer'],
            [['qty'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_opname' => 'Id Opname',
            'id_product' => 'Id Product',
            'id_uom' => 'Id Uom',
            'qty' => 'Qty',
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
    public function getIdOpname()
    {
        return $this->hasOne(StockOpname::className(), ['id_opname' => 'id_opname']);
    }
}