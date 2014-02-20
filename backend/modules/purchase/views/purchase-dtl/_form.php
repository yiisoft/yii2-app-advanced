<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var backend\modules\purchase\models\PurchaseDtl $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="purchase-dtl-form">

	<?php $form = ActiveForm::begin(); ?>

		<?= $form->field($model, 'id_purchase_hdr')->textInput() ?>

		<?= $form->field($model, 'id_product')->textInput() ?>

		<?= $form->field($model, 'id_supplier')->textInput() ?>

		<?= $form->field($model, 'purch_qty')->textInput() ?>

		<?= $form->field($model, 'id_uom')->textInput() ?>

		<?= $form->field($model, 'purch_price')->textInput() ?>

		<div class="form-group">
			<?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
		</div>

	<?php ActiveForm::end(); ?>

</div>
