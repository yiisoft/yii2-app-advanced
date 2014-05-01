<?php

use yii\helpers\Html;
use yii\grid\GridView;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var biz\models\ProductStockSearch $searchModel
 */
$this->title = 'Product Stocks';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-stock-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="col-lg-9">
        <?=
        GridView::widget([
            'tableOptions' => ['class' => 'table table-striped'],
            'layout' => '{items}{pager}',
            'dataProvider' => $dataProvider,
            //'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                'idWarehouse.nm_whse',
                'idProduct.nm_product',
                'qty_stock',
                'idUom.cd_uom',
            //'create_date',
            // 'create_by',
            // 'update_date',
            // 'update_by',
            //['class' => 'yii\grid\ActionColumn'],
            ],
        ]);
        ?>
    </div>
    <div class="col-lg-3">
        <div class="panel panel-primary">
            <div class="panel-heading">Firter Items</div>
            <div class="panel-body">
                <?php echo $this->render('_search', ['model' => $searchModel]); ?>
            </div>            
        </div>
    </div>   

</div>
