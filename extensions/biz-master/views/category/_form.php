<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var biz\models\Category $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="panel panel-primary">
    <div class="panel-heading">
        Product Group
    </div>
    <div class="panel-body">
        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'cd_category')->textInput(['maxlength' => 4]) ?>

        <?= $form->field($model, 'nm_category')->textInput(['maxlength' => 32]) ?>

        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>

    </div>   

    <?php ActiveForm::end(); ?>

</div>
