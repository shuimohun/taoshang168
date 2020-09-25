/*惠省惠赚*/
$(function () {


    $(".back").on('click',function(){
        history.go(-1);

    })

    $(".main_nav_savemoney ul li").click(function () {
    $(".main_nav_savemoney ul li").removeClass("on");
    $(this).addClass("on");
    var thisNum = $(this).index();
    $(".main_savemoney .main_contain").hide();
    $(".main_savemoney .main_contain").eq(thisNum).show();
    })

    var current=1;
    var rows=27;
    var cat_id;
    var state_id;
    var hasMore=true;
    /*获取有套餐的一级分类*/
    function getNav(){
        $.getJSON(ApiUrl+'?ctl=Goods_SaveMoney&met=endlessList&typ=json',function (e) {

            if(e.status ==200){
                var nav_cat= template.render("nav_cat",e.data);
                $(".nav_cat ul").html(nav_cat);
                var bundling = e.data.bundling_list.items;
                for(var i=0; i<bundling.length; i++){
                    bundling[i].CombinedPrice =(bundling[i].old_total_price-bundling[i].bundling_discount_price).toFixed(2);
                }
                // console.log(bundling);
                e.data.bundling_list.items=bundling;
                console.log(e.data);
                var earnmore = template.render("earnmore",e.data);
                $(".earnmore").html(earnmore);
                nav_Ocat()
            }

        })

    }
    getNav()

    /*一级分类查询数据*/
    $(".find_nav_list").on('click','li',function(){
        /*执行数据查询函数*/
        current=1;
       /* $(".nav-fixed li").each(function(){
            if($(this).hasClass("curr")){
                $(this).removeClass("curr");
            }
        })*/
        $(".nav-fixed li").each(function(){
            if($(this).attr("data-id")==state_id){
                $(this).addClass("curr").siblings().removeClass("curr");
            }
        })
        cat_id = $(this).attr("data-id");
        getData();

    })
    /*价格筛选点击*/
    $(".nav-fixed").on('click','li',function(){
        current=1;
       /* state_id = $(this).attr("data-id");
        getData();*/
        if($(this).attr("data-id")){
            state_id = $(this).attr("data-id");
            getData();
        }

    })

    function getData(more){
        var param={};
        if(cat_id){
            param.cat_id=cat_id;
        }
        if(state_id){
            param.state_id=state_id;
        }
        param.current =current;
        param.rows=rows;
        $.getJSON(ApiUrl+'?ctl=Goods_SaveMoney&met=endlessList&typ=json',param,function (e) {
            if(e.status ==200){
                if(more){
                    var earnmoreAppend = template.render("earnmoreAppend",e.data);
                    $(".earnmore ul").append(earnmoreAppend);
                }else{
                    $(".earnmore").empty();
                    var earnmore = template.render("earnmore",e.data);
                    $(".earnmore").html(earnmore);
                    $("html,body").animate({scrollTop:$(".nav_cat")});
                }
                current++;

                if((current*rows)>e.data.bundling_list.totalsize){
                    hasMore=false;
                }




            }


    })

    }
    $(window).scroll(function(e) {
        if( !($(".pop-up").hasClass("block")) && !($(".ui-mask").hasClass("block")) ){
            if($(window).scrollTop() + $(window).height()== $(document).height()) {
                if(hasMore){

                    getData(true);
                }
            }
        }
    });
    function nav_Ocat(){
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

    });


    /****************弹窗部分*************************************/
    $(function(){
    $('.info').click(function(){
    $('.win-top').fadeIn();
    $('.win-bottom').fadeTo(300,0.3);
    });
    $('.bottom').click(function(){
    $('.win-top,.win-bottom').fadeOut();
    })
    })
    /****************弹窗部分*************************************/

    /************滚动导航栏展开*************/
    $(function(){
    $('.an').click(function(){
    $('body').css('height','100%');
    if ($('.head-top').css('display') == 'none'){
    $('.head-top').slideDown();
    $('body').css('overflow','hidden');
    }
    else{
    $('.head-top').slideUp();
    $('body').css('overflow','visible');
    }
    });
    });
    /************滚动导航栏展开*************/


    /*********阻止移动端页面滑动***********/
    /*window.ontouchmove=function(e){
    e.preventDefault && e.preventDefault();
    e.returnValue=false;
    e.stopPropagation && e.stopPropagation();
    return false;
    }*/

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
    /***********************************************/
    $('.banner').each(function() {
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
    /**********轮播图部分***************/


    //   footer  高亮   start1
    $(".nav-fixed li.side-icon").click(function(){
    if($(".pop-up").hasClass("animated") || $(".more-activties-wrap").hasClass("animated")){
    activityStop();
    // popUpStop();
    return false;
    }else{
    if(!($(this).hasClass("curr"))){
    $(this).addClass("curr");
    $(this).siblings("li").removeClass("curr");
    }else{
    return false;
    }
    }
    });
    //   footer  高亮   end

    //   点击  更多活动        start
    $(".more-icon").click(function(){
    if($(".pop-up").hasClass("animated")){
    //  popUpStop();
    return false;
    }else{
    if(!($(".more-activties-wrap").hasClass("ed"))){
    //   $(".more-activties-wrap").addClass("ed");
    if(!($(".more-activties-wrap").hasClass("animated"))){
    $(".ui-mask").addClass("block");
    $(".ui-mask").animate({"opacity":0.6},320);
    $(".more-activties-wrap").animate({"bottom":"0rem"},320,function(){
    $(".more-activties-wrap").addClass("animated");
    //   $(".more-activties-wrap").removeClass("ed");
    });
    }else{
    activityStop();
    }
    }else{
    return false;
    }
    }
    });
    //   点击  更多活动    end
    //点击  ui-mask   更多  活动  框   收起
    $(".ui-mask").click(function(){
    activityStop();
    });
    //点击  ui-mask   更多  活动  框   收起     end
    //收起  更多活动  start
    function activityStop() {
    $(".more-activties-wrap").animate({"bottom":"-3.6rem"},320,function(){
    $(".more-activties-wrap").removeClass("animated");
    // $(".more-activties-wrap").removeClass("ed");
    });
    $(".ui-mask").animate({"opacity":0},320,function(){
    $(".ui-mask").removeClass("block");
    });
    }
    //收起  更多活动  end











