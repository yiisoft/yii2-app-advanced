<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var \frontend\models\ResendVerificationEmailForm $model */

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;

$this->title = 'Resend verification email';
$this->params['breadcrumbs'][] = $this->title;
$this->params['meta_description'] = 'Resend the verification email to confirm your account.';
$this->params['meta_keywords'] = 'yii, yii2, verification, email, resend, confirm account';
$htmlIcon = <<<HTML
<div class="input-group"><span class="input-group-text" aria-hidden="true">%s</span>{input}</div>{error}{hint}
HTML;
?>
<div class="site-resend-verification-email d-flex align-items-center justify-content-center py-5">
    <div class="card border-0 overflow-hidden login-split-card">
        <div class="row g-0">

            <!-- Brand panel -->
            <div class="col-md-5 d-none d-md-flex login-brand-panel text-white">
                <div class="d-flex flex-column justify-content-between p-4 p-lg-5 w-100">
                    <div>
                        <?= Html::img(
                            Yii::getAlias('@web/images/yii3_full_white_for_dark.svg'),
                            [
                                'alt' => 'Yii Framework',
                                'height' => 40,
                                'class' => 'mb-4',
                            ],
                        ) ?>
                    </div>
                    <div>
                        <h2 class="fw-bold mb-3 login-brand-title">
                            Verify Your<br>Email
                        </h2>
                        <p class="opacity-75 mb-0 login-brand-text">
                            We will send a new verification email to confirm your account.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Form panel -->
            <div class="col-md-7">
                <div class="p-4 p-lg-5">
                    <div class="text-center mb-4">
                        <div class="d-md-none mb-3">
                            <?= Html::img(
                                Yii::getAlias('@web/images/yii3_full_black_for_light.svg'),
                                [
                                    'alt' => 'Yii Framework',
                                    'class' => 'login-mobile-logo',
                                    'height' => 36,
                                ],
                            ) ?>
                        </div>
                        <h1 class="h3 fw-bold mb-1">Resend verification email</h1>
                        <p class="text-body-secondary small">Enter your email to receive a new verification link</p>
                    </div>

                    <?php $form = ActiveForm::begin(['id' => 'resend-verification-email-form']); ?>

                    <div class="mb-4">
                        <label class="form-label fw-semibold small" for="resendverificationemailform-email">Your Email</label>
                        <?= $form->field($model, 'email', [
                            'options' => ['class' => 'mb-0'],
                            'template' => sprintf($htmlIcon, '&#9993;'),
                            'inputOptions' => [
                                'autofocus' => true,
                                'class' => 'form-control',
                                'placeholder' => 'email@example.com',
                            ],
                        ])->textInput() ?>
                    </div>

                    <div class="d-grid">
                        <?= Html::submitButton(
                            'Send',
                            [
                                'class' => 'btn login-btn btn-lg rounded-3 text-white',
                            ],
                        ) ?>
                    </div>

                    <?php ActiveForm::end(); ?>

                    <div class="text-body-secondary text-center mt-3 small">
                        Already verified? <?= Html::a('Login', ['site/login']) ?>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>
