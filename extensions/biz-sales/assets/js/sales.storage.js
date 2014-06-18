yii.storage = (function($) {
    var STAGE_KEY = 'push-running-stage';
    var CURRENT_SESSION_KEY = 'session-current';
    var SESSION_KEY_PREFIX = 'session-';
    var POS_DATA_KEY_PREFIX = 'pos-data-';
    var LAST_MODIFIED = 'last-modified';
    var CURRENT_DRAWER = 'current-drawer';
    var IDLE = 10000;

    function setRuning(val) {
        localStorage.setItem(STAGE_KEY, val ? (new Date()).getTime() : 0);
    }

    function isRunning() {
        var stage = localStorage.getItem(STAGE_KEY);
        return stage !== undefined && stage * 1 > ((new Date()).getTime() - IDLE);
    }

    var local = {
        interval: 1000,
        id_cash_drawer: 0,
    }
    var pub = {
        setCashDrawer: function(drawer) {
            local.id_cash_drawer = drawer.id_cashdrawer;
            localStorage.setItem(CURRENT_DRAWER, JSON.stringify(drawer));
        },
        getCurrentDrawer: function() {
            var s = localStorage.getItem(CURRENT_DRAWER);
            return s != undefined ? JSON.parse(s) : false;
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
            if (cKey == key) {
                localStorage.removeItem(CURRENT_SESSION_KEY);
            }
            localStorage.removeItem(SESSION_KEY_PREFIX + key);
        },
        saveSession: function(data) {
            var key = pub.getCurrentSession(true);
            localStorage.setItem(SESSION_KEY_PREFIX + key, JSON.stringify(data));
            localStorage.setItem(LAST_MODIFIED, (new Date()).getTime());
        },
        changeSession: function(key) {
            if (key == undefined) {
                localStorage.removeItem(CURRENT_SESSION_KEY);
                return [];
            } else {
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
            return result.sort();
        },
        getDataPos: function(all, drawer) {
            var keys = Object.keys(localStorage);
            keys = keys.sort();
            var result = [];
            $.each(keys, function() {
                var key = this;
                if (key.indexOf(POS_DATA_KEY_PREFIX) == 0) {
                    var data = JSON.parse(localStorage.getItem(key));
                    if (drawer == undefined || data.id_drawer + '' == drawer + '') {
                        result.push(data);
                    }
                    return all == true;
                }
            });
            if (all == true) {
                return result;
            } else {
                return result.shift();
            }
        },
        getLastModified: function() {
            return localStorage.getItem(LAST_MODIFIED);
        },
        push: function() {
            if (biz.config.pushUrl) {
                if (!isRunning()) {
                    var data = pub.getDataPos();
                    if (data) {
                        setRuning(true);
                        $.ajax(biz.config.pushUrl, {
                            data: data,
                            dataType: 'json',
                            type: 'POST',
                            success: function(r) {
                                if (r.type == 'S') {
                                    localStorage.removeItem(POS_DATA_KEY_PREFIX + data.key);
                                    localStorage.setItem(LAST_MODIFIED, (new Date()).getTime());
                                }
                                setRuning(false);
                            },
                            error: function() {
                                setRuning(false);
                            }
                        });
                    }
                }
            }
            setTimeout(function() {
                pub.push();
            }, local.interval);
        },
        init: function() {
            if (biz.config.pushInterval) {
                local.interval = biz.config.pushInterval;
            }
            pub.push();
        }
    }
    return pub;
})(window.jQuery);