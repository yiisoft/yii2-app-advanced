<?php

namespace biz\behaviors;

use DateTime;

/**
 * Description of DateConverter
 *
 * @author MDMunir
 */
class DateConverter extends \yii\base\Behavior
{
    public $attributeMaps = [];
    public $logicalFormat = 'd-m-Y';
    public $physicalFormat = 'Y-m-d';

    public function __get($param)
    {
        if (isset($this->attributeMaps[$param])) {
            return $this->convertToLogical($this->owner->{$this->attributeMaps[$param]});
        } else {
            return parent::__get($name);
        }
    }

    public function __set($param, $value)
    {
        if (isset($this->attributeMaps[$param])) {
            $this->owner->{$this->attributeMaps[$param]} = $this->convertToPhysical($value);
        } else {
            parent::__set($name, $value);
        }
    }

    private function convertToPhysical($value)
    {
        $date = DateTime::createFromFormat($this->logicalFormat, $value);
        return date($this->physicalFormat, $date->getTimestamp());
    }

    private function convertToLogical($value)
    {
        $date = DateTime::createFromFormat($this->physicalFormat, $value);
        return date($this->logicalFormat, $date->getTimestamp());
    }

    public function canGetProperty($name, $checkVars = true)
    {
        return isset($this->attributeMaps[$name]) || parent::canGetProperty($name, $checkVars);
    }

    public function canSetProperty($name, $checkVars = true)
    {
        return isset($this->attributeMaps[$name]) || parent::canSetProperty($name, $checkVars);
    }
}