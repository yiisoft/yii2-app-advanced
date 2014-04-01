<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\AutoComplete;
use backend\modules\master\models\GlobalConfig;

/**
 * @var yii\web\View $this
 * @var backend\modules\master\models\GlobalConfig $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="global-config-form">

	<?php $form = ActiveForm::begin(); ?>

	<?php
	$groups = GlobalConfig::find()->select('config_group')->distinct(true)->column();
	echo $form->field($model, 'config_group')->widget('yii\jui\AutoComplete', [
		'options' => ['class' => 'form-control', 'maxlength' => 16],
		'clientOptions' => [
			'source' => $groups
		]
	])
	?>

	<?= $form->field($model, 'config_name')->textInput(['maxlength' => 32]) ?>

	<?= $form->field($model, 'config_value')->textInput() ?>

	<?= $form->field($model, 'description')->textInput(['maxlength' => 128]) ?>

    <div class="form-group">
		<?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

	<?php ActiveForm::end(); ?>

</div>
