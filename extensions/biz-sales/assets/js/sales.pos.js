yii.pos = (function($) {
    var $grid, $form, $template, $list_session, $list_template;
    var storage = {
        changeSession: function(key) {
            var details = yii.storage.changeSession(key);
            $('#detail-grid > tbody > tr').remove();
            $.each(details, function() {
                var item = this;
                var $row = $template.clone();
                $row.find('span[data-text="nm_product"]').text(item.nm_product);
                $row.find('input[data-field="id_product"]').val(item.id_product);
                $row.find('span[data-text="price"]').text(local.format(item.price));
                $row.find('input[data-field="price"]').val(item.price);
                $row.find('input[data-field="qty"]').val(item.qty);
                $row.find('input[data-field="discon"]').val(item.discon);
                $row.find('input[data-field="id_uom"]').val(item.id_uom);
                $row.find('span[data-text="nm_uom"]').text(item.nm_uom);
                $grid.children('tbody').append($row);
            });
            $('#product').focus();
            local.normalizeItem();
        },
        newSession: function() {
            yii.storage.removeCurrentSession();
            $('#detail-grid > tbody > tr').remove();
            $list_session.children('div').removeClass('active');
            $('#total-price').text(local.format(0));
            $('#product').focus();
        },
        listSession: function() {
            var keys = yii.storage.listSession();
            var current = yii.storage.getCurrentSession();
            $list_session.children('div').remove();

            $.each(keys, function() {
                var key = this;
                var $div = $list_template.clone();
                $div.children('.session').text(key);
                if (key == current) {
                    $div.addClass('active');
                }
                $list_session.append($div);
            });
            return current;
        },
        savePos: function() {
            var $rows = $('#detail-grid > tbody > tr');
            if ($rows.length == 0) {
                return false;
            }
            var details = [];
            $rows.each(function() {
                var $row = $(this), detail = {};
                $row.find('input[data-field]').each(function() {
                    var field = $(this).data('field');
                    detail[field] = $(this).val();
                });
                details.push(detail);
            });
            // -- save to queue and remove session
            if (yii.storage.savePos(details)) {
                $('#list-session > div.active').remove();
                $('#detail-grid > tbody > tr').remove();
            }
        },
        initEvent: function() {
            $('#new-session').click(function() {
                storage.newSession();
                return false;
            });
            $list_session.on('click', 'a', function() {
                var $this = $(this);
                var isActive = $this.closest('div').hasClass('active');
                if ($this.is('.session')) {
                    if (isActive) {
                        return false;
                    }
                    var key = $this.text();
                    storage.changeSession(key);
                } else {
                    var $div = $this.closest('div');
                    var key = $div.children('.session').text();
                    yii.storage.removeSession(key);
                    if (isActive) {
                        $('#detail-grid > tbody > tr').remove();
                        $('#product').focus();
                    }
                }
                storage.listSession();
                return false;
            });
        },
        init: function() {
            var drawer = yii.storage.getCurrentDrawer();
            if (drawer != false) {
                yii.storage.setCashDrawer(drawer);
            }
            local.checkDrawer();
            yii.storage.loadMaster();
            yii.global.pullMaster(biz.config.pullMasterUrl,{},function(master){
                yii.storage.saveMaster(master);
            });
            var key = yii.storage.getCurrentSession();
            if (key) {
                storage.changeSession(key);
            } else {
                storage.listSession();
            }
            storage.initEvent();
        },
    }

    var local = {
        addItem: function(item) {
            var has = false;
            $('#detail-grid > tbody > tr').each(function() {
                var $row = $(this);
                if ($row.find('input[data-field="id_product"]').val() == item.id) {
                    has = true;
                    var $qty = $row.find('input[data-field="qty"]');
                    if ($qty.val() == '') {
                        $qty.val('2');
                    } else {
                        $qty.val($qty.val() * 1 + 1);
                    }
                    return false;
                }
            });
            if (!has) {
                var $row = $template.clone();
                //$row.show();
                $row.find('span[data-text="nm_product"]').text(item.text);
                $row.find('input[data-field="id_product"]').val(item.id);
                $row.find('span[data-text="price"]').text(local.format(item.price));
                $row.find('input[data-field="price"]').val(item.price);
                $row.find('input[data-field="qty"]').val('1');
                $row.find('input[data-field="id_uom"]').val(item.id_uom);
                $row.find('span[data-text="nm_uom"]').text(item.nm_uom);
                local.selectRow($row)
                $grid.children('tbody').append($row);
            }
            local.normalizeItem();
        },
        selectRow: function($row, focus) {
            if ($row.is('.selected')) {
                return;
            }
            $grid.find('tbody > tr').removeClass('selected');
            $row.addClass('selected');
            if (focus) {
                $row.find('input[data-field="qty"]')
            }
        },
        setFocus: function(act) {
            var $row = $grid.find('tbody > tr.selected');
            if ($row.length == 1) {
                var $li = $row.find('li' + (act == 42 ? '.qty' : '.discon'));
                $li.show();
                $li.children('input').focus().select();
                return false;
            }
        },
        delActiveRow: function() {
            var $row = $grid.find('tbody > tr.selected');
            if ($row.length == 1) {
                $row.remove();
                local.normalizeItem();
                $('#product').focus();
                return false;
            }
        },
        format: function(n) {
            return $.number(n, 2);
        },
        normalizeItem: function() {
            var total = 0.0;
            var details = [];
            $('#detail-grid > tbody > tr').each(function() {
                var $row = $(this);
                var q = $row.find('input[data-field="qty"]').val(),
                    d = $row.find('input[data-field="discon"]').val();
                q = q == '' ? 1 : q;
                if (d == '') {
                    $row.find('li.discon').hide();
                    d = 0;
                } else {
                    $row.find('li.discon').show();
                }

                var t = (1 - 0.01 * d) * q * $row.find('input[data-field="price"]').val();
                $row.find('span[data-text="total_price"]').text(local.format(t));
                $row.find('input[data-field="total_price"]').val(t);
                total += t;
                // session
                var detail = {};
                $row.find('input[data-field]').each(function() {
                    detail[$(this).data('field')] = this.value;
                });
                detail.nm_product = $row.find('span[data-text="nm_product"]').text();
                detail.nm_uom = $row.find('span[data-text="nm_uom"]').text();
                details.push(detail);
            });
            $('#total-price').text(local.format(total));
            $('#h-total-price').val(total);
            yii.storage.saveSession(details);
            storage.listSession();
        },
        searchProductByCode: function(cd) {
            cd = cd.toLowerCase();
            if (biz.master.barcodes[cd]) {
                var id = biz.master.barcodes[cd] + '';
                if (biz.master.product[id]) {
                    return biz.master.product[id];
                }
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
        currentTime: function() {
            setTimeout(local.currentTime, 1000);
        },
        checkDrawer: function() {
            $.getJSON(biz.config.checkDrawerUrl, function(r) {
                if (r.type == 'S') {
                    local.setDrawer(r.drawer);
                } else {
                    $('#dlg-drawer').modal('show');
                }
            }).fail(function(jqxhr, textStatus, error) {
                var err = textStatus + ', ' + error;
                yii.global.log("Request Failed: " + err);
                if (jqxhr.status == 403) { // forbiden
                    window.location.href = biz.config.loginUrl;
                }
            });
        },
        setDrawer: function(obj) {
            yii.storage.setCashDrawer(obj);
            $('#id-drawer').val(obj.id_cashdrawer);
            $('#no-kasir').text(obj.cashier_no);
            $('#nm-cabang').text(obj.nm_branch);
            $('#nama-kasir').text(obj.username);
            $('#open-time').text(obj.open_time);
        },
        initObj: function() {
            $grid = $('#detail-grid');
            $form = $('#pos-form');
            $template = $('#detail-grid > thead > tr');
            $list_session = $('#list-session');
            $list_template = $('#list-template > div');
        },
        initEvent: function() {
            $grid.on('click', '[data-action="delete"]', function() {
                $(this).closest('tr').remove();
                local.normalizeItem();
                return false;
            });
            $grid.on('click', 'tr', function() {
                local.selectRow($(this), true);
            });
            yii.global.isChangeOrEnter($grid, ':input', function() {
                $('#product').focus();
                local.normalizeItem();
            });
            yii.global.isChangeOrEnter($('#payment-value'), '', function() {
                var p = this.value * 1;
                var t = $('#h-total-price').val() * 1;
                $('#cashback').text('Rp ' + local.format(p - t));
                if (p >= t) {
                    $('#cashback').css({'color': 'black'});
                    $('#dlg-confirm-save').modal('show');
                } else {
                    $('#cashback').css({'color': 'red'});
                }
                return false;
            });
            $grid.on('focus', 'input', function(e) {
                $(e.target).select();
                local.selectRow($(e.target).closest('tr'));
            });
            $('#btn-save').on('click', function() {
                storage.savePos();
                $('#product').focus();
                return false;
            });
            $(document).on('keypress keydown', '*', function(e) {
                var n = $(e.target).is(':input') && e.target.value;
                var kode = e.which;
                if (e.type == 'keydown') {
                    switch (kode) {
                        case 46: // delete
                            if (!n) {
                                return local.delActiveRow();
                            }
                        case 78: // ctrl+N
                            if (e.ctrlKey) {
                                storage.newSession();
                                return false;
                            }
                        case 66: // ctrl+B
                        case 67: // ctrl+C
                            if (e.ctrlKey) {
                                $('#payment-method').val(kode == 67 ? 1 : 2);
                                $('#payment-value').focus().select();
                                return false;
                            }
                        default:
                            //console.log('keydown '+kode);
                            break;
                    }
                } else {
                    switch (kode) {
                        case 42:
                        case 45:
                            if (!n) {
                                return local.setFocus(kode);
                            }
                        default:
                            //console.log('keypress '+kode);
                            break;
                    }
                }
            });
            yii.numeric.input($grid, 'input[data-field]', {
                allowFloat: true,
                allowNegative: false,
            });
            yii.numeric.input($('#payment-value'), '', {});
            
            $('#cashdrawer-opennew').click(function() {
                $.post(biz.config.newDrawerUrl,
                    $('#dlg-drawer :input').serialize(),
                    function(r) {
                        if (r.type == 'S') {
                            local.setDrawer(r.drawer);
                            $('#dlg-drawer').modal('hide');
                        }else{
                            alert(r.msg);
                        }
                    });
                return false;
            });

            $('#product').change(local.onProductChange);
            $('#product').focus();

            // confirm-save
            $('#btn-confirm-yes').click(function(e) {
                e.preventDefault();
                alert('Cetak');
                storage.savePos();
                $('#product').focus();
                $('#dlg-confirm-save').modal('hide');
                $('#payment-value').val('');
                return false;
            });
            $('#btn-confirm-no').click(function(e) {
                e.preventDefault();
                storage.savePos();
                $('#product').focus();
                $('#dlg-confirm-save').modal('hide');
                $('#payment-value').val('');
                return false;
            });
        },
        init: function() {
            local.initObj();
            local.initEvent();
        }
    }

    var pub = {
        onSelectProduct: function(event, ui) {
            yii.global.log(ui.item);
            local.addItem(ui.item);
        },
        init: function() {
            local.init();
            storage.init();
        },
    };

    return pub;
})(window.jQuery);