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
    <div class="box box-danger">
        <div class="box-header">
            <h3 class="box-title">General Ledger</h3>
            <div class="pull-right" style="padding: 20px;" >
                <?= Html::a('', ['create'], ['class' => 'fa fa-plus', 'title' => 'New Product', 'style' => 'width:100%;']) ?>
            </div>
        </div>
        <div class="box-body no-padding">
            <?=
            GridView::widget([
                'dataProvider' => $dataProvider,
                'tableOptions' => ['class' => 'table table-striped'],
                'layout' => '{items}{pager}',
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
    </div>
</div>