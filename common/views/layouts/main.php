<?php

use yii\web\View;
use yii\helpers\Html;
use common\assets\AppAsset;
use rmrevin\yii\fontawesome\AssetBundle;
use hail812\adminlte3\assets\AdminLteAsset;

/* @var $this View */
/* @var $content string */

AdminLteAsset::register($this);
AppAsset::register($this);
AssetBundle::register($this);

$assetDir = Yii::$app->assetManager->getPublishedUrl('@vendor/almasaeed2010/adminlte/dist');
?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">

<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <link rel="icon" href="<?= Yii::getAlias('@assets')?>/img/favicon/32x32.png" sizes="32x32" />
    <link rel="icon" href="<?= Yii::getAlias('@assets')?>/img/favicon/192x192.png" sizes="192x192" />
    <?php $this->head() ?>
</head>

<?
$body_class = Yii::$app->user->isGuest ? 'sidebar-collapse' : 'sidebar-mini';
$navbar = Yii::$app->user->isGuest ? 'navbar-guest' : 'navbar';
?>

<body class="hold-transition layout-navbar-fixed <?= $body_class?>">
<?php $this->beginBody() ?>

<div class="wrapper">
    <!-- Navbar -->
    <?= $this->render($navbar, ['assetDir' => $assetDir]) ?>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <? if (!Yii::$app->user->isGuest) echo $this->render('sidebar', ['assetDir' => $assetDir]);?>

    <!-- Content Wrapper. Contains page content -->
    <?= $content ?>
    <!-- /.content-wrapper -->

    <!-- Control Sidebar -->
    <?= $this->render('control-sidebar') ?>
    <!-- /.control-sidebar -->

    <!-- Main Footer -->
    <?= $this->render('footer') ?>
</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
