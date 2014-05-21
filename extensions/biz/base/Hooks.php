<?php

namespace biz\base;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * Description of BaseHooks
 *
 * @author MDMunir
 */
class Hooks extends \yii\base\Component
{
    const INTERNAL_HANDLER = '_internal_';

    public $hooksPath;
    public $hooksNamespace;
    public $extraBehaviors = [];
    public $maxLevel = 0;
    private $_counter = 0;
    private $_handlers = [];
    private $_eventStates = [];

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
        if (!in_array($name, $this->_eventStates) && ($this->maxLevel === 0 || count($this->_eventStates) < $this->maxLevel)) {
            array_push($this->_eventStates, $name);
            parent::trigger($name, $event);
            array_pop($this->_eventStates);
        }
    }

    public function behaviors()
    {
        $result = [];
        if ($this->hooksPath) {
            $path = Yii::getAlias($this->hooksPath);
            $namespace = empty($this->hooksNamespace) ? '' : trim($this->hooksNamespace, '\\') . '\\';
            foreach (scandir($path) as $file) {
                if ($file == '.' || $file == '..' || is_dir($path . '/' . $file)) {
                    continue;
                }
                if (strcmp(substr($file, -4), '.php') === 0) {
                    include $path . '/' . $file;
                    $classname = $namespace . substr($file, 0, -4);
                    if (class_exists($classname, false) && is_subclass_of($classname, 'yii\base\Behavior')) {
                        $result[$classname] = $classname;
                    }
                }
            }
        }
        return ArrayHelper::merge($result, $this->extraBehaviors);
    }
}