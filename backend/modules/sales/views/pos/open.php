<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var backend\modules\sales\models\Session $model
 * @var ActiveForm $form
 */
?>
<div class="open">

	<?php $form = ActiveForm::begin(); ?>

		<?= $form->field($model, 'no_cashier') ?>
		<?= $form->field($model, 'initial') ?>
	
		<div class="form-group">
			<?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
		</div>
	<?php ActiveForm::end(); ?>

</div><!-- open -->
