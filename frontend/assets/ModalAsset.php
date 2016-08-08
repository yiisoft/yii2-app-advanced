<?php

    namespace frontend\assets;

    use yii\web\AssetBundle;

    class ModalAsset extends AssetBundle
    {
        public $basePath = '@webroot';
        public $baseUrl = '@web';

        public $css = [
            'modal/css/modal.css',
        ];

        public $js = [
            'modal/js/modal.js'
        ];

    }