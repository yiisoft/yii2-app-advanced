<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var backend\modules\master\models\ProductUom $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="product-uom-form">

	<?php $form = ActiveForm::begin(); ?>

		<?= $form->field($model, 'id_product')->textInput() ?>

		<?= $form->field($model, 'id_uom')->textInput() ?>

		<?= $form->field($model, 'isi')->textInput() ?>

		<?= $form->field($model, 'smallest')->checkbox() ?>

		<div class="form-group">
			<?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
		</div>

	<?php ActiveForm::end(); ?>

</div>
