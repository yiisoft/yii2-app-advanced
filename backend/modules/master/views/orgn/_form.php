<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var backend\modules\master\models\Orgn $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="orgn-form col-lg-6" style="padding-left: 0px;">


    <?php $form = ActiveForm::begin(); ?>
    <div class="panel panel-primary">
        <div class="panel-heading">
            New Organization
        </div>
        <div class="panel-body">
            <?= $form->field($model, 'cd_orgn')->textInput(['maxlength' => 4, 'style'=>'width:120px;']) ?>

            <?= $form->field($model, 'nm_orgn')->textInput(['maxlength' => 64]) ?>
        </div>
    </div>
    
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
