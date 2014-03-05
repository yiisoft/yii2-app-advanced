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
<html lang="<?= Yii::$app->language ?>" manifestx="sales.appcache">
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

		<?php
		$s = '<html>';
		foreach ($this->jsFiles as $jsFiles) {
			$s.="\n" . implode("\n", $jsFiles);
		}
		$s.="\n" . implode("\n", $this->cssFiles);

		$s.="\n</html>";

		$caches = [];
		$dom = new DOMDocument();
		$dom->loadHTML($s);
		$scripts = $dom->getElementsByTagName('script');
		foreach ($scripts as $script) {
			$caches[] = $script->getAttribute('src');
		}
		$styles = $dom->getElementsByTagName('link');
		foreach ($styles as $style) {
			$caches[] = $style->getAttribute('href');
		}
		$manifest = $this->render('@backend/modules/sales/_manifest.php', ['caches' => $caches]);
		//echo $manifest;
		?>
	</body>
</html>
<?php $this->endPage() ?>
