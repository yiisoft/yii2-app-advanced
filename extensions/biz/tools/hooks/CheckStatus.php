<?php

namespace biz\tools\hooks;

use biz\tools\Hooks;
use biz\models\PurchaseHdr;
use yii\base\UserException;

/**
 * Description of CheckAccess
 *
 * @author MDMunir
 */
class CheckStatus extends \biz\base\Behavior
{

    public function events()
    {
        return[
            Hooks::E_PPUPD_1 => 'purchaseUpdate',
            Hooks::E_PPREC_1 => 'PurchaseReceive',
        ];
    }

    public function purchaseUpdate($event, $model)
    {
        if ($model->status != PurchaseHdr::STATUS_DRAFT) {
            throw new UserException('tidak bisa diedit');
        }
    }

    public function purchaseReceive($event, $model)
    {
        if ($model->status != PurchaseHdr::STATUS_DRAFT) {
            throw new UserException('Dokument tidak boleh direlese');
        }
    }
}