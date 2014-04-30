<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var biz\models\ProductSupplier $model
 */

$this->title = 'Create Product Supplier';
$this->params['breadcrumbs'][] = ['label' => 'Product Suppliers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-supplier-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
