<?php

use yii\helpers\Html;
use common\extensions\inputGrid\Grid;
use yii\web\JsExpression;
use backend\modules\master\models\Product;


kartik\widgets\Select2Asset::register($this);
?>
<div class="col-lg-12">
	<?php
	$inpDropDownUom = function($model,$index,$column){
		$items = [];
		if($model->id_product){
			$items = Product::ListUoms($model->id_product);
		}
		return Html::activeDropDownList($model, "[$index]id_uom", $items,['data-attribute'=>'id_uom']);
	};
	
	echo Grid::widget([
		'dataProvider' => $detailProvider,
		'columns' => [
			['class' => 'common\extensions\inputGrid\SerialColumn'],
			['attribute' => 'idProduct.nm_product'],
			['attribute' => 'transfer_qty_send'],
			['class' => 'common\extensions\inputGrid\InputColumn',
				'attribute' => 'transfer_qty_receive',
				'inputOptions' => ['data-attribute' => 'transfer_qty_receive']],
			['attribute' => 'idUom.nm_uom'],
		],
	]);
	?>
</div>

