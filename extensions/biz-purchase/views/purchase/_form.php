<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\web\JsExpression;
use biz\master\models\Warehouse;
use yii\jui\AutoComplete;
use biz\tools\Helper;

/**
 * @var yii\web\View $this
 * @var biz\models\PurchaseHdr $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="purchase-hdr-form">
    <?php
    $form = ActiveForm::begin([
            'id' => 'purchase-form',
    ]);
    ?>
    <?php
    $models = $details;
    $models[] = $model;
    echo $form->errorSummary($models)
    ?>
    <div class="col-lg-3">
        <div class="panel panel-primary">
            <div class="panel-heading">
                Purchase Header
            </div>
            <div class="panel-body">
                <?= $form->field($model, 'purchase_num')->textInput(['maxlength' => 16, 'readonly' => true]); ?>
                <?php
                $el_id = Html::getInputId($model, 'id_supplier');
                $field = $form->field($model, "id_supplier", ['template' => "{label}\n{input}{text}\n{hint}\n{error}"]);
                $field->labelOptions['for'] = $el_id;
                $field->hiddenInput(['id' => 'id_supplier']);
                $field->parts['{text}'] = AutoComplete::widget([
                        'model' => $model,
                        'attribute' => 'idSupplier[nm_supplier]',
                        'options' => ['class' => 'form-control', 'id' => $el_id],
                        'clientOptions' => [
                            'source' => new JsExpression("yii.process.sourceSupplier"),
                            'select' => new JsExpression("yii.process.onSupplierSelect"),
                            'open' => new JsExpression("yii.process.onSupplierOpen"),
                        ]
                ]);
                echo $field;
                ?>
                <?= $form->field($model, 'id_warehouse')->dropDownList(Helper::getWarehouseList()); ?>
                <?php
                echo $form->field($model, 'purchaseDate')
                    ->widget('yii\jui\DatePicker', [
                        'options' => ['class' => 'form-control', 'style' => 'width:50%'],
                        'clientOptions' => [
                            'dateFormat' => 'dd-mm-yy'
                        ],
                ]);
                ?>
            </div>
            <div class="panel-footer" style="text-align: right;">
                <?php
            echo Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']);
            ?>
            </div>
        </div>
    </div>    
    <?= $this->render('_detail', ['model' => $model, 'details' => $details]) ?> 
    <?php ActiveForm::end(); ?>

</div>