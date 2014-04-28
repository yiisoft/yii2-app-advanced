<?php

use yii\helpers\Url;
?>
<style>
<?php $this->beginBlock('CSS') ?>
	select{
		-webkit-appearance: none;
		-moz-appearance: none;
		text-indent: 1px;
		text-overflow: '';
	}
	#detail-grid select{
		-webkit-appearance: none;
		-moz-appearance: none;
		text-indent: 1px;
		text-overflow: '';
		border:none;
		background:inherit;
	}
	
	#detail-grid select:focus{
		border:none;
		background:inherit;
	}
	
	#detail-grid > tbody > tr:hover > td{
		background-color:#E9E9F9;
	}
	#detail-grid > tbody > tr.selected > td{
		background-color:#E9E9E9;
	}
	#detail-grid tbody input{
		border:none;
		background:inherit;
		color:inherit;
		text-align:right;
	}
	#detail-grid tbody input:focus{
		border:initial;
		background:white;
	}
	#detail-grid td.total-price{
		text-align:right;
	}
	#detail-grid tfoot .total-price{
		text-decoration:underline;
	}
	#detail-grid li:not(:first-child){
		/*		color:#A0A0A0;*/
	}
	.ui-autocomplete {
		max-height: 200px;
		overflow-y: auto;
		/* prevent horizontal scrollbar */
		overflow-x: hidden;
	}
	#list-session li{
		
	}
	#list-session li.active{
		color:blue;
	}
<?php $this->endBlock(); ?>
</style>

<script type="text/javascript">
<?php $this->beginBlock('JS_END') ?>
<?php $this->endBlock(); ?>

<?php $this->beginBlock('JS_READY') ?>
	$('#product').data("ui-autocomplete")._renderItem = function(ul, item) {
		var $a = $('<a>').append($('<b>').text(item.text)).append('<br>');
		return $("<li>").append($a).appendTo(ul);
	};
	$('input[data-field="transfer_qty_receive"]').first().focus();

	$(window).keydown(function(event) {
		if (event.keyCode == 13) {
			event.preventDefault();
			return false;
		}
	});
	
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
