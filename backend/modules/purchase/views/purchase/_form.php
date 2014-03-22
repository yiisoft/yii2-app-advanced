<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\web\JsExpression;
use kartik\widgets\Select2;
use yii\helpers\ArrayHelper;
use backend\modules\master\models\Warehouse;
use yii\jui\AutoComplete;

/**
 * @var yii\web\View $this
 * @var backend\modules\purchase\models\PurchaseHdr $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<?php
$pluginOptions = [
	'ajax' => [
		'dataType' => 'json',
		'url' => new JsExpression("function() { return jQuery(this).data('url'); }"),
		'data' => new JsExpression('function(term,page) { return {term:term}; }'),
		'results' => new JsExpression('function(data,page) { return {results:data}; }'),
	],
	'initSelection' => new JsExpression('yii.detail.initSelectionFunc'),
];
?>
<div class="purchase-hdr-form">

	<?php $form = ActiveForm::begin([
		'id'=>'purchase-form',
		
	]); ?>
	<?php echo $form->errorSummary($model) ?>
	<div style="display: block">
		<div class="col-lg-4">
			<?= $form->field($model, 'purchase_num')->textInput(['maxlength' => 16, 'readonly' => true]); ?>
		</div>
		<div class="col-lg-4">
			<?php
			Html::activeHiddenInput($model, 'id_supplier');
			$field = $form->field($model,"id_supplier",['template'=>"{label}\n{input}{text}\n{hint}\n{error}"])->input('hidden');
			$field->parts['{text}'] = AutoComplete::widget([
				'model'=>$model,
				'attribute'=>'idSupplier[nm_supplier]',
				'options'=>['class'=>'form-control'],
				'clientOptions'=>[
					'source'=>  new JsExpression("yii.purchase.sourceSupplier"),
					'select'=>new JsExpression("function(event,ui){
	$('#purchasehdr-id_supplier').val(ui.item.id);
}"),
				]
			]);
			echo $field;
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
	</div>
	<?= $this->render('_detail', ['model' => $model, 'details'=>$details]) ?>
	<div class="col-lg-12">
		<div class="form-group">
			<?php 
			echo Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ;
			 ?>
		</div>
	</div>
	<?php ActiveForm::end(); ?>

</div>