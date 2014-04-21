<?php

use yii\web\JsExpression;
use yii\jui\AutoComplete;
use yii\helpers\Html;
use biz\sales\models\SalesDtl;
use biz\master\models\Product;
use app\tools\Helper;

?>
<div class="col-lg-9" style="padding-left: 0px;">
    <div class="panel panel-info">
        <div class="panel-heading">
            Product :
            <?php
            echo AutoComplete::widget([
                'name' => 'product',
                'id' => 'product',
                'clientOptions' => [
                    'source' => new JsExpression('yii.sales.sourceProduct'),
                    'select' => new JsExpression('yii.sales.onProductSelect'),
                    'delay' => 100,
                ]
            ]);
            ?>
        </div>
        <div class="panel-body" style="text-align: right;">
            <input type="hidden" data-field="total_price"><h2>Rp<span id="total-price"></h2></span>
        </div>
        <table id="detail-grid" class="table table-striped">
            <?php

            function renderRow($model, $index) {
                ob_start();
                ob_implicit_flush(false);
                ?>
                <tr>
                    <td style="width: 50px">
                        <a data-action="delete" title="Delete" href="#"><span class="glyphicon glyphicon-trash"></span></a>
                        <?= Html::activeHiddenInput($model, "[$index]id_product", ['data-field' => 'id_product', 'id' => false]) ?>
                        <?= Html::activeHiddenInput($model, "[$index]id_sales_dtl", ['data-field' => 'id_sales_dtl', 'id' => false]) ?>
                    </td>
                    <td class="items" style="width: 45%">
                        <ul class="nav nav-list">
                            <li><span class="cd_product"><?= Html::getAttributeValue($model, 'idProduct[cd_product]') ?></span> 
                                - <span class="nm_product"><?= Html::getAttributeValue($model, 'idProduct[nm_product]') ?></span></li>
                            <li>
                                Jumlah <?=
                                Html::activeTextInput($model, "[$index]sales_qty", [
                                    'data-field' => 'sales_qty',
                                    'size' => 5, 'id' => false,
                                    'required' => true])
                                ?>
                                <?= Html::activeDropDownList($model, "[$index]id_uom", Helper::ListProductUoms($model->id_product), ['data-field' => 'id_uom', 'id' => false]) ?>
                            </li>
                            <li>
								<?= Html::activeHiddenInput($model, "[$index]sales_price", ['data-field' => 'sales_price','id' => false]) ?>
                                Price Rp <span class="sales_price"><?= Html::getAttributeValue($model, 'sales_price') ?></span> 
                            </li>
                        </ul>
                    </td>
                    <td class="selling" style="width: 40%">
                        <ul class="nav nav-list">
                            <li>Discon</li>
                            <li>
                                <?php
                                $sales_price = $model->sales_price;
                                $discon = $model->discount;
                                $discon_percen = $sales_price > 0 ? 100 * $discon/ $sales_price : 0;
								$discon_percen = round($discon_percen, 2);
                                ?>
                                Percen <?=
                                Html::textInput('', $discon_percen, [
                                    'data-field' => 'discount_percen',
                                    'size' => 8, 'id' => false,
                                    'required' => false])
                                ?> %
                            </li>
                            <li>
                                Discon Rp <?=
                                Html::activeTextInput($model, "[$index]discount", [
                                    'data-field' => 'discount',
                                    'size' => 16, 'id' => false,
                                    'required' => false])
                                ?>
                            </li>
                        </ul>
                    </td>
                    <td class="total-price">
                        <ul class="nav nav-list">
                            <li>&nbsp;</li>
                            <li>
                                <input type="hidden" data-field="total_price"><span class="total-price"></span>
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
            echo Html::tag('tbody', implode("\n", $rows), ['data-template' => renderRow(new SalesDtl, '_index_')])
            ?>
        </table>
    </div>
</div>
<?php
$this->render('_script');