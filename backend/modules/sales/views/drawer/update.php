<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var backend\modules\sales\models\Cashdrawer $model
 */

$this->title = 'Update Cashdrawer: ' . $model->id_cashdrawer;
$this->params['breadcrumbs'][] = ['label' => 'Cashdrawers', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_cashdrawer, 'url' => ['view', 'id' => $model->id_cashdrawer]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="cashdrawer-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
