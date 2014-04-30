<?php

use yii\helpers\Html;
use yii\grid\GridView;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var biz\models\searchs\ProductGroup $searchModel
 */

$this->title = 'Product Groups';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-group-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Product Group', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id_group',
            'cd_group',
            'nm_group',
            'create_date',
            'create_by',
            // 'update_date',
            // 'update_by',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
