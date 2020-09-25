<?php
if(!defined('ROOT_PATH')){
    exit('No Permission');
}

include $this->view->getTplPath() . '/' . 'header.php';
?>

<link href="<?=$this->view->css?>/index.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="<?=$this->view->css_com?>/jquery/plugins/validator/jquery.validator.css">
<script type="text/javascript" src="<?=$this->view->js_com?>/plugins/validator/jquery.validator.js" charset="utf-8"></script>

<script type="text/javascript" src="<?=$this->view->js_com?>/plugins/validator/local/zh_CN.js" charset="utf-8"></script>
<style>
    .ui-jqgrid tr.jqgrow .img_flied{padding: 1px; line-height: 0px;}
    .img_flied img{width: 60px; height: 60px;}
    .ul-inline li {
        float: left;
        margin-right: 0px;
        margin-bottom: 8px;
    }
</style>
</head>
<body>

<div class="wrapper page">

    <!--标题 start-->
    <div class="fixed-bar">
        <div class="item-title">
            <div class="subject">
                <h3>添加商品</h3>
                <h5>猜你喜欢商品添加</h5>
            </div>
        </div>
    </div>
    <!--标题 end-->

    <!--搜索 start-->
    <div class="mod-search cf" id="report-search" ng-app="app">

        <div class="l" id="filter-menu" ng-controller="myCtl">
            <ul class="ul-inline fix">
                <li>
                    <label ng-class="{error: error.province}" >
                        <select class="ui-tree-wrap" ng-model="selected" ng-options="s.cat_name for s in cat_list" ng-change="c(selected.cat_id)" >
                            <option value="" style="text-align:center">选择商品分类</option>
                        </select>
                    </label>
                </li>

                <li>
                    <label ng-show="cat_list_two.length" ng-class="{error: error.city}">
                        <select class="ui-tree-wrap" ng-model="selected2" ng-options="sh.cat_name for sh in cat_list_two" ng-change="c2(selected2.cat_id)" >
                            <option value="">选择商品分类</option>
                        </select>
                    </label>
                </li>

                <li>
                    <label ng-show="cat_list_three.length" ng-class="{error: error.area}">
                        <select class="ui-tree-wrap" ng-model="selected3" ng-options="x.cat_name for x in cat_list_three" ng-change="c3(selected3.cat_id)" >
                            <option value="">选择商品分类</option>
                        </select>
                    </label>
                </li>
                <li>
                    <label ng-show="cat_list_four.length" ng-class="{error: error.cun}">
                        <select class="ui-tree-wrap" ng-model="selected4" ng-options="i.cat_name for i in cat_list_four" ng-change="c4(selected4.cat_id)" >
                            <option value="">选择商品分类</option>
                        </select>
                    </label>
                </li>

                <li>
                    <input type="text" id="common_name" name="common_name" class="ui-input ui-input-ph" placeholder="输入商品名称搜索" autocomplete="off">
                </li>

                <li>
                    <input type="hidden" id="cat_id" name="cat_id" value="{{cat_id}}">
                </li>

                <li>
                    <a class="ui-btn" id="search" style="left: 10px;
    position: relative;">搜索 <i class="iconfont icon-btn02"></i></a>
                </li>

            </ul>
        </div>

    </div>
    <!--搜索 end-->

    <!--商品列表 start-->
    <div class="cf">
        <div class="grid-wrap">
            <table id="grid">
            </table>
            <div id="page"></div>
        </div>
    </div>
    <!--商品列表 end-->

</div>
<script src="<?=$this->view->js?>/controllers/goods/common_like_manage.js"></script>
<script src="<?=$this->view->js?>/controllers/angular.js"></script>
<script>
    var app = angular.module('app',[]);
    var url = SITE_URL + '?ctl=Goods_Likes&met=cat&typ=json';
    app.controller('myCtl',function($scope,$http){
        loadCats = function(pid = 0){
            $http.get(url,{pid:pid}).then(function (result) {  //正确请求成功时处理
                $scope.cat_list = result.data.data;
            }).catch(function (result) { //捕捉错误处理
                alert(result.data.Message);
            });
        };
        loadCats();

        $scope.c = function (cat_id) {
            var pid = cat_id;
            $scope.cat_id = cat_id;
            loadCatsTwo = function(pid){
                $http({
                    method:'GET',
                    url:url,
                    params:{'pid':pid},
                }).then(function successCallback(result) {
                    $scope.cat_list_two = result.data.data;
                }, function errorCallback(result) {
                    alert(result.data.Message);
                });
            }
            loadCatsTwo(pid);

            $scope.error.province = false;
            $scope.error.city = false;
            $scope.error.area = false;
            $scope.error.cun = false;
            $scope.selected2 = "";
            $scope.selected3 = "";
            $scope.selected4 = "";
        };

        $scope.c2 = function (cat_id) {
            var pid = cat_id;
            $scope.cat_id = cat_id;
            loadCatsThree = function(pid){
                $http({
                    method:'GET',
                    url:url,
                    params:{'pid':pid},
                }).then(function successCallback(result) {
                    $scope.cat_list_three = result.data.data;
                }, function errorCallback(result) {
                    alert(result.data.Message);
                });
            }
            loadCatsThree(pid);
            $scope.error.city = false;
            $scope.error.area = false;
            $scope.error.cun = false;
            $scope.selected3 = "";
            $scope.selected4 = "";
        };

        $scope.c3 = function (cat_id) {
            var pid = cat_id;
            $scope.cat_id = cat_id;
            loadCatsFour = function(pid) {
                $http({
                    method: 'GET',
                    url: url,
                    params: {'pid': pid},
                }).then(function successCallback(result) {
                    $scope.cat_list_four = result.data.data;
                }, function errorCallback(result) {
                    alert(result.data.Message);
                });
            }
            loadCatsFour(pid);
            $scope.error.area = false;
            $scope.error.cun = false;
            $scope.selected4 = "";
        };
        $scope.c4 = function (cat_id) {
            $scope.cat_id = cat_id;
            $scope.error.cun = false;
        };

        $scope.submit = function () {
            $scope.error.province = $scope.selected ? false : true;
            $scope.error.city = $scope.selected2 ? false : true;
            $scope.error.area = $scope.selected3 ? false : true;
            $scope.error.cun = $scope.selected4 ? false : true;
        };

    })
</script>

<?php include $this->view->getTplPath() . '/' . 'footer.php';?>




























