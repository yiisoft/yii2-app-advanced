<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var biz\accounting\models\AccPeriode $model
 */

$this->title = 'Create Acc Periode';
$this->params['breadcrumbs'][] = ['label' => 'Acc Periodes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="acc-periode-create">

	<h1><?= Html::encode($this->title) ?></h1>

	<?php echo $this->render('_form', [
		'model' => $model,
	]); ?>

</div>
