<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
use biz\models\TransferNotice;
use yii\data\ActiveDataProvider;

/**
 * @var yii\web\View $this
 * @var TransferNotice $model
 */
$this->title = $model->idTransfer->transfer_num;
$this->params['breadcrumbs'][] = ['label' => 'Transfer Notices', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<h1><?= Html::encode($this->title) ?></h1>

<div class="purchase-hdr-view col-lg-9">
    <?php
    echo GridView::widget([
        'tableOptions' => ['class' => 'table table-striped'],
        'layout' => '{items}{pager}',
        'dataProvider' => new ActiveDataProvider([
            'query' => $model->getTransferNoticeDtls()->with('transferDtl'),
            'sort' => false,
            'pagination' => false,
            ]),
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'idProduct.nm_product',
            'transferDtl.transfer_qty_send:text:Qty Send',
            'transferDtl.transfer_qty_receive:text:Qty Receive',
            'qty_selisih',
            'qty_approve',
            'idUom.nm_uom',
        ]
    ]);
    ?>
</div>
<div class="col-lg-3" style="padding-left: 0px;">
    <div class="panel panel-primary">
        <div class="panel-heading">
            Notice Header
        </div>
        <?php
        echo DetailView::widget([
            'options' => ['class' => 'table table-striped detail-view', 'style' => 'padding:0px;'],
            'model' => $model,
            'attributes' => [
                'idTransfer.transfer_num',
                'idTransfer.idWarehouseSource.nm_whse',
                'idTransfer.idWarehouseDest.nm_whse',
                'noticeDate',
            ],
        ]);
        ?>
    </div>
    <?php
    if ($model->status == TransferNotice::STATUS_CREATE) {
        echo Html::a('Update', ['update', 'id' => $model->id_transfer], ['class' => 'btn btn-primary']) . ' ';
        echo Html::a('Delete', ['delete', 'id' => $model->id_transfer], [
            'class' => 'btn btn-danger',
            'data-confirm' => Yii::t('app', 'Are you sure to delete this item?'),
            'data-method' => 'post',
        ]);
    }
    ?>
</div>