<?php

namespace biz\behaviors;

use ReflectionClass;
use yii\helpers\Inflector;

/**
 * Description of StatusBehavior
 *
 * @author MDMunir
 */
class StatusBehavior extends \yii\base\Behavior
{
    public $maps = [];
    private static $_maps = [];
    private static $_maps_list = [];

    public function getNmStatus()
    {
        $status = $this->owner->status;
        if (isset($this->maps[$status])) {
            return $this->maps[$status];
        }
        $className = $this->owner->className();
        if (!isset(static::$_maps[$className])) {
            $ref = new ReflectionClass($className);
            static::$_maps[$className] = [];
            foreach ($ref->getConstants() as $key => $value) {
                if (strpos($key, 'STATUS_') === 0) {
                    static::$_maps[$className][$value] = Inflector::camel2words(strtolower(substr($key, 7)));
                }
            }
        }
        return isset(static::$_maps[$className][$status]) ? static::$_maps[$className][$status] : '';
    }
    
    public static function statusList($className,$extra=[])
    {
        if (!isset(static::$_maps_list[$className])) {
            $ref = new ReflectionClass($className);
            static::$_maps_list[$className] = [];
            foreach ($ref->getConstants() as $key => $value) {
                if (strpos($key, 'STATUS_') === 0) {
                    static::$_maps_list[$className][$value] = Inflector::camel2words(strtolower(substr($key, 7)));
                }
            }
        }
        $result = static::$_maps_list[$className];
        foreach ($extra as $key => $value) {
            $result[$key] = $value;
        }
        ksort($result);
        return $result;
    }
}