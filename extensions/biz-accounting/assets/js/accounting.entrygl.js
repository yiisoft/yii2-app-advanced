yii.entrygl = (function($) {
    var template, counter = 0, $body;

    var pub = {
        addRow: function() {
            var $row = $(template.replace(/_index_/g, counter++));
            $body.append($row);
            pub.rearrange();
        },
        afterRow:function ($row){
            
        },
        rearrange:function (){
            var no = 1;
            $body.children('tr').each(function (){
                $(this).children('td.serial').text(no++);
            });
        },
        init: function() {
            $body = $('#tbl-gldetail > tbody');
            template = $body.data('template');

            $('#tbl-gldetail > thead a.fa').click(function() {
                pub.addRow();
                return false;
            });

            $('#tbl-gldetail').on('click', 'td.action > a.fa', function() {
                $(this).closest('tr').remove();
                pub.rearrange();
                return false;
            });
            
            $body.children('tr').each(function (){
                pub.afterRow($(this));
            });
            pub.rearrange();
            console.log('ABCDE');
        }
    };
    return pub;
})(window.jQuery);