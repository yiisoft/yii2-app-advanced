<?php

/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace backend\assets;
use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle {

    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
        'css/metro-bootstrap.css',
//        'docs/docs.css',
//        'docs/font-awesome.css'
        ];
    public $js = [
//        'docs/application.js',
//        'docs/bootstrap.js',
//        'docs/bootstrap.min.js',
//        'docs/bootstrap.min.js', 
//        'docs/jquery-1.8.0.js',
//        'docs/jquery.validate.js',
//        'docs/jquery.validate.unobtrusive.js',
//        'docs/jquery.unobtrusive-ajax.js',
//        'docs/metro-bootstrap/metro-docs.js'
        ];
    public $depends = [  
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];

}
