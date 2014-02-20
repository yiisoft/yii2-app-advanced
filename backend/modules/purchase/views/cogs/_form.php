<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var backend\modules\purchase\models\Cogs $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="cogs-form">

	<?php $form = ActiveForm::begin(); ?>

		<?= $form->field($model, 'id_branch')->textInput() ?>

		<?= $form->field($model, 'id_product')->textInput() ?>

		<?= $form->field($model, 'id_uom')->textInput() ?>

		<?= $form->field($model, 'cogs')->textInput() ?>

		<div class="form-group">
			<?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
		</div>

	<?php ActiveForm::end(); ?>

</div>
