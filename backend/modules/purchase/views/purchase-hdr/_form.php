<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var backend\modules\purchase\models\PurchaseHdr $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="purchase-hdr-form">

	<?php $form = ActiveForm::begin(); ?>

		<?= $form->field($model, 'purchase_num')->textInput(['maxlength' => 16]) ?>

		<?= $form->field($model, 'id_supplier')->textInput() ?>

		<?= $form->field($model, 'id_warehouse')->textInput() ?>

		<?= $form->field($model, 'purchase_date')->textInput() ?>

		<?= $form->field($model, 'id_status')->textInput() ?>

		<div class="form-group">
			<?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
		</div>

	<?php ActiveForm::end(); ?>

</div>
