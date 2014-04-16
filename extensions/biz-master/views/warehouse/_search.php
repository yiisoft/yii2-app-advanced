<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var biz\master\models\WarehouseSearch $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="warehouse-search">

	<?php $form = ActiveForm::begin([
		'action' => ['index'],
		'method' => 'get',
	]); ?>

		<?= $form->field($model, 'id_warehouse') ?>

		<?= $form->field($model, 'cd_whse') ?>

		<?= $form->field($model, 'nm_whse') ?>

		<?= $form->field($model, 'create_date') ?>

		<?= $form->field($model, 'create_by') ?>

		<?php // echo $form->field($model, 'update_date') ?>

		<?php // echo $form->field($model, 'update_by') ?>

		<div class="form-group">
			<?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
			<?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
		</div>

	<?php ActiveForm::end(); ?>

</div>
