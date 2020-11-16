<?php

use yii\helpers\Url;
use hail812\adminlte3\widgets\Menu;
?>

<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?= Url::home()?>" class="brand-link">
        <img src="<?= Yii::getAlias('@assets')?>/img/logo/160x160.png" alt="Logo" class="brand-image"
             style="opacity: .8">
        <span class="brand-text font-weight-light">TradeMinerBot</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="<?=$assetDir?>/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">Alexander Pierce</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">

            <?php
            echo Menu::widget([
                'items' => [
                    ['label' => 'User Menu', 'header' => true],
                    ['label' => 'Exchange Accounts', 'icon' => 'id-card', 'url' => ['/exchange-account/index']],
                    ['label' => 'Algos', 'icon' => 'brain', 'url' => ['/algo/index']],
                    ['label' => 'Strategies', 'icon' => 'robot', 'url' => ['/strategy/index']],
                    ['label' => 'Dash Board', 'icon' => 'tachometer-alt', 'url' => ['/site/monitor']],

                    ['label' => 'Admin Menu', 'header' => true],
                    ['label' => 'Exchanges', 'icon' => 'sync', 'url' => ['/exchange/index']],
                    ['label' => 'Currency Pairs', 'icon' => 'coins', 'url' => ['/currency-pair/index']],

                    ['label' => 'Dev tools', 'header' => true],
                    ['label' => 'API Commands', 'icon' => 'terminal', 'url' => ['/api-command/index'],],
                    [
                        'label' => 'Logs',
                        'icon' => 'file',
                        'items' => [
                            ['label' => 'Errors', 'icon' => 'times', 'url' => ['/error-log/index']],
                            ['label' => 'Cron Logs', 'icon' => 'info', 'url' => ['/cron-log/index']],
                        ],
                    ],
                ],
            ]);
            ?>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
