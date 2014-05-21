<?php

namespace biz\models;

use Yii;

/**
 * This is the model class for table "transfer_notice_dtl".
 *
 * @property integer $id_transfer
 * @property integer $id_product
 * @property double $qty_notice
 * @property integer $id_uom
 *
 * @property Uom $idUom
 * @property Product $idProduct
 * @property TransferNotice $idTransfer
 * @property TransferDtl $transferDtl Description
 */
class TransferNoticeDtl extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'transfer_notice_dtl';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_transfer', 'id_product', 'qty_notice', 'id_uom'], 'required'],
            [['id_transfer', 'id_product', 'id_uom'], 'integer'],
            [['qty_notice'], 'double']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_transfer' => 'Id Transfer',
            'id_product' => 'Id Product',
            'qty_notice' => 'Qty Notice',
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
        return $this->hasOne(TransferNotice::className(), ['id_transfer' => 'id_transfer']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransferDtl()
    {
        return $this->hasOne(TransferDtl::className(), ['id_transfer' => 'id_transfer', 'id_product' => 'id_product']);
    }
}