<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var backend\modules\purchase\models\AccPeriode $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="acc-periode-form">

	<?php $form = ActiveForm::begin(); ?>

		<?= $form->field($model, 'id_periode')->textInput() ?>

		<?= $form->field($model, 'id_branch')->textInput() ?>

		<?= $form->field($model, 'nm_periode')->textInput(['maxlength' => 32]) ?>

		<?= $form->field($model, 'date_from')->textInput() ?>

		<?= $form->field($model, 'date_to')->textInput() ?>

		<div class="form-group">
			<?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
		</div>

	<?php ActiveForm::end(); ?>

</div>
