<?php

use yii\helpers\Url;
?>

<script type="text/javascript">
<?php $this->beginBlock('JS_END') ?>
<?php $this->endBlock(); ?>

<?php $this->beginBlock('JS_READY') ?>
    $('#product').data("ui-autocomplete")._renderItem = function(ul, item) {
        var $a = $('<a>').append($('<b>').text(item.text)).append('<br>');
        return $("<li>").append($a).appendTo(ul);
    };

<?php $this->endBlock(); ?>
</script>
<?php
$this->registerJsFile(Yii::getAlias('@web/js/mdm.numeric.js'), [\yii\web\YiiAsset::className()]);
$this->registerJsFile(Yii::getAlias('@web/js/numeral.min.js'), [\yii\web\JqueryAsset::className()]);
$this->registerJsFile(Yii::getAlias('@web/js/jquery.number.js'), [\yii\web\JqueryAsset::className()]);
$this->registerJsFile(Url::toRoute(['js']), [\yii\web\YiiAsset::className()]);

$this->registerCss($this->blocks['CSS']);
//$this->registerJs($this->blocks['JS_END'], yii\web\View::POS_END);
$this->registerJs($this->blocks['JS_READY'], yii\web\View::POS_READY);
