yii.global = (function($) {
    var enterPressed = false;
    var pub = {
        renderItem: function(ul, item) {
            var $a = $('<a>')
                .append($('<b>').text(item.text)).append('<br>')
                .append($('<i>').text(item.cd).css({color: '#999999'}));
            return $("<li>").append($a).appendTo(ul);
        },
        renderItemPos: function(ul, item) {
            var $a = $('<a>')
                .append($('<b>').text(item.text)).append('<br>')
                .append($('<i>').text(item.cd + ' - @ Rp' + item.price).css({color: '#999999'}));
            return $("<li>").append($a).appendTo(ul);
        },
        isChangeOrEnter: function($obj, sel, func) {
            $obj.on('change keydown', sel, function(e) {
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
                return func.apply(e.target);
            });
        },
        pullMaster: function(url, param) {
            var pullUrl = url ? url : biz.config.pullUrl;
            var data = param ? param : {};
            if (pullUrl) {
                $.getJSON(pullUrl, data, function(result) {
                    $.each(result, function(key, val) {
                        biz.master[key] = val;
                    });
                });
            }
        },
        log: function(data) {
            if (biz.debug) {
                console.log(data);
            }
        },
        sourceProduct: function(request, callback) {
            var result = [];
            var limit = biz.config.limit;
            var checkStock = biz.config.checkStock && biz.master.ps !== undefined;

            var term = request.term.toLowerCase();
            var whse = biz.config.whse;
            if (checkStock && (whse == undefined || biz.master.ps[whse] == undefined)) {
                callback([]);
                return;
            }

            $.each(biz.master.product, function() {
                var product = this;
                if (product.text.toLowerCase().indexOf(term) >= 0 || product.cd.toLowerCase().indexOf(term) >= 0) {
                    var id = product.id + '';
                    if (!checkStock || biz.master.ps[whse][id] > 0) {
                        result.push(product);
                        limit--;
                        if (limit <= 0) {
                            return false;
                        }
                    }
                }
            });
            callback(result);
        },
    }
    return pub;
})(window.jQuery);


