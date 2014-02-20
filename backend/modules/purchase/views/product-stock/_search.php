<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var backend\modules\purchase\models\ProductStockSearch $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="product-stock-search">

	<?php $form = ActiveForm::begin([
		'action' => ['index'],
		'method' => 'get',
	]); ?>

		<?= $form->field($model, 'id_stock') ?>

		<?= $form->field($model, 'id_product') ?>

		<?= $form->field($model, 'id_periode') ?>

		<?= $form->field($model, 'id_warehouse') ?>

		<?= $form->field($model, 'status_closing') ?>

		<?php // echo $form->field($model, 'qty_stock') ?>

		<?php // echo $form->field($model, 'id_uom') ?>

		<?php // echo $form->field($model, 'create_date') ?>

		<?php // echo $form->field($model, 'create_by') ?>

		<?php // echo $form->field($model, 'update_date') ?>

		<?php // echo $form->field($model, 'update_by') ?>

		<div class="form-group">
			<?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
			<?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
		</div>

	<?php ActiveForm::end(); ?>

</div>
