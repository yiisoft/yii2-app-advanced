<?php

use yii\helpers\Html;
use biz\adminlte\MyAsset;

/**
 * @var \yii\web\View $this
 * @var string $content
 */
$lte_asset = MyAsset::register($this);
$baseurl = $lte_asset->baseUrl;
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
    <body class="skin-blue">
        <header class="header">
            <?php echo $this->render('heading',['baseurl'=>$baseurl]); ?>
        </header>
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <aside class="left-side sidebar-offcanvas">
                <?php echo $this->render('sidebar',['baseurl'=>$baseurl]); ?>
            </aside>
            <aside class="right-side">
                <section class="content-header">
                    <h1>
                        Dashboard
                        <small>Control panel</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Dashboard</li>
                    </ol>
                </section>
                <section class="content">                    
                    <?= $content ?>
                </section>
            </aside>
        </div>

        <!--        <footer class="footer">
                    <div class="container">
                        <p class="pull-left">&copy; My Company <?= ''//date('Y')    ?></p>
                        <p class="pull-right"><?= ''//Yii::powered()    ?></p>
                    </div>
                </footer>-->
    </div>
    <?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
