<?php

use biz\purchase\assets\PurchaseAsset;
use yii\web\View;

PurchaseAsset::register($this);
$js_begin = 'var master = '.  json_encode($masters);
$js_ready = '$("#product").data("ui-autocomplete")._renderItem = yii.global.renderItem';
$this->registerJs($js_begin, View::POS_BEGIN);
$this->registerJs($js_ready);
