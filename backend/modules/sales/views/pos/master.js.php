<?php if (false): ?>
	<script type="text/javascript">
<?php endif; ?>
	yii.Product = (function($) {
		var options = {
			product: <?= json_encode($product); ?>,
			pushUrl: '<?= $url; ?>',
			delay: 1000,
			limit: 20,
		};
		var runing = false;
		var pub = {
			data: options.product,
			setOptions: function(value) {
				options = $.extend({}, options, value || {});
			},
			query: function(option) {
				var result = [];
				var limit = options.limit;
				$.each(options.product, function() {
					if (this.text.toLowerCase().indexOf(option.term.toLowerCase()) >= 0) {
						result.push(this);
						limit--;
						if (limit <= 0) {
							return false;
						}
					}
				});
				option.callback({results: result});
			},
			add: function(data) {
				var idata = localStorage.getItem('pos-data-count') * 1 + 1;
				localStorage.setItem('pos-data-' + idata, data);
				localStorage.setItem('pos-data-count', idata);
			},
			push: function() {
				var keys = Object.keys(localStorage);
				$.each(keys, function() {
					var key = this;
					if (key != 'pos-data-count' && key.indexOf('pos-data-') == 0) {
						if (!runing) {
							runing = true;
							$.ajax(options.pushUrl, {
								data: localStorage.getItem(key),
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
					pub.push();
				}, options.delay);
			},
			init: function() {
				pub.push();
			}
		}
		return pub;
	})(window.jQuery);
<?php if (false): ?>
	</script>
<?php endif; ?>