<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var backend\modules\sales\models\SalesHdr $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="sales-hdr-form">

	<?php $form = ActiveForm::begin(); ?>

		<?= $form->field($model, 'sales_num')->textInput(['maxlength' => 16]) ?>

		<?= $form->field($model, 'id_warehouse')->textInput() ?>

		<?= $form->field($model, 'id_customer')->textInput() ?>

		<?= $form->field($model, 'update_by')->textInput() ?>

		<?= $form->field($model, 'update_date')->textInput() ?>

		<?= $form->field($model, 'create_by')->textInput() ?>

		<?= $form->field($model, 'create_date')->textInput() ?>

		<?= $form->field($model, 'sales_date')->textInput() ?>

		<div class="form-group">
			<?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
		</div>

	<?php ActiveForm::end(); ?>

</div>
