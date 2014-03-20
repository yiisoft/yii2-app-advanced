<?php

use yii\web\JsExpression;
use yii\jui\AutoComplete;
use yii\helpers\Html;
use yii\helpers\Json;
?>
<div class="col-lg-12">
	<div class="col-lg-9">
		<?php
		echo AutoComplete::widget([
			'name' => 'product',
			'id' => 'product',
			'clientOptions' => [
				'source' => new JsExpression('yii.Product.source'),
				'select' => new JsExpression('yii.Pos.onSelect'),
				'delay' => 500,
			]
		]);
		?>
		<table id="detail-grid" class="table table-striped">
			<thead style="display: none">
				<tr>
					<td style="width: 50px">
						<a data-action="delete" title="Delete" href="#"><span class="glyphicon glyphicon-trash"></span></a>
					</td>
					<td class="items">
						<ul class="nav nav-list">
							<input type="hidden" data-field="price"><input type="hidden" data-field="id_uom">
							<input type="hidden" data-field="id_product">
							<li><span class="item">
									<span class="nm_product"></span>
								</span></li>
							<li><span class="qty">
									Jumlah <input type="text" size="5" data-field="qty" value="1"> <span class="nm_uom"></span>
									@ Rp<span class="price"></span>
								</span></li>
							<li><span class="discon">
									Discon <input type="text" size="5" data-field="discon"> %
								</span></li>
						</ul>
					</td>
					<td class="total-price">
						<input type="hidden" data-field="total_price"><span class="total-price"></span>
					</td>
				</tr>
			</thead>
			<tfoot>
				<tr>
					<td colspan="2">&nbsp;</td>
					<td class="total-price">
						<input type="hidden" data-field="total_price"><span id="total-price"></span>
					</td>
				</tr>
			</tfoot>
			<tbody>
			</tbody>
		</table>
	</div>
	<div class="col-lg-3">
		<a id="new-session" href="#">New Session</a><br>
		<ul id="list-session" class="nav nav-list"></ul>
	</div>
</div>