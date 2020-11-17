<?php
namespace frontend\forms\auth;

use yii\base\Model;
use core\entities\user\User;;

class PasswordResetRequestForm extends Model
{
    public $email;

    public function rules()
    {
        return [
            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'exist',
                'targetClass' => User::class,
                'message' => 'There is no user with this email address.'
            ],
            ['email', 'exist',
                'targetClass' => User::class,
                'filter' => ['status' => User::STATUS_ACTIVE],
                'message' => 'User is not active.'
            ],
        ];
    }
}
