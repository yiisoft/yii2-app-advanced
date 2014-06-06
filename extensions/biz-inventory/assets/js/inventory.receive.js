yii.receive = (function($) {
    var $grid, $form, template, counter = 0;

    var local = {
        checkStock: true,
        addItem: function(item) {
            var has = false;
            $('#detail-grid > tbody > tr').each(function() {
                var $row = $(this);
                if ($row.find('input[data-field="id_product"]').val() == item.id) {
                    has = true;
                    var $qty = $row.find('input[data-field="transfer_qty_receive"]');
                    if ($qty.val() == '') {
                        $qty.val('2');
                    } else {
                        $qty.val($qty.val() * 1 + 1);
                    }
                }
            });
            if (!has) {
                var $row = $(template.replace(/_index_/g, counter++));

                $row.find('span.cd_product').text(item.cd);
                $row.find('span.nm_product').text(item.text);
                $row.find('input[data-field="id_product"]').val(item.id);

                $row.find('input[data-field="transfer_qty_send"]').val('0');
                var $select = $row.find('select[data-field="id_uom"]').html('');
                $.each(item.uoms, function() {
                    $select.append($('<option>').val(this.id).text(this.nm).attr('data-isi', this.isi));
                });

                $grid.find('tbody > tr').removeClass('selected');
                $row.addClass('selected');
                $grid.children('tbody').append($row);
                $row.find('input[data-field="transfer_qty_receive"]').focus();
            }
            local.rearange();
        },
        format: function(n) {
            return $.number(n, 0);
        },
        rearange: function() {
            var num = 1;
            $('#detail-grid > tbody > tr').each(function() {
                $(this).find('div.serial > span').text(num++);
            });
        },
        normalizeItem: function($row) {
            var s = $row.find('input[data-field="transfer_qty_send"]').val() * 1;
            var r = $row.find('input[data-field="transfer_qty_receive"]').val() * 1;
            var $is = $row.find('input[data-field="transfer_selisih"]');
            $is.val(r - s);
            if (r == s) {
                $is.css({color: 'black'});
            } else {
                $is.css({color: 'red'});
            }
        },
        searchProductByCode: function(cd) {
            var whse = $('#transferhdr-id_warehouse_source').val();
            if (local.checkStock && (whse == '' || biz.master.ps[whse] == undefined)) {
                return false;
            }
            var id = biz.master.barcodes[cd] + '';
            if (id && biz.master.product[id]) {
                if (local.checkStock && (biz.master.ps[whse][id] == undefined || biz.master.ps[whse][id] <= 0)) {
                    return false;
                }
                return biz.master.product[id];
            }
            return false;
        },
        onProductChange: function() {
            var item = local.searchProductByCode(this.value);
            if (item !== false) {
                local.addItem(item);
            }
            this.value = '';
            $(this).autocomplete("close");
        },
        initRow: function() {
            $('#detail-grid > tbody > tr').each(function() {
                var $row = $(this);
                local.normalizeItem($row);
            });
            counter++;
        },
        initObj: function() {
            $grid = $('#detail-grid');
            $form = $('#purchase-form');
            template = $('#detail-grid > tbody').data('template');
        },
        initEvent: function() {
            $grid.on('click', '[data-action="delete"]', function() {
                $(this).closest('tr').remove();
                return false;
            });

            $grid.on('click', 'tr', function() {
                $grid.find('tbody > tr').removeClass('selected');
                $(this).addClass('selected');
            });

            $grid.on('keydown', ':input[data-field]', function(e) {
                if (e.keyCode == 13) {
                    var $inputs = $grid.find(':input:visible[data-field]:not([readonly])');
                    var idx = $inputs.index(this);
                    if (idx >= 0) {
                        if (idx < $inputs.length - 1) {
                            $inputs.eq(idx + 1).focus();
                        } else {
                            //$('#product').focus();
                        }
                    }
                }
            });

            $grid.on('change', ':input[data-field]', function() {
                var $row = $(this).closest('tr');
                local.normalizeItem($row);
            });

            var clicked = false;
            $grid.on('click focus', 'input[data-field]', function(e) {
                if (e.type == 'click') {
                    clicked = true;
                } else {
                    if (!clicked) {
                        $(this).select();
                    }
                    clicked = false;
                }
            });

            $('input[data-field="transfer_qty_receive"]').first().focus();

            $('#product').change(local.onProductChange);

            $(window).keydown(function(event) {
                if (event.keyCode == 13) {
                    if ($(event.target).is('#product')) {
                        $('#product').change();
                    } else {
                        event.preventDefault();
                    }
                    return false;
                }
            });
        }
    }

    var pub = {
        init: function() {
            local.initObj();
            local.initRow();
            local.initEvent();
            yii.numeric.input($grid, 'input[data-field]');
        },
        sourceProduct: function(request, callback) {
            var result = [];
            var limit = biz.config.limit;
            var term = request.term.toLowerCase();
            var whse = $('#transferhdr-id_warehouse_source').val();
            if (local.checkStock && (whse == '' || biz.master.ps[whse] == undefined)) {
                callback([]);
                return;
            }

            $.each(biz.master.product, function() {
                if (this.text.toLowerCase().indexOf(term) >= 0) {
                    var id = this.id + '';
                    if (local.checkStock && (biz.master.ps[whse][id] == undefined || biz.master.ps[whse][id] <= 0)) {
                        callback([]);
                        return;
                    }
                    result.push(this);
                    limit--;
                    if (limit <= 0) {
                        return false;
                    }
                }
            });
            callback(result);
        },
        onProductSelect: function(event, ui) {
            local.addItem(ui.item);
        },
    };
    return pub;
})(window.jQuery);