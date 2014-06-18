<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use biz\tools\Helper;

/**
 * @var yii\web\View $this
 * @var biz\models\User2Branch $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="user2-branch-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= ''//$form->field($model, 'id_branch')->textInput() ?>
    <?= $form->field($model, 'id_branch')->dropDownList(Helper::getBranchList()) ?>                 

    <?= $form->field($model, 'id_user')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
