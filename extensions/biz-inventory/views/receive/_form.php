<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use biz\inventory\components\ReceiveAsset;
use biz\tools\BizDataAsset;

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
    echo $form->errorSummary($models)
    ?>
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
                <?= $form->field($model, 'transferDate')->textInput(['readonly' => true]); ?>
                <?php
                echo $form->field($model, 'receiveDate')
                    ->widget('yii\jui\DatePicker', [
                        'options' => ['class' => 'form-control', 'style' => 'width:50%'],
                        'clientOptions' => [
                            'dateFormat' => 'dd-mm-yy'
                        ],
                ]);
                ?>

            </div>
        </div>
        <div class="form-group">
            <?php
            echo Html::submitButton('Update', ['class' => 'btn btn-primary']);
            ?>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>
<?php
ReceiveAsset::register($this);
BizDataAsset::register($this, [
    'master'=>$masters
]);
$js_ready = '$("#product").data("ui-autocomplete")._renderItem = yii.global.renderItem;';
$this->registerJs($js_ready);
