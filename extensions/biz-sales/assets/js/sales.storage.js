yii.storage = (function($) {
    var runing = false;
    var pub = {
        push: function() {
            var keys = Object.keys(localStorage);
            $.each(keys, function() {
                var key = this;
                if (key != 'pos-data-count' && key.indexOf('pos-data-') == 0) {
                    if (!runing) {
                        runing = true;
                        var data = JSON.parse(localStorage.getItem(key));
                        $.ajax(config.pushUrl, {
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
            }, config.delay);
        },
        init:function(){
            pub.push();
        }
    }
    return pub;
})(window.jQuery);