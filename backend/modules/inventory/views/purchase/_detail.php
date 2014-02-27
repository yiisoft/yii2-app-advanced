<?php

use yii\helpers\Html;
use common\extensions\inputGrid\Grid;
use yii\web\JsExpression;
use backend\modules\master\models\Product;


kartik\widgets\Select2Asset::register($this);
?>
<script>
	var afterAddRow = function(row) {
		row.find('input[data-attribute="id_product"]').select2({
			ajax: {
				url: '<?= Html::url(['product-of-supplier']) ?>',
				dataType: "json",
				data: function(term, page) {
					return {
						term: term,
						supp: $('#purchasehdr-id_supplier').val()
					};
				},
				results: function(data, page) {
					return {results: data};
				}
			},
			initSelection: function(element, callback) {
				var id = $(element).val();
				if (id !== "") {
					$.ajax('<?= Html::url(['/master/product/list']) ?>', {
						dataType: 'json',
						data: {id: id},
					}).done(function(data) {
						callback(data);
					});
				}
			},
			width: "resolve"
		}).on('change', function(e) {
			$.get('<?= Html::url(['uom-of-product']) ?>',
					{prod: e.val}, function(result) {
				row.find('td select[data-attribute="id_uom"]').html(result);
			});
		});
	}
</script>
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
			['class' => 'common\extensions\inputGrid\InputColumn',
				'attribute' => 'id_product',
				'inputOptions' => ['data-attribute' => 'id_product']],
			['class' => 'common\extensions\inputGrid\InputColumn',
				'attribute' => 'purch_qty',
				'inputOptions' => ['data-attribute' => 'purch_qty']],
			['class' => 'common\extensions\inputGrid\InputColumn',
				'attribute' => 'purch_price',
				'inputOptions' => ['data-attribute' => 'purch_price']],
			['class' => 'common\extensions\inputGrid\InputColumn',
				'attribute' => 'id_uom',
				'value' => $inpDropDownUom],
			['class' => 'common\extensions\inputGrid\ActionColumn']
		],
		'afterAddRow' => new JsExpression('afterAddRow'),
	]);
	?>
</div>

