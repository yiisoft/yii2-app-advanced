<?php

namespace app\tools\hooks;

use app\tools\Hooks;
use app\tools\Helper;
use biz\master\models\PriceCategory;
use biz\master\models\Price;

/**
 * Description of Price
 *
 * @author MDMunir
 */
class UpdatePrice extends \yii\base\Behavior
{

    public function events()
    {
        return [
            Hooks::EVENT_PURCHASE_RECEIVE_BODY => 'purchaseReceiveBody'
        ];
    }

    private function executePriceFormula($_formula_, $price)
    {
        if (empty($_formula_)) {
            return $price;
        }
        $_formula_ = preg_replace('/price/i', '$price', $_formula_);
        return empty($_formula_) ? $price : eval("return $_formula_;");
    }

    protected function updatePrice($params)
    {
        $categories = PriceCategory::find()->all();
        foreach ($categories as $category) {
            $price = Price::findOne([
                    'id_product' => $params['id_product'],
                    'id_price_category' => $category->id_price_category
            ]);

            if (!$price) {
                $price = new Price();
                $price->setAttributes([
                    'id_product' => $params['id_product'],
                    'id_price_category' => $category->id_price_category,
                    'id_uom' => $params['id_uom'],
                    'price' => 0
                ]);
            }

            if ($price->canSetProperty('logParams')) {
                $price->logParams = [
                    'app' => $params['app'],
                    'id_ref' => $params['id_ref'],
                ];
            }
            $price->price = $this->executePriceFormula($category->formula, $params['price']);
            if (!$price->save()) {
                throw new UserException(implode(",\n", $price->firstErrors));
            }
        }

        return true;
    }

    public function purchaseReceiveBody($event, $model, $detail)
    {
        $smallest_uom = Helper::getSmallestProductUom($detail->id_product);

        $this->updatePrice([
            'id_product' => $detail->id_product,
            'id_uom' => $smallest_uom,
            'price' => $detail->selling_price,
            'app' => 'purchase',
            'id_ref' => $detail->id_purchase_dtl,
        ]);
    }
}