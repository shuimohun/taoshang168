// function sc_s(goods_id) {
//     if (dropFavoriteGoods(goods_id)){
//         var img = '.img_'+goods_id;
//         $(img).attr("src", "../images/like@2x.png");
//     }
// }
// function  sc_z(goods_id) {
//     //收藏
//     if (favoriteGoods(goods_id)){
//         var img = '.img_'+goods_id;
//         $(img).attr("src", "../images/heart.png");
//     }
// }
function clle(th)
{
    var path = $(th).attr('src');
    var goods_id = $(th).attr('goods_id');
    if(path == '../images/like@2x.png')
    {
        favoriteGoods(goods_id);
        $(th).attr('src','../images/heart.png');
    }
    else if(path == '../images/heart.png')
    {
        dropFavoriteGoods(goods_id);
        $(th).attr('src','../images/like@2x.png');
    }

}

var nav = getQueryString('nav');
$(function(){

    $.ajax({
        url: ApiUrl+"/index.php?ctl=Goods_Goods&met=sonanddaughter&typ=json",
        type: 'get',
        dataType: 'json',
        success:function(result)
        {
            var data = result.data;
            console.log(data)
            var navHtml = template.render('nav',data);
            $('.find_nav_list').append(navHtml);
            var advHtml = template.render('adv',data);
            $('.slider_list').html(advHtml);
            slide();
            adv();
        }
    })
    if(!nav)
    {
        nav = 0;
    }
    $.post(ApiUrl+'/index.php?ctl=Goods_Goods&met=sonanddaughter_row&typ=json',{'nav':nav},function(result){

        if(result.status == 200)
        {
            var data = result.data;
            var xlHtml = template.render('xl_res',data);
            $('.swiper-container').html(xlHtml);
            var scHtml = template.render('sc_res',data);
            $('.proprietary_goods').html(scHtml);
            var plHtml = template.render('pl_res',data);
            $('.contain_goods').html(plHtml);


            var swiper = new Swiper('.swiper-container', {
                pagination: '.swiper-pagination',
                slidesPerView: 3,
                paginationClickable: true,
                spaceBetween: 30,
                freeMode: true
            });

        }
    });

})
function adv()
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
//导航点击分类
$('.find_nav_list').on('click',"li[class='find_nav_cur']",function(){
    var fid = $('.find_nav_cur>a').attr('id');
    location.href = WapSiteUrl+'/tmpl/sonanddaughter.html?nav='+fid;
    return;
});
//跳转商品详情
function coty(cid){
    window.location.href = "./product_detail.html?cid="+cid;
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