<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var backend\modules\master\models\Warehouse $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="warehouse-form">

	<?php $form = ActiveForm::begin(); ?>

		<?= $form->field($model, 'id_branch')->textInput() ?>
	
		<?= $form->field($model, 'cd_whse')->textInput(['maxlength' => 4]) ?>

		<?= $form->field($model, 'nm_whse')->textInput(['maxlength' => 32]) ?>

		<div class="form-group">
			<?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
		</div>

	<?php ActiveForm::end(); ?>

</div>
