<?php if (!defined('ROOT_PATH')){exit('No Permission');}?>
<?php
include $this->view->getTplPath() . '/' . 'header.php';
?>
    <script src="<?=$this->view->js?>/angular.js"></script>
    <link rel="stylesheet"  type="text/css" href="<?= $this->view->css ?>/dailyBuy.css">
<div ng-app="app" ng-controller="dailyBuyCtl" >

<!-- 内容 -->
	<div class="fix-nav">
		<div class="fix-nav-1200">
			<div class="fix-nav-kinds lf curr">
				<a href="<?=YLB_Registry::get('url')?>?ctl=Goods_Cheap&met=index<?php if(isset($type)){ ?>&type=<?=$type?><?php }?>" class="w-130">
					<span>≡</span>
					全部类目
				</a>

				<div class="silde-menu">
					<ul class="silde-menu-ul">
						<li><a href="<?=YLB_Registry::get('url')?>?ctl=Goods_Cheap&met=index&type=1&cat_sid=" target="_self">今日爆款</a></li>
						<li><a href="<?=YLB_Registry::get('url')?>?ctl=Goods_Cheap&met=index&type=2&cat_id=&cat_sid=" target="_self">人气王收藏</a></li>
					</ul>
				</div>

			</div>

			<!-- 滚动分类 start-->
			<ul class="lf nav-1200-right">
                <li ng-class="{true:'lf curr',false:'lf'}[curr_id==item.cat_id]" ng-repeat="item in navCatList"><a href="javascript:void(0);" ng-click="loadDataBy('cat_id',item.cat_id)" ng-bind="item.nav_name" ng-mouseover="getSecondCat(item.cat_id)"></a></li>
			</ul>
			<!-- 滚动分类 end-->
		</div>

        <div class="fix-nav-bottom">
        	<div class="fix-nav-bottom-1200">
        		<ul ng-init="curr_id2=0">
        			<li ng-class="{true:'lf curr',false:'lf'}[curr_id2==0]">
        				<a href="#">全部</a>
        			</li>
                    <!--二级分类-->
                    <li ng-class="{true:'lf curr',false:'lf'}[curr_id2==item.cat_id]" ng-repeat="item in secondCat">
                        <a href="javascript:void(0);" ng-bind="item.cat_name" ng-click="loadDataBy('cat_id',item.cat_id)"></a>
                    </li>
        		</ul>
        	</div>
        </div>

	</div>

    <div class="banner">
        <div class="swiper-container swiper-container-horizontal">
            <div class="swiper-wrapper" style="position: absolute !important;">
            <!--轮播图-->
                <div class="swiper-slide" ng-repeat="item in advList" >
                    <a href="{{item.url}}"><img ng-src="{{item.pic_url}}"/></a>
                </div>
            </div>
            <div class="swiper-pagination swiper-pagination-clickable swiper-pagination-bullets"><span class="swiper-pagination-bullet"></span><span class="swiper-pagination-bullet"></span><span class="swiper-pagination-bullet"></span><span class="swiper-pagination-bullet"></span><span class="swiper-pagination-bullet"></span><span class="swiper-pagination-bullet"></span><span class="swiper-pagination-bullet"></span><span class="swiper-pagination-bullet swiper-pagination-bullet-active"></span><span class="swiper-pagination-bullet"></span><span class="swiper-pagination-bullet"></span></div>
        </div>
        <script>
            var swiper = new Swiper('.swiper-container', {
                pagination: '.swiper-pagination',
                paginationClickable: true,
                spaceBetween: 30,
                centeredSlides: true,
                autoplay: 5000,
                autoplayDisableOnInteraction: false,
                loop: true
            });
        </script>

    </div>

	<div class="wrap clearfix">
		<div class="small-nav-wrap">
			<div class="small-nav all-type has-arrow">
				<div class="kind lf  curr">
					<a href="<?=YLB_Registry::get('url')?>?ctl=Goods_Cheap&met=index<?php if(isset($type)){ ?>&type=<?=$type?><?php }?>">
						<i></i>
						全部类目
					</a>
				</div>
                <!-- 固定分类 start-->
				<ul class="lf">
                    <li ng-class="{true:'lf curr',false:'lf'}[curr_id==item.cat_id]" ng-repeat="item in navCatList"><a href="javascript:void(0);" ng-click="loadDataBy('cat_id',item.cat_id)" ng-bind="item.nav_name" ng-mouseover="getSecondCat(item.cat_id)"></a></li>
				</ul>
                <!-- 固定分类 end-->

			</div>

             <div class="small-nav type-detail">
                <ul>
                    <li ng-class="{true:'lf curr',false:'lf'}[curr_id2==0]"><a href="#">全部</a></li>
                    <!--二级分类-->
                    <li ng-class="{true:'lf curr',false:'lf'}[curr_id2==item.cat_id]" ng-repeat="item in secondCat"><a href="javascript:void(0);" ng-bind="item.cat_name" ng-click="loadDataBy('cat_id',item.cat_id)"></a></li>

                </ul>
            </div>

		</div>
		<!-- 今日爆款 start-->
		<div class="tody-explosion">
			<div class="title-wrap">
				<div class="title-img">
					<i class="icon"></i>
				</div>
			</div>
			<div class="explosion-wrap">
				<ul class="explosion-list orflow">

					<li class="explosion-item orflow lf" ng-repeat="item in hotList">
						<div class="lf item-left">
							<div class="img-center">
								<a href="#">
									<img ng-src="{{item.common_image}}" alt="" ng-click="goodsInfo(item.common_id)">
								</a>
							</div>
							<div class="share-wrap clearfix">
                                <div class="share lf">
                                    <span>分享立减</span>
                                    <span class="save" ng-bind="item.common_share_price | currency : '￥' "></span>
                                </div>
                                <div class="share rt">
                                    <span>立赚</span>
                                    <span class="save" ng-bind="item.common_promotion_price | currency : '￥' "></span>
                                </div>
                            </div>
						</div>
						<div class="lf item-right">
							<div class="top-ranking">
								<i class="icon"></i>
								<span class="ranking-num" ng-bind="$index+1"></span>
							</div>
							<div class="selled orflow">
								<div class="text-center-wrap">
									<i class="icon lf"></i>
									<p class="selled-detail lf">已售<span ng-bind="item.common_salenum"></span>件!</p>
								</div>
							</div>
							<p class="goods-detail text2" ng-bind="item.common_name" ng-click="goodsInfo(item.common_id)"></p>
							<div class="favourable-icons-wrap orflow">
								<i class="icon reduce-icon lf" ng-show="item.is_man==1"></i>         <!--满-->
								<i class="icon time-icon lf" ng-show="item.common_is_xian==1"></i>       <!--限时-->
							</div>
							<div class="price" ng-bind="item.common_price | currency:'￥'"></div>
							<div class="share-price">
								分享价 <span ng-bind="item.common_shared_price | currency:'￥'"></span>
							</div>
							<div class="option-wrap orflow">
								<a href="javascript:void(0);" ng-click="goodsInfo(item.common_id)">
									<i class="icon lf"></i>
									<span class="lf">分享购买</span>
								</a>
							</div>
						</div>
					</li>

				</ul>
			</div>
		</div>
		<!-- 今日爆款 end-->

	</div>

</div>


<script type="text/javascript">
	//固定导航栏 start
	$(window).scroll(function(){
			if($(window).scrollTop() > ( $(".small-nav-wrap").outerHeight(true)) + $(".small-nav-wrap").offset().top){
				$(".fix-nav").css({"display":"block"});
			}else{
				$(".fix-nav").css({"display":"none"});
			}
		});
	$(function(){
		// 固定导航栏  start
		$(".fix-nav-kinds").mouseover(function(){
			$(".silde-menu-ul").addClass("block");
		}).mouseout(function(){
			$(".silde-menu-ul").removeClass("block");
		});
		$(".fix-nav-kinds").click(function(){
			$(".fix-nav-bottom").removeClass("block");
			$(".fix-nav-1200 .nav-1200-right li").removeClass("curr");
		});
		$(".fix-nav .fix-nav-1200 li").click(function(){
			$(this).addClass("curr");
			$(this).siblings(".curr").removeClass("curr");
			$(".fix-nav-bottom").addClass("block");
		});
		$(".fix-nav-bottom li").click(function(){
			$(this).addClass("curr");
			$(this).siblings(".curr").removeClass("curr");
		});
			//判断 什么时候有 fix-nav-bottom  start
		if($(".fix-nav .nav-1200-right li").hasClass("curr")){
			$(".fix-nav-bottom").addClass("block");
		}else{
			$(".fix-nav-bottom").removeClass("block");
		};
			//判断 什么时候有 fix-nav-bottom   end

		// 固定导航栏  end


		$(".kind").click(function(){
			$(this).addClass("curr");
			$(this).siblings("ul").children(".curr").removeClass("curr");
			$(".type-detail").removeClass("block");
		});

		$(".all-type li").click(function(){
			$(this).addClass("curr");
			$(this).siblings(".curr").removeClass("curr");
			$(this).parent("ul").siblings(".curr").removeClass("curr");
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
			//判断 什么时候有 type-detail    end

	});

</script>

<script >
var app = angular.module('app',[]);
app.controller('dailyBuyCtl',function($scope,$http){

    getAdv = function(){
        $http({
            method:'GET',
                url:"<?=YLB_Registry::get('url')?>" + "/index.php?ctl=Adv_Adv&met=index&type=dailybuy&typ=json"
//              url:"http://www.taoshang168.com/shop/index.php?ctl=Adv_Adv&met=index&type=dailybuy&typ=json"
        }).then(function successCallback(data){
              $scope.advList = data.data.data;
//            alert(JSON.stringify(data.data.data));
        },function errorCallback(msg){
//            alert(JSON.stringify(msg));
        })
    };
    getAdv();

    /**
    * 获取一级分类
    */
    getNavCat = function(){
        $http({
            method:'GET',
            url:"<?=YLB_Registry::get('url')?>" + "/index.php?ctl=Goods_Cat&met=getOneCat&typ=json"
        }).then(function successCallback(data){
            $scope.navCatList = data.data.data;
//            alert(JSON.stringify(data));
        },function errorCallback(msg){
//            alert(JSON.stringify(msg));
        })
    };
    getNavCat();

    /**
    *   获取二级分类
    */
    $scope.getSecondCat = function(cat_id){
        $http({
            method:'GET',
            url:"<?=YLB_Registry::get('url')?>"+"/index.php?ctl=Goods_Cat&met=tree&cat_parent_id="+cat_id+"&type=1&typ=json"
        }).then(function successCallback(res){
            $scope.secondCat = res.data.data.items;
//            alert(JSON.stringify(res.data.data));
        },function errorCallback(msg){
//            alert(JSON.stringify(msg));
        })
    };

    $scope.page = 1;
    $scope.cat_id = 0;
    $scope.nums = 36;

    /**
    * 获取今日爆款数据
    */
    getHotList = function(){
        $http({
            method:'GET',
            url:"<?=YLB_Registry::get('url')?>" + "?ctl=Goods_Goods&met=getGoodsHotList&typ=json&dataType=common_salenum&page="+$scope.page+"&nums="+$scope.nums+"&catId="+$scope.cat_id
        }).then(function successCallback(data){
            $scope.hotList = data.data.data;
//            alert(JSON.stringify($scope.hotList));
        },function errorCallback(msg){

        })
    }
    getHotList();

    /**
    * 根据条件加载数据
    * @param key
    * @param val
    */
    $scope.loadDataBy = function(key,val){
        switch(key){
            case 'cat_id':              //根据分类id加载数据
                $scope.cat_id = val;
                $scope.curr_id = val;
                $scope.curr_id2 = val;
                getHotList();
                break;
            default:
                ;
        }
    }

    /**
    * 页面跳转 - 商品详情
    * @param common_id
    */
    $scope.goodsInfo = function(common_id){
        window.open("<?=YLB_Registry::get('url')?>?ctl=Goods_Goods&met=goods&cid="+common_id);
    }

     /**
     * 下拉更新商品数据
     * @刘贵龙
     */

    var scrolled = false;
    $(window).on('scroll',function(){
        var dh = parseInt(document.body.scrollHeight);
        var wh = parseInt($(window).height());
        var dsh = parseInt($(window).scrollTop());
        var sh = dsh+wh;
        $scope.finished = true;
        if($scope.finished == true && sh == dh-1){
            $scope.finished = false;
            loadMore();
        }
    })

    loadMore = function(){
        $scope.page++;

        $http({
            method:'GET',
            url:"<?=YLB_Registry::get('url')?>" + "?ctl=Goods_Goods&met=getGoodsHotList&typ=json&dataType=common_salenum&page="+$scope.page+"&nums="+$scope.nums+"&catId="+$scope.cat_id,
        }).then(function successCallback(res){
            if(res.data.status == 200 && res.data.data.length > 1){
                var a = $scope.hotListNew = res.data.data;
                var b = $scope.hotList;
                $scope.hotList = b.concat(a);	//加载的分页数据与原数据合并
                setTimeout(function(){
                    $scope.finished = true;
                },1500)
            }
        },function errorCallback(res){

        });
    }


})

</script>

</body>
<!-- 尾部 -->
<?php
/*include $this->view->getTplPath() . '/' . 'footer.php';
*/?>