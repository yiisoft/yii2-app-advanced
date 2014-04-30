<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/**
 * @var yii\web\View $this
 * @var biz\models\PriceCategory $model
 */

$this->title = $model->id_price_category;
$this->params['breadcrumbs'][] = ['label' => 'Price Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="price-category-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id_price_category], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id_price_category], [
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
            'id_price_category',
            'nm_price_category',
            'formula',
            'create_by',
            'update_date',
            'update_by',
            'create_date',
        ],
    ]) ?>

</div>
