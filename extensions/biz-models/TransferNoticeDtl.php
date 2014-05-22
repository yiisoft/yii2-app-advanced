<?php

namespace biz\models;

use Yii;

/**
 * This is the model class for table "transfer_notice_dtl".
 *
 * @property integer $id_transfer
 * @property integer $id_product
 * @property double $qty_selisih
 * @property double $qty_approve
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
            [['id_transfer', 'id_product', 'qty_selisih', 'id_uom'], 'required'],
            [['id_transfer', 'id_product', 'id_uom'], 'integer'],
            [['qty_selisih','qty_approve'], 'double']
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
            'qty_selisih' => 'Qty Selisih',
            'qty_approve' => 'Qty Approve',
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