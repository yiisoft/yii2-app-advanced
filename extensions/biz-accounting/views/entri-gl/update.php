<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var biz\models\GlHeader $model
 */

$this->title = 'Update Gl Header: ' . ' ' . $model->id_gl;
$this->params['breadcrumbs'][] = ['label' => 'Gl Headers', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_gl, 'url' => ['view', 'id' => $model->id_gl]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="gl-header-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
