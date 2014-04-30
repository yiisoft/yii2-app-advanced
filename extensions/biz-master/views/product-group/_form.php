<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var biz\models\ProductGroup $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="product-group-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'cd_group')->textInput(['maxlength' => 4]) ?>

    <?= $form->field($model, 'nm_group')->textInput(['maxlength' => 32]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
