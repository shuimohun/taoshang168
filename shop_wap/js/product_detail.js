var goods_id = getQueryString("goods_id");
var cid = getQueryString("cid");
var commit = getQueryString('commit');
var common_is_virtual;
var buy_limit;
var shop_owner;
var isBuyHave;
var goods_storage;
var buyLimitation;

var suid = getQueryString("suid");
var from = getQueryString("from");
var type = getQueryString("type");
var hash = location.hash;

//如果没有goods_id，则根据cid获取goods_id
if (!goods_id && cid) {
    $.ajax({
        url: ApiUrl + "?ctl=Goods_Goods&met=getGoodsidByCid&typ=json",
        type: "POST",
        data: {
            k: getCookie('key'),
            u: getCookie('id'),
            cid: cid
        },
        dataType: "json",
        async: false,
        success: function(result) {
            if (result.status == 200) {
                goods_id = result.data.goods_id;
            }
        }
    });
}

new Mlink({
    mlink:'https://a0ncmk.mlinks.cc/Ab5y?name=gid&id='+goods_id,
    button:document.querySelector('img#btnOpenApp')
});

var map_list = [];
var map_index_id = '';
var shop_id;
var isWx;
$(function() {
    var key = getCookie('key');
    var unixTimeToDateString = function(ts, ex) {
        ts = parseFloat(ts) || 0;
        if (ts < 1) {
            return '';
        }
        var d = new Date();
        d.setTime(ts * 1e3);
        var s = '' + d.getFullYear() + '-' + (1 + d.getMonth()) + '-' + d.getDate();
        if (ex) {
            s += ' ' + d.getHours() + ':' + d.getMinutes() + ':' + d.getSeconds();
        }
        return s;
    };

    var buyLimitation = function(a, b) {
        a = parseInt(a) || 0;
        b = parseInt(b) || 0;
        var r = 0;
        if (a > 0) {
            r = a;
        }
        if (b > 0 && r > 0 && b < r) {
            r = b;
        }
        return r;
    };

    template.helper('isEmpty', function(o) {
        for (var i in o) {
            return false;
        }
        return true;
    });

    // 图片轮播

    function picSwipe() {
        var elem = $("#mySwipe")[0];
        window.mySwipe = Swipe(elem, {
            continuous: false,
            stopPropagation: true,
            callback: function(index, element) {
                $('.goods-detail-turn').find('li').eq(index).addClass('cur').siblings().removeClass('cur');
            }
        });
    }

    //判断是否在微信内
    var ua = navigator.userAgent.toLowerCase();
    if (ua.match(/MicroMessenger/i) == "micromessenger") {
        var isWx = 1;
    }

    //加载商品数据
    get_detail(goods_id);
    //点击商品规格，获取新的商品

    function arrowClick(self, myData) {
        $(self).addClass("current").siblings().removeClass("current");
        //拼接属性
        var curEle = $(".spec").find("a.current");
        var curSpec = [];
        $.each(curEle, function(i, v) {
            // convert to int type then sort
            curSpec.push(parseInt($(v).attr("specs_value_id")) || 0);
        });
        var spec_string = curSpec.sort(function(a, b) {
            return a - b;
        }).join("|");
        //获取商品ID
        goods_id = myData.spec_list[spec_string];
        get_detail(goods_id);
    }

    function contains(arr, str) { //检测goods_id是否存入
        var i = arr.length;
        while (i--) {
            if (arr[i] === str) {
                return true;
            }
        }
        return false;
    }
    $.sValid.init({
        rules: {
            buynum: "digits"
        },
        messages: {
            buynum: "请输入正确的数字"
        },
        callback: function(eId, eMsg, eRules) {
            if (eId.length > 0) {
                var errorHtml = "";
                $.map(eMsg, function(idx, item) {
                    errorHtml += "<p>" + idx + "</p>";
                });
                $.sDialog({
                    skin: "red",
                    content: errorHtml,
                    okBtn: false,
                    cancelBtn: false
                });
            }
        }
    });
    //检测商品数目是否为正整数

    function buyNumer() {
        $.sValid();
    }

    function get_detail(goods_id) {
        //渲染页面
        $.ajax({
            url: ApiUrl + "?ctl=Goods_Goods&met=goods&typ=json",
            type: "get",
            data: {
                goods_id: goods_id,
                k: key,
                u: getCookie('id'),
                cid: cid
            },
            dataType: "json",
            success: function(result) {
                var data = result.data;
                //给data赋值
                data.isWx = isWx;

                if (result.status == 200) {
                    $("title").html(data.goods_info.goods_name);
                    //商品图片格式化数据
                    if (data.goods_image) {
                        var goods_image = data.goods_image.split(",");
                        data.goods_image = goods_image;
                    } else {
                        data.goods_image = [];
                    }
                    if (data.goods_info) {
                        //商品规格格式化数据
                        if (data.goods_info.common_spec_name) {
                            var goods_map_spec = $.map(data.goods_info.common_spec_name, function(v, i) {
                                var goods_specs = {};
                                goods_specs["goods_spec_id"] = i;
                                goods_specs['goods_spec_name'] = v;
                                if (data.goods_info.common_spec_value_c) {
                                    $.map(data.goods_info.common_spec_value_c, function(vv, vi) {
                                        if (i == vi) {
                                            goods_specs['goods_spec_value'] = $.map(vv, function(vvv, vvi) {
                                                var specs_value = {};
                                                specs_value["specs_value_id"] = vvi;
                                                specs_value["specs_value_name"] = vvv;
                                                return specs_value;
                                            });
                                        }
                                    });
                                    return goods_specs;
                                } else {
                                    data.goods_info.common_spec_value = [];
                                }
                            });
                            data.goods_map_spec = goods_map_spec;
                        } else {
                            data.goods_map_spec = [];
                        }

                        // 虚拟商品限购时间和数量
                        if (data.goods_info.common_is_virtual == '1') {
                            data.goods_info.virtual_indate_str = unixTimeToDateString(data.goods_info.virtual_indate, true);
                            data.goods_info.buyLimitation = buyLimitation(data.goods_info.virtual_limit, data.goods_info.upper_limit);
                        }

                        // 预售发货时间
                        /*if (data.goods_info.is_presell == '1') {
                         data.goods_info.presell_deliverdate_str = unixTimeToDateString(data.goods_info.presell_deliverdate);
                         }*/

                        //渲染模板
                        var html = template.render('product_detail', data);
                        $("#product_detail_html").html(html);

                        if (data.goods_info.common_is_virtual == '0') {
                            $('.goods-detail-o2o').remove();
                        }

                        //渲染模板
                        var html = template.render('product_detail_sepc', data);
                        $("#product_detail_spec_html").html(html);

                        //渲染模板
                        var html = template.render('voucher_script', data);
                        $("#voucher_html").html(html);

                        //渲染模板
                        var html = template.render('promotion_script', data);
                        $("#promotion_html").html(html);

                        var html = template.render('shuxing_script', data);
                        $("#shuxing_html").html(html);

                        var html = template.render('share_script', data);
                        $("#share_html").html(html);


                        var _TimeCountDown = $(".fnTimeCountDown");
                        _TimeCountDown.fnTimeCountDown();

                        if (data.goods_info.share_info && data.goods_info.share_info.price) {
                            console.log(data.goods_info.share_info.price)
                            var shared = data.goods_info.share_info.price.share_base;
                            $.each(shared, function(i) {
                                $('.share_' + i).addClass('shared');
                                $('.share_' + i).find('i').html('已减<i>' + shared[i] + '</i>元');
                                $('.share_' + i).find('img').attr('src', '../images/share_' + i + '_light@3x.png');
                            })
                        }

                        if (data.goods_info.is_virtual == '1') {
                            shop_id = data.store_info.shop_id;
                            virtual();
                        }

                        // 购物车中商品数量
                        if (getCookie('cart_count')) {
                            if (getCookie('cart_count') > 0) {
                                $('#cart_count,#cart_count1').html('<sup>' + getCookie('cart_count') + '</sup>');
                            }
                        }

                        //图片轮播
                        picSwipe();
                        //商品描述
                        $(".pddcp-arrow").click(function() {
                            $(this).parents(".pddcp-one-wp").toggleClass("current");
                        });
                        //规格属性
                        var myData = {};
                        myData["spec_list"] = data.spec_list;
                        $(".spec a").click(function() {
                            var self = this;
                            arrowClick(self, myData);
                        });
                        //购买数量，减
                        $(".minus").click(function() {
                            var buynum = $(".buy-num").val();
                            if (buynum > 1) {
                                $(".buy-num").val(parseInt(buynum - 1));
                            }
                        });
                        //购买数量加
                        $(".add").click(function() {

                            if(data.goods_info.fu_info)
                            {
                                if( data.goods_info.fu_info.status != 1 && data.goods_info.fu_info.status != 2 )
                                {
                                    var buynum = parseInt($(".buy-num").val());
                                    if (buynum < data.goods_info.goods_stock) {
                                        $(".buy-num").val(parseInt(buynum + 1));
                                    }
                                }
                            }
                            else
                            {
                                var buynum = parseInt($(".buy-num").val());
                                if (buynum < data.goods_info.goods_stock) {
                                    $(".buy-num").val(parseInt(buynum + 1));
                                }
                            }

                        });
                        // 一个F码限制只能购买一件商品 所以限制数量为1
                        if (data.goods_info.is_fcode == '1') {
                            $('.minus').hide();
                            $('.add').hide();
                            $(".buy-num").attr('readOnly', true);
                        }

                        //收藏
                        $(".pd-collect").click(function() {
                            if ($(this).hasClass('favorate')) {
                                if (dropFavoriteGoods(goods_id)) $(this).removeClass('favorate');
                            } else {
                                if (favoriteGoods(goods_id)) $(this).addClass('favorate');
                            }
                        });

                        common_is_virtual = data.goods_info.common_is_virtual;
                        buy_limit = data.goods_info.buyer_limit;
                        isBuyHave = data.isBuyHave;
                        shop_owner = data.shop_owner;
                        goods_storage = data.goods_info.goods_storage;
                        buyLimitation = data.goods_info.buyLimitation;

                      /*  //加入购物车
                        $("#add-cart").click(function (){});

                        //立即购买
                        if (data.goods_info.common_is_virtual == '1') {
                            $("#buy-now").click(function() {
                                var key = getCookie('key');//登录标记
                                if (!key) {
                                    //window.location.href = WapSiteUrl+'/tmpl/member/login.html';
                                    callback = window.location.href;

                                    login_url   = UCenterApiUrl + '?ctl=Login&met=index&typ=e';


                                    callback = ApiUrl + '?ctl=Login&met=check&typ=e&redirect=' + encodeURIComponent(callback);


                                    login_url = login_url + '&from=wap&callback=' + encodeURIComponent(callback);

                                    window.location.href = login_url;
                                    return false;
                                }

                                var buynum = parseInt($('.buy-num').val()) || 0;

                                if (buynum < 1) {
                                    $.sDialog({
                                        skin:"red",
                                        content:'参数错误！',
                                        okBtn:false,
                                        cancelBtn:false
                                    });
                                    return;
                                }
                                if (buynum > data.goods_info.goods_storage) {
                                    $.sDialog({
                                        skin:"red",
                                        content:'库存不足！',
                                        okBtn:false,
                                        cancelBtn:false
                                    });
                                    return;
                                }

                                // 虚拟商品限购数量
                                if (data.goods_info.buyLimitation > 0 && buynum > data.goods_info.buyLimitation) {
                                    $.sDialog({
                                        skin:"red",
                                        content:'超过限购数量！',
                                        okBtn:false,
                                        cancelBtn:false
                                    });
                                    return;
                                }

                                if(data.shop_owner)
                                {
                                    $.sDialog({
                                        skin:"red",
                                        content:'不能购买自己商店的商品！',
                                        okBtn:false,
                                        cancelBtn:false
                                    });
                                    return;
                                }
                                if(data.isBuyHave)
                                {
                                    $.sDialog({
                                        skin:"red",
                                        content:'您已达购买上限！',
                                        okBtn:false,
                                        cancelBtn:false
                                    });
                                    return;
                                }

                                var json = {};
                                json.key = key;
                                json.cart_id = goods_id;
                                json.quantity = buynum;

                                location.href = WapSiteUrl+'/tmpl/order/vr_buy_step1.html?goods_id='+goods_id+'&quantity='+buynum;
                                /!*$.ajax({
                                 type:'post',
                                 url:ApiUrl+'?act=member_vr_buy&op=buy_step1',
                                 data:json,
                                 dataType:'json',
                                 success:function(result){
                                 if (result.data.error) {
                                 $.sDialog({
                                 skin:"red",
                                 content:result.data.error,
                                 okBtn:false,
                                 cancelBtn:false
                                 });
                                 } else {
                                 location.href = WapSiteUrl+'/tmpl/order/vr_buy_step1.html?goods_id='+goods_id+'&quantity='+buynum;
                                 }
                                 }
                                 });*!/
                            });
                        } else {
                            $("#buy-now").click(function (){

                                var key = getCookie('key');//登录标记

                                if(!key){
                                    //window.location.href = WapSiteUrl+'/tmpl/member/login.html';
                                    callback = window.location.href;

                                    login_url   = UCenterApiUrl + '?ctl=Login&met=index&typ=e';


                                    callback = ApiUrl + '?ctl=Login&met=check&typ=e&redirect=' + encodeURIComponent(callback);


                                    login_url = login_url + '&from=wap&callback=' + encodeURIComponent(callback);

                                    window.location.href = login_url;
                                }else{
                                    var buynum = parseInt($('.buy-num').val()) || 0;
                                    if (buynum < 1) {
                                        $.sDialog({
                                            skin:"red",
                                            content:'参数错误！',
                                            okBtn:false,
                                            cancelBtn:false
                                        });
                                        return;
                                    }

                                    if (buynum > data.goods_info.buyer_limit  && data.goods_info.buyer_limit) {
                                        $.sDialog({
                                            skin:"red",
                                            content:'库存不足！',
                                            okBtn:false,
                                            cancelBtn:false
                                        });
                                        return;
                                    }

                                    if(data.shop_owner)
                                    {
                                        $.sDialog({
                                            skin:"red",
                                            content:'不能购买自己商店的商品！',
                                            okBtn:false,
                                            cancelBtn:false
                                        });
                                        return;
                                    }
                                    if(data.isBuyHave)
                                    {
                                        $.sDialog({
                                            skin:"red",
                                            content:'您已达购买上限！',
                                            okBtn:false,
                                            cancelBtn:false
                                        });
                                        return;
                                    }

                                    var json = {};
                                    json.key = key;
                                    json.cart_id = goods_id+'|'+buynum;
                                    $.ajax({
                                        url:ApiUrl+"?ctl=Buyer_Cart&met=addCart&typ=json",
                                        data:{k:key,u:getCookie('id'),goods_id:goods_id,goods_num:buynum},
                                        type:"post",
                                        success:function (result){
                                            console.info(result);
                                            if(checkLogin(result.login)){
                                                if(result.status == 200){
                                                    show_tip();
                                                    // 更新购物车中商品数量
                                                    delCookie('cart_count');
                                                    getCartCount();
                                                    location.href = WapSiteUrl + "/tmpl/order/buy_step1.html?ifcart=1&cart_id="+result.data.cart_id;
                                                    //location.href = WapSiteUrl+'/tmpl/order/buy_step1.html?goods_id='+goods_id+'&buynum='+buynum;
                                                }else{
                                                    $.sDialog({
                                                        skin:"red",
                                                        content:result.msg,
                                                        okBtn:false,
                                                        cancelBtn:false
                                                    });
                                                }
                                            }
                                        }
                                    });
                                }
                            });

                        }*/

                        //推荐 热销 显隐
                        $('.recommend .recom_recommend').click(function() {
                            if (!$(this).hasClass('curr')) {
                                $(this).siblings('.curr').removeClass('curr');
                                $(this).addClass('curr');
                                var type = $(this).data('type');
                                if (type == 'tuijian') {
                                    $('.recommend .rexiao').hide();
                                    $('.recommend .tuijian').show();
                                } else if (type == 'rexiao') {
                                    $('.recommend .tuijian').hide();
                                    $('.recommend .rexiao').show();
                                }
                            }
                        });

                        //激活分享 立减和送福免单
                        var active_share_url = '';
                        if(data.goods_info.fu_flag){
                            active_share_url = ApiUrl + "?ctl=Goods_Goods&met=activeFu&typ=json";
                        }else{
                            active_share_url = ApiUrl + "?ctl=Goods_Goods&met=actShare&typ=json";
                        }
                        if (suid > 0 && (goods_id > 0 || cid > 0) && (type == 'app' || hash != "")) {
                            $.ajax({
                                url: active_share_url,
                                type: 'get',
                                dataType: 'json',
                                data: {
                                    'gid': goods_id,
                                    'cid': cid,
                                    'suid': suid,
                                    'hash': hash,
                                    'from': from,
                                    'type': type
                                },
                                success: function(result) {}
                            });
                        }

                        //分享 立减和送福免单
                        // var desc = data.goods_info['goods_name'];
                        var desc = '我在免费领取'+data.goods_info['goods_name']+',送福免单活动真实有效!!!';
                        var share_img = data.goods_info['goods_image'];
                        var id = getCookie('id');
                        var share_uid = '';
                        if (id) {
                            share_uid = '&suid=' + id;
                        }
                        if( data.goods_info.promotion && data.goods_info.promotion.promotion_type == 6 )
                        {
                            var link = WapSiteUrl + '/tmpl/sendbless_register.html?gid=' + goods_id + share_uid + '&fu_id='+data.goods_info.promotion.promotion_id+'&type=app&from=';

                        }
                        else
                        {
                            var link = WapSiteUrl + '/tmpl/sendbless_register.html?gid=' + goods_id + share_uid + '&type=app&from=';
                        }

                        if(data.goods_info.fu_flag)
                        {
                            var countNum=data.goods_info.total_person;
                            var title = '';
                            if( data.goods_info.is_register==0 )
                            {
                                title = '我是第'+countNum+'个送福免单,请您帮忙点击集个福,赶紧参加免费领取';
                            }
                            else if( data.goods_info.is_register==1 )
                            {
                                title = '我是第'+countNum+'个送福免单,请您帮忙注册集个福,赶紧参加免费领取';
                            }
                        }
                        else
                        {
                            var title = '淘尚168商城';
                        }


                        if (data.wxConfig) {
                            //微信内分享
                            wx.config({
                                debug: false,
                                appId: data.wxConfig.appId,
                                timestamp: data.wxConfig.timestamp,
                                nonceStr: data.wxConfig.nonceStr,
                                signature: data.wxConfig.signature,
                                jsApiList: ['onMenuShareTimeline', 'onMenuShareAppMessage', 'onMenuShareQQ', 'onMenuShareQZone']
                            });
                            //微信加载
                            wx.ready(function() {
                                if( data.goods_info.fu_flag ) {
                                    var key = getCookie("key");
                                    if( !key ) {
                                        var callback = window.location.href;
                                        var loginUrl = UCenterApiUrl + '?ctl=Login&met=index&typ=e';
                                        var login_url = loginUrl + '&from=wap&callback=' + encodeURIComponent(callback);
                                        window.location.href = login_url;
                                        return false;
                                    }
                                    else
                                    {
                                        if( data.default_address !=1 )
                                        {
                                            var msg = confirm("请选择默认收货地址");
                                            if( msg )
                                            {
                                                var adrDefault       = WapSiteUrl+'/tmpl/member/address_list.html';
                                                window.location.href = adrDefault;
                                                return false;
                                            }
                                            else
                                            {
                                                return false;
                                            }
                                        }


                                    }
                                }
                                //朋友圈
                                wx.onMenuShareTimeline({
                                    title: title,
                                    // 分享标题
                                    desc: desc,
                                    link: link + 'weixin_timeline',
                                    // 分享链接，该链接域名或路径必须与当前页面对应的公众号JS安全域名一致
                                    imgUrl: share_img,
                                    // 分享图标
                                    success: function() {
                                        alert('分享成功');
                                        if( data.goods_info.fu_flag ==1 )
                                        {
                                            if( !data.goods_info.fu_info || data.goods_info.fu_info.status !=1  )
                                            {
                                                addFu("wechatTimeline");
                                            }
                                        }
                                    },
                                    cancel: function() {
                                        alert('分享失败');
                                    }
                                });
                                //微信朋友
                                wx.onMenuShareAppMessage({
                                    title: title,
                                    // 分享标题
                                    desc: desc,
                                    // 分享描述
                                    link: link + 'weixin',
                                    // 分享链接，该链接域名或路径必须与当前页面对应的公众号JS安全域名一致
                                    imgUrl: share_img,
                                    // 分享图标
                                    success: function() {
                                        alert('分享成功');
                                        if( data.goods_info.fu_flag ==1 )
                                        {
                                            if( !data.goods_info.fu_info || data.goods_info.fu_info.status !=1  )
                                            {
                                                addFu("wechatFriend");
                                            }
                                        }
                                    },
                                    cancel: function() {
                                        alert('分享失败');
                                    }
                                });
                                //QQ好友
                                wx.onMenuShareQQ({
                                    title: title,
                                    // 分享标题
                                    desc: desc,
                                    // 分享描述
                                    link: link + 'sqq',
                                    // 分享链接
                                    imgUrl: share_img,
                                    // 分享图标
                                    success: function() {
                                        alert('分享成功');
                                        if( data.goods_info.fu_flag ==1 )
                                        {
                                            if( !data.goods_info.fu_info || data.goods_info.fu_info.status !=1  )
                                            {
                                                addFu("qqFriend");
                                            }
                                        }
                                    },
                                    cancel: function() {
                                        alert('分享失败');
                                    }
                                });
                                //qq空间
                                wx.onMenuShareQZone({
                                    title: title,
                                    // 分享标题
                                    desc: desc,
                                    // 分享描述
                                    link: link + 'qzone',
                                    // 分享链接
                                    imgUrl: share_img,
                                    // 分享图标
                                    success: function() {
                                        alert('分享成功');
                                        if( data.goods_info.fu_flag ==1 )
                                        {
                                            if( !data.goods_info.fu_info || data.goods_info.fu_info.status !=1  )
                                            {
                                                addFu("qZone");
                                            }
                                        }
                                    },
                                    cancel: function() {
                                        alert('分享失败');
                                    }
                                });
                            });
                        } else {
                            var nativeShare = new NativeShare();
                            var shareData = {
                                title: title,
                                desc: desc,
                                // 如果是微信该link的域名必须要在微信后台配置的安全域名之内的。
                                link: link,
                                icon: share_img,
                                // 不要过于依赖以下两个回调，很多浏览器是不支持的
                                success: function() {
                                    //alert('success')
                                },
                                fail: function() {
                                    //alert('fail')
                                }
                            };
                            function call(command) {
                                try {
                                    nativeShare.call(command)
                                } catch (err) {
                                    // 如果不支持，你可以在这里做降级处理
                                    if (err.message) {
                                        alert(err.message)
                                    } else {
                                        alert('当前浏览器不支持此功能。')
                                    }
                                }
                            }
                            $('.share').on('click', function() {
                                var type = $(this).data('type');
                                if( data.goods_info.fu_flag ) {
                                    var key = getCookie("key");
                                    if( !key ) {
                                        var callback = window.location.href;
                                        var loginUrl = UCenterApiUrl + '?ctl=Login&met=index&typ=e';
                                        var login_url = loginUrl + '&from=wap&callback=' + encodeURIComponent(callback);
                                        window.location.href = login_url;
                                        return false;
                                    } else {

                                        if( data.goods_info.promotion.fu_order_flag ==1 )
                                        {
                                            $.sDialog({
                                                content: '您有包含此商品的订单尚未完成,此时分享不享受送福免单',
                                                okBtn: false,
                                                cancelBtnText: '返回',
                                                cancelFn: function() {}
                                            });
                                        }

                                        if( data.default_address !=1 )
                                        {
                                            var msg = confirm("请选择默认收货地址");
                                            if( msg )
                                            {
                                                var adrDefault       = WapSiteUrl+'/tmpl/member/address_list.html';
                                                window.location.href = adrDefault;
                                                return false;
                                            }
                                            else
                                            {
                                                return false;
                                            }
                                        }
                                        else {
                                            if( !data.goods_info.fu_info ) {
                                                addFu(type);
                                            }
                                        }
                                    }
                                }


                                if (type) {
                                    stype = '';
                                    if (type == 'qZone') {
                                        stype = 'qzone';
                                    } else if (type == 'qqFriend') {
                                        stype = 'sqq';
                                    } else if (type == 'wechatFriend') {
                                        stype = 'weixin';
                                    } else if (type == 'wechatTimeline') {
                                        stype = 'weixin_timeline';
                                    } else if (type == 'weibo') {
                                        stype = 'tsina';
                                    }
                                    shareData.link = link;
                                    shareData.link = shareData.link + stype;
                                    nativeShare.setShareData(shareData);
                                    // console.log( shareData.title);
                                    call(type);
                                }
                            });
                        }

                    } else {
                        $.sDialog({
                            content: '该商品已下架或该店铺已关闭！<br>请返回上一页继续操作…',
                            okBtn: false,
                            cancelBtnText: '返回',
                            cancelFn: function() {
                                history.back();
                            }
                        });
                    }

                    $.ajax({
                        url: ApiUrl + "?ctl=Goods_Goods&met=getGoodsBundling&typ=json",
                        type: "get",
                        data: {
                            goods_id: goods_id
                        },
                        dataType: "json",
                        success: function (e) {
                            if(e.status == 200){
                                var html = template.render('bundling', e);
                                $(".bundling").html(html);

                                var swiper = new Swiper('.swiper-container', {
                                    pagination: '.swiper-pagination',
                                    slidesPerView: 3,
                                    paginationClickable: true,
                                    spaceBetween: 30,
                                    freeMode: true
                                });

                                $('.package_div').click(function() {
                                    var b_id = $(this).data('id');
                                    if (b_id !== null || b_id !== undefined || b_id !== '') {
                                        window.location.href = 'package.html?b_id=' + b_id;
                                    }
                                });

                            }
                        }
                    });

                } else {
                    $.sDialog({
                        content: data.error + '！<br>请返回上一页继续操作…',
                        okBtn: false,
                        cancelBtnText: '返回',
                        cancelFn: function() {
                            history.back();
                        }
                    });
                }

                //验证购买数量是不是数字
                $("#buynum").blur(buyNumer);
                if (!commit) {
                    $('.two_bottom').addClass('hide');
                }
                // 从下到上动态显示隐藏内容
                $.animationUp({
                    valve: '.add-cart',
                    // 动作触发
                    wrapper: '#product_detail_spec_html',
                    // 动作块
                    scroll: '#product_roll',
                    // 滚动块，为空不触发滚动
                    start: function() { // 开始动作触发事件
                        $('.goods-detail-foot').addClass('hide').removeClass('block');
                        commit = 'add_card';
                        $('.two_bottom').removeClass('hide');
                    },
                    close: function() { // 关闭动作触发事件
                        $('.goods-detail-foot').removeClass('hide').addClass('block');

                    }
                });
                $.animationUp({
                    valve: '.buy-now',
                    // 动作触发
                    wrapper: '#product_detail_spec_html',
                    // 动作块
                    scroll: '#product_roll',
                    // 滚动块，为空不触发滚动
                    start: function() { // 开始动作触发事件
                        $('.goods-detail-foot').addClass('hide').removeClass('block');
                        commit = 'buy_now';
                        $('.two_bottom').removeClass('hide');
                    },
                    close: function() { // 关闭动作触发事件
                        $('.goods-detail-foot').removeClass('hide').addClass('block');

                    }
                });
                $.animationUp({
                    valve: '#goods_spec_selected',
                    // 动作触发
                    wrapper: '#product_detail_spec_html',
                    // 动作块
                    scroll: '#product_roll',
                    // 滚动块，为空不触发滚动
                    start: function() { // 开始动作触发事件
                        $('.goods-detail-foot').addClass('hide').removeClass('block');
                        commit = null;
                        $('.two_bottom').addClass('hide');
                    },
                    close: function() { // 关闭动作触发事件
                        $('.goods-detail-foot').removeClass('hide').addClass('block');
                        $('.two_bottom').removeClass('hide');
                    }
                });
                $.animationUp({
                    valve: '#getVoucher',
                    // 动作触发
                    wrapper: '#voucher_html',
                    // 动作块
                    scroll: '#voucher_roll',
                    // 滚动块，为空不触发滚动
                });
                $.animationUp({
                    valve: '#getPromotion',
                    // 动作触发
                    wrapper: '#promotion_html',
                    // 动作块
                    scroll: '#promotion_roll',
                    // 滚动块，为空不触发滚动
                });
                $.animationUp({
                    valve: '#getShuxing',
                    // 动作触发
                    wrapper: '#shuxing_html',
                    // 动作块
                    scroll: '#shuxing_roll',
                    // 滚动块，为空不触发滚动
                });
                $.animationUp({
                    valve: '.share_button',
                    // 动作触发
                    wrapper: '#share_html',
                    // 动作块
                    scroll: '',
                    // 滚动块，为空不触发滚动
                });

                $('#voucher_html').on('click', '.get', function() {
                    //getFreeVoucher($(this).attr('data-tid'));
                    if (!$(this).hasClass('taken')) {
                        getVoucher($(this));
                    }
                });

                // 联系客服
                $('.kefu').click(function() {

                    var key = getCookie('key'); //登录标记
                    if (!key) {
                        callback = window.location.href;

                        login_url = UCenterApiUrl + '?ctl=Login&met=index&typ=e';

                        callback = ApiUrl + '?ctl=Login&met=check&typ=e&redirect=' + encodeURIComponent(callback);

                        login_url = login_url + '&from=wap&callback=' + encodeURIComponent(callback);

                        window.location.href = login_url;
                        return false;
                    }

                    if (result.data.store_info.member_name == getCookie('user_account')) {
                        alert('自己不能给自己发消息!');
                        history.go(0);
                    } else {
                        if (window.chatTo) {
                            chatTo(result.data.store_info.member_name.toString());
                        } else if (window.android) {
                            if (window.android.chatTo) {
                                window.android.chatTo(result.data.store_info.member_name.toString(), result.data.store_info.store_name, data.store_info.store_logo);
                            }
                        } else {
                            //tmpl/im-chatinterface.html?contact_type=C&contact_you=10012&contact_yname=admin123&uname=5511aa
                            window.location.href = WapSiteUrl + '/tmpl/im-chatinterface.html?contact_type=C&contact_you=' + result.data.store_info.member_id + '&contact_yname=' + result.data.store_info.store_name + '&uname=' + getCookie('user_account');
                        }
                    }
                })
            }
        });
    }

    $.scrollTransparent();
    $('#product_detail_html').on('click', '#get_area_selected', function() {
        $.areaSelected({
            success: function(data) {
                $('#get_area_selected_name').html(data.area_info);
                var area_id = data.area_id_2 == 0 ? data.area_id_1 : data.area_id_2;
                $.getJSON(ApiUrl + '?act=goods&op=calc', {
                    goods_id: goods_id,
                    area_id: area_id
                }, function(result) {
                    $('#get_area_selected_whether').html(result.data.if_store_cn);
                    $('#get_area_selected_content').html(result.data.content);
                    if (!result.data.if_store) {
                        $('.buy-handle').addClass('no-buy');
                    } else {
                        $('.buy-handle').removeClass('no-buy');
                    }
                });
            }
        });
    });

    $('body').on('click', '#goodsBody,#goodsBody1', function() {
        window.location.href = WapSiteUrl + '/tmpl/product_info.html?goods_id=' + goods_id;
    });
    $('body').on('click', '#goodsEvaluation,#goodsEvaluation1,#goodsEvaluation2', function() {
        window.location.href = WapSiteUrl + '/tmpl/product_eval_list.html?goods_id=' + goods_id;
    });

    $('#list-address-scroll').on('click', 'dl > a', map);
    $('#map_all').on('click', map);

    /*$(window).scroll(function (){
     if ($(window).scrollTop() + $(window).height() > $(document).height() - 1){
     window.location.href = WapSiteUrl+'/tmpl/product_info.html?goods_id=' + goods_id;
     }
     });*/


    function addFu( type ) {
        var share_type;
        if( type == "qqFriend")
        {
            share_type = "sqq";
        }
        else if( type == "qZone" )
        {
            share_type = "qzone";
        }
        else if( type == "wechatFriend" )
        {
            share_type = "weixin";
        }
        else if( type == "wechatTimeline" )
        {
            share_type = "weixin_timeline";
        }
        else if( type == "weibo" )
        {
            share_type = "tsina";
        }
        var addFu_gid = goods_id;
        // console.log(share_type);
        // return  false;
        $.ajax({
            type: 'POST',
            url: ApiUrl + '?ctl=Goods_Goods&met=addFu&typ=json',
            dataType: 'json',
            data:{gid:addFu_gid,type:share_type},
            async: false,
            success: function(e) {
                if( e.status == 250 )
                {
                    if( !e.data )
                    {
                        alert( e.msg );
                        return false;
                    }

                }
            }
        })
    }
});

function show_tip() {
    var flyer = $('.goods-pic > img').clone().css({
        'z-index': '999',
        'height': '3rem',
        'width': '3rem'
    });
    flyer.fly({
        start: {
            left: $('.goods-pic > img').offset().left,
            top: $('.goods-pic > img').offset().top - $(window).scrollTop()
        },
        end: {
            left: $("#cart_count1").offset().left + 40,
            top: $("#cart_count1").offset().top - $(window).scrollTop(),
            width: 0,
            height: 0
        },
        onEnd: function() {
            flyer.remove();
        }
    });
}

function virtual() {
    $('#get_area_selected').parents('.goods-detail-item').remove();
    $.getJSON(ApiUrl + '?act=goods&op=store_o2o_addr', {
        shop_id: shop_id
    }, function(result) {
        if (!result.data.error) {
            if (result.data.addr_list.length > 0) {
                $('#list-address-ul').html(template.render('list-address-script', result.data));
                map_list = result.data.addr_list;
                var _html = '';
                _html += '<dl index_id="0">';
                _html += '<dt>' + map_list[0].name_info + '</dt>';
                _html += '<dd>' + map_list[0].address_info + '</dd>';
                _html += '</dl>';
                _html += '<p><a href="tel:' + map_list[0].phone_info + '"></a></p>';
                $('#goods-detail-o2o').html(_html);

                $('#goods-detail-o2o').on('click', 'dl', map);

                if (map_list.length > 1) {
                    $('#store_addr_list').html('查看全部' + map_list.length + '家分店地址');
                } else {
                    $('#store_addr_list').html('查看商家地址');
                }
                $('#map_all > em').html(map_list.length);
            } else {
                $('.goods-detail-o2o').hide();
            }
        }
    });
    $.animationLeft({
        valve: '#store_addr_list',
        wrapper: '#list-address-wrapper',
        scroll: '#list-address-scroll'
    });
}

function map() {
    $('#map-wrappers').removeClass('hide').removeClass('right').addClass('left');
    $('#map-wrappers').on('click', '.header-l > a', function() {
        $('#map-wrappers').addClass('right').removeClass('left');
    });
    $('#baidu_map').css('width', document.body.clientWidth);
    $('#baidu_map').css('height', document.body.clientHeight);
    map_index_id = $(this).attr('index_id');
    if (typeof map_index_id != 'string') {
        map_index_id = '';
    }
    if (typeof(map_js_flag) == 'undefined') {
        $.ajax({
            url: WapSiteUrl + '/js/map.js',
            dataType: "script",
            async: false
        });
    }
    if (typeof BMap == 'object') {
        baidu_init();
    } else {
        load_script();
    }
}

function submit() {
    if (commit == 'add_card') {
        //设置key
        var key = getCookie('key'); //登录标记
        //获取数量
        var quantity = parseInt($(".buy-num").val());
        //判断key是否存在
        if (!key) {
            var goods_info = decodeURIComponent(getCookie('goods_cart'));
            if (goods_info == null) {
                goods_info = '';
            }
            if (goods_id < 1) {
                show_tip();
                return false;
            }
            var cart_count = 0;
            if (!goods_info) {
                goods_info = goods_id + ',' + quantity;
                cart_count = 1;
            } else {
                var goodsarr = goods_info.split('|');
                for (var i = 0; i < goodsarr.length; i++) {
                    var arr = goodsarr[i].split(',');
                    if (contains(arr, goods_id)) {
                        show_tip();
                        return false;
                    }
                }
                goods_info += '|' + goods_id + ',' + quantity;
                cart_count = goodsarr.length;
            }
            // 加入cookie
            addCookie('goods_cart', goods_info);
            // 更新cookie中商品数量
            addCookie('cart_count', cart_count);
            show_tip();
            getCartCount();
            $('#cart_count,#cart_count1').html('<sup>' + cart_count + '</sup>');
            return false;
        } else {
            if (shop_owner) {
                $.sDialog({
                    skin: "red",
                    content: '不能购买自己商店的商品！',
                    okBtn: false,
                    cancelBtn: false
                });
                return;
            }
            if (isBuyHave) {
                $.sDialog({
                    skin: "red",
                    content: '您已达购买上限！',
                    okBtn: false,
                    cancelBtn: false
                });
                return;
            }

            $.ajax({
                url: ApiUrl + "?ctl=Buyer_Cart&met=addCart&typ=json",
                data: {
                    k: key,
                    u: getCookie('id'),
                    goods_id: goods_id,
                    goods_num: quantity
                },
                type: "post",
                success: function(result) {
                    if (checkLogin(result.login)) {
                        if (result.status == 200) {
                            show_tip();
                            // 更新购物车中商品数量
                            delCookie('cart_count');
                            getCartCount();
                            $('#cart_count,#cart_count1').html('<sup>' + getCookie('cart_count') + '</sup>');
                        } else {
                            if(result.msg){
                                msg = result.msg;
                            }else{
                                msg = '添加失败';
                            }
                            $.sDialog({
                                skin: "red",
                                content: msg,
                                okBtn: false,
                                cancelBtn: false
                            });
                        }
                    }
                }
            })
        }
    } else if (commit == 'buy_now') {
        if (common_is_virtual == '1') {
            var key = getCookie('key'); //登录标记
            if (!key) {
                //window.location.href = WapSiteUrl+'/tmpl/member/login.html';
                callback = window.location.href;

                login_url = UCenterApiUrl + '?ctl=Login&met=index&typ=e';


                callback = ApiUrl + '?ctl=Login&met=check&typ=e&redirect=' + encodeURIComponent(callback);


                login_url = login_url + '&from=wap&callback=' + encodeURIComponent(callback);

                window.location.href = login_url;
                return false;
            }

            var buynum = parseInt($('.buy-num').val()) || 0;

            if (buynum < 1) {
                $.sDialog({
                    skin: "red",
                    content: '参数错误！',
                    okBtn: false,
                    cancelBtn: false
                });
                return;
            }
            if (buynum > goods_storage) {
                $.sDialog({
                    skin: "red",
                    content: '库存不足！',
                    okBtn: false,
                    cancelBtn: false
                });
                return;
            }

            // 虚拟商品限购数量
            if (buyLimitation > 0 && buynum > buyLimitation) {
                $.sDialog({
                    skin: "red",
                    content: '超过限购数量！',
                    okBtn: false,
                    cancelBtn: false
                });
                return;
            }

            if (shop_owner) {
                $.sDialog({
                    skin: "red",
                    content: '不能购买自己商店的商品！',
                    okBtn: false,
                    cancelBtn: false
                });
                return;
            }
            if (isBuyHave) {
                $.sDialog({
                    skin: "red",
                    content: '您已达购买上限！',
                    okBtn: false,
                    cancelBtn: false
                });
                return;
            }

            var json = {};
            json.key = key;
            json.cart_id = goods_id;
            json.quantity = buynum;
            location.href = WapSiteUrl + '/tmpl/order/vr_buy_step1.html?goods_id=' + goods_id + '&quantity=' + buynum;
        } else {

            var key = getCookie('key'); //登录标记

            if (!key) {
                //window.location.href = WapSiteUrl+'/tmpl/member/login.html';
                callback = window.location.href;

                login_url = UCenterApiUrl + '?ctl=Login&met=index&typ=e';


                callback = ApiUrl + '?ctl=Login&met=check&typ=e&redirect=' + encodeURIComponent(callback);


                login_url = login_url + '&from=wap&callback=' + encodeURIComponent(callback);

                window.location.href = login_url;
            } else {
                var buynum = parseInt($('.buy-num').val()) || 0;
                if (buynum < 1) {
                    $.sDialog({
                        skin: "red",
                        content: '参数错误！',
                        okBtn: false,
                        cancelBtn: false
                    });
                    return;
                }

                if (buynum > buy_limit && buy_limit) {
                    $.sDialog({
                        skin: "red",
                        content: '库存不足！',
                        okBtn: false,
                        cancelBtn: false
                    });
                    return;
                }

                if (shop_owner) {
                    $.sDialog({
                        skin: "red",
                        content: '不能购买自己商店的商品！',
                        okBtn: false,
                        cancelBtn: false
                    });
                    return;
                }
                if (isBuyHave) {
                    $.sDialog({
                        skin: "red",
                        content: '您已达购买上限！',
                        okBtn: false,
                        cancelBtn: false
                    });
                    return;
                }

                var json = {};
                json.key = key;
                json.cart_id = goods_id + '|' + buynum;
                $.ajax({
                    url: ApiUrl + "?ctl=Buyer_Cart&met=addCart&typ=json",
                    data: {
                        k: key,
                        u: getCookie('id'),
                        goods_id: goods_id,
                        goods_num: buynum
                    },
                    type: "post",
                    success: function(result) {
                        if (checkLogin(result.login)) {
                            if (result.status == 200) {
                                show_tip();
                                // 更新购物车中商品数量
                                delCookie('cart_count');
                                getCartCount();
                                location.href = WapSiteUrl + "/tmpl/order/buy_step1.html?ifcart=1&cart_id=" + result.data.cart_id;
                                //location.href = WapSiteUrl+'/tmpl/order/buy_step1.html?goods_id='+goods_id+'&buynum='+buynum;
                            } else {
                                alert(result.status);
                                $.sDialog({
                                    skin: "red",
                                    content: result.msg,
                                    okBtn: false,
                                    cancelBtn: false
                                });
                            }
                        }
                    }
                });
            }
        }
    }
}

function open_show(){
    $('.open').show();
    $('.open .open_close').on('click',function(){
        $(this).parent().css({'display':'none'});
        addCookie('openshow',1,1);
    });
    if (getCookie('openshow')){
        $('.open').css({'display':'none'});
    } else {
        $(this).parent().css({'display':'block'});
    }
};
open_show();


