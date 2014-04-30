<?php

namespace biz\base;

/**
 * Description of Event
 *
 * @author MDMunir
 */
class Event extends \yii\base\Event
{
    public $params;
    public $result;

    public function __construct($name, $params = [], $config = [])
    {
        $this->name = $name;
        $this->params = (array) $params;
        parent::__construct($config);
    }
}