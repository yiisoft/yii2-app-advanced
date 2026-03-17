<?php

declare(strict_types=1);

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var \frontend\models\PasswordResetRequestForm $model */

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;

$this->title = 'Reset your password';
$this->params['breadcrumbs'][] = $this->title;
$this->params['meta_description'] = 'Request a password reset link to recover access to your account.';
$this->params['meta_keywords'] = 'yii, yii2, password reset, forgot password, recovery';
$htmlIcon = <<<HTML
{label}<div class="input-group"><span class="input-group-text" aria-hidden="true">%s</span>{input}</div>{error}{hint}
HTML;
$labelOptions = ['class' => 'form-label fw-semibold small'];
?>
<div class="site-request-password-reset d-flex align-items-center justify-content-center py-5">
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
                                'class' => 'mb-4',
                                'height' => 40,
                            ],
                        ) ?>
                    </div>
                    <div>
                        <h2 class="fw-bold mb-3 login-brand-title">
                            Forgot Your<br>Password?
                        </h2>
                        <p class="opacity-75 mb-0 login-brand-text">
                            No worries. Enter your email and we will send you a reset link.
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
                        <h1 class="h3 fw-bold mb-1"><?= Html::encode($this->title) ?></h1>
                        <p class="text-body-secondary small">A link to reset your password will be sent to your email</p>
                    </div>

                    <?php $form = ActiveForm::begin(['id' => 'request-password-reset-form']); ?>

                    <div class="mb-4">
                        <?= $form->field($model, 'email', [
                            'options' => ['class' => 'mb-0'],
                            'template' => sprintf($htmlIcon, '&#9993;'),
                            'inputOptions' => [
                                'autofocus' => true,
                                'class' => 'form-control',
                                'placeholder' => 'email@example.com',
                            ],
                        ])->textInput()->label('Your Email', $labelOptions) ?>
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
                        Remember your password? <?= Html::a('Login', ['site/login']) ?>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>
