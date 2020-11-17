<?php
namespace frontend\forms\auth;

use yii\base\Model;

class ResetPasswordForm extends Model
{
    public $password;

     public function rules()
    {
        return [
            ['password', 'required'],
            ['password', 'string', 'min' => 6],
        ];
    }
}
