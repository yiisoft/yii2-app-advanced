<?php

namespace biz\behaviors;

use yii\web\User;
use biz\sales\controllers\PosController;

/**
 * Description of UserBehavior
 *
 * @author MDMunir
 */
class UserBehavior extends \biz\base\PropertyBehavior
{

    public function events()
    {
        return [
            User::EVENT_AFTER_LOGIN => 'afterLogin'
        ];
    }

    protected function getProperties()
    {
        return[
            'branch' => 1,
        ];
    }

    /**
     * 
     * @param \yii\web\UserEvent $event
     */
    public function afterLogin($event)
    {
        //PosController::invalidatePos();
    }
}