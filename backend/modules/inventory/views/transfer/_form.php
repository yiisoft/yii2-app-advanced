<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use yii\web\JsExpression;
use kartik\widgets\Select2;
use yii\helpers\ArrayHelper;
use backend\modules\master\models\Warehouse;

/**
 * @var yii\web\View $this
 * @var backend\modules\inventory\models\PurchaseHdr $model
 * @var yii\widgets\ActiveForm $form
 */
?>
<script>
	var initSelectionFunc = function(element, callback) {
		var id = $(element).val();
		var url = $(element).data('url');
		if (id !== "") {
			$.ajax(url, {
				data: {id: id},
				dataType: "json"
			}).done(function(data) {
				callback(data);
			});
		}

	};
<?php
$pluginOptions = [
	'ajax' => [
		'dataType' => 'json',
		'data' => new JsExpression('function(term,page) { return {term:term}; }'),
		'results' => new JsExpression('function(data,page) { return {results:data}; }'),
	],
	'initSelection' => new JsExpression('initSelectionFunc'),
];
?>
</script>
<div class="purchase-hdr-form">

	<?php $form = ActiveForm::begin(); ?>
	<?php
	$details = $detailProvider->getModels();
	array_unshift($details, $model);
	echo $form->errorSummary($details);
	?>
	<div style="display: block">
		<div class="col-lg-4">
			<?= $form->field($model, 'transfer_num')->textInput(['maxlength' => 16,'readonly'=>true]) ?>
		</div>
		<div class="col-lg-4">
			<?php
			echo $form->field($model, 'id_warehouse_source')->dropDownList(Warehouse::WarehouseList(true));
			?>
		</div>
		<div class="col-lg-4" >
			<?php
			echo $form->field($model,'id_warehouse_dest')->dropDownList(Warehouse::WarehouseList());
			?>
		</div>
	</div>
	<div style="display: block">
		<div class="col-lg-4">
			<?php
			echo $form->field($model, 'transfer_date', [
						'template' => "{label}<br>{input}\n<span class='info'></span>\n{hint}\n{error}"
					])
					->widget('yii\jui\DatePicker', [
						'options' => ['class' => 'form-control', 'style' => 'width:35%'],
						'clientOptions' => [
							'dateFormat' => 'yy-mm-dd'
						],
			]);
			?>
		</div>
		<div class="col-lg-4">
			
		</div>
	</div>
	<?= $this->render('_detail', ['model' => $model, 'detailProvider' => $detailProvider]) ?>
	<div class="col-lg-12">
		<div class="form-group">
			<?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
		</div>
	</div>
	<?php ActiveForm::end(); ?>

</div>
