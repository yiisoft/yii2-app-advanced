<?php

namespace biz\accounting\models;

use Yii;

/**
 * This is the model class for table "invoice_dtl".
 *
 * @property integer $id_invoice
 * @property integer $id_reff
 * @property string $description
 * @property string $trans_value
 *
 * @property InvoiceHdr $idInvoice
 */
class InvoiceDtl extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'invoice_dtl';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_invoice', 'id_reff'], 'required'],
            [['id_invoice', 'id_reff'], 'integer'],
            [['description'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_invoice' => 'Id Invoice',
            'id_reff' => 'Id Reff',
            'description' => 'Description',
            'trans_value' => 'Trans Value',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdInvoice()
    {
        return $this->hasOne(InvoiceHdr::className(), ['id_invoice' => 'id_invoice']);
    }
}
