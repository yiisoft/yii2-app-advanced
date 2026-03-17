<?php

declare(strict_types=1);

namespace common\bootstrap;

use Yii;
use yii\base\Application;
use yii\base\BootstrapInterface;
use yii\mail\MailerInterface;

/**
 * Registers the application mailer component as the DI container singleton for {@see MailerInterface}.
 *
 * Codeception replaces `components.mailer` with its own TestMailer to capture sent emails.
 *
 * Since the DI container is configured before the mailer mock, this bootstrap ensures the DI singleton resolves to the
 * same mailer instance used by the application.
 */
final class MailerBootstrap implements BootstrapInterface
{
    /**
     * @param Application $app Application instance.
     */
    public function bootstrap($app): void
    {
        Yii::$container->setSingleton(MailerInterface::class, $app->mailer);
    }
}
