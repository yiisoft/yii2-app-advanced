<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var biz\models\TransferNotice $model
 */
$this->title = 'Update Transfer Notice: ' . ' ' . $model->idTransfer->transfer_num;
$this->params['breadcrumbs'][] = ['label' => 'Transfer Notices', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idTransfer->transfer_num, 'url' => ['view', 'id' => $model->id_transfer]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="transfer-notice-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?=
    $this->render('_form', [
        'model' => $model,
        'details' => $details,
    ])
    ?>

</div>
