<?php

namespace core\services\auth;

use core\entities\user\User;
use yii\mail\MailerInterface;
use core\entities\access\Rbac;
use frontend\forms\auth\SignupForm;
use core\services\access\RoleManager;
use core\repositories\UserRepository;
use core\services\helpers\TransactionManager;

class SignupService
{
    private $mailer;
    private $users;
    private $roles;
    private $transaction;

    public function __construct(
        UserRepository $users,
        MailerInterface $mailer,
        RoleManager $roles,
        TransactionManager $transaction
    )
    {
        $this->mailer = $mailer;
        $this->users = $users;
        $this->roles = $roles;
        $this->transaction = $transaction;
    }

    public function signup(SignupForm $form): void
    {
        $user = User::requestSignup(
            $form->username,
            $form->email,
            $form->password
        );
        $this->transaction->wrap(function () use ($user) {
            $this->users->save($user);
            $this->roles->assign($user->id, Rbac::ROLE_USER);
        });

        $sent = $this->mailer
            ->compose(
                ['html' => 'auth/signup/confirm-html', 'text' => 'auth/signup/confirm-text'],
                ['user' => $user]
            )
            ->setTo($form->email)
            ->setSubject('Signup confirm for ' . \Yii::$app->name)
            ->send();
        if (!$sent) {
            throw new \RuntimeException('Email sending error.');
        }
    }

    public function confirm($token): void
    {
        if (empty($token)) {
            throw new \DomainException('Empty confirm token.');
        }
        $user = $this->users->getByEmailConfirmToken($token);
        $user->confirmSignup();
        $this->users->save($user);
    }
}
