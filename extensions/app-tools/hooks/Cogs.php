<?php

namespace app\tools\hooks;

use app\tools\Hooks;
use app\tools\Helper;
use biz\master\models\Cogs as MCogs;

/**
 * Description of Cogs
 *
 * @author MDMunir
 */
class Cogs extends \yii\base\Behavior
{

    public function events()
    {
        return [
            Hooks::EVENT_PURCHASE_RECEIVE_BODY => 'purchaseReceiveBody'
        ];
    }

    protected function updateCogs($params)
    {
        $cogs = MCogs::findOne(['id_product' => $params['id_product']]);
        if (!$cogs) {
            $cogs = new MCogs();
            $cogs->setAttributes([
                'id_product' => $params['id_product'],
                'id_uom' => $params['id_uom'],
                'cogs' => 0.0
            ]);
        }
        $cogs->cogs = 1.0 * ($cogs->cogs * $params['old_stock'] + $params['price'] * $params['added_stock']) / ($params['old_stock'] + $params['added_stock']);
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

    public function purchaseReceiveBody($event,$model,$detail)
    {
        $qty_per_uom = Helper::getQtyProductUom($detail->id_product, $detail->id_uom);
        $smallest_uom = Helper::getSmallestProductUom($detail->id_product);

        $current_qty_all = Helper::getCurrentStockAll($detail->id_product);

        $this->updateCogs([
            'id_product' => $detail->id_product,
            'id_uom' => $smallest_uom,
            'old_stock' => $current_qty_all,
            'added_stock' => $detail->purch_qty * $qty_per_uom,
            'price' => ($detail->purch_price * (1 - $model->item_discount * 0.01)) / $qty_per_uom,
            'app' => 'purchase',
            'id_ref' => $detail->id_purchase_dtl,
        ]);
    }
}