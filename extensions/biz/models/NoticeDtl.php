<?php

namespace biz\models;

use Yii;

/**
 * This is the model class for table "notice_dtl".
 *
 * @property integer $id_transfer
 * @property integer $id_product
 * @property string $qty_notice
 * @property integer $id_uom
 *
 * @property Uom $idUom
 * @property Product $idProduct
 * @property TransferNotice $idTransfer
 */
class NoticeDtl extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'notice_dtl';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_transfer', 'id_product', 'qty_notice', 'id_uom'], 'required'],
            [['id_transfer', 'id_product', 'id_uom'], 'integer'],
            [['qty_notice'], 'string']
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
}