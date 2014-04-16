<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\web\JsExpression;
use biz\master\models\Warehouse;
use yii\jui\AutoComplete;

/**
 * @var yii\web\View $this
 * @var biz\purchase\models\PurchaseHdr $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="sales-form">
	<?php
	$form = ActiveForm::begin([
			'id' => 'sales-form',
	]);
	?>
	<?php
	$models = $details;
	$models[] = $model;
	echo $form->errorSummary($models)
	?>
	<?= $this->render('_detail', ['model' => $model, 'details' => $details]) ?> 
    <div class="col-lg-3" style="padding-right: 0px;">
        <div class="panel panel-primary">
            <div class="panel-heading">
                Sales Header
            </div>
            <div class="panel-body">
				<?= $form->field($model, 'sales_num')->textInput(['readonly' => true]); ?>
				<?= $form->field($model, 'id_warehouse')->dropDownList(Warehouse::WarehouseList()); ?>
				<?php
				echo $form->field($model, 'sales_date')
					->widget('yii\jui\DatePicker', [
						'options' => ['class' => 'form-control', 'style' => 'width:50%'],
						'clientOptions' => [
							'dateFormat' => 'yy-mm-dd'
						],
				]);
				?>
				<hr >
				<?php
				$id_input = Html::getInputId($model, 'id_customer');
				$field = $form->field($model, 'id_customer', ['template' => "{label}\n{input}\n{text}\n{hint}\n{error}"]);
				$field->labelOptions['for'] = $id_input;
				$field->input('hidden', ['id' => 'id_customer']);
				$field->parts['{text}'] = AutoComplete::widget([
						'model' => $model,
						'attribute' => 'idCustomer[nm_cust]',
						'options' => ['class' => 'form-control', 'id' => $id_input],
						'clientOptions' => [
							'source' => new JsExpression('yii.sales.sourceCustomer'),
							'select' => new JsExpression('yii.sales.onCustomerSelect'),
							'open' => new JsExpression('yii.sales.onCustomerOpen'),
						],
				]);
				echo $field;
				?>
				<?= $form->field($model, 'discount')->textInput() ?>
            </div>
        </div>
        <div class="form-group">
			<?php
			echo Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']);
			echo Html::a('X', '', ['id'=>'click-me']);
			?>
        </div>
    </div>
	<?php ActiveForm::end(); ?>

</div>