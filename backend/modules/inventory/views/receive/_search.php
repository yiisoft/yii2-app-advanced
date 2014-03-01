<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var backend\modules\inventory\models\TransferHdrSearch $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="transfer-hdr-search">

	<?php $form = ActiveForm::begin([
		'action' => ['index'],
		'method' => 'get',
	]); ?>

		<?= $form->field($model, 'id_transfer_hdr') ?>

		<?= $form->field($model, 'id_branch') ?>

		<?= $form->field($model, 'transfer_num') ?>

		<?= $form->field($model, 'id_warehouse_source') ?>

		<?= $form->field($model, 'id_warehouse_dest') ?>

		<?php // echo $form->field($model, 'transfer_date') ?>

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
