<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var backend\modules\master\models\Supplier $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="supplier-form">

	<?php $form = ActiveForm::begin(); ?>

		<?= $form->field($model, 'cd_supplier')->textInput(['maxlength' => 4]) ?>

		<?= $form->field($model, 'nm_supplier')->textInput(['maxlength' => 32]) ?>

		<div class="form-group">
			<?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
		</div>

	<?php ActiveForm::end(); ?>

</div>
