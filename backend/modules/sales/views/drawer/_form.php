<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var backend\modules\sales\models\CashDrawer $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="cash-drawer-form">

	<?php $form = ActiveForm::begin(); ?>
	<?php $readonly = $action == 'close'; ?>
	<?=
	$form->field($model, 'id_branch')->dropDownList([
		1 => 'Satu',
			], ['readonly' => $readonly])
	?>

	<?=
	$form->field($model, 'no_cashier')->dropDownList([
		1 => 1, 2 => 2, 3 => 3, 4 => 4
			], ['readonly' => $readonly])
	?>

	<?= $form->field($model, 'name_cashier')->textInput(['readonly' => true]) ?>

	<?= $form->field($model, 'initial_cash')->textInput(['readonly' => $readonly]) ?>

	<?= $action == 'open' ? '' : $form->field($model, 'close_cash')->textInput() ?>

	<?= $form->field($model, 'create_date')->textInput(['readonly' => true]) ?>

	<div class="form-group">
		<?php
		$text = $model->isNewRecord ? 'Open New' : ($action == 'open' ? 'Update' : 'Close');
		?>
		<?= Html::submitButton($text, ['class' => 'btn btn-success']) ?>
		<?=
		$model->isNewRecord ? '' : ($action == 'open' ? Html::a('Pos', yii\helpers\Url::toRoute(['pos/create']), [
							'class' => 'btn btn-primary'
						]) : '');
		?>
	</div>

	<?php ActiveForm::end(); ?>

</div>
