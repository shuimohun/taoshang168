$(function (){

    template.helper('isEmpty', function(o) {
        for (var i in o) {
            return false;
        }
        return true;
    });
    template.helper('decodeURIComponent', function(o){
        return decodeURIComponent(o);
    });
    var key = getCookie('key');
    if(!key){
        $.getJSON(ApiUrl+'?ctl=Buyer_Index&met=recommendList&typ=json', function (e) {
            $(".title_guess").html("为你推荐");
            $('.guess-like').html(template.render("like_g", e));
        });

        var goods = decodeURIComponent(getCookie('goods_cart'));
        if (goods != null) {
            var goodsarr = goods.split('|');
        } else {
            goodsarr = {};
        }

        var cart_list = new Array();
        var sum = 0;
        if(goodsarr.length>0){
            for(var i=0;i<goodsarr.length;i++){
                var info = goodsarr[i].split(',');
                if (isNaN(info[0]) || isNaN(info[1])) continue;
                data = getGoods(info[0], info[1]);

                console.info(data);
                if ($.isEmptyObject(data)) continue;
                if (cart_list.length > 0) {
                    var has = false
                    for (var j=0; j<cart_list.length; j++) {
                        if (cart_list[j].shop_id == data.shop_id) {
                            cart_list[j].goods.push(data);
                            has = true
                        }
                    }
                    if (!has) {
                        var datas = {};
                        datas.shop_id = data.shop_id;
                        datas.store_name = data.store_name;
                        datas.goods_id = data.goods_id;
                        var goods = new Array();
                        goods = [data];
                        datas.goods = goods;
                        cart_list.push(datas);
                    }
                } else {
                    var datas = {};
                    datas.shop_id = data.shop_id;
                    datas.store_name = data.store_name;
                    datas.goods_id = data.goods_id;
                    var goods = new Array();
                    goods = [data];
                    datas.goods = goods;
                    cart_list.push(datas);
                }

                sum += parseFloat(data.goods_sum);
            }
        }

        var rData = {cart_list:cart_list, sum:sum.toFixed(2), cart_count:goodsarr.length, check_out:false};
        rData.WapSiteUrl = WapSiteUrl;

        console.info(rData);
        var html = template.render('cart-list1', rData);
        $('#cart-list').addClass('no-login');
        if (rData.cart_list.length == 0) {
            get_footer();
        }
        $("#cart-list-wp").html(html);
        $('.goto-settlement,.goto-shopping').parent().hide();
        //删除购物车
        $(".goods-del").click(function(){
            var $this = $(this);
            $.sDialog({
                skin:"red",
                content:'确认删除吗？',
                okBtn:true,
                cancelBtn:true,
                okFn: function() {
                    var goods_id = $this.attr('cart_id');
                    for(var i=0;i<goodsarr.length;i++){
                        var info = goodsarr[i].split(',');
                        if (info[0] == goods_id) {
                            goodsarr.splice(i,1);
                            break;
                        }
                    }
                    addCookie('goods_cart',goodsarr.join('|'));
                    // 更新cookie中商品数量

                    if(goodsarr[0] == 'null')
                    {
                        addCookie('cart_count',goodsarr.length - 1);
                    }
                    else
                    {
                        addCookie('cart_count',goodsarr.length);
                    }
                    location.reload();
                }
            });
        });
         //购买数量，减
        $(".minus").click(function(){
            var sPrents = $(this).parents(".cart-litemw-cnt");
            var goods_id = sPrents.attr('cart_id');
            for(var i=0;i<goodsarr.length;i++){
                var info = goodsarr[i].split(',');
                if (info[0] == goods_id) {
                    if (info[1] == 1) {
                        return false;
                    }
                    info[1] = parseInt(info[1]) - 1;
                    goodsarr[i] = info[0] + ',' + info[1];
                    sPrents.find('.buy-num').val(info[1]);
                }
            }
            addCookie('goods_cart',goodsarr.join('|'));
        });
        //购买数量加
        $(".add").click(function(){
            var sPrents = $(this).parents(".cart-litemw-cnt");
            var goods_id = sPrents.attr('cart_id');
            for(var i=0;i<goodsarr.length;i++){
                var info = goodsarr[i].split(',');
                if (info[0] == goods_id) {
                    info[1] = parseInt(info[1]) + 1;
                    goodsarr[i] = info[0] + ',' + info[1];
                    sPrents.find('.buy-num').val(info[1]);
                }
            }
            addCookie('goods_cart',goodsarr.join('|'));
        });
    }else{
        //初始化页面数据
        function initCartList(){
             $.ajax({
                url:ApiUrl+"/index.php?ctl=Buyer_Cart&met=cart&typ=json",
                type:"post",
                dataType:"json",
                data:{k:key, u:getCookie('id')},
                success:function (result){
                    if(checkLogin(result.login)){
                        if(!result.data.error){
                            initGuessLike();
                            if (result.data.count == 0) {
                                addCookie('cart_count',0);
                                //get_footer();
                            }
                            var rData = result.data;
                            rData.WapSiteUrl = WapSiteUrl;
                            rData.check_out = true;
                            var html = template.render('cart-list', rData);

                            $("#cart-list-wp").html(html);
                            //删除购物车
                            $(".goods-del").click(function(){
                                var  cart_id = $(this).attr("cart_id");
                                $.sDialog({
                                    skin:"red",
                                    content:'确认删除吗？',
                                    okBtn:true,
                                    cancelBtn:true,
                                    okFn: function() {
                                        delCartList(cart_id);
                                    }
                                });
                            });
                             //购买数量，减
                            $(".minus").click(minusBuyNum);
                            //购买数量加
                            $(".add").click(addBuyNum);
                            $(".buynum").blur(buyNumer);
                            // 从下到上动态显示隐藏内容
                            for (var i in rData.cart_list) {
                                $.animationUp({
                                    valve : '.animation-up' + i,          // 动作触发，为空直接触发
                                    wrapper : '.nctouch-bottom-mask' + i,    // 动作块
                                    scroll : '.nctouch-bottom-mask-rolling' + i,     // 滚动块，为空不触发滚动
                                });
                            }
                            // 领店铺代金券
                            $('.nctouch-voucher-list').on('click', '.btn', function(){
                                if(!$(this).hasClass('taken')){
                                    getVoucher($(this));
                                }
                            });
                            $('.store-activity').click(function(){
                                $(this).css('height', 'auto');
                            });
                        }else{
                           alert(result.data.error);
                        }
                    }
                }
            });
        }
        function initGuessLike() {
            $.getJSON(ApiUrl+'?ctl=Buyer_Index&met=likesList&typ=json', function (e) {
                 $(".title_guess").html("猜你喜欢");
                 $('.guess-like').html(template.render("like_g", e));
             });
        }
        initCartList();

        //删除购物车
        function delCartList(cart_id){
            $.ajax({
                url:ApiUrl+"/index.php?ctl=Buyer_Cart&met=delCartByCid&typ=json",
                type:"post",
                data:{k:key,u:getCookie('id'),id:cart_id},
                dataType:"json",
                success:function (res){
                    console.info(res);
                    if(checkLogin(res.login)){
                        if(res.status == 200){
                            initCartList();
                            delCookie('cart_count');
                            // 更新购物车中商品数量
                            getCartCount();
                        }else{
                            alert(res.msg);
                        }
                    }
                }
            });
        }
        //购买数量减
        function minusBuyNum(){
            var self = this;
            editQuantity(self,"minus");
        }
        //购买数量加
        function addBuyNum(){
            var self = this;
            editQuantity(self,"add");
        }
        //购买数量增或减，请求获取新的价格
        function editQuantity(self,type){
            var sPrents = $(self).parents(".cart-litemw-cnt");
            var cart_id = sPrents.attr("cart_id");
            var numInput = sPrents.find(".buy-num");
            var goodsPrice = sPrents.find(".goods-price");
            var buynum = parseInt(numInput.val());
            var quantity = 1;
            if(type == "add"){
                quantity = parseInt(buynum+1);
            }else {
                if(buynum >1){
                    quantity = parseInt(buynum-1);
                }else {
                    return false;
                }
            }
            $('.pre-loading').removeClass('hide');
            $.ajax({
                url:ApiUrl+"/index.php?ctl=Buyer_Cart&met=editCartNum&typ=json",
                type:"post",
                data:{k:key,u:getCookie('id'),cart_id:cart_id,num:quantity},
                dataType:"json",
                success:function (res){
                    console.info(res);
                    if(checkLogin(res.login)){
                        if(res.status == 200){
                            numInput.val(quantity);
                            /*goodsPrice.html('￥<em>' + res.data.price + '</em>');*/
                            calculateTotalPrice();
                        }else{
                            $.sDialog({
                                skin:"red",
                                content:res.msg,
                                okBtn:false,
                                cancelBtn:false
                            });
                        }
                        $('.pre-loading').addClass('hide');
                    }
                }
            });
        }

        //去结算
        $('#cart-list-wp').on('click', ".check-out > a", function(){
            if (!$(this).parent().hasClass('ok')) {
                return false;
            }
            //购物车ID
            var cartIdArr = [];
            $('.cart-litemw-cnt').each(function(){
                if ($(this).find('input[name="cart_id"]').prop('checked')) {
                    var cartId = $(this).find('input[name="cart_id"]').val();
                    var cartNum = parseInt($(this).find('.value-box').find("input").val());
                    var cartIdNum = cartId/*+"|"+cartNum*/;
                    cartIdArr.push(cartIdNum);
                }
            });
            var cart_id = cartIdArr;
            window.location.href = WapSiteUrl + "/tmpl/order/buy_step1.html?ifcart=1&cart_id="+cart_id;
        });

        //验证
        $.sValid.init({
            rules:{
                buynum:"digits"
            },
            messages:{
                buynum:"请输入正确的数字"
            },
            callback:function (eId,eMsg,eRules){
                if(eId.length >0){
                    var errorHtml = "";
                    $.map(eMsg,function (idx,item){
                        errorHtml += "<p>"+idx+"</p>";
                    });
                    $.sDialog({
                        skin:"red",
                        content:errorHtml,
                        okBtn:false,
                        cancelBtn:false
                    });
                }
            }  
        });
        function buyNumer(){
            $.sValid();
        }
    }

    // 店铺全选
    $('#cart-list-wp').on('click', '.store_checkbox', function(){
        $(this).parents('.nctouch-cart-container').find('input[name="cart_id"]').prop('checked', $(this).prop('checked'));
        calculateTotalPrice();
    });
    // 所有全选
    $('#cart-list-wp').on('click', '.all_checkbox', function(){
        $('#cart-list-wp').find('input[type="checkbox"]').prop('checked', $(this).prop('checked'));
        calculateTotalPrice();
    });
    
    $('#cart-list-wp').on('click', 'input[name="cart_id"]', function(){
        calculateTotalPrice();
    });
    var hasmore = true;
    var pagesize = 24;
    var curpage = 0;
    var firstRow = 0;
    $(window).scroll(function(e){
            if($(window).scrollTop() + $(window).height() == $(document).height()) {
                if(hasmore){
                    $.getJSON(ApiUrl+'?ctl=Buyer_Index&met=likesList&typ=json', function (e) {
                        $('.guess-like').append(template.render("like_g", e));
                        curpage++;
                        if(e.data){
                            firstRow = curpage * pagesize;
                            hasmore = true;
                            $('.no-data').hide();
                            $('.loading').show();
                        }else{
                            hasmore = false;
                            $('.no-data').show();
                            $('.loading').hide();
                        }
                    });
                }
            }
    });
    
});

function calculateTotalPrice() {
    var totalPrice = parseFloat("0.00");
    $('.cart-litemw-cnt').each(function(){
        if ($(this).find('input[name="cart_id"]').prop('checked')) {
            if($(this).data('type') == 'bl'){
                totalPrice += parseFloat($(this).find('.package_item_price').html()) * parseInt($(this).find('.value-box').find('input').val());
            }else{
                totalPrice += parseFloat($(this).find('.goods-price').find('em').html()) * parseInt($(this).find('.value-box').find('input').val());
            }
        }
    });
    $(".total-money").find('em').html(totalPrice.toFixed(2));
    check_button();
    return true;
}

function getGoods(goods_id, goods_num){
    var data = {};
    $.ajax({
        type:'get',
        url:ApiUrl+'/index.php?ctl=Goods_Goods&met=goodDetail&typ=json&goods_id='+goods_id,
        dataType:'json',
        async:false,
        success:function(result){
            if (result.status !== 200) {
                return false;
            }

            data.cart_id = goods_id;
            data.shop_id = result.data.goods_base.shop_id;
            data.store_name = result.data.goods_base.shop_name;
            data.goods_id = goods_id;
            data.goods_name = result.data.goods_base.goods_name;
            data.goods_price = result.data.goods_base.now_price;
            data.goods_num = goods_num;
            data.goods_image_url = result.data.goods_base.goods_image;
            data.goods_sum = (parseInt(goods_num)*parseFloat(result.data.goods_base.now_price)).toFixed(2);
        }
    });
    return data;
}

function get_footer() {
        footer = true;
        /*$.ajax({
            url: WapSiteUrl+'/js/tmpl/footer.js',
            dataType: "script"
          });*/
}

function check_button() {
    var _has = false
    $('input[name="cart_id"]').each(function(){
        if ($(this).prop('checked')) {
            _has = true;
        }
    });
    if (_has) {
        $('.check-out').addClass('ok');
    } else {
        $('.check-out').removeClass('ok');
    }
}