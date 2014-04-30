<?php

namespace biz\base;

/**
 * Description of UserInfo
 *
 * @property \yii\web\User $owner Description
 * @author MDMunir
 */
class PropertyBehavior extends \yii\base\Behavior
{
    private $_properties;

    /**
     * 
     * @return array
     */
    protected function getProperties()
    {
        return [];
    }

    private function initProperties()
    {
        if ($this->_properties === null) {
            $this->_properties = $this->getProperties();
        }
    }

    /**
     * @inheritdoc
     */
    public function canGetProperty($name, $checkVars = true)
    {
        $this->initProperties();
        return isset($this->_properties[$name]) || array_key_exists($name, $this->_properties) || parent::canGetProperty($name, $checkVars);
    }

    /**
     * @inheritdoc
     */
    public function __get($name)
    {
        $this->initProperties();
        if (isset($this->_properties[$name]) || array_key_exists($name, $this->_properties)) {
            return $this->_properties[$name];
        }
        return parent::__get($name);
    }
}