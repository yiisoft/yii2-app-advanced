<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use backend\modules\inventory\models\TransferHdr;

/**
 * @var yii\web\View $this
 * @var backend\modules\purchase\models\PurchaseHdr $model
 */
$this->title = $model->transfer_num;
$this->params['breadcrumbs'][] = ['label' => 'Receive', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="purchase-hdr-view">
    <h1><?= Html::encode($this->title) ?></h1>
    <p>
        <?php
        if ($model->status == TransferHdr::STATUS_ISSUE or $model->status == TransferHdr::STATUS_CONFIRM_REJECT) {
            echo Html::a('Update', ['update', 'id' => $model->id_transfer], ['class' => 'btn btn-primary']) . ' ';
        }
        if ($model->status == TransferHdr::STATUS_CONFIRM_APPROVE) {
            echo Html::a('Receive', ['receive-confirm', 'id' => $model->id_transfer], [
                'class' => 'btn btn-primary',
                'data-confirm' => Yii::t('app', 'Are you sure to receive this item?'),
                'data-method' => 'post',
            ]);
        }
        ?>
    </p>

    <?php
    echo DetailView::widget([
        'template'=>'<tr><th style="width:25%;">{label}</th><td>{value}</td></tr>',
        'model' => $model,
        'attributes' => [
            'transfer_num',
            'idWarehouseSource.nm_whse',
            'idWarehouseDest.nm_whse',
            'transfer_date',
            'nmStatus',
        ],
    ]);
    ?>
    <?php
    echo yii\grid\GridView::widget([
        'tableOptions' => ['class' => 'table table-striped'],
        'layout' => '{items}{pager}',
        'dataProvider' => new \yii\data\ActiveDataProvider([
            'query' => $model->getTransferDtls(),
            'sort' => false,
            'pagination' => false,
            ]),
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'idProduct.nm_product',
            'transfer_qty_send',
            'transfer_qty_receive',
            ['header' => 'Selisih', 'value' => function($model) {
                return $model->transfer_qty_receive - $model->transfer_qty_send;
            }],
            'idUom.nm_uom',
        ]
    ]);
    ?>
</div>
