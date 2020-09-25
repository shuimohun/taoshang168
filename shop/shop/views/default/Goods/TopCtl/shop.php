<?php if (!defined('ROOT_PATH')){exit('No Permission');}?>
<?php
include $this->view->getTplPath() . '/' . 'header.php';
?>
<link rel="stylesheet"  type="text/css" href="<?= $this->view->css ?>/goods_top_shop.css">
<script type="text/javascript" src="<?= $this->view->js ?>/jquery.js"></script>
<script type="text/javascript" src="<?= $this->view->js ?>/angular.js"></script>
   <div class="bg-container" ng-app="app">
   		<div class="container" ng-controller="GoodsTopShopCtl">
	    	<!-- 面包屑导航  start -->
		    <div class="crumb">
		    	<a href="<?=YLB_Registry::get('url')?>?ctl=Goods_Top&met=index" target="_blank">排行榜首页</a>
		    	&nbsp;>&nbsp;
		    	<span ng-bind="current_cat_name"></span>
		    </div>
		    <!-- 面包屑导航  end -->

		    <!-- main   -->
		    <div class="main">
		    	<div class="titl">
		    		<h1 ng-bind="current_cat_name"></h1>
		    	</div>

		    	<div class="part-tab-content">
                    <ul class="part-tab-list orflow">
                        <li class="shadow lf" ng-repeat="item in shopSaleGoodsList">
                                    <a href="#">
                                        <div class="ratings-result flag-1">
                                            <div class="flag-left">
                                                <i>{{$index+1}}</i>
                                            </div>
                                            <div class="flag-dec">{{item.salenums}}人在逛</div>
                                        </div>
                                        <div class="top-wrap">
                                            <div class="brand">
                                                <img ng-src="{{item.shop_logo}}" ng-click="shopPage(item.shop_id)" alt="">
                                            </div>
                                            <div class="brand-shop text1">
                                                <a href="javascript:;" ng-click="shopPage(item.shop_id)" ng-bind="item.shop_name">
                                                    <i class="icon"></i>
                                                </a>
                                            </div>
                                            <div class="sign" style="position: absolute;top: 47px;left: 260px;">
                                                <span class="sign1" ng-show="{{item.shop_self_support}}">自营</span>
                                                <span class="sign1" ng-hide="{{item.shop_self_support}}">第三方</span>
                                            </div>
                                        </div>

                                        <ul class="bottom-wrap orflow">
                                            <li class="lf li-portrait" ng-repeat="good in item.goods_list">
                                                <a href="javascript:;" ng-click="goodsInfo(good.common_id,'cid')">
                                                    <div class="img-show">
                                                        <img ng-src="{{good.common_image}}" alt="">
                                                        <p class="price" ng-bind="good.common_price | currency:'￥'"></p>
                                                    </div>
                                                    <div class="img-else">
                                                        <div class="text-description">
                                                            <p class="text1" ng-bind="good.common_name"></p>
                                                        </div>
                                                        <div class="share-wrap orflow">
                                                            <div class="share-sub" style="display: inline-block;">
                                                                <span class="share-text">分享立减</span>
                                                                <span class="price" ng-bind="good.common_share_price | currency:'￥'"></span>
                                                            </div>
                                                        </div>
                                                        <div class="share-wrap orflow">
                                                             <div class="share-sub" style="display: inline-block;">
                                                                <span class="share-text">立赚</span>
                                                                <span class="price" ng-bind="good.common_promotion_price | currency:'￥'"></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </li>
                                        </ul>
                                    </a>
                                </li>
                    </ul>
                </div>
            </div>
		    <!-- main   end-->
    	</div>
   </div>

       <script>

        var app = angular.module('app',[]);
        app.config(['$locationProvider', function ($locationProvider) {
            $locationProvider.html5Mode({
                enabled: true,
                requireBase: false//必须配置为false，否则<base href=''>这种格式带base链接的地址才能解析
            });
        }]);

        app.controller('GoodsTopShopCtl',function($scope,$http,$location){
            $scope.current_cat_id = $location.search().cat_id;
            $scope.current_cat_name = $location.search().cat_name;

            /**
            * 获取子分类
            * @param cat_id
            */
            $scope.getSubCat = function()
            {
                var url = "<?=YLB_Registry::get('url')?>/index.php?ctl=Goods_Top&met=getChildCat&typ=json&cat_parent_id="+$scope.current_cat_id;
                $http({
                    method:'GET',
                    url:url,
                }).then(
                    function successCallback(res){
                        $scope.subCatList = res.data.data.items;
                        $scope.subCatIds = res.data.data.subCatIds;
                        getShopSaleGoods($scope.subCatIds,page = 1,pageSize = 100);
                    },function errorCallback(msg){

                    }
                );
            };

            /**
            * 获取热销店铺即商品
            */
            getShopSaleGoods = function(cat_ids,page=1,pageSize=12)
            {
                var url = "<?=YLB_Registry::get('url')?>/index.php?ctl=Goods_Top&met=getShopSaleGoods&typ=json&cat_ids=("+cat_ids+")&page="+page+"&pageSize="+pageSize;
                $http({
                    method:'GET',
                    url:url,
                }).then(
                    function successCallback(res){
                        $scope.shopSaleGoodsList = res.data.data.list_all;
                        console.log($scope.shopSaleGoodsList);
                    },
                    function errorCallback(msg){

                    }
                )
            };

            $scope.getSubCat();


            $scope.goodsInfo = function(id,type='cid')
            {
                if(type == 'cid'){
                    window.open(SITE_URL + "?ctl=Goods_Goods&met=goods&type=goods&cid="+id);
                }
                if(type == 'gid'){
                    window.open(SITE_URL + "?ctl=Goods_Goods&met=goods&type=goods&cid="+id);
                }
            }

            $scope.shopPage = function(id)
            {
                  window.open(SITE_URL + "?ctl=Shop&met=index&typ=e&id="+id);
            }

        })
    </script>

</body>
<!-- 尾部 -->
<?php
include $this->view->getTplPath() . '/' . 'footer.php';
?>