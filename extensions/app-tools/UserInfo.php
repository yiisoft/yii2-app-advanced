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
    public $branch;
    
    public function attach($owner)
    {
        parent::attach($owner);
        $this->initUser($owner->getIdentity());
    }
    
    protected function initUser($identity)
    {
        $this->branch = 1;
    }
}