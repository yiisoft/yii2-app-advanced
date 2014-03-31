<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\AutoComplete;
use yii\web\JsExpression;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use backend\modules\master\models\Uom;

/**
 * @var yii\web\View $this
 * @var backend\modules\master\models\ProductUom $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class=" product-uom-form col-lg-6" style="padding-left: 0px;">

    <?php $form = ActiveForm::begin(); ?>
    <div class="panel panel-primary">
        <div class="panel-heading">Product Uoms</div>
        <div class="panel-body">
            <?php
            $id_input = Html::getInputId($model, 'id_product');
            $field = $form->field($model, 'id_product', ['template' => "{label}\n{input}\n{text}\n{hint}\n{error}"]);
            $field->labelOptions['for'] = $id_input;
            $field->input('hidden', ['id' => 'id_product']);
            $field->parts['{text}'] = AutoComplete::widget([
                    'model' => $model,
                    'attribute' => 'idProduct[nm_product]',
                    'options' => ['class' => 'form-control', 'id' => $id_input],
                    'clientOptions' => [
                        'source' => Url::toRoute(['product/auto-product']),
                        'select' => new JsExpression('function(event,ui){$(\'#id_product\').val(ui.item.did)}'),
                        'open' => new JsExpression('function(event,ui){$(\'#id_product\').val(\'\')}'),
                    ],
            ]);
            echo $field;
            ?>

            <?= $form->field($model, 'id_uom')->dropDownList(ArrayHelper::map(Uom::find()->all(), 'id_uom', 'nm_uom'), ['style' => 'width:200px;']); ?>

            <?= $form->field($model, 'isi')->textInput() ?>
        </div>
    </div>



    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
