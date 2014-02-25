<?php

use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use yii\bootstrap\ButtonGroup;
use yii\bootstrap\Dropdown;

/**
 * @var \yii\web\View $this
 * @var string $content
 */
AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
	<head>
		<meta charset="<?= Yii::$app->charset ?>"/>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title><?= Html::encode($this->title) ?></title>
		<?php $this->head() ?>
	</head>
	<body>
		<?php $this->beginBody() ?>
		<div class="wrap">
			<?php
			NavBar::begin([
				'brandLabel' => 'My Company',
				'brandUrl' => Yii::$app->homeUrl,
				'options' => [
					'class' => 'navbar-inverse navbar-fixed-top',
				],
			]);
			$menuItems = [
				['label' => 'Home', 'url' => ['/site/index']],
			];
			if (Yii::$app->user->isGuest) {
				$menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
			} else {
				$menuItems[] = ['label' => 'Logout (' . Yii::$app->user->identity->username . ')', 'url' => ['/site/logout']];
			}
			$menuItems[] = ['label' => '<span class="glyphicon glyphicon-th"></span>',
				'items' => Dropdown::widget([
					'items' => [
						'<button id="cw3" class="btn"><span class="glyphicon glyphicon-align-justify"></span></button>
<button id="cw4" class="btn"><span class="glyphicon glyphicon-align-justify"></span></button>
<button id="cw5" class="btn"><span class="glyphicon glyphicon-align-justify"></span></button>
<button id="cw6" class="btn"><span class="glyphicon glyphicon-align-justify"></span></button>
<button id="cw7" class="btn"><span class="glyphicon glyphicon-align-justify"></span></button>
<button id="cw8" class="btn"><span class="glyphicon glyphicon-align-justify"></span></button>
<button id="cw9" class="btn"><span class="glyphicon glyphicon-align-justify"></span></button>
<button id="cw10" class="btn"><span class="glyphicon glyphicon-align-justify"></span></button>
<button id="cw11" class="btn"><span class="glyphicon glyphicon-align-justify"></span></button>
<button id="cw12" class="btn"><span class="glyphicon glyphicon-align-justify"></span></button>',
					],
					'encodeLabels' => true,
					'clientOptions' => false,
					'options' => ['style' => 'right: -60px;min-width: 200px;'],
					'view' => $this,
				])
			];
			echo Nav::widget([
				'options' => ['class' => 'navbar-nav navbar-right'],
				'encodeLabels' => false,
				'items' => $menuItems,
			]);
			echo Nav::widget([
				'options' => ['class' => 'navbar-nav navbar-left'],
				'items' => [
					['label' => 'm1'],
					['label' => 'm2'],
					['label' => 'm3'],
				]
			]);
			NavBar::end();
			?>

			<div class="container">
				<?=
				Breadcrumbs::widget([
					'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
				])
				?>
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
