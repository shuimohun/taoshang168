
var app = angular.module('app',[]);
app.controller('shopGoodsListCtl',function($scope,$http){

    var urlStr = String(window.location);
    var baseUrl = urlStr.split('?')[0];
    $scope.shop_id = parseInt(urlStr.split('?')[1].split('&')[2].split('=')[1]);

    /**
     * 获取一级分类
     */
    getNavCat = function(){
        $http({
            method:'GET',
            url:baseUrl + "?ctl=Shop&met=getCatByShopId&parent_id=0&shop_id="+$scope.shop_id+"&typ=json"
        }).then(function successCallback(data){
            $scope.navCatList = data.data.data;
        },function errorCallback(msg){
        })
    };
    getNavCat();

    /**
     *   获取子分类
     */
    $scope.getSecondCat = function(cat_id){
        $http({
            method:'GET',
            url:baseUrl + "?ctl=Shop&met=getCatByShopId&parent_id="+cat_id+"&shop_id="+$scope.shop_id+"&typ=json"
        }).then(function successCallback(res){
            $scope.secondCat = res.data.data;
        },function errorCallback(msg){
        })
    };

    $scope.getCatName = function(level,cat_name,cat_id){
        if(level == 1){
            $scope.catOne = '--'+cat_name;
            $scope.catSecond = '';
        }else if(level == 2){
            $scope.catSecond = '--'+cat_name;
        }

        window.open(baseUrl + "?ctl=Shop&met=goodsList&id="+$scope.shop_id+"&shop_cat_id="+cat_id,'_self');
    }
})
