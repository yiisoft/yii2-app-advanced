<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var backend\modules\accounting\models\AccPeriodeSearch $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="acc-periode-search">

	<?php $form = ActiveForm::begin([
		'action' => ['index'],
		'method' => 'get',
	]); ?>

		<?= $form->field($model, 'id_periode') ?>

		<?= $form->field($model, 'id_branch') ?>

		<?= $form->field($model, 'nm_periode') ?>

		<?= $form->field($model, 'date_from') ?>

		<?= $form->field($model, 'date_to') ?>

		<?php // echo $form->field($model, 'status') ?>

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
