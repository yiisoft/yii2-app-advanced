<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var biz\master\models\Uom $model
 * @var yii\widgets\ActiveForm $form
 */
?>
<div class="panel panel-primary">
    <div class="panel-heading">
        Uoms
    </div>
    <div class="panel-body">
        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'cd_uom')->textInput(['maxlength' => 4]) ?>

        <?= $form->field($model, 'nm_uom')->textInput(['maxlength' => 32]) ?>

        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>

    </div>   

    <?php ActiveForm::end(); ?>

</div>