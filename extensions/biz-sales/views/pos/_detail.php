<?php

use yii\web\JsExpression;
use yii\jui\AutoComplete;
?>
<div class="box box-info">
    <div class="box-header">
        <div class="form-group" style="padding: 15px;">
            <label for="product">Product :</label>
            <?php
            echo AutoComplete::widget([
                'name' => 'product',
                'id' => 'product',
                'clientOptions' => [
                    'source' => new JsExpression('yii.global.sourceProduct'),
                    'select' => new JsExpression('yii.pos.onSelectProduct'),
                    'delay' => 500
                ],
                'options' => ['class' => 'form-control'],
            ]);
            ?>
        </div>
        <div class="box-body" style="text-align: right; padding-top: 0px; padding-bottom: 0px;">        
            <input type="hidden" id="h-total-price"><h2>Rp<span id="total-price"></span></h2>
        </div>
    </div>
    <table id="detail-grid" class="table table-striped no-padding" style="padding: 0px;">
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
                <td class="total-price">
                    <input type="hidden" data-field="total_price"><span data-text="total_price"></span>
                </td>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>
