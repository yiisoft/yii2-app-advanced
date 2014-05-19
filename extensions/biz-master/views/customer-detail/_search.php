<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var biz\models\searchs\CustomerDetail $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="customer-detail-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id_customer') ?>

    <?= $form->field($model, 'id_distric') ?>

    <?= $form->field($model, 'addr1') ?>

    <?= $form->field($model, 'addr2') ?>

    <?= $form->field($model, 'latitude') ?>

    <?php // echo $form->field($model, 'longtitude') ?>

    <?php // echo $form->field($model, 'id_kab') ?>

    <?php // echo $form->field($model, 'id_kec') ?>

    <?php // echo $form->field($model, 'id_kel') ?>

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
