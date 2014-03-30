<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var backend\modules\master\models\ProductGroups $model
 */

$this->title = 'Create Product Groups';
$this->params['breadcrumbs'][] = ['label' => 'Product Groups', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-groups-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
