<?php

use yii\helpers\Html;
use yii\grid\GridView;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var biz\models\searchs\GlHeader $searchModel
 */
$this->title = 'Gl Headers';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="gl-header-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]);  ?>

    <p>
        <?= Html::a('Create Gl Header', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'glDate',
            'gl_num',
            'description',
            'create_by',
        // 'type_reff', 
        // 'id_reff',
        // 'id_gl'
        // 'create_date',
        // 'id_branch',
        // 'id_periode',
        // 'gl_memo',
        // 'status',
        // 'update_date',
        // 'update_by',
         ['class' => 'yii\grid\ActionColumn'],
        ],
    ]);
    ?>

</div>
