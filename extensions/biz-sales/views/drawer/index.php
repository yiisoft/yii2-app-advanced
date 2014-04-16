<?php

use yii\helpers\Html;
use yii\grid\GridView;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var biz\sales\models\CashdrawerSearch $searchModel
 */

$this->title = 'Cashdrawers';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cashdrawer-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Cashdrawer', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id_cashdrawer',
            'client_machine',
            'id_branch',
            'cashier_no',
            'id_user',
            // 'init_cash',
            // 'close_cash',
            // 'variants',
            // 'status',
            // 'create_date',
            // 'create_by',
            // 'update_date',
            // 'update_by',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
