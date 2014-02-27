<?php 
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<div class="purchase-hdr-form">

	<?php $form = ActiveForm::begin(); ?>
	<?php
	$details = $detailProvider->getModels();
	array_unshift($details, $model);
	echo $form->errorSummary($details);
	?>
	<div style="display: block">
		<div class="col-lg-4">
			<?= Html::getAttributeValue($model, 'transfer_num'); ?>
		</div>
		<div class="col-lg-4">
			<?php
			echo Html::getAttributeValue($model, 'idWarehouseSource[nm_whse]');
			//echo $form->field($model, 'id_warehouse_source')->dropDownList(Warehouse::WarehouseList(true));
			?>
		</div>
		<div class="col-lg-4" >
			<?php
			echo Html::getAttributeValue($model, 'idWarehouseDest[nm_whse]');
			//echo $form->field($model,'id_warehouse_dest')->dropDownList(Warehouse::WarehouseList());
			?>
		</div>
	</div>
	<div style="display: block">
		<div class="col-lg-4">
			<?php
			echo Html::getAttributeValue($model, 'transfer_date');
//			echo $form->field($model, 'transfer_date', [
//						'template' => "{label}<br>{input}\n<span class='info'></span>\n{hint}\n{error}"
//					])
//					->widget('yii\jui\DatePicker', [
//						'options' => ['class' => 'form-control', 'style' => 'width:35%'],
//						'clientOptions' => [
//							'dateFormat' => 'yy-mm-dd'
//						],
//			]);
			?>
		</div>
		<div class="col-lg-4">
			<?php
			echo $form->field($model, 'id_status', [
				'template' => "{label}{input}<br><span class='btn btn-primary'>Release</span>\n{hint}\n{error}"
			])->input('hidden', ['value' => 1]);
			?>
		</div>
	</div>
	<?= $this->render('_detail_receive', ['model' => $model, 'detailProvider' => $detailProvider]) ?>
	<div class="col-lg-12">
		<div class="form-group">
			<?= Html::submitButton('Receive', ['class' => 'btn btn-success']) ?>
		</div>
	</div>
	<?php ActiveForm::end(); ?>

</div>
