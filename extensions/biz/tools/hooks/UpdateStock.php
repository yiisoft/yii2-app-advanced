<?php

namespace biz\tools\hooks;

use biz\tools\Hooks;
use biz\tools\Helper;
use biz\models\ProductStock;

/**
 * Description of Stock
 *
 * @author MDMunir
 */
class UpdateStock extends \yii\base\Behavior
{

    public function events()
    {
        return [
            Hooks::E_PPREC_22 => 'purchaseReceiveBody',
            Hooks::E_ITISS_22 => 'transferIssueBody',
            Hooks::E_SSREL_22 => 'salesStdrReleaseBody',
        ];
    }

    protected function updateStock($params)
    {
        $stock = ProductStock::findOne([
                'id_warehouse' => $params['id_warehouse'],
                'id_product' => $params['id_product'],
        ]);
        $qty_per_uom = Helper::getQtyProductUom($params['id_product'], $params['id_uom']);
        if (!$stock) {
            $smallest_uom = Helper::getSmallestProductUom($params['id_product']);
            $stock = new ProductStock();
            $stock->setAttributes([
                'id_warehouse' => $params['id_warehouse'],
                'id_product' => $params['id_product'],
                'id_uom' => $smallest_uom,
                'qty_stock' => 0,
            ]);
        }

        $stock->qty_stock = $stock->qty_stock + $params['qty'] * $qty_per_uom;
        if ($stock->canSetProperty('logParams')) {
            $stock->logParams = [
                'mv_qty' => $params['qty'] * $qty_per_uom,
                'app' => $params['app'],
                'id_ref' => $params['id_ref'],
            ];
        }
        if (!$stock->save()) {
            throw new UserException(implode(",\n", $stock->firstErrors));
        }

        return true;
    }

    /**
     * 
     * @param \biz\base\Event $event
     * @param \biz\purchase\models\PurchaseHdr $model
     * @param \biz\purchase\models\PurchaseDtl $detail
     */
    public function purchaseReceiveBody($event, $model, $detail)
    {
        $this->updateStock([
            'id_warehouse' => $detail->id_warehouse,
            'id_product' => $detail->id_product,
            'id_uom' => $detail->id_uom,
            'qty' => $detail->purch_qty,
            'app' => 'purchase',
            'id_ref' => $detail->id_purchase_dtl,
        ]);
    }

    /**
     * 
     * @param \biz\base\Event $event
     * @param \biz\inventory\models\TransferHdr $model
     * @param \biz\inventory\models\TransferDtl $detail
     */
    public function transferIssueBody($event, $model, $detail)
    {
        $this->UpdateStock([
            'id_warehouse' => $model->id_warehouse_source,
            'id_product' => $detail->id_product,
            'id_uom' => $detail->id_uom,
            'qty' => -$detail->transfer_qty_send,
            'app' => 'transfer',
            'id_ref' => $model->id_transfer,
        ]);
    }

    public function salesStdrReleaseBody($event, $model, $detail)
    {
        Helper::updateStock([
            'id_warehouse' => $detail->id_warehouse,
            'id_product' => $detail->id_product,
            'id_uom' => $detail->id_uom,
            'qty' => -$detail->sales_qty,
            'app' => 'sales-standart',
            'id_ref' => $detail->id_sales_dtl,
        ]);
    }
}