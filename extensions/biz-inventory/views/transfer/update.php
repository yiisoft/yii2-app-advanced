<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var biz\purchase\models\PurchaseHdr $model
 */
$this->title = 'Update Transfer: ' . $model->transfer_num;
$this->params['breadcrumbs'][] = ['label' => 'Transfer', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->transfer_num, 'url' => ['view', 'id' => $model->id_transfer]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="purchase-hdr-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php
    echo $this->render('_form', [
        'model' => $model,
        'details' => $details,
        'masters' => $masters,
    ]);
    ?>

</div>
