<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var biz\models\Uom $model
 */

$this->title = 'Create Uom';
$this->params['breadcrumbs'][] = ['label' => 'Uoms', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="uom-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
