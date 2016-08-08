<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';

    public $css = [
        'https://fonts.googleapis.com/css?family=Exo+2:200,400,500,500italic,600,600italic,700,700italic,400italic,300,300italic&subset=latin,cyrillic',
        'css/site.css',
    ];
    public $js = [
        'js/tmpl.min.js',
        'js/jquery.textchange.min.js',
        'js/library.js',
        'js/global.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        //'frontend\assets\ModalAsset',
        //'frontend\assets\NotyThemeAsset',
        //'frontend\assets\ToolTipster',

    ];
}
