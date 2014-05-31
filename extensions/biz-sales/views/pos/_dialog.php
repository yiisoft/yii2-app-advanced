<?php

use yii\bootstrap\Modal;
use yii\helpers\Html;
use biz\tools\Helper;
use biz\models\Cashdrawer;
use yii\grid\GridView;
use yii\data\ActiveDataProvider;
?>
<?php
Modal::begin([
    'id' => 'dlg-drawer',
    'closeButton' => null,
    'clientOptions' => [
        'backdrop' => 'static'
    ]
]);
?>
<div class="cash-drawer-form">
    <?php
    $query = Cashdrawer::find()->where([
        'client_machine' => Yii::$app->clientUniqueid,
        'id_user' => Yii::$app->user->id,
        'status' => Cashdrawer::STATUS_OPEN,
    ]);
    if ($query->count() > 0) {
        echo GridView::widget([
            'dataProvider' => new ActiveDataProvider(['query' => $query, 'sort' => false]),
            'columns' => [
                'idBranch.nm_branch',
                'cashier_no',
                'open_time',
                [
                    'class' => 'yii\grid\ActionColumn',
                    'template' => '{select-drawer}',
                    'buttons' => [
                        'select-drawer' => function ($url) {
                        return Html::a('<span class="glyphicon glyphicon-ok"></span>', $url, [
                                'class' => 'cashdrawer-select',
                        ]);
                    }
                    ]
                ]
            ],
            'layout' => '{items}'
        ]);
    }else{
    ?>
    <?= $form->field($model, 'id_branch')->dropDownList(Helper::getBranchList()) ?>
    <?= $form->field($model, 'cashier_no')->dropDownList([1 => 1, 2 => 2, 3 => 3, 4 => 4]) ?>
    <?= $form->field($model, 'init_cash') ?>
    <div class="form-group">
        <?= Html::a('Open New', '', ['class' => 'btn btn-success', 'id' => 'cashdrawer-opennew']); ?>
    </div>
    <?php } ?>
</div>
<?php Modal::end(); ?>