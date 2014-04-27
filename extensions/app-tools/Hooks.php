<?php

namespace app\tools;

/**
 * Description of Hooks
 *
 * @author MDMunir
 */
class Hooks extends \yii\base\Component
{
    const EVENT_PURCHASE_RECEIVE_BEGIN = 'purchaseReceiveBegin';
    const EVENT_PURCHASE_RECEIVE_BODY = 'purchaseReceiveBody';
    const EVENT_PURCHASE_RECEIVE_END = 'purchaseReceiveEnd';
    const EVENT_TRANSFER_ISSUE_BEGIN = 'transferIssueBegin';
    const EVENT_TRANSFER_ISSUE_BODY = 'transferIssueBody';
    const EVENT_TRANSFER_ISSUE_END = 'transferIssueEnd';

    public function init()
    {
        $this->initEvent();
    }

    private function initEvent()
    {
        foreach ($this->events() as $event => $handler) {
            $this->on($event, is_string($handler) ? [$this, $handler] : $handler, null, false);
        }
    }

    public function on($name, $handler, $data = null, $append = true)
    {
        parent::on($name, [$this, 'baseHandler'], [$handler, $data], $append);
    }

    /**
     * 
     * @param string|Event $event
     * @param array $params
     */
    public function fire($event, $params = [])
    {
        if (is_string($event)) {
            $name = $event;
            $event = new Event($name, $params);
        } else {
            $name = $event->name;
            if ($event instanceof Event) {
                $event->params = $params;
            }
        }
        parent::trigger($name, $event);
    }

    /**
     * 
     * @param \yii\base\Event $event
     */
    public function baseHandler($event)
    {
        list($handler, $data) = $event->data;
        $event->data = $data;
        if ($event instanceof Event) {
            $params = $event->params;
            array_unshift($params, $event);
            $event->result = call_user_func_array($handler, $params);
        } else {
            call_user_func($handler, $event);
        }
    }

    public function events()
    {
        return [];
    }

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