<?php

declare(strict_types=1);

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\User $user */

$loginLink = Yii::$app->urlManager->createAbsoluteUrl(['site/login']);
$resetLink = Yii::$app->urlManager->createAbsoluteUrl(['site/request-password-reset']);
$resendLink = Yii::$app->urlManager->createAbsoluteUrl(['site/resend-verification-email']);
?>
<div class="signup-existing-account">
    <p>Hello <?= Html::encode($user->username) ?>,</p>

    <p>Someone tried to sign up with this email address, but it already belongs to your account.</p>

    <p>If it was you, log in instead: <?= Html::a(Html::encode($loginLink), $loginLink) ?></p>

    <p>If you forgot your password, reset it: <?= Html::a(Html::encode($resetLink), $resetLink) ?></p>

    <p>If you have not verified your email address yet, request a new verification email: <?= Html::a(Html::encode($resendLink), $resendLink) ?></p>

    <p>If it was not you, you can ignore this email.</p>
</div>
