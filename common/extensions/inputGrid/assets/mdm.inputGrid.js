(function($) {
	$.fn.mdmInputGrid = function(method) {
		if (typeof method === 'object' || !method) {
			return methods.init.apply(this, arguments);
		} else if (methods[method]) {
			return methods[method].apply(this, Array.prototype.slice.call(arguments, 1));
		} else {
			$.error('Method ' + method + ' does not exist on jQuery.mdmInputGrid');
			return false;
		}
	};

	var defaults = {
		afterAddRow: undefined,
		templateRow: '<tr></tr>',
	};

	var gridData = {};

	var methods = {
		init: function(options) {
			return this.each(function() {
				var $e = $(this);
				var settings = $.extend({}, defaults, options || {});
				gridData[$e.prop('id')] = {settings: settings};

				if ($e.find('tbody > tr[data-key]').length <= 1) {
					$e.find('a[data-action="delete"]').hide();
				}

				$e.on('click.mdmInputGrid','a[data-action]', function() {
					var $btn = $(this);
					if ($btn.data('action') == 'add') {
						methods.newRow.apply($e);
					} else {
						var index = $btn.closest('tr[data-key]').index();
						methods.deleteRow.call($e,index);
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
				var data = gridData[$grid.prop('id')];

				var $row = $(data.settings.templateRow.replace(/_index_/g, data.settings.counter));
				$row.attr('data-key', '');
				$row.attr('data-index', data.settings.counter);

				data.settings.counter++;
				$grid.find('tbody').append($row);
				$grid.find('tbody a[data-action="delete"]').show();
				methods.rearrange.apply($grid);
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
				methods.rearrange.apply($grid);
			});
		},
		rearrange: function() {
			return this.each(function() {
				var $grid = $(this);
				var row = 1;
				$grid.find('tbody > tr[data-key]').each(function() {
					$(this).find('td > span.serial-column').text(row++);
				});

			});
		},

		destroy: function () {
			return this.each(function () {
				$(window).unbind('.mdmInputGrid');
				$(this).removeData('mdmInputGrid');
			});
		},

		data: function () {
			var id = $(this).prop('id');
			return gridData[id];
		}
	};
})(window.jQuery);

