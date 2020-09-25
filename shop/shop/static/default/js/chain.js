/**
 * @author     zcg
 */
$(document).ready(function() {

    window.get = function(e) {
        $(e).parent().parent().parent().find(".sale_detail").show();
    };

    window.showVoucher = function(e) {
        $(e).parent().parent().parent().find(".voucher_detail").show();
    };

    $(".bk").click(function() {
        $(this).parent().parent().hide();
    });

    function getTransport() {
        var address = $(".add_choose").find('p').html();
        var cart_id = []; //定义一个数组
        $("input[name='cart_id']").each(function() {
            cart_id.push($(this).val()); //将值添加到数组中
        });

        $.post(SITE_URL + '?ctl=Seller_Transport&met=getTransportCost&typ=json', {
            address: address,
            cart_id: cart_id
        }, function(data) {
            console.info(data);
            if (data && 200 == data.status) {
                $.each(data.data, function(key, val) {
                    $(".trancon" + key).html(val.con);
                    $(".trancost" + key).html(val.cost.toFixed(2));

                    //计算店铺合计
                    $(".sprice" + key).html(($(".price" + key).html() * 1 + val.cost * 1).toFixed(2));
                });

                //计算订单中金额
                var total = 0;
                $(".dian_total i").each(function() {
                    total += $(this).html() * 1;
                });
                $(".total").html(total.toFixed(2));
                //$(".rate_total").html((total*rate/100).toFixed(2));

            }
        });

    }
    var c = $(".goods_num");
    var e = null;
    c.each(function() {
        var g = $(this).find("a"); //添加减少按钮
        var h = $(this).find("input#nums"); //当前商品数量
        var o = this;
        var f = h.attr("data-max"); //最大值 - 库存
        var i = 1;
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
    })

    function edit_num(id, num, obj) {
        gprice = $("#goods_price").val();
        price = gprice * num;
        $('.cell' + id + ' span').html((Number(price).toFixed(2)));
        $(".subtotal_all").html(Number(price).toFixed(2));
    }


    //付款按钮
    $('.submit-btn').click(function() {
        $('#form').submit();
    });

    //验证手机号
    window.checkmobile = function() {
        var value = $("#mob_phone").val();
        var errorFlag = false;
        var errorMessage = "";
        var reg = /^(\+\d{2,3}\-)?\d{11}$/;
        if (value != '') {
            if (!reg.test(value)) {
                errorFlag = true;
                errorMessage = "手机号码格式不正确";
            }
        } else {
            errorFlag = true;
            errorMessage = "请输入手机号码";
        }
        return errorMessage

    }


    //加价购的商品
    var increase_goods_id = [];
    $(".increase_list").each(function() {
        if ($(this).is('.checked')) {
            increase_goods_id.push($(this).find("#redemp_goods_id").val());
        }
    })

    //去付款按钮（生成订单）
    $("#pay_btn").click(function() {
        //获取手机号码
        mob_phone = $("#mob_phone").val();
        flag = checkmobile();

        if (flag) {
            Public.tips.error(flag);
            return false;
        }

        //2.获取收货人
        true_name = $("#true_name").val();
        if (!true_name) {
            Public.tips.error('请填写收货人');
            return false;
        }
        //3.获取商品信息（商品id，商品备注）
        goods_id = $("#goods_id").val();
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

        //获取支付方式
        pay_way_id = $(".pay-selected").attr('pay_id');

        //门店信息
        var chain_id = $("#chain_id").val();
        //获取商品留言
        remarks = $("#goodsremarks").val();

        $("body").css("overflow", "hidden");
        $("#mask_box").show();

        $.ajax({
            type: "POST",
            url: SITE_URL + '?ctl=Buyer_Order&met=addChainOrder&typ=json',
            data: {
                mob_phone: mob_phone,
                true_name: true_name,
                goods_id: goods_id,
                chain_id: chain_id,
                increase_goods_id: increase_goods_id,
                voucher_id: voucher_id,
                pay_way_id: pay_way_id,
                remarks: remarks
            },
            dataType: "json",
            contentType: "application/json;charset=utf-8",
            async: false,
            success: function(a) {
                console.info(a);
                if (a.status == 200) {

                    if (pay_way_id == 1) {
                        window.location.href = PAYCENTER_URL + "?ctl=Info&met=pay&uorder=" + a.data.uorder;
                        return false;
                    } else {
                        window.location.href = SITE_URL + '?ctl=Buyer_Order&met=chain';
                        return false;
                    }
                } else {
                    if (a.msg != 'failure') {
                        Public.tips.error(a.msg);
                    } else {
                        Public.tips.error('订单提交失败！');
                    }

                    //alert('订单提交失败');
                }
            },
            failure: function(a) {
                Public.tips.error('操作失败！');
                //$.dialog.alert("操作失败！");
            }
        });

    });

    window.jiabuy = function(e) {

        limit = $(e).parents('.increase').find('#exc_goods_limit').val();
        shop_id = $(e).parents('.increase').find('#shop_id').val();
        param = $(e).data('param');

        if ($(e).is('.checked')) {
            $('.get_'+shop_id+'_'+param.increase_id).html('换购商品');
            $('.rel_good_infor'+' tr.increase_item'+param.id).remove();

            $(e).removeClass('checked');
            $(e).parents('.increase_list').removeClass('checked');

            good_price = $(e).parents('.increase_list').find(".redemp_price").val();
            good_price_rate = $(e).parents('.increase_list').find(".redemp_price_rate").val();
            good_price_arate = Number(Number(good_price).toFixed(2) - Number(good_price_rate).toFixed(2)).toFixed(2);

            //总会员折扣减价
            total_rate = Number(Number($('.rate_total').html()) - good_price_rate *1 ).toFixed(2);
            $('.rate_total').html(total_rate);

            //总价减价
            total_price = Number(Number($('.total').html()) * 1 - good_price * 1).toFixed(2);
            $('.total').html(total_price);

            after_total = Number($('.after_total').html());
            $(".after_total").html((after_total - good_price_arate * 1).toFixed(2));

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
                $('.rel_good_infor').append($h);

                $(e).addClass('checked');
                $(e).parents('.increase_list').addClass('checked');

                good_price = $(e).parents('.increase_list').find(".redemp_price").val();
                good_price_rate = $(e).parents('.increase_list').find(".redemp_price_rate").val();
                good_price_arate = Number(Number(good_price).toFixed(2) - Number(good_price_rate).toFixed(2)).toFixed(2);

                //折扣减价
                shop_rate = Number(Number($('.rate_total').html()) * 1 + good_price_rate * 1).toFixed(2);
                $('.rate_total').html(shop_rate);

                //总价加价
                total_price = Number(Number($('.total').html()) * 1 + good_price * 1).toFixed(2);
                $('.total').html(total_price);

                after_total = Number(Number($('.after_total').html()) * 1 + good_price_arate * 1).toFixed(2);
                $(".after_total").html(after_total);

            }
        }
    };

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

        if ($(e).is('.checked')) {

            $(e).removeClass("checked");
            $(e).parents('.voucher_list').removeClass('checked');

            //隐藏代金券信息
            $(".shop_voucher" +shop_id+" .voucher"+shop_id).html('');
            $(".shop_voucher"+shop_id).hide();

            //店铺折扣减价
            shop_rate = Number(Number($('.rate_total').html()) * 1 + voucher_price_rate * 1).toFixed(2);
            $('.rate_total').html(shop_rate);

            after_total = Number($('.after_total').html());
            $(".after_total").html((after_total + voucher_price_arate*1).toFixed(2));
        } else {

            $(e).parents(".voucher").find(".checked").removeClass("checked");
            $(e).addClass("checked");
            $(e).parents('.voucher_list').addClass('checked');

            //显示代金券信息
            $(".shop_voucher" +shop_id+" .voucher"+shop_id).html("-￥"+getFloatStr(voucher_price));
            $(".shop_voucher"+shop_id).show();

            //店铺折扣减价
            shop_rate = Number(Number($('.rate_total').html()) * 1 + checked_v_prate*1 - voucher_price_rate * 1).toFixed(2);
            $('.rate_total').html(shop_rate);

            //支付金额
            after_total = Number($('.after_total').html());
            $(".after_total").html((after_total + checked_v_arate*1 - voucher_price_arate*1).toFixed(2));
        }
    }


    //选择支付方式
    $(".pay_way").click(function() {
        $(this).parent().find(".pay-selected").removeClass("pay-selected");
        $(this).addClass("pay-selected");
    })

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

})