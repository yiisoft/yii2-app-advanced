<?php

namespace biz\hooks;

use biz\tools\Hooks;
use biz\tools\Helper;
use biz\models\ProductStock;
use yii\base\UserException;

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
            Hooks::E_IRREC_22 => 'receiveReceiveBody',
            
            Hooks::E_TNCRE_22 => 'transferNoticeCreateBody'
        ];
    }

    /**
     * 
     * @param array $params
     * Required field id_warehouse, id_product, id_uom, qty
     * Optional field app, id_ref
     * @return boolean
     * @throws UserException
     */
    public function updateStock($params)
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
            $logParams = ['mv_qty' => $params['qty'] * $qty_per_uom];
            foreach (['app', 'id_ref'] as $key) {
                if (isset($params[$key]) || array_key_exists($key, $params)) {
                    $logParams[$key] = $params[$key];
                }
            }
            $stock->logParams = $logParams;
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
        $this->updateStock([
            'id_warehouse' => $detail->id_warehouse,
            'id_product' => $detail->id_product,
            'id_uom' => $detail->id_uom,
            'qty' => -$detail->sales_qty,
            'app' => 'sales-standart',
            'id_ref' => $detail->id_sales_dtl,
        ]);
    }

    /**
     * 
     * @param \biz\base\Event $event
     * @param \biz\models\TransferHdr $model
     * @param \biz\models\TransferDtl $detail
     */
    public function receiveReceiveBody($event, $model, $detail)
    {
        $this->UpdateStock([
            'id_warehouse' => $model->id_warehouse_dest,
            'id_product' => $detail->id_product,
            'id_uom' => $detail->id_uom,
            'qty' => $detail->transfer_qty_receive,
            'app' => 'receive',
            'id_ref' => $model->id_transfer,
        ]);
    }

    /**
     * 
     * @param \biz\base\Event $event
     * @param \biz\models\TransferNotice $model
     * @param \biz\models\TransferNoticeDtl $detail
     */
    public function transferNoticeCreateBody($event, $model, $detail)
    {
        $this->UpdateStock([
            'id_warehouse' => $model->idTransfer->id_warehouse_source,
            'id_product' => $detail->id_product,
            'id_uom' => $detail->id_uom,
            'qty' => -$detail->qty_notice,
            'app' => 'create notice',
            'id_ref' => $model->id_transfer,
        ]);
    }
}