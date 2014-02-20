<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var backend\modules\purchase\models\PurchaseDtlSearch $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="purchase-dtl-search">

	<?php $form = ActiveForm::begin([
		'action' => ['index'],
		'method' => 'get',
	]); ?>

		<?= $form->field($model, 'id_purchase_dtl') ?>

		<?= $form->field($model, 'id_purchase_hdr') ?>

		<?= $form->field($model, 'id_product') ?>

		<?= $form->field($model, 'id_supplier') ?>

		<?= $form->field($model, 'purch_price') ?>

		<?php // echo $form->field($model, 'purch_qty') ?>

		<?php // echo $form->field($model, 'id_uom') ?>

		<?php // echo $form->field($model, 'update_date') ?>

		<?php // echo $form->field($model, 'update_by') ?>

		<?php // echo $form->field($model, 'create_by') ?>

		<?php // echo $form->field($model, 'create_date') ?>

		<div class="form-group">
			<?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
			<?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
		</div>

	<?php ActiveForm::end(); ?>

</div>
