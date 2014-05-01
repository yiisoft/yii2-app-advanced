<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/**
 * @var yii\web\View $this
 * @var biz\models\Cashdrawer $model
 */

$this->title = $model->id_cashdrawer;
$this->params['breadcrumbs'][] = ['label' => 'Cashdrawers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cashdrawer-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id_cashdrawer], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id_cashdrawer], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id_cashdrawer',
            'client_machine',
            'id_branch',
            'cashier_no',
            'id_user',
            'init_cash',
            'close_cash',
            'variants',
            'status',
            'create_date',
            'create_by',
            'update_date',
            'update_by',
        ],
    ]) ?>

</div>
