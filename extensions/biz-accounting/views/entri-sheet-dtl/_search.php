<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var biz\accounting\models\EntriSheetDtlSearch $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="entri-sheet-dtl-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id_esheet') ?>

    <?= $form->field($model, 'id_coa') ?>

    <?= $form->field($model, 'dk') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
