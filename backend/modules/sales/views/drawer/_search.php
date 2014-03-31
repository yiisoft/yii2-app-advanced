<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var backend\modules\sales\models\CashdrawerSearch $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="cashdrawer-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id_cashdrawer') ?>

    <?= $form->field($model, 'client_machine') ?>

    <?= $form->field($model, 'id_branch') ?>

    <?= $form->field($model, 'cashier_no') ?>

    <?= $form->field($model, 'id_user') ?>

    <?php // echo $form->field($model, 'init_cash') ?>

    <?php // echo $form->field($model, 'close_cash') ?>

    <?php // echo $form->field($model, 'variants') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'create_date') ?>

    <?php // echo $form->field($model, 'create_by') ?>

    <?php // echo $form->field($model, 'update_date') ?>

    <?php // echo $form->field($model, 'update_by') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
