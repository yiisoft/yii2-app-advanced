<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use biz\accounting\models\Coa;
use yii\helpers\ArrayHelper;
use yii\jui\AutoComplete;
use yii\web\JsExpression;

/**
 * @var yii\web\View $this
 * @var biz\accounting\models\Coa $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="coa-form col-lg-6">

    <?php $form = ActiveForm::begin(); ?>
    <div class="panel panel-primary">
        <div class="panel-heading">Chart of Account</div>
        <div class="panel-body">
            <?= $form->field($model, 'coa_type')->dropDownList(Coa::getCoaType(), ['style' => 'width:180px;']) ?>

            <?= $form->field($model, 'cd_account')->textInput(['maxlength' => 16, 'style' => 'width:180px;']) ?>

            <?= $form->field($model, 'nm_account')->textInput(['maxlength' => 64]) ?>

            <?php
            $el_id = Html::getInputId($model, 'id_coa_parent');
            $field = $form->field($model, "id_coa_parent", ['template' => "{label}\n{input}{text}\n{hint}\n{error}"]);
            $field->labelOptions['for'] = $el_id;
            $field->hiddenInput(['id' => 'id_coa_parent']);
            $field->parts['{text}'] = AutoComplete::widget([
                    'model' => $model,
                    'attribute' => 'idCoaParent[nm_account]',
                    'options' => ['class' => 'form-control', 'id' => $el_id],
                    'clientOptions' => [
                        'source' => yii\helpers\Url::toRoute(['coa-list']),
                        'select' => new JsExpression('function(event,ui){$(\'#id_coa_parent\').val(ui.item.id)}'),
                        'open' => new JsExpression('function(event,ui){$(\'#id_coa_parent\').val(\'\')}'),
                    ]
            ]);
            echo $field;
            ?>

            <?= $form->field($model, 'normal_balance')->radioList(ArrayHelper::map(Coa::getBalanceType(), 'normal_balance', 'nm_balance')) ?>

        </div>

    </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
