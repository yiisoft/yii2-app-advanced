<?php 
use yii\helpers\Url;
?>
<style>
<?php $this->beginBlock('CSS') ?>
	#detail-grid li.qty{
		/*		display:none;*/
		padding-left: 20px;
	}
	#detail-grid li.discon{
		display:none;
		padding-left: 20px;
	}
	#detail-grid > tbody > tr:hover > td{
		background-color:#E9E9F9;
	}
	#detail-grid > tbody > tr.selected > td{
		background-color:#E9E9E9;
	}
	#detail-grid input{
		border:none;
		background:inherit;
		color:inherit;
		text-align:right;
	}
	#detail-grid td.total-price{
		text-align:right;
	}
	#detail-grid tfoot .total-price{
		text-decoration:underline;
	}
	#detail-grid input:focus{
		
	}
	#detail-grid li:not(:first-child){
		color:#A0A0A0;
	}
	#detail-grid span[data-text="nm_product"]{
		font-size: larger;
		font-weight: bold;
	}
	.ui-autocomplete {
		max-height: 200px;
		overflow-y: auto;
		/* prevent horizontal scrollbar */
		overflow-x: hidden;
	}
	#list-session div a.session{
		color:black;
	}
	#list-session div.active  a.session{
		color:blue;
	}
<?php $this->endBlock(); ?>
</style>

<script type="text/javascript">
<?php $this->beginBlock('JS_END') ?>

<?php $this->endBlock(); ?>

<?php $this->beginBlock('JS_READY') ?>
	$('#product').data("ui-autocomplete")._renderItem = function(ul, item) {
		var $a = $('<a>').append($('<b>').text(item.text)).append('<br>')
				.append($('<i>').text(item.cd + ' - @ Rp' + item.price).css({color: '#999999'}));
		return $("<li>").append($a).appendTo(ul);
	};

	$('#product').change(yii.pos.onProductChange);
	$('#product').focus();

<?php $this->endBlock(); ?>
</script>
<?php
$this->registerJsFile(Yii::getAlias('@web/js/mdm.numeric.js'), [\yii\web\YiiAsset::className()]);
$this->registerJsFile(Yii::getAlias('@web/js/jquery.number.min.js'),[\yii\web\JqueryAsset::className()]);
$this->registerJsFile(Url::toRoute(['js']),[\yii\web\YiiAsset::className()]);

$this->registerCss($this->blocks['CSS']);
$this->registerJs($this->blocks['JS_READY'], yii\web\View::POS_READY);
