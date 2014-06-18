yii.drawer = (function($) {
    var $bodyList;
    var local = {
        interval: 5000,
        lastModified:0,
        showPendingData: function() {
            $bodyList.children().remove();
            var no = 1;
            var list = yii.storage.getDataPos(true, biz.id_drawer);
            $.each(list, function() {
                var data = this;
                var $tr = $('<tr>');
                var d = new Date(data.key * 1);
                var i = 0, q = 0.0, t = 0.0;
                $.each(data.detail, function() {
                    var detail = this;
                    i++;
                    q += (detail.qty * 1);
                    t += (detail.qty * detail.price * (1 - detail.discon / 100));
                });
                $tr.append($('<td>').text(no++));
                $tr.append($('<td>').text(d.toLocaleTimeString()));
                $tr.append($('<td>').text(i));
                $tr.append($('<td>').text(q));
                $tr.append($('<td>').text(t));
                $tr.appendTo($bodyList);
            });
        },
        show: function() {
            var lastM = yii.storage.getLastModified();
            if (local.lastModified != lastM) {
                local.showPendingData();
                local.lastModified = lastM;
            }
            setTimeout(function() {
                local.show();
            }, local.interval);
        },
    }
    var pub = {
        init: function() {
            if(biz.config.showInterval){
                local.interval = biz.config.showInterval;
            }
            $bodyList = $('#list-pos > tbody');
            local.show();
        }
    }
    return pub;
})(window.jQuery);