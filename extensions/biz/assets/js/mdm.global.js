yii.global = (function($) {
    var enterPressed = false;
    var pub = {
        renderItem: function(ul, item) {
            var $a = $('<a>').append($('<b>').text(item.text)).append('<br>');
            return $("<li>").append($a).appendTo(ul);
        },
        renderItemPos: function(ul, item) {
            var $a = $('<a>').append($('<b>').text(item.text)).append('<br>')
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
    }
    return pub;
})(window.jQuery);


