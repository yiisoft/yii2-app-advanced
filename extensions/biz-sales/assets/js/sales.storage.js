yii.storage = (function($) {
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

    var local = {
        interval: 1000,
        id_cash_drawer: 0,
    }
    var pub = {
        setCashDrawer: function(id) {
            local.id_cash_drawer = id;
        },
        getCurrentSession: function(createNew) {
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
        removeSession: function(key) {
            var cKey = localStorage.getItem(CURRENT_SESSION_KEY);
            if(cKey == key){
                localStorage.removeItem(CURRENT_SESSION_KEY);
            }
            localStorage.removeItem(SESSION_KEY_PREFIX + key);
        },
        saveSession: function(data) {
            var key = pub.getCurrentSession(true);
            localStorage.setItem(SESSION_KEY_PREFIX + key, JSON.stringify(data));
        },
        changeSession: function(key) {
            if(key==undefined){
                localStorage.removeItem(CURRENT_SESSION_KEY);
                return [];
            }else{
                localStorage.setItem(CURRENT_SESSION_KEY, key);
                return pub.getSessionData(key);
            }            
        },
        getSessionData: function(key) {
            var data = localStorage.getItem(SESSION_KEY_PREFIX + key);
            if (data) {
                return JSON.parse(data);
            } else {
                return [];
            }
        },
        savePos: function(detail) {
            var key = pub.getCurrentSession(true);
            var data = {
                id_drawer: local.id_cash_drawer,
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
            return result.reverse();
        },
        push: function() {
            if (biz.config.pushUrl) {
                var keys = Object.keys(localStorage);
                $.each(keys, function() {
                    var key = this;
                    if (key != POS_DATA_COUNT_KEY && key.indexOf(POS_DATA_KEY_PREFIX) == 0) {
                        if (!runing()) {
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
            }
            setTimeout(function() {
                pub.push();
            }, local.interval);
        },
        init: function() {
            local.interval = biz.config.interval ? biz.config.interval : 1000;
            pub.push();
        }
    }
    return pub;
})(window.jQuery);