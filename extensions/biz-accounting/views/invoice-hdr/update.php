<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var biz\accounting\models\InvoiceHdr $model
 */

$this->title = 'Update Invoice Hdr: ' . $model->id_invoice;
$this->params['breadcrumbs'][] = ['label' => 'Invoice Hdrs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_invoice, 'url' => ['view', 'id' => $model->id_invoice]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="invoice-hdr-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
