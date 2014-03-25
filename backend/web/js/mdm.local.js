yii.local = (function($) {
	var rs = false;
	function running(r) {
		if (r === undefined) {
			return rs || localStorage.getItem('running-state') == '1';
		} else {
			rs = r;
			localStorage.setItem('running-state', r ? '1' : '0');
		}
	}
	
	var pub = {
		delay: 1000,
		pushUrl:false,
		pending: function() {
			var c = 0;
			var keys = Object.keys(localStorage);
			$.each(keys, function() {
				if (key.indexOf('pos-data-') == 0) {
					c++;
				}
			});
			return c;
		},
		push: function() {
			var keys = Object.keys(localStorage);
			$.each(keys, function() {
				var key = this;
				if (key.indexOf('pos-data-') == 0) {
					if (pub.pushUrl && !running()) {
						running(true);
						try {
							var data = JSON.parse(localStorage.getItem(key));
							$.ajax(pub.pushUrl, {
								data: data,
								dataType: 'json',
								type: 'POST',
								success: function(r) {
									if (r.type == 'S') {
										localStorage.removeItem(key);
									}
									running(false);
								},
								error: function() {
									running(false);
								}
							});
						} catch (exe) {
							
						}
					}
					return false;
				}
			});
			setTimeout(function() {
				pub.push();
			}, pub.delay);
		},
		init: function() {
			pub.push();
		},
	}
	return pub;
})(window.jQuery);