<?php

use yii\helpers\Html;
use yii\grid\GridView;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var biz\models\CashdrawerSearch $searchModel
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
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'idBranch.nm_branch',
            'cashier_no',
            'idUser.username',
            'open_time',
            'nmStatus',
            'client_machine',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?= Yii::$app->clientId; ?>
</div>
