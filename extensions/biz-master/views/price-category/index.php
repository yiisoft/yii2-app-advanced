<?php

use yii\helpers\Html;
use yii\grid\GridView;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var biz\master\models\PriceCategorySearch $searchModel
 */

$this->title = 'Price Categories';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="price-category-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <div class="pull-right">
        <?= Html::a('', ['create'], ['class' => 'btn btn-default glyphicon glyphicon-plus', 'title' => 'Create New', 'style' => 'width:100%;']) ?>
    </div>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'tableOptions' => ['class' => 'table table-striped'],
        'layout' => '{items}{pager}',
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id_price_category',
            'nm_price_category',
            'formula',
            'create_by',
            'update_date',
            // 'update_by',
            // 'create_date',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>