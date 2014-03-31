<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\modules\master\models\Branch;
/**
 * @var yii\web\View $this
 * @var backend\modules\sales\models\Cashdrawer $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="cashdrawer-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_branch')->dropDownList(ArrayHelper::map(Branch::find()->all(), 'id_branch', 'nm_branch')) ?>

    <?= $form->field($model, 'cashier_no')->dropDownList([1=>1,2=>2,3=>3,4=>4,5=>5,6=>6,7=>7]) ?>

    <?= $form->field($model, 'init_cash')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
	
</div>
