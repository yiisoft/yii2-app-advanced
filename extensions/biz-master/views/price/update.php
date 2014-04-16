<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var biz\master\models\Price $model
 */

$this->title = 'Update Price: ' . $model->id_product;
$this->params['breadcrumbs'][] = ['label' => 'Prices', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_product, 'url' => ['view', 'id_product' => $model->id_product, 'id_price_category' => $model->id_price_category]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="price-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
