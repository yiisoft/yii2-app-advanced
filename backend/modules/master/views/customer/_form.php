<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var backend\modules\master\models\Customer $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="customer-form">

	<?php $form = ActiveForm::begin(); ?>

		<?= $form->field($model, 'cd_cust')->textInput(['maxlength' => 13]) ?>

		<?= $form->field($model, 'nm_cust')->textInput(['maxlength' => 64]) ?>

		<?= $form->field($model, 'id_cclass')->textInput() ?>

		<?= $form->field($model, 'status')->textInput() ?>

		<?= $form->field($model, 'contact_name')->textInput(['maxlength' => 64]) ?>

		<?= $form->field($model, 'contact_number')->textInput(['maxlength' => 64]) ?>

		<div class="form-group">
			<?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
		</div>

	<?php ActiveForm::end(); ?>

</div>
