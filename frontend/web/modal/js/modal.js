;(function( $ ) {
    var methods = {
        init : function( options ) {
            var options = $.extend({
                onConfirm:function(){},
                onAfterDisplay:function(){},
                onBeforeDisplay:function(){},
                afterWindowResize:function(){},
                onClose:function(){},
                onCancel:function(){},
                hide_this:true,
                show_top:false,
                full_size:false
            }, options || {});
            return this.each(function() {

                var scrollWidth = 0;
                if( !$(this).data('scrollSize') )
                {
                    /*if(document.scrollHeight==document.offsetHeight)
                     {
                     scrollWidth = 0;
                     }
                     else
                     {*/
                    // создадим элемент с прокруткой
                    var div = document.createElement('div');

                    div.style.overflowY = 'scroll';
                    div.style.width =  '50px';
                    div.style.height = '50px';
                    div.style.visibility = 'hidden';

                    document.body.appendChild(div);
                    scrollWidth = div.offsetWidth - div.clientWidth;
                    document.body.removeChild(div);
                    //}

                    $(this).data('scrollSize',scrollWidth);
                }

                scrollWidth = $(this).data('scrollSize');

                if(options.hide_this && !options.show_top)
                {
                    $('.mymodal').trigger('modal.hide');
                }
                else if(!options.show_top)
                {
                    $('.mymodal').not(this).trigger('modal.hide');
                }

                var scrollTop = $(window).scrollTop();

                var dlg_block = $(this);
                dlg_block.data('full_size',options.full_size);

                var id_dlg = dlg_block.attr('id');
                if(!id_dlg) return;
                var dlg = $('.modaldlg',dlg_block);
                $('div.err, span.err',dlg).hide().text('');
                $('input.err',dlg).removeClass('err');

                var scale = 1.5;
                var margin = 30;
                var max_w = 1270;
                var min_w = 890;

                padding1 = parseInt(dlg.css('padding-left')) + parseInt(dlg.css('padding-right'));
                padding2 = parseInt(dlg.css('padding-top')) + parseInt(dlg.css('padding-bottom'));
                max_w -= padding1;
                min_w -= padding1;

                function autoSizeDlg()
                {

                    var d_w1 = $(window).width() - margin*2 - padding1;
                    var d_h1 = $(window).height() - margin*2 - padding2;
                    var d_w= 0, d_h=0;

                    if(d_w1/d_h1 > scale)
                    {
                        d_w = d_w1;
                        d_h = parseInt(d_w1/scale);
                    }
                    else
                    {
                        d_h = d_h1;
                        d_w = parseInt(d_h1*scale);
                    }

                    if(d_w>max_w)
                    {
                        d_w=max_w;
                        d_h=parseInt(d_w/scale);
                    }
                    if(d_h1<d_h)
                    {
                        d_h = d_h1;
                        d_w=parseInt(d_h*scale);
                    }
                    if(d_w<min_w)
                    {
                        d_w=min_w;
                        d_h=parseInt(d_w/scale);
                    }
                    dlg.width(d_w);
                    dlg.height(d_h);

                }

                $('.clear',dlg).val('');

                dlg_block.css({'display':'block', 'visibility':'visible'});
                /*dlg.css({'display':'block', 'visibility':'visible'});*/

                dlg_block.addClass('hidden_dlg');
                if(!options.full_size)
                {

                }
                else
                {
                    autoSizeDlg();
                }

                $('body').addClass('modal-show').css('padding-right',scrollWidth+'px');
                options.onBeforeDisplay(dlg); // event

                var left = ($(window).width()-dlg.outerWidth())/2;
                var top = ($(window).height()-dlg.outerHeight())/2;
                if(top<0) top =0;
                if( dlg.hasClass('feed-dlg') ) top=14;
                //dlg.css({'left':left+'px','top':top+'px'});

                dlg_block.css({'display':'', 'visibility':''});
                dlg.css({'display':'', 'visibility':''});
                dlg_block.fadeIn(200);

                dlg.addClass('show_dlg');
                $('.focus:eq(0)',dlg).focus();
                /*dlg.fadeIn(200,function(){
                 options.onAfterDisplay(dlg);
                 });*/
                options.onAfterDisplay(dlg);


                dlg_block.off('click','.confirm');

                dlg_block.on('click','.confirm',function(e){
                    e.preventDefault();
                    options.onConfirm(dlg, $(this));
                });


                var prev_item_clicked = null;

                dlg_block.off('click','.closedlg, .close');
                dlg_block.off('modal.hide');

                dlg_block.on('click','.closedlg, .close',function(e){
                    e.preventDefault();
                    if( prev_item_clicked== $(e.target)[0])
                    {
                        closeDlg();
                    }
                });

                dlg_block.on('modal.hide',function(){
                    closeDlg();
                });

                dlg_block.off('mousedown');
                dlg_block.on('mousedown',function(e){
                    prev_item_clicked = $(e.target)[0];
                });

                dlg_block.off('mouseup');
                dlg_block.on('mouseup',function(e){
                    if(e.button==2) return;
                    if( $(e.target).attr('id')!=id_dlg ) return;
                    if( prev_item_clicked== $(e.target)[0])
                    {
                        closeDlg();
                        dlg.removeClass('hidden_dlg');
                    }
                });

                function closeDlg()
                {
                    options.onClose(dlg);
                    if($('.modaldlg.show_dlg').length==0)
                    {
                        $('body').removeClass('modal-show').css('padding-right','');
                    }
                    dlg.removeClass('show_dlg');
                    /*dlg.fadeOut(200,function(){
                     if($('.mymodal:visible').length==1)
                     {
                     $('body>.top').css('left','');
                     }
                     dlg.closest('.offset').css('margin-left','');
                     //$(window).scrollTop(scrollTop);
                     $('.clear',dlg).val('');
                     });*/

                    if($('.mymodal:visible').length==1)
                    {
                        $('body>.top').css('left','');
                    }

                    dlg_block.fadeOut(300,function(){
                        if($('.mymodal:visible').length==0)
                        {
                            $('body').removeClass('modal-show').css('padding-right','');
                        }
                    });
                }
                if(!dlg_block.data('sethandlers'))
                {

                    /*
                     $('body').on({
                     'mousewheel': function(e) {
                     if (e.target.id == 'ava-dlg'  ) return;
                     console.log(dlg_block.is(':visible'));
                     if( !dlg_block.is(':visible') ) return;
                     e.preventDefault();
                     e.stopPropagation();
                     }
                     });
                     */

                    try{
                        $('input,textarea').on('textchange',function(){
                            $('input.err, textarea.err',dlg).removeClass('err');
                            $('.line.err',dlg).hide();
                        });
                    }
                    catch(e)
                    {

                    }


                    $('input,textarea',dlg_block).on('focus',function(){
                        //$(this).removeClass('err');
                    });


                    dlg_block.data('sethandlers',true);
                }

                if( !dlg.data('setup_resize') )
                {
                    $(window).on('resize', function(){
                        if( !dlg_block.is(':visible') ) return;

                        if(options.full_size)
                        {
                            autoSizeDlg();
                        }

                        options.afterWindowResize(dlg);

                        var left = ($(window).width()-dlg.outerWidth())/2;
                        var top = ($(window).height()-dlg.outerHeight())/2;
                        if( left<0 ) left=0;
                        if( top<0 ) top=0;
                        if( dlg.hasClass('feed-dlg') ) top=14;
                        //dlg.css({'left':left+'px','top':top+'px'});
                    });
                    dlg.data('setup_resize',false);
                }

            });
        },
        hide:function(){
            return $(this).trigger('modal.hide');
        },
        err:function(data){
            $('.err',this).show().html(data);
            return $(this);
        },
        center:function(){
            //return;

            var dlg = $('.modaldlg',this);
            var left = ($(window).width() - dlg.outerWidth()) / 2;
            var top = ($(window).height() - dlg.outerHeight()) / 2;
            if(top<0) top =0;
            if( dlg.hasClass('feed-dlg') ) top=14;
            //dlg.css({'left': left + 'px', 'top': top + 'px'});
        },
        foot:function(){

            var dlg = $('.modaldlg',this);
            var left = ($(window).width() - dlg.outerWidth()) / 2;
            var top = ($(window).height() - dlg.outerHeight()) / 2;
            if( dlg.hasClass('feed-dlg') ) top=14;
            if(top<0) {
                top = 0;
                $(this).scrollTop($(this).height());
            }
            dlg.css({'left': left + 'px', 'top': top + 'px'});
        }

    };

    $.fn.myModal=function( method ){

        if ( methods[method] ) {
            return methods[method].apply( this, Array.prototype.slice.call( arguments, 1 ));
        } else if ( typeof method === 'object' || ! method ) {

            return methods.init.apply( this, arguments );
        } else {
            $.error( 'Method ' +  method + ' does not exist on jQuery.myModal' );
        }
    };

})( jQuery );