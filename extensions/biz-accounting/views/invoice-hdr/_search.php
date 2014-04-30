<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var biz\models\searchs\InvoiceHdr $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="invoice-hdr-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id_invoice') ?>

    <?= $form->field($model, 'inv_num') ?>

    <?= $form->field($model, 'type') ?>

    <?= $form->field($model, 'inv_date') ?>

    <?= $form->field($model, 'due_date') ?>

    <?php // echo $form->field($model, 'id_vendor') ?>

    <?php // echo $form->field($model, 'inv_value') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'create_date') ?>

    <?php // echo $form->field($model, 'create_by') ?>

    <?php // echo $form->field($model, 'update_date') ?>

    <?php // echo $form->field($model, 'update_by') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
