<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use biz\models\Orgn;

/**
 * @var yii\web\View $this
 * @var biz\models\Branch $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="branch-form col-lg-6" style="padding-left: 0px;">

    <?php $form = ActiveForm::begin(); ?>
    <div class="panel panel-primary">
        <div class="panel-heading">
            Branch
        </div>
        <div class="panel-body">
            <?= $form->field($model, 'id_orgn')->dropDownList(ArrayHelper::map(Orgn::find()->all(), 'id_orgn', 'nm_orgn'), ['style' => 'width:200px;']); ?>

            <?= $form->field($model, 'cd_branch')->textInput(['maxlength' => 4, 'style' => 'width:120px;']) ?>

            <?= $form->field($model, 'nm_branch')->textInput(['maxlength' => 32]) ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
