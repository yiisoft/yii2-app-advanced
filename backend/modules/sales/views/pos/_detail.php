<?php

use yii\helpers\Html;
use common\extensions\inputGrid\Grid;
use yii\web\JsExpression;
use backend\modules\master\models\Product;

kartik\widgets\Select2Asset::register($this);
?>
<script>
	var afterAddRow = function(row) {
		var $product = row.find('input[data-attribute="id_product"]');
		var $qty = row.find('input[data-attribute="sales_qty"]');
		var $price = row.find('input[data-attribute="sales_price"]');
		var $drUom = row.find('select[data-attribute="id_uom"]');
		$product.select2({
			query: yii.Product.query,
			minimumInputLength: 2,
			width: "resolve"
		}).on('select2-selecting.mdmInputGrid', function(e) {
			var uoms = e.object.uoms;
			$drUom.html('');
			$.each(uoms, function() {
				var opt = $('<option></option>');
				opt.attr('value', this.id);
				opt.data('price',e.object.price*this.isi);
				opt.text(this.nm);
				$drUom.append(opt);
			});
		}).change(function(){
			$drUom.change();
			$qty.focus();
		});
		
		$drUom.change(function(){
			$price.val($drUom.children(':selected').data('price'))
		});
	}
</script>
<div class="col-lg-12">
	<?php
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
				'inputType' => 'dropDownList',
				'attribute' => 'id_uom',],
			['class' => 'common\extensions\inputGrid\ActionColumn',],
		],
		'afterAddRow' => new JsExpression('afterAddRow'),
	]);
	?>
</div>

