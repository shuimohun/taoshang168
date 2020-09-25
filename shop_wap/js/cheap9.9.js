$(function(){
    //   footer  高亮   start1
    $(".nav-fixed li.side-icon").click(function(){
        if($(".pop-up").hasClass("animated") || $(".more-activties-wrap").hasClass("animated")){
            activityStop();
            popUpStop();
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

    //   添加   我喜欢   start
    $(".goods-ul .goods .goods-detail .goods-like .like").click(function(){
        if($(this).hasClass("curr")){
            $(this).removeClass("curr");
        }else{
            $(this).addClass("curr");
        }
    });
    //   添加   我喜欢    end

    //   点击  更多活动        start
    $(".more-icon").click(function(){
        if($(".pop-up").hasClass("animated")){
            popUpStop();
            return false;
        }else{
            if(!($(".more-activties-wrap").hasClass("ed"))){
                $(".more-activties-wrap").addClass("ed");
                if(!($(".more-activties-wrap").hasClass("animated"))){
                    $(".ui-mask").addClass("block");
                    $(".ui-mask").animate({"opacity":0.6},320);
                    $(".more-activties-wrap").animate({"bottom":"1.5625rem"},320,function(){
                        $(".more-activties-wrap").addClass("animated");
                        $(".more-activties-wrap").removeClass("ed");
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
        $(".more-activties-wrap").animate({"bottom":"-3.078125rem"},320,function(){
            $(".more-activties-wrap").removeClass("animated");
            $(".more-activties-wrap").removeClass("ed");
        });
        $(".ui-mask").animate({"opacity":0},320,function(){
            $(".ui-mask").removeClass("block");
        });
    }
    //收起  更多活动  end

    $('.nav-fixed .home-icon').on('click',function () {
        cat_id='';
        firstRow = 0;
        type = 1;
        init_main(false);
    })
    $('.nav-fixed .icon-9').on('click',function () {
        type = 1;
        firstRow = 0;
        init_main(false);
    })
    $('.nav-fixed .icon-20').on('click',function () {
        type = 2;
        firstRow = 0;
        init_main(false);
    })
    $('.nav-fixed .icon-50').on('click',function () {
        type = 3;
        firstRow = 0;
        init_main(false);
    })

});

function callback(id,more){
    if(id > 0){
        firstRow = 0;
        curpage = 0;
        cat_id = id;
    }
    init_main(more);
}


var type = getQueryString("type");
var cat_id = getQueryString("cat_id");
var cat_sid = getQueryString("cat_sid");

if(!getCookie('sub_site_id')){
    addCookie('sub_site_id',0,0);
}
var sub_site_id = getCookie('sub_site_id');

function init_main(more) {
    param = {};
    param.firstRow = firstRow;

    if (type != ""){
        param.type = type
    }else{
        param.type = 1
    }
    if (cat_id != ""){
        param.cat_id = cat_id
    }else {
        param.cat_id = 0
    }
    if (cat_sid != ""){
        param.cat_sid = cat_sid
    }


    $.getJSON(ApiUrl + "?ctl=Goods_Cheap&met=index&typ=json&sub_site_id="+sub_site_id + window.location.search.replace("?", "&"), param,
        function (e) {
        if(e.status == 200){
            console.log(more)
            console.log(e.data)
            if(more){
                var main = template.render("more_goods", e.data);
                $('.page .swiper-wrapper .swiper-slide-active .main ul').append(main);
            }else{
                $('.page .swiper-wrapper .swiper-slide-active .main').empty();
                var main = template.render("main", e.data);
                $('.page .swiper-wrapper .swiper-slide-active .main').html(main);
            }

            curpage++;
            if(e.data['data_goods'].page < e.data['data_goods'].total){
                firstRow = curpage * pagesize;
                hasmore = true;
            }else{
                hasmore = false;
            }

            var mySwiper_banner = new Swiper ('.banner.swiper-container', {
                direction: 'horizontal',
                loop: true,
                pagination: '.swiper-pagination',
                autoplayDisableOnInteraction : false,
                autoplay: 3500
            });
        }
    });
}



