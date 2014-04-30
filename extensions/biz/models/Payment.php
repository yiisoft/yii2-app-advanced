<?php

namespace biz\models;

use Yii;

/**
 * This is the model class for table "payment".
 *
 * @property integer $id_payment
 * @property string $payment_num
 * @property integer $payment_type
 * @property string $payment_date
 * @property string $create_date
 * @property integer $create_by
 * @property string $update_date
 * @property integer $update_by
 *
 * @property PaymentDtl $paymentDtl
 * @property InvoiceHdr[] $idInvoices
 */
class Payment extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'payment';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['payment_type', 'payment_date'], 'required'],
            [['payment_type'], 'integer'],
            [['payment_date'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_payment' => 'Id Payment',
            'payment_num' => 'Payment Num',
            'payment_type' => 'Payment Type',
            'payment_date' => 'Payment Date',
            'create_date' => 'Create Date',
            'create_by' => 'Create By',
            'update_date' => 'Update Date',
            'update_by' => 'Update By',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPaymentDtl()
    {
        return $this->hasOne(PaymentDtl::className(), ['id_payment' => 'id_payment']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdInvoices()
    {
        return $this->hasMany(InvoiceHdr::className(), ['id_invoice' => 'id_invoice'])->viaTable('payment_dtl', ['id_payment' => 'id_payment']);
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'biz\behaviors\AutoTimestamp',
            'biz\behaviors\AutoUser',
            [
                'class' => 'mdm\autonumber\Behavior',
                'digit' => 4,
                'group' => 'payment',
                'attribute' => 'payment_num',
                'value' => date('ymd.?')
            ]
        ];
    }
}