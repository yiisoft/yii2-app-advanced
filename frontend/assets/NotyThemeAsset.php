<?php

    namespace frontend\assets;

    use yii\web\AssetBundle;

    class NotyThemeAsset extends AssetBundle{

        public $sourcePath = '@webroot/js/noty';


        public $js = [
            'example.js',
        ];

        public $depends = [
            'lo\modules\noty\assets\NotyAsset',
        ];
    }
