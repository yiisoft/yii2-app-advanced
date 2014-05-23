<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var biz\models\GlHeader $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="gl-header-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'glDate') ?>

    <?= $form->field($model, 'id_branch')->textInput() ?>

    <?= $form->field($model, 'id_periode')->textInput() ?>

    <?= $form->field($model, 'description')->textInput() ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <?= $form->field($model, 'gl_date')->textInput() ?>

    <?= $form->field($model, 'type_reff')->textInput() ?>

    <?= $form->field($model, 'id_reff')->textInput() ?>

    <?= $form->field($model, 'gl_memo')->textInput(['maxlength' => 128]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
