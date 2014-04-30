<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var biz\models\searchs\Coa $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="coa-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id_coa') ?>

    <?= $form->field($model, 'id_coa_parent') ?>

    <?= $form->field($model, 'cd_account') ?>

    <?= $form->field($model, 'nm_account') ?>

    <?= $form->field($model, 'coa_type') ?>

    <?php // echo $form->field($model, 'normal_balance') ?>

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
