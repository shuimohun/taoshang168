
$(function(){

    var url = window.location.search;
    var infor =  url.substr(1);
    var infor_row= infor.split('&');
    var infor_i = infor_row[0].split('=');
    var infor_id = infor_i[1];
    if(infor_row[1]!=undefined){
        var infor_t = infor_row[1].split('=');
        var infor_type= infor_t[1];
    }
    var name = '';
    var img = '';
       if(infor_id==''&&infor_type==''){
            alert('没有咨询id，请仔细查看');
            history.go(-1);
       }
       else{

           $.getJSON(ApiUrl + "?ctl=Information_Group&met=informationGroupList&typ=json",function (e) {
               var data = e.data;
               var scHtml = template.render('list_l', data);
               $('.find_nav_left').html(scHtml);
               cell();
           });
           $.getJSON(ApiUrl + "?ctl=Information_Reply&met=get&typ=json",{article_id:infor_id},function (e) {
               var html = template.render('comm_s', e.data);
               $('.comm').html(html);
           });
           $.getJSON(ApiUrl + "?ctl=Information_Base&met=get&typ=json",{information_id:infor_id,information_group_id:infor_type},function (e) {
               var goods = template.render('goods_recommend', e);
               $('.zx_goods').html(goods);
               var data = e.data;
               var infou_count;
               if(data.infou_count==null){
                   infou_count =  0;
               }else{
                   infou_count =  data.infou_count;
               }
              var is_like = '';
               if(data.is_like==1){
                    is_like = '<img src="./img/zan_on.png" alt="" infor_id="'+ data.information_id+'" class="greeWith n_like">';
               }else{
                   is_like = '<img src="./img/zan.png" alt="" infor_id="'+ data.information_id+'" class="greeWith i_like">';
               }
               name = data.information_title;
               img = data.information_pic;
               var html = '' +
                   '<div class="title">'+data.information_title+'</div>'
                   +' <div class="title_date">'+data.information_add_time+'</div>'
                   +' <div class="contain_img"><img src="'+data.information_pic+'" alt=""></div>'
                   +' <div class="contain_artical">'+data.information_desc+'</div>'
                   +' <span>浏览'+ data.read_count +'次</span>'
                   +' <span >点赞<span class="dz" style="margin-right:0">'+infou_count +'</span>次</span>'
                   +' <span class="share_button">分享</span>'
                   + is_like;
               $('.contain').html(html);

               /*---------------------------分享-------------------------------------------*/
               var html = template.render('share_script', data);
               $("#share_html").html(html);
               $('.share_button').on('click',function(){
                  $('.share_tanchuang').show();
                  $('.bg_contain').show();
               });
               $('.bg_contain').on('click',function () {
                   $('.share_tanchuang').hide();
                   $('.bg_contain').hide();
               })

               //分享
               var id = getCookie('id');//登录标记
               var suid = '';
               if(id){
                   suid = '&suid='+id;
               }
               var title = data.information_title;
               var infro_id = data.id;
               var desc = "关注说说，发文章、发视频、阅读、转发、点赞，赚金蛋换大奖";
               var share_img = data.information_pic;
               var link = WapSiteUrl+'/tmpl/information.html?id=' + infro_id+'&type=app&from=';
               if(data.wxConfig){
                   //微信内分享
                   wx.config({
                       debug: false,
                       appId: data.wxConfig.appId,
                       timestamp:data.wxConfig.timestamp,
                       nonceStr: data.wxConfig.nonceStr,
                       signature: data.wxConfig.signature,
                       jsApiList: [
                           'onMenuShareTimeline',
                           'onMenuShareAppMessage',
                           'onMenuShareQQ',
                           'onMenuShareQZone'
                       ]
                   });

                   //微信加载
                   wx.ready(function () {
                       var key = getCookie("key");
                       //朋友圈
                       wx.onMenuShareTimeline({
                           title: title, // 分享标题
                           desc:desc,
                           link: link, // 分享链接，该链接域名或路径必须与当前页面对应的公众号JS安全域名一致
                           imgUrl: share_img, // 分享图标
                           success: function () {
                               alert('分享成功');

                               if( key )
                               {
                                   share_point();
                               }
                           },
                           cancel: function () {
                               alert('分享失败');
                           }
                       });
                       //微信朋友
                       wx.onMenuShareAppMessage({
                           title: title, // 分享标题
                           desc: desc, // 分享描述
                           link: link, // 分享链接，该链接域名或路径必须与当前页面对应的公众号JS安全域名一致
                           imgUrl:share_img, // 分享图标
                           success: function () {
                               alert('分享成功');
                               if( key )
                               {
                                   share_point();
                               }
                           },
                           cancel: function () {
                               alert('分享失败');
                           }
                       });

                       wx.onMenuShareQQ({
                           title:title, // 分享标题
                           desc:desc, // 分享描述
                           link:link, // 分享链接
                           imgUrl:share_img, // 分享图标
                           success: function () {
                               alert('分享成功');
                               if( key )
                               {
                                   share_point();
                               }
                           },
                           cancel: function () {
                               alert('分享失败');
                           }
                       });
                       wx.onMenuShareQZone({
                           title:title, // 分享标题
                           desc:desc, // 分享描述
                           link:link, // 分享链接
                           imgUrl:share_img, // 分享图标
                           success: function () {
                               alert('分享成功');
                               if( key )
                               {
                                   share_point();
                               }
                           },
                           cancel: function () {
                               alert('分享失败');
                           }
                       });
                   });
               }else{
                   var nativeShare = new NativeShare();
                   var shareData = {
                       title: title,
                       desc: desc,// 如果是微信该link的域名必须要在微信后台配置的安全域名之内的。
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
                           console.log(command);
                           return false;
                           nativeShare.call(command)
                       } catch (err) {
                           // 如果不支持，你可以在这里做降级处理
                           if(err.message){
                               alert(err.message)
                           }else{
                               alert('当前浏览器不支持此功能。')
                           }
                       }
                   }

                   $('.share').on('click',function () {

                       var key = getCookie("key")
                       if( key )
                       {
                           share_point();
                       }
                       var type = $(this).data('type');
                       if(type){
                           //&type=app&from=
                           stype = '';
                           if(type == 'qZone'){
                               stype = 'qzone';
                           }else if(type == 'qqFriend'){
                               stype = 'sqq';
                           }else if(type == 'wechatFriend'){
                               stype = 'weixin';
                           }else if(type == 'wechatTimeline'){
                               stype = 'weixin_timeline';
                           }else if(type == 'weibo'){
                               stype = 'tsina';
                           }
                           shareData.link = shareData.link + stype;
                           nativeShare.setShareData(shareData);
                           console.log( shareData.link);
                           call(type);
                       }
                   });
               }
/*               $.animationUp({
                   valve : '.share_button',          // 动作触发
                   wrapper : '#share_html',    // 动作块
                   scroll : '',     // 滚动块，为空不触发滚动
               });*/

               /*---------------------------分享-------------------------------------------*/

               /**
                * 商品推荐样式 Start
                */
               var goods_num = $(".zx_goods .zx_goods_list ul li").length;
               // console.log(goods_num)
               if(goods_num == 1){
                   $(".zx_goods .zx_goods_list").removeClass("two_goods");
                   $(".zx_goods .zx_goods_list").removeClass("three_goods");
                   $(".zx_goods .zx_goods_list").addClass("one_goods");
               }
               if(goods_num == 2){
                   $(".zx_goods .zx_goods_list").removeClass("one_goods");
                   $(".zx_goods .zx_goods_list").removeClass("three_goods");
                   $(".zx_goods .zx_goods_list").addClass("two_goods");
               }
               if(goods_num == 3){
                   $(".zx_goods .zx_goods_list").removeClass("one_goods");
                   $(".zx_goods .zx_goods_list").removeClass("two_goods");
                   $(".zx_goods .zx_goods_list").addClass("three_goods");
               }
               if(goods_num > 3){
                   $(".zx_goods .zx_goods_list").removeClass("one_goods");
                   $(".zx_goods .zx_goods_list").removeClass("two_goods");
                   $(".zx_goods .zx_goods_list").removeClass("three_goods");
               }
               /**
                *商品推荐样式  End
                */

           });
           //调用
           $("body").delegate(".greeWith","click", function(){
               greeWithClick($(this));
           })
       }
    $('.but').on('click',function(){
        var e = getCookie("key");
        if(!e)
        {
            window.location.href = WapSiteUrl+"/tmpl/member/login.html";
            return;
        }
        if($('#review').val()!=''){
            var content = $('#review').val();
            $.getJSON(ApiUrl + "?ctl=Information_Reply&met=add&typ=json",{information_id:infor_id,information_reply_content:content},function (e) {
                if(e.status == 200){
                var html = '' +
                '<div class="comment">'
                    +'<div class="comment_img"><img src="'+e.data.user_logo+'" alt=""></div>'
                    +'<span>'+e.data.user_name+'</span>'
                    +'<i>'+e.data.article_reply_content+'</i>'
                    +'<em>'+e.data.article_reply_time+'</em>'
                    +'</div>';
                    $('.comm').before(html);
                    //评论成功后，清除评论框里的内容
                    $('#review').val('');
                }else{
                   alert(e.msg);
                   return false;
                }
            });
        }else{
            alert(e.msg);
            return false;
        }
    })

    //点赞
    function greeWithClick(icon){
        if(icon.attr('src') == "./img/zan.png"){
            var e = getCookie("key");
            if(!e)
            {
                window.location.href = WapSiteUrl+"/tmpl/member/login.html";
                return;
            }
            var infor_id = icon.attr('infor_id');
            $.getJSON(ApiUrl + "?ctl=News&met=getLike&typ=json",{id:infor_id,from:'point'},function (e) {
                if(e.status == 200){
                    icon.attr('src','./img/zan_on.png');
                    var dz = $('.dz').html();
                    $('.dz').html(parseInt(dz)+parseInt(1));
                }else{
                    alert(e.msg);
                    if(e.msg=='需要登录'){
                        window.location.href = WapSiteUrl+"/tmpl/member/login.html";
                    }
                }
            });
        }
        else if(icon.attr('src') == "./img/zan_on.png"){
            var e = getCookie("key");
            if(!e)
            {
                window.location.href = WapSiteUrl+"/tmpl/member/login.html";
                return;
            }
            var infor_id = icon.attr('infor_id');
            $.getJSON(ApiUrl + "?ctl=Information_Like&met=unLike&typ=json",{information_id:infor_id},function (e) {
                if(e.status == 200){
                    icon.attr('src','./img/zan.png');
                    var dz = $('.dz').html();
                    $('.dz').html(dz-1);
                }else{
                    alert(e.msg);
                    if(e.msg=='需要登录'){
                        window.location.href = WapSiteUrl+"/tmpl/member/login.html";
                    }
                }
            });
        }
    }


    setTimeout(function(){
        getPoint()
    }, 20000);

    //阅读增加金蛋
    function getPoint(){
        $.ajax({
            type: 'GET',
            url: ApiUrl + '?ctl=Information_Base&met=readPoint&typ=json&information_id='+infor_id,
            dataType: 'json',
            async: false,
            success: function(result) {
                if( result.status == 200 )
                {
                    alert("阅读完成,增加金蛋拉")
                }
            }
        })
    }

    //分享增加金蛋
    function share_point(){
        $.ajax({
            type: 'POST',
            url: ApiUrl + '?ctl=News&met=share_point&typ=json',
            data:{information_id:infor_id},
            dataType: 'json',
            async: false,
            success: function(result) {
                console.log(result)
            }
        })
    }
})
function common_alert(){

    if ($('.info_alert').css('display') == 'none'){
        $('.info_alert').css({'display': 'block'});


        var $el = '<img src="../images/user_img/choose_gray@3x.png" alt=""> <a href="../index.html"><span><img src="../images/user_img/more_home@2x.png" alt=""><u>商城首页</u></span></a><a href="cart_list.html"><span><img src="../images/user_img/more_cart@2x.png" alt=""><u>购物车</u></span></a><a href="../tmpl/member/order_list.html"><span><img src="../images/user_img/more_form@2x.png" alt=""><u>我的订单</u></span></a><a href="../tmpl/member/chat_list.html"><span><img src="../images/bbc-bg36.png" alt=""><u>消息</u></span></a>'

        $('.info_alert').html($el);
    }
    else{
        $('.info_alert').css({'display': 'none'});
    }
}
//标题滚动
function  cell() {
    $(".find_nav_list").css("left",sessionStorage.left+"px");
    $(".find_nav_list li").each(function(){
        if($(this).find("a").text()==sessionStorage.pagecount){
            $(".sideline").css({left:$(this).position().left});
            $(".sideline").css({width:$(this).outerWidth()});
            // $(this).addClass("find_nav_cur").siblings().removeClass("find_nav_cur");
            /* navName(sessionStorage.pagecount);*/
            return false
        }
        else{
            $(".sideline").css({left:0});
            // $(".find_nav_list li").eq(0).addClass("find_nav_cur").siblings().removeClass("find_nav_cur");
        }
    });
    var nav_w=$(".find_nav_list li").first().width();
    $(".sideline").width(nav_w);
    $(".find_nav_list li").on('click', function(){
        nav_w=$(this).width();
        $(".sideline").stop(true);
        $(".sideline").animate({left:$(this).position().left},300);
        $(".sideline").animate({width:nav_w});
        // $(this).addClass("find_nav_cur").siblings().removeClass("find_nav_cur");
        var fn_w = ($(".find_nav").width() - nav_w) / 2;
        var fnl_l;
        var fnl_x = parseInt($(this).position().left);
        if (fnl_x <= fn_w) {
            fnl_l = 0;
        } else if (fn_w - fnl_x <= flb_w - fl_w) {
            fnl_l = flb_w - fl_w;
        } else {
            fnl_l = fn_w - fnl_x;
        }
        $(".find_nav_list").animate({
            "left" : fnl_l
        }, 300);
        sessionStorage.left=fnl_l;
        var c_nav=$(this).find("a").text();
        /*navName(c_nav);*/
    });
    var fl_w=$(".find_nav_list").width();
    var flb_w=$(".find_nav_left").width();
    $(".find_nav_list").on('touchstart', function (e) {
        var touch1 = e.originalEvent.targetTouches[0];
        x1 = touch1.pageX;
        y1 = touch1.pageY;
        ty_left = parseInt($(this).css("left"));
    });
    $(".find_nav_list").on('touchmove', function (e) {
        var touch2 = e.originalEvent.targetTouches[0];
        var x2 = touch2.pageX;
        var y2 = touch2.pageY;
        if(ty_left + x2 - x1>=0){
            $(this).css("left", 0);
        }else if(ty_left + x2 - x1<=flb_w-fl_w){
            $(this).css("left", flb_w-fl_w);
        }else{
            $(this).css("left", ty_left + x2 - x1);
        }
        if(Math.abs(y2-y1)>0){
            e.preventDefault();
        }
    });
}
function  biaoti(id) {
    $.getJSON(ApiUrl + "?ctl=Information_Base&met=informationBaseList&typ=json",{'information_group':id},function (e) {
        var data = e.data;
        var scHtml = template.render('item_m', data);
        $('.item_i').html(scHtml);
    });

}
function  recommend() {
    $.getJSON(ApiUrl + "?ctl=Information_Base&met=recommendList&typ=json",function (e) {
        var recommendHtml = template.render('recommend', e.data);
        $('.recommend').html(recommendHtml);
    });

}
recommend();

function open_show(){
        $('.open').show();
        $('.open_close').on('click',function(){
            $(this).parent().css({'display':'none'});
            $('body').css({'margin-top':'.8rem'});
            $('.person').css({
                'position':'fixed',
                'top':'0'
            });
            addCookie('openshow',1,1);
        });
        if (getCookie('openshow')){
            $('.open').css({'display':'none'});
            $('body').css({'margin-top':'.8rem'});
            $('.person').css({
                'position':'fixed',
                'top':'0'
            });
        } else {
            $(this).parent().css({'display':'block'});
            $('body').css({'margin-top':'1.6rem'});
        }
    };
    open_show();
