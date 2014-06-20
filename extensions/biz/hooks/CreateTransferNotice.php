<?php

namespace biz\hooks;

use Yii;
use biz\tools\Hooks;
use biz\models\TransferNotice;
use biz\models\TransferNoticeDtl;
use biz\base\Event;

/**
 * Description of CreateTransferNotice
 *
 * @author MDMunir
 */
class CreateTransferNotice extends \yii\base\Behavior
{

    public function events()
    {
        return [
            Hooks::E_IRREC_23 => 'receiveReceiveEnd',
        ];
    }

    /**
     * 
     * @param \biz\base\Event $event
     * @param \biz\models\TransferHdr $model
     */
    public function receiveReceiveEnd($event, $model)
    {
        $noticeDtls = [];
        foreach ($model->transferDtls as $detail) {
            if ($detail->transfer_qty_send != $detail->transfer_qty_receive) {
                $noticeDtl = new TransferNoticeDtl;
                $noticeDtl->id_product = $detail->id_product;
                $noticeDtl->qty_selisih = $detail->transfer_qty_receive - $detail->transfer_qty_send;
                $noticeDtl->id_uom = $detail->id_uom;
                $noticeDtls[] = $noticeDtl;
            }
        }
        if (count($noticeDtls)) {
            $notice = new TransferNotice;
            $notice->description = 'Qty kirim tidak sama dengan qty terima';
            $notice->notice_date = date('Y-m-d');
            $notice->status = TransferNotice::STATUS_CREATE;
            $notice->id_transfer = $model->id_transfer;
            if (!$notice->save()) {
                throw new \Exception(implode("\n", $notice->firstErrors));
            }
        Yii::$app->trigger(Hooks::E_TNCRE_21, new Event([$notice]));
            foreach ($noticeDtls as $noticeDtl) {
                $noticeDtl->id_transfer = $notice->id_transfer;
                if (!$noticeDtl->save()) {
                    throw new \Exception(implode("\n", $noticeDtl->firstErrors));
                }
        Yii::$app->trigger(Hooks::E_TNCRE_22, new Event([$notice,$noticeDtl]));
            }
        Yii::$app->trigger(Hooks::E_TNCRE_23, new Event([$notice]));
        }
    }
}