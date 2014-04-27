<?php

namespace app\tools\hooks;

use app\tools\Hooks;
use app\tools\Helper;
use biz\inventory\models\ProductStock;


/**
 * Description of Stock
 *
 * @author MDMunir
 */
class Stock extends \yii\base\Behavior
{

    public function events()
    {
        return [
            Hooks::EVENT_PURCHASE_RECEIVE_BODY => 'purchaseReceiveBody',
            Hooks::EVENT_TRANSFER_ISSUE_BODY => 'transferIssueBody',
        ];
    }

    protected function updateStock($params)
    {
        $stock = ProductStock::findOne([
                'id_warehouse' => $params['id_warehouse'],
                'id_product' => $params['id_product'],
        ]);
        if (!$stock) {
            $stock = new ProductStock();
            $stock->setAttributes([
                'id_warehouse' => $params['id_warehouse'],
                'id_product' => $params['id_product'],
                'id_uom' => $params['id_uom'],
                'qty_stock' => 0,
            ]);
        }

        $stock->qty_stock = $stock->qty_stock + $params['qty'];
        if ($stock->canSetProperty('logParams')) {
            $stock->logParams = [
                'mv_qty' => $params['qty'],
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
     * @param \app\tools\Event $event
     * @param \biz\purchase\models\PurchaseHdr $model
     * @param \biz\purchase\models\PurchaseDtl $detail
     */
    public function purchaseReceiveBody($event,$model,$detail)
    {
        $qty_per_uom = Helper::getQtyProductUom($detail->id_product, $detail->id_uom);
        $smallest_uom = Helper::getSmallestProductUom($detail->id_product);

        $this->updateStock([
            'id_warehouse' => $detail->id_warehouse,
            'id_product' => $detail->id_product,
            'id_uom' => $smallest_uom,
            'qty' => $detail->purch_qty * $qty_per_uom,
            'app' => 'purchase',
            'id_ref' => $detail->id_purchase_dtl,
        ]);
    }

    /**
     * 
     * @param \app\tools\Event $event
     * @param \biz\inventory\models\TransferHdr $model
     * @param \biz\inventory\models\TransferDtl $detail
     */
    public function transferIssueBody($event,$model,$detail)
    {
        $smallest_uom = Helper::getSmallestProductUom($detail->id_product);
        $qty_per_uom = Helper::getQtyProductUom($detail->id_product, $detail->id_uom);
        $this->UpdateStock([
            'id_warehouse' => $model->id_warehouse_source,
            'id_product' => $detail->id_product,
            'id_uom' => $smallest_uom,
            'qty' => -$detail->transfer_qty_send * $qty_per_uom,
            'app' => 'transfer',
            'id_ref' => $model->id_transfer,
        ]);
    }
}