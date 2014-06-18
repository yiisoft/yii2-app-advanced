<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use biz\models\Cashdrawer;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model biz\models\Cashdrawer */
/* @var $form yii\widgets\ActiveForm */

$this->title = $model->idUser->username . ' : Cashier ' . $model->cashier_no;
$this->params['breadcrumbs'][] = ['label' => 'Cashdrawers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$isOpen = $model->status == Cashdrawer::STATUS_OPEN;
?>
<div class="cashdrawer-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php
    $form = ActiveForm::begin([
            'action' => ['close','id'=>$model->id_cashdrawer]
        ])
    ?>
    <?=
    DetailView::widget([
        'model' => $model,
        'attributes' => [
            'idBranch.nm_branch',
            'cashier_no',
            'idUser.username',
            'nmStatus',
            'open_time',
            [
                'attribute' => 'close_cash',
                'value' => $isOpen ? $form->field($model, 'close_cash', [
                    'template'=>'{input}'
                ]) : $model->close_cash,
                'format' => $isOpen ? 'raw' : 'number',
            ]
        ],
    ]);
    ?>
    <p>
        <?php
        if ($isOpen) {
            echo Html::submitButton('Close', ['class' => 'btn btn-danger']);
        }
        ?>
    </p>
    <?php ActiveForm::end() ?>

<?= $this->render('_detail', ['id_drawer' => $model->id_cashdrawer]) ?>

</div>
