<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var biz\master\models\GlobalConfig $model
 */

$this->title = 'Update Global Config: ' . $model->config_group;
$this->params['breadcrumbs'][] = ['label' => 'Global Configs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->config_group, 'url' => ['view', 'config_group' => $model->config_group, 'config_name' => $model->config_name]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="global-config-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
