<?php if (!defined('ROOT_PATH')){exit('No Permission');}?>
<?php
include $this->view->getTplPath() . '/' . 'header.php';
?>
    <script src="<?=$this->view->js?>/angular.js"></script>
    <script src="<?=$this->view->js?>/common.js"></script>
    <link rel="stylesheet"  type="text/css" href="<?= $this->view->css ?>/dailyBuy.css">
<div ng-app="app" ng-controller="dailyBuyCtl">

<!-- 内容 -->
	<div class="fix-nav">
		<div class="fix-nav-1200 orflow">
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
			<ul class="orflow nav-1200-right">
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
        <div class="swiper-container">
            <div class="swiper-wrapper" style="position: absolute !important;">
            <!--轮播图-->
                <div class="swiper-slide" ng-repeat="item in advList" on-finish-render-filters>
                    <a href="{{item.url}}"><img ng-src="{{item.pic_url}}"/></a>
                </div>
            </div>
            <div class="swiper-pagination"></div>
        </div>
    </div>

	<div class="wrap clearfix">
		<div class="small-nav-wrap">
			<div class="small-nav all-type">
				<div class="kind lf  curr">
					<a href="#">
						<i></i>
						全部类型
					</a>
				</div>
				<ul style="overflow:hidden;">
					<li class="lf"><a href="#hotSale">今日爆款</a></li>
					<li class="lf"><a href="#collection">人气王收藏</a></li>
				</ul>
			</div>

			<div class="small-nav all-type has-arrow">
				<div class="kind lf  curr">
					<a href="<?=YLB_Registry::get('url')?>?ctl=Goods_Cheap&met=index<?php if(isset($type)){ ?>&type=<?=$type?><?php }?>">
						<i></i>
						全部类目
					</a>
				</div>
                <!-- 固定分类 start-->
				<ul class="orflow">
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
		<div class="tody-explosion" id="hotSale">
			<div class="title-wrap">
				<div class="title-img">
					<i class="icon"></i>
				</div>
				<a href="?ctl=Activity&met=hotSale" class="more-wrap rt" target="blank">
					<i class="icon"></i>
				</a>
			</div>
			<div class="explosion-wrap">
				<ul class="explosion-list orflow">

					<li class="explosion-item orflow lf" ng-repeat="item in hotList">
						<div class="lf item-left">
							<div class="img-center">

									<img ng-src="{{item.common_image}}" style="cursor:pointer"  alt="" ng-click="goodsInfo(item.common_id)">
								
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
							<p class="goods-detail text2" style="cursor:pointer"  ng-bind="item.common_name" ng-click="goodsInfo(item.common_id)"></p>
							<div class="favourable-icons-wrap orflow">
								<i class="icon reduce-icon lf" ng-show="item.is_man==1"></i>         <!--满-->
								<i class="icon time-icon lf" ng-show="item.common_is_xian==1"></i>       <!--限时-->
							</div>
							<div class="price" ng-bind="item.common_price | currency:'￥'"></div>
							<div class="share-price">
								分享价 <span ng-bind="item.common_shared_price | currency:'￥'"></span>
							</div>
							<div class="option-wrap orflow">
							    <i class="icon lf" style="cursor: pointer"></i>
								<a href="javascript:void(0);" ng-click="goodsInfo(item.common_id)">
									<span class="lf">分享购买</span>
								</a>
							</div>
						</div>
					</li>

				</ul>
			</div>
		</div>
		<!-- 今日爆款 end-->

		<!-- 人气王收藏  start -->
		<div class="top-collection" id="collection">
			<div class="title-wrap">
				<div class="title-img">
					<i class="icon"></i>
				</div>
				<a href="?ctl=Activity&met=topCollection" class="more-wrap rt" target="blank">
					<i class="icon"></i>
				</a>
			</div>
			<div class="collection-wrap">
				<ul class="collection-list">

					<li class="collection-item lf" ng-repeat="item in collectList">
                        <div class="item-top">
                            <div class="img-center">
                                <img ng-src="{{item.common_image}}" style="cursor:pointer"  alt="" ng-click="goodsInfo(item.common_id)" style="cursor:pointer">
                                <div class="top-ranking orflow flag1">  <!--通过 flag1  flag2 flag3变换颜色 ， 默认为灰色-->
                                    <span class="stone lf"></span>
                                    <div class="stone-right lf">
                                        <span class="collection-num" ng-bind="item.common_collect"></span>
                                        <span class="collection-text">已收藏</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="item-bottom">
                            <div class="goods-detail text2" style="cursor:pointer"  ng-bind="item.common_name" ng-click="goodsInfo(item.common_id)" ng-click="goodsInfo(item.common_id)" style="cursor:pointer"></div>
                            <div class="favourable-icons-wrap orflow">
                                <i class="icon reduce-icon lf" ng-show="item.is_man==1"></i>
                                <i class="icon time-icon lf" ng-show="item.is_man==1"></i>
                            </div>
                            <div class="share-wrap clearfix">
                                <div class="share orflow">
                                    <span>分享立减</span>
                                    <span class="save" ng-bind="item.common_share_price | currency : '￥'"></span>
                                </div>
                            </div>
                            <div class="share-wrap clearfix">
                                <div class="share orflow">
                                    <span>立赚</span>
                                    <span class="save" ng-bind="item.common_promotion_price | currency : '￥'"></span>
                                </div>
                            </div>
                            <div class="price-wrap">
                                <span class="new-price" ng-bind="item.common_shared_price | currency : '￥'"></span>
                                <span class="old-price" ng-bind="item.common_price | currency : '￥'"></span>
                            </div>
                            <div class="option-wrap orflow">
                                <i class="icon lf" style="cursor:pointer" ng-click="collect($event,item.is_liked,item.common_goods_id)"></i>
                                已收藏 {{item.common_collect}} 人
                            </div>
                        </div>
					</li>

				</ul>
			</div>
		</div>
		<!-- 人气王收藏  end -->
	</div>

</div>

<script >
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

       /* (function caluHeight() {
            var calH = $(".small-nav-wrap .small-nav.all-type.has-arrow").outerHeight() + 'px';
            alert(calH)
            $(".fix-nav").css({"height": calH})
        }())*/


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

    var app = angular.module('app',[]);
    app.directive('onFinishRenderFilters', function ($timeout) {
        return {
            restrict: 'A',
            link: function(scope, element, attr) {
                if (scope.$last === true) {
                    $timeout(function() {
                        scope.$emit('ngRepeatFinished');
                    });
                }
            }
        };
    });
    app.controller('dailyBuyCtl',function($scope,$http){
        getAdv = function(){
            $http({
                method:'GET',
                url:"<?=YLB_Registry::get('url')?>" + "?ctl=Adv_Adv&met=index&type=dailybuy&typ=json"
            }).then(function successCallback(data){
                $scope.advList = data.data.data;
            },function errorCallback(msg){

            })
        };
        getAdv();

        /**
        * 获取一级分类
        */
        getNavCat = function(){
            $http({
                method:'GET',
                url:"<?=YLB_Registry::get('url')?>" + "?ctl=Goods_Cat&met=getOneCat&typ=json"
            }).then(function successCallback(data){
                $scope.navCatList = data.data.data;

            },function errorCallback(msg){

            })
        };
        getNavCat();

        /**
        *   获取二级分类
        */
        $scope.getSecondCat = function(cat_id){
            $http({
                method:'GET',
                url:"<?=YLB_Registry::get('url')?>"+"?ctl=Goods_Cat&met=tree&cat_parent_id="+cat_id+"&type=1&typ=json"
            }).then(function successCallback(res){
                $scope.secondCat = res.data.data.items;
            },function errorCallback(msg){

            })
        };

        $scope.page = 1;
        $scope.cat_id = 0;
        $scope.nums = 9;
        $scope.nums_c = 12;
        /**
        * 获取今日爆款数据
        */
        getHotList = function(){
            $http({
                method:'GET',
                url:"<?=YLB_Registry::get('url')?>" + "?ctl=Goods_Goods&met=getGoodsHotList&typ=json&dataType=common_salenum&page="+$scope.page+"&nums="+$scope.nums+"&catId="+$scope.cat_id
            }).then(function successCallback(data){
                $scope.hotList = data.data.data;

            },function errorCallback(msg){

            })
        }
        getHotList();

        /**
        * 获取收藏商品数据
        */
        getCollectList = function(){
            $http({
                method:'GET',
                url:"<?=YLB_Registry::get('url')?>" + "?ctl=Goods_Goods&met=getGoodsHotList&typ=json&dataType=common_collect&page="+$scope.page+"&nums="+$scope.nums_c+"&catId="+$scope.cat_id
            }).then(function successCallback(data){
                $scope.collectList = data.data.data;

            },function errorCallback(msg){

            })
        };
        getCollectList();

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
                    getCollectList();
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
         * 收藏商品
         * @param $event
         * @param is_favorite
         * @param goods_id
         * @liuguilong 20170710
         */
        $scope.collect = function($event,is_liked,goods_id){
            var thisDom = $($event.target);
            if(is_favorite == 0){
                var url = '<?=YLB_Registry::get('url')?>?ctl=Goods_Goods&met=collectGoods&typ=json';
                $http({
                    method: 'POST',
                    url: url,
                    params: {goods_id: goods_id}
                }).then(function successCallback(res) {
                    Public.tips.success('收藏成功！');
                    thisDom.attr('src', '<?=$this->view->img?>/book_s.png');
                    loadData();
                }, function errorCallback(msg) {

                })
            }else{
                var url = '<?=YLB_Registry::get('url')?>?ctl=Goods_Goods&met=canleCollectGoods&typ=json';
                $http({
                    method:'POST',
                    url:url,
                    params:{goods_id:goods_id}
                }).then(function successCallback(res){
                    Public.tips.error('取消收藏成功！');
                    thisDom.attr('src','<?=$this->view->img?>/book_n.png');
                    loadData();
                },function errorCallback(msg){

                })
            }
        }

        $scope.$on('ngRepeatFinished', function (ngRepeatFinishedEvent) {
            var swiper = new Swiper('.swiper-container', {
                pagination: '.swiper-pagination',
                paginationClickable: true,
                spaceBetween: 30,
                centeredSlides: true,
                autoplay: 5000,
                autoplayDisableOnInteraction: false,
                loop: true
            });
        });
    })

</script>

</body>
<!-- 尾部 -->
<?php
include $this->view->getTplPath() . '/' . 'footer.php';
?>