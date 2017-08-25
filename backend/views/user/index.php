<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index box box-primary ">
        
    <div class="box-header">
        <p>
            <?= Html::a('Create User', ['create'], ['class' => 'btn btn-success']) ?>
        </p>
    </div>
    <div class="box-body">



    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'id',
            'first_name',
            'last_name',
            'email',
            // 'created_at',
            // 'updated_at',

            ['class' => 'yii\grid\ActionColumn',
             'template' => '{view}&nbsp;&nbsp;{update}&nbsp;&nbsp;{permit}&nbsp;&nbsp;{delete}',
             'buttons' =>
                 [
                     'permit' => function ($url, $model) {
                         return Html::a('<span class="glyphicon glyphicon-wrench"></span>', Url::to(['/permit/user/view', 'id' => $model->id]), [
                             'title' => Yii::t('yii', 'Change user role')
                         ]); },
                 ]
            ],
        ],
    ]); ?>
    </div>
</div>
