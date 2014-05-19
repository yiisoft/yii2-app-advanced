<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/**
 * @var yii\web\View $this
 * @var biz\models\GlobalConfig $model
 */

$this->title = $model->config_group;
$this->params['breadcrumbs'][] = ['label' => 'Global Configs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="global-config-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'config_group' => $model->config_group, 'config_name' => $model->config_name], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'config_group' => $model->config_group, 'config_name' => $model->config_name], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'config_group',
            'config_name',
            'config_value',
            'description',
        ],
    ]) ?>

</div>
