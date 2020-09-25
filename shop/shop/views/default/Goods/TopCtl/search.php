<?php if (!defined('ROOT_PATH')){exit('No Permission');}?>
<?php
include $this->view->getTplPath() . '/' . 'header.php';
?>
<link rel="stylesheet"  type="text/css" href="<?= $this->view->css ?>/goods_top_search.css">
<script type="text/javascript" src="<?= $this->view->js ?>/jquery.js"></script>
<script type="text/javascript" src="<?= $this->view->js ?>/angular.js"></script>
   <div class="bg-container" ng-app="app">
   		<div class="container" ng-controller="GoodsTopSearchCtl">
	    	<!-- 面包屑导航  start -->
		    <div class="crumb">
		    	<a href="<?=YLB_Registry::get('url')?>?ctl=Goods_Top&met=index" target="_blank">排行榜首页</a>
		    </div>
		    <!-- 面包屑导航  end -->

		    <!-- main   -->
		    <div class="main">
		    	<div class="part-tab-content ">
                    <ul class="part-tab-list  ">
                        <li class="shadow" ng-repeat="item in searchWorldList">
                            <a href="#">
                            	<div class="search-type lf search-1">
                            		<div class="ratings-result flag-1">
	                            		<div class="flag-left">
	                            			<i>{{$index+1}}</i>
	                            		</div>
	                            	</div>
			                		<div class="search-type-img-robot">
                                                <p class="search-th text1" ng-bind="item.search_keyword"></p>
                                            </div>
                                            <p class="search-pepole text1">{{item.search_nums}}人在搜</p>
			                	</div>
	                            <ul class="img-show-wrap lf">
	                            	<li class="img-show-sub lf" ng-repeat="good in item.goods_list">
	                            		<div class="img-show">
                                            <a href="javascript:;"><img ng-src="{{good.common_image}}" ng-click="goodsInfo(good.common_id,'cid')" alt=""></a>
		                                </div>
		                                <div class="img-else">
		                                	<div class="share-wrap orflow">
	                                            <div class="share-sub lf">
	                                                <span class="share-text" style="color:#c51e1e">分享立减</span>
	                                                <span class="price" ng-bind="good.common_share_price | currency:'￥'"></span>
	                                            </div>
	                                            <div class="share-sub rt">
	                                                <span class="share-text" style="color:#c51e1e">立赚</span>
	                                                <span class="price" ng-bind="good.common_promotion_price | currency:'￥'"></span>
	                                            </div>
	                                        </div>
		                                    <div class="text-description">
		                                        <a href="javascript:;" ng-click="goodsInfo(good.common_id,'cid')"><p class="text1" ng-bind="good.common_name"></p></a>
		                                    </div>
		                                    <div class="price" ng-bind="good.common_price | currency:'￥'" ng-click="goodsInfo(good.common_id,'cit')"></div>
	                                	</div>
	                            	</li>
	                            </ul>
	                            <a href="<?=YLB_Registry::get('url')?>?ctl=Goods_Goods&met=goodslist&typ=e&keywords={{item.search_keyword}}" target="_blank"><div class="look-more rt">查看更多</div></a>
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

        app.controller('GoodsTopSearchCtl',function($scope,$http,$location){
            getSearchWrold = function()
            {
                var url = "<?=YLB_Registry::get('url')?>?ctl=Goods_Top&met=getSearchWordAll&typ=json";
                $http({
                    method:'GET',
                    url:url,
                }).then(
                    function successCallback(res){
                        $scope.searchWorldList = res.data.data;
                    },
                    function errorCallback(msg){

                    }
                )
            };
            getSearchWrold();

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