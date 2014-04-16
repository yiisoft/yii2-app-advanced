<?php

use yii\helpers\Html;
use biz\inventory\models\TransferDtl;
use biz\master\models\Product;
?>
<div class="col-lg-9" style="padding-left: 0px;">
    <div class="panel panel-info">
        <table id="detail-grid" class="table table-striped">
			<?php

			function renderRow($model, $index)
			{
				ob_start();
				ob_implicit_flush(false);
				?>
				<tr>
					<td style="width: 50px">
						<?= $index + 1; ?>
						<?= Html::activeHiddenInput($model, "[$index]id_product", ['data-field' => 'id_product', 'id' => false]) ?>
						<?= Html::activeHiddenInput($model, "[$index]id_transfer_dtl", ['data-field' => 'id_transfer_dtl', 'id' => false]) ?>
					</td>
					<td class="items" style="width: 45%">
						<ul class="nav nav-list">
							<li><span class="cd_product"><?= Html::getAttributeValue($model, 'idProduct[cd_product]') ?></span> 
								- <span class="nm_product"><?= Html::getAttributeValue($model, 'idProduct[nm_product]') ?></span></li>
							<li>
								Jumlah <?=
								Html::activeTextInput($model, "[$index]transfer_qty_send", [
									'data-field' => 'transfer_qty_send',
									'size' => 5, 'id' => false,
									'readonly' => true, 'disabled' => true])
								?>
								<span > &nbsp; <?= Html::getAttributeValue($model, 'idUom[nm_uom]') ?></span>
								<?php Html::activeDropDownList($model, "[$index]id_uom", Product::ListUoms($model->id_product), ['data-field' => 'id_uom', 'id' => false]) ?>
							</li>
							<li>
							</li>
						</ul>
					</td>
					<td class="selling" style="width: 40%">
						<ul class="nav nav-list">
							<li>Receive</li>
							<li>
								Jumlah <?=
								Html::activeTextInput($model, "[$index]transfer_qty_receive", [
									'data-field' => 'transfer_qty_receive',
									'size' => 5, 'id' => false,
									'required' => true])
								?>
							</li>
							<li>
								Selisih <?php
								$selisih = $model->transfer_qty_receive - $model->transfer_qty_send;
								echo Html::textInput('', $selisih, [
									'data-field' => 'transfer_selisih',
									'size' => 5, 'id' => false,
									'readonly' => true, 'disabled' => true])
								?>
							</li>
						</ul>
					</td>
					<td class="total-price">
						<ul class="nav nav-list">
							<li>&nbsp;</li>
							<li>
								<input type="hidden" data-field="total_price">
							</li>
						</ul>
					</td>
				</tr>
				<?php
				return trim(preg_replace('/>\s+</', '><', ob_get_clean()));
			}
			?>
			<?php
			$rows = [];
			foreach ($details as $index => $model) {
				$rows[] = renderRow($model, $index);
			}
			echo Html::tag('tbody', implode("\n", $rows), ['data-template' => renderRow(new TransferDtl, '_index_')])
			?>
        </table>
    </div>
</div>
<?php
$this->render('_script');