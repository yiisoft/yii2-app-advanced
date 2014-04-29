<?php

namespace app\tools;

/**
 * Description of Hooks
 *
 * @author MDMunir
 */
class Hooks extends BaseHooks
{
    const EVENT_PURCHASE_RECEIVE_BEGIN = 'purchaseReceiveBegin';
    const EVENT_PURCHASE_RECEIVE_BODY = 'purchaseReceiveBody';
    const EVENT_PURCHASE_RECEIVE_END = 'purchaseReceiveEnd';
    const EVENT_TRANSFER_ISSUE_BEGIN = 'transferIssueBegin';
    const EVENT_TRANSFER_ISSUE_BODY = 'transferIssueBody';
    const EVENT_TRANSFER_ISSUE_END = 'transferIssueEnd';
    const EVENT_RECEIVE_RECEIVE_BEGIN = 'receiveReceiveBegin';
    const EVENT_RECEIVE_RECEIVE_BODY = 'receiveReceiveBody';
    const EVENT_RECEIVE_RECEIVE_END = 'receiveReceiveEnd';
    const EVENT_SALES_STDR_RELEASE_BEGIN = 'salesStdrReleaseBegin';
    const EVENT_SALES_STDR_RELEASE_BODY = 'salesStdrReleaseBody';
    const EVENT_SALES_STDR_RELEASE_END = 'salesStdrReleaseEnd';

    public function behaviors()
    {
        return[
            'app\tools\hooks\UpdateStock',
            'app\tools\hooks\UpdateCogs',
            'app\tools\hooks\UpdatePrice',
            'app\tools\hooks\CreateInvoice',
            'app\tools\hooks\CreateGl',
        ];
    }
}