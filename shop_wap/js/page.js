/*************************/


$(function(){
    var uid = getCookie('id'); //登录标记
       if(!uid){
           checkLogin(0)
       }

    var isWx;

    //判断是否在微信内
    var ua = navigator.userAgent.toLowerCase();
    if (ua.match(/MicroMessenger/i) == "micromessenger") {
        var isWx = 1;
    }




    /*我的晒图数据获取*/
    function getEvaluation(){
        $.getJSON(ApiUrl+'?ctl=Goods_Evaluation&met=wapGetEvalustion&typ=json',function(e){
            e.data.isWx = isWx;
            if(e.status ==200) {
                $(".main .contentEval").empty();
                var fansItem = template.render("fansItem", e.data);
                $(".main .contentEval").html(fansItem);
                $(".user-logo").attr("src", e.data.all.items[0][0].user_logo);
                $(".user-name").text(e.data.all.items[0][0].user_name);

                var noContent = template.render("noContent", e.data);
                $(".no-comment-pic").html(noContent);
                /* 粉丝圈   我的晒图   */
                var fans_no_comment_pic_element = $('<a href="./member/order_list.html?data-state=finish"><div class="mask"></div><span>查看更多</span></a>');
                fans_no_comment_pic_element.appendTo($(".no-comment-goods .no-comment-pic ul li:last"));
              //分享弹框

                var html = template.render('share_script', e.data);
                $("#share_html").html(html);


                $(".nctouch-bottom-mask-tip").click(function(){//点击返回 关闭弹框
                  $(".nctouch-bottom-mask").removeClass("up");
                  $(".nctouch-bottom-mask").addClass("down");
                })
                $(".nctouch-bottom-mask-close").click(function(){//点击关闭按钮 关闭弹框
                  $(".nctouch-bottom-mask").removeClass("up");
                  $(".nctouch-bottom-mask").addClass("down");
                })
                $(".nctouch-bottom-mask-bg").click(function(){//点击关闭按钮 关闭弹框
                  $(".nctouch-bottom-mask").removeClass("up");
                  $(".nctouch-bottom-mask").addClass("down");
                })

                /*分享注册*/
                /*点击开始*/
                var link = '';
                var share_img = '';
                var desc = '';
                $(".comment-icon3").click(function(){

                    $(".nctouch-bottom-mask").removeClass("down");
                    $(".nctouch-bottom-mask").addClass("up");
                    event.stopPropagation();
                    goods_id = $(this).data("id");
                    var id = getCookie('id'); //登录标记
                    if (id) {
                        var suid = '&suid=' + id;
                    }

                    link = ApiUrl + '?ctl=Goods_Goods&met=goods&gid=' + goods_id + suid + '&type=app&from=';
                    share_img = $(this).parent().prev().children().children("img").attr("src");
                    desc = $(this).parent().prev().children().children().children("p.fans-goods-title").text();
                })
                /*点击结束*/

                /*注册开始*/
                var title = '淘尚168商城';
                if (e.data.wxConfig)
                {
                    //微信内分享
                    wx.config({
                        debug: false,
                        appId: e.data.wxConfig.appId,
                        timestamp: e.data.wxConfig.timestamp,
                        nonceStr: e.data.wxConfig.nonceStr,
                        signature: e.data.wxConfig.signature,
                        jsApiList: ['onMenuShareTimeline', 'onMenuShareAppMessage', 'onMenuShareQQ', 'onMenuShareQZone']
                    });

                    //微信加载
                    wx.ready(function() {
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
                            },
                            cancel: function() {
                                alert('分享失败');
                            }
                        });

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
                            },
                            cancel: function() {
                                alert('分享失败');
                            }
                        });
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
                            },
                            cancel: function() {
                                alert('分享失败');
                            }
                        });
                    });
                }
                else {
                    var nativeShare = new NativeShare();

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

                    $('.share').click(function() {

                        var type = $(this).data('type');
                        if (type) {
                            //&type=app&from=
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

                            var shareData = {
                                title: title,
                                desc: desc,
                                // 如果是微信该link的域名必须要在微信后台配置的安全域名之内的。
                                link: link + stype,
                                icon: share_img,
                                // 不要过于依赖以下两个回调，很多浏览器是不支持的
                                success: function() {
                                    //alert('success')
                                },
                                fail: function() {
                                    //alert('fail')
                                }
                            };
                            // alert(shareData.link);
                            nativeShare.setShareData(shareData);
                            call(type);
                        }
                    });
                }
                /*注册结束*/



            }


        });
    }
    getEvaluation()
    /*注册分享插件*/


    /*---------粉丝圈-我的晒图  tab切换------------*/
    $(".fans-comment-tab .fans-comment-main").click(function () {
      $(".fans-comment-tab .fans-comment-main").removeClass("cur");
      $(this).addClass("cur");
    });



/*---------------分享按钮点击---------------------------*/






    /*-------------点击全部--------*/
    $(".hasAll").click(function(){
        getEvaluation()
    })
    /*--------点击有图-----------*/
    $(".hasImg").click(function () {
        $.getJSON(ApiUrl+'?ctl=Goods_Evaluation&met=wapGetEvalustion&typ=json&img=1',function(e){
            e.data.isWx = isWx;
            if(e.status ==200){
                var fansItem = template.render("fansItem",e.data);
                $(".main .contentEval").empty();
                $(".main .contentEval").html(fansItem);
                $(".user-logo").attr("src",e.data.all.items[0][0].user_logo);
                $(".user-name").text(e.data.all.items[0][0].user_name);

                var noContent = template.render("noContent",e.data);
                $(".no-comment-pic").html(noContent);

                var html = template.render('share_script', e.data);
                $("#share_html").html(html);

                /* 粉丝圈   我的晒图   */
                var fans_no_comment_pic_element = $('<a href="./member/order_list.html?data-state=finish"><div class="mask"></div><span>查看更多</span></a>');
                fans_no_comment_pic_element.appendTo($(".no-comment-goods .no-comment-pic ul li:last"));

                $(".nctouch-bottom-mask-tip").click(function(){//点击返回 关闭弹框
                    $(".nctouch-bottom-mask").removeClass("up");
                    $(".nctouch-bottom-mask").addClass("down");
                })
                $(".nctouch-bottom-mask-close").click(function(){//点击关闭按钮 关闭弹框
                    $(".nctouch-bottom-mask").removeClass("up");
                    $(".nctouch-bottom-mask").addClass("down");
                })
                $(".nctouch-bottom-mask-bg").click(function(){//点击关闭按钮 关闭弹框
                    $(".nctouch-bottom-mask").removeClass("up");
                    $(".nctouch-bottom-mask").addClass("down");
                })

                //切换点赞样式
                tickle();
            }else if(e.status==250){
                alert("请登录");
            }


        });
    });

});






function tickle(i,evalId){
    var i=$(i);
    var evaluation_goods_id = evalId;
    var key = getCookie('key');
    if (!key) {
        checkLogin(0);
        return;
    }
    var prev = i.prev();
    if(i.hasClass("on"))
    {

        /*取消点赞*/
        $.ajax({
            type: 'post',
            url: ApiUrl + '?ctl=Goods_Evaluation&met=cancleEvaluationTickle&typ=json',
            data: {eId: evaluation_goods_id},
            dataType: 'json',
            async: false,
            success: function(result) {
                if(result.status=200){

                    var content='';
                    if(result.data.countTickle==null){
                        content +="点赞0次";
                    }else{
                        content +="点赞"+result.data.countTickle+"次";
                    }
                    prev.html(content);
                    i.removeClass("on");
                }
            }
        });

    }
    else
    {

        /*点赞*/
        $.ajax({
            type: 'post',
            url: ApiUrl + '?ctl=Goods_Evaluation&met=addEvaluationTickle&typ=json',
            data:{eId:evaluation_goods_id},
            dataType: 'json',
            async: false,
            success: function(result) {
                if(result.status=200){

                    var content='';
                    if(result.data.countTickle==null){
                        content +="点赞0次";
                    }else{
                        content +="点赞"+result.data.countTickle+"次";
                    }
                    prev.html(content);
                    i.addClass("on");
                }
            }
        });
    }

}










