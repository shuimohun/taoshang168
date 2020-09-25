<?php if (!defined('ROOT_PATH')){exit('No Permission');}?>
<?php
include $this->view->getTplPath() . '/' . 'header.php';
?>
<link rel="stylesheet"  type="text/css" href="<?= $this->view->css ?>/goods_top_sale.css">
<script type="text/javascript" src="<?= $this->view->js ?>/jquery.js"></script>
<script type="text/javascript" src="<?= $this->view->js ?>/angular.js"></script>

   <div class="bg-container" ng-app="app">
   		<div class="container" ng-controller="GoodsTopSaleCtl">
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
<!--		                        <li class="no-1-3 li-infeed shadow">
		                            <a href="#">
		                            	<div class="ratings-result flag-1">
		                            		<div class="flag-left">
		                            			<i>1</i>
		                            		</div>
		                            		<div class="flag-dec">销售指数100</div>
		                            	</div>
		                                <div class="img-show">
		                                    <img src="http://taos168.com/shop/image.php/media/ba58602ff036cd67715a76ceb9e232ff/10077/26/image/20170627/1498550880750646.jpg" alt="">
		                                </div>
		                                <div class="img-else">
		                                    <div class="text-description">
		                                        <p class="text2">Apple iPhone 6 32GB 金色移动联通电信4G手机</p>
		                                        <div class="sign">
		                                            <span class="sign1">自营</span>
		                                            <span class="sign2">赠</span>
		                                        </div>
		                                    </div>
		                                    <div class="share-wrap orflow">
		                                    	<div class="share-sub lf">
		                                    		<span class="share-text">分享立减</span>
		                                    		<span class="price">￥5.00</span>
		                                    	</div>
		                                    	<div class="share-sub rt">
		                                    		<span class="share-text">立赚</span>
		                                    		<span class="price">￥5.00</span>
		                                    	</div>
		                                    </div>
		                                    <div class="price-wrap">
		                                        <div class="grating-wrap orflow">
		                                            <div class="gratingRate lf">
		                                                好评率<span>95%</span>
		                                            </div>
		                                            <div class="gratingNum rt">
		                                                好评数 <span>8.4万+</span>条
		                                            </div>
		                                        </div>
		                                        <div class="price">
		                                            ￥<span  style="color:#c51e1e">2573.00</span>
		                                        </div>
		                                    </div>
		                                </div>
		                            </a>
		                        </li>-->
                                <li class="no-3-after li-portrait shadow" ng-repeat="item in goodsSaleList">
                                <a href="#">
                                    <div class="ratings-result">
                                        <div class="flag-left">
                                            <i ng-bind="$index+indexJump"></i>
                                        </div>
                                    </div>
                                    <div class="img-show">
                                        <img ng-src="{{item.common_image}}" ng-click="goodsInfo(item.common_id)" alt="">
                                        <div class="grating-wrap orflow">
                                            <div class="gratingRate lf" style="margin-left:15px">
                                                好评<span ng-bind="item.common_evaluate"></span>
                                            </div>
                                            <div class="gratingNum rt" style="margin-right:15px">
                                                收藏 <span ng-bind="item.common_collect"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="img-else">
                                        <div class="text-description">
                                            <p class="text1" ng-bind="item.common_name" ng-click="goodsInfo(item.common_id)"></p>
                                        </div>
                                        <div class="share-wrap orflow">
                                            <div class="share-sub lf">
                                                <span class="share-text">分享立减</span>
                                                <span class="price" ng-bind="item.common_share_price | currency:'￥'"></span>
                                            </div>
                                            <div class="share-sub rt">
                                                <span class="share-text">立赚</span>
                                                <span class="price" ng-bind="item.common_promotion_price | currency:'￥'"></span>
                                            </div>
                                        </div>
                                        <div class="price-wrap orflow">
                                            <div class="price lf">
                                                ￥<span  style="color:#c51e1e" ng-bind="item.common_price"></span>
                                            </div>
                                            <div class="rt">销量：<span ng-bind="item.common_salenum"></span></div>
                                        </div>
                                    </div>
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

        app.controller('GoodsTopSaleCtl',function($scope,$http,$location){
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
                        $scope.getGoodsSaleByIds($scope.subCatIds,page=1,pageSize=100);
                    },function errorCallback(msg){

                    }
                );
            };

            /**
            * 根据大分类查找数据
            * @param page
            * @param pageSize
            */
            $scope.getGoodsSaleByIds = function(cat_ids,page=1,pageSize=100,indexJump = 1)
            {
                $scope.subCatIds = cat_ids;
                $scope.indexJump = indexJump;
                var url = "<?=YLB_Registry::get('url')?>/index.php?ctl=Goods_Top&met=goodsSale&typ=json&cat_ids=("+cat_ids+")"+"&page="+page+"&pageSize="+pageSize;
                $http({
                    method:'GET',
                    url:url,
                }).then(
                    function successCallback(res){
                        $scope.goodsSaleList = res.data.data;
                    },
                    function errorCallback(msg){

                    }
                );
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
        })
    </script>

</body>
<!-- 尾部 -->
<?php
include $this->view->getTplPath() . '/' . 'footer.php';
?>


