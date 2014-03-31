<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var backend\modules\master\models\Customer $model
 */

$this->title = 'Update Customer: ' . $model->id_customer;
$this->params['breadcrumbs'][] = ['label' => 'Customers', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_customer, 'url' => ['view', 'id' => $model->id_customer]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="customer-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
