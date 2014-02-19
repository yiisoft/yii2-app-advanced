<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var backend\modules\master\models\Product $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="product-form">

	<?php $form = ActiveForm::begin(); ?>

		<?= $form->field($model, 'id_product')->textInput() ?>

		<?= $form->field($model, 'cd_product')->textInput(['maxlength' => 13]) ?>

		<?= $form->field($model, 'nm_product')->textInput(['maxlength' => 64]) ?>

		<?= $form->field($model, 'id_category')->textInput() ?>

		<div class="form-group">
			<?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
		</div>

	<?php ActiveForm::end(); ?>

</div>
