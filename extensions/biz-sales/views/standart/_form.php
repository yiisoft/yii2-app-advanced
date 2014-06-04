<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\web\JsExpression;
use yii\jui\AutoComplete;
use biz\tools\Helper;
use biz\sales\assets\StandartAsset;
use yii\web\View;

/**
 * @var yii\web\View $this
 * @var biz\purchase\models\PurchaseHdr $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="sales-form">
    <?php
    $form = ActiveForm::begin([
            'id' => 'sales-form',
    ]);
    ?>
    <?php
    $models = $details;
    $models[] = $model;
    echo $form->errorSummary($models)
    ?>
    <?= $this->render('_detail', ['model' => $model, 'details' => $details]) ?> 
    <div class="col-lg-3" style="padding-right: 0px;">
        <div class="panel panel-primary">
            <div class="panel-heading">
                Sales Header
            </div>
            <div class="panel-body">
                <?= $form->field($model, 'sales_num')->textInput(['readonly' => true]); ?>
                <?= $form->field($model, 'id_warehouse')->dropDownList(Helper::getWarehouseList()); ?>
                <?php
                echo $form->field($model, 'salesDate')
                    ->widget('yii\jui\DatePicker', [
                        'options' => ['class' => 'form-control', 'style' => 'width:50%'],
                        'clientOptions' => [
                            'dateFormat' => 'dd-mm-yy'
                        ],
                ]);
                ?>
                <hr >
                <?php
                $id_input = Html::getInputId($model, 'id_customer');
                $field = $form->field($model, 'id_customer', ['template' => "{label}\n{input}\n{text}\n{hint}\n{error}"]);
                $field->labelOptions['for'] = $id_input;
                $field->input('hidden', ['id' => 'id_customer']);
                $field->parts['{text}'] = AutoComplete::widget([
                        'model' => $model,
                        'attribute' => 'idCustomer[nm_cust]',
                        'options' => ['class' => 'form-control', 'id' => $id_input],
                        'clientOptions' => [
                            'source' => new JsExpression('yii.standart.sourceCustomer'),
                            'select' => new JsExpression('yii.standart.onCustomerSelect'),
                            'open' => new JsExpression('yii.standart.onCustomerOpen'),
                        ],
                ]);
                echo $field;
                ?>
                <?= $form->field($model, 'discount')->textInput() ?>
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
<?php
StandartAsset::register($this);
$j_master = json_encode($masters);
$js_begin = <<<BEGIN
    var master = $j_master;
BEGIN;
$js_ready = '$("#product").data("ui-autocomplete")._renderItem = yii.global.renderItem';
$this->registerJs($js_begin, View::POS_BEGIN);
$this->registerJs($js_ready);
