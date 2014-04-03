<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var backend\modules\accounting\models\Coa $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="coa-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'cd_account')->textInput(['maxlength' => 16]) ?>

    <?= $form->field($model, 'coa_type')->textInput() ?>

    <?= $form->field($model, 'normal_balance')->textInput(['maxlength' => 1]) ?>

    <?= $form->field($model, 'id_coa_parent')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
