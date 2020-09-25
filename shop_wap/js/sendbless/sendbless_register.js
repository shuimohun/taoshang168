

var goods_id = getQueryString('gid');
var fu_id = getQueryString('fu_id');
//激活分享
var share_uid   = getQueryString("suid");
var su_name     = getQueryString("suname");
var from        = getQueryString("from");
var type        = getQueryString("type");
var hash        = location.hash;
var gid         = goods_id;
var cid;
$(function () {
    if(!goods_id)
    {
        location.href =WapSiteUrl+'/tmpl/sendbless_list.html';
    }

//判断是否在微信内
    var ua = navigator.userAgent.toLowerCase();
    if (ua.match(/MicroMessenger/i) == "micromessenger") {
        var isWx = 1;
    }

/**新人优惠商品信息*/
    function NewBuyer(){
        $.ajax({
            type: 'GET',
            url: ApiUrl + '?ctl=NewBuyer&met=index&typ=json',
            dataType: 'json',
            data:{firstRow:0,type_id:0},
            async: false,
            success: function(e) {
                if(e.status == 200)
                {
                    var Fu_newBuy = template.render("Fu_newBuy",e);
                    $(".more_item .Fu_newBuy").html(Fu_newBuy);
                }


            }
        })
    }
    NewBuyer()
/*--------新人优惠end--------*/
/*惠抢购商品信息s*/

    var H_firstRow = 0;
    var H_listRows = 5;
    var H_more     =true;
    function scarebuy(more){
        $.ajax({
            type: 'POST',
            url: ApiUrl + '?ctl=ScareBuy&met=index&typ=json',
            dataType: 'json',
            data:{firstRow:H_firstRow,listRows:H_listRows},
            async: false,
            success: function(e) {

                if(more)
                {
                    var scareBuy = template.render("scareBuy",e);
                    $(".scareBuy").append(scareBuy);
                }else{
                    var scareBuy = template.render("scareBuy",e);
                    $(".scareBuy").html(scareBuy);
                }

                var _TimeCountDown = $(".fnTimeCountDown");
                _TimeCountDown.fnTimeCountDown();
                H_firstRow = e.data.goods.page * H_listRows;
                if(H_firstRow>e.data.goods.totalsize)
                {
                    H_more = false;
                }
            }
        })
    }
/*点击惠抢购*/
    $(".more_nav ul li").eq(1).on('click',function () {
        H_firstRow=0;
        scarebuy()
    })
/*获取惠抢购商品信息 end*/
/*限时折扣商品信息 s*/
    function getDiscount() {
        $.ajax({
            type: 'POST',
            url: ApiUrl + '?ctl=Api_App_Discount&met=getContentByTab&typ=json',
            dataType: 'json',
            data:{is_not:2,nav:0},
            async: false,
            success: function(e) {
                var Discount = template.render("Discount",e);
                $(".Discount").html(Discount);

            }
        })
    }
/*点击限时获取数据*/
    $(".more_nav ul li").eq(2).on('click',function () {
        getDiscount()
    })
/*获取限时折扣商品信息 end*/

/*好物包邮数据获取s*/
    var F_page = 1;
    var F_rows = 15;
    var F_more = true;
    function getGoodsFree(more) {
        $.ajax({
            type: 'POST',
            url: ApiUrl + '?ctl=Goods_Goods&met=getGoodsFree&typ=json',
            dataType: 'json',
            data:{page:F_page,rows:F_rows},
            async: false,
            success: function(e) {
                if(e.status==200)
                {
                    if(more)
                    {
                        var GoodsFreeAppend = template.render("GoodsFreeAppend",e);
                        $(".GoodsFree .list ul").append(GoodsFreeAppend);
                    }else{
                        var GoodsFree = template.render("GoodsFree",e);
                        $(".GoodsFree .list").html(GoodsFree);
                    }
                    if(F_page>e.data.total)
                    {
                        F_more=false;
                    }
                    F_page++;

                }
            }
        })
    }
    $(".more_nav ul li").eq(3).on('click',function () {
        getGoodsFree()
    })

/*好物包邮数据end*/
/*底部导航栏切换*/
   function footNav() {
       //新人优惠，惠抢购，限时折扣，好物包邮切换效果
       $(".more_nav ul li").click(function(){
           var _this = $(this).index();
           $(this).addClass("on").siblings().removeClass("on");
           $(".more_wrap ul li").eq(_this).show().siblings().hide();
       })
   }
/*底部导航栏切换end*/

/*添加送福记录*/
 function addFu(type){
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
     $.ajax({
         type: 'POST',
         url: ApiUrl + '?ctl=Goods_Goods&met=addFu&typ=json',
         dataType: 'json',
         data:{gid:addFu_gid,type:share_type},
         async: false,
         success: function(e) {

             if( e.status ==250 )
             {
                 $.sDialog({
                     'content':e.msg,
                     'cancelBtn':false,
                     okFn:function () {
                         return false;
                     }
                })
             }
         }
     })
 }

    //弹框福袋
    /*var pop_H = $(".pop_bless_con").height();
    console.log(pop_img_H)
    $(".pop_bless_con img").css({"margin-top":(pop_img_H/2)})
    */
    //获取当前时间函数
    function p(s) {
        return s < 10 ? '0' + s: s;
    }
    var uid = getCookie("id");
    function getRecord() {

        $.ajax({
            type: 'POST',
            url: ApiUrl + '?ctl=Goods_GoodsFu&met=getRecord&typ=json',
            dataType: 'json',
            data:{uid:uid,gid:goods_id,fu_id:fu_id},
            async: false,
            success: function(e) {

                if( e.status ==200 )
                {
                    //open link

                    new Mlink({
                        mlink:'https://a0ncmk.mlinks.cc/Ab5y?name=gid&id='+e.data.margin2.goods_id,
                        button:document.querySelector('img#btnOpenApp')
                    });


                    /*添加送福记录 start 福框默认隐藏,点击链接进来显示*/
                    $(".pop_video").hide();
                    if (share_uid > 0 && (gid > 0 || cid > 0) && (type == 'app' || hash != "") && from) {
                        // console.log(uid);
                        /*获取用户商品活动状态**/
                        $.ajax({
                            type: 'POST',
                            url: ApiUrl + '?ctl=Goods_GoodsFu&met=recordResult&typ=json',
                            dataType: 'json',
                            data:{uid:share_uid,gid:goods_id,fu_id:fu_id},
                            async: false,
                            success: function( res ) {
                                var tip_text;
                                if( res.status == 200 )
                                {

                                    if( res.data.share_result.status == 4 && su_name.length >0 )
                                    {
                                        tip_text= '您的好友送福免单成功,赶快参加送福吧!';

                                    }
                                    else if( res.data.share_result.status != 4 && su_name.length >0 )
                                    {
                                        if( e.data.bless_user.register == 0 )
                                        {
                                            tip_text= '成功帮助'+su_name+'集福成功,赶快参加送福吧!';

                                        }
                                        else if( e.data.bless_user.register == 1 )
                                        {
                                            tip_text= '需要注册帮助好友'+su_name+'集福!';
                                        }
                                    }

                                    tip_text+='立即注册';

                                }
                                else
                                {
                                    tip_text='快快参加送福免单活动吧!!!';
                                }
                                $(".inter_page_text").html(tip_text);
                            }
                        })

                        //点击注册按钮,跳转注册页面,按分享类型跳转
                        $(".inter_page_text").click(function () {
                            //http://www.taos168.com/ucenter/index.php?ctl=Login&met=reg&from=qq/wx/wb
                            var callback = window.location.href;
                            if( from == 'singlemessage' || from == 'timeline' || from == 'weixin' || from == 'weixin_timeline' || from == 'groupmessage' )
                            {
                                window.location.href = UCenterApiUrl+'?ctl=Login&met=reg&from=wx&callback='+ encodeURIComponent(callback);
                            }
                            if( from =='sqq' || from =='qzone' )
                            {
                                window.location.href = UCenterApiUrl+'?ctl=Login&met=reg&from=qq&callback='+ encodeURIComponent(callback);
                            }
                            if( from =='tsina' )
                            {
                                window.location.href = UCenterApiUrl+'?ctl=Login&met=reg&from=wb&callback='+ encodeURIComponent(callback);
                            }
                        })
                        
                        
                        /*弹福框*/
                        var video = getCookie("video"+gid+from);
                        console.log( video );
                        if(video)
                        {
                            $(".pop_video").hide();
                        }
                        else
                        {
                            addCookie("video"+gid+from,"1",2);
                            $(".pop_video").show();
                        }
                        var video = document.getElementById("canvas");
                        var video_H = video.offsetHeight;
                        video.style.marginTop = -video_H+"px";
                        $(".pop_btn_close").click(function () {
                            $(".pop_video").hide();
                        })

                        $(".pop_bless_btn").click(function () {
                                $(".pop_video").hide();
                            })
                        $.ajax({
                            url: ApiUrl + "?ctl=Goods_Goods&met=activeFu&typ=json",
                            type: 'get',
                            dataType: 'json',
                            data: {
                                'gid': gid,
                                'cid': cid,
                                'suid': share_uid,
                                'hash': hash,
                                'from': from,
                                'type': type
                            },
                            success: function(result) {}
                        });
                    }
                    /*添加送福记录end*/

                    if( e.data.margin2.fu_state == 2 )
                    {
                        $.sDialog({
                            'content':'商品已抢光,看看别的吧(*^▽^*)',
                            'cancelBtn':false,
                            okFn:function () {
                                location.href =WapSiteUrl+'/tmpl/sendbless_list.html';
                            }
                        })
                    }
                    var margin2 = template.render("margin2",e);
                    $(".margin2").html(margin2);
                    footNav();
                    var bless_user = template.render("bless_user",e);
                    $(".bless_user").html(bless_user);
                    if(e.data.bless_user.status == 1)
                    {
                        if(e.data.margin2.end_time){
                            /**活动结束倒计时*/
                            var _TimeCountDown = $(".fnTimeCountDown");
                            _TimeCountDown.fnTimeCountDown();
                        }
                    }
                    else if(e.data.bless_user.status ==2)
                    {
                        if(e.data.margin2.end_time){
                            /**活动结束倒计时*/
                            var _TimeCountDown = $(".fnTimeCountDown");
                            _TimeCountDown.fnTimeCountDown();
                        }
                    }
                    else if(e.data.bless_user.status ==3 || e.data.bless_user.status == 4)
                    {
                        var $dateShow1=$(".fnTimeCountDown");
                        $dateShow1.find(".hour").html("00");
                        $dateShow1.find(".mini").html("00");
                        $dateShow1.find(".sec").html("00");
                    }

                    var title = e.data.margin2.fu_name;
                    $(".cx_title p").html(title);

                     //分享
                    var good_id = goods_id;

                    var desc = '我在免费领取'+e.data.margin2.goods_name+',送福免单活动真实有效!!!';
                    var share_img = e.data.margin2.goods_image;

                    var id = getCookie('id'); //登录标记
                    var suid = '';
                    if (id) {
                        suid = '&suid=' + id;
                    }
                    var countNum = ++e.data.margin2.sale_countFu;
                    var title = '';
                    if( e.data.bless_user.register == 0 )
                    {
                        title = '我是第'+countNum+'个送福免单,请您帮忙点击集个福,赶紧参加免费领取';
                    }
                    else if(e.data.bless_user.register == 1 )
                    {
                        title = '我是第'+countNum+'个送福免单,请您帮忙注册集个福,赶紧参加免费领取';
                    }

                    var suname = getCookie("user_account");
                    var link = WapSiteUrl + '/tmpl/sendbless_register.html?gid=' + good_id + suid + '&suname='+suname+'&fu_id='+fu_id+'&type=app&from=';
                    if (e.data.wxConfig) {


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
                            $('.share_img').on('click', function() {
                                var key = getCookie("key");
                                if( !key )
                                {
                                    var callback = window.location.href;
                                    var regUrl = UCenterApiUrl + '?ctl=Login&act=reg&t=';
                                    var reg_url = regUrl + '&from=wap&callback=' + encodeURIComponent(callback);
                                    window.location.href = reg_url;
                                    return false;
                                }
                                else
                                {
                                    if( e.data.fu_order_flag == 1)
                                    {
                                        alert("您有包含此商品的订单尚未完成,此时分享不享受送福免单");
                                        // return false;
                                    }
                                    if( e.data.default_adress !=1 )
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
                                            alert("下载app送福成功率更高哦,不下载请点击右上角三个小点分享送福")
                                            return false;
                                        }
                                    }
                                    else
                                    {
                                        alert("下载app送福成功率更高哦,不下载请点击右上角三个小点分享送福")
                                    }

                                }
                            });
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
                                    if( e.data.bless_user.status ==2 ) //已完成 未领取
                                    {
                                        /*判断时间是否过期,过期重新参加,覆盖之前记录,没有过期提示领取,*/
                                        var myDate = new Date();
                                        //获取当前年
                                        var year=myDate.getFullYear();
                                        //获取当前月
                                        var month=myDate.getMonth()+1;
                                        //获取当前日
                                        var date=myDate.getDate();
                                        var h=myDate.getHours();       //获取当前小时数(0-23)
                                        var m=myDate.getMinutes();     //获取当前分钟数(0-59)
                                        var s=myDate.getSeconds();
                                        var now=year+'-'+p(month)+"-"+p(date)+" "+p(h)+':'+p(m)+":"+p(s);

                                        if(now>e.data.margin2.end_time)
                                        {           //时间过期
                                            addFu("wechatTimeline");
                                        }
                                    }
                                    else if( e.data.bless_user.status ==3 || e.data.bless_user.status ==4 || e.data.bless_user.status ==0 || e.data.bless_user.status ==5 ) //已领取 或者以失败分享重新参加活动
                                    {
                                        /*添加活动记录 addFu*/
                                        addFu("wechatTimeline");
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
                                    if( e.data.bless_user.status ==2 ) //已完成 未领取
                                    {
                                        /*判断时间是否过期,过期重新参加,覆盖之前记录,没有过期提示领取,*/
                                        var myDate = new Date();
                                        //获取当前年
                                        var year=myDate.getFullYear();
                                        //获取当前月
                                        var month=myDate.getMonth()+1;
                                        //获取当前日
                                        var date=myDate.getDate();
                                        var h=myDate.getHours();       //获取当前小时数(0-23)
                                        var m=myDate.getMinutes();     //获取当前分钟数(0-59)
                                        var s=myDate.getSeconds();
                                        var now=year+'-'+p(month)+"-"+p(date)+" "+p(h)+':'+p(m)+":"+p(s);

                                        if(now>e.data.margin2.end_time)
                                        {           //时间过期
                                            addFu("wechatFriend");
                                        }
                                    }
                                    else if( e.data.bless_user.status ==3 || e.data.bless_user.status ==4 || e.data.bless_user.status ==0 || e.data.bless_user.status ==5 ) //已领取 或者以失败分享重新参加活动
                                    {
                                        /*添加活动记录 addFu*/
                                        addFu("wechatFriend");
                                    }
                                },
                                cancel: function() {
                                    alert('分享失败');
                                }
                            });
                            //qq好友
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
                                    if( e.data.bless_user.status ==2 ) //已完成 未领取
                                    {
                                        /*判断时间是否过期,过期重新参加,覆盖之前记录,没有过期提示领取,*/
                                        var myDate = new Date();
                                        //获取当前年
                                        var year=myDate.getFullYear();
                                        //获取当前月
                                        var month=myDate.getMonth()+1;
                                        //获取当前日
                                        var date=myDate.getDate();
                                        var h=myDate.getHours();       //获取当前小时数(0-23)
                                        var m=myDate.getMinutes();     //获取当前分钟数(0-59)
                                        var s=myDate.getSeconds();
                                        var now=year+'-'+p(month)+"-"+p(date)+" "+p(h)+':'+p(m)+":"+p(s);

                                        if(now>e.data.margin2.end_time)
                                        {           //时间过期
                                            addFu("qqFriend");
                                        }
                                    }
                                    else if( e.data.bless_user.status ==3 || e.data.bless_user.status ==4 || e.data.bless_user.status ==0 || e.data.bless_user.status ==5 ) //已领取 或者以失败分享重新参加活动
                                    {
                                        /*添加活动记录 addFu*/
                                        addFu("qqFriend");
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
                                        if( e.data.bless_user.status ==2 ) //已完成 未领取
                                        {
                                            /*判断时间是否过期,过期重新参加,覆盖之前记录,没有过期提示领取,*/
                                            var myDate = new Date();
                                            //获取当前年
                                            var year=myDate.getFullYear();
                                            //获取当前月
                                            var month=myDate.getMonth()+1;
                                            //获取当前日
                                            var date=myDate.getDate();
                                            var h=myDate.getHours();       //获取当前小时数(0-23)
                                            var m=myDate.getMinutes();     //获取当前分钟数(0-59)
                                            var s=myDate.getSeconds();
                                            var now=year+'-'+p(month)+"-"+p(date)+" "+p(h)+':'+p(m)+":"+p(s);

                                            if(now>e.data.margin2.end_time)
                                            {           //时间过期
                                                addFu("qZone");
                                            }
                                        }
                                        else if( e.data.bless_user.status ==3 || e.data.bless_user.status ==4 || e.data.bless_user.status ==0 || e.data.bless_user.status ==5 ) //已领取 或者以失败分享重新参加活动
                                        {
                                            /*添加活动记录 addFu*/
                                            addFu("qZone");
                                        }

                                    },
                                    cancel: function() {
                                        alert('分享失败');
                                    }
                                });
                        });
                    }
                    else
                    {
                        var nativeShare = new NativeShare();
                        var shareData = {
                            title: title,
                            desc: desc,
                            // 如果是微信该link的域名必须要在微信后台配置的安全域名之内的。
                            link: link,
                            icon: share_img,
                            // 不要过于依赖以下两个回调，很多浏览器是不支持的
                            success: function() {
                                alert('success')
                            },
                            fail: function() {
                                alert('fail')
                            }
                        };
                        function call(command) {
                            try {
                                nativeShare.call(command)
                            } catch (err) {
                                // 如果不支持，你可以在这里做降级处理
                                if (err.message)
                                {
                                    alert(err.message)
                                }
                                else
                                {
                                    alert('当前浏览器不支持此功能。')
                                }
                            }
                        }
                        $('.share_img').on('click', function() {
                            /*判断是否登录*/
                            var type = $(this).data('type');
                            var key = getCookie("key");
                            if(!key)
                            {
                                var callback = window.location.href;
                                var regUrl = UCenterApiUrl + '?ctl=Login&act=reg&t=';
                                var reg_url = regUrl + '&from=wap&callback=' + encodeURIComponent(callback);
                                window.location.href = reg_url;
                                return false;
                                // var callback = window.location.href;
                                // var loginUrl = UCenterApiUrl + '?ctl=Login&met=index&typ=e';
                                // var login_url = loginUrl + '&from=wap&callback=' + encodeURIComponent(callback);
                                // window.location.href = login_url;
                                // return false;
                            }else{

                                if( e.data.fu_order_flag == 1)
                                {
                                    alert("您有包含此商品的订单尚未完成,此时分享不享受送福免单");
                                    // return false;
                                }
                                if( e.data.default_adress !=1 )
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

                                alert("下载app送福成功率更高哦~~")

                                if( e.data.bless_user.status ==2 ) //已完成 未领取
                                {
                                    /*判断时间是否过期,过期重新参加,覆盖之前记录,没有过期提示领取,*/
                                    var myDate = new Date();
                                    //获取当前年
                                    var year=myDate.getFullYear();
                                    //获取当前月
                                    var month=myDate.getMonth()+1;
                                    //获取当前日
                                    var date=myDate.getDate();
                                    var h=myDate.getHours();       //获取当前小时数(0-23)
                                    var m=myDate.getMinutes();     //获取当前分钟数(0-59)
                                    var s=myDate.getSeconds();
                                    var now=year+'-'+p(month)+"-"+p(date)+" "+p(h)+':'+p(m)+":"+p(s);

                                    if(now>e.data.margin2.end_time)
                                    {           //时间过期
                                        addFu(type);
                                    }
                                }
                                else if( e.data.bless_user.status ==3 || e.data.bless_user.status ==4 || e.data.bless_user.status ==0 || e.data.bless_user.status ==5 ) //已领取 或者以失败分享重新参加活动
                                {
                                    /*添加活动记录 addFu*/
                                    addFu(type);
                                }

                                if (type)
                                {
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
                                    shareData.link=link;
                                    shareData.link = shareData.link + stype;
                                    nativeShare.setShareData(shareData);
                                    console.log(shareData.link);
                                    // return false;
                                    call(type);
                                }
                            }

                        });
                    }
                    //分享end
                }
            }
        })
    }
    getRecord();

    /*滚动条触底*/
    $(window).scroll(function(e) {
        if( !($(".pop-up").hasClass("block")) && !($(".ui-mask").hasClass("block")) )
        {
            if($(window).scrollTop() + $(window).height()== $(document).height())
            {
                if($(".more_nav ul li").eq(1).hasClass("on"))
                {
                    if(H_more)
                    {
                        scarebuy(true);
                    }

                }
                if($(".more_nav ul li").eq(3).hasClass("on"))
                {
                    if(F_more)
                    {
                        getGoodsFree(true);
                    }
                }
            }
        }
    });



})


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

var vid = getCookie("video");
if( !vid )
{
    open_show();
}