<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var biz\purchase\models\PurchaseHdr $model
 */
$this->title = 'Create Transfer';
$this->params['breadcrumbs'][] = ['label' => 'Transfer', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="purchase-hdr-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php
    echo $this->render('_form', [
        'model' => $model,
        'details' => $details,
        'masters' => $masters
    ]);
    ?>

</div>
