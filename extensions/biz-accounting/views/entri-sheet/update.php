<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var biz\models\EntriSheet $model
 */

$this->title = 'Update Entri Sheet: ' . $model->cd_esheet;
$this->params['breadcrumbs'][] = ['label' => 'Entri Sheets', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->cd_esheet, 'url' => ['view', 'id' => $model->id_esheet]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="entri-sheet-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
