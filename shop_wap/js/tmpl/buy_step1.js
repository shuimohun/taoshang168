var key = getCookie('key');
// buy_stop2使用变量
var ifcart = getQueryString('ifcart');
if (ifcart == 1) {
    var cart_id = getQueryString('cart_id');
    cart_id = cart_id.split(',');
} else {
    var cart_id = getQueryString("goods_id") + '|' + getQueryString("buynum");
}
var pay_name = 'online';
var invoice_id = 0;
var address_id, vat_hash, offpay_hash, offpay_hash_batch, voucher, pd_pay, password, fcode = '',rcb_pay, rpt, payment_code;
var message = {};
// change_address 使用变量
var freight_hash, city_id, area_id, province_id;
// 其他变量
var area_info;
var goods_id;
var buy_able;

function isEmptyObject(e) {
    var t;
    for (t in e)
        return !1;
    return !0
}

$(function() {

    var isIntegral = getQueryString("isIntegral");

    // 地址列表
    $('#list-address-valve').click(function() {
        var address_id = $(this).find("#address_id").val();
        $.ajax({
            type: 'post',
            url: ApiUrl + "/index.php?ctl=Buyer_Cart&met=confirm&typ=json",
            data: {
                k: key,
                u: getCookie('id'),
                product_id: cart_id
            },
            dataType: 'json',
            async: false,
            success: function(result) {
                checkLogin(result.login);
                if (result.data.address == null) {
                    return false;
                }
                //console.info(result);
                var data = result.data;
                data.address_id = address_id;
                var html = template.render('list-address-add-list-script', data);
                $("#list-address-add-list-ul").html(html);
            }
        });
    });
    $.animationLeft({
        valve: '#list-address-valve',
        wrapper: '#list-address-wrapper',
        scroll: '#list-address-scroll'
    });

    // 地区选择
    $('#list-address-add-list-ul').on('click', 'li', function() {
        $(this).addClass('selected').siblings().removeClass('selected');
        eval('address_info = ' + $(this).attr('data-param'));
        _init(address_info.user_address_id);
        //console.info(address_info);
        $('#true_name').html(address_info.user_address_contact);
        $('#mob_phone').html(address_info.user_address_phone);
        $('#address').html(address_info.user_address_area + address_info.user_address_address);
        $("#address_id").val(address_info.user_address_id);
        $('#list-address-wrapper').find('.header-l > a').click();
    });

    // 地址新增
    $.animationLeft({
        valve: '#new-address-valve',
        wrapper: '#new-address-wrapper',
        scroll: ''
    });

    // 支付方式
    /*$.animationLeft({
        valve: '#select-payment-valve',
        wrapper: '#select-payment-wrapper',
        scroll: ''
    });*/

    // 地区选择
    $('#new-address-wrapper').on('click', '#varea_info', function() {

        $.areaSelected({
            success: function(data) {
                //console.info(data);
                province_id = data.area_id_1;
                city_id = data.area_id_2;
                area_id = data.area_id_3;
                area_info = data.area_info;
                $('#varea_info').val(data.area_info);
            }
        });
    });

    //增值税发票中的地区选择
    $('#invoice-list').on('click', '#invoice_area_info', function() {
        $.areaSelected({
            success: function(a) {
                $("#invoice_area_info").val(a.area_info).attr({
                    "data-areaid1": a.area_id_1,
                    "data-areaid2": a.area_id_2,
                    "data-areaid3": a.area_id_3,
                    "data-areaid": a.area_id,
                    "data-areaid2": a.area_id_2 == 0 ? a.area_id_1 : a.area_id_2
                })
            }
        });
    });

    // 发票
    $.animationLeft({
        valve: '#invoice-valve',
        wrapper: '#invoice-wrapper',
        scroll: ''
    });

    template.helper('isEmpty', function(o) {
        var b = true;
        $.each(o, function(k, v) {
            b = false;
            return false;
        });
        return b;
    });

    template.helper('pf', function(o) {
        return parseFloat(o) || 0;
    });

    template.helper('p2f', function(o) {
        return (parseFloat(o) || 0).toFixed(2);
    });


    var _init = function(address_id) {

        // 购买第一步 提交
        $.ajax({ //提交订单信息
            type: 'post',
            url: ApiUrl + '/index.php?ctl=Buyer_Cart&met=confirm&typ=json',
            dataType: 'json',
            data: {
                k: key,
                u: getCookie('id'),
                product_id: cart_id,
                ifcart: ifcart,
                address_id: address_id
            },
            success: function(result) {
                if (result.status == 250) {
                    $.sDialog({
                        skin: "red",
                        content: result.data.msg,
                        okBtn: false,
                        cancelBtn: false
                    });
                    return false;
                }

                if (result.data.user_rate == 0) {
                    result.data.user_rate = 100;
                }

                // 商品数据
                result.data.address_id = address_id;
                result.data.WapSiteUrl = WapSiteUrl;
                delete result.data.count;
                var html = template.render('goods_list', result.data);
                $("#deposit").html(html);

                buy_able = result.data.buy_able;
                var  inid;
                for (var i in result.data.glist) {
                    $.animationUp({
                        valve: '.animation-up' + i,
                        // 动作触发，为空直接触发
                        wrapper: '.nctouch-bottom-mask' + i,
                        // 动作块
                        scroll: '.nctouch-bottom-mask-rolling' + i,
                        // 滚动块，为空不触发滚动
                    });
                    window.get = function(e) {

                        inid = $(e).attr('data-inid');
                        $('.nctouch-bottom-mask1'+i+'_'+$(e).attr('data-inid')).toggleClass('up');

                        $.animationUp({

                            valve: '.animation-hg' +inid,
                            // 动作触发，为空直接触发   +$('.animation-hg'+i).attr('data-inid')
                            wrapper: '.nctouch-bottom-mask1' + i + '_'+inid,
                            // 动作块
                            scroll: '.nctouch-bottom-mask-rolling' + i + '_'+inid,
                            // 滚动块，为空不触发滚动
                        });

                    }



                }

                // 默认地区相关
                if ($.isEmptyObject(result.data.address)) {
                    $.sDialog({
                        skin: "block",
                        content: '请添加地址',
                        okFn: function() {
                            $('#new-address-valve').click();
                        },
                        cancelFn: function() {
                            history.go(-1);
                        }
                    });
                    return false;
                }

                /*if (typeof(result.datas.inv_info.inv_id) != 'undefined') {
                 invoice_id = result.datas.inv_info.inv_id;
                 }
                 // 发票
                 $('#invContent').html(result.datas.inv_info.content);
                 vat_hash = result.datas.vat_hash;
                 freight_hash = result.datas.freight_hash;*/
                // 输入地址数据
                insertHtmlAddress(result.data.address, address_id);

                // 代金券
                voucher_temp = [];
                for (var k in result.data.glist.voucher_base) {
                    voucher_temp.push([result.data.glist.voucher_base[k].voucher_t_id + '|' + k + '|' + result.data.glist.voucher_base[k].voucher_price]);
                }
                voucher = voucher_temp.join(',');
                total_price = 0;
                for (var k in result.data.glist) {

                    //会员折扣
                    rate_price = 0;
                    if(result.data.glist[k].rate_price){
                        rate_price = result.data.glist[k].rate_price;
                    }

                    //选取最优代金券
                    var voucher_price = 0;
                    var voucher_id = 0;
                    if (result.data.glist[k].voucher_base) {
                        for (var kv in result.data.glist[k].voucher_base) {
                            if (result.data.glist[k].voucher_base[kv].voucher_price > voucher_price) {
                                voucher_price = result.data.glist[k].voucher_base[kv].voucher_price;
                                voucher_id = result.data.glist[k].voucher_base[kv].voucher_id;
                            }
                        }
                    }

                    var ds = 0;
                    if (voucher_price > 0) {
                        voucher_arate = Number(voucher_price*result.data.glist[k].user_rate/100).toFixed(2);

                        if(rate_price > 0){
                            voucher_rate = voucher_price - voucher_arate;
                            rate_price = rate_price - voucher_rate;
                        }
                        ds = (result.data.glist[k].total_price - voucher_arate) * 1;

                        $('#vourchPrice' + k).html(Number(voucher_price).toFixed(2));
                        $('#vourchPrice' + k).data('arate',voucher_arate);
                        $('#voucher' + k).show();
                        $('#vourch_id' + k).val(voucher_id);
                        $('.voucher_' + k + '_' + voucher_id).addClass('checked');

                    }else{
                        ds = result.data.glist[k].total_price * 1;
                    }

                    if(rate_price > 0 ){
                        $('#ratePrice' + k).html(Number(rate_price).toFixed(2));
                        $('#rate' + k).show();
                    }

                    total_price += ds;

                    $('#storeTotal' + k).html(ds.toFixed(2));
                    //$('#storeFreight' + k).html(result.data.cost[k].cost);

                    // 留言
                    message[k] = '';
                    $('#storeMessage' + k).on('change', function() {
                        message[k] = $(this).val();
                    });
                }

                // 红包
                /*var rpt_price = 0;
                var rpt_id = 0;
                if (result.data.rpt_list) {
                    for(var j in result.data.rpt_list){
                        if(rpt_price < result.data.rpt_list[j].redpacket_price){
                            rpt_price = result.data.rpt_list[j].redpacket_price;
                            rpt_id = result.data.rpt_list[j].redpacket_id;
                            rpt_info = ((parseFloat(result.data.rpt_list[j].redpacket_t_orderlimit) > 0) ? '满' + parseFloat(result.data.rpt_list[j].redpacket_t_orderlimit).toFixed(2) + '元，': '') + '优惠' + parseFloat(result.data.rpt_list[j].redpacket_price).toFixed(2) + '元'
                            $('#rptInfo').html(rpt_info);
                            $('#rptVessel').show();
                        }
                    }
                } else {
                    $('#rptVessel').hide();
                }
                $('#useRPT').click(function(){
                    if ($(this).prop('checked')) {
                        //rpt = rpt_id + '|' +parseFloat(rpt_price);
                        rpt = rpt_id;
                        rptPrice = parseFloat(rpt_price);
                        total_price = result.data.total_price - rptPrice;
                    } else {
                        rpt = '';
                        total_price = result.data.total_price;
                    }
                    if (total_price <= 0) {
                        total_price = 0;
                    }
                    if (!isIntegral) {
                        $('#totalPayPrice').html(total_price.toFixed(2));
                    }
                });*/

                //total_price = result.data.total_price;

                $('#totalPrice,#onlineTotal').html(total_price.toFixed(2));
                if (!isIntegral) {
                    $('#totalPayPrice').html(total_price.toFixed(2));
                }

                $(".rate-money").show();
                password = '';

                $('.nctouch-voucher-list').on('click','.btn',function () {
                    if(!$(this).hasClass('checked')){
                        k = $(this).data('sid');
                        voucher_id = $(this).data('tid');
                        voucher_price = Number($(this).data('price'));
                        user_rate = Number($(this).data('user-rate'));
                        voucher_arate = Number(voucher_price*user_rate/100).toFixed(2);
                        voucher_rate = Number(voucher_price - voucher_arate);

                        checked_voucher_id = $('#vourch_id' + k).val();
                        checked_voucher_price = Number($('#vourchPrice' + k).html());
                        checked_voucher_arate = Number($('#vourchPrice' + k).data('arate'));
                        checked_v_rate = Number(checked_voucher_price - checked_voucher_arate);
                        storeTotal = Number($('#storeTotal' + k).html());

                        $('.voucher_' + k + '_' + checked_voucher_id).removeClass('checked');
                        $('#vourch_id' + k).val(voucher_id);
                        $('.voucher_' + k + '_' + voucher_id).addClass('checked');

                        $('#vourchPrice' + k).html(voucher_price.toFixed(2));
                        $('#storeTotal' + k).html(Number(storeTotal + checked_voucher_arate - voucher_arate).toFixed(2));

                        ratePrice = Number($('#ratePrice' + k).html());
                        ratePrice = Number(ratePrice + checked_v_rate - voucher_rate).toFixed(2);
                        $('#ratePrice' + k).html(ratePrice);
                        $('#vourchPrice' + k).data('arate',voucher_arate);

                        total_price = Number($('#totalPrice').html());
                        total_price = Number(total_price + checked_voucher_arate - voucher_arate).toFixed(2);
                        $('#totalPrice,#onlineTotal').html(total_price);
                        if (!isIntegral) {
                            $('#totalPayPrice').html(total_price);
                        }
                    }
                })

                $('.nctouch-voucher-list.increase').on('click','.btnn',function () {
                    var goods_data = $(this).attr('data-param');
                    eval( "goods_data = "+goods_data);
                    limit  = goods_data.limit;

                    if($(this).is('.checked')){
                        goods_price = $(this).parents('.increase_list').find(".redemp_price").val();
                        goods_price_rate = $(this).parents('.increase_list').find(".redemp_price_rate").val();
                        goods_price_arate = Number(Number(goods_price).toFixed(2) - Number(goods_price_rate).toFixed(2)).toFixed(2);
                        //商品金额
                        var monery = Number($('.monery'+i).html());
                        //本店合计
                        var storeTotal = Number($('#storeTotal'+i).html());

                        var ratePrice = Number($('#ratePrice'+i).html());


                        $('#b'+goods_data.id+'').remove();
                        $(this).removeClass('checked');
                        $(this).parents('.increase_list').removeClass('checkeds');

                        //商品金额
                        var gprice = Number(monery*1-goods_price*1).toFixed(2);
                        $('.monery'+i).html(gprice);

                        //会员折扣
                        shop_rate = Number(ratePrice*1-goods_price_rate*1).toFixed(2);
                        $('#ratePrice'+i).html(shop_rate);

                        //本店合计
                        var hjprice = Number(storeTotal*1-goods_price_arate*1).toFixed(2);
                        $('#storeTotal'+i).html(hjprice);

                        //总金额
                        $('#totalPrice').html(hjprice);
                        var topr = Number($('#totalPayPrice').html());
                        $("#totalPayPrice").html((topr*1-goods_price_arate*1).toFixed(2));


                    }else {

                        num = $(this).parents('.increase').children(".increase_list").find('.checked').length;

                        if(limit <= 0 || (limit > 0 && num < limit)) {

                            $(this).addClass('checked');
                            $(this).parents('.increase_list').addClass('checkeds');
                            var htm = '' +
                                '<li class="buy-item" id="b' + goods_data.id + '">'
                                + '<div class="goods-pic">'
                                + '<a href="<%=WapSiteUrl%>/tmpl/product_detail.html?goods_id=' + goods_data.id + '">'
                                + '<img src="' + goods_data.image + '"/>'
                                + '</a>'
                                + '</div>'
                                + '<dl class="goods-info">'
                                + '<dt class="goods-name">'
                                + '<a href="<%=WapSiteUrl%>/tmpl/product_detail.html?goods_id=' + goods_data.id + '">'
                                + ' ' + goods_data.name + '(换购) '
                                + '</a>'
                                + '</dt>'
                                + '</dl>'
                                + '<div class="goods-subtotal">'
                                + '<span class="goods-price">￥<em>' + goods_data.price + '</em></span>'
                                + '</div>'
                                + '<div class="goods-num"><em>1</em>件</div>'
                                + '</li>';
                            $('.nctouch-cart-item').append(htm);
                            //合计结算
                            // var goods_price = Number(goods_data.price);
                            // var gprice = Number(je+goods_price).toFixed(2);
                            //金额
                           //  $('.je'+i).html(gprice);
                           //  //合计结算
                           //  // alert(zk);
                           //  var hjprice = Number(goods_price+hj-zk);
                           //  $('#storeTotal'+i).html(hjprice);
                           //  $('#totalPrice,#totalPayPrice').html(hjprice);
                           //  // $('#ratePrice'+i).html(hy);
                           // //会晕折扣
                           //  var hy = Number(zk+hy).toFixed(2);
                           //  $('#ratePrice'+i).html(hy)

                            goods_price = $(this).parents('.increase_list').find(".redemp_price").val();
                            goods_price_rate = $(this).parents('.increase_list').find(".redemp_price_rate").val();
                            goods_price_arate = Number(Number(goods_price).toFixed(2) - Number(goods_price_rate).toFixed(2)).toFixed(2);
                            //商品金额
                            var monery = Number($('.monery'+i).html());
                            //本店合计
                            var storeTotal = Number($('#storeTotal'+i).html());

                            var ratePrice = Number($('#ratePrice'+i).html());

                            //商品金额
                            var gprice = Number(monery*1+goods_price*1).toFixed(2);
                            $('.monery'+i).html(gprice);

                            //会员折扣
                            shop_rate = Number(ratePrice*1+goods_price_rate*1).toFixed(2);
                            $('#ratePrice'+i).html(shop_rate);

                            //本店合计
                            var hjprice = Number(storeTotal*1+goods_price_arate*1).toFixed(2);
                            $('#storeTotal'+i).html(hjprice);

                            //总金额
                            total_price = Number(Number($('#totalPrice').html()) * 1 + goods_price_arate * 1).toFixed(2);
                            $('#totalPrice').html(total_price);

                            var topr = Number($('#totalPayPrice').html());
                            $("#totalPayPrice").html((topr*1+goods_price_arate*1).toFixed(2));
                        }
                    }
                })
            }
        });
    };

    // 初始化
    _init();

    // 插入地址数据到html
    var insertHtmlAddress = function(address, address_id) {
        var address_info = {};
        for (var i = 0; i < address.length; i++) {

            if (address_id != undefined) {
                if (address[i].user_address_id == address_id) {
                    //address_info.address_id = address[i].user_address_area_id;
                    address_info.address_id = address[i].user_address_id;
                    address_info.user_address_contact = address[i].user_address_contact;
                    address_info.provice_id = address[i].user_address_provice_id;
                    address_info.city_id = address[i].user_address_city_id;
                    address_info.area_id = address[i].user_address_area_id;
                    address_info.user_address_phone = address[i].user_address_phone;
                    address_info.user_address_area = address[i].user_address_area;
                    address_info.user_address_address = address[i].user_address_address;
                }
            } else {
                //初始判断有误，已更改  17/11/6
                if (address[i].user_address_default != '0' && address[i].user_address_default) {
                    //address_info.address_id = address[i].user_address_area_id;
                    address_info.address_id = address[i].user_address_id;
                    address_info.user_address_contact = address[i].user_address_contact;
                    address_info.provice_id = address[i].user_address_provice_id;
                    address_info.city_id = address[i].user_address_city_id;
                    address_info.area_id = address[i].user_address_area_id;
                    address_info.user_address_phone = address[i].user_address_phone;
                    address_info.user_address_area = address[i].user_address_area;
                    address_info.user_address_address = address[i].user_address_address;

                }
            }

        }
        if (!isEmptyObject(address_info)) {
            address_id = address_info.address_id;
            $('#true_name').html(address_info.user_address_contact);
            $('#mob_phone').html(address_info.user_address_phone);
            $('#address').html(address_info.user_address_area + address_info.user_address_address);
        } else {
            $('#address').html('未选择收货地址');
        }
        $("#address_id").val(address_id);
        area_id = address_info.area_id;
        city_id = address_info.city_id;
        province_id = address_info.provice_id;
        /*if (address_api.content) {
         for (var k in address_api.content) {
         $('#storeFreight' + k).html(parseFloat(address_api.content[k]).toFixed(2));
         }
         }
         offpay_hash = address_api.offpay_hash;
         offpay_hash_batch = address_api.offpay_hash_batch;
         if (address_api.allow_offpay == 1) {
         $('#payment-offline').show();
         }
         if (!$.isEmptyObject(address_api.no_send_tpl_ids)) {
         $('#ToBuyStep2').parent().removeClass('ok');
         for (var i=0; i<address_api.no_send_tpl_ids.length; i++) {
         $('.transportId' + address_api.no_send_tpl_ids[i]).show();
         }
         } else {

         }*/
        $('#ToBuyStep2').parent().addClass('ok');
    };

    // 支付方式选择
    // 在线支付
    $('#payment-online').click(function() {
        pay_name = 'online';
        $('#select-payment-wrapper').find('.header-l > a').click();
        $('#select-payment-valve').find('.current-con').html('在线支付');
        $("#pay-selected").val('1');
        $(this).addClass('sel').siblings().removeClass('sel');
    });
    // 货到付款
    $('#payment-offline').click(function() {
        pay_name = 'offline';
        $('#select-payment-wrapper').find('.header-l > a').click();
        $('#select-payment-valve').find('.current-con').html('货到付款');
        $("#pay-selected").val('2');
        $(this).addClass('sel').siblings().removeClass('sel');
    });

    // 地址保存
    $.sValid.init({
        rules: {
            vtrue_name: "required",
            vmob_phone: "required",
            varea_info: "required",
            vaddress: "required"
        },
        messages: {
            vtrue_name: "姓名必填！",
            vmob_phone: "手机号必填！",
            varea_info: "地区必填！",
            vaddress: "街道必填！"
        },
        callback: function(eId, eMsg, eRules) {
            if (eId.length > 0) {
                var errorHtml = "";
                $.map(eMsg, function(idx, item) {
                    errorHtml += "<p>" + idx + "</p>";
                });
                errorTipsShow(errorHtml);
            } else {
                errorTipsHide();
            }
        }
    });
    $('#add_address_form').find('.btn').click(function() {
        if ($.sValid()) {
            var param = {};
            param.k = key;
            param.user_address_contact = $('#vtrue_name').val();
            param.user_address_phone = $('#vmob_phone').val();
            param.user_address_address = $('#vaddress').val();
            param.address_area = $('#varea_info').val();
            param.province_id = province_id;
            param.city_id = city_id;
            param.area_id = area_id;

            param.user_address_default = 0;

            param.u = getCookie('id');

            $.ajax({
                type: 'post',
                url: ApiUrl + "/index.php?ctl=Buyer_User&met=addAddressInfo&typ=json",
                data: param,
                dataType: 'json',
                success: function(result) {
                    //console.info(result);
                    if (result.status == 200) {
                        //param.address_id = result.data.address_id;
                        _init(result.data.user_address_id);
                        $('#true_name').html(result.data.user_address_contact);
                        $('#mob_phone').html(result.data.user_address_phone);
                        $('#address').html(result.data.user_address_area + result.data.user_address_address);
                        $("#address_id").val(result.data.user_address_id);
                        $('#new-address-wrapper,#list-address-wrapper').find('.header-l > a').click();
                    }
                }
            });
        }
    });
    // 发票选择
    $('#invoice-noneed').click(function() {
        $(this).addClass('sel').siblings().removeClass('sel');
        $('#invoice_add,#invoice-list').hide();
        invoice_id = 0;
    });
    $('#invoice-need').click(function() {
        $(this).addClass('sel').siblings().removeClass('sel');
        $('#invoice_add,#invoice-list').show();

        html = '<option value="明细">明细</option>';
        $('#inc_content').append(html);
        //获取发票列表
        $.ajax({
            type: 'post',
            url: ApiUrl + '/index.php?ctl=Buyer_Cart&met=piao&typ=json',
            data: {
                k: key,
                u: getCookie('id')
            },
            dataType: 'json',
            success: function(result) {
                checkLogin(result.login);
                //console.info(result);
                //console.info(result.data);
                var html = template.render('invoice-list-script', result.data);
                $('#invoice-list').html(html)
                if (result.data.normal.length > 0) {
                    invoice_id = result.data.normal[0].invoice_id;
                }
            }
        });
    });
    // 发票类型选择
    $('input[name="inv_title_select"]').click(function() {
        //增值税发票
        if ($(this).val() == 'increment') {
            $('#invoice-list>#addtax').show();
            $('#invoice-list>#electron').hide();
            $('#invoice-list>#normal').hide();

        } //电子发票
        else if ($(this).val() == 'electronics') {
            $('#invoice-list>#electron').show();
            $('#invoice-list>#normal').hide();
            $('#invoice-list>#addtax').hide();
        } //普通发票
        else {
            $('#invoice-list>#normal').show();
            $('#invoice-list>#electron').hide();
            $('#invoice-list>#addtax').hide();
        }
    });

    $('#invoice-div').on('click', '#invoiceNew', function() {
        if ($(this).is(".checked")) {
            $(this).removeClass('checked');
            $('#invoice_normal_add').hide();

            title = $("#invoice_normal_add").find("input[name='inv_normal_add_title']").val();
            cont = $("#invoice_normal_add").find("#inv_normal_add_content").val();

            var data = {
                invoice_state: invoice_state,
                invoice_title: title,
                k: key,
                u: getCookie('id')
            };

            flag = add_invoice(data);
        } else {
            invoice_id = 0;
            $('#invoice_normal_add').show();
        }
    });

    $('#invoice-list').on('click', 'label', function() {
        invoice_id = $(this).find('input').val();
    });

    var add_invoice = function(e) {
        var result = "";
        $.ajax({
            type: 'post',
            url: ApiUrl + "?ctl=Buyer_Invoice&met=addInvoice&typ=json",
            data: e,
            dataType: "json",
            async: false,
            success: function(a) {
                result = a;
            }
        });
        return result;
    };

    // 发票添加
    $('#invoice-div').find('.btn-l').click(function() {
        //选择需要发表按钮
        if ($('#invoice-need').hasClass('sel')) {
            //判断选择的发票类型
            invoice_type = $('#invoice_type').find(".checked").find("input[name='inv_title_select']").attr('id');
            //普通发票
            if (invoice_type == 'norm') {
                //判断有没有新增的发票抬头
                invoice_state = 1;
                type = "普通发票";
                if ($('#invoiceNew').hasClass('checked')) {
                    title = $("#invoice_normal_add").find("input[name='inv_normal_add_title']").val();
                    cont = $("#invoice_normal_add").find("#inv_normal_add_content").val();

                    var data = {
                        invoice_state: invoice_state,
                        invoice_title: title,
                        k: key,
                        u: getCookie('id')
                    };

                    flag = add_invoice(data);
                } else {
                    title = $("#normal").find("#inc_normal_title").val();
                    cont = $("#normal").find("#inc_normal_content").val();
                    flag = {
                        status: 200,
                        data: {
                            invoice_id: ''
                        }
                    }
                }
            }

            //电子发票
            if (invoice_type == 'electronics') {
                //将电子发票保存到数据库
                type = '电子发票';
                title = $("#electron").find('.checked').find("input[name='inv_ele_title']").val();
                phone = $("#electron").find("input[name='inv_ele_phone']").val();
                email = $("#electron").find("input[name='inv_ele_email']").val();
                cont = $("#electron").find("#inc_content").val();
                var data = {
                    invoice_state: '2',
                    invoice_title: title,
                    invoice_rec_phone: phone,
                    invoice_rec_email: email,
                    k: key,
                    u: getCookie('id')
                };

                flag = add_invoice(data);
            }

            //增值税发票
            if (invoice_type == 'increment') {
                //将增值税发票保存到数库中
                type = '增值税发票';
                title = $("#addtax").find("input[name='inv_tax_title']").val();
                company = $("#addtax").find("input[name='inv_tax_title']").val();
                code = $("#addtax").find("input[name='inv_tax_code']").val();
                addr = $("#addtax").find("input[name='inv_tax_address']").val();
                phone = $("#addtax").find("input[name='inv_tax_phone']").val();;
                bname = $("#addtax").find("input[name='inv_tax_bank']").val();
                bcount = $("#addtax").find("input[name='inv_tax_bankaccount']").val();
                cname = $("#addtax").find("input[name='inv_tax_recname']").val();
                cphone = $("#addtax").find("input[name='inv_tax_recphone']").val();
                province = $("#addtax").find("input[name='invoice_tax_rec_province']").val();
                caddr = $("#addtax").find("input[name='inv_tax_rec_addr']").val();

                province_id = $("#addtax").find("input[name='invoice_tax_rec_province']").attr('data-areaid1');
                city_id = $("#addtax").find("input[name='invoice_tax_rec_province']").attr('data-areaid2');
                area_id = $("#addtax").find("input[name='invoice_tax_rec_province']").attr('data-areaid3');

                cont = $("#addtax").find("#inc_tax_content").val();
                var data = {
                    invoice_state: '3',
                    invoice_title: title,
                    invoice_company: company,
                    invoice_code: code,
                    invoice_reg_addr: addr,
                    invoice_reg_phone: phone,
                    invoice_reg_bname: bname,
                    invoice_reg_baccount: bcount,
                    invoice_rec_name: cname,
                    invoice_rec_phone: cphone,
                    invoice_rec_province: province,
                    invoice_province_id: province_id,
                    invoice_city_id: city_id,
                    invoice_area_id: area_id,
                    invoice_goto_addr: caddr,
                    k: key,
                    u: getCookie('id')
                };

                flag = add_invoice(data);
            }

            if (flag.status == 200) {
                $('#invContent').html(type + ' ' + title + ' ' + cont);
                $("input[name='invoice_id']").val(flag.data.invoice_id)
            } else {
                $.sDialog({
                    content: '操作失败',
                    okBtn: false,
                    cancelBtnText: '返回',
                    cancelFn: function() {}
                })
            }
        } else {
            $('#invContent').html('不需要发票');
        }
        $('#invoice-wrapper').find('.header-l > a').click();
    });

    // 支付
    $('#ToBuyStep2').click(function() {

        if (!buy_able) {
            $.sDialog({
                content: '有部分商品配送范围无法覆盖您选择的地址，请更换其它商品！',
                okBtn: false,
                cancelBtnText: '返回',
                cancelFn: function() {
                    history.back();
                }
            });
        }
        if ($("#totalPayPrice").html() >= 99999999.99) {
            $.sDialog({
                content: '订单金额过大，请分批购买！',
                okBtn: false,
                cancelBtnText: '返回',
                cancelFn: function() {
                    history.back();
                }
            });
        }

        //1.获取收货地址
        address_contact = $("#true_name").html();
        address_address = $("#address").html();
        address_phone = $("#mob_phone").html();
        address_id = $("#address_id").val();
        if (address_id == 'undefined') {
            $.sDialog({
                skin: "red",
                content: '请选择收货地址！',
                okBtn: false,
                cancelBtn: false
            });
            return false;
        }

        //2.获取发票信息
        invoice = $("#invContent").html();
        invoice_id = $("input[name='invoice_id']").val();

        //3.获取商品信息（商品id，商品备注）
        var cart_id = []; //定义一个数组
        $("input[name='cart_id']").each(function() {
            cart_id.push($(this).val()); //将值添加到数组中
        });

        var remark = [];
        var shop_id = [];
        $("input[name='remarks']").each(function() {
            shop_id.push($(this).attr("rel"));
            remark.push($(this).val()); //将值添加到数组中
        });

        //加价购的商品
        var increase_goods_id = [];
        $(".increase_list").each(function() {
            if ($(this).is('.checkeds')) {
                increase_goods_id.push($(this).find("#redemp_goods_id").val());
            }
        });

        //代金券信息
        var voucher_id = [];
        $(".voucher_list").each(function() {
            if ($(this).val() > 0) {
                voucher_id.push($(this).val());
            }
        });

        //分享id
        var share_price_id_value = [];
        $("input[name='share_price_id']").each(function() {
            share_price_id_value.push($(this).val()); //将值添加到数组中
        });

        //获取支付方式
        pay_way_id = $("#pay-selected").val();

        $.ajax({
            type: 'get',
            url: ApiUrl + "?ctl=Buyer_Order&met=addOrder&typ=json",
            data: {
                receiver_name: address_contact,
                arr: 1,
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
                k: key,
                u: getCookie('id'),
                from: "wap",
                share_price_id_value:share_price_id_value
            },
            dataType: "json",
            success: function(a) {
                if (a.status == 200) {
                    delCookie('cart_count');
                    //重新计算购物车的数量
                    getCartCount();
                    if (pay_way_id == 1) {
                        window.location.href = PayCenterWapUrl + "?ctl=Info&met=pay&uorder=" + a.data.uorder;
                        return false;
                    } else {
                        window.location.href = WapSiteUrl + '/tmpl/member/order_list.html';
                        return false;
                    }
                }else if(a.status == 210){
                    window.location.href = WapSiteUrl + '/tmpl/member/order_list.html';
                    return false;
                } else {
                    if (a.msg != 'failure') {
                        $.sDialog({
                            content: a.msg,
                            okBtn: false,
                            cancelBtnText: '返回',
                            cancelFn: function() { /*history.back();*/
                            }
                        });
                    } else {
                        $.sDialog({
                            content: '订单提交失败！',
                            okBtn: false,
                            cancelBtnText: '返回',
                            cancelFn: function() { /*history.back();*/
                            }
                        });
                    }
                }
            },
            failure: function(a) {
                Public.tips.error('操作失败！');
            }
        });
    });
});