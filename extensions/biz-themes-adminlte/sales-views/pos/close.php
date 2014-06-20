<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;
use biz\sales\components\DrawerAsset;
use biz\tools\BizDataAsset;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model biz\models\Cashdrawer */
/* @var $form yii\widgets\ActiveForm */

$this->title = $model->idUser->username . ' : Cashier ' . $model->cashier_no;
$this->params['breadcrumbs'][] = ['label' => 'Cashdrawers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cashdrawer-close">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php $form = ActiveForm::begin() ?>
    <?=
    DetailView::widget([
        'model' => $model,
        'attributes' => [
            'idBranch.nm_branch',
            'cashier_no',
            'idUser.username',
            'open_time',
            'init_cash:number:init cash',
            [
                'attribute' => 'close_cash',
                'value' => $form->field($model, 'close_cash', [
                    'template' => '{input}'
                ]),
                'format' => 'raw',
            ],
            [
                'label' => 'Variant',
                'value' => Html::tag('span', $model->variants,['id'=>'variant']),
                'format' => 'raw'
            ]
        ],
    ]);
    ?>
    <p>
        <?= Html::hiddenInput('',$model->init_cash,['id'=>'init-cash']) ?>
        <?= Html::hiddenInput('','',['id'=>'total-sales']) ?>
        <?=
        Html::submitButton('Close', ['class' => 'btn btn-danger',
            'disabled' => true, 'id' => 'btn-drawer-close']);
        ?>
    </p>
    <?php ActiveForm::end() ?>
    <div id="pending-post">
        <p>Pending:</p>
        <table id="list-pos" style="width: 100%">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Time</th>
                    <th>Jumlah Item</th>
                    <th>Total Item</th>
                    <th>Total Nilai</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>
</div>
<?php
$biz = [
    'id_drawer' => $model->id_cashdrawer,
    'config' => [
        'pushUrl' => Url::toRoute(['save-pos']),
        'delay' => 1000,
        'pushInterval' => 10000,
        'showInterval' => 10000,
        'totalCashDrawerUrl' => Url::toRoute(['total-cash'])
    ]
];
BizDataAsset::register($this, $biz);
DrawerAsset::register($this);
