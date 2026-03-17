<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var \common\models\LoginForm $model */

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;

$this->title = 'Login';
$htmlIcon = <<<HTML
<div class="input-group"><span class="input-group-text" aria-hidden="true">%s</span>{input}</div>{error}{hint}
HTML;
?>
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
                        Backend<br>Administration
                    </h2>
                    <p class="opacity-75 mb-0 login-brand-text">
                        Manage your Yii2 application with the advanced admin dashboard.
                    </p>
                </div>
            </div>
        </div>

        <!-- Form panel -->
        <div class="col-md-7">
            <div class="p-4 p-lg-5">
                <div class="text-center mb-4">
                    <!-- Mobile-only logo -->
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
                    <h1 class="h3 fw-bold mb-1">Sign in to your account</h1>
                    <p class="text-body-secondary small">Enter your credentials to access the admin panel</p>
                </div>

                <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

                <div class="mb-3">
                    <label class="form-label fw-semibold small" for="loginform-username">Your Username</label>
                    <?= $form->field($model, 'username', [
                        'options' => ['class' => 'mb-0'],
                        'template' => sprintf($htmlIcon, '&#128100;'),
                        'inputOptions' => [
                            'class' => 'form-control',
                            'placeholder' => 'username',
                            'autofocus' => true,
                        ],
                    ])->textInput() ?>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold small" for="loginform-password">Your Password</label>
                    <?= $form->field($model, 'password', [
                        'options' => ['class' => 'mb-0'],
                        'template' => sprintf($htmlIcon, '&#128274;'),
                        'inputOptions' => [
                            'class' => 'form-control',
                            'placeholder' => 'Password',
                        ],
                    ])->passwordInput() ?>
                </div>

                <div class="mb-4">
                    <?= $form->field($model, 'rememberMe')->checkbox() ?>
                </div>

                <div class="d-grid">
                    <?= Html::submitButton(
                        'Sign in',
                        [
                            'class' => 'btn login-btn btn-lg rounded-3 text-white',
                            'name' => 'login-button',
                        ],
                    ) ?>
                </div>

                <?php ActiveForm::end(); ?>

            </div>
        </div>

    </div>
</div>
