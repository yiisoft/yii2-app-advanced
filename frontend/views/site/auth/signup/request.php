<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap4\ActiveForm */
/* @var $signupForm frontend\forms\auth\SignupForm */

$this->title = 'Signup';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="card">
    <div class="card-body signup-request">

        <p>Please fill out the following fields to signup:</p>

        <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>

        <?= $form->field($signupForm, 'username')->textInput(['autofocus' => true]) ?>

        <?= $form->field($signupForm, 'email') ?>

        <?= $form->field($signupForm, 'password')->passwordInput() ?>

        <div class="form-group">
            <?= Html::submitButton('Signup', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
        </div>

        <?php ActiveForm::end(); ?>

        <div class="social-auth-links text-center mb-3">
            <p>- OR -</p>
            <?= $this->render('../authchoice')?>
        </div>
        <!-- /.social-auth-links -->

    </div>
</div>
