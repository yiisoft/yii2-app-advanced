<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use biz\master\models\Warehouse;

/**
 * @var yii\web\View $this
 * @var biz\purchase\models\PurchaseHdr $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="receive-form">
    <?php
    $form = ActiveForm::begin([
                'id' => 'receive-form',
    ]);
    ?>
    <?php 
	$models = $details;
	$models[] = $model;
	echo $form->errorSummary($models) ?>
    <?= $this->render('_detail', ['model' => $model, 'details' => $details]) ?> 
    <div class="col-lg-3" style="padding-right: 0px;">
        <div class="panel panel-primary">
            <div class="panel-heading">
                Transfer Header
            </div>
            <div class="panel-body">
                <?= $form->field($model, 'transfer_num')->textInput(['readonly' => true]); ?>
                <?= $form->field($model, 'idWarehouseSource[nm_whse]')->textInput(['readonly' => true]); ?>
                <?= $form->field($model, 'idWarehouseDest[nm_whse]')->textInput(['readonly' => true]); ?>
                <?= $form->field($model, 'transfer_date')->textInput(['readonly' => true]); ?>
                
            </div>
        </div>
        <div class="form-group">
            <?php
            echo Html::submitButton('Receive', ['class' => 'btn btn-primary']);
            ?>
        </div>
    </div>
    <?php ActiveForm::end(); ?>

</div>