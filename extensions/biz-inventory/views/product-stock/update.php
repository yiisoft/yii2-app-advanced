<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var biz\inventory\models\ProductStock $model
 */

$this->title = 'Update Product Stock: ' . $model->id_warehouse;
$this->params['breadcrumbs'][] = ['label' => 'Product Stocks', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_warehouse, 'url' => ['view', 'id_warehouse' => $model->id_warehouse, 'id_product' => $model->id_product]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="product-stock-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
