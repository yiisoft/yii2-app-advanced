<?php

use yii\helpers\Html;
use \yii\bootstrap4\ActiveForm;

/* @var $loginForm frontend\forms\auth\LoginForm */

$this->title = 'LogIn';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="card">
    <div class="card-body login">
        <p class="login-box-msg">Sign in to start earn</p>

        <?php $form = ActiveForm::begin(['id' => 'login-form']) ?>

        <?= $form->field($loginForm, 'username', [
            'options' => ['class' => 'form-group has-feedback'],
            'inputTemplate' => '{input}<div class="input-group-append"><div class="input-group-text"><span class="fas fa-envelope"></span></div></div>',
            'template' => '{beginWrapper}{input}{error}{endWrapper}',
            'wrapperOptions' => ['class' => 'input-group mb-3']
        ])
            ->label(false)
            ->textInput(['placeholder' => $loginForm->getAttributeLabel('username')]) ?>

        <?= $form->field($loginForm, 'password', [
            'options' => ['class' => 'form-group has-feedback'],
            'inputTemplate' => '{input}<div class="input-group-append"><div class="input-group-text"><span class="fas fa-lock"></span></div></div>',
            'template' => '{beginWrapper}{input}{error}{endWrapper}',
            'wrapperOptions' => ['class' => 'input-group mb-3']
        ])
            ->label(false)
            ->passwordInput(['placeholder' => $loginForm->getAttributeLabel('password')]) ?>

        <div class="row">
            <div class="col-8">
                <?= $form->field($loginForm, 'rememberMe')->checkbox() ?>
            </div>
            <div class="col-4">
                <?= Html::submitButton('Sign In', ['class' => 'btn btn-primary btn-block']) ?>
            </div>
        </div>

        <?php ActiveForm::end(); ?>

        <div class="social-auth-links text-center mb-3">
            <p>- OR -</p>
            <?/*= yii\authclient\widgets\AuthChoice::widget([
                'baseAuthUrl' => ['network/auth']
            ]); */?>
        </div>
        <!-- /.social-auth-links -->

        <p class="mb-1">
            <?= Html::a('I forgot my password', ['auth/reset/request']) ?>
        </p>
        <p class="mb-0">
            <?= Html::a('Register a new member', ['/auth/signup/request']) ?>
        </p>
    </div>
    <!-- /.login-card-body -->
</div>
