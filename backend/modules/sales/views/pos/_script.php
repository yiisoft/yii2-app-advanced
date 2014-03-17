<style>
<?php $this->beginBlock('CSS') ?>
	#detail-grid td.items .qty{
		/*		display:none;*/
		padding-left: 20px;
	}
	#detail-grid td.items .discon{
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
	#list-session li.active{
		color:blue;
	}
<?php $this->endBlock(); ?>
</style>

<script type="text/javascript">
<?php $this->beginBlock('JS_END') ?>
	yii.numericInput = (function($) {
		function getCaret(element) {
			if (element.selectionStart)
				return element.selectionStart;

			else if (document.selection) { //IE specific
				element.focus();
				var r = document.selection.createRange();
				if (r == null)
					return 0;

				var re = element.createTextRange(), rc = re.duplicate();
				re.moveToBookmark(r.getBookmark());
				rc.setEndPoint('EndToStart', re);
				return rc.text.length;
			}

			return 0;
		}
		var allowFloat = true, allowNegative = false;
		
		var pub = {
			init: function() {
				$('#detail-grid').on('keypress', 'input', pub.keypress)
			},
			keypress: function(event) {
				var inputCode = event.which;
				var currentValue = $(this).val();

				if (inputCode > 0 && (inputCode < 48 || inputCode > 57)) {	// Checks the if the character code is not a digit
					if (allowFloat == true && inputCode == 46) {	// Conditions for a period (decimal point)
						//Disallows a period before a negative
						if (allowNegative == true && getCaret(this) == 0 && currentValue.charAt(0) == '-')
							return false;

						//Disallows more than one decimal point.
						if (currentValue.match(/[.]/))
							return false;
					}

					else if (allowNegative == true && inputCode == 45) {	// Conditions for a decimal point
						if (currentValue.charAt(0) == '-')
							return false;

						if (getCaret(this) != 0)
							return false;
					}

					else if (inputCode == 8) 	// Allows backspace
						return true;
					else								// Disallow non-numeric
						return false;
				}

				else if (inputCode > 0 && (inputCode >= 48 && inputCode <= 57)) {	// Disallows numbers before a negative.
					if (allowNegative == true && currentValue.charAt(0) == '-' && getCaret(this) == 0)
						return false;
				}
			}
		}
		return pub;
	})(window.jQuery);

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
					$row.find('input[data-field="price"]').val(item.price);
					$row.find('input[data-field="qty"]').val('1');
					$row.find('input[data-field="id_uom"]').val(item.id_uom);
					$row.find('.items span.nm_uom').text(item.nm_uom);

					$grid.find('tbody > tr').removeClass('selected');
					$row.addClass('selected');
					$grid.children('tbody').append($row);
					//$grid.find('input').numericInput({allowFloat: true});
				}
				pub.normalizeItem();
			},
			onSelect: function(event, ui) {
				pub.addItem(ui.item);
			},
			onSearch: function(e, ui) {
				//console.log(e.target.value);
			},
			getCurrentSession: function() {
				var key = localStorage.getItem('session-current');
				if (key == undefined) {
					key = (new Date()).getTime();
					localStorage.setItem('session-current', key);
					localStorage.setItem('session-' + key, '[]');
					$('#list-session > li').removeClass('active');
					$('#list-session').append($('<li>').text(key).addClass('active'));
				}
				return key;
			},
			normalizeItem: function() {
				var total = 0.0;
				var details = [];
				$('#detail-grid > tbody > tr:not(:first)').each(function() {
					var $row = $(this);
					var q, d;
					if ($row.find('input[data-field="qty"]').val() == '') {
						//$row.find('span.qty').hide();
						q = 1;
					} else {
						//$row.find('span.qty').show();
						q = $row.find('input[data-field="qty"]').val();
					}

					if ($row.find('input[data-field="discon"]').val() == '') {
						$row.find('span.discon').hide();
						d = 0;
					} else {
						$row.find('span.discon').show();
						d = $row.find('input[data-field="discon"]').val();
					}

					var t = (1 - 0.01 * d) * q * $row.find('span.qty > span.price').text();
					$row.find('td.total-price > span.total-price').text(t);
					$row.find('input[data-field="total_price"]').val(t);
					total += t;

					// session
					var detail = {};
					$row.find('input[data-field]').each(function() {
						detail[$(this).data('field')] = this.value;
					});
					detail.nm_product = $row.find('.items span.nm_product').text();
					detail.nm_uom = $row.find('.items span.nm_uom').text();
					details.push(detail);
				});
				$('#total-price').text(total);
				var key = pub.getCurrentSession();
				localStorage.setItem('session-' + key, JSON.stringify(details))
			},
			changeSession: function(key) {
				var details = JSON.parse(localStorage.getItem('session-' + key));
				localStorage.setItem('session-current', key);
				$('#detail-grid > tbody > tr:not(:first)').remove();
				$.each(details, function() {
					var item = this;
					var $row = $template.clone();
					$row.show();
					$row.find('.items span.nm_product').text(item.nm_product);
					$row.find('input[data-field="id_product"]').val(item.id_product);
					$row.find('.items span.price').text(item.price);
					$row.find('input[data-field="price"]').val(item.price);
					$row.find('input[data-field="qty"]').val(item.qty);
					$row.find('input[data-field="discon"]').val(item.discon);
					$row.find('input[data-field="id_uom"]').val(item.id_uom);
					$row.find('.items span.nm_uom').text(item.nm_uom);

					$grid.children('tbody').append($row);
					//$grid.find('input').numericInput({allowFloat: true});
				});
				pub.normalizeItem();
			},
			newSession: function() {
				localStorage.removeItem('session-current');
				$('#detail-grid > tbody > tr:not(:first)').remove();
				$('#product').focus();
			},
			initSession: function() {
				var current = pub.getCurrentSession();
				var keys = Object.keys(localStorage);
				$.each(keys, function() {
					var key = this;
					if (key != 'session-current' && key.indexOf('session-') == 0) {
						var $li = $('<li>').text(key.substr(8));
						if (key == 'session-' + current) {
							$li.addClass('active');
						}
						$('#list-session').append($li);
					}
				});
				pub.changeSession(current);
			},
			init: function() {
				$grid = $('#detail-grid');
				$form = $('#pos-form');
				$template = $('#detail-grid > tbody > tr:first');

				$grid.on('click', '[data-action="delete"]', function() {
					$(this).closest('tr').remove();
					return false;
				});

				$grid.on('click', 'tr', function() {
					$grid.find('tbody > tr').removeClass('selected');
					$(this).addClass('selected');
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

				$grid.on('focus', 'input', function(e) {
					$(e.target).select();
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
						var key = pub.getCurrentSession();
						localStorage.removeItem('session-' + key);
						localStorage.removeItem('session-current');
						$('#list-session > li.active').remove();
						$('#detail-grid > tbody > tr:not(:first)').remove();
					} catch (e) {

					}
					return false;
				});

				pub.initSession();
				$('#new-session').click(function() {
					pub.newSession();
					return false;
				});

				$('#list-session').on('click', 'li', function() {
					var $this = $(this);
					var key = $this.text();
					$('#list-session > li').removeClass('active');
					$this.addClass('active');
					pub.changeSession(key);
					return false;
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
							var $span= $row.find('span' + action);
							$span.show();
							$span.children('input').focus().select();
							return false;
						}
					}
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
		$(this).autocomplete("close");
	});
<?php $this->endBlock(); ?>
</script>
<?php
//$this->registerJsFile(Yii::getAlias('@web/js/numericInput.min.js'), [yii\web\JqueryAsset::className()]);
$this->registerCss($this->blocks['CSS']);
$this->registerJs($this->blocks['JS_END'], yii\web\View::POS_END);
$this->registerJs($this->blocks['JS_READY'], yii\web\View::POS_READY);
