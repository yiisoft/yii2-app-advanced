<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var biz\purchase\models\PurchaseHdrSearch $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="purchase-hdr-search">

	<?php $form = ActiveForm::begin([
		'action' => ['index'],
		'method' => 'get',
	]); ?>

		<?= $form->field($model, 'id_purchase_hdr') ?>

		<?= $form->field($model, 'purchase_num') ?>

		<?= $form->field($model, 'id_supplier') ?>

		<?= $form->field($model, 'id_warehouse') ?>

		<?= $form->field($model, 'purchaseDate') ?>

		<?php // echo $form->field($model, 'id_status') ?>

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
