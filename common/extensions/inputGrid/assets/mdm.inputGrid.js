(function($) {
	$.fn.mdmInputGrid = function(method, args) {
		if (typeof method === 'object' || !method) {
			return methods.init.apply(this, arguments);
		} else if (methods[method]) {
			return methods[method].apply(this, Array.prototype.slice.call(arguments, 1));
		} else {
			return $(this).yiiGridView(method, args);
		}
	};

	var defaults = {
		afterAddRow: undefined,
		templateRow:'<tr></tr>',
	};

	var methods = {
		init: function(options) {
			return this.each(function() {
				var $e = $(this);
				$e.yiiGridView(options);
				var settings = $.extend({}, defaults, options || {});
				$e.data('mdmInputGrid', {
					settings: settings
				});

				if ($e.find('tbody > tr[data-key]').length <= 1) {
					$e.find('a[data-action="delete"]').hide();
				}

				$($e.find('a[data-action]')).on('click.mdmInputGrid', function() {
					var $btn = $(this);
					if ($btn.data('action') == 'add') {
						$e.mdmInputGrid('newRow');
					} else {
						var index = $btn.closest('tr[data-key]').index();
						$e.mdmInputGrid('deleteRow', index);
					}
					return false;
				});

				if (settings.afterAddRow != undefined) {
					$e.find('tbody > tr[data-key]').each(function() {
						settings.afterAddRow.call($e, $(this));
					});
				}

			});
		},
		newRow: function() {
			return this.each(function() {
				var $grid = $(this);
				var data = $grid.mdmInputGrid('data');
				
				var $row = $(data.settings.templateRow.replace(/_index_/g, data.settings.counter)); //$grid.find('tbody tr').first().clone(true);
				$row.attr('data-key', '');
				$row.attr('data-index', data.settings.counter);
				
				data.settings.counter++;
				$grid.find('tbody').append($row);
				$grid.find('tbody a[data-action="delete"]').show();
				$grid.mdmInputGrid('rearrange');
				if (data.settings.afterAddRow != undefined) {
					data.settings.afterAddRow.call($grid, $row);
				}
			});
		},
		deleteRow: function(index) {
			return this.each(function() {
				var $grid = $(this);
				var $body = $grid.find('tbody');
				if ($body.children('tr[data-key]').length > 1) {
					$body.children('tr[data-key]').eq(index).remove();
					if ($body.children('tr[data-key]').length <= 1) {
						$body.find('a[data-action="delete"]').hide();
					}
				}
				$grid.mdmInputGrid('rearrange');
			});
		},
		rearrange: function() {
			return this.each(function() {
				var $grid = $(this);
				var col = $grid.find('thead > tr').children('th.serial').index();

				if (col != undefined) {
					var row = 1;
					$grid.find('tbody > tr[data-key]').each(function() {
						$(this).children('td').eq(col).text(row++);
					});
				}
			});
		},
		data: function() {
			return this.data('mdmInputGrid');
		}
	};
})(window.jQuery);

