<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var biz\models\searchs\PriceCategory $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="price-category-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id_price_category') ?>

    <?= $form->field($model, 'nm_price_category') ?>

    <?= $form->field($model, 'formula') ?>

    <?= $form->field($model, 'create_by') ?>

    <?= $form->field($model, 'update_date') ?>

    <?php // echo $form->field($model, 'update_by') ?>

    <?php // echo $form->field($model, 'create_date') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
