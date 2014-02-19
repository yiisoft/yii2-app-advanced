<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var backend\modules\master\models\Branch $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="branch-form">

	<?php $form = ActiveForm::begin(); ?>

		<?= $form->field($model, 'id_orgn')->textInput() ?>

		<?= $form->field($model, 'cd_branch')->textInput(['maxlength' => 4]) ?>

		<?= $form->field($model, 'nm_branch')->textInput(['maxlength' => 32]) ?>

		<div class="form-group">
			<?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
		</div>

	<?php ActiveForm::end(); ?>

</div>
