<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use biz\models\Cashdrawer;

/* @var $this yii\web\View */
/* @var $model biz\models\Cashdrawer */

$this->title = $model->idUser->username . ' : Cashier ' . $model->cashier_no;
$this->params['breadcrumbs'][] = ['label' => 'Cashdrawers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$isOpen = $model->status == Cashdrawer::STATUS_OPEN;
?>
<div class="cashdrawer-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?=
    DetailView::widget([
        'model' => $model,
        'attributes' => [
            'idBranch.nm_branch',
            'cashier_no',
            'idUser.username',
            'open_time',
            'init_cash:number',
            'close_cash:number',
            'variant:number'
        ],
    ]);
    ?>

</div>
