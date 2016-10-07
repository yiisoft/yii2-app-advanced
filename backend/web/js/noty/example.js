$.noty.layouts.topCenter.css.width = '412px';
$.noty.layouts.topCenter.container.style = function() {
    $(this).css({
        top          : 20,
        left         : 0,
        position     : 'fixed',
        width        : '412px',
        height       : 'auto',
        margin       : 0,
        padding      : 0,
        listStyleType: 'none',
        zIndex       : 10000000
    });

    $(this).css({
        left: ($(window).width() - $(this).outerWidth(false)) / 2 + 'px'
    });
};

/*$.noty.defaults.template = '<div class="noty_message box-shadow3"><p><span class="fleft icon status">&nbsp;</span><span class="msg block overh"><div class="noty_text"></span></p></div>';*/
$.noty.defaults.force = true;
$.noty.defaults.maxVisible = 5;
$.noty.defaults.dismissQueue = true;

$.noty.themes.reviews = {
    name    : 'reviews',
    helpers : {},

    modal   : {
        class:'',
        css: {
            position       : 'fixed',
            width          : '100%',
            height         : '100%',
            backgroundColor: '#000',
            zIndex         : 10000,
            opacity        : 0.6,
            display        : 'none',
            left           : 0,
            top            : 0
        }
    },
    style   : function() {

        this.$bar.css({
            overflow    : 'hidden',
            margin      : '4px 0',
            borderRadius: '3px',
            boxShadow: "0 0 4px 0 rgba(0, 0, 0, 0.15)",
            background: "#f9edbe",
            border   : '1px solid #f0c36d',
            //width:'auto',
        });

        this.$message.css({
            fontSize  : '14px',
            lineHeight: '16px',
            color: '#000',
            textAlign : 'left',
            padding   : '20px 25px',
            width     : 'auto',
            position  : 'relative',

        });

        /*this.$closeButton.css({
         position: 'absolute',
         position: 'absolute',
         top: 10, right: 10,
         width: 20, height: 20,
         background: "#f0c36d",
         color: '#fff',
         cursor: 'pointer'
         });

         this.$buttons.css({
         padding        : 5,
         textAlign      : 'right',
         borderTop      : '1px solid #ccc',
         backgroundColor: '#fff'
         });

         this.$buttons.find('button').css({
         marginLeft: 5
         });

         this.$buttons.find('button:first').css({
         marginLeft: 0
         });

         this.$closeButton.on({
         mouseenter: function() {
         //$(this).css({'background':'#f49c15'});
         },
         mouseleave: function() {
         //$(this).css({background: "#f0c36d"});
         }
         });*/

        switch(this.options.layout.name) {
            case 'top':
                this.$bar.css({
                    borderBottom: '2px solid #eee',
                    borderLeft  : '2px solid #eee',
                    borderRight : '2px solid #eee',
                    borderTop   : '2px solid #eee',
                    boxShadow   : "0 2px 4px rgba(0, 0, 0, 0.1)"
                });
                break;
            case 'topCenter':
            case 'center':
            case 'bottomCenter':
            case 'inline':
                this.$bar.css({
                    //border   : '1px solid #eee',
                    //boxShadow: "0 2px 4px rgba(0, 0, 0, 0.1)"
                });
                //this.$message.css({fontSize: '13px', textAlign: 'left'});
                break;
            case 'topLeft':
            case 'topRight':
            case 'bottomLeft':
            case 'bottomRight':
            case 'centerLeft':
            case 'centerRight':
                this.$bar.css({
                    border   : '1px solid #eee',
                    boxShadow: "0 2px 4px rgba(0, 0, 0, 0.1)"
                });
                this.$message.css({fontSize: '13px', textAlign: 'left'});
                break;
            case 'bottom':
                this.$bar.css({
                    borderTop   : '2px solid #eee',
                    borderLeft  : '2px solid #eee',
                    borderRight : '2px solid #eee',
                    borderBottom: '2px solid #eee',
                    boxShadow   : "0 -2px 4px rgba(0, 0, 0, 0.1)"
                });
                break;
            default:
                this.$bar.css({
                    border   : '2px solid #eee',
                    boxShadow: "0 2px 4px rgba(0, 0, 0, 0.1)"
                });
                break;
        }


        this.$bar.attr('style','');
        this.$message.attr('style','');

        switch(this.options.type) {
            case 'alert':
            case 'notification':
                this.$bar.css({backgroundColor: '#FFF', borderColor: '#dedede', color: '#444'});
                break;
            case 'warning':
                this.$bar.css({backgroundColor: '#FFEAA8', borderColor: '#FFC237', color: '#826200'});
                this.$buttons.css({borderTop: '1px solid #FFC237'});
                break;
            case 'error':
                this.$bar.css({backgroundColor: '#f75254', borderColor: '#f75254', color: '#FFF'});
                //this.$message.css({fontWeight: 'bold'});
                this.$buttons.css({borderTop: '1px solid darkred'});
                break;
            case 'information':
                this.$bar.css({backgroundColor: '#78C5E7', borderColor: '#3badd6', color: '#FFF'});
                this.$buttons.css({borderTop: '1px solid #0B90C4'});
                break;
            case 'success':
                this.$bar.css({backgroundColor: '#BCF5BC', borderColor: '#7cdd77', color: 'darkgreen'});
                this.$buttons.css({borderTop: '1px solid #50C24E'});
                break;
            default:
                this.$bar.css({backgroundColor: '#FFF', borderColor: '#CCC', color: '#444'});
                break;
        }
    },
    callback: {
        onShow : function() {

        },
        onClose: function() {

        }
    }
};