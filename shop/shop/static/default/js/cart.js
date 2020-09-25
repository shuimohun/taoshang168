/**
 * @author WenQingTeng
 */

var address_id, address_contact, address_address, address_phone, invoice, invoice_id, shop_id, voucher_price, total_price, total_rate, num, good_price, good_price_rate;

$(document).ready(function() {

    $("input[type='checkbox']").prop("checked", false);

    $(document).click(function(e) {

    });

    window.get = function(e) {
        //$(e).parent().parent().parent().find(".sale_detail").show();
        $('.box_list').hide();
        $('.increase_info'+$(e).data('iid')).show();
    }

    window.showManSong = function(e) {
        $('.box_list').hide();
        $('.mansong_info'+$(e).data('sid')).show();
    }

    /*window.lookManSong = function (e) {
        goods_id = $(e).data('id');
        $('html, body').animate({
            scrollTop: $('.row_mansong_'+goods_id).offset().top - 200
        }, 500,function () {
            $('.row_mansong_'+goods_id).css('background-color','#FFF9E8');
        });
    }*/

    window.showVoucher = function(e) {
        $('.box_list').hide();
        if($(e).hasClass('show')){
            $(e).removeClass('show');
            $(e).parent().parent().parent().find(".voucher_detail").hide();
        }else{
            $(e).addClass('show');
            $(e).parent().parent().parent().find(".voucher_detail").show();
        }
    }

    $(".bk").click(function() {
        $(this).parent().parent().hide();
        $(this).parent().parent().prev('.show_voucher').removeClass('show');
    })

    //切换用户收货地址，获取物流运费
    $(".receipt_address li").click(function() {
        $(".receipt_address li").removeClass('add_choose');
        $(this).addClass('add_choose');

        getTransport();
    });

    //返回购物车
    $("#back_cart").click(function() {
        location.href = SITE_URL + "?ctl=Buyer_Cart&met=cart";
    });

    function getTransport() {
        var address_id = $(".add_choose").find('#address_id').val();
        product_id = getQueryString('product_id');
        location.href = SITE_URL + "?ctl=Buyer_Cart&met=confirm&product_id=" + product_id + "&address_id=" + address_id;
    }

    var ww = $(document).height() - 173;
    var top;
    top = $(window).scrollTop() + $(window).height();
    top >= ww ? $(".pay_fix").css("position", "relative") : $(".pay_fix").css("position", "fixed");
    $(window).scroll(function() {
        top = $(window).scrollTop() + $(window).height();
        if (top >= ww) {
            $(".pay_fix").css("position", "relative");
        } else {
            $(".pay_fix").css("position", "fixed");
        }
    });


    //全选的删除按钮
    $('.delete').click(function() {
        //获取所有选中的商品id
        var chk_value = []; //定义一个数组
        $("input[name='product_id[]']:checked").each(function() {
            chk_value.push($(this).val()); //将选中的值添加到数组chk_value中
        })

        $.dialog({
            title: '删除',
            content: '您确定要删除吗？',
            height: 100,
            width: 410,
            lock: true,
            drag: false,
            ok: function() {
                $.post(SITE_URL + '?ctl=Buyer_Cart&met=delCartByCid&typ=json', {
                    id: chk_value
                }, function(data) {
                    console.info(data);
                    if (data && 200 == data.status) {
                        //$.dialog.alert('删除成功');
                        Public.tips.success('删除成功!');
                        window.location.reload(); //刷新当前页
                    } else {
                        //$.dialog.alert('删除失败');
                        Public.tips.error('删除失败!');
                    }
                });
            }
        })
    });

    //全选
    $('.checkall').click(function() {
        var _self = this;
        $('.checkitem').each(function() {
            if (!this.disabled) {
                $(this).prop('checked', _self.checked);

                if (_self.checked) {
                    $(this).parent().parent().parent().addClass('item-selected');
                } else {
                    $(this).parent().parent().parent().removeClass('item-selected');
                }
            }
        });
        $('.checkall').prop('checked', this.checked);
        count();
    });

    //勾选店铺
    $('.checkshop').click(function() {
        if (this.checked) {
            $(this).parents(".carts_content").find(".checkitem").prop('checked', true);
            $(this).parent().parent().parent().find(".row_line").addClass('item-selected');
        } else {
            $(this).parents(".carts_content").find(".checkitem").prop('checked', false);
            $(this).parent().parent().parent().find(".row_line").removeClass('item-selected');
        }
        count();
    });

    //单度选择商品
    $('.checkitem').click(function() {
        var _self = this;
        if (!this.disabled) {
            $(this).prop('checked', _self.checked);

            if (_self.checked) {
                $(this).parent().parent().parent().addClass('item-selected');

                //判断该店铺下的商品是否已全选
                if ($(this).parents('.table_list').find(".checkitem").not("input:checked").length == 0) {
                    $(this).parents(".carts_content").find(".checkshop").prop('checked', true);
                }

                //判断是否所有商品都已选择，如果所有商品都选择了就勾选全选
                if ($(".checkitem").not("input:checked").length == 0) {
                    $('.checkall').prop('checked', true);
                }
            } else {
                $(this).parent().parent().parent().removeClass('item-selected');

                //判断该店铺下的商品是否已全选
                if ($(this).parents('.table_list').find(".checkitem").not("input:checked").length != 0) {
                    $(this).parents(".carts_content").find(".checkshop").prop('checked', false);
                }

                //判断全选是否勾选，如果勾选就去除
                if ($(".checkitem").not("input:checked").length != 0) {
                    $('.checkall').prop('checked', false);
                }
            }
        }
        count();
    });

    function count() {
        var count = 0;
        var num = 0;
        $(".cart-checkbox").find("input[name='product_id[]']:checked").each(function() {
            var value = $(this).val();
            var price = $(this).parent().parent().parent().find(".price_all span").html();
            price = price.replace(/,/g, "")
            price = Number(price);
            count = count + price;
            num++;
        });
        $(".subtotal_all").html(count.toFixed(2));
        //$(".cart-count em").html(num);
        if (num > 0) {
            $(".submit-btn").removeClass("submit-btn-disabled");
        } else {
            $(".submit-btn").addClass("submit-btn-disabled");
        }
    }

    var c = $(".goods_num");
    var e = null;
    c.each(function() {
        var g = $(this).find("a"); //添加减少按钮
        var h = $(this).find("input.nums"); //当前商品数量
        var o = this;
        var f = h.attr("data-max"); //最大值 - 库存
        var i = h.attr("data-min"); //最小值
        var id = h.attr("data-id"); //购物车id
        h.bind("input propertychange", function() {
            var j = this;
            var k = $(j).val();
            e && clearTimeout(e);
            e = setTimeout(function() {
                var l = Math.max(Math.min(f, k.replace(/\D/gi, "").replace(/(^0*)/, "") || 1), i);
                $(j).val(l);
                edit_num(id, l, o);
                if (l == f) {
                    g.eq(1).attr("class", "no_add");
                    if (l == i) g.eq(0).attr("class", "no_reduce")
                    else g.eq(0).attr("class", "reduce")
                } else {
                    if (l <= i) {
                        g.eq(0).attr("class", "no_reduce");
                        g.eq(1).attr("class", "add")
                    } else {
                        g.eq(0).attr("class", "reduce");
                        g.eq(1).attr("class", "add")
                    }
                }
            }, 50)
        }).trigger("input propertychange").blur(function() {
            $(this).trigger("input propertychange")
        }).keydown(function(l) {
            if (l.keyCode == 38 || l.keyCode == 40) {
                var j = 0;
                l.keyCode == 40 && (j = 1);
                g.eq(j).trigger("click")
            }
        });
        g.bind("click", function(l) {
            if (!$(this).hasClass("no_reduce")) {
                var j = parseInt(h.val(), 10) || 1;
                if ($(this).hasClass("add") && !$(this).hasClass("no_add")) {
                    $(this).prev().prev().attr("class", "reduce");
                    if (f > i && j >= f) {
                        $(this).attr("class", "no_add")
                    } else {
                        j++;
                        edit_num(id, j, o);
                    }
                } else {
                    if ($(this).hasClass("reduce") && !$(this).hasClass("no_reduce")) {
                        j--;
                        edit_num(id, j, o);
                        $(this).next().next().attr("class", "add");
                        j <= i && $(this).attr("class", "no_reduce")
                    }
                }
                h.val(j)
            }
        })
    });

    function edit_num(id, num, obj) {
        $.ajax({
            type:'post',
            url:SITE_URL + "?ctl=Buyer_Cart&met=editCartNum&typ=json",
            data:{cart_id:id,num:num},
            dataType:'json',
            success:function(result){
                if(result.status == 200){
                    $('.cell' + id + ' span').html((Number(result.data.price).toFixed(2)));
                    if (result.data.unit_price > 0) {
                        $('.np' + id).html((Number(result.data.unit_price).toFixed(2)));
                    }

                    if (result.data.bl == '1') {
                        //套装 Zhenzh
                        $('.bl' + id).each(function(i, v) {
                            var _data = $(this).attr('data-param');
                            var p = eval("data_str = " + _data); //各个商品的单价
                            var total_price = (Number(p.price) * Number(num)).toFixed(2);

                            $(v).find(".goods_num").html(num.toString());
                            $(v).find(".price_all").html("<span class='subtotal'>" + total_price + "</span>");
                        });
                    }
                    count();
                }
            }
        });
    }

    $('.del a').click(function() {
        var e = $(this);
        var data_str = e.attr('data-param');
        eval("data_str = " + data_str);
        $.dialog({
            title: '删除',
            content: '您确定要删除吗？',
            height: 100,
            width: 410,
            lock: true,
            drag: false,
            ok: function() {
                $.post(SITE_URL + '?ctl=' + data_str.ctl + '&met=' + data_str.met + '&typ=json', {
                    id: data_str.id
                }, function(data) {
                    console.info(data);
                    if (data && 200 == data.status) {
                        //$.dialog.alert('删除成功');
                        Public.tips.success('删除成功!');
                        e.parents('tr').hide('slow', function() {
                            var row_count = $('#table_list').find('.row_line:visible').length;
                            if (row_count <= 0) {
                                $('#list_norecord').show();
                            }
                        });
                        window.location.reload(); //刷新当前页
                    } else {
                        //$.dialog.alert('删除失败');
                        Public.tips.error('删除失败!');
                    }
                });
            }
        })
    });

    //付款按钮
    $('.submit-btn').click(function() {

        //获取所有选中的商品id
        var chk_value = []; //定义一个数组
        $("input[name='product_id[]']:checked").each(function() {
            //将选中的值添加到数组chk_value中
            chk_value.push($(this).val());
        });

        if (chk_value != "") {
            $("#form").attr('action', '?ctl=Buyer_Cart&met=confirm&product_id=' + chk_value);
            $('#form').submit();
        }

    });

    function changeURLPar(destiny, par, par_value) {
        var pattern = par + '=([^&]*)';
        var replaceText = par + '=' + par_value;
        if (destiny.match(pattern)) {
            var tmp = new RegExp(pattern);
            tmp = destiny.replace(tmp, replaceText);
            return (tmp);
        } else {
            if (destiny.match('[\?]')) {
                return destiny + '&' + replaceText;
            } else {
                return destiny + '?' + replaceText;
            }


        }
        return destiny + '\n' + par + '\n' + par_value;
    }

    window.addAddress = function(val) {
        //地址中的参数
        var params = window.location.search;
        params = changeURLPar(params, 'address_id', val.user_address_id);
        window.location.href = SITE_URL + params;

        if (val.user_address_default == 1) {
            def = 'add_choose';

            $(".add_choose").removeClass("add_choose");
        } else {
            def = '';
        }
        str = '<li class=" ' + def + ' " id="addr' + val.user_address_id + ' "><div class="editbox"><a onclick="edit_address( ' + val.user_address_id + ' )">编辑</a> <a onclick="del_address( ' + val.user_address_id + ' )">删除</a></div><h5> ' + val.user_address_contact + ' </h5><p> ' + val.user_address_area + ' ' + val.user_address_address + ' </p><div><span class="phone"><i class="iconfont">&#xe64c;</i><span> ' + val.user_address_phone + ' </span></span></div></li>';

        $("#address_list").append(str);

        //location.reload();
    }

    window.editAddress = function(val) {
        area = val.user_address_area + ' ' + val.user_address_address;
        $("#addr" + val.user_address_id).find("h5").html(val.user_address_contact);
        $("#addr" + val.user_address_id).find("p").html(area);
        $("#addr" + val.user_address_id).find(".phone").find("span").html(val.user_address_phone);

        history.go(0);
    };

    window.addInvoice = function(state, title, con, id) {
        str = state + ' ' + title + ' ' + con;
        $(".mr10").html(str);
        $("input[name='invoice_id']").val(id);
    }

    //删除收货地址
    $(".del_address").click(function(event) {
        var id = $(this).attr('data_id');
        $.dialog({
            title: '删除',
            content: '您确定要删除吗？',
            height: 100,
            width: 410,
            lock: true,
            drag: false,
            ok: function() {
                $.post(SITE_URL + '?ctl=Buyer_User&met=delAddress&typ=json', {
                    id: id
                }, function(data) {
                    console.info(data);
                    if (data && 200 == data.status) {
                        Public.tips.success('删除成功!');
                        $("#addr" + id).hide('slow');
                    } else {
                        Public.tips.error('删除失败!');
                    }
                });
            }
        })

        if (event && event.stopPropagation) {
            event.stopPropagation();
        } else {
            event.cancelBubble = true;
        }
    });

    //编辑收货地址
    $(".edit_address").click(function(event) {
        url = SITE_URL + "?ctl=Buyer_Cart&met=resetAddress&id=" + $(this).attr('data_id');

        $.dialog({
            title: '修改地址',
            content: 'url: ' + url,
            height: 340,
            width: 580,
            lock: true,
            drag: false

        });

        if (event && event.stopPropagation) {
            event.stopPropagation();
        } else {
            event.cancelBubble = true;
        }
    });

    //去付款按钮（生成订单）
    $("#pay_btn").click(function() {

        if ($(".total").html() >= 99999999.99) {
            Public.tips.error('订单金额过大，请分批购买！');
            return false;
        }

        //1.获取收货地址
        address_id = $(".add_choose").find("#address_id").val();
        address_contact = $(".add_choose").find("h5").html();
        address_address = $(".add_choose").find("p").html();
        address_phone = $(".add_choose").find(".phone").find("span").html();

        if ( typeof (address_id) == 'undefined' || !address_id) {
            Public.tips.error('请填写收货地址！');
            return false;
        }

        //判断是否存在超出配送范围的商品
        if (!buy_able) {
            Public.tips.error('有部分商品配送范围无法覆盖您选择的地址，请更换其它商品 ！');
            return false;
        }

        //2.获取发票信息
        invoice = $(".invoice-cont").find(".mr10").html();
        invoice_id = $("input[name='invoice_id']").val();

        //3.获取商品信息（商品id，商品备注）
        var cart_id = []; //定义一个数组
        $("input[name='cart_id']").each(function() {
            cart_id.push($(this).val()); //将值添加到数组中
        });

        var remark = [];
        var shop_id = [];
        $("input[name='remarks']").each(function() {
            shop_id.push($(this).attr("id"));
            remark.push($(this).val()); //将值添加到数组中
        });

        //加价购的商品
        var increase_goods_id = [];
        $(".increase_list").each(function() {
            if ($(this).is('.checked')) {
                increase_goods_id.push($(this).find("#redemp_goods_id").val());
            }
        })

        //代金券信息
        var voucher_id = [];
        $(".voucher_list").each(function() {
            if ($(this).is(".checked")) {
                voucher_id.push($(this).find("#voucher_id").val());
            }
        })

        //优惠券信息
        var rpt_info = '';
        var rpt = 0;
        if ($('#rpt').length > 0) {
            rpt_info = $('#rpt').val().split('|');
        }
        if (rpt_info) {
            rpt = rpt_info[0];
        }

        //获取支付方式
        pay_way_id = $(".pay-selected").attr('pay_id');

        var share_price_id_value = []; //定义一个数组
        $("input[name='share_price_id[]']").each(function() {
            share_price_id_value.push($(this).val()); //将选中的值添加到数组chk_value中
        });


        $("body").css("overflow", "hidden");
        $("#mask_box").show();
        $.ajax({
            type: "POST",
            url: SITE_URL + '?ctl=Buyer_Order&met=addOrder&typ=json',
            data: {
                receiver_name: address_contact,
                receiver_address: address_address,
                receiver_phone: address_phone,
                invoice: invoice,
                invoice_id: invoice_id,
                cart_id: cart_id,
                shop_id: shop_id,
                remark: remark,
                increase_goods_id: increase_goods_id,
                voucher_id: voucher_id,
                rpt: rpt,
                pay_way_id: pay_way_id,
                address_id: address_id,
                from: 'pc',
                share_price_id_value: share_price_id_value
            },
            dataType: "json",
            contentType: "application/json;charset=utf-8",
            async: false,
            success: function(a) {
                if (a.status == 200) {
                    if (pay_way_id == 1) {
                        window.location.href = PAYCENTER_URL + "?ctl=Info&met=pay&uorder=" + a.data.uorder + "&from_app_id=" + app_id;
                        return false;
                    } else {
                        window.location.href = SITE_URL + '?ctl=Buyer_Order&met=physical';
                        return false;
                    }
                }else if(a.status == 210){
                    window.location.href = SITE_URL + '?ctl=Buyer_Order&met=physical';
                    return false;
                }else {
                    if (a.msg) {
                        Public.tips.error(a.msg);
                    } else {
                        Public.tips.error('订单提交失败！');
                    }
                    $('#mask_box').hide();
                    $("body").css("overflow", "auto");
                }
            },
            failure: function(a) {
                Public.tips.error('操作失败！');
            }
        });

    });

    window.jiabuy = function(e) {

        limit = $(e).parents('.increase').find('#exc_goods_limit').val();
        shop_id = $(e).parents('.increase').find('#shop_id').val();
        param = $(e).data('param');

        if ($(e).is('.checked')) {
            $('.get_'+shop_id+'_'+param.increase_id).html('换购商品');
            $('.tbody'+shop_id+' tr.increase_item'+param.id).remove();

            clanRpt();

            $(e).removeClass('checked');
            $(e).parents('.increase_list').removeClass('checked');

            good_price = $(e).parents('.increase_list').find(".redemp_price").val();
            good_price_rate = $(e).parents('.increase_list').find(".redemp_price_rate").val();
            good_price_arate = Number(Number(good_price).toFixed(2) - Number(good_price_rate).toFixed(2)).toFixed(2);

            //商品减价
            goods_price = Number(Number($('.price' + shop_id).html()) * 1 - good_price * 1).toFixed(2);
            $('.price' + shop_id).html(goods_price);

            //店铺折扣减价
            shop_rate = Number(Number($('.shoprate' + shop_id).html()) * 1 - good_price_rate * 1).toFixed(2);
            $('.shoprate' + shop_id).html(shop_rate);

            //店铺减价
            shop_price = Number(Number($('.sprice' + shop_id).html()) * 1 - good_price_arate * 1).toFixed(2);
            $('.sprice' + shop_id).html(shop_price);

            //总会员折扣减价
            total_rate = Number(Number($('.rate_total').html()) - good_price_rate *1 ).toFixed(2);
            $('.rate_total').html(total_rate);

            //总价减价
            total_price = Number(Number($('.total').html()) * 1 - good_price_arate * 1).toFixed(2);
            after_total = Number($('.after_total').html());

            $('.total').html(total_price);
            $(".after_total").html((after_total - good_price_arate * 1).toFixed(2));

            //修改订单金额后需要修改平台红包
            iniRpt(after_total.toFixed(2));
            $('#orderRpt').html('0.00');
        } else {
            //计算已经选择了加价购商品
            num = $(e).parents('.increase').children(".increase_list").find('.checked').length;

            if (limit <= 0 || (limit > 0 && num < limit)) {
                //选择加价购后添加进订单列表
                $('.get_'+shop_id+'_'+ param.increase_id).html('重新换购');
                var increase_goods_param = {};
                increase_goods_param.id = param.id;
                increase_goods_param.name = param.name;
                increase_goods_param.price = param.price;
                increase_goods_param.image = param.image;
                increase_goods_param.spec = param.spec;
                var h = $('#increase-goods-tpl').html();
                h = h.replace(/__(\w+)/g, function(r, $1) {
                    return increase_goods_param[$1];
                });
                var $h = $(h);
                $h.find('img[data-src]').each(function() {
                    this.src = $(this).attr('data-src');
                });
                $('.tbody'+shop_id).append($h);

                clanRpt();

                $(e).addClass('checked');
                $(e).parents('.increase_list').addClass('checked');

                good_price = $(e).parents('.increase_list').find(".redemp_price").val();
                good_price_rate = $(e).parents('.increase_list').find(".redemp_price_rate").val();
                good_price_arate = Number(Number(good_price).toFixed(2) - Number(good_price_rate).toFixed(2)).toFixed(2);

                //商品金额
                goods_price = Number(Number($('.price' + shop_id).html()) * 1 + good_price * 1).toFixed(2);
                $('.price' + shop_id).html(goods_price);

                //店铺折扣减价
                shop_rate = Number(Number($('.shoprate' + shop_id).html()) * 1 + good_price_rate * 1).toFixed(2);
                $('.shoprate' + shop_id).html(shop_rate);

                //本店合计
                shop_price = Number(Number($('.sprice' + shop_id).html()) * 1 + good_price_arate * 1).toFixed(2);
                $('.sprice' + shop_id).html(shop_price);

                //总会员折扣减价
                //total_rate = Number(Number($('.rate_total').html()) + good_price_rate * 1).toFixed(2);
                //$('.rate_total').html(total_rate);

                //总价加价
                total_price = Number(Number($('.total').html()) * 1 + good_price_arate * 1).toFixed(2);
                $('.total').html(total_price);

                after_total = Number(Number($('.after_total').html()) * 1 + good_price_arate * 1).toFixed(2);
                $(".after_total").html(after_total);

                //修改订单金额后需要修改平台红包
                iniRpt(after_total);
                $('#orderRpt').html('0.00');
            }
        }
    }

    window.useVoucher = function(e) {
        shop_id = $(e).parent().find('#shop_id').val();

        //选择代金券 计算价格之前 获取到之前选择的代金券
        var checked_v_p = 0;//之前选择的代金券金额
        var checked_v_prate = 0;//之前选择的代金券金额
        var checked_v = $(e).parents(".voucher").find(".voucher_list.checked");
        if(checked_v){
            if(checked_v.find("#voucher_price").val()){
                checked_v_p = checked_v.find("#voucher_price").val();
            }
            if(checked_v.find("#voucher_price_rate").val()){
                checked_v_prate = checked_v.find("#voucher_price_rate").val();
            }
        }
        checked_v_arate = Number(checked_v_p).toFixed(2) - Number(checked_v_prate).toFixed(2);

        //获取本代金券的价值
        voucher_price = $(e).parent().find("#voucher_price").val();
        voucher_price_rate = $(e).parent().find("#voucher_price_rate").val();
        voucher_price_arate = Number(Number(voucher_price).toFixed(2) - Number(voucher_price_rate).toFixed(2)).toFixed(2);

        clanRpt();//选择代金券后 清除平台红包选择

        if ($(e).is('.checked')) {

            $(e).removeClass("checked");
            $(e).parents('.voucher_list').removeClass('checked');

            //删除代金券信息
            $(".shop_voucher" + shop_id +" .voucher" + shop_id).html('');
            $(".shop_voucher" + shop_id).hide();

            //店铺折扣减价
            shop_rate = Number(Number($('.shoprate' + shop_id).html()) * 1 + voucher_price_rate * 1).toFixed(2);
            $('.shoprate' + shop_id).html(shop_rate);

            //店铺合计
            shop_price = Number(Number($('.sprice' + shop_id).html())*1+voucher_price_arate*1).toFixed(2);
            $('.sprice' + shop_id).html(shop_price);

            total_price = Number(Number($('.total').html())*1+voucher_price_arate*1).toFixed(2);
            after_total = Number($('.after_total').html());
            $('.total').html(total_price);
            $(".after_total").html((after_total + voucher_price_arate*1).toFixed(2));
        } else {

            $(e).parents(".voucher").find(".checked").removeClass("checked");
            $(e).addClass("checked");
            $(e).parents('.voucher_list').addClass('checked');

            //显示代金券信息
            $(".shop_voucher" + shop_id +" .voucher" + shop_id).html("-￥"+getFloatStr(voucher_price));
            $(".shop_voucher" + shop_id).show();

            //店铺折扣减价
            shop_rate = Number(Number($('.shoprate' + shop_id).html()) * 1 + checked_v_prate*1 - voucher_price_rate * 1).toFixed(2);
            $('.shoprate' + shop_id).html(shop_rate);

            //本店合计
            shop_price = Number(Number($('.sprice' + shop_id).html())*1 + checked_v_arate*1 - voucher_price_arate*1).toFixed(2);
            $('.sprice' + shop_id).html(shop_price);

            //订单金额
            total_price = Number(Number($('.total').html())*1 + checked_v_arate*1 - voucher_price_arate*1).toFixed(2);
            $('.total').html(total_price);

            //支付金额
            after_total = (Number($('.after_total').html()) + checked_v_arate*1 - voucher_price_arate*1).toFixed(2);
            $(".after_total").html(after_total);
        }

        iniRpt(after_total);
        $('#orderRpt').html('0.00');
    }

    window.getVoucher = function(e) {
        if(!e.hasClass('taken')){
            tid = e.attr('data-tid');
            $.ajax({
                type:'post',
                url:SITE_URL+"?ctl=Voucher&met=receiveVoucher&typ=json",
                data:{vid:tid},
                dataType:'json',
                success:function(result){
                    var skin = 'green';
                    var msg = '';
                    if(result.status == 200){
                        e.addClass('taken');
                        if(result.data['voucher_t_points'] > 0){
                            msg = '兑换成功';
                            e.html('已兑');
                        }else {
                            msg = '领取成功';
                            e.html('已领');
                        }
                        Public.tips.success(msg);
                    }else{
                        skin = 'red';
                        if(result.msg){
                            msg = result.msg;
                        }else {
                            msg = '失败!'
                        }
                        Public.tips.error(msg);
                    }
                }
            });
        }
    }

    //10 自动补全10.00
    var getFloatStr = function(num){
        num += '';
        num = num.replace(/[^0-9|\.]/g, ''); //清除字符串中的非数字非.字符
        if(/^0+/) //清除字符串开头的0
            num = num.replace(/^0+/, '');
        if(!/\./.test(num)) //为整数字符串在末尾添加.00
            num += '.00';
        if(/^\./.test(num)) //字符以.开头时,在开头添加0
            num = '0' + num;
        num += '00';        //在字符串末尾补零
        return num.match(/\d+\.\d{2}/)[0];
    };

    //选择支付方式
    $(".pay_way").click(function() {
        $(this).parent().find(".pay-selected").removeClass("pay-selected");
        $(this).addClass("pay-selected");
    })

})