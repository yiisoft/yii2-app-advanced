<?php

namespace backend\modules\accounting\models;

use yii\base\UserException;

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
 * @property string $create_date
 * @property integer $create_by
 * @property string $update_date
 * @property integer $update_by
 *
 * @property InvoiceDtl $invoiceDtl
 * @property PaymentDtl $paymentDtl
 * @property Payment[] $idPayments
 */
class InvoiceHdr extends \yii\db\ActiveRecord {

    const TYPE_PURCHASE = 100;
    const TYPE_SALES = 200;

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'invoice_hdr';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['type', 'inv_date', 'due_date', 'id_vendor', 'inv_value'], 'required'],
            [['due_date', 'inv_num'], 'string'],
            [['inv_value'], 'double'],
            [['type', 'id_vendor'], 'integer'],
            [['inv_date'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id_invoice' => 'Id Invoice',
            'inv_num' => 'Inv Num',
            'type' => 'Type',
            'inv_date' => 'Inv Date',
            'due_date' => 'Due Date',
            'id_vendor' => 'Id Vendor',
            'inv_value' => 'Inv Value',
            'create_date' => 'Create Date',
            'create_by' => 'Create By',
            'update_date' => 'Update Date',
            'update_by' => 'Update By',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInvoiceDtl() {
        return $this->hasOne(InvoiceDtl::className(), ['id_invoice' => 'id_invoice']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPaymentDtl() {
        return $this->hasOne(PaymentDtl::className(), ['id_invoice' => 'id_invoice']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdPayments() {
        return $this->hasMany(Payment::className(), ['id_payment' => 'id_payment'])->viaTable('payment_dtl', ['id_invoice' => 'id_invoice']);
    }

    public function behaviors() {
        return [
            'backend\components\AutoTimestamp',
            'backend\components\AutoUser',
            [
                'class' => 'mdm\autonumber\Behavior',
                'digit' => 6,
                'group' => 'invoice',
                'attribute' => 'inv_num',
                'value' => function($event) {
                return 'IN' . date('y.?');
            }
            ]
        ];
    }

    public static function createInvoice($params) {
        $invoice = new self();
        $invoice->id_vendor = $params['id_vendor'];
        $invoice->inv_date = $params['date'];
        $invoice->inv_value = $params['value'];
        $invoice->type = $params['type'];
        $invoice->due_date = date('Y-m-d', strtotime('+1 month'));
        if (!$invoice->save()) {
            throw new UserException(implode("\n", $invoice->getFirstErrors()));
        }

        $invDtl = new InvoiceDtl();
        $invDtl->id_invoice = $invoice->id_invoice;
        $invDtl->id_reff = $params['id_ref'];
        if (!$invDtl->save()) {
            throw new UserException(implode("\n", $invDtl->getFirstErrors()));
        }
    }

}
