<?php

namespace biz\tools\hooks;

use biz\tools\Hooks;
use biz\tools\Helper;
use biz\models\InvoiceHdr;

/**
 * Description of Invoice
 *
 * @author MDMunir
 */
class CreateInvoice extends \yii\base\Behavior
{

    public function events()
    {
        return [
            Hooks::E_PPREC_23 => 'purchaseReceiveEnd'
        ];
    }

    /**
     * 
     * @param Event $event
     */
    public function purchaseReceiveEnd($event, $model)
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