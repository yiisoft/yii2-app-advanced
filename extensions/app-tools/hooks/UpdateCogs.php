<?php

namespace app\tools\hooks;

use app\tools\Hooks;
use app\tools\Helper;
use biz\master\models\Cogs;

/**
 * Description of Cogs
 *
 * @author MDMunir
 */
class UpdateCogs extends \yii\base\Behavior
{

    public function events()
    {
        return [
            Hooks::EVENT_PURCHASE_RECEIVE_BODY => 'purchaseReceiveBody'
        ];
    }

    protected function updateCogs($params)
    {
        $cogs = Cogs::findOne(['id_product' => $params['id_product']]);
        if (!$cogs) {
            $smallest_uom = Helper::getSmallestProductUom($params['id_product']);
            $cogs = new Cogs();
            $cogs->setAttributes([
                'id_product' => $params['id_product'],
                'id_uom' => $smallest_uom,
                'cogs' => 0.0
            ]);
        }
        $current_stock = Helper::getCurrentStockAll($params['id_product']);
        $qty_per_uom = Helper::getQtyProductUom($params['id_product'], $params['id_uom']);
        $added_stock = $params['added_stock'] * $qty_per_uom;
        $cogs->cogs = 1.0 * ($cogs->cogs * $current_stock + $params['price'] * $params['added_stock']) / ($current_stock + $added_stock);
        if ($cogs->canSetProperty('logParams')) {
            $cogs->logParams = [
                'app' => $params['app'],
                'id_ref' => $params['id_ref'],
            ];
        }
        if (!$cogs->save()) {
            throw new UserException(implode(",\n", $cogs->firstErrors));
        }
        return true;
    }

    public function purchaseReceiveBody($event, $model, $detail)
    {
        $this->updateCogs([
            'id_product' => $detail->id_product,
            'id_uom' => $detail->id_uom,
            'added_stock' => $detail->purch_qty,
            'price' => ($detail->purch_price * (1 - $model->item_discount * 0.01)),
            'app' => 'purchase',
            'id_ref' => $detail->id_purchase_dtl,
        ]);
    }
}