<?php

namespace app\tools\hooks;

use app\tools\Hooks;
use app\tools\Helper;
use biz\accounting\models\GlHeader;

/**
 * Description of Gl
 *
 * @author MDMunir
 */
class CreateGl extends \yii\base\Behavior
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
        // GL *************
        $glHdr = [
            'date' => date('Y-m-d'),
            'type_reff' => GlHeader::TYPE_PURCHASE,
            'memo' => null,
            'id_reff' => $model->id_purchase,
            'id_branch' => $model->id_branch,
            'description' => 'Pembelian barang kredit ' . $model->purchase_num,
        ];

        $dtls = [
            'PERSEDIAAN' => $model->purchase_value * (1 - $model->item_discount * 0.01),
            'HUTANG' => $model->purchase_value * (1 - $model->item_discount * 0.01),
        ];

        $glDtls = Helper::entriSheetToGlMaps('PEMBELIAN_KREDIT', $dtls);
        Helper::createGL($glHdr, $glDtls);
    }
}