<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var biz\models\\EntriSheetDtl $model
 */

$this->title = 'Update Entri Sheet Dtl: ' . $model->id_esheet;
$this->params['breadcrumbs'][] = ['label' => 'Entri Sheet Dtls', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_esheet, 'url' => ['view', 'id_esheet' => $model->id_esheet, 'id_coa' => $model->id_coa]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="entri-sheet-dtl-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
