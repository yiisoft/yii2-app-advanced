<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var biz\models\TransferNotice $model
 */

$this->title = 'Create Transfer Notice';
$this->params['breadcrumbs'][] = ['label' => 'Transfer Notices', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="transfer-notice-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
