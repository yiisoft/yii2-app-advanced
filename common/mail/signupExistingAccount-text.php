<?php

declare(strict_types=1);

/** @var yii\web\View $this */
/** @var common\models\User $user */

$loginLink = Yii::$app->urlManager->createAbsoluteUrl(['site/login']);
$resetLink = Yii::$app->urlManager->createAbsoluteUrl(['site/request-password-reset']);
$resendLink = Yii::$app->urlManager->createAbsoluteUrl(['site/resend-verification-email']);
?>
Hello <?= $user->username ?>,

Someone tried to sign up with this email address, but it already belongs to your account.

If it was you, log in instead:
<?= $loginLink ?>

If you forgot your password, reset it:
<?= $resetLink ?>

If you have not verified your email address yet, request a new verification email:
<?= $resendLink ?>

If it was not you, you can ignore this email.
