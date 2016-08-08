var lib = (function(){

    var is_loading = false;
    var is_guest = null;
    var returnHash = '';
    var randov_val = false;
    var _isDebug = null;
    var _lang = null;

    var token_name = false;
    var token = false;
    var _task = false;
    var _item_id = false;
    var _user = false;
    var _cur_prod = false;
    var _uri_get = false;
    var _route = false;
    var _cur_filter = {'order':'date-down', 'city':false, 'category':false, 'user':false};
    var _prev_pageTitle = document.title;
    var _user_room = false;
    var _id_user_send = false;
    var _data_editing = true;


    return {
        init:function(t){
            if(typeof t =='object')
            {
                if(t.lang && _lang===null)
                {
                    _lang = t.lang;
                }
                if(t.debug && _isDebug===null)
                {
                    _isDebug = t.debug;
                }
                if(t.token)
                {
                    this.setToken(t.token);
                }
                if(t.guest && is_guest===null)
                {
                    is_guest = t.guest=='guest';
                }
                if(_task===false && t.task)
                {
                    _task = t.task;
                }
                if(_item_id===false && t.item_id)
                {
                    _item_id = t.item_id;
                }
                if(_user===false && t.user)
                {
                    _user = t.user;
                }
                if(_uri_get==false && t.getParams)
                {
                    _uri_get = t.getParams;
                }
                if(_route===false && t.route)
                {
                    _route = t.route;
                }
                if(_user_room===false && t.room)
                {
                    _user_room = t.room;
                }
            }
        },
        getRoom:function(){
            return _user_room;
        },
        setCurFilter: function(params){
            if(typeof params !='object')
            {
                return;
            }
            //_cur_filter = $.extend(_cur_filter,params);
        },
        getCurFilter: function(){
            return _cur_filter;
        },

        buildUrl:function(params, data, is_history, is_close)
        {
            is_close = is_close || false;
            is_history = is_history || false;
            if(is_history && !is_close)
            {
                return;
            }
            var p = {};
            if( params.city.id ){
                p['city'] = params.city.id;
            }
            if( params.cat.id )
            {
                p['category'] = params.cat.id;
            }

            if( params.user.id )
            {
                p['user'] = params.user.id;
            }

            if(params.order!='date-down')
            {
                p['order'] = params.order;
                /*if( cur_list=='all' && cur_filter.order )
                {
                }*/
            }
            if(params.search_val && $.trim(params.search_val)!='')
            {
                p['search_val'] = params.search_val;
            }
            var history_state = {title:'EXTUL'};
            if(data)
            {
                p['product'] = data['id'];
                document.title = data.title;
                history_state = {type:'prod_detail', content: data, cur_filter:params, title:data.title};
            }
            else
            {
                document.title = _prev_pageTitle;
            }

            if(p['city'] || p['category'] || p['user'])
            {

            }

            var url = $.buildUrl(p, true);
            if(url=='?')
            {
                url =  '';
                if(_route=='list/index')
                {
                    url='/list'+url;
                }
                else if(_route=='product/favorite')
                {
                    url='/favorite'+url;
                }
                else if(_route=='product/hold')
                {
                    url='/hold'+url;
                }
                else if(_route=='product/view')
                {
                    url=location.pathname;
                }
                else
                {
                    url='/';
                }

            }

            if(is_close && (_uri_get['city']!=p['city'] || _uri_get['category']!=p['category'] || _uri_get['user']!=p['user']) )
            {
                location.href = url;
            }
            else
            {
                //var url = p;//decodeURIComponent(p);
                history.pushState(history_state, null, url);
            }

        },
        getIdItem:function(){
            return _item_id;
        },
        getRoute: function(){
            return _route;
        },
        getTask:function(){
            return _task;
        },
        getParams:function(){
            return jQuery.extend({}, _uri_get);
        },
        getUser:function(){
            return _user;
        },
        setToken:function(t){
            if(!token)
            {
                token= t.t;
                token_name= t.name;
            }
        },
        setUserSend:function(id_user_send){
            if(_id_user_send===false)
            {
                _id_user_send = id_user_send;
            }
        },
        getUserSend:function(){
            return _id_user_send;
        },
        isGuest:function(){
            return is_guest;
        },
        checkUser : function(callback,hashTag){
            hashTag = hashTag || '';
            if(is_guest) {
                if(hashTag!='')
                {
                    //this.ajax('/useraccount/putHash',{hashTag:hashTag},function(data){});
                }

                //this.socialRegister();
                return false;
            }
            else{
                callback();
                return true;
            }
        },
        checkEmail : function(email){
            var pattern = /^([a-z0-9_\.\+-])+@[a-z0-9-]+\.([a-z]{2,4}\.)?[a-z]{2,4}$/i;
            return pattern.test(email);
        },
        setCurProd:function(id){
            _cur_prod = id;
        },
        getCurProd:function(){
            return _cur_prod;
        },
        ajax : function(url,data,success,error,dataType,type){
            url  = url || '';
            data = data || {};
            success = success || function(){}
            error = error|| function(){}
            type = type || 'POST';
            dataType = dataType || 'json';

            if( randov_val )
            {
                data.randomval = Math.random()*10000;
            }

            data[token_name] = token;
            data['lang'] = _lang;

            $.ajax({
                type: type,
                url: url,
                dataType: dataType,
                data:data,
                success: function(data)
                {
                    is_loading = false;
                    success(data);
                },
                error:function(p1,p2,p3){

                    is_loading = false;
                    //console.log(p1,p2,p3);
                    if(p1.status==400)
                    {
                        if( _isDebug )
                        {
                            try{
                                showNoty(p1.responseText,'error');
                            }
                            catch(e)
                            {

                            }
                        }
                        return;
                    }
                    else if(p1.status==403)
                    {
                        //socialRegister();
                        //return;
                    }
                    if(_isDebug)
                    {
                        console.info(url);
                        console.log(p1.responseText);
                    }

                    error(p1,p2,p3);
                }
            });
        },

        clearErr : function(){
            $('.msg-error').remove();
        },

        showErr : function(place,text){
            if( !place || !text ) return;

            $('.msg-error',place).remove();
            $('<div class="alert danger msg-error">'+text+'</div>').appendTo(place);
        },

        getCoords : function(addr, marker, map, el_lat, el_lng, callback){

            $.ajax({
                dataType: "json",
                url: "//maps.googleapis.com/maps/api/geocode/json?address="+addr+"&sensor=false&language=ru",
                data: {},
                success: function(data){
                    if (data.status == "OK")
                    {
                        var lat = data.results[0].geometry.location.lat;
                        var lng = data.results[0].geometry.location.lng;

                        marker.setPosition(new google.maps.LatLng(lat, lng));
                        marker.setTitle(addr);
                        marker.setMap(map);
                        map.panTo(marker.getPosition());
                        $(el_lat).val(lat);
                        $(el_lng).val(lng);

                        //console.log(addr+" Координаты: "+lat+", "+lng);
                    }
                    else{
                        //console.log(data);
                    }
                    if(callback) callback();
                }
            });
        },

        info : function (text){
            noty({"timeout":5000,"layout":"topCenter","dismissQueue":true,"theme":"relax","animation":{"open":"animated fadeInDown","close":"animated fadeOutUp","easing":"easing","speed":300},"text":text,"type":"success"});
        },
        cartAdded : function (text, no_hide_other_dlg, onclose){
            var dlg= $('#add-to-cart-dlg');
            if(!dlg.length){
                alert(text);
            }else{
                $('.modalinfo',dlg).html(text);
                dlg.myModal({show_top:no_hide_other_dlg, onClose:function(){
                    if( typeof onclose == 'function')
                    {
                        onclose();
                    }
                }});
            }
        },

        confirm : function(text, callback, cancel) {
            cancel = cancel || function(){};
            var modal = $('#confirm-dlg');
            $('.modalinfo', modal).html(text);
            modal.myModal({
                onConfirm: function () {
                    if (typeof callback == 'function') {
                        callback();
                    }
                    modal.myModal('hide');
                }, onClose:cancel
            });
        },

        err : function (text){

            noty({text:text, type:'error', dismissQueue: true, timeout: 3000, killer:true});

            return;
            var dlg= $('#err-dlg');
            if(!dlg.length)
            {
                alert(text);
            }
            else
            {
                $('.err-text',dlg).html(text).show();
                dlg.myModal();
            }
        },
        noty: function(text, type, dismissQueue, timeout, callback){
            type = type || 'success';
            dismissQueue = dismissQueue==true || false;
            timeout = timeout || 3000;
            callback = callback || {};
            var o = {text:text, type:type, dismissQueue: dismissQueue, timeout: timeout, killer:true};
            if(callback)
            {
                o.callback = callback;
            }
            noty(o);
        },

        tabs : function (selector){

            if ($(selector).hasClass('active')){
                var first = $(selector+".active");
            }else{
                var first = $(selector).first();
            }
            first.addClass('active');
            $(".tabs_content .tabs.active").removeClass('active');
            $("#"+first.attr('rel'), ".tabs_content").addClass('active');

            $(selector).on('click',function(){
                var element = $(this);
                var id = element.attr('rel');
                if(id=='') return;

                $(selector).removeClass('active');
                element.addClass('active');
                $(".tabs_content .tabs.active").removeClass('active');
                $("#"+id, ".tabs_content").addClass('active');

                if(selector==".menu-tabs li"){
                    location.hash = id+'t';
                }
            });

            if(selector==".menu-tabs li") {
                $('.menu-tabs li[rel=' + location.hash.substr(1).slice(0, -1) + ']').trigger('click');
            }
        },
        textAreaCol: function(id, parent, name_count, maxLength){

            var textarea=$(id);
            if(textarea.length==0) return;
            var maxLength = maxLength || $(id).attr('maxlength');
            var block_parent=$(id).closest(parent);
            var counter=$(name_count,block_parent);

            if(textarea.val()!='')
            {
                counter.html(char_left+(maxLength-textarea.val().length));
            }

            textarea.keyup(function()
            {
                var curLength = $(this).val().length;
                $(this).val($(this).val().substr(0, maxLength));
                var remaning = maxLength - curLength;
                if (remaning < 0) remaning = 0;
                counter.html(char_left+remaning);
                textarea.removeClass('err');
            });
        },

        isTouch: function(){
            return true == ("ontouchstart" in window || window.DocumentTouch && document instanceof DocumentTouch);
        },
        /**
         * Происходит ли на данный момент редактирования информации
         * @returns {boolean}
         */
        get dataEditing() {
            return  false;//_data_editing;
        },
        set dataEditing(data) {
            return  _data_editing = data;
        }

    };

})();

jQuery(document).ajaxStart(function(){

    $('body').addClass('loading');
});
jQuery.ajaxSetup({
    beforeSend: function(){
        // Действия, которые будут выполнены перед выполнением этого ajax-запроса
        //console.log('beforeSend');

    },

    complete: function(){
        // Действия, которые будут выполнены после завершения ajax-запроса
        //console.log('complete');
        $('body').removeClass('loading');
        //$('.submit_btn.loading').removeClass('loading');
    }
    // ......
});


var Msg = (function(){

            return {

                getDlgUri:function(id_user){
                    return location.origin+'/m/'+id_user;
                },
                send:function(btn, id_user){
                    if( $(btn).data('click') ) return;
                    var ob = this;
                    var msg_field = $('#msg-'+id_user);
                    if(msg_field.length==0)
                    {
                        return;
                    }

                    if($.trim(msg_field.val())=='' )
                    {
                        msg_field.focus();
                        return;
                    }
                    $(btn).data('click', true);

                    lib.ajax('/useraccount/sendMsg',{id_user:id_user, text:$.trim(msg_field.val())}, function (data) {
                        $(btn).data('click', false);
                        if(data['err'])
                        {
                            lib.err(data['err'])
                        }
                        else if(data['ok'])
                        {
                            msg_field.val('').focus();
                        }

                    })
                },
                loadDialog:function(event, id_user){
                    if($(event.target).closest('a').length==1 || $(event.target).closest('.input_wrap').length==1 || $(event.target).closest('.no_click').length==1) return;
                    location.href = this.getDlgUri(id_user);
                },
                blockDlg:function(event, id_user){

                    lib.confirm(CONFIRM_BLOCK_DLG,function(){
                        lib.ajax('/profilemessages/block',{user:id_user},function(data){
                            if(data['ok'])
                            {
                                location.reload();
                            }
                        });
                    },function(){
                        $('.show_manage_btns.clicked').removeClass('clicked');
                    });
                },
                writeMsg:function(event, id_user, username, userimg){
                    var modal = $('#write_msg-dlg');
                    $('.userimg', modal).html('<img src="'+userimg+'">');
                    $('.username', modal).text(username);
                    modal.myModal({show_top:true,onConfirm:function(dlg, btn){
                        var p = {};
                        p.im = $.trim($('.msg_im', dlg).val());
                        p.email = $.trim($('.msg_email', dlg).val());
                        p.val = $.trim($('.msg_val', dlg).val());
                        p.id_product = lib.getIdItem()||lib.getCurProd();
                        p.id_user = id_user;

                        lib.ajax('/profilemessages/sendMsg', {data:{'text':p.val, 'id_user_send':p.id_user}, sender:{im: p.im, email: p.email}, id_prod: p.id_product }, function(data){
                            if(data['err'])
                            {
                                var err  = '';
                                if(typeof data['err'] =='object')
                                {
                                    for(var i in data['err'])
                                    {
                                        err+=data['err'][i]+'<br>';
                                    }
                                }
                                else
                                {
                                    err = data['err'];
                                }

                                modal.myModal('err', err);
                            }
                            else if(data['ok'])
                            {
                                modal.myModal('hide');
                                $('textarea', modal).val('');
                                noty({text: data['txt'], dismissQueue: true, timeout: 3000, killer:true});
                            }
                        });
                    }});
                },
            }
})();

var User = {
    lib: lib,
    showPhone: function (el, user, phone, place) {
        lib.ajax('/profile/showPhone', {uid: user, type: phone}, function (data) {
            if (data['ok']) {
                $(el).prev($(place)).text(data['ok']).addClass('show');
                $(el).remove();
            }
        });
    }
}



var cart = (function() {

    return {
        /**
         *
         * @param el - элемент, по которому нажали
         * @param cart_id - идентификатор записи в корзине
         * @param item_id - идентификатор товара
         */
        update: function (el, cart_id, item_id) {
            el = $(el);
            el.addClass('animate-spin');
            lib.ajax('/cart/updateItem', {cart_id: cart_id, item_id: item_id}, function (data) {
                if(data['ok'])
                {
                    location.reload();
                }
            });
        }
    }
})();