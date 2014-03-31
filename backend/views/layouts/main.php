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
    $manifest = 'manifest="' . Yii::getAlias('@web/' . $this->manifest_file) . '"';
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
                    'linkOptions' => [
                        'data-user_id' => Yii::$app->user->id,
                        'data-method' => 'post']
                ];
            }

            if (!Yii::$app->user->isGuest) {
                $menuItems2 = [
                    [
                        'label' => 'Setup',
                        'url' => ['#'],
                        'items' => [
                            ['label' => 'User Management', 'url' => ['#'],],
                            ['label' => 'Auth & Autorization', 'url' => ['#'],],
                            '<li class="divider"></li>',
                            ['label' => 'Organization', 'url' => ['/master/orgn'],],
                            ['label' => 'Branch', 'url' => ['/master/branch'],],
                        ]
                    ],
                    [
                        'label' => 'Master',
                        'url' => ['#'],
                        'items' => [
                            ['label' => 'Product', 'url' => ['/master/product'],],
                            ['label' => 'Supplier', 'url' => ['/master/supplier/create'],],
                            ['label' => 'Customer', 'url' => ['/master/customer/create'],],
                            ['label' => 'Warehouse', 'url' => ['/master/warehouse/create'],]
                        ]
                    ], [
                        'label' => 'Purchasing',
                        'items' => [
                            ['label' => 'Entri Pembelian', 'url' => ['/purchase/purchase/create'],],
                            ['label' => 'Receive Pembelian', 'url' => ['/purchase/purchase/receive'],],
                            ['label' => 'Posting Pembelian', 'url' => ['/purchase/purchase/posting'],],
                            '<li class="divider"></li>',
                            ['label' => 'Pembelian Per Supplier', 'url' => ['#']],
                            ['label' => 'Pembelian Per Jatuh Tempo', 'url' => ['#']],
                            ['label' => 'Pembelian Per Nilai Faktur', 'url' => ['#']],
                        ]
                    ],
                    [
                        'label' => 'Inventory',
                        'items' => [
                            ['label' => 'Transfer Antar Gudang', 'url' => ['/inventory/transfer'],],
                            ['label' => 'Receive Transfer', 'url' => ['/inventory/receive'],],
                            '<li class="divider"></li>',
                            ['label' => 'Stock Opname', 'url' => ['#']],
                            ['label' => 'Stock Adjusment', 'url' => ['#']],
                            '<li class="divider"></li>',
                            ['label' => 'Stock Per Barang', 'url' => ['#']],
                            ['label' => 'Stock Per Group', 'url' => ['#']],
                            ['label' => 'Stock Per Category', 'url' => ['#']],
                            ['label' => 'Rekap Nilai Stok', 'url' => ['#']],
                        ]
                    ],
                    [
                        'label' => 'Sales',
                        'items' => [
                            ['label' => 'Sales Standart', 'url' => ['/sales/standart'],],
                            ['label' => 'Point of Sales', 'url' => ['/sales/pos/create'],],
                            ['label' => 'Posting Penjualan', 'url' => ['#']],
                            '<li class="divider"></li>',
                            ['label' => 'Sales Harian', 'url' => '#'],
                            ['label' => 'Sales Bulanan', 'url' => '#'],
                            ['label' => 'Sales Tahunan', 'url' => '#'],
                            ['label' => 'Sales Per Group', 'url' => '#'],
                            ['label' => 'Sales Per Category', 'url' => '#'],
                            '<li class="divider"></li>',
                            ['label' => 'Analisa Barang Laku', 'url' => '#'],
                        ]
                    ],
                    [
                        'label' => 'Accounting',
                        'items' => [
                            ['label' => 'COA', 'url' => ['#']],
                            ['label' => 'Entry Sheet', 'url' => ['#']],
                            '<li class="divider"></li>',
                            ['label' => 'Entri Journal', 'url' => '#'],
                            ['label' => 'Pembayaran Hutang', 'url' => '#'],
                            ['label' => 'Penerimaan Piutang', 'url' => '#'],
                            ['label' => 'Entri Biaya', 'url' => '#'],
                            ['label' => 'Setoran Bank', 'url' => '#'],
                            '<li class="divider"></li>',
                            ['label' => 'Journal Umum', 'url' => '#'],
                            ['label' => 'Buku Besar', 'url' => '#'],
                            ['label' => 'Neraca', 'url' => '#'],
                            ['label' => 'Laba/Rugi', 'url' => '#'],
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
