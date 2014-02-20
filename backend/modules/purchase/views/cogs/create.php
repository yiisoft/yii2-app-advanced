<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var backend\modules\purchase\models\Cogs $model
 */

$this->title = 'Create Cogs';
$this->params['breadcrumbs'][] = ['label' => 'Cogs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cogs-create">

	<h1><?= Html::encode($this->title) ?></h1>

	<?php echo $this->render('_form', [
		'model' => $model,
	]); ?>

</div>
