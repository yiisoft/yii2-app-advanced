<style>
<?php $this->beginBlock('CSS') ?>
	#detail-grid td.items .qty > div{
		display:none;
		padding-left: 20px;
	}
	#detail-grid td.items .discon > div{
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
	#detail-grid input:focus{
		
	}
	#detail-grid li:not(:first-child){
		color:#A0A0A0;
	}
	.ui-autocomplete {
		max-height: 200px;
		overflow-y: auto;
		/* prevent horizontal scrollbar */
		overflow-x: hidden;
	}
<?php $this->endBlock(); ?>
</style>
<script type="text/javascript">
<?php $this->beginBlock('JS_END') ?>
	yii.Pos = (function($) {
		var $grid, $form, $template;

		var pub = {
			addItem: function(item) {
				var has = false;
				$('#detail-grid > tbody > tr:not(:first)').each(function() {
					var $row = $(this);
					if ($row.find('input[data-field="id_product"]').val() == item.id) {
						has = true;
						var $qty = $row.find('input[data-field="qty"]');
						if ($qty.val() == '') {
							$qty.val('2');
						} else {
							$qty.val($qty.val() * 1 + 1);
						}
						return false;
					}
				});
				if (!has) {
					var $row = $template.clone();
					$row.show();
					$row.find('.items span.nm_product').text(item.text);
					$row.find('input[data-field="id_product"]').val(item.id);
					$row.find('.items span.price').text(item.price);

					var uom = false;
					for (var i in item.uoms) {
						uom = item.uoms[i];
						break;
					}
					if (uom) {
						$row.find('.items span.nm_uom').text(uom.nm);
					}
					$grid.find('tbody > tr').removeClass('selected');
					$row.addClass('selected');
					$grid.children('tbody').append($row);
					$grid.find('input').numericInput({allowFloat: true});
				}
				pub.normalizeItem();
			},
			onSelect: function(event, ui) {
				pub.addItem(ui.item);
			},
			onSearch: function(e, ui) {
				//console.log(e.target.value);
			},
			normalizeItem: function() {
				var total = 0.0;
				$('#detail-grid > tbody > tr:not(:first)').each(function() {
					var $row = $(this);
					var q, d;
					if ($row.find('input[data-field="qty"]').val() == '') {
						$row.find('span.qty > div').hide();
						q = 1;
					} else {
						$row.find('span.qty > div').show();
						q = $row.find('input[data-field="qty"]').val();
					}

					if ($row.find('input[data-field="discon"]').val() == '') {
						$row.find('span.discon > div').hide();
						d = 0;
					} else {
						$row.find('span.discon > div').show();
						d = $row.find('input[data-field="discon"]').val();
					}

					var t = (1 - 0.01 * d) * q * $row.find('span.qty > div > span.price').text();
					$row.find('td.total-price > span.total-price').text(t);
					$row.find('input[data-field="price"]').val(t);
					total += t;
				});
				$('#total-price').text(total);
			},
			init: function() {
				$grid = $('#detail-grid');
				$form = $('#pos-form');
				$template = $('#detail-grid > tbody > tr:first');

				$grid.on('click', '[data-action="delete"]', function() {
					$(this).closest('tr').remove();
					return false;
				});

				$form.on('submit', function() {
					try {
						var data = {
							detail: [],
						};
						$('#detail-grid > tbody > tr:not(:first)').each(function() {
							var $row = $(this), detail = {};
							$row.find('input[data-field]').each(function() {
								var field = $(this).data('field');
								detail[field] = $(this).val();
							});
							data.detail.push(detail);
						});
						yii.Product.add(JSON.stringify(data));
						$('#detail-grid > tbody > tr:not(:first)').remove();
					} catch (e) {

					}
					return false;
				});

				$grid.on('click', 'tr', function() {
					$grid.find('tbody > tr').removeClass('selected');
					$(this).addClass('selected');
				});

				$(document).on('keydown', '', function(e) {
					var action = false;
					if ((e.shiftKey && e.keyCode == 56) || e.keyCode == 42) {
						action = '.qty';
					}
					if (e.keyCode == 189 || e.keyCode == 173) {
						action = '.discon';
					}
					if (action !== false) {
						var $elem = $(e.target);
						if ($elem.is(':input') && $elem.val() != '') {
							return;
						}
						var $row = $grid.find('tbody > tr.selected');
						if ($row.length == 1) {
							var $div = $row.find('span' + action + ' > div');
							$div.show();
							$div.children('input').focus().select();
							return false;
						}
					}
				});

				var enterPressed = false;
				$grid.on('change keydown', ':input', function(e) {
					if (e.type === 'keydown') {
						if (e.keyCode !== 13) {
							return; // only react to enter key
						} else {
							enterPressed = true;
						}
					} else {
						// prevent processing for both keydown and change events
						if (enterPressed) {
							enterPressed = false;
							return;
						}
					}
					$('#product').focus();
					pub.normalizeItem();
				});
			},
		};
		return pub;
	})(window.jQuery);
<?php $this->endBlock(); ?>

<?php $this->beginBlock('JS_READY') ?>
	$('#product').data("ui-autocomplete")._renderItem = function(ul, item) {
		var $a = $('<a>').append($('<b>').text(item.text))
				.append('<br>')
				.append($('<i>').text(item.cd + ' - @ Rp' + item.price).css({color: '#999999'}));
		return $("<li>").append($a).appendTo(ul);
	};

	$('#product').change(function() {
		var item = yii.Product.searchByCode(this.value);
		if (item !== false) {
			yii.Pos.addItem(item);
		}
		this.value = '';
		$(this).autocomplete("close")
	});
<?php $this->endBlock(); ?>
</script>
<?php
$this->registerJsFile(Yii::getAlias('@web/js/numericInput.min.js'), [yii\web\JqueryAsset::className()]);
$this->registerCss($this->blocks['CSS']);
$this->registerJs($this->blocks['JS_END'], yii\web\View::POS_END);
$this->registerJs($this->blocks['JS_READY'], yii\web\View::POS_READY);
