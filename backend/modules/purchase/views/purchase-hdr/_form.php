<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use yii\web\JsExpression;
use kartik\widgets\Select2;
use yii\helpers\ArrayHelper;

/**
 * @var yii\web\View $this
 * @var backend\modules\purchase\models\PurchaseHdr $model
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
			<?= $form->field($model, 'purchase_num')->textInput(['maxlength' => 16]) ?>
		</div>
		<div class="col-lg-4">
			<?php
			$urlSupp = Html::url(['list-of-supplier']);
			echo $form->field($model, 'id_supplier')->widget(Select2::classname(), [
				'options' => ['data-url' => $urlSupp],
				'pluginOptions' => ArrayHelper::merge($pluginOptions, ['ajax' => ['url' => $urlSupp]]),
			]);
			?>
		</div>
		<div class="col-lg-4" >
			<?php
			$urlWhs = Html::url(['list-of-warehouse']);
			echo $form->field($model, 'id_warehouse')->widget(Select2::classname(), [
				'options' => ['data-url' => $urlWhs],
				'pluginOptions' => ArrayHelper::merge($pluginOptions, ['ajax' => ['url' => $urlWhs]]),
			]);
			?>
		</div>
	</div>
	<div style="display: block">
		<div class="col-lg-4">
			<?php
			echo $form->field($model, 'purchase_date', [
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
			<?php
			echo $form->field($model, 'id_status', [
				'template' => "{label}{input}<br><span class='btn btn-primary'>Draft</span>\n{hint}\n{error}"
			])->input('hidden', ['value' => 1]);
			?>
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
