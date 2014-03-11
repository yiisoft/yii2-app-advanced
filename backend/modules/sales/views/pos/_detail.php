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
			query: yii.Product.query,
			minimumInputLength: 2,
			width: "resolve"
		}).on('select2-selecting.mdmInputGrid', function(e) {
			var uoms = e.object.uoms;
			var drUom = row.find('select[data-attribute="id_uom"]');
			drUom.html('');
			$.each(uoms,function(){
				var opt = $('<option></option>');
				opt.attr('value',this.id);
				opt.text(this.nm);
				drUom.append(opt);
			});
		});

		row.find('input[data-attribute="purch_price"]').on('change', function() {
			var $sell = row.find('input[data-attribute="selling_price"]');
			var $mark = row.find('input[data-attribute="markup_percen"]');
			$sell.val((1 + $mark.val() / 100.0) * $(this).val());
		});
	}
</script>
<div class="col-lg-12">
	<?php
	$inpDropDownUom = function($model, $index, $column) {
				$items = [];
				if ($model->id_product) {
					$items = Product::ListUoms($model->id_product);
				}
				return Html::activeDropDownList($model, "[$index]id_uom", $items, ['data-attribute' => 'id_uom']);
			};

	echo Grid::widget([
		'dataProvider' => $detailProvider,
		'columns' => [
			['class' => 'common\extensions\inputGrid\SerialColumn'],
			['class' => 'common\extensions\inputGrid\InputColumn',
				'attribute' => 'id_product',],
			['class' => 'common\extensions\inputGrid\InputColumn',
				'attribute' => 'sales_qty',],
			['class' => 'common\extensions\inputGrid\InputColumn',
				'attribute' => 'sales_price',],
			['class' => 'common\extensions\inputGrid\InputColumn',
				'inputType'=>'dropDownList',
				'attribute' => 'id_uom',],
			['class' => 'common\extensions\inputGrid\ActionColumn',],
		],
		'afterAddRow' => new JsExpression('afterAddRow'),
	]);
	?>
</div>

