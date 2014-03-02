<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var backend\modules\master\models\ProductSupplier $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="product-supplier-form">

	<?php $form = ActiveForm::begin(); ?>

		<?= $form->field($model, 'id_product')->textInput() ?>

		<?= $form->field($model, 'id_supplier')->textInput() ?>

		<div class="form-group">
			<?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
		</div>

	<?php ActiveForm::end(); ?>

</div>
