<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var \frontend\models\SignupForm $model */

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;

$this->title = 'Signup';
$this->params['breadcrumbs'][] = $this->title;
$this->params['meta_description'] = 'Create a new account to start building with Yii2.';
$this->params['meta_keywords'] = 'yii, yii2, signup, register, create account';
$htmlIcon = <<<HTML
<div class="input-group"><span class="input-group-text" aria-hidden="true">%s</span>{input}</div>{error}{hint}
HTML;
?>
<div class="site-signup d-flex align-items-center justify-content-center py-5">
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
                            Create Your<br>Account
                        </h2>
                        <p class="opacity-75 mb-0 login-brand-text">
                            Join us and start building amazing applications with Yii2.
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
                        <h1 class="h3 fw-bold mb-1">Create a new account</h1>
                        <p class="text-body-secondary small">Fill out the fields below to get started</p>
                    </div>

                    <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>

                    <div class="mb-3">
                        <label class="form-label fw-semibold small" for="signupform-username">Your Username</label>
                        <?= $form->field($model, 'username', [
                            'options' => ['class' => 'mb-0'],
                            'template' => sprintf($htmlIcon, '&#128100;'),
                            'inputOptions' => [
                                'autofocus' => true,
                                'class' => 'form-control',
                                'placeholder' => 'username',
                            ],
                        ])->textInput() ?>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold small" for="signupform-email">Your Email</label>
                        <?= $form->field($model, 'email', [
                            'options' => ['class' => 'mb-0'],
                            'template' => sprintf($htmlIcon, '&#9993;'),
                            'inputOptions' => [
                                'class' => 'form-control',
                                'placeholder' => 'email@example.com',
                            ],
                        ])->textInput() ?>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-semibold small" for="signupform-password">Your Password</label>
                        <?= $form->field($model, 'password', [
                            'options' => ['class' => 'mb-0'],
                            'template' => sprintf($htmlIcon, '&#128274;'),
                            'inputOptions' => [
                                'class' => 'form-control',
                                'placeholder' => 'Password',
                            ],
                        ])->passwordInput() ?>
                    </div>

                    <div class="d-grid">
                        <?= Html::submitButton(
                            'Signup',
                            [
                                'class' => 'btn login-btn btn-lg rounded-3 text-white',
                                'name' => 'signup-button',
                            ],
                        ) ?>
                    </div>

                    <?php ActiveForm::end(); ?>

                    <div class="text-body-secondary text-center mt-3 small">
                        Already have an account? <?= Html::a('Login', ['site/login']) ?>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>
