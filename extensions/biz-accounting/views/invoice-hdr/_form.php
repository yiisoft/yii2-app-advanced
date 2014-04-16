<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var biz\accounting\models\InvoiceHdr $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="invoice-hdr-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'inv_num')->textInput() ?>

    <?= $form->field($model, 'type')->textInput() ?>

    <?= $form->field($model, 'inv_date')->textInput() ?>

    <?= $form->field($model, 'id_vendor')->textInput() ?>

    <?= $form->field($model, 'inv_value')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
