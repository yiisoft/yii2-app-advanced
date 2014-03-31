<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var backend\modules\master\models\Supplier $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="supplier-form col-lg-6" style="padding-left: 0px;">
    <?php $form = ActiveForm::begin(); ?>
    <div class="panel panel-primary">
        <div class="panel-heading">
            New Supplier
        </div>
        <div class="panel-body">
            <?= $form->field($model, 'cd_supplier')->textInput(['maxlength' => 4,'style'=>'width:120px;']) ?>

            <?= $form->field($model, 'nm_supplier')->textInput(['maxlength' => 32]) ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
