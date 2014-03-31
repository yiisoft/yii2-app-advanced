<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var backend\modules\master\models\ProductUom $model
 */

$this->title = 'Update Product Uom: ' . $model->id_product;
$this->params['breadcrumbs'][] = ['label' => 'Product Uoms', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_product, 'url' => ['view', 'id_product' => $model->id_product, 'id_uom' => $model->id_uom]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="product-uom-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
