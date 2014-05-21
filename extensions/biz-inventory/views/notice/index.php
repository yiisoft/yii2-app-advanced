<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var biz\models\searchs\TransferNotice $searchModel
 */
$this->title = 'Transfer Notices';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="transfer-notice-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]);  ?>

    <?php Pjax::begin(['formSelector' => 'form', 'enablePushState' => false]); ?>

    <?php
    echo GridView::widget([
        'dataProvider' => $dataProvider,
        'tableOptions' => ['class' => 'table table-striped'],
        'layout' => '{items}{pager}',
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'idTransfer.transfer_num',
            'idTransfer.idWarehouseSource.nm_whse',
            'idTransfer.idWarehouseDest.nm_whse',
            'noticeDate',
            //'nmStatus',
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update}',
            ],
        ],
    ]);
    ?>
    <?php Pjax::end(); ?>


</div>
