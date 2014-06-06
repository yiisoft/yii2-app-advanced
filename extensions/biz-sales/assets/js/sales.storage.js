yii.storage = (function($) {
    var interval;
    var STAGE_KEY = 'push-running-stage';
    var CURRENT_SESSION_KEY = 'session-current';
    var SESSION_KEY_PREFIX = 'session-';
    var POS_DATA_COUNT_KEY = 'pos-data-count';
    var POS_DATA_KEY_PREFIX = 'pos-data-';
    var IDLE = 10;
    var id_cash_drawer;

    function runing(val) {
        if (val === undefined) {
            var stage = localStorage.getItem(STAGE_KEY);
            var result = stage == undefined ? ['0', '0'] : stage.split(':');
            return result[0] == '1' && ((new Date()).getTime() - result[1] * 1) < IDLE;
        } else {
            localStorage.setItem(STAGE_KEY, (val ? '1:' : '0:') + (new Date()).getTime());
        }
    }
    var pub = {
        setCashDrawe:function(id){
            id_cash_drawer = id;
        },
        getCurrentSession: function(createNew){
            var key = localStorage.getItem(CURRENT_SESSION_KEY);
            if (key == undefined && createNew) {
                key = (new Date()).getTime();
                localStorage.setItem(CURRENT_SESSION_KEY, key);
                localStorage.setItem(SESSION_KEY_PREFIX + key, '[]');
            }
            return key;
        },
        removeCurrentSession: function() {
            localStorage.removeItem(CURRENT_SESSION_KEY);
        },
        removeSession:function (key){
            localStorage.removeItem(SESSION_KEY_PREFIX + key);
        },
        saveSession: function(data) {
            var key = storage.getCurrentSession(true);
            localStorage.setItem(SESSION_KEY_PREFIX + key, JSON.stringify(data));
        },
        changeSession: function(key) {
            localStorage.setItem(CURRENT_SESSION_KEY, key);
            return JSON.parse(localStorage.getItem(SESSION_KEY_PREFIX + key));
        },
        getSessionData: function(key) {
            return JSON.parse(localStorage.getItem(SESSION_KEY_PREFIX + key));
        },
        savePos: function(detail) {
            var key = pub.getCurrentSession(true);
            var data = {
                id_drawer: id_cash_drawer,
                key: key,
                detail: detail,
            }

            var s = JSON.stringify(data);
            localStorage.setItem(POS_DATA_KEY_PREFIX + key, s);
            localStorage.removeItem(SESSION_KEY_PREFIX + key);
            localStorage.removeItem(CURRENT_SESSION_KEY);
            return true;
        },
        listSession: function() {
            var keys = Object.keys(localStorage);
            var result = [];
            $.each(keys, function() {
                var key = this;
                if (key != CURRENT_SESSION_KEY && key.indexOf(SESSION_KEY_PREFIX) == 0) {
                    result.push(key.substr(8));
                }
            });
            return result;
        },
        push: function() {
            var keys = Object.keys(localStorage);
            $.each(keys, function() {
                var key = this;
                if (key != POS_DATA_COUNT_KEY && key.indexOf(POS_DATA_KEY_PREFIX) == 0) {
                    if (runing()) {
                        runing(true);
                        var data = JSON.parse(localStorage.getItem(key));
                        $.ajax(biz.config.pushUrl, {
                            data: data,
                            dataType: 'json',
                            type: 'POST',
                            success: function(r) {
                                if (r.type == 'S') {
                                    localStorage.removeItem(key);
                                }
                                runing(false);
                            },
                            error: function() {
                                runing(false);
                            }
                        });
                    }
                    return false;
                }
            });
            setTimeout(function() {
                pub.push();
            }, interval);
        },
        init: function() {
            interval = biz.config.interval ? biz.config.interval : 1000;
            pub.push();
        }
    }
    return pub;
})(window.jQuery);