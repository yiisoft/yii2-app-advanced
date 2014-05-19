<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var biz\models\CustomerDetail $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="customer-detail-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_customer')->textInput() ?>

    <?= $form->field($model, 'id_distric')->textInput() ?>

    <?= $form->field($model, 'addr1')->textInput(['maxlength' => 128]) ?>

    <?= $form->field($model, 'id_kab')->textInput() ?>

    <?= $form->field($model, 'id_kec')->textInput() ?>

    <?= $form->field($model, 'id_kel')->textInput() ?>

    <?= $form->field($model, 'latitude')->textInput() ?>

    <?= $form->field($model, 'longtitude')->textInput() ?>

    <?= $form->field($model, 'addr2')->textInput(['maxlength' => 128]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
