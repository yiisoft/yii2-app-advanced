<?php if (false): ?>
	<script type="text/javascript">
<?php endif; ?>
	yii.Product = (function($) {
		var options = {
			product: <?= json_encode($product); ?>,
			pushUrl: '<?= $url; ?>',
			delay: 1000,
			limit: 20,
			templateRow: undefined,
		};
		var runing = false;
		var pub = {
			data: options.product,
			getOptions: function() {
				return options;
			},
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
			source: function(request, callback) {
				var result = [];
				var limit = options.limit;
				var term = request.term.toLowerCase();
				$.each(options.product, function() {
					if (this.text.toLowerCase().indexOf(term) >= 0 || this.cd == term) {
						result.push(this);
						limit--;
						if (limit <= 0) {
							return false;
						}
					}
				});
				callback(result);
			},
			searchByCode: function(cd) {
				var result = false;
				$.each(options.product, function() {
					if (this.cd == cd) {
						result = this;
						return false;
					}
				});
				return result;
			},
			add: function(data) {
				//var idata = localStorage.getItem('pos-data-count') * 1 + 1;
				var date = new Date();
				localStorage.setItem('pos-data-' + date.getTime(), data);
				//localStorage.setItem('pos-data-count', idata);
			},
			push: function() {
				var keys = Object.keys(localStorage);
				$.each(keys, function() {
					var key = this;
					if (key != 'pos-data-count' && key.indexOf('pos-data-') == 0) {
						if (!runing) {
							runing = true;
							var data = JSON.parse(localStorage.getItem(key));
							$.ajax(options.pushUrl, {
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