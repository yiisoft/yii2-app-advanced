<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var backend\modules\accounting\models\Coa $model
 */

$this->title = 'Create Coa';
$this->params['breadcrumbs'][] = ['label' => 'Coas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="coa-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
