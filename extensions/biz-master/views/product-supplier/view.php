<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/**
 * @var yii\web\View $this
 * @var biz\models\ProductSupplier $model
 */

$this->title = $model->id_product;
$this->params['breadcrumbs'][] = ['label' => 'Product Suppliers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-supplier-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id_product' => $model->id_product, 'id_supplier' => $model->id_supplier], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id_product' => $model->id_product, 'id_supplier' => $model->id_supplier], [
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
            'id_supplier',
            'create_date',
            'create_by',
            'update_date',
            'update_by',
        ],
    ]) ?>

</div>
