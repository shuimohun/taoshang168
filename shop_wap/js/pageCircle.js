/*************************/

$(function(){

    var isWx;

    //判断是否在微信内
    var ua = navigator.userAgent.toLowerCase();
    if (ua.match(/MicroMessenger/i) == "micromessenger") {
        var isWx = 1;
    }
    $(".back").on('click',function(){
        history.go(-1);
    })

    var current=1;
    var rows=5;
    var hasMore=true;
    var saleMore=true;
    var group;

    /*获取说说数据*/
    var Apage = 1;
    var Arows = 10;
    var artMore = true;
    //获取文章分类
    function getInfoGroup() {
        var res;
        $.ajax({
            url: ApiUrl + "?ctl=News&met=infoGroup&typ=json",
            type: 'POST',
            data:{},
            async:false,
            dataType: 'json',
            success: function(result) {
                var info_group = template.render("info_group",result);
                $(".info_group").html(info_group);

                $(".info_group ul li").each(function () {
                    if( $(this).hasClass("find_nav_cur"))
                    {
                        group = $(this).attr("data-group");
                    };
                })
                cat();
                getArticle();
                catClick();
                 res=  true;

            }
        })
        return res;
    }
    function getArticle(more) {
        $.ajax({
            url: ApiUrl + "?ctl=News&met=getArticle&typ=json",
            type: 'POST',
            data:{page:Apage,rows:Arows,group:group},
            dataType: 'json',
            async:false,
            success: function(result) {
                if(result.status == 200)
                {

                    if(more)
                    {
                        var information_article_append = template.render("information_article_append",result);
                        $(".information_article").append(information_article_append);
                    }
                    else
                    {
                        var information_article = template.render("information_article",result);
                        $(".main .evalList").html(information_article);
                    }

                    var  num = $(".itemwrap").length;
                    for(var i=0; i<num; i++)
                    {
                        var text = $(".itemwrap").eq(i).find("span.info_desc").text();

                        var len = text.length;
                        if(len>10)
                        {
                            var content = text.substr(0,10)+'......';
                            $(".saylink").eq(i).find("span").text(content);
                        }
                    }

                    //发表图片仅有一张图片的样式
                    $(".saypic").each(function(){
                        var img_num = $(this).find("ul li").length;
                        if(img_num<2){
                            $(this).addClass("onlyone");
                        }else{
                            $(this).removeClass("onlyone");
                        }
                    })
                    if($(".sayList").hasClass("cur"))
                    {
                        if( result.data.totalsize < Apage*Arows )
                        {
                            artMore = false;
                            $('.loading').hide();

                        }else{
                            artMore =true;
                            $('.loading').show();
                        }
                    }

                    Apage++;

                }

            },
            error: function () {
                // alert("加载开小差了,请重新刷新加载");
            }
        });
    }
     //导航点击获取数据
    function catClick() {
        $(".info_group li").click(function () {
            Apage = 1;
            group = $(this).attr("data-group");
            getArticle()
        })
    }
//分类导航
    function cat(){
        $(".find_nav_list").css("left",sessionStorage.left+"px");
        $(".find_nav_list li").each(function(){
            if($(this).find("a").text()==sessionStorage.pagecount){
                $(".sideline").css({left:$(this).position().left});
                $(".sideline").css({width:$(this).outerWidth()});
                $(this).addClass("find_nav_cur").siblings().removeClass("find_nav_cur");
                navName(sessionStorage.pagecount);
                return false
            }
            else{


                $(".find_nav_list li").each(function () {
                    if( $(this).attr("data-group") == "rem" )
                    {
                        if( $(this).index() ==0)
                        {
                            $(".sideline").css({left:0});
                        }
                        else
                        {
                            $(".sideline").css({left:77.0429});
                        }
                        $(this).addClass("find_nav_cur").siblings().removeClass("find_nav_cur");
                    }
                })
            }
        });
        var nav_w=$(".find_nav_list li").first().width();
        $(".sideline").width(nav_w);
        $(".find_nav_list li").on('click', function(){
            nav_w=$(this).width();
            $(".sideline").stop(true);
            $(".sideline").animate({left:$(this).position().left},300);
            $(".sideline").animate({width:nav_w});
            $(this).addClass("find_nav_cur").siblings().removeClass("find_nav_cur");
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
            navName(c_nav);
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
    function navName(c_nav) {
        switch (c_nav) {
            case "精选":
                sessionStorage.pagecount = "精选";
                break;
            case "服饰内衣":
                sessionStorage.pagecount = "服饰内衣";
                break;
            case "电子数码":
                sessionStorage.pagecount = "电子数码";
                break;
            case "美妆饰品":
                sessionStorage.pagecount = "美妆饰品";
                break;
            case "鞋靴箱包":
                sessionStorage.pagecount = "鞋靴箱包";
                break;
            case "家电办公":
                sessionStorage.pagecount = "家电办公";
                break;
            case "食品茶酒":
                sessionStorage.pagecount = "食品茶酒";
                break;
            case "生鲜水果":
                sessionStorage.pagecount = "生鲜水果";
                break;
            case "运动户外":
                sessionStorage.pagecount = "运动户外";
                break;
            case "母婴玩具":
                sessionStorage.pagecount = "母婴玩具";
                break;
            case "日用百货":
                sessionStorage.pagecount = "日用百货";
                break;
            case "家具建材":
                sessionStorage.pagecount = "家具建材";
                break;
            case "汽车汽配":
                sessionStorage.pagecount = "汽车汽配";
                break;
        }
    }

    /**-----------说说---------------------------------------------*/

    $(".sayList").on('click',function(){
        window.name = 'sayList';
        if(getCookie("art"))
        {
            delCookie("art")
        }
        artMore=true;
        /*获取说说函数*/
        Apage=1;
        $(".main .evalList").empty();
        getInfoGroup();
    })

    /*时间排序点击*/
    $(".sortTime").on('click',function(){
        window.name = 'sortTime';
        current=1;
        $(".main .evalList").empty();
        getEval();
    });
    /*销量排序点击*/
    $(".sortSaleNum").on('click',function(){
        window.name = 'sortSaleNum';
        current=1;
        $(".main .evalList").empty();
        getEval('','salenum');
    });

    /*刷新保持导航栏不变*/
    if(!window.name)
    {
        getInfoGroup();
        window.name = "sayList";

    }
    else
    {
        var name = window.name;
        if(name =="sayList")
        {
            var re = getInfoGroup();

            if(re)
            {
                $(".find_nav_list").css({left:0});
            }
        }else if(name =='sortTime')
        {
            $(".find_nav").hide();
            $(".fans-comment-tab a").each(function(){
                if($(this).hasClass(name)){
                    $(this).addClass("cur").siblings().removeClass("cur");
                }
            })
            getEval();
        }else if(name =='sortSaleNum')
        {
            $(".find_nav").hide();
            $(".fans-comment-tab a").each(function(){
                if($(this).hasClass(name)){
                    $(this).addClass("cur").siblings().removeClass("cur");
                }
            })
            getEval('','salenum');
        }

    }


/*----------------------------------------------------------------*/
    function getEval(more,sort){

        var param={};
        if(sort){
            param.sort=sort;
        }
        param.page=current;
        param.rows=rows;

        $.getJSON(ApiUrl+'?ctl=Goods_Evaluation&met=wapGetEvalCircle&typ=json',param,function(e){
            e.data.isWx = isWx;
            if(e.status==200){


                if(more){
                    var evalListAppend = template.render("evalListAppend",e.data);
                    $(".main .evalList").append(evalListAppend);

                }else{

                    var evalList = template.render("evalList",e.data);
                    $(".main .evalList").html(evalList);
                    $("html,body").animate({scrollTop:$(".nav_cat")});

                }
                if($(".sortTime").hasClass("cur"))
                {
                    if((current*rows)<(e.data.evaluationAll.totalsize)){
                        hasMore=true;

                        if(e.data.evaluationAll.items.length ==0){
                            hasMore=false;
                            $('.loading').hide();
                        }else{
                            $('.loading').show();
                        }
                    }else{
                        hasMore=false;
                        $('.loading').hide();
                    }
                }
                if($(".sortSaleNum").hasClass("cur"))
                {
                    if((current*rows)<=(e.data.evaluationAll.totalsize)){
                        saleMore=true;
                            if(e.data.evaluationAll.items.length ==0){
                            $('.loading').hide();
                        }else{
                            $('.loading').show();
                        }
                    }else{
                        saleMore=false;
                        $('.loading').hide();
                    }
                }


                current++;

                /*分享开始*/
                //分享弹框

                var html = template.render('share_script', e.data);
                $("#share_html").html(html);


                $(".nctouch-bottom-mask-tip").click(function(){     //点击返回 关闭弹框
                    $(".nctouch-bottom-mask").removeClass("up");
                    $(".nctouch-bottom-mask").addClass("down");
                })
                $(".nctouch-bottom-mask-close").click(function(){   //点击关闭按钮 关闭弹框
                    $(".nctouch-bottom-mask").removeClass("up");
                    $(".nctouch-bottom-mask").addClass("down");
                })
                $(".nctouch-bottom-mask-bg").click(function(){      //点击关闭按钮 关闭弹框
                    $(".nctouch-bottom-mask").removeClass("up");
                    $(".nctouch-bottom-mask").addClass("down");
                })





                /*点击开始*/
                var link = '';
                var share_img = '';
                var desc = '';
                $(".comment-icon3").click(function(){
                    if($(this).hasClass("icon3")){

                        $(".nctouch-bottom-mask").removeClass("down");
                        $(".nctouch-bottom-mask").addClass("up");
                        event.stopPropagation();

                        link = WapSiteUrl + '/tmpl/fans-circle.html?from=';
                        share_img='';
                        desc='快来看看吧,好东西都在粉丝圈呀!';

                    }else{
                        $(".nctouch-bottom-mask").removeClass("down");
                        $(".nctouch-bottom-mask").addClass("up");
                        event.stopPropagation();
                        var goods_id = $(this).data("id");
                        var id = getCookie('id'); //登录标记
                        if (id) {
                            var suid = '&suid=' + id;
                        }

                        link = ApiUrl + '?ctl=Goods_Goods&met=goods&gid=' + goods_id + suid + '&type=app&from=';
                        share_img = $(this).parent().prev().children().children("img").attr("src");
                        desc = $(this).parent().prev().children().children().children("p.fans-goods-title").text();
                    }



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
                            var stype = '';
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
                            console.log(shareData.link)
                            nativeShare.setShareData(shareData);
                            call(type);
                        }
                    });
                }
                /*注册结束*/


            }
        })
    }

    /*切换点赞*/

    $(window).scroll(function(e) {
        if( !($(".pop-up").hasClass("block")) && !($(".ui-mask").hasClass("block")) )
        {
            if($(window).scrollTop() + $(window).height()== $(document).height())
            {
               if($(".sayList").hasClass("cur"))
                {
                    if($(".searchContent").val().length >0 && getCookie("art")){

                        if(searchMore)
                        {
                          searchArticleMore(true);
                        }
                    }else{
                        if(artMore)
                        {
                            getArticle(true);
                        }
                    }
                }
                if($(".sortSaleNum").hasClass("cur"))
                {
                    if(saleMore)
                    {
                        getEval(true,'salenum');
                    }
                }
                if($(".sortTime").hasClass("cur"))
                {
                    if(hasMore)
                    {
                        getEval(true);
                    }
                }
            }
        }
    });

    /*---------粉丝圈-我的晒图  tab切换------------*/
    $(".fans-comment-tab .fans-comment-main").click(function () {
        $(".fans-comment-tab .fans-comment-main").removeClass("cur");
        $(this).addClass("cur");
        if($(".fans-comment-main").eq(1).hasClass("cur")){
            $(".find_nav").hide();
            $(".fans_search_btn").hide();
            $(".fans-comment-tab").css({"width":"100%"});

        }else if($(".fans-comment-main").eq(2).hasClass("cur")){
            $(".find_nav").hide();
            $(".fans_search_btn").hide();
            $(".fans-comment-tab").css({"width":"100%"});
        }else if($(".fans-comment-main").eq(0).hasClass("cur")){
            $(".find_nav").show();
            $(".fans_search_btn").show();
            $(".fans-comment-tab").css({"width":"88%"});
        }

    });
    /*---------粉丝圈-说说  搜索框显示隐藏-----------*/
    $(".fans_search_btn").click(function(){
           if($(".saylistmain .search").hasClass("show")){
               $(".saylistmain .search").removeClass("show");
           }else{
               $(".saylistmain .search").addClass("show");
           }
    })
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

function EvaluationReply(i,parent_id){

    var key = getCookie('key');
    if (!key) {
        checkLogin(0);
        return;
    }
    var i=$(i);
    var uid = getCookie("id");
    var uname = getCookie('user_account');
    var content = i.prev("input").val();
    var parent_id = parent_id;
    if(content.length<5){
        alert("输入字符不能少于5个。");
        return ;
    }
    var param={};
    param.uid=uid;
    param.uname=uname;
    param.content=content;
    param.parent_id=parent_id;

    $.getJSON(ApiUrl+'?ctl=Goods_Evaluation&met=evaluationReply&typ=json',param,function(res){
        if(res.status==200){
            i.prev().val("");
            i.prev().prev().children().eq(2).remove();
            var reply = '<div class="fans-comment-result"><p><span>'+uname+'：</span>'+content+'</p></div>';
            i.prev().prev().prepend(reply);


        }else if(res.status==250){
            var msg ='含有违禁词 : '+ res.msg;
            alert(msg);
        }
    })



}

function add_friend(i,user_id){
    var key = getCookie('key');
    if (!key) {
        checkLogin(0);
        return;
    }
    var login_id = getCookie("id");
    if(login_id ==user_id){
        alert("不能关注自己");
        return;
    }
    var _this = $(i);
    if(_this.hasClass("on")){
        alert("已关注该用户");
    }else{
        $.ajax({
            type: 'post',
            url: ApiUrl + '?ctl=Buyer_User&met=addFriendDetail&typ=json',
            data: {id: user_id},
            dataType: 'json',
            async: false,
            success: function(result) {
                if(200 == result.status){
                    _this.addClass("on");
                }

            }
        })
    }


}

var Spage = 1;
var Srows = 5;
var searchMore = true;
function searchArticle(){
    Spage=1;
    var text = $(".searchContent").val();
    if(text.length ==0)
    {
        alert("搜索内容不能为空");
        return false;
    }
    $.ajax({
        url: ApiUrl + "?ctl=News&met=wapSearch&typ=json",
        type: 'POST',
        data:{text:text,page:Spage,rows:Srows},
        dataType: 'json',
        success: function(result) {
            addCookie("art","search",0.01);
            if(result.status == 200)
            {
                if(result.data.items.length ==0){
                    alert("暂无搜索数据");
                    return false;
                }
                var search_article = template.render("search_article",result);
                $(".main .evalList").html(search_article);
                var  num = $(".itemwrap").length;
                for(var i=0; i<num; i++)
                {
                    var text = $(".itemwrap").eq(i).find("span.info_desc").text();

                    var len = text.length;
                    if(len>10)
                    {
                        var content = text.substr(0,10)+'......';
                        $(".saylink").eq(i).find("span").text(content);
                    }
                }

                //发表图片仅有一张图片的样式
                $(".saypic").each(function(){
                    var img_num = $(this).find("ul li").length;
                    if(img_num<2){
                        $(this).addClass("onlyone");
                    }else{
                        $(this).removeClass("onlyone");
                    }
                })

                if(result.data.totalsize<5){
                    $(".loading").hide();
                }else{
                    $(".loading").show();
                }
            }

        },
        error: function () {
            // alert("加载开小差了,请重新刷新加载");
        }
    });
}
/*搜索加载更多*/
function searchArticleMore(more) {
    Spage++;
    var text = $(".searchContent").val();
    if(text.length ==0)
    {
        alert("搜索内容不能为空");
        return false;
    }
    $.ajax({
        url: ApiUrl + "?ctl=News&met=wapSearch&typ=json",
        type: 'POST',
        data:{text:text,page:Spage,rows:Srows},
        dataType: 'json',
        success: function(result) {
            addCookie("art","search",0.01);
            if(result.status == 200)
            {

                var search_article_append = template.render("search_article_append",result);
                $(".information_article").append(search_article_append);
                var  num = $(".itemwrap").length;
                for(var i=0; i<num; i++)
                {
                    var text = $(".itemwrap").eq(i).find("span.info_desc").text();

                    var len = text.length;
                    if(len>10)
                    {
                        var content = text.substr(0,10)+'......';
                        $(".saylink").eq(i).find("span").text(content);
                    }
                }
                //发表图片仅有一张图片的样式
                $(".saypic").each(function(){
                    var img_num = $(this).find("ul li").length;
                    if(img_num<2){
                        $(this).addClass("onlyone");
                    }else{
                        $(this).removeClass("onlyone");
                    }
                })

                if(Spage>result.data.total)
                {
                    searchMore=false;
                    $(".loading").hide();

                }
                $(".searchContent").val(text);

            }

        },
        error: function () {
            // alert("加载开小差了,请重新刷新加载");
        }
    });
}

/*添加关注或取消关注*/
function friend(i,user_id,from) {
    var id= getCookie("id");
    if(!id){
        checkLogin(0);
    }
    if( from )
    {
        var from =  from;
    }
    console.log(from)
    var _this   = $(i);
    var id      = user_id;

    if(_this.hasClass("on"))
    {
        var user_friend_id = _this.attr("data-id");
        /*已经关注,发送取消请求*/
        $.ajax({
            type: 'post',
            url: ApiUrl + '?ctl=Buyer_User&met=cancelFriendDetail&typ=json',
            data: {id: user_friend_id,from:'article'},
            dataType: 'json',
            async: false,
            success: function(result) {
                if(200 == result.status){
                    _this.removeClass("on");
                    _this.text("未关注");
                    $(".ad_btn").each(function () {
                        var userId = $(this).attr("data-uid");
                        if(userId == user_id)
                        {
                            $(this).removeClass("on");
                            $(this).text("未关注")
                        }
                    })
                }
            }
        })
    }else{
        /*未关注 发送关注请求*/
        $.ajax({
            type: 'post',
            url: ApiUrl + '?ctl=Buyer_User&met=addFriendDetail&typ=json',
            data: {id: id,from:from},
            dataType: 'json',
            async: false,
            success: function(result) {
                if(200 == result.status){
                    var user_friend_id = result.data.user_friend_id;
                    _this.attr("data-id",user_friend_id);
                    _this.addClass("on");
                    _this.text("已关注");
                    $(".ad_btn").each(function () {
                        var userId = $(this).attr("data-uid");
                        if(userId == user_id)
                        {
                            $(this).attr("data-id",user_friend_id);
                            $(this).addClass("on");
                            $(this).text("已关注")
                        }
                    })
                }
            }
        })
    }
}


//文章点赞 or 取消点赞

function info_like( i,info_id ) {

    var key = getCookie("key");
    if( !key)
    {
        checkLogin(0);
    }

    var _this =  $(i);
    if( info_id )
    {
        var infomation_id = info_id;
    }

    var src = _this.find("img").attr("src");
    if( src == 'img/fans-circle/fansicon1.png')
    {
        //没有点赞 发送点赞请求
        $.ajax({
            type: 'GET',
            url: ApiUrl + '?ctl=News&met=getLike&typ=json&id='+infomation_id,
            dataType: 'json',
            async: false,
            success: function(e) {

                if( e.status == 200 )
                {
                    _this.find("img").attr("src",'img/fans-circle/fansicon1-2.png');
                    var num = _this.find("span").text();
                    var count = ++num
                    _this.find("span").html(count);
                }
            }
        })
    }
    else
    {
        //已经点赞发送取关请求
        $.ajax({
            type: 'GET',
            url: ApiUrl + '?ctl=Information_Like&met=unLike&typ=json&information_id='+infomation_id,
            dataType: 'json',
            async: false,
            success: function(e) {

                if( e.status == 200 )
                {
                    _this.find("img").attr("src",'img/fans-circle/fansicon1.png');
                    var num = _this.find("span").text();
                    var count;
                    if( num ==0)
                    {
                        count =0;
                    }
                    else
                    {
                        count = --num;
                    }

                    _this.find("span").html(count);
                }
            }
        })

    }


}

//头部导航置顶悬浮 2018-08-27
var top_nav_scrolltop = $(".find_nav_list.info_group").offset().top;
$(window).scroll(function(){
    var scroll_top = $(this).scrollTop();
    if(scroll_top > top_nav_scrolltop){
        $(".find_nav_list.info_group").addClass("fixed");
    }else{
        $(".find_nav_list.info_group").removeClass("fixed");
    }
});







