<?php

use yii\web\JsExpression;
use yii\jui\AutoComplete;
?>
<div class="panel panel-default">
	<div class="panel-body pull-right">
		Product :
		<?php
		echo AutoComplete::widget([
			'name' => 'product',
			'id' => 'product',
			'clientOptions' => [
				'source' => new JsExpression('yii.pos.sourceProduct'),
				'select' => new JsExpression('yii.pos.onSelectProduct'),
				'delay' => 500
			]
		]);
		?>
		<input type="hidden" data-field="total_price"><span id="total-price"></span>
	</div>
	<table id="detail-grid" class="table table-striped" style="padding: 0px;">
		<thead style="display: none">
			<tr>
				<td style="width: 50px">
					<a data-action="delete" title="Delete" href="#"><span class="glyphicon glyphicon-trash"></span></a>
					<input type="hidden" data-field="price"><input type="hidden" data-field="id_uom">
					<input type="hidden" data-field="id_product">
				</td>
				<td>
					<ul class="nav nav-list">
						<li class="item">
							<span data-text="nm_product"></span>
						</li>
						<li class="qty">
							Jumlah <input type="text" size="5" data-field="qty" value="1"> <span data-text="nm_uom"></span>
							@ Rp<span data-text="price"></span>
						</li>
						<li class="discon">
							Discon <input type="text" size="5" data-field="discon"> %

						</li>
					</ul>
				</td>
				<td>
					<input type="hidden" data-field="total_price"><span data-text="total_price"></span>
				</td>
			</tr>
		</thead>
		<tbody>
		</tbody>
	</table>
</div>
