<?php

namespace biz\inventory\models;

use Yii;
use biz\master\models\Product;
use biz\master\models\Uom;

/**
 * This is the model class for table "transfer_dtl".
 *
 * @property integer $id_transfer_dtl
 * @property integer $id_transfer
 * @property integer $id_product
 * @property string $transfer_qty_send
 * @property string $transfer_qty_receive
 * @property integer $id_uom
 *
 * @property Uom $idUom
 * @property Product $idProduct
 * @property TransferHdr $idTransfer
 */
class TransferDtl extends \yii\db\ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'transfer_dtl';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_transfer', 'id_product', 'transfer_qty_send', 'id_uom'], 'required'],
            [['id_transfer', 'id_product', 'id_uom'], 'integer'],
            [['transfer_qty_send', 'transfer_qty_receive'], 'filter', 'filter' => function($val) {
                return empty($val) ? 0 : (double) $val;
            }]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_transfer_dtl' => 'Id Transfer Dtl',
            'id_transfer' => 'Id Transfer',
            'id_product' => 'Id Product',
            'transfer_qty_send' => 'Transfer Qty Send',
            'transfer_qty_receive' => 'Transfer Qty Receive',
            'id_uom' => 'Id Uom',
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
    public function getIdTransfer()
    {
        return $this->hasOne(TransferHdr::className(), ['id_transfer' => 'id_transfer']);
    }
}