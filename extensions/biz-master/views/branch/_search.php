<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var biz\master\models\BranchSearch $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="branch-search">

	<?php $form = ActiveForm::begin([
		'action' => ['index'],
		'method' => 'get',
	]); ?>

		<?= $form->field($model, 'id_branch') ?>

		<?= $form->field($model, 'id_orgn') ?>

		<?= $form->field($model, 'cd_branch') ?>

		<?= $form->field($model, 'nm_branch') ?>

		<?= $form->field($model, 'create_date') ?>

		<?php // echo $form->field($model, 'update_date') ?>

		<?php // echo $form->field($model, 'update_by') ?>

		<?php // echo $form->field($model, 'create_by') ?>

		<div class="form-group">
			<?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
			<?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
		</div>

	<?php ActiveForm::end(); ?>

</div>
