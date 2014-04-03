<?php

namespace backend\modules\accounting\models;

use Yii;

/**
 * This is the model class for table "payment_dtl".
 *
 * @property integer $id_payment
 * @property integer $id_invoice
 * @property string $pay_val
 *
 * @property Payment $idPayment
 * @property InvoiceHdr $idInvoice
 */
class PaymentDtl extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'payment_dtl';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_payment', 'id_invoice', 'pay_val'], 'required'],
            [['id_payment', 'id_invoice'], 'integer'],
            [['pay_val'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_payment' => 'Id Payment',
            'id_invoice' => 'Id Invoice',
            'pay_val' => 'Pay Val',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdPayment()
    {
        return $this->hasOne(Payment::className(), ['id_payment' => 'id_payment']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdInvoice()
    {
        return $this->hasOne(InvoiceHdr::className(), ['id_invoice' => 'id_invoice']);
    }
}
