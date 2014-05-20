<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use biz\models\PurchaseHdr;

/**
 * @var yii\web\View $this
 * @var biz\models\PurchaseHdr $model
 */
$this->title = $model->purchase_num;
$this->params['breadcrumbs'][] = ['label' => 'Purchase', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<h1><?= Html::encode($this->title) ?></h1>


<div class="col-lg-3" style="padding-left: 0px;">
    <div class="panel panel-primary">
        <div class="panel-heading">
            Purchase Header
        </div>
        <?php
        echo DetailView::widget([
            'options' => ['class' => 'table table-striped detail-view', 'style' => 'padding:0px;'],
            'model' => $model,
            'attributes' => [
                'purchase_num',
                'idSupplier.nm_supplier',
                'purchaseDate',
                'nmStatus',
            ],
        ]);
        ?>
        <div class="panel-footer" style="text-align: right;">
            <?php
            if ($model->status == PurchaseHdr::STATUS_DRAFT) {
                echo Html::a('Update', ['update', 'id' => $model->id_purchase], ['class' => 'btn btn-primary']) . ' ';
                echo Html::a('Delete', ['delete', 'id' => $model->id_purchase], [
                    'class' => 'btn btn-danger',
                    'data-confirm' => Yii::t('app', 'Are you sure to delete this item?'),
                    'data-method' => 'post',
                ]) . ' ';
                echo Html::a('Receive', ['receive', 'id' => $model->id_purchase], [
                    'class' => 'btn btn-success',
                    'data-confirm' => Yii::t('app', 'Are you sure to receive this item?'),
                    'data-method' => 'post',
                ]);
            }
            ?>
        </div>
    </div>    
</div>
<div class="purchase-hdr-view col-lg-9">
    <?php
    echo yii\grid\GridView::widget([
        'tableOptions' => ['class' => 'table table-striped'],
        'layout' => '{items}',
        'dataProvider' => new \yii\data\ActiveDataProvider([
            'query' => $model->getPurchaseDtls(),
            'sort' => false,
            'pagination' => false,
            ]),
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'idWarehouse.nm_whse',
            'idProduct.nm_product',
            'purch_qty',
            'purch_price',
            'selling_price',
            'idUom.nm_uom',
        ]
    ]);
    ?>
</div>

