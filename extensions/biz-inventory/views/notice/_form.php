<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var biz\models\TransferNotice $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="transfer-notice-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_transfer')->textInput() ?>

    <?= $form->field($model, 'noticeDate') ?>

    <?= $form->field($model, 'description')->textInput() ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <?= $form->field($model, 'notice_date')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
