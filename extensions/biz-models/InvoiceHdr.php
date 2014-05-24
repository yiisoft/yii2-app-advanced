<?php

namespace biz\models;

use Yii;

/**
 * This is the model class for table "invoice_hdr".
 *
 * @property integer $id_invoice
 * @property string $inv_num
 * @property integer $type
 * @property string $inv_date
 * @property string $due_date
 * @property integer $id_vendor
 * @property string $inv_value
 * @property integer $status
 * @property string $create_date
 * @property integer $create_by
 * @property string $update_date
 * @property integer $update_by
 *
 * @property PaymentDtl $paymentDtl
 * @property Payment[] $idPayments
 * @property InvoiceDtl $invoiceDtl
 */
class InvoiceHdr extends \yii\db\ActiveRecord
{
    const TYPE_PURCHASE = 100;
    const TYPE_SALES = 200;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'invoice_hdr';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type', 'invDate', 'dueDate', 'id_vendor', 'inv_value', 'status'], 'required'],
            [['type', 'id_vendor', 'status'], 'integer'],
            [['inv_date', 'due_date'], 'safe'],
            [['inv_value'], 'number']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_invoice' => 'Id Invoice',
            'inv_num' => 'Inv Num',
            'type' => 'Type',
            'inv_date' => 'Inv Date',
            'due_date' => 'Due Date',
            'id_vendor' => 'Id Vendor',
            'inv_value' => 'Inv Value',
            'status' => 'Status',
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
        return $this->hasOne(PaymentDtl::className(), ['id_invoice' => 'id_invoice']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdPayments()
    {
        return $this->hasMany(Payment::className(), ['id_payment' => 'id_payment'])->viaTable('payment_dtl', ['id_invoice' => 'id_invoice']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInvoiceDtl()
    {
        return $this->hasOne(InvoiceDtl::className(), ['id_invoice' => 'id_invoice']);
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
                'group' => 'inv',
                'attribute' => 'inv_num',
                'value' => date('ymd.?')
            ],
            [
                'class'=>'biz\behaviors\DateConverter',
                'attributes'=>[
                    'invDate' => 'inv_date',
                    'dueDate' => 'due_date',
                ]
            ],
        ];
    }
}