<?php

use backend\modules\sales\components\SalesAsset;
use yii\helpers\Html;

/**
 * @var \yii\web\View $this
 * @var string $content
 */
SalesAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" manifest="sales.appcache">
	<head>
		<meta charset="<?= Yii::$app->charset ?>"/>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title><?= Html::encode($this->title) ?></title>
		<?php $this->head() ?>
	</head>
	<body>
		<?php $this->beginBody() ?>
		<div class="wrap">
			<div class="container">
				<?= $content ?>
			</div>
		</div>

		<footer class="footer">
			<div class="container">
				<p class="pull-left">&copy; My Company <?= date('Y') ?></p>
				<p class="pull-right"><?= Yii::powered() ?></p>
			</div>
		</footer>

		<?php $this->endBody() ?>
	</body>
</html>
<?php $this->endPage() ?>
