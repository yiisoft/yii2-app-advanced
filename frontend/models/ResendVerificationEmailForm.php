<?php

declare(strict_types=1);

namespace frontend\models;

use common\models\User;
use yii\base\Model;
use yii\mail\MailerInterface;

class ResendVerificationEmailForm extends Model
{
    public string $email = '';
    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
        ];
    }

    /**
     * Sends confirmation email to user.
     *
     * Nothing is sent when there is no unverified user with this email address. The result must not be shown to the
     * visitor, so that the form does not reveal which email addresses are registered.
     *
     * @param MailerInterface $mailer the mailer component.
     * @param string $supportEmail the support email address.
     * @param string $appName the application name.
     *
     * @return bool whether the email was sent.
     */
    public function sendEmail(MailerInterface $mailer, string $supportEmail, string $appName): bool
    {
        $user = User::findOne([
            'email' => $this->email,
            'status' => User::STATUS_INACTIVE,
        ]);

        if ($user === null) {
            return false;
        }

        return $mailer
            ->compose(
                ['html' => 'emailVerify-html', 'text' => 'emailVerify-text'],
                ['user' => $user],
            )
            ->setFrom([$supportEmail => $appName . ' robot'])
            ->setTo($this->email)
            ->setSubject('Account registration at ' . $appName)
            ->send();
    }
}
