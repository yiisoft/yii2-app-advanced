<?php

namespace app\tools\hooks;

use app\tools\Hooks;
use app\tools\Helper;
use biz\accounting\models\InvoiceHdr;

/**
 * Description of Invoice
 *
 * @author MDMunir
 */
class Invoice extends \yii\base\Behavior
{

    public function events()
    {
        return [
            Hooks::EVENT_PURCHASE_RECEIVE_END => 'purchaseReceiveEnd'
        ];
    }

    /**
     * 
     * @param Event $event
     */
    public function purchaseReceiveEnd($event,$model)
    {
        /*
         * AUTOMATIC INVOICE
         * 1.Invoice Create
         * 2.GL Create
         */
        Helper::createInvoice([
            'id_vendor' => $model->id_supplier,
            'type' => InvoiceHdr::TYPE_PURCHASE,
            'value' => $model->purchase_value * (1 - $model->item_discount * 0.01),
            'date' => $model->purchase_date,
            'id_ref' => $model->id_purchase,
        ]);
    }
}