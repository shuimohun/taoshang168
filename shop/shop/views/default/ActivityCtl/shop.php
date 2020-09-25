<?php
include $this->view->getTplPath() . '/' . 'header.php';
?>
<body>
<link rel="stylesheet" type="text/css" href="<?= $this->view->css ?>/shop.css">
<script type="text/javascript" src="<?=$this->view->js_com?>/template.js"></script>
<script>
    var sci = getQueryString('sci');
    $(function(){
     $('.lf.sci_'+sci).attr('class','lf curr');
    });

</script>
	<div class="banner">
		<div class="swiper-container">
            <?php if($slider){?>
			<div class="swiper-wrapper">
                <?php foreach($slider as $key=>$value){?>
				<div class="swiper-slide">
					<a href="<?=$value['url'] ?>">
						<img src="<?=$value['pic_url'] ?>" alt="">
					</a>
				</div>
				<?php } ?>
			</div>
            <?php } ?>
		</div>
	</div>
	<div class="shop-wrap w-1200">

		<div class="small-wrap-base  mt-20">
			<div class="small-nav-wrap">
                <?php if($cat){?>
				<div class="small-nav all-type has-arrow">
					<div class="inner-1200">
						<div class="kind lf  curr">	
							<a href="<?=YLB_Registry::get('url').'?ctl=Activity&met=shop'?>">
								<i></i>
								全部类目
							</a>
						</div>
						<ul class="orflow">
                            <?php foreach($cat as $key=>$value){?>
		                    <li class="lf sci_<?=$value['shop_class_id'] ?>">
		                    	<a href="<?=YLB_Registry::get('url').'?ctl=Activity&met=shop&sci='.$value['shop_class_id']?>"><?=$value['shop_class_name'] ?></a>
		                    </li>
		                    <?php } ?>
						</ul>
					</div>
				</div>
                <?php } ?>
			</div>
		</div>
		<div class="nice-wrap mt-20">
			<div class="wrap-title">
				<div class="bar"></div>
				<div class="title"></div>
			</div>
            <?php if($nice_shop){?>
			<div class="nice-content">
				<ul class="nice-list orflow">
                    <?php foreach($nice_shop as $key=>$value){?>
					<li class="nice-item lf">
						<a href="<?=YLB_Registry::get('url').'?ctl=Shop&met=index&typ=e&id='.$value['shop_id'] ?>">
							<div class="img-center">
								<img src="<?=$value['shop_logo_wap'] ?>" alt="">
							</div>
							<p class="nice-item-name text1"><?=$value['shop_name'] ?></p>
							<div class="enter-shop">
								<div class="smile-wrap lf">
									<div class="smile"><span><?=$value['ove_me'] ?>%</span>超满意</div>
									<i class="icon"></i>
								</div>
								<span class="rt enter-shop-btn">进店看看&nbsp;></span>
							</div>
						</a>
					</li>
                    <?php } ?>
				</ul>
			</div>
            <?php } ?>
		</div>
		<div class="good-shops mt-20">
			<div class="wrap-title">
				<div class="bar"></div>
				<div class="title"></div>
			</div>
            <?php if($sure_shop){ ?>
			<div class="good-shops-content">
				<ul class="good-shops-list orflow" id="activityList">
                     <?php foreach ($sure_shop as $key=>$value){ ?>
					<li class="good-shops-item lf">
						<div class="shop-introduce orflow">
							<div class="lf introduce-left">
								<div class="img-center lf">
									<img src="<?=$value['shop_logo_wap'] ?>" alt="">
								</div>
								<div class="img-else">
									<h3 class="text1"><a href="<?=YLB_Registry::get('url').'?ctl=Shop&met=index&id='.$value['shop_id'] ?>"><?=$value['shop_name'] ?></a></h3>
                                    <span class="collectioned"><?php if($value['shop_self_support'] == 'true'){?><span class="goods_self m-r-5">自营</span><?php } ?> 共<?=$value['shop_collect'] ?>人收藏</span>
								</div>
							</div>
							<div class="rt introduce-right">
								<div class="all-goods">
									<a href="<?=YLB_Registry::get('url').'?ctl=Shop&met=goodsList&id='.$value['shop_id']?>">
										全部商品<?=$value['goods_total']?>件
										<i class="icon"></i>
									</a>
								</div>
								<span class="watch-update">
									<a href="<?=YLB_Registry::get('url').'?ctl=Shop&met=goodsList&order=common_sell_time&sort=desc&id='.$value['shop_id']?>">
										查看上新&nbsp;&nbsp;>>
									</a>
								</span>
							</div>
						</div>
						<div class="goods-show">
							<ul class="goods-show-list orflow">
                                <?php if($value['common_goods']){ ?>
                                    <?php foreach($value['common_goods'] as $k=>$v){ ?>
								        <li class="goods-show-item lf">
                                            <div class="img-center">
                                                <img src="<?=$v['common_image'] ?>" alt="">
                                            </div>
                                            <p class="good-describe text2"><a href="<?=YLB_Registry::get('url').'?ctl=Goods_Goods&met=goods&type=goods&gid='.$v['id_goods']?>"><?=$v['common_name'] ?></a></p>
                                            <div class="share-wrap clearfix">
                                                <div class="share orflow">
                                                    <span>分享立减</span>
                                                    <span class="save">￥<?=$v['common_share_price'] ?></span>
                                                </div>
                                            </div>
                                            <div class="share-wrap clearfix">
                                                <div class="share orflow">
                                                    <span>立赚</span>
                                                    <span class="save">￥<?=$v['common_promotion_price'] ?></span>
                                                </div>
                                            </div>
                                            <div class="like-collection orflow">
                                                <a href="javascript:;">
                                                    <i class="icon lf <?php if($v['is_favorite']){ ?>curr<?php } ?>" data-goods-id="<?=$v['id_goods'] ?>"></i>
                                                </a>
                                                <span class="lf"><?=$v['common_collect'] ?>人收藏</span>
                                            </div>
                                        </li>
                                    <?php } ?>
								<?php } ?>
							</ul>
						</div>
					</li>
                    <?php } ?>
					
				</ul>
			</div>
            <?php } ?>
            <div class="ui-pagination page" id="listPage">
            </div>
		</div>
	</div>
    <script type="text/html" id="shop_append">
        <% if(items){ %>
        <% for(var i in items){ %>
        <li class="good-shops-item lf">
            <div class="shop-introduce orflow">
                <div class="lf introduce-left">
                    <div class="img-center lf">
                        <img src="<%=items[i].shop_logo_wap %>" alt="">
                    </div>
                    <div class="img-else">
                        <h3 class="text1"><a href="<?=YLB_Registry::get('url').'?ctl=Shop&met=index&id='?><%=items[i].shop_id %>"><%=items[i].shop_name %></a></h3>
                        <span class="collectioned"><% if(items[i].shop_self_support == 'true'){%><span class="goods_self m-r-5">自营</span><% } %> 共<%=items[i].shop_collect %>人收藏</span>
                    </div>
                </div>
                <div class="rt introduce-right">
                    <div class="all-goods">
                        <a href="<?=YLB_Registry::get('url').'?ctl=Shop&met=goodsList&id='?><%=items[i].shop_id %>">
                            全部商品<%=items[i].goods_total %>件
                            <i class="icon"></i>
                        </a>
                    </div>
                    <span class="watch-update">
                        <a href="<?=YLB_Registry::get('url').'?ctl=Shop&met=goodsList&order=common_sell_time&sort=desc&id='?><%=items[i].shop_id %>">
                            查看上新&nbsp;&nbsp;>>
                        </a>
                    </span>
                </div>
            </div>
            <% if(items[i].common_goods){ %>
            <div class="goods-show">
                <ul class="goods-show-list orflow">
                    <% var goods = items[i].common_goods %>
                    <% for(var k in items[i].common_goods){ %>
                    <li class="goods-show-item lf">
                        <div class="img-center">
                            <img src="<%=goods[k].common_image %>" alt="">
                        </div>
                        <p class="good-describe text2"><a href="<?=YLB_Registry::get('url').'?ctl=Goods_Goods&met=goods&type=goods&gid='?><%=goods[k].id_goods %>"><%=goods[k].common_name %></a></p>
                        <div class="share-wrap clearfix">
                            <div class="share orflow">
                                <span>分享立减</span>
                                <span class="save">￥<%=goods[k].common_share_price %></span>
                            </div>
                        </div>
                        <div class="share-wrap clearfix">
                            <div class="share orflow">
                                <span>立赚</span>
                                <span class="save">￥<%=goods[k].common_promotion_price %></span>
                            </div>
                        </div>
                        <div class="like-collection orflow">
                            <a href="javascript:;">
                                <i class="icon lf <% if(goods[k].is_favorite){ %>curr<% } %>" data-goods-id="<%=goods[k].id_goods %>"></i>
                            </a>
                            <span class="lf"><%=goods[k].common_collect %>人收藏</span>
                        </div>
                    </li>
                    <% } %>
                </ul>
            </div>
            <% } %>
        </li>
        <% } %>
        <% } %>
    </script>
	<script type="text/javascript">


	$(window).scroll(function(){
				if($(window).scrollTop() > $(".small-wrap-base").offset().top){
					var $navH = $(".small-nav-wrap").outerHeight();
//					$(".nice-wrap").css({"margin-top":$navH});
					$(".small-nav").addClass("fixed");
				}else{
//					$(".nice-wrap").css({"margin-top":0});
					$(".small-nav").removeClass("fixed");
				}
			});

		$(function(){

		    (function getH() {
		         var h = $(".small-nav-wrap").outerHeight() + 'px';
                 $(".small-nav-wrap").css({"height": h});
		    }())
			
			 var swiper = new Swiper('.swiper-container', {
                pagination: '.swiper-pagination',
                paginationClickable: true,
                spaceBetween: 30,
                centeredSlides: true,
                autoplay: 5000,
                autoplayDisableOnInteraction: false,
                loop: true,
                noSwiping : true,
                noSwipingClass : 'swiper-slide'
            });

			
			$(".kind").click(function(){
				// $(this).addClass("curr");
				$(this).siblings("ul").children(".curr").removeClass("curr");
				$(".type-detail").removeClass("block");
			});
			
			$(".all-type li").click(function(){
				$(this).addClass("curr");
				$(this).siblings(".curr").removeClass("curr");
				// $(this).parent("ul").siblings(".curr").removeClass("curr");
				$(".type-detail").addClass("block");
			});

			$(".type-detail li").click(function(){
				$(this).addClass("curr");
				$(this).siblings(".curr").removeClass("curr");
			}); 
				//判断 什么时候有 type-detail   start
			if($(".type-detail li").hasClass("curr")){
				$(".type-detail").addClass("block");
			}else{
				$(".type-detail").removeClass("block");
			};

			$(".like-collection .icon").click(function(){
				if(!($(this).hasClass("curr"))){
                    favoriteGoods($(this).attr('data-goods-id'));
					$(this).addClass("curr");
				}else{
                    dropFavoriteGoods($(this).attr('data-goods-id'));
					$(this).removeClass("curr");
				}
			})
		});

    function favoriteGoods(goods_id){
        var key = getCookie('key');
        if (!key) {
            checkLogin(0);
            return;
        }
        if (goods_id <= 0) {
            $.sDialog({skin: "green", content: '参数错误', okBtn: false, cancelBtn: false});
            return false;
        }
        var return_val = false;
        $.ajax({
            type: 'post',
            url: SITE_URL+'?ctl=Goods_Goods&met=collectGoods&typ=json',
            data:{k:key,u:getCookie('id'),goods_id:goods_id},
            dataType: 'json',
            async: false,
            success: function(result) {
                if (result.status == 200) {
//                     $.sDialog({skin: "green", content: "收藏成功！", okBtn: false, cancelBtn: false});
                    return_val = true;
                } else {
                    $.sDialog({skin: "red", content: result.data.error, okBtn: false, cancelBtn: false});
                }
            }
        });
        return return_val;
    }

    function dropFavoriteGoods(goods_id){
        var key = getCookie('key');
        if (!key) { checkLogin(0); return; }
        if (goods_id <= 0) {
            $.sDialog({skin: "green", content: '参数错误', okBtn: false, cancelBtn: false}); return false;
        }
        var return_val = false;
        $.ajax({
            type: 'post',
            url: SITE_URL+'?ctl=Goods_Goods&met=canleCollectGoods&typ=json',
            data: {k: key,u:getCookie('id'), goods_id: goods_id},
            dataType: 'json',
            async: false,
            success: function(result) {
                if (result.status == 200) {
//                     $.sDialog({skin: "green", content: "已取消收藏！", okBtn: false, cancelBtn: false});
                    return_val = true;
                } else {
                    console.log(result);
                    $.sDialog({skin: "red", content: result.data.error, okBtn: false, cancelBtn: false});
                }
            }
        });
        return return_val;
    }
	</script>

    <script type="text/javascript">
        var sci = getQueryString('sci');
        var _page ={
            page:1,
            rows:8,
            firstRow: 0,
            totalRows: 0
        };
        //加载初始分页
        $(function(){
            $.post(SITE_URL+'?ctl=Api_App_FindShop&met=sureShop&typ=json',{sci:sci},function(r){
               if(r.status == 200)
               {
                   loadPage(r.data);
               }
            });
        });

         function get_sure_shop()
         {
            var param = {};
            param.sci = sci;
            $.ajax({
                url:SITE_URL+'?ctl=Api_App_FindShop&met=sureShop&typ=json&firstRow='+_page.firstRow+'&totalRows='+_page.totalRows,
                data:param,
                type:'post',
                dataType:'json',
                success:function(r)
                {
                    if(r.status == 200)
                    {
                        var shopHtml = template.render('shop_append',r.data);
                        $('.good-shops-list').html(shopHtml);
                        console.log(r.data);
                        loadPage(r.data);
                    }
                }
            });
         }

         function loadPage(data)
         {
             var page_nav = $(data.page_nav).each(function(index, element){
                 var href = $(this).prop('href');
                 if ( !(typeof href == 'undefined') ) {
                     var firstRow = href.match(/firstRow=\d+/).join().replace('firstRow=', ''),
                         totalRows = href.match(/totalRows=\d+/).join().replace('totalRows=', '');
                     $(this).data('firstRow', firstRow);
                     $(this).data('totalRows', totalRows);
                 }
                 $(this).prop('href', 'javascript:void(0)');
             });
             $('#listPage').html(page_nav);
         }

         $('#listPage').on('click','a',function(){
             var _thisPage;
             if ( $(this).hasClass('nextPage') || $(this).hasClass('prePage') ) {
                 if ( $(this).hasClass('nextPage') ){
                     _thisPage =  parseInt($('#pagination').find('b').html()) + 1;
                 } else {
                     _thisPage =  parseInt($('#pagination').find('b').html()) - 1;
                 }

             } else {
                 _thisPage =  $(this).html().replace(/\.+/, '');
             }
             _page.page = _thisPage;
             _page.firstRow = $(this).data('firstRow'), _page.totalRows = $(this).data('totalRows');
             get_sure_shop();
         })

    </script>
</body>
<?php
include $this->view->getTplPath() . '/' . 'footer.php';
?>