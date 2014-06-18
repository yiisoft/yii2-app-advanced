<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var biz\models\SalesHdr $model
 */
$this->title = 'Sales-Retail';
$this->params['breadcrumbs'][] = ['label' => 'Sales Hdrs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sales-hdr-create">   
    <?php
    echo $this->render('_form', [
        'payment_methods' => $payment_methods,
        'masters' => $masters
    ]);
    ?>

</div>
