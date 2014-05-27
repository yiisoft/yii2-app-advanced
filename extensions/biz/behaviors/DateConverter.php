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
    public $attributes = [];
    public $logicalFormat = 'd-m-Y';
    public $physicalFormat = 'Y-m-d';

    public function __get($param)
    {
        if (isset($this->attributes[$param])) {
            return $this->convertToLogical($this->owner->{$this->attributes[$param]});
        } else {
            return parent::__get($param);
        }
    }

    public function __set($param, $value)
    {
        if (isset($this->attributes[$param])) {
            $this->owner->{$this->attributes[$param]} = $this->convertToPhysical($value);
        } else {
            parent::__set($param, $value);
        }
    }

    private function convertToPhysical($value)
    {
        if (empty($value)) {
            return null;
        }
        $date = DateTime::createFromFormat($this->logicalFormat, $value);
        return $date->format($this->physicalFormat);
    }

    private function convertToLogical($value)
    {
        if (empty($value)) {
            return null;
        }
        $date = DateTime::createFromFormat($this->physicalFormat, $value);
        return $date->format($this->logicalFormat);
    }

    public function canGetProperty($name, $checkVars = true)
    {
        return isset($this->attributes[$name]) || parent::canGetProperty($name, $checkVars);
    }

    public function canSetProperty($name, $checkVars = true)
    {
        return isset($this->attributes[$name]) || parent::canSetProperty($name, $checkVars);
    }
}