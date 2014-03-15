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
				//'search' => new JsExpression('yii.Pos.onSearch'),
			]
		]);
		echo ord('-');
		?>
		<table id="detail-grid" class="table table-striped">
			<tbody>
				<tr style="display: none">
					<td style="width: 50px">
						<a data-action="delete" title="Delete" href="#"><span class="glyphicon glyphicon-trash"></span></a>
					</td>
					<td class="items">
						<ul class="nav nav-list">
							<li><span class="item">
									<input type="hidden" class="id_product">
									<span class="nm_product"></span>
								</span></li>
							<li><span class="qty">
									<div>
										Jumlah <input type="text" size="5" class="qty"> <span class="nm_uom"></span>
										@ Rp<span class="price"></span>
									</div>
								</span></li>
							<li><span class="discon">
									<div>
										Discon <input type="text" size="5" class="discon"> %
									</div>
								</span></li>
						</ul>
					</td>
					<td class="total-price">
						<span class="total-price"></span>
					</td>
				</tr>
			</tbody>
		</table>
	</div>
	<div class="col-lg-3">
		<span id="total-price"></span>
	</div>
</div>