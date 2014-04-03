<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var backend\modules\accounting\models\Coa $model
 */

$this->title = 'Update Coa: ' . $model->id_coa;
$this->params['breadcrumbs'][] = ['label' => 'Coas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_coa, 'url' => ['view', 'id' => $model->id_coa]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="coa-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
