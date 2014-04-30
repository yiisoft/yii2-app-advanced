<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var biz\models\Uom $model
 */

$this->title = 'Update Uom: ' . ' ' . $model->id_uom;
$this->params['breadcrumbs'][] = ['label' => 'Uoms', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_uom, 'url' => ['view', 'id' => $model->id_uom]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="uom-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
