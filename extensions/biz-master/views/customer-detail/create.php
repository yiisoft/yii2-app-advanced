<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var biz\models\CustomerDetail $model
 */

$this->title = 'Create Customer Detail';
$this->params['breadcrumbs'][] = ['label' => 'Customer Details', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="customer-detail-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
