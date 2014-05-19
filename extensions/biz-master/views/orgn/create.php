<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var biz\models\Orgn $model
 */

$this->title = 'Create Orgn';
$this->params['breadcrumbs'][] = ['label' => 'Orgns', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="orgn-create">

	<h1><?= Html::encode($this->title) ?></h1>

	<?php echo $this->render('_form', [
		'model' => $model,
	]); ?>

</div>
