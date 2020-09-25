
$(function(){

	//获取一级分类
	$(window).scroll(function(e) {
		if( !($(".pop-up").hasClass("block")) && !($(".ui-mask").hasClass("block")) ){
			if($(window).scrollTop() + $(window).height() >= $(document).height() ) {
		       // alert("没有更多了!"); //已经滚动到底部
		   }
		}else{
			return false;
		}
	});
	gesture();
    getMainCat();

    $(".main-nav-list").on('click','li',function(){
        $(this).addClass("curr").siblings("li.curr").removeClass("curr");
    })

//   footer  高亮   start1
	$(".nav-fixed li.side-icon").click(function(){
 		if($(".pop-up").hasClass("animated") || $(".more-activties-wrap").hasClass("animated")){
 			/*activityStop();
 			popUpStop();*/

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

//     点击其它地方    ------start
	$(document).click(function(e){
		if( ($(e.targe) !== $(".nav-right-icon") && $(".pop-up").hasClass("animated")) ||  ($(e.targe) !== $(".more-icon") && $(".more-activties-wrap").hasClass("animated"))){

			popUpStop();
			activityStop();
		}
	});
	
	$(".pop-up").click(function(e){
		e.stopPropagation();
	});
	$(".more-activties-wrap").click(function(e){
		e.stopPropagation();
	});
//     点击其它地方    ------end
	
	//  点击右侧 弹框     start
	$(".nav-right-icon").click(function(e){
		e.stopPropagation();
		if(!($(".pop-up").hasClass("ed"))){
			$(".pop-up").addClass("ed");
			if(!($(".pop-up").hasClass("animated"))){
				$(".pop-up").addClass("block");	
				/*var levelwH = $(".pop-up .level-1-wrap").outerHeight();
				$(".pop-up .pop-up-content").css({"top":poppaH + searchH + levelwH});    //动态获取    pop-up-content  的  top值*/
				$(".pop-up").addClass("animated");
				$(".pop-up").animate({"marginLeft":"-5rem"},500,function(){
//					$("body").css({"position":"fixed","top":-$(window).scrollTop() + "px","left":0});
					$(".pop-up").removeClass("ed");
				});
			}else{
				/*$("body").css({"position":"static"});
				$("body").scrollTop( -parseFloat($("body").css("top")) );*/
				popUpStop();
			}	
		}else{
			return false;
		}
	});
	
	$(".pop-up .search input").click(function(){
		$(".search .keyW span").remove();
	});
	// 点击 右侧 弹框       end


//   点击  更多活动        start
	$(".more-icon").click(function(e){
		e.stopPropagation();
		if($(".pop-up").hasClass("animated")){
//			popUpStop();

		}else{
			if(!($(".more-activties-wrap").hasClass("ed"))){
				$(".more-activties-wrap").addClass("ed");
				if(!($(".more-activties-wrap").hasClass("animated"))){	
					$(".ui-mask").addClass("block");			
					$(".ui-mask").animate({"opacity":0.6},320);
					$(".more-activties-wrap").animate({"bottom":"1.5625rem"},320,function(){
//						$("body").css({"position":"fixed","top":-$(window).scrollTop() + "px","left":0});
						$(".more-activties-wrap").addClass("animated");	
						$(".more-activties-wrap").removeClass("ed");
					});
				}else{
					/*$("body").css({"position":"static"});
					$("body").scrollTop( -parseFloat($("body").css("top")) );*/
					activityStop();
				}		
			}else{
				return false;
			}
		}		
	});
//   点击  更多活动    end	

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
		$(".pop-up").removeClass("animated");
		$(".pop-up").animate({"marginLeft":"5rem"},500,function(){
			$(".pop-up").removeClass("block");
			$(".pop-up").removeClass("ed");
		});
	}
	//  收起 右侧弹窗  function end
    var page = 0;
    var listRows = 8;
    var firstRow = page*listRows;
    var hasMore =true;



    function getDiscountGoods(){
        $(".hot-sale").hide();
        $(".hot-search").hide();
        $(".hot-shop").hide();
        $(".hot-discount").show();
        $.ajax({
            url:ApiUrl+'?ctl=DiscountBuy&met=discountBuyList&typ=json',
            type:'post',
            dataType:'json',
            data:{firstRow:firstRow,listRows:listRows,discount_l:0,discount_r:10,self_support:3},
            success:function(res){
                console.log(res);
                if(res.status==200){

                    var discount = template.render("discount",res);
                    $(".hot-discount ul").html(discount);


                }


            }
        })
    }

        /*下拉框加载*/
    var pagesroll = 1;
    var listRowsSroll = 8;
    var firstRowSroll = pagesroll*listRowsSroll;
    var hasMore =true;


    function getDiscountGoodsSroll(){
        $(".hot-sale").hide();
        $(".hot-search").hide();
        $(".hot-shop").hide();
        $(".hot-discount").show();
        $.ajax({
            url:ApiUrl+'?ctl=DiscountBuy&met=discountBuyList&typ=json',
            type:'post',
            dataType:'json',
            data:{firstRow:firstRowSroll,listRows:listRowsSroll,discount_l:0,discount_r:10,self_support:3},
            success:function(res){
                console.log(res);
                if(res.status==200){
                    var num;
                    for(var i=0; i<res.data.items.length; i++){
                        num =firstRowSroll+i+1;
                        res.data.items[i].num = num;
                        console.log( typeof res.data.items[i].num);
                    }
                    var discountsroll = template.render("discountsroll",res);
                    $(".hot-discount ul").append(discountsroll);
                    if((8+firstRowSroll)<res.data.totalsize){
                        hasMore=true;
                        $(".loading").show();
                    }else{
                        hasMore=false;
                        $(".loading").hide();
                    }
                    pagesroll++;
                    firstRowSroll = pagesroll*listRowsSroll;


                }


            }
        })
    }


    $(".main-nav-list li").eq(3).click(function(){
        /*下拉框加载*/
         pagesroll = 1;
         listRowsSroll = 8;
         firstRowSroll = pagesroll*listRowsSroll;
         hasMore =true;
        getDiscountGoods();

    })


    $(window).scroll(function(e) {
        if( !($(".pop-up").hasClass("block")) && !($(".ui-mask").hasClass("block")) ){
            if($(window).scrollTop() + $(window).height()== $(document).height()) {
                if($(".main-nav-list li").eq(3).hasClass("curr"))
                {
                    if(hasMore){
                        getDiscountGoodsSroll();
                    }

                }
            }
        }
    });

});





function gesture () {
    var startx, starty;  
    //获得角度  
    function getAngle(angx, angy) {  
        return Math.atan2(angy, angx) * 180 / Math.PI;

    }
    //根据起点终点返回方向 1向上 2向下 3向左 4向右 0未滑动  
    function getDirection(startx, starty, endx, endy) {  
        var angx = endx - startx;  
        var angy = endy - starty;  
        var result = 0;  
   
        //如果滑动距离太短  
        if (Math.abs(angx) < 2 && Math.abs(angy) < 2) {  
            return result;  
        }  
   
        var angle = getAngle(angx, angy);  
        if (angle >= -135 && angle <= -45) {  
            result = 1;  
        } else if (angle > 45 && angle < 135) {  
            result = 2;  
        } else if ((angle >= 135 && angle <= 180) || (angle >= -180 && angle < -135)) {  
            result = 3;  
        } else if (angle >= -45 && angle <= 45) {  
            result = 4;  
        }  
   
        return result;  
    }  
    //手指接触屏幕  
    document.addEventListener("touchstart", function(e) {  
        startx = e.touches[0].pageX;  
        starty = e.touches[0].pageY;  
    }, false);  
    //手指离开屏幕  
    document.addEventListener("touchend", function(e) {  
        var endx, endy;  
        endx = e.changedTouches[0].pageX;  
        endy = e.changedTouches[0].pageY;  
        var direction = getDirection(startx, starty, endx, endy);  
        switch (direction) {  
            case 0:  
                //alert("未滑动！");  
                break;  
            case 1:  
//              alert("向上！")
                if( !($(".pop-up").hasClass("animated")) && !($(".more-activties-wrap").hasClass("animated")) ){
					//当 pop-up  和 更多活动 么有被打开时 向上手势  会 增加 hide-header-top
                	$("body").addClass("hide-header-top");
                }else{
                	return false;
                }
                break;  
            case 2:  
				if( !($(".pop-up").hasClass("animated")) && !($(".more-activties-wrap").hasClass("animated")) ){
					//当 pop-up  和 更多活动 么有被打开时 向下手势  会 移除 hide-header-top
                	$("body").removeClass("hide-header-top");
               }else if( $(".pop-up").hasClass("animated") || $(".more-activties-wrap").hasClass("animated") ){
					//当 pop-up  和 更多活动 有一个 被打开时 向下手势  会什么都不做
                	return false;
                }
                break;  
            case 3:  
                //alert("向左！")  
                break;  
            case 4:  
                //alert("向右！")  
                break;  
            default:  
        }  
    }, false);  
  

}

function getMainCat(){

    $.ajax({
        type: 'post',
        url: ApiUrl+'?ctl=Goods_Top&met=index&typ=json',
        data:{},
        dataType:'json',
        success: function(result) {

            if(result.status=200){
                var navList='';
				var items= result.data.cat_data;
				var cat_id= result.data.cat_data[0].cat_id;
				var cat_name= result.data.cat_data[0].cat_name;
                for(var i=0 ; i<items.length; i++){
                	if(i==0){
                        navList += '<li class="curr" onclick="getChildCat('+items[i].cat_id+')" data-id="'+items[i].cat_id +'"><a href="javascript:;"><img class="icon" alt="" src="'+items[i].cat_pic+'" /><span>' + items[i].cat_name + '</span></a></li>';

                    }else{
                        navList += '<li  onclick="getChildCat('+items[i].cat_id+')" data-id="'+items[i].cat_id +'"><a href="javascript:;"><img class="icon"  alt="" src="'+items[i].cat_pic+'"/><span>' + items[i].cat_name + '</span></a></li>';

                    }
                }
                $(".nav-scroll-wrap ul").html(navList);

                getChildCat(cat_id);

                var nav_list = template.render("nav_lun",result.data)
                $(".banner .swiper-wrapper").html(nav_list)

                //导航处   start
                var navli_w=$(".nav-scroll-wrap li").first().children("a").innerWidth();
                $(".sideline").width(navli_w);
                var marginStr = $(".nav-scroll-wrap a").css("margin");
                var marginL = parseFloat(marginStr.split(" ")[1]);
                $(".sideline").css({"left":marginL + "px"});

                $(".nav-scroll-wrap li").on('click', function(){
                    if($(".more-activties-wrap").hasClass("animated") || $(".pop-up").hasClass("animated")){

                    }else{

                        navli_w=$(this).children("a").outerWidth();
                        $(".sideline").css({"width":$('.nav .nav-scroll-wrap li').eq(mySwiper_page.activeIndex).children("a").outerWidth()});
                        $(".sideline").css({"left":$('.nav .nav-scroll-wrap li').eq(mySwiper_page.activeIndex).position().left + marginL});
                        $(this).addClass("curr").siblings().removeClass("curr");
                        var nav_w = ($(".nav").width() - navli_w) / 2;
                        var fnl_l;
                        var fnl_x = parseInt($(this).position().left);
                        if (fnl_x <= nav_w) {
                            fnl_l = 0;
                        } else if (nav_w - fnl_x <= nb_w - nsw_w) {
                            fnl_l = nb_w - nsw_w;
                        } else {
                            fnl_l = nav_w - fnl_x;
                        }
                        $(".nav-bar").animate({
                            "scrollLeft" : -fnl_l
                        }, 0);
                        mySwiper_page.slideTo($(this).index(), 300);
                    }
                });

                var nsw_w=$(".nav-scroll-wrap").width();
                var nb_w=$(".nav-bar").width();
                //导航处   end



                /*初始化  swiper*/
                var mySwiper_page = new Swiper ('.page.swiper-container', {
                    direction: 'horizontal',
                    loop: false,
                    followFinger:false,
                    onTransitionStart:function(swiper){
                        var nav_w = ($(".nav").width() - navli_w) / 2;
                        var fnl_l;
                        var fnl_x = parseInt($('.nav .nav-scroll-wrap li').eq(mySwiper_page.activeIndex).position().left);
                        if (fnl_x <= nav_w) {
                            fnl_l = 0;
                        } else if (nav_w - fnl_x <= nb_w - nsw_w) {
                            fnl_l = nb_w - nsw_w;
                        } else {
                            fnl_l = nav_w - fnl_x;
                        }

                        $(".nav-bar").animate({
                            "scrollLeft" : -fnl_l
                        }, 0);
                        $(window).scrollTop(0);
                        $(".sideline").css({"width":$('.nav .nav-scroll-wrap li').eq(mySwiper_page.activeIndex).children("a").outerWidth()});
                        $(".sideline").css({"left":$('.nav .nav-scroll-wrap li').eq(mySwiper_page.activeIndex).position().left + marginL});
                        $('.nav .nav-scroll-wrap li').eq(mySwiper_page.activeIndex).addClass('curr').siblings("li").removeClass('curr');
                    }

                });


                /*初始化  swiper end*/

            }
        },
        error:function () {
        }
    });

}
//获取当前分类下二级分类
function getChildCat(id){
    $(".hot-sale").show();
    $(".hot-shop").hide();
    $(".hot-search").hide();
    $(".hot-discount").hide();
	var cat_id = id;
	$.ajax({
        type: 'post',
        url: ApiUrl+'?ctl=Goods_Top&met=getChildCat&typ=json',
        data:{cat_parent_id:cat_id},
        dataType:'json',
		success:function(result){

        	if(200 == result.status){
				var data  = result.data;
				var nav = template.render('nav_list',data);
				$('.s-nav .s-nav-list').html(nav);


                //点击  导航(小)---》  全部分类处  高亮   start
                $(".s-nav-list .s-nav-list-li").click(function(){
                    if($(".pop-up").hasClass("animated")){
                        popUpStop();
                    }else{
                        $(this).addClass("curr").siblings("li.curr").removeClass("curr");
                    }
                });
                //点击  导航(小)---》  全部分类处  高亮   end
				var subCatIds = result.data.subCatIds;

				getGoodsSale(subCatIds);
                shopSale(subCatIds);

			}

		},

	})

}

//热卖榜函数
function getGoodsSale(ids){
    $(".main-nav-list li").eq(0).addClass("curr").siblings("li.cuur").removeClass("curr");
    for(var i=1;i<$(".main-nav-list li").length;i++){
        $(".main-nav-list li").eq(i).removeClass("curr");
    }
    $(".hot-shop").hide();
    $(".hot-search").hide();
    $(".hot-discount").hide();
    $(".hot-sale").show();

	var catIds =ids;
	var page=1;
	var pageSize=30;
    $.ajax({
		type:'post',
		url:ApiUrl+'?ctl=Goods_Top&met=goodsSale&typ=json',
		data:{cat_ids:"("+catIds+")",pageSize:pageSize,page:page},
        dataType:'json',
		success:function(res){
            if(res.status=200) {

                 var goods_sale = template.render("goods_sales",res);
                 $(".hot-sale .goods-ul").html(goods_sale);

            }
		}

	})
}
//店铺榜
function shopSale(ids){
    var catIds =ids;
    var page=1;
    var pageSize=12;
    $.ajax({
        type:'post',
        url:ApiUrl+'?ctl=Goods_Top&met=getShopSaleGoods&typ=json',
        data:{cat_ids:"("+catIds+")",pageSize:pageSize,page:page},
        dataType:'json',
        success:function(result){
            if(result.status=200) {

                var shop_list = template.render("shop_list",result.data);
                $(".hot-shop ul").html(shop_list);
                var mySwiper_banner = new Swiper ('.banner.swiper-container', {
                    direction: 'horizontal',
                    loop: true,
                    pagination: '.swiper-pagination',
                    autoplayDisableOnInteraction : false,
                    autoplay: 3500,
                });
            }

        }

    })
}

//热搜榜

function getSearchWord(){
    $(".hot-sale").hide();
    $(".hot-discount").hide();
    $(".hot-shop").hide();
    $(".hot-search").show();
	$.ajax({
        url:ApiUrl+'?ctl=Goods_Top&met=getSearchWordAll&typ=json',
        type:'post',
        dataType:'json',
		success:function(res){
            console.log(res);
			if(res.status==200){
				var search = template.render('sList',res);
				$(".hot-search ul").html(search);

                    var mySwiper_elevator = new Swiper ('.hot-search .swiper-container', {
                    direction: 'horizontal',
                    loop: false,
                    slidesPerView:3,
                    touchMoveStopPropagation:false,
                    freeMode:true   //  若为false  则只滑动一格
                });

           }



		}
	})
}


//搜索商品//搜索框查询
function searchKey(){
	// console.log(WapSiteUrl) ;
	var keyWord= $('#val').val();
	// alert(keyWord);
    var url = WapSiteUrl+'/tmpl/product_list.html?keyword='+keyWord;
    location.href=url;
}


function shop(e){
    $(".hot-sale").hide();
    $(".hot-search .common-shop-search").hide();
    $(".hot-discount").hide();
    $(".hot-shop").show();

}


//获取轮播图 navlist


