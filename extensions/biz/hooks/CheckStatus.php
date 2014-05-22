<?php

namespace biz\hooks;

use biz\tools\Hooks;
use biz\models\PurchaseHdr;
use biz\models\TransferHdr;
use biz\models\TransferNotice;
use yii\base\UserException;

/**
 * Description of CheckAccess
 *
 * @author MDMunir
 */
class CheckStatus extends \yii\base\Behavior
{

    public function events()
    {
        return[
            Hooks::E_PPUPD_1 => 'purchaseUpdate',
            Hooks::E_PPREC_1 => 'purchaseReceive',
            Hooks::E_ITUPD_1 => 'transferUpdate',
            Hooks::E_ITISS_1 => 'transferIssue',
            Hooks::E_IRUPD_1 => 'receiveUpdate',
            Hooks::E_INAPP_1 => 'noticeApprove',
        ];
    }

    public function purchaseUpdate($event, $model)
    {
        if ($model->status != PurchaseHdr::STATUS_DRAFT) {
            throw new UserException('tidak boleh diedit');
        }
    }

    public function purchaseReceive($event, $model)
    {
        if ($model->status != PurchaseHdr::STATUS_DRAFT) {
            throw new UserException('Dokument tidak boleh direlese');
        }
    }

    public function transferUpdate($event, $model)
    {
        if ($model->status != TransferHdr::STATUS_DRAFT) {
            throw new UserException('tidak boleh diedit');
        }
    }

    public function transferIssue($event, $model)
    {
        if ($model->status != TransferHdr::STATUS_DRAFT) {
            throw new UserException('tidak boleh diissue');
        }
    }

    public function receiveUpdate($event, $model)
    {
        $allowStatus = [TransferHdr::STATUS_ISSUE, TransferHdr::STATUS_DRAFT_RECEIVE];
        if (!in_array($model->status, $allowStatus)) {
            throw new UserException('tidak bisa diedit');
        }
    }
    
    public function noticeApprove($event, $model)
    {
        if ($model->status != TransferNotice::STATUS_UPDATE) {
            throw new UserException('tidak boleh diapprove');
        }
    }

    
}