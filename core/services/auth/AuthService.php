<?php

namespace core\services\auth;

use core\entities\user\User;
use frontend\forms\auth\LoginForm;
use core\repositories\UserRepository;

class AuthService
{
    private $users;

    public function __construct(UserRepository $users)
    {
        $this->users = $users;
    }

    public function auth(LoginForm $form): User
    {
        $user = $this->users->findByUsernameOrEmail($form->username);
        if (!$user) {
            throw new \DomainException('Undefined user or password.');
        } else if (!$user->isActive()) {
            throw new \DomainException('User is not confirmed. Please confirm user by using link in confirmation email.');
        } else if (!$user->validatePassword($form->password)) {
            throw new \DomainException('Pair user password is not correct.');
        }
        return $user;
    }
}
