<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\modules\accounting\models\Coa;
use yii\helpers\ArrayHelper;

/**
 * @var yii\web\View $this
 * @var backend\modules\accounting\models\Coa $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="coa-form col-lg-6">

    <?php $form = ActiveForm::begin(); ?>
    <div class="panel panel-primary">
        <div class="panel-heading">Chart of Account</div>
        <div class="panel-body">
            <?= $form->field($model, 'coa_type')->dropDownList(Coa::getCoaType(), ['style' => 'width:180px;']) ?>

            <?= $form->field($model, 'cd_account')->textInput(['maxlength' => 16,'style' => 'width:180px;']) ?>

            <?= $form->field($model, 'nm_account')->textInput(['maxlength' => 64]) ?>

            <?= $form->field($model, 'id_coa_parent')->textInput() ?>

            <?= $form->field($model, 'normal_balance')->radioList(ArrayHelper::map(Coa::getBalanceType(), 'normal_balance', 'nm_balance')) ?>

        </div>

    </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
