<?php

use biz\tools\BizAsset;
use yii\web\View;
?>
<script type="text/javascript">
<?php $this->beginBlock('JS_END') ?>
    yii.master = (function($) {
        var pub = {
            product: <?= json_encode($product); ?>,
            barcodes: <?= json_encode($barcodes); ?>,
            supp:<?= json_encode($supp) ?>,
            ready: function() {
                $('#product').data("ui-autocomplete")._renderItem = function(ul, item) {
                    var $a = $('<a>').append($('<b>').text(item.text)).append('<br>')
                    //.append($('<i>').text(item.cd + ' - @ Rp' + item.price).css({color: '#999999'}));
                    return $("<li>").append($a).appendTo(ul);
                };

            }
        }
        return pub;
    })(window.jQuery);
<?php $this->endBlock(); ?>
</script>
<?php
$assets = BizAsset::register($this);
$this->registerJsFile($assets->baseUrl . '/js/inventory.transfer.js', [BizAsset::className()]);
$this->registerJs($this->blocks['JS_END'], View::POS_END);
$this->registerJs('yii.master.ready()');
