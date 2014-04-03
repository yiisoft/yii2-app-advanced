<?php

use yii\helpers\Html;
use yii\grid\GridView;
use backend\modules\inventory\models\TransferHdr;
use yii\data\ActiveDataProvider;
use yii\widgets\Pjax;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var backend\modules\purchase\models\PurchaseHdrSearch $searchModel
 */
$this->title = 'Transfer';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="purchase-hdr-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="pull-right">
        <?= Html::a('', ['create'], ['class' => 'btn btn-default glyphicon glyphicon-plus', 'title' => 'Create New', 'style' => 'width:100%;']) ?>
    </div>


    <?php Pjax::begin(['formSelector' => 'form', 'enablePushState' => false]); ?>
    <?php
    echo GridView::widget([
        'dataProvider' => $dataProvider,
        'tableOptions' => ['class' => 'table table-striped'],
        'layout' => '{items}{pager}',
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'transfer_num',
            'idWarehouseSource.nm_whse',
            'idWarehouseDest.nm_whse',
            'transfer_date',
            'nmStatus',
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update} {delete} {issue}',
                'buttons' => [
                    'update' => function ($url, $model) {
                        return $model->status == TransferHdr::STATUS_DRAFT ? Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, [
                            'title' => Yii::t('yii', 'Update'),
                            'data-pjax' => '0',
                        ]) : '';
                },
                    'delete' => function ($url, $model) {
                        return $model->status == TransferHdr::STATUS_DRAFT ? Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, [
                            'title' => Yii::t('yii', 'Delete'),
                            'data-confirm' => Yii::t('yii', 'Are you sure you want to delete this item?'),
                            'data-method' => 'post',
                            'data-pjax' => '0',
                        ]) : '';
                },
                    'issue' => function ($url, $model) {
                        return $model->status == TransferHdr::STATUS_DRAFT ? Html::a('<span class="glyphicon glyphicon-save"></span>', $url, [
                            'title' => Yii::t('yii', 'Issue'),
                            'data-confirm' => Yii::t('yii', 'Are you sure you want to issue this item?'),
                            'data-method' => 'post',
                            'data-pjax' => '0',
                        ]) : '';
                }
                ]
            ],
        ],
    ]);
    ?>
    <?php Pjax::end(); ?>
</div>
