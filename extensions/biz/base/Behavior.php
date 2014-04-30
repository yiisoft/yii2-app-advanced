<?php

namespace biz\base;

/**
 * Description of Behavior
 *
 * @author MDMunir
 */
class Behavior extends \yii\base\Behavior
{
    private $_methods = [];

    public function addMethod($name, $callback)
    {
        $this->_methods[$name] = $callback;
    }

    public function __call($name, $params)
    {
        if (isset($this->_methods[$name])) {
            return call_user_func_array($this->_methods[$name], $params);
        }
        return parent::__call($name, $params);
    }

    public function hasMethod($name)
    {
        return isset($this->_methods[$name]) || parent::hasMethod($name);
    }
}