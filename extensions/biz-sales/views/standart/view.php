<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use biz\models\SalesHdr;

/**
 * @var yii\web\View $this
 * @var biz\models\SalesHdr $model
 */
$this->title = $model->sales_num;
$this->params['breadcrumbs'][] = ['label' => 'Sales', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<h2><?= Html::encode($this->title) ?></h2>
<div class="purchase-hdr-view col-lg-9">
    <?php
    echo yii\grid\GridView::widget([
        'tableOptions' => ['class' => 'table table-striped'],
        'layout' => '{items}',
        'dataProvider' => new \yii\data\ActiveDataProvider([
            'query' => $model->getSalesDtls(),
            'sort' => false,
            'pagination' => false,
            ]),
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'idProduct.nm_product',
            'sales_qty',
            'sales_price',
            'idUom.nm_uom',
        ]
    ]);
    ?>

</div>
<div class="col-lg-3" style="padding-left: 0px;">
    <div class="panel panel-primary">
        <div class="panel-heading">
            Sales Header
        </div>
        <?php
        echo DetailView::widget([
            'options' => ['class' => 'table table-striped detail-view', 'style' => 'padding:0px;'],
            'model' => $model,
            'attributes' => [
                'sales_num',
                'idCustomer.nm_cust',
                'idBranch.nm_branch',
                'sales_date',
                'nmStatus',
            ],
        ]);
        ?>
    </div>
    <?php
    if ($model->status == SalesHdr::STATUS_DRAFT) {
        echo Html::a('Update', ['update', 'id' => $model->id_sales], ['class' => 'btn btn-primary']) . ' ';
        echo Html::a('Delete', ['delete', 'id' => $model->id_sales], [
            'class' => 'btn btn-danger',
            'data-confirm' => Yii::t('app', 'Are you sure to delete this item?'),
            'data-method' => 'post',
        ]) . ' ';
        echo Html::a('Release', ['release', 'id' => $model->id_sales], [
            'class' => 'btn btn-success',
            'data-confirm' => Yii::t('app', 'Are you sure to release this item?'),
            'data-method' => 'post',
        ]);
    } elseif ($model->status == SalesHdr::STATUS_RELEASE) {
        echo Html::a('Posting', ['posting', 'id' => $model->id_sales], [
            'class' => 'btn btn-success',
            'data-confirm' => Yii::t('app', 'Are you sure to post this item?'),
            'data-method' => 'post',
        ]);
    }
    ?>
</div>
