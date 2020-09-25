<?php if (!defined('ROOT_PATH')){exit('No Permission');}?>
<?php
include $this->view->getTplPath() . '/' . 'header.php';
?>
<style>
    body{
        position: relative;
    }
    #list{
        position: absolute;
        top:25%;
        left:-15%;
    }
    .activeDis{
        color:#c51e1e;
        font-weight: bold;
    }
    .wrap_discount{display: none;}
    .t_ban{ width100%; height:400px; overflow:hidden; position:relative;}

</style>
<script type="text/javascript" src="<?=$this->view->js?>/common.js"></script>
<link rel="stylesheet" type="text/css" href="<?=$this->view->css?>/taoshang168.css" />
<script type="text/javascript" src="<?=$this->view->js?>/goods.js"></script>
<script type="text/javascript" src="<?=$this->view->js?>/taoshang168.js"></script>
<script type="text/javascript" src="<?=$this->view->js_com?>/plugins/jquery.toastr.min.js" charset="utf-8"></script>
<script src="<?=$this->view->js?>/angular.js"></script>
<script src="<?=$this->view->js?>/angular-sanitize.js"></script>
    <div class="t_ban">
        <div class="tg_center discount-buy-banner" id="slides">
            <div class="banner bd">
                <ul class="items">
                    <?php if(Web_ConfigModel::value('subsite_is_open') && isset($_COOKIE['sub_site_id']) && $_COOKIE['sub_site_id'] > 0){$scarebuy_subsite_id = '_'.$_COOKIE['sub_site_id'];}else{$scarebuy_subsite_id = '';} ?>
                    <?php if(Web_ConfigModel::value('discountSlider1_image')){ ?>
                        <li>
                            <a href="<?=Web_ConfigModel::value('dis_live_link1')?>">
                                <img src="<?=image_thumb(Web_ConfigModel::value('discountSlider1_image'),1920,400)?>"/>
                            </a>
                        </li>
                    <?php } ?>
                    <?php if(Web_ConfigModel::value('discountSlider2_image')){ ?>
                        <li>
                            <a href="<?=Web_ConfigModel::value('dis_live_link2')?>">
                                <img src="<?=image_thumb(Web_ConfigModel::value('discountSlider2_image'),1920,400)?>"/>
                            </a>
                        </li>
                    <?php } ?>
                    <?php if(Web_ConfigModel::value('discountSlider3_image')){ ?>
                        <li>
                            <a href="<?=Web_ConfigModel::value('dis_live_link3')?>">
                                <img src="<?=image_thumb(Web_ConfigModel::value('discountSlider3_image'),1920,400)?>"/>
                            </a>
                        </li>
                    <?php } ?>
                    <?php if(Web_ConfigModel::value('discountSlider4_image')){ ?>
                        <li>
                            <a href="<?=Web_ConfigModel::value('dis_live_link4')?>">
                                <img src="<?=image_thumb(Web_ConfigModel::value('discountSlider4_image'),1920,400)?>"/>
                            </a>
                        </li>
                    <?php } ?>
                </ul>
            </div>
            <!-- Add Pagination -->
            <div class="hd">
                <ul>
                    <li></li><li></li><li></li><li></li>
                </ul>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        jQuery(".discount-buy-banner").slide({
            mainCell:".bd ul",
            autoPlay:true
        })
    </script>
    <div class="wrap wrap_discount" ng-app="app" ng-controller="discountBuyCtl">

        <div class="title" style="background:url(<?=$this->view->img?>/title_bg.png)">
            <img src="<?=$this->view->img?>/img_Flash.png" alt="">
            <span>限时限量</span>
            <span>疯狂抢购</span>
        </div>
        <div class='discountimg'>
            <a href="javascript:;" ng-click="goodsInfo(item.goods_id)" ng-repeat="item in salenumList">
                <img ng-src="{{item.goods_image}}">
            </a>
        </div>

        <div class='discount'>
            <ul class='discount_top' ng-init="selectDis=0">
                <a ng-click="searchByDis(0,10)"><li ng-class="{true:'activeDis',false:''}[selectDis==0]">劲爆折扣</li></a>
                <a ng-repeat="dis in [1,2,3,4,5,6,7,8,9]" ng-click="searchByDis(dis,dis+1);"><li ng-class="{true:'activeDis',false:''}[selectDis==dis]">{{dis}}折</li></a>
            </ul>
            <ul class='discount_bottom'>
                <select ng-model="sortmodel" ng-options="sortitem.name for sortitem in sortList" ng-change="orderBy(sortmodel.key,sortmodel.sort)" style="margin-left: 26px;margin-top: 10px;border:solid 0px #000;font-size:14px;color:#333">
                    <option value="" selected hidden>{{sortSelected}}</option>
                </select>
                
                <span ng-click="searchByShop(1)">
                    <img src="<?=$this->view->img?>/round.png" alt="" class='shop_button'>自营
                </span>
                <span ng-click="searchByShop(0)">
                    <img src="<?=$this->view->img?>/round.png" alt="" class='shop_button'>商家
                </span>
            </ul>
        </div>

        <ul class="seckill">
            <li ng-repeat="item in list | orderBy:orderKey:sort | filter:cat_parent_id:item.cat_parent_id ">
                <div class="seckill_img">
                    <a href="javascript:;" ng-click="goodsInfo(item.goods_id)">
                        <img ng-src="{{item.goods_image}}" alt="">
                    </a>
                    <div ng-show="{{item.soldOut}}" class='tit'><i>已售罄</i></div>
                </div>
                <div class="seckill_info">
                    <a href="javascript:;" ng-click="goodsInfo(item.goods_id)"><span>{{item.goods_name}}</span></a>
                    <p class='share_wrap'><span class='share'>分享立减<u>￥{{item.goods_share_price}}</u></span></p>
                    <p class='share_wrap' ng-hide="{{item.goods_is_promotion == 0}}"><span class='share'>分享立赚<u>￥{{item.goods_promotion_price}}</u></span></p>
                    <p class='cuxiao'>促销:</p><p class='zhekou1'>{{item.discount_rate}}折<p>
                    <p class='zhekou2'>原价:￥{{item.goods_price}}</p>
                    <p class='share_hou'>折扣价:<i style="color:#333; font-size:14px;display:inline;">￥{{item.discount_price}}</i></p>
                    <div class='progress'><img src="<?=$this->view->img?>/gradient.png" alt="" width="{{item.sales_persent}}"></div><div class='sheng'>已售<i style="color:#e45050;" >{{item.goods_salenum}}/{{item.goods_stock}}</i>件</div>
                    <img src="<?=$this->view->img?>/book_s.png" alt="" class='book_n' ng-click="collect($event,item.is_favorite,item.goods_id)" style="cursor:pointer" ng-show="{{item.is_favorite == 1}}">
                    <img src="<?=$this->view->img?>/book_n.png" alt="" class='book_n' ng-click="collect($event,item.is_favorite,item.goods_id)" style="cursor:pointer" ng-show="{{item.is_favorite == 0}}">
                    <a href="javascript:;" ng-click="goodsInfo(item.goods_id)">
                        <button style="cursor:pointer" ng-class="{1:'saleover_button',0:''}[{{item.soldOut}}]">全分享价￥{{item.share_total_price}}</button>
                    </a>
                </div>
            </li>
        </ul>

        <ul class="list">
            <img class="er" src="<?=YLB_Registry::get('base_url')?>/shop/api/qrcode.php?data=<?=urlencode(YLB_Registry::get('base_url')."/?ctl=ScareBuy&met=index")?>" />
            <li>扫描二维码</li>
            <li>手机购物更实惠</li>
            <li ng-repeat="item in catList">
                <a href="javascript:void(0);" ng-click="fnSearch(item.cat_id)">
                    {{item.goods_cat_nav_name}}
                </a>
            </li>
        </ul>

        <nav class="page page_front" ng-bind-html="page_nav | to_trusted"></nav>

    </div>
    <script>
        $(function(){
            $('.discount_bottom span .shop_button').click(function(){
                if ($(this).attr('src') == '<?=$this->view->img?>/round.png'){
                    $(this).attr('src','<?=$this->view->img?>/round_select.png');
                    $(this).parent().siblings().find('.shop_button').attr('src','<?=$this->view->img?>/round.png');
                } else if($(this).attr('src') == '<?=$this->view->img?>/round_select.png'){
                    $(this).attr('src','<?=$this->view->img?>/round.png');
                    $(this).parent().siblings().find('.shop_button').attr('src','<?=$this->view->img?>/round_select.png');
                }
            });

            $('.book_n').click(function(){
                if ( $(this).attr('src') == '<?=$this->view->img?>/book_n.png' ){
                    $(this).attr('src','<?=$this->view->img?>/book_s.png');
                } else if( $(this).attr('src') == '<?=$this->view->img?>/book_s.png' ){
                    $(this).attr('src','<?=$this->view->img?>/book_n.png');
                }
            })
        });
        $(function(){
            var w_width = $(window).width();
            var left = ((w_width - 1200) / 2) - 135;
            if(left < 0){
                left = 0;
            }
            $(".list").css("left",left);
            $(".list").fadeIn();
        });

        var app = angular.module('app',[]);

        app.filter('to_trusted', ['$sce', function($sce){
            return function(text) {
                return $sce.trustAsHtml(text);
            };
        }]);

        app.controller('discountBuyCtl',function($scope,$http,$filter){

            /**
             * 加载列表数据
             */
            $scope.firstRow = 0;
            $scope.listRows = 16;
            $scope.discount_l = 0;
            $scope.discount_r = 10;
            $scope.self_support = 3;    //3为全部 （0 商家 1 自营）
            $scope.sortSelected = '综合排序';

            var loadData = $scope.loadData = function(pageUrl){
                if(pageUrl != null){
                    var url = pageUrl;
                }else{
                    var url = "<?=YLB_Registry::get('url')?>?ctl=DiscountBuy&met=discountBuyList&typ=json&firstRow="+$scope.firstRow+"&listRows="+$scope.listRows+"&discount_l="+$scope.discount_l+"&discount_r="+$scope.discount_r+"&self_support="+$scope.self_support;
                }
                $http({
                    method:'GET',
                    url:url
                }).then(function successCallback(res){
                    $scope.list = res.data.data.items;
                    if($scope.list.length < 1){
                        Public.tips({type: 1, content: '暂无相关商品数据！'});
                    }
                    $scope.page_nav = res.data.data.page_nav;
                    $('.wrap_discount').show();
                },function errorCallback(res){

                });
            }
            loadData();

            /**
             * 加载头部数据，根据销量取7条
             */
            var loadData2 = $scope.loadData2 = function(){
                var url = "<?=YLB_Registry::get('url')?>?ctl=DiscountBuy&met=discountBuyListSalenum&typ=json&nums=7";
                $http({
                    method:'GET',
                    url:url
                }).then(function successCallback(res){
                    $scope.salenumList = res.data.data;
                },function errorCallback(msg){

                });
            }
            loadData2();

            /**
             * 加载左侧分类数据
             */
            var catList = $scope.catList = function(){
                var url = "<?=YLB_Registry::get('url')?>?ctl=DiscountBuy&met=discountCatList&typ=json";
                $http({
                    method:'GET',
                    url:url
                }).then(function seccuessCallback(res){
                    $scope.catList = res.data.data.items;
                },function errorCallback(msg){

                })
            }
            catList();

            /**
             * 分页
             */
            $('.page_front').on('click','a',function(){
                $(this).css('background-color','#e02222');
                $(this).css('color','#fff');
                var pageUrl = $(this).attr('href');
                loadData(pageUrl);
                return false;
            });

            /**
             * 排序 根据满减满送价格
             */
            $scope.sortList = [
                {key:'goods_id',name:'综合排序',sort:0},
                {key:'goods_id',name:'综合评分',sort:1},
                {key:'goods_start_time',name:'上架时间',sort:0},
                {key:'discount_price',name:'折扣从高到低',sort:1},
                {key:'discount_price',name:'折扣从低到高',sort:0},
                {key:'goods_salenum',name:'销量从高到低',sort:1},
                {key:'goods_salenum',name:'销量从低到高',sort:0},
                {key:'goods_share_price',name:'立省价格从高到低',sort:1},
                {key:'goods_share_price',name:'立省价格从低到高',sort:0}
            ];
            $scope.orderBy = function(orderKey,sort){
                $scope.orderKey = orderKey;
                $scope.sort = sort;
                loadData();
            }

            /**
             * 搜索：根据折扣
             */
            $scope.searchByDis = function(discount_l,discount_r){
                $scope.selectDis = discount_l;
                $scope.discount_l = discount_l;
                $scope.discount_r = discount_r;
                loadData();
            };

            /**
             * 搜索：根据 店铺 或自营 YLB_shop_base 的 self_suppopt字段
             */
            $scope.searchByShop = function(self,sort){
                $scope.self_support = self;
                loadData();
            };

            /**
            * 搜索：根据分类
            */
            $scope.fnSearch = function(cat_id){
                $scope.cat_parent_id = cat_id;
                loadData();
            };

            /**
             * 收藏商品
             * @param $event
             * @param is_favorite
             * @param goods_id
             */
            $scope.collect = function($event,is_favorite,goods_id){
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
            };

            $scope.goodsInfo = function(gid){
                window.open("<?=YLB_Registry::get('url')?>?ctl=Goods_Goods&met=goods&gid="+gid,'_blank');
            }
        })
    </script>
<?php
include $this->view->getTplPath() . '/' . 'footer.php';
?>





























