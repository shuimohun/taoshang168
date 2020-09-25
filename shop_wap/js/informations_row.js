
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
       }else{
           $.getJSON(ApiUrl + "?ctl=Api_Information_Group&met=informationGroupList&typ=json",function (e) {
               var data = e.data;
               var scHtml = template.render('list_l', data);
               $('.find_nav_left').html(scHtml);
               cell();
           });
           $.getJSON(ApiUrl + "?ctl=Information_Reply&met=get&typ=json",{article_id:infor_id},function (e) {
               var data = e.data;
               var html = template.render('comm_s', data);
               $('.comm').html(html);
           });
           $.getJSON(ApiUrl + "?ctl=Information_Base&met=get&typ=json",{information_id:infor_id,information_group_id:infor_type},function (e) {
               var data = e.data;
               var infou_count;
               if(data.infou_count==null){
                   infou_count =  0;
               }else{
                   infou_count =  data.infou_count;
               }

               // ifram = document.getElementById('yly');
               // if (navigator.userAgent.match(/iPad|iPhone/i)) {
               //     iframe_box = document.getElementById('contain_artical');
               //     iframe_box.style.width = 200 + 'px';
               //     iframe_box.style.height = 200 + 'px';
               //     iframe_box.style.border = '1 red';
               //     ifram.setAttribute('scrolling', 'no');
               //     iframe_box.appendChild(ifram)
               // }

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
                   +' <span>点赞'+infou_count +'次</span>'
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
               var desc = data.information_title;
               var share_img = data.information_pic;
               var link = WapSiteUrl+'/tmpl/informations.html?id=' + infro_id;
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
                       //朋友圈
                       wx.onMenuShareTimeline({
                           title: title, // 分享标题
                           desc:desc,
                           link: link, // 分享链接，该链接域名或路径必须与当前页面对应的公众号JS安全域名一致
                           imgUrl: share_img, // 分享图标
                           success: function () {
                               alert('分享成功');
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
                       // desc: desc,// 如果是微信该link的域名必须要在微信后台配置的安全域名之内的。
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
                           if(err.message){
                               alert(err.message)
                           }else{
                               alert('当前浏览器不支持此功能。')
                           }
                       }
                   }

                   $('.share').on('click',function () {
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
                           call(type);
                       }
                   });
               }
               $.animationUp({
                   valve : '.share_button',          // 动作触发
                   wrapper : '#share_html',    // 动作块
                   scroll : '',     // 滚动块，为空不触发滚动
               });

               /*---------------------------分享-------------------------------------------*/
           });
           //调用
           $("body").delegate(".greeWith","click", function(){
               greeWithClick($(this));
           })

            //分享
           var nativeShare = new NativeShare()
           var shareData = {
               title: '淘尚168商城',
               desc: name,
               // 如果是微信该link的域名必须要在微信后台配置的安全域名之内的。
               link: ApiUrl+'/index.php?ctl=Api_Information_Base&met=get&typ=json&information_id='+infor_id,
               icon: img,
               // 不要过于依赖以下两个回调，很多浏览器是不支持的
               success: function() {
                   alert('success')
               },
               fail: function() {
                   alert('fail')
               }
           }
           nativeShare.setShareData(shareData)
           function call(command) {
               try {
                   nativeShare.call(command)
               } catch (err) {
                   // 如果不支持，你可以在这里做降级处理
                   alert(err.message)
               }
           }
           function setTitle(title) {
               nativeShare.setShareData({
                   title: title,
               })
           }
           $("body").delegate(".share_button","click", function(){
               /*if (!key) {
                callback = window.location.href;
                login_url   = UCenterApiUrl + '?ctl=Login&met=index&typ=e';
                callback = ApiUrl + '?ctl=Login&met=check&typ=e&redirect=' + encodeURIComponent(callback);
                login_url = login_url + '&from=wap&callback=' + encodeURIComponent(callback);
                window.location.href = login_url;
                return false;
                }*/
               call();
           });

            //分享
           var nativeShare = new NativeShare()
           var shareData = {
               title: '淘尚168商城',
               desc: name,
               // 如果是微信该link的域名必须要在微信后台配置的安全域名之内的。
               link: ApiUrl+'?ctl=Api_Information_Base&met=get&typ=json&information_id='+infor_id,
               icon: img,
               // 不要过于依赖以下两个回调，很多浏览器是不支持的
               success: function() {
                   alert('success')
               },
               fail: function() {
                   alert('fail')
               }
           }
           nativeShare.setShareData(shareData)
           function call(command) {
               try {
                   nativeShare.call(command)
               } catch (err) {
                   // 如果不支持，你可以在这里做降级处理
                   alert(err.message)
               }
           }
           function setTitle(title) {
               nativeShare.setShareData({
                   title: title,
               })
           }
           $("body").delegate(".share_button","click", function(){
               /*if (!key) {
                callback = window.location.href;
                login_url   = UCenterApiUrl + '?ctl=Login&met=index&typ=e';
                callback = ApiUrl + '?ctl=Login&met=check&typ=e&redirect=' + encodeURIComponent(callback);
                login_url = login_url + '&from=wap&callback=' + encodeURIComponent(callback);
                window.location.href = login_url;
                return false;
                }*/
               call();
           });

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
        window.webkit.messageHandlers.NativeMethod.postMessage("like");
        if(icon.attr('src') == "./img/zan.png"){
            var e = getCookie("key");
            if(!e)
            {
                window.location.href = WapSiteUrl+"/tmpl/member/login.html";
                return;
            }
            var infor_id = icon.attr('infor_id');
            $.getJSON(ApiUrl + "?ctl=Information_Like&met=like&typ=json",{information_id:infor_id},function (e) {
                if(e.status == 200){
                    icon.attr('src','./img/zan_on.png');
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
                }else{
                    alert(e.msg);
                    if(e.msg=='需要登录'){
                        window.location.href = WapSiteUrl+"/tmpl/member/login.html";
                    }
                }
            });
        }
    }


})
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
    $.getJSON(ApiUrl + "?ctl=Api_Information_Base&met=informationBaseList&typ=json",{'information_group':id},function (e) {
        var data = e.data;
        var scHtml = template.render('item_m', data);
        $('.item_i').html(scHtml);
    });

}