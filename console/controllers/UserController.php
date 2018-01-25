<?php

namespace console\controllers;

use common\models\User;
use Yii;
use yii\console\Controller;
use yii\helpers\Console;

class UserController extends Controller
{
    public $email;
    public $password;

    public function options($actionID)
    {
        return ['email', 'password'];
    }

    public function optionAliases()
    {
        return ['e' => 'email', 'p' => 'password'];
    }

    public function actionCreateAdmin()
    {
        $userRole = Yii::$app->authManager->getRole('admin');
        if (!$userRole) {
            $role = Yii::$app->authManager->createRole('admin');
            $role->description = 'Администратор';
            Yii::$app->authManager->add($role);
            $userRole = Yii::$app->authManager->getRole('admin');
        }

        while (empty($this->email)) {
            echo "\n  Enter admin email: ";
            $this->email = trim(Console::input());
        }

        while (empty($this->password)) {
            echo "\n  Enter admin password: ";
            $this->password = trim(Console::input());
        }

        $user = new User();
        $user->email = $this->email;
        $user->setPassword($this->password);

        try {
            if ($user->save()) {
                Yii::$app->authManager->assign($userRole, $user->id);
                $email = $this->ansiFormat($this->email, Console::FG_YELLOW);
                echo "\n  Admin user with email: $email was created " . $this->ansiFormat('successful', Console::FG_GREEN) . "\n";
            } else {
                $this->stderr("\n  You have some errors\n" . print_r($user->errors, true), Console::FG_RED);
            }
        } catch (\Exception $exception) {
            $this->stderr("\n  Exception occurred while user was creating : " . $exception->getMessage() . "\n", Console::FG_RED);
        }
    }
}
