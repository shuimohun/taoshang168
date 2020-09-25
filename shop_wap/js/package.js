/**
 * Created by Zhenzh on 2017/08/03.
 */


$(function () {
    var b_id = getQueryString('b_id');
    if (b_id !== null || b_id !== undefined || b_id !== '') {

        new Mlink({
            mlink:'https://a0ncmk.mlinks.cc/Ab5y?name=bid&id='+b_id,
            button:document.querySelector('#btnOpenApp')
        });

        //激活分享
        var suid = getQueryString("suid");
        var from = getQueryString("from");
        var hash = location.hash;
        if(suid > 0 && b_id > 0 && (hash != "" || from)){
            $.ajax({
                url: ApiUrl + "?ctl=Goods_Goods&met=actShare",
                type: 'get',
                dataType: 'json',
                data:{'bid':b_id,'suid':suid,'hash':hash,'from':from},
                success: function(result) {
                }
            });
        }

        param = {};
        param.bid = b_id;
        $.getJSON(ApiUrl + "?ctl=Goods_Goods&met=getBundlingById&typ=json",param,function (e) {
            if(e.status == 200){
                $(".main").empty();
                var main = template.render("main", e.data);
                $(".main").append(main);

                $('.buynow').click(function () {
                    var key = getCookie('key');//登录标记

                    if(e.data.shop_owner)
                    {
                       /* $.sDialog({skin: "red", content: '不能购买自己商店的商品', okBtn: false, cancelBtn: false});*/
                       alert('不能购买自己商店的商品')
                        return;
                    }

                    if(!key){
                        callback = window.location.href;
                        login_url   = UCenterApiUrl + '?ctl=Login&met=index&typ=e';
                        callback = ApiUrl + '?ctl=Login&met=check&typ=e&redirect=' + encodeURIComponent(callback);
                        login_url = login_url + '&from=wap&callback=' + encodeURIComponent(callback);
                        window.location.href = login_url;
                    }else{
                        $.ajax({
                            url:ApiUrl+"/index.php?ctl=Buyer_Cart&met=addCart&typ=json",
                            data:{k:key,u:getCookie('id'),bl_id:b_id,goods_num:1},
                            type:"post",
                            success:function (result){
                                if(checkLogin(result.login)){
                                    if(result.status == 200){
                                        // 更新购物车中商品数量
                                        delCookie('cart_count');
                                        getCartCount();
                                        location.href = WapSiteUrl + "/tmpl/order/buy_step1.html?ifcart=1&cart_id="+result.data.cart_id;
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
                })

            }
        })
    }
});


function open_show(){
    $('.open').show();
    $('.open_close').on('click',function(){
        $(this).parents("section").css({'display':'none'});
        $('body').css({'margin-top':0});
        $('.nav').css({
            'position':'fixed',
            'top':'0'
        });
        addCookie('openshow',1,1);
    });
    if (getCookie('openshow')){
        $('.open').css({'display':'none'});
        $('body').css({'margin-top':0});
        $('.nav').css({
            'position':'fixed',
            'top':'0'
        });
    } else {
        $(this).parent().css({'display':'block'});
        // $('body').css({'margin-top':'1.8rem'});
    }
};
open_show();

