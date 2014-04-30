<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/**
 * @var yii\web\View $this
 * @var biz\models\Uom $model
 */

$this->title = $model->id_uom;
$this->params['breadcrumbs'][] = ['label' => 'Uoms', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="uom-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id_uom], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id_uom], [
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
            'id_uom',
            'cd_uom',
            'nm_uom',
            'create_date',
            'create_by',
            'update_date',
            'update_by',
        ],
    ]) ?>

</div>
