<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;

/* @var $this yii\web\View */
?>

<div class="gl-header-form">

    <?php
    echo Html::dropDownList('', $es, $sheets, ['id' => 'sheets', 'prompt' => '-']);
    $form = ActiveForm::begin();
    echo $form->errorSummary($model);
    ?>

    <?=
    $form->field($model, 'glDate')->widget(DatePicker::className(), [
        'options' => ['class' => 'form-control', 'style' => 'width:50%'],
        'clientOptions' => [
            'dateFormat' => 'dd-mm-yy'
        ],
    ]);
    ?>
    <?= $form->field($model, 'id_branch')->textInput() ?>

    <?= $form->field($model, 'id_periode')->textInput() ?>

    <?= $form->field($model, 'description')->textInput() ?>

    <?= $form->field($model, 'gl_memo')->textInput(['maxlength' => 128]) ?>

    <?php
    if (!empty($details)) {
        echo $this->render('_detail', [
            'form' => $form,
            'details' => $details
        ]);
    }
    ?>
    <div class="form-group">
<?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

<?php ActiveForm::end(); ?>

</div>
<?php 
$url = \yii\helpers\Url::toRoute(['create']);
$js = <<<JS
    \$('#sheets').change(function(){
        window.location.href = '{$url}&es='+\$(this).val();
   });
JS;
$this->registerJs($js);