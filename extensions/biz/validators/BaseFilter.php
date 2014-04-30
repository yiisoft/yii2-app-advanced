<?php

namespace biz\validators;

/**
 * Description of BaseFilter
 *
 * @author MDMunir
 */
class BaseFilter extends \yii\validators\Validator
{
    public $valueWhenEmpty = null;
    public $useTrim = true;
    public $filter;
    public $skipOnEmpty = false;

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        if ($this->filter === null) {
            throw new InvalidConfigException('The "filter" property must be set.');
        }
    }

    /**
     * @inheritdoc
     */
    public function validateAttribute($object, $attribute)
    {
        $value = $this->useTrim ? trim($object->$attribute) : $object->$attribute;
        $object->$attribute = $value === '' ? $this->valueWhenEmpty : call_user_func($this->filter, $value);
    }
}