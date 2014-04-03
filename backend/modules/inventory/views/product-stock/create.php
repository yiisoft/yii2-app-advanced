<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var backend\modules\inventory\models\ProductStock $model
 */

$this->title = 'Create Product Stock';
$this->params['breadcrumbs'][] = ['label' => 'Product Stocks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-stock-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
