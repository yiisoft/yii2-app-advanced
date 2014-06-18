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
    <body class="bg-black">
        <div class="form-box" id="login-box">
            <div class="header"><h1><?= Html::encode($this->title) ?></h1></div>
            <?= $content ?>            
        </div>
    </div>
    </body>
    <?php $this->endBody() ?>
</html>
<?php $this->endPage() ?>
