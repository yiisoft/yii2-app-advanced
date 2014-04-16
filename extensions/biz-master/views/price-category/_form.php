<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var biz\master\models\PriceCategory $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="price-category-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nm_price_category')->textInput() ?>

    <?= $form->field($model, 'formula')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
