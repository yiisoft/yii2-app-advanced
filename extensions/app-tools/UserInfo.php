<?php

namespace app\tools;

/**
 * Description of UserInfo
 *
 * @property \yii\web\User $owner Description
 * @author MDMunir
 */
class UserInfo extends \yii\base\Behavior
{
    private $_properties;

    protected function initProperties()
    {
        if ($this->_properties === null) {
            $this->_properties = [];
            $this->_properties['branch'] = 1;
        }
    }

    public function canGetProperty($name, $checkVars = true)
    {
        $this->initProperties();
        return isset($this->_properties[$name]) || array_key_exists($name, $this->_properties) || parent::canGetProperty($name, $checkVars);
    }

    public function __get($name)
    {
        $this->initProperties();
        if (isset($this->_properties[$name]) || array_key_exists($name, $this->_properties)) {
            return $this->_properties[$name];
        }
        return parent::__get($name);
    }
}