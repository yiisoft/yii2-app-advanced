<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/**
 * @var yii\web\View $this
 * @var backend\modules\accounting\models\Coa $model
 */

$this->title = $model->id_coa;
$this->params['breadcrumbs'][] = ['label' => 'Coas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="coa-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id_coa], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id_coa], [
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
            'id_coa',
            'id_coa_parent',
            'cd_account',
            'coa_type',
            'normal_balance',
            'create_date',
            'create_by',
            'update_date',
            'update_by',
        ],
    ]) ?>

</div>
