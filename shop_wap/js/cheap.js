


$(function(){
//初始化   获取 各个数值   start
	/*var windowH = $(window).height();
	var bannerH = $(".banner").outerHeight(true);
	var navH = $(".nav").outerHeight(true);
	var paddingH = parseFloat($(".pop-up").css("paddingTop"));
	var headerH = $(".header").outerHeight(true);
	var footerH = $(".nav-fixed").outerHeight(true);  */
//初始化   获取 各个数值   end

//  获取 main  应有的高度            start
	/*var mainH = windowH - headerH - footerH +"px";
	$(".main").css({"height":mainH});
	$(".header-wrap").css({"height":headerH+"px"});*/
//  获取 main  应有的高度            end

//导航  动态获取 所有宽度    开始
	/*var $navW = 0;
	$(".nav .scroll-wrap ul li").each(function(){
		$navW += parseFloat($(this).outerWidth(true));
	});
	$(".nav .scroll-wrap ul").css({"width":$navW});*/
//导航  动态获取 所有宽度  结束

    var h = $('.banner').height();

    $(window).scroll(function () {
        var iTop = $(window).scrollTop();
        if(iTop>=h){
            $(".nav").addClass("fixed");
            $('.banner').hide();
        }else{
            popUpStop();
            $('.banner').show();
            $(".nav").removeClass("fixed");
        }
    })

//导航      高亮   start
 $(".nav .scroll-wrap li a").click(function(){
 	if($(".more-activties-wrap").hasClass("animated") || $(".pop-up").hasClass("animated")){
 		popUpStop();
 		return false
 	}else{
	 	$(this).addClass("curr");
	 	if($(this).parent("li").siblings("li").children("a").hasClass("curr")){
	 		$(this).parent("li").siblings("li").children("a").removeClass("curr");
	 	}
	 	if($(".nav .all a").hasClass("curr")){
	 		$(".nav .all a").removeClass("curr");
	 	}
 	}
 });
 $(".nav .all a").click(function(){
 	if($(".more-activties-wrap").hasClass("animated") || $(".pop-up").hasClass("animated")){
 		popUpStop();
 		return false;
 	}else{
 		$(this).addClass("curr");
 	if($(".nav .scroll-wrap li a").hasClass("curr")){
 		$(".nav .scroll-wrap li a").removeClass("curr");
 	}
 	}
 })
//导航      高亮     end

//   footer  高亮   start
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


//  导航栏  fixed    start
/*	$(".main").scroll(function(){
	var old = $(".main").scrollTop();

		if($(this).scrollTop() > bannerH){
			$(".nav").addClass("fixed");
			$(".nav").css({"top":headerH});
		}else{
			$(".nav").removeClass("fixed");
		}
	});*/
//     导航栏  fixed    end


//  右侧 弹框       start
	//动态获取  右侧  弹出框的高度     start
	/*var  H = windowH - headerH - navH -footerH;
	var minH = H - paddingH * 2;*/

	//动态获取  右侧  弹出框的高度     end
	$(".nav-right-icon").click(function(e){
		if(!($(".pop-up").hasClass("ed"))){
			$(".pop-up").addClass("ed");
			if(!($(".pop-up").hasClass("animated"))){
				$(".pop-up").addClass("block");
				$(".pop-up").css({"top":"2.2rem"});
				$(".pop-up").addClass("block");
				$(".nav").addClass("fixed");
				$(".nav").css({"top": '0px'});
				$(".pop-up").addClass("animated");
				var popUpContentTop = $(".hot-search").outerHeight(true);
				$(".pop-up-content").css({"top":"0px"});

				$(".pop-up").animate({"marginLeft":"-5rem"},500,function(){
					$(".pop-up").removeClass("ed");
				});
			}else{
				popUpStop();
			}
		}else{
			return false;
		}
	});

	$(".pop-up .search input").click(function(){
		$(".search .keyW span").remove();
	})
//  右侧 弹框       end


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


	//  收起 右侧弹窗  function  start
	function popUpStop(){
		$(".nav").addClass("fixed");
			$(".nav").css({"top":"0px"});
			$(".pop-up").removeClass("animated");
			$(".pop-up").animate({"marginLeft":"5rem"},500,function(){
				$(".pop-up").removeClass("block");
				$(".pop-up").removeClass("ed");
			});
	}
	//  收起 右侧弹窗  function end


});





var pagesize = 24;
var curpage = 0;
var firstRow = 0;

var hasmore = true;
var footer = false;

var type = getQueryString("type");
var cat_id = getQueryString("cat_id");
var cat_sid = getQueryString("cat_sid");

if(!getCookie('sub_site_id')){
    addCookie('sub_site_id',0,0);
}
var sub_site_id = getCookie('sub_site_id');

//头部一级分类
function get_goods_cat() {
    $.getJSON(ApiUrl + "?ctl=Goods_Cat&met=getOneCat&typ=json", function (data) {
        if(data.status == 200){

        	console.log(data);
            var mySwiper = new Swiper('#topNav', {
                freeMode: true,
                freeModeMomentumRatio: 0.5,
                slidesPerView: 'auto',
            });

            var html = '';
            $.each(data.data,function (k,v) {
                html += '<div class="swiper-slide" data-id="'+v['cat_id']+'"><span>'+v['nav_name']+'</span></div>';
            });

            mySwiper.appendSlide(html);

            swiperWidth = mySwiper.container[0].clientWidth;
            maxTranslate = mySwiper.maxTranslate();
            maxWidth = -maxTranslate + swiperWidth / 2;
            $(".swiper-container").on('touchstart', function(e) {
                e.preventDefault();
            })
            mySwiper.on('tap', function(swiper, e) {
                e.preventDefault();
                slide = swiper.slides[swiper.clickedIndex];
                slideLeft = slide.offsetLeft;
                slideWidth = slide.clientWidth;
                slideCenter = slideLeft + slideWidth / 2;
                // 被点击slide的中心点
                mySwiper.setWrapperTransition(300);
                if (slideCenter < swiperWidth / 2) {
                    mySwiper.setWrapperTranslate(0);
                } else if (slideCenter > maxWidth) {
                    mySwiper.setWrapperTranslate(maxTranslate)
                } else {
                    nowTlanslate = slideCenter - swiperWidth / 2;
                    mySwiper.setWrapperTranslate(-nowTlanslate)
                }

                $('.nav-bar .curr').removeClass('curr');

                $("#topNav .active").removeClass('active');
                $("#topNav .swiper-slide").eq(swiper.clickedIndex).addClass('active');

                $("#topNav .curr").removeClass('curr');
                $("#topNav .swiper-slide").eq(swiper.clickedIndex).addClass('curr');

                cat_id = $("#topNav .swiper-slide").eq(swiper.clickedIndex).data('id');

                firstRow = 0;
                get_goods_list(true);
            });
        }
    })
}

function get_goods_list(clear){

    param = {};
    param.firstRow = firstRow;

    if (type != ""){
        param.type = type
    }else{
        param.type = 1
	}
    if (cat_id != ""){
        param.cat_id = cat_id
    }
	if (cat_sid != ""){
        param.cat_sid = cat_sid
    }

    $.getJSON(ApiUrl + "?ctl=Goods_Cheap&met=index&typ=json&sub_site_id="+sub_site_id + window.location.search.replace("?", "&"), param, function (e) {
		if(e.status == 200){
            var banner_adv = template.render("banner_adv", e.data);
            console.log(e.data['adv_list']);
            $("#banner .swiper-wrapper").append(banner_adv);

			var data_goods = template.render("data_goods", e.data['data_goods']);
			if(clear){
                $(".goods-ul").empty();
			}
			$(".goods-ul").append(data_goods);

			$(".loading").remove();
			curpage++;

			if(e.data.page < e.data.total)
			{
				firstRow = curpage * pagesize;
				hasmore = true;
			}
			else
			{
				hasmore = false;
			}
		}
    });
}

$(function () {
    get_goods_cat();
    get_goods_list();
    $(window).scroll(function ()
    {
        if(hasmore){
            if ($(window).scrollTop() + $(window).height() > $(document).height() - 1)
            {
                get_goods_list(false);
            }
        }

    });


    $('.nav-fixed .home-icon').on('click',function () {
        cat_id='';
        firstRow = 0;
        type = 1;
        get_goods_list(true);
    })
    $('.nav-fixed .icon-9').on('click',function () {
    	type = 1;
        firstRow = 0;
        get_goods_list(true);
    })
    $('.nav-fixed .icon-20').on('click',function () {
        type = 2;
        firstRow = 0;
        get_goods_list(true);
    })
    $('.nav-fixed .icon-50').on('click',function () {
        type = 3;
        firstRow = 0;
        get_goods_list(true);
    })
});





