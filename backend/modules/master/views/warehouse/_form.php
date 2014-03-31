<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\modules\master\models\Branch;

/**
 * @var yii\web\View $this
 * @var backend\modules\master\models\Warehouse $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="warehouse-form col-lg-6" style="padding-left: 0px;">

    <?php $form = ActiveForm::begin(); ?>
    <div class="panel panel-primary">
        <div class="panel-heading">
            Warehouse
        </div>
        <div class="panel-body">
            <?= $form->field($model, 'id_branch')->dropDownList(ArrayHelper::map(Branch::find()->all(), 'id_branch', 'nm_branch'), ['style' => 'width:200px;']) ?>

            <?= $form->field($model, 'cd_whse')->textInput(['maxlength' => 4, 'style' => 'width:120px;']) ?>

            <?= $form->field($model, 'nm_whse')->textInput(['maxlength' => 32]) ?>
        </div>
    </div>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
