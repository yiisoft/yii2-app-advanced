<?php

namespace biz\behaviors;

/**
 * Description of UserBehavior
 *
 * @author MDMunir
 */
class UserBehavior extends \biz\base\PropertyBehavior
{

    protected function getProperties()
    {
        return[
            'branch' => 1,
        ];
    }
}