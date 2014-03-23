<?php if (false): ?>
	<script type="text/javascript">
<?php endif; ?>
	yii.pos = (function($) {
		var $grid, $form, $template, runing = false, $list_session, $list_template;

		var product = <?= json_encode($product); ?>,
				delay = 1000,
				limit = 20;

		var storage = {
			pushUrl: '<?= \yii\helpers\Url::toRoute(['save-pos']) ?>',
			getCurrentSession: function() {
				var key = localStorage.getItem('session-current');
				if (key == undefined) {
					key = (new Date()).getTime();
					localStorage.setItem('session-current', key);
					localStorage.setItem('session-' + key, '[]');

					$list_session.children('div').removeClass('active');
					var $div = $list_template.clone();
					$div.children('.session').text(key);
					$list_session.append($div.addClass('active'));
				}
				return key;
			},
			changeSession: function(key) {
				var details = JSON.parse(localStorage.getItem('session-' + key));
				localStorage.setItem('session-current', key);
				$('#detail-grid > tbody > tr').remove();
				$.each(details, function() {
					var item = this;
					var $row = $template.clone();
					$row.find('span[data-text="nm_product"]').text(item.nm_product);
					$row.find('input[data-field="id_product"]').val(item.id_product);
					$row.find('span[data-text="price"]').text(local.format(item.price));
					$row.find('input[data-field="price"]').val(item.price);
					$row.find('input[data-field="qty"]').val(item.qty);
					$row.find('input[data-field="discon"]').val(item.discon);
					$row.find('input[data-field="id_uom"]').val(item.id_uom);
					$row.find('span[data-text="nm_uom"]').text(item.nm_uom);

					$grid.children('tbody').append($row);
				});
				$('#product').focus();
				local.normalizeItem();
			},
			newSession: function() {
				localStorage.removeItem('session-current');
				$('#detail-grid > tbody > tr').remove();
				$list_session.children('div').removeClass('active');
				$('#total-price').text(local.format(0));
				$('#product').focus();
			},
			listSession: function() {
				var current = localStorage.getItem('session-current');
				var keys = Object.keys(localStorage);
				$list_session.children('div').remove();
				$.each(keys, function() {
					var key = this;
					if (key != 'session-current' && key.indexOf('session-') == 0) {
						var $div = $list_template.clone();
						$div.children('.session').text(key.substr(8));
						if (key == 'session-' + current) {
							$div.addClass('active');
						}
						$list_session.append($div);
					}
				});
				return current;
			},
			saveSession: function(data) {
				var key = storage.getCurrentSession();
				localStorage.setItem('session-' + key, JSON.stringify(data));
				storage.listSession();
			},
			save: function() {
				var $rows = $('#detail-grid > tbody > tr');
				if ($rows.length == 0) {
					return false;
				}
				var data = {
					detail: [],
				};
				$rows.each(function() {
					var $row = $(this), detail = {};
					$row.find('input[data-field]').each(function() {
						var field = $(this).data('field');
						detail[field] = $(this).val();
					});
					data.detail.push(detail);
				});

				// -- save to queue and remove session
				var key = storage.getCurrentSession();
				data.key = key;
				var s = JSON.stringify(data);
				localStorage.setItem('pos-data-' + key, s);

				localStorage.removeItem('session-' + key);
				localStorage.removeItem('session-current');
				$('#list-session > div.active').remove();
				$('#detail-grid > tbody > tr').remove();
			},
			push: function() {
				var keys = Object.keys(localStorage);
				$.each(keys, function() {
					var key = this;
					if (key != 'pos-data-count' && key.indexOf('pos-data-') == 0) {
						if (!runing) {
							runing = true;
							var data = JSON.parse(localStorage.getItem(key));
							$.ajax(storage.pushUrl, {
								data: data,
								dataType: 'json',
								type: 'POST',
								success: function(r) {
									if (r.type == 'S') {
										localStorage.removeItem(key);
									}
									runing = false;
								},
								error: function() {
									runing = false;
								}
							});
						}
						return false;
					}
				});
				setTimeout(function() {
					storage.push();
				}, delay);
			},
			initEvent: function() {
				$('#new-session').click(function() {
					storage.newSession();
					return false;
				});

				$list_session.on('click', 'a', function() {
					var $this = $(this);
					if ($this.is('.session')) {
						if ($this.closest('div').hasClass('active')) {
							return false;
						}
						var key = $this.text();
						$('#list-session > div').removeClass('active');
						$this.closest('div').addClass('active');
						storage.changeSession(key);
					} else {
						var $div = $this.closest('div');
						var key = $div.children('.session').text();
						$div.remove();
						localStorage.removeItem('session-' + key);
						if (localStorage.getItem('session-current') == key) {
							localStorage.removeItem('session-current');
							$('#detail-grid > tbody > tr').remove();
							$('#product').focus();
						}
					}
					return false;
				});
			},
			init: function() {
				var current = storage.listSession();
				if (current) {
					storage.changeSession(current);
				}
				storage.initEvent();
				storage.push();
			},
		}

		var local = {
			addItem: function(item) {
				var has = false;
				$('#detail-grid > tbody > tr').each(function() {
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
					//$row.show();
					$row.find('span[data-text="nm_product"]').text(item.text);
					$row.find('input[data-field="id_product"]').val(item.id);
					$row.find('span[data-text="price"]').text(local.format(item.price));
					$row.find('input[data-field="price"]').val(item.price);
					$row.find('input[data-field="qty"]').val('1');
					$row.find('input[data-field="id_uom"]').val(item.id_uom);
					$row.find('span[data-text="nm_uom"]').text(item.nm_uom);

					local.selectRow($row)
					$grid.children('tbody').append($row);
				}
				local.normalizeItem();
			},
			selectRow: function($row, focus) {
				if ($row.is('.selected')) {
					return;
				}
				$grid.find('tbody > tr').removeClass('selected');
				$row.addClass('selected');
				if (focus) {
					$row.find('input[data-field="qty"]')
				}
			},
			setFocus: function(act) {
				var $row = $grid.find('tbody > tr.selected');
				if ($row.length == 1) {
					var $li = $row.find('li' + (act == 42 ? '.qty' : '.discon'));
					$li.show();
					$li.children('input').focus().select();
					return false;
				}
			},
			delActiveRow: function() {
				var $row = $grid.find('tbody > tr.selected');
				if ($row.length == 1) {
					$row.remove();
					local.normalizeItem();
					$('#product').focus();
					return false;
				}
			},
			format: function(n) {
				return $.number(n, 2);
			},
			normalizeItem: function() {
				var total = 0.0;
				var details = [];
				$('#detail-grid > tbody > tr').each(function() {
					var $row = $(this);
					var q = $row.find('input[data-field="qty"]').val(),
							d = $row.find('input[data-field="discon"]').val();
					q = q == '' ? 1 : q;

					if (d == '') {
						$row.find('li.discon').hide();
						d = 0;
					} else {
						$row.find('li.discon').show();
					}

					var t = (1 - 0.01 * d) * q * $row.find('input[data-field="price"]').val();
					$row.find('span[data-text="total_price"]').text(local.format(t));
					$row.find('input[data-field="total_price"]').val(t);
					total += t;

					// session
					var detail = {};
					$row.find('input[data-field]').each(function() {
						detail[$(this).data('field')] = this.value;
					});
					detail.nm_product = $row.find('span[data-text="nm_product"]').text();
					detail.nm_uom = $row.find('span[data-text="nm_uom"]').text();
					details.push(detail);
				});
				$('#total-price').text(local.format(total));
				storage.saveSession(details);
			},
			initObj: function() {
				$grid = $('#detail-grid');
				$form = $('#pos-form');
				$template = $('#detail-grid > thead > tr');
				$list_session = $('#list-session');
				$list_template = $('#list-template > div');
			},
			initEvent: function() {
				$grid.on('click', '[data-action="delete"]', function() {
					$(this).closest('tr').remove();
					local.normalizeItem();
					return false;
				});

				$grid.on('click', 'tr', function() {
					local.selectRow($(this), true);
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
					local.normalizeItem();
				});

				$grid.on('focus', 'input', function(e) {
					$(e.target).select();
					local.selectRow($(e.target).closest('tr'));
				});

				$form.on('submit', function() {
					storage.save();
					return false;
				});

				$(document).on('keypress', '', function(e) {
					var $elem = $(e.target);
					if ($elem.is(':input') && $elem.val() != '') {
						return;
					}
					var kode = e.which;
					switch (kode) {
						case 42:
						case 45:
							return local.setFocus(kode);
						default:
							
					}
				});

				$(document).on('keydown', '', function(e) {
					var n = $(e.target).is(':input') && e.target.value;
					
					var kode = e.which;
					switch (kode) {
						case 46:
							if(!n){
								return local.delActiveRow();
							}
						case 78:
							if(e.ctrlKey){
								storage.newSession();
								return false;
							}
						default:
							console.log(kode);
					}
				});

				yii.numeric.input($grid, 'input[data-field]', {
					allowFloat: true,
					allowNegative: false,
				});
			},
			init: function() {
				local.initObj();
				local.initEvent();
			}
		}

		var pub = {
			sourceProduct: function(request, callback) {
				var result = [];
				var c = limit;
				var term = request.term.toLowerCase();
				$.each(product, function() {
					if (this.text.toLowerCase().indexOf(term) >= 0 || this.cd == term) {
						result.push(this);
						c--;
						if (c <= 0) {
							return false;
						}
					}
				});
				callback(result);
			},
			searchProductByCode: function(cd) {
				var result = false;
				$.each(product, function() {
					if (this.cd == cd) {
						result = this;
						return false;
					}
				});
				return result;
			},
			onSelectProduct: function(event, ui) {
				local.addItem(ui.item);
			},
			onProductChange: function() {
				var item = pub.searchProductByCode(this.value);
				if (item !== false) {
					local.addItem(item);
				}
				this.value = '';
				$(this).autocomplete("close");
			},
			init: function() {
				local.init();
				storage.init();
			},
		};
		return pub;
	})(window.jQuery);
<?php if (false): ?>
	</script>
<?php endif; ?>