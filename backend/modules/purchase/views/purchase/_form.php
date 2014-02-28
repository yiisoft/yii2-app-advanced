<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use yii\web\JsExpression;
use kartik\widgets\Select2;
use yii\helpers\ArrayHelper;
use backend\modules\master\models\Warehouse;

/**
 * @var yii\web\View $this
 * @var backend\modules\purchase\models\PurchaseHdr $model
 * @var yii\widgets\ActiveForm $form
 */
?>
<script>
	var initSelectionFunc = function(element, callback) {
		var id = $(element).val();
		if(id){
			callback({id: id,text: $(element).data('text')});
		}
	};
<?php
$pluginOptions = [
	'ajax' => [
		'dataType' => 'json',
		'url' => new JsExpression("function() { return jQuery(this).data('url'); }"),
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
			<?= $form->field($model, 'purchase_num')->textInput(['maxlength' => 16, 'readonly' => true]); ?>
		</div>
		<div class="col-lg-4">
			<?php
			$urlSupp = Html::url(['list-of-supplier']);
			echo $form->field($model, 'id_supplier')->widget(Select2::classname(), [
				'options' => [
					'data-url' => $urlSupp,
					'data-text' => ArrayHelper::getValue($model, 'idSupplier.nm_supplier')
				],
				'pluginOptions' => $pluginOptions,
			]);
			?>
		</div>
		<div class="col-lg-4" >
			<?= $form->field($model, 'id_warehouse')->dropDownList(Warehouse::WarehouseList()); ?>
		</div>
	</div>
	<div style="display: block">
		<div class="col-lg-4">
			<?php
			echo $form->field($model, 'purchase_date')
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
