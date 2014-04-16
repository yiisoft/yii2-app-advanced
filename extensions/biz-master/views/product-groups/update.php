<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var biz\master\models\ProductGroups $model
 */

$this->title = 'Update Product Groups: ' . $model->id_group;
$this->params['breadcrumbs'][] = ['label' => 'Product Groups', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_group, 'url' => ['view', 'id' => $model->id_group]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="product-groups-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
