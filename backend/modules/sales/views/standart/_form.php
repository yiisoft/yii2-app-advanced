<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\web\JsExpression;
use backend\modules\master\models\Warehouse;
use yii\jui\AutoComplete;

/**
 * @var yii\web\View $this
 * @var backend\modules\purchase\models\PurchaseHdr $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="purchase-hdr-form">
    <?php
    $form = ActiveForm::begin([
                'id' => 'sales-form',
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
                Sales Header
            </div>
            <div class="panel-body">
                <?= $form->field($model, 'sales_num')->textInput(['maxlength' => 16, 'readonly' => true]); ?>
				<?= Html::activeHiddenInput($model, 'id_customer'); ?>
                <?= $form->field($model, 'idCustomer[nm_cust]')->widget('yii\jui\AutoComplete',[
					'options' => ['class' => 'form-control'],
                            'clientOptions' => [
                                'source' => new JsExpression('yii.sales.sourceCustomer'),
								'select'=> new JsExpression('yii.sales.onCustomerSelect'),
								'open'=> new JsExpression('yii.sales.onCustomerOpen'),
                            ],
					]); ?>
                <?= $form->field($model, 'id_warehouse')->dropDownList(Warehouse::WarehouseList()); ?>
                <?php
                echo $form->field($model, 'sales_date')
                        ->widget('yii\jui\DatePicker', [
                            'options' => ['class' => 'form-control', 'style' => 'width:50%'],
                            'clientOptions' => [
                                'dateFormat' => 'yy-mm-dd'
                            ],
                ]);
                ?>
            </div>
        </div>
        <div class="form-group">
            <?php
            echo Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']);
            ?>
        </div>
    </div>
    <?php ActiveForm::end(); ?>

</div>