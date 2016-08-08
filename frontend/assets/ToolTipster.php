<?php

namespace frontend\assets;

use yii\web\AssetBundle;

class ToolTipster extends AssetBundle{
    
    public $sourcePath = '@bower/tooltipster';


    public $css = [
        'css/tooltipster.css',
        'css/themes/tooltipster-shadow.css',
    ];

    public $js = [
        'js/jquery.tooltipster.min.js',
    ];

}
