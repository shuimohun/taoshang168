$(function(){
   var e = getCookie("key");

   if(!e)
   {
       window.location.href = WapSiteUrl+"/tmpl/member/login.html";
       return;
   }
    var url = location.search;

   $.ajax({
       url:ApiUrl + "?ctl=Points&met=pList&typ=json",
       type:'post',
       dataType:'json',
       success:function(result)
       {
           var data = result.data;
           var navHtml = template.render('nav',data);
           $('.find_nav_list').append(navHtml);

           $(".redbag_head>span").html(data.user_info.user_name);
           $(".redbag_head>img").attr("src",data.user_info.user_logo);
           $("#red").html(data.redPacket);
           $("#ticket").html(data.ava_voucher_num);
           $("#egg").html(data.user_resource.user_points);
           $("#gift").html(data.points_order_num);
           $('.div_v').html('V'+data.user_info.user_grade);
           $('.div_v.n').html('V'+parseInt(parseInt(data.user_info.user_grade)+parseInt(1)));
           $('.progress>img').attr('width',parseInt((data.user_resource.user_growth/data.growth.grade_growth_end)*100)+'%');
           $('.div_right>i').html(data.growth.next_grade_growth);
           if(url == '')
           {
               $.post(ApiUrl + "?ctl=Points&met=index&typ=json",function(result){
                   console.log(result.data);
                   var data = result.data;
                   var redHtml = template.render('redPack',data);
                   $('.redbag_contain').append(redHtml);
                   var giftHtml = template.render('gifts',data);
                   $('.gift').append(giftHtml);
                   var chitHtml = template.render('chits',data);
                   $('.chit').append(chitHtml);
                   var picHtml = template.render('pic',data);
                   $('.slider_list').append(picHtml);
                   lunbo();

               });
           }
           else
           {
               var id = url.substr(5);
               $.post(ApiUrl+"/index.php?ctl=Points&met=index&typ=json",{fid:id},function(result){
                   console.log(result.data);
                   var data = result.data;
                   var redHtml = template.render('redPack',data);
                   $('.redbag_contain').append(redHtml);
                   var giftHtml = template.render('gifts',data);
                   $('.gift').append(giftHtml);
                   var chitHtml = template.render('chits',data);
                   $('.chit').append(chitHtml);
                   var picHtml = template.render('pic',data);
                   $('.slider_list').append(picHtml);
                   lunbo();
               });
           }

           slide();
       }
   });

//点击代金券
   $('.chit').on('click',"a[nctype='exchange_integrate']",function(){
        var v_id = $(this).data("vid");
       $('.tanchuang_top').html('确定要立即兑换？');
       $('.tanchuang').css('display','block');
       $('.bg_tanchuang').show();
       $('.ensure').click(function(){
           $.ajax({
               url: ApiUrl + "?ctl=Voucher&met=getVoucherById&typ=json",
               data: {vid: v_id},
               type: 'post',
               dataType: 'json',
               success: function(data){
                   if(data.status == 200)
                   {
                       var data = data.data, voucher_t_eachlimit = data.voucher_t_eachlimit;
                       var params = {
                           vid: v_id,
                           k: getCookie("key"),
                           u: getCookie("id")
                       };
                       if(data.voucher_t_eachlimit == 0)
                       {
                           $.ajax({
                               url:ApiUrl+"/index.php?ctl=Voucher&met=receiveVoucher&typ=json",
                               data: params,
                               type: 'post',
                               dataType:'json',
                               success:function(data)
                               {
                                   var msg = data.msg;
                                   $('.tanchuang_top').html(msg);
                                   $('.tanchuang').css('display','block');
                                   $('.bg_tanchuang').show();
                               }
                           });
                       }
                       else
                       {
                           $.ajax({
                               url:ApiUrl+"/index.php?ctl=Voucher&met=receiveVoucher&typ=json",
                               data: params,
                               type: 'post',
                               dataType:'json',
                               success:function(data)
                               {
                                   var msg = data.msg;
                                   $('.tanchuang_top').html(msg);
                                   $('.tanchuang').css('display','block');
                                   $('.bg_tanchuang').show();
                               }
                           });
                       }
                       var chitHtml = template.render("chits",data);
                       $('.chit').append(chitHtml);
                   }else{
                       $('.tanchuang_top').html('网络异常');
                       $('.tanchuang').css('display','block');
                       $('.bg_tanchuang').show();
                   }
               }
           });
       });
       //点击取消按钮
       $('.delete').click(function(){
           $('.bg_tanchuang').hide();
           $('.tanchuang').hide();
       });
   });

//点击平台红包
   $('.redbag_contain').on('click',"a[nctype='exchange_redpack']",function(){
       var id = $(this).data('rtid');
       $('.tanchuang_top').html('确定要立即兑换？');
       $('.tanchuang').css('display','block');
       $('.bg_tanchuang').show();
       //点击确定按钮
       $('.ensure').click(function(){
           $.ajax({
               url:ApiUrl+'/index.php?ctl=RedPacket&met=getRedPacketById&typ=json',
               data:{id:id},
               type:'post',
               dataType:'json',
               success:function(result)
               {
                   if(result.status == 200)
                   {
                       var data = result.data, redpacket_t_eachlimit = data.redpacket_t_eachlimit;
                       var params = {
                           red_packet_t_id:id,
                           k:getCookie('key'),
                           u:getCookie('id')
                       };

                       $.ajax({
                           url:ApiUrl+"/index.php?ctl=RedPacket&met=receiveRedPacket&typ=json",
                           data: params,
                           type:'post',
                           dataType:'json',
                           success:function(data)
                           {
                               location.reload();
                           }
                       });

                   }
               }
           });
       });
       //点击取消按钮
       $('.delete').click(function(){
           $('.bg_tanchuang').hide();
           $('.tanchuang').hide();
       });
   });

});

//点击导航
$('.find_nav_list').on('click',"li[class='find_nav_cur']",function(){
    var fid = $('.find_nav_cur>a').attr('id');
    location.href = WapSiteUrl+'/tmpl/goldeggsbuy.html?fid='+fid;

});




//轮播图
function lunbo()
{
    $('.slider_list').each(function() {
        /**********轮播图部分***************/
        if ($(this).find('.item').length < 2) {
            return;
        }
        Swipe(this, {
            startSlide: 2,
            speed: 400,
            auto: 3000,
            continuous: true,
            disableScroll: false,
            stopPropagation: false,
            callback: function(index, elem) {},
            transitionEnd: function(index, elem) {}
        });
    });
}

function slide()
{
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
            $(".sideline").css({left:0});
            $(".find_nav_list li").eq(0).addClass("find_nav_cur").siblings().removeClass("find_nav_cur");
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
        case "潮流服饰":
            sessionStorage.pagecount = "潮流服饰";
            break;
        case "美妆饰品":
            sessionStorage.pagecount = "美妆饰品";
            break;
        case "鞋靴箱包":
            sessionStorage.pagecount = "鞋靴箱包";
            break;
        case "食品茶酒":
            sessionStorage.pagecount = "食品茶酒";
            break;
        case "家电办公":
            sessionStorage.pagecount = "家电办公";
            break;
        case "生鲜特产":
            sessionStorage.pagecount = "生鲜特产";
            break;
        case "运动器材":
            sessionStorage.pagecount = "运动器材";
            break;
        case "母婴玩具":
            sessionStorage.pagecount = "母婴玩具";
            break;
        case "日用百货":
            sessionStorage.pagecount = "日用百货";
            break;
        case "家居建材":
            sessionStorage.pagecount = "家居建材";
            break;
        case "电子数码":
            sessionStorage.pagecount = "电子数码";
            break;
        case "汽车汽配":
            sessionStorage.pagecount = "汽车汽配";
            break;
        case "生活服务":
            sessionStorage.pagecount = "生活服务";
            break;
    }
}
