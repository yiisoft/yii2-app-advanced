<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/**
 * @var yii\web\View $this
 * @var biz\models\Warehouse $model
 */

$this->title = $model->id_warehouse;
$this->params['breadcrumbs'][] = ['label' => 'Warehouses', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="warehouse-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id_warehouse], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id_warehouse], [
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
            'id_warehouse',
            'id_branch',
            'cd_whse',
            'nm_whse',
            'create_date',
            'create_by',
            'update_date',
            'update_by',
        ],
    ]) ?>

</div>
