<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/**
 * @var yii\web\View $this
 * @var biz\models\Price $model
 */

$this->title = $model->id_product;
$this->params['breadcrumbs'][] = ['label' => 'Prices', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="price-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id_product' => $model->id_product, 'id_price_category' => $model->id_price_category], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id_product' => $model->id_product, 'id_price_category' => $model->id_price_category], [
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
            'id_product',
            'id_price_category',
            'id_uom',
            'price',
            'create_date',
            'create_by',
            'update_date',
            'update_by',
        ],
    ]) ?>

</div>
