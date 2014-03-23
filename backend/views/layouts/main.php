<?php

use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\NavBar;
use yii\bootstrap\Nav;
use yii\widgets\Breadcrumbs;

/**
 * @var \yii\web\View $this
 * @var string $content
 */
AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<?php
if (isset($this->manifest_file)) {
    $manifest = "manifest=\"{$this->manifest_file}\"";
} else {
    $manifest = '';
}
?>
<html lang="<?= Yii::$app->language ?>" <?= $manifest ?>>
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
                'brandLabel' => 'SangkilBiz-3',
                'brandUrl' => Yii::$app->homeUrl,
                'options' => [
                    'class' => 'navbar-default navbar-fixed-top',
                ],
            ]);

            $menuItems = [
                ['label' => 'Home', 'url' => ['/site/index']],
            ];
            if (Yii::$app->user->isGuest) {
                $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
            } else {
                $menuItems[] = [
                    'label' => 'Logout (' . Yii::$app->user->identity->username . ')',
                    'url' => ['/site/logout'],
                    'linkOptions' => ['data-method' => 'post']
                ];
            }

            if (!Yii::$app->user->isGuest) {
                $menuItems2 = [
                    [
                        'label' => 'Setup',
                        'url' => ['#'],
                        'items' => [
                            ['label' => 'User Management',
                                'url' => ['#'],
                                'linkOptions' => ['data-method' => 'post']],
                            ['label' => 'Auth & Autorization',
                                'url' => ['#'],
                                'linkOptions' => ['data-method' => 'post']],
                            '<li class="divider"></li>',
                            ['label' => 'Organization Setup',
                                'url' => ['#'],
                                'linkOptions' => ['data-method' => 'post']],
                        ]
                    ],
                    [
                        'label' => 'Master',
                        'url' => ['#'],
                        'items' => [
                            ['label' => 'Product',
                                'url' => ['/master/product'],
                                'linkOptions' => ['data-method' => 'post']],
                            ['label' => 'Supplier',
                                'url' => ['/master/supplier'],
                                'linkOptions' => ['data-method' => 'post']],
                            ['label' => 'Customer',
                                'url' => ['/customer'],
                                'linkOptions' => ['data-method' => 'post']]
                        ]
                    ], [
                        'label' => 'Purchasing',
                        'url' => ['/purchase/purchase'],
                        'linkOptions' => ['data-method' => 'post']
                    ],
                    [
                        'label' => 'Inventory',
                        //'url' => ['/inventory'],
                        //'linkOptions' => ['data-method' => 'post'],
                        'items' => [
                            ['label' => 'Transfer',
                                'url' => ['/inventory/transfer'],
                                'linkOptions' => ['data-method' => 'post']],
                            ['label' => 'Receive',
                                'url' => ['/inventory/receive'],
                                'linkOptions' => ['data-method' => 'post']],
                            '<li class="divider"></li>',
                            ['label' => 'Stock Opname',
                                'url' => ['/inventory/opname'],
                                'linkOptions' => ['data-method' => 'post']]
                        ]
                    ],
                    [
                        'label' => 'Sales',
                        //'url' => ['/inventory'],
                        //'linkOptions' => ['data-method' => 'post'],
                        'items' => [
                            ['label' => 'Sales Standart',
                                'url' => ['/sales'],
                                'linkOptions' => ['data-method' => 'post']],
                            ['label' => 'Point of Sales',
                                'url' => ['/sales/pos'],
                                'linkOptions' => ['data-method' => 'post']]
                        ]
                    ],
                    [
                        'label' => 'Accounting',
                        //'url' => ['/inventory'],
                        //'linkOptions' => ['data-method' => 'post'],
                        'items' => [
                            ['label' => 'COA',
                                'url' => ['/coa'],
                                'linkOptions' => ['data-method' => 'post']],
                            ['label' => 'Entry Sheet',
                                'url' => ['/Entry'],
                                'linkOptions' => ['data-method' => 'post']],
                            ['label' => 'Entry Sheet',
                                'url' => ['/Entry'],
                                'linkOptions' => ['data-method' => 'post']],
                            '<li class="dropdown-header">Dropdown Header</li>',
                            ['label' => 'Level 1 - Dropdown B', 'url' => '#'],
                        ]
                    ]
                ];
                echo Nav::widget([
                    'options' => ['class' => 'navbar-nav navbar-left'],
                    'items' => $menuItems2,
                ]);
            }

            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-right'],
                'items' => $menuItems,
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
                <p class="pull-left">&copy; SangkilSoft.Corp <?= date('Y') ?></p>
                <p class="pull-right"><?= Yii::powered() ?></p>
            </div>
        </footer>

        <?php $this->endBody() ?>
    </body>
</html>
<?php
$this->endPage();
