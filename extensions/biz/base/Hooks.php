<?php

namespace biz\base;

/**
 * Description of BaseHooks
 *
 * @author MDMunir
 */
class Hooks extends \yii\base\Component
{
    const INTERNAL_HANDLER = '_internal_';

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
    private $_counter = 0;
    private $_handlers = [];

    public function __call($name, $params)
    {
        if (strpos($name, static::INTERNAL_HANDLER) === 0 && isset($params[0]) && $params[0] instanceof \yii\base\Event) {
            $event = $params[0];
            $handler = $this->_handlers[$event->name][$name];
            if ($event instanceof Event) {
                $extraParams = $event->params;
                array_unshift($extraParams, $event);
                $event->result = call_user_func_array($handler, $extraParams);
            } else {
                call_user_func($handler, $event);
            }
        } else {
            return parent::__call($name, $params);
        }
    }

    public function on($name, $handler, $data = null, $append = true)
    {
        $internalHandler = static::INTERNAL_HANDLER . ($this->_counter++);
        $this->_handlers[$name][$internalHandler] = $handler;
        parent::on($name, [$this, $internalHandler], $data, $append);
    }

    public function off($name, $handler = null)
    {
        if ($handler === null) {
            unset($this->_handlers[$name]);
            return parent::off($name, $handler);
        } else {
            $removed = false;
            foreach ($this->_handlers[$name] as $i => $value) {
                if ($value === $handler) {
                    $removed = parent::off($name, [$this, $i]) || $removed;
                    unset($this->_handlers[$name][$i]);
                }
            }
            return $removed;
        }
    }

    /**
     * 
     * @param string|Event $event
     * @param array $params
     */
    public function fire($event)
    {
        $params = func_get_args();
        array_shift($params);
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

    public function events()
    {
        return [];
    }
}