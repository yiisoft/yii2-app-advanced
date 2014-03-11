<?php

use backend\modules\sales\components\SalesAsset;
use yii\helpers\Html;

/**
 * @var \yii\web\View $this
 * @var string $content
 */
SalesAsset::register($this);

$manifest = empty($this->context->manifest) ? '' : $this->context->manifest;
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" <?= $manifest !== '' ? "manifestx=\"{$manifest}\"" : '' ?> >
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
		$cache = Yii::$app->cache;
		if ($manifest !== '' && $cache && $cache->get($manifest) === false) {
			try {
				$html = '<html>';
				foreach ($this->jsFiles as $jsFiles) {
					$html.="\n" . implode("\n", $jsFiles);
				}
				$html.="\n" . implode("\n", $this->cssFiles);

				$html.="\n</html>";

				$caches = [];
				$dom = new DOMDocument();
				$dom->loadHTML($html);
				foreach ($dom->getElementsByTagName('script') as $script) {
					$caches[] = $script->getAttribute('src');
				}
				foreach ($dom->getElementsByTagName('link') as $style) {
					$caches[] = $style->getAttribute('href');
				}
				$cache->set($manifest, $caches);
			} catch (Exception $exc) {
				
			}
		}
		?>
	</body>
</html>
<?php $this->endPage() ?>
