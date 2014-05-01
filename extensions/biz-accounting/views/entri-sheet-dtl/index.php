<?php

use yii\helpers\Html;
use yii\grid\GridView;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var biz\models\\EntriSheetDtlSearch $searchModel
 */
$this->title = 'Entri Sheet Dtls';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="entri-sheet-dtl-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php // echo $this->render('_search', ['model' => $searchModel]);  ?>

    <p>
        <?= Html::a('Create Entri Sheet Dtl', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'tableOptions' => ['class' => 'table table-striped'],
        'layout' => '{items}{pager}',
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id_esheet',
            'id_coa',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]);
    ?>

</div>
