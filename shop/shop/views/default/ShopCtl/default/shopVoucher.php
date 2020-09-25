<?php if (!defined('ROOT_PATH'))
{
    exit('No Permission');
} ?>
<?php
if($shop_base['shop_type'] == 2)
{
    include $this->view->getTplPath() . '/' .'supplier_header.php';
}
else
{
    include $this->view->getTplPath() . '/' .'header.php';
}
?>
<link rel="stylesheet" type="text/css" href="<?= $this->view->css ?>/personalstores.css">
<link rel="stylesheet" type="text/css" href="<?= $this->view->css ?>/Group-integral.css" />
<link rel="stylesheet" type="text/css" href="<?= $this->view->css ?>/shop-voucher.css" />

<style>

    .define_detail{text-align:left;padding:15px;}
    .wrap{width: 100% !important; margin: 0 auto;}
    .bbc-nav ul{width: 1200px !important;margin: 0 auto;}
    .head_cont{ width: 1200px !important;margin: 0 auto;}
    .ncsl-nav-banner{overflow: hidden;}
    .store-decoration-block-1{width: 100% !important; overflow: hidden; text-align: center;}
    .t_goods_bot{width: 1200px;margin: 0 auto;}
</style>
<div style="width:1200px;position: relative;margin: 0 auto;">
    <div class="bbc-store-info">
        <div class="basic">
            <div class="displayed">
                <a href=""><?=$shop_base['shop_name']?></a>
                <span class="all-rate">
                <div class="rating">
                    <span style="width: <?=$shop_scores_percentage?>%"></span>
                </div>
               <em><?=$shop_scores_count?></em><em>分</em>
            </span>
            </div>
            <div class="sub">
                <div class="store-logo">
                    <img src="<?=$shop_base['shop_logo']?>" alt="<?=$shop_base['shop_name']?>" title="<?=$shop_base['shop_name']?>">
                </div>
                <!--店铺基本信息 S-->
                <div class="bbc-info_reset">
                    <div class="title">
                        <h4><?=$shop_base['shop_name']?></h4>
                    </div>
                    <div class="content_reset">
                        <div class="bbc-detail-rate">
                            <ul>
                                <li>
                                    <h5>描述</h5>
                                    <div class="low" ><?=$shop_detail['shop_desc_scores']?><i></i></div>
                                </li>
                                <li>
                                    <h5>服务</h5>
                                    <div class="low" ><?=$shop_detail['shop_service_scores']?><i></i></div>
                                </li>
                                <li>
                                    <h5>物流</h5>
                                    <div class="low" ><?=$shop_detail['shop_send_scores']?><i></i></div>
                                </li>
                            </ul>
                        </div>
                        <div class="btns">
                            <a href="index.php?ctl=Shop&met=goodsList&id=<?=$shop_id?>" class="goto">进店逛逛</a>
                            <a href="javascript:;" onclick="collectShop(<?=$shop_id?>)">收藏店铺</a>
                        </div>
                        <?php if(!empty($shop_all_base)){?>
                            <dl class="no-border">
                                <dt>公司名称：</dt>
                                <dd><?=$shop_all_base['shop_company_name']?></dd>
                            </dl>
                            <dl>
                                <dt>电　　话：</dt>
                                <dd><?=$shop_all_base['company_phone']?></dd>
                            </dl>
                            <dl>
                                <dt>所&nbsp;&nbsp;在&nbsp;&nbsp;地：</dt>
                                <dd><?=$shop_all_base['shop_company_address']?></dd>
                            </dl>
                        <?php }?>
                        <dl class="messenger">
                            <dt>联系方式：</dt>
                            <dd><span member_id="9"></span><a href="javascript:;" class="chat-enter" style="margin: 0" rel="<?=$shop_detail['user_id']?>"><img src="<?=$this->view->img?>/icon-im.gif" alt=""></a>
                            </dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="wrap clearfix">
    <div class="clearfix">
        <div class="div_shop_Carouselfigure1" style="overflow: hidden;">
            <?php if(!empty($shop_base['shop_banner'])){ ?>
                <img src="<?=$shop_base['shop_banner']?>" "/></a>
            <?php }else{ ?>
                <img src="<?= $this->view->img ?>/shop_img.png" /></a>
            <?php } ?>
        </div>
    </div>
    <div id="nav" class="bbc-nav">
        <ul>
            <li class="active9"><a href="index.php?ctl=Shop&met=index&id=<?=$shop_id?>"><span>店铺首页<i></i></span></a></li>
            <?php if($shop_nav['items']){ foreach ($shop_nav['items'] as $key => $value) {?>
            <li><a href="<?php if(!empty($value['url'])) echo $value['url'];else echo 'index.php?ctl=Shop&met=info&id='.$shop_id.'&nav_id='.$value['id']; ?>" <?php if($value['target']){?>target="_blank" <?php } ?>><span><?=$value['title']?><i></i></span></a></li>
            <?php }} ?>
        </ul>
    </div>
    <div class="clearfix">
        <div class="wrap">
            <div class="voucher-wrap">
                <div class="voucher-wrap-inner">
                    <div class="voucher-bg"></div>
                    <!-- 此处  voucher-text  为   抢到  代金券  div      用congratulate 类控制-->
                        <div class="voucher-text congratulate">
                            <div class="voucher-text1">恭喜您,抢到50元代金券</div>
                            <p class="voucher-text2">代金券将于5-15分钟后,发送到您的账户里,请注意查收~</p>
                            <p class="voucher-text2">
                                <span>3</span>秒后为您自动跳转...
                            </p>
                        </div>
                    <!-- 此处  voucher-text  为   已抢过  代金券  div       用Have-snatched 类控制-->
                        <!-- <div class="voucher-text have-snatched">
                            <div class="voucher-text1">您今天已参加过此活动,别太贪心呦,明天再来~</div>
                            
                            <p class="voucher-text2">
                                <span>3</span>秒后为您自动跳转...
                            </p>
                        </div> -->
                        <div class="btns">
                            <a href="#">返回活动页面</a>
                            <a href="#">关闭页面</a>
                        </div>
                    </div>
                    <div class="voucher-explain">
                        <p>说明：快抢代金券有一定的随机比例，可能存在抢不到的情况。</p>
                        <span>常见问题</span>
                        <div class="explain-text"><a href="#">1、优惠券的使用规则？</a></div>
                        <div class="explain-text"><a href="#">2、在哪里查询优惠券？</a></div>
                        <div class="explain-text"><a href="#">3、如何使用优惠券？</a></div>

                    </div>
                </div>
            <div class="shop-sells-hot">
                <div class="shop-sells-hot-title">本店热卖</div>
                <!-- 满减送 start -->
             <div class="shop-sells-hot-part">
                 <div class="full-delivery-content">
                     <ul class="orflow li-5-list">
                        <li class="lf li-5-item">
                           <div class="item-top">
                                <div class="img-center">
                                    <a href="#">
                                       <img src="http://taos168.com/shop/image.php/media/ba58602ff036cd67715a76ceb9e232ff/10077/26/image/20170705/1499225124937232.jpg!232x232.jpg" alt="">
                                   </a>
                                </div>
                           </div>
                           <div class="item-bottom">
                               <div class="goods-detail text2">
                                    <a href="#">fwu抚慰防护恢复鄂温克发挥和uwhfuefheufhue 饭盒uqh发去 发乎情发货夫妇忽前忽后赴俄气</a>
                               </div>
                               <div class="sales-promotion-wrap">
                                   促销: <span class="sales-key">满</span>
                               </div>
                               <div class="share-wrap clearfix">
                                    <div class="share lf">
                                        <span>分享立减</span>
                                        <span class="save">￥22.0</span>
                                    </div>
                                    <div class="share rt">
                                        <span>立赚</span>
                                        <span class="save">￥546.00</span>
                                    </div>
                                </div>
                                <div class="price-wrap">
                                    <span class="new-price">￥<em>418651.00</em></span>
                                    <span class="old-price">￥119000.00</span>
                                </div>
                                <div class="say-good-wrap orflow">
                                    <div class="say-good lf">
                                        <a href="#"><i class="icon"></i></a>
                                        1025人都说好
                                    </div>
                                    <div class="rt monthly-sales-wrap">
                                        月销量<span class="monthly-sales">41548</span>
                                    </div>
                                </div>
                           </div>
                        </li>
                        <li class="lf li-5-item">
                           <div class="item-top">
                                <div class="img-center">
                                    <a href="#">
                                       <img src="http://taos168.com/shop/image.php/media/ba58602ff036cd67715a76ceb9e232ff/10077/26/image/20170705/1499225124937232.jpg!232x232.jpg" alt="">
                                   </a>
                                </div>
                           </div>
                           <div class="item-bottom">
                               <div class="goods-detail text2">
                                    <a href="#">fwu抚慰防护恢复鄂温克发挥和uwhfuefheufhue 饭盒uqh发去 发乎情发货夫妇忽前忽后赴俄气</a>
                               </div>
                               <div class="sales-promotion-wrap">
                                   促销: <span class="sales-key">满</span>
                               </div>
                               <div class="share-wrap clearfix">
                                    <div class="share lf">
                                        <span>分享立减</span>
                                        <span class="save">￥22.0</span>
                                    </div>
                                    <div class="share rt">
                                        <span>立赚</span>
                                        <span class="save">￥546.00</span>
                                    </div>
                                </div>
                                <div class="price-wrap">
                                    <span class="new-price">￥<em>418651.00</em></span>
                                    <span class="old-price">￥119000.00</span>
                                </div>
                                <div class="say-good-wrap orflow">
                                    <div class="say-good lf">
                                        <a href="#"><i class="icon"></i></a>
                                        1025人都说好
                                    </div>
                                    <div class="rt monthly-sales-wrap">
                                        月销量<span class="monthly-sales">41548</span>
                                    </div>
                                </div>
                           </div>
                        </li>
                        <li class="lf li-5-item">
                           <div class="item-top">
                                <div class="img-center">
                                    <a href="#">
                                       <img src="http://taos168.com/shop/image.php/media/ba58602ff036cd67715a76ceb9e232ff/10077/26/image/20170705/1499225124937232.jpg!232x232.jpg" alt="">
                                   </a>
                                </div>
                           </div>
                           <div class="item-bottom">
                               <div class="goods-detail text2">
                                    <a href="#">fwu抚慰防护恢复鄂温克发挥和uwhfuefheufhue 饭盒uqh发去 发乎情发货夫妇忽前忽后赴俄气</a>
                               </div>
                               <div class="sales-promotion-wrap">
                                   促销: <span class="sales-key">满</span>
                               </div>
                               <div class="share-wrap clearfix">
                                    <div class="share lf">
                                        <span>分享立减</span>
                                        <span class="save">￥22.0</span>
                                    </div>
                                    <div class="share rt">
                                        <span>立赚</span>
                                        <span class="save">￥546.00</span>
                                    </div>
                                </div>
                                <div class="price-wrap">
                                    <span class="new-price">￥<em>418651.00</em></span>
                                    <span class="old-price">￥119000.00</span>
                                </div>
                                <div class="say-good-wrap orflow">
                                    <div class="say-good lf">
                                        <a href="#"><i class="icon"></i></a>
                                        1025人都说好
                                    </div>
                                    <div class="rt monthly-sales-wrap">
                                        月销量<span class="monthly-sales">41548</span>
                                    </div>
                                </div>
                           </div>
                        </li>
                        <li class="lf li-5-item">
                           <div class="item-top">
                                <div class="img-center">
                                    <a href="#">
                                       <img src="http://taos168.com/shop/image.php/media/ba58602ff036cd67715a76ceb9e232ff/10077/26/image/20170705/1499225124937232.jpg!232x232.jpg" alt="">
                                   </a>
                                </div>
                           </div>
                           <div class="item-bottom">
                               <div class="goods-detail text2">
                                    <a href="#">fwu抚慰防护恢复鄂温克发挥和uwhfuefheufhue 饭盒uqh发去 发乎情发货夫妇忽前忽后赴俄气</a>
                               </div>
                               <div class="sales-promotion-wrap">
                                   促销: <span class="sales-key">满</span>
                               </div>
                               <div class="share-wrap clearfix">
                                    <div class="share lf">
                                        <span>分享立减</span>
                                        <span class="save">￥22.0</span>
                                    </div>
                                    <div class="share rt">
                                        <span>立赚</span>
                                        <span class="save">￥546.00</span>
                                    </div>
                                </div>
                                <div class="price-wrap">
                                    <span class="new-price">￥<em>418651.00</em></span>
                                    <span class="old-price">￥119000.00</span>
                                </div>
                                <div class="say-good-wrap orflow">
                                    <div class="say-good lf">
                                        <a href="#"><i class="icon"></i></a>
                                        1025人都说好
                                    </div>
                                    <div class="rt monthly-sales-wrap">
                                        月销量<span class="monthly-sales">41548</span>
                                    </div>
                                </div>
                           </div>
                        </li>
                         <li class="lf li-5-item">
                           <div class="item-top">
                                <div class="img-center">
                                    <a href="#">
                                       <img src="http://taos168.com/shop/image.php/media/ba58602ff036cd67715a76ceb9e232ff/10077/26/image/20170705/1499225124937232.jpg!232x232.jpg" alt="">
                                   </a>
                                </div>
                           </div>
                           <div class="item-bottom">
                               <div class="goods-detail text2">
                                    <a href="#">fwu抚慰防护恢复鄂温克发挥和uwhfuefheufhue 饭盒uqh发去 发乎情发货夫妇忽前忽后赴俄气</a>
                               </div>
                               <div class="sales-promotion-wrap">
                                   促销: <span class="sales-key">满</span>
                               </div>
                               <div class="share-wrap clearfix">
                                    <div class="share lf">
                                        <span>分享立减</span>
                                        <span class="save">￥22.0</span>
                                    </div>
                                    <div class="share rt">
                                        <span>立赚</span>
                                        <span class="save">￥546.00</span>
                                    </div>
                                </div>
                                <div class="price-wrap">
                                    <span class="new-price">￥<em>418651.00</em></span>
                                    <span class="old-price">￥119000.00</span>
                                </div>
                                <div class="say-good-wrap orflow">
                                    <div class="say-good lf">
                                        <a href="#"><i class="icon"></i></a>
                                        1025人都说好
                                    </div>
                                    <div class="rt monthly-sales-wrap">
                                        月销量<span class="monthly-sales">41548</span>
                                    </div>
                                </div>
                           </div>
                        </li>
                        <li class="lf li-5-item">
                           <div class="item-top">
                                <div class="img-center">
                                    <a href="#">
                                       <img src="http://taos168.com/shop/image.php/media/ba58602ff036cd67715a76ceb9e232ff/10077/26/image/20170705/1499225124937232.jpg!232x232.jpg" alt="">
                                   </a>
                                </div>
                           </div>
                           <div class="item-bottom">
                               <div class="goods-detail text2">
                                    <a href="#">fwu抚慰防护恢复鄂温克发挥和uwhfuefheufhue 饭盒uqh发去 发乎情发货夫妇忽前忽后赴俄气</a>
                               </div>
                               <div class="sales-promotion-wrap">
                                   促销: <span class="sales-key">满</span>
                               </div>
                               <div class="share-wrap clearfix">
                                    <div class="share lf">
                                        <span>分享立减</span>
                                        <span class="save">￥22.0</span>
                                    </div>
                                    <div class="share rt">
                                        <span>立赚</span>
                                        <span class="save">￥546.00</span>
                                    </div>
                                </div>
                                <div class="price-wrap">
                                    <span class="new-price">￥<em>418651.00</em></span>
                                    <span class="old-price">￥119000.00</span>
                                </div>
                                <div class="say-good-wrap orflow">
                                    <div class="say-good lf">
                                        <a href="#"><i class="icon"></i></a>
                                        1025人都说好
                                    </div>
                                    <div class="rt monthly-sales-wrap">
                                        月销量<span class="monthly-sales">41548</span>
                                    </div>
                                </div>
                           </div>
                        </li>
                        <li class="lf li-5-item">
                           <div class="item-top">
                                <div class="img-center">
                                    <a href="#">
                                       <img src="http://taos168.com/shop/image.php/media/ba58602ff036cd67715a76ceb9e232ff/10077/26/image/20170705/1499225124937232.jpg!232x232.jpg" alt="">
                                   </a>
                                </div>
                           </div>
                           <div class="item-bottom">
                               <div class="goods-detail text2">
                                    <a href="#">fwu抚慰防护恢复鄂温克发挥和uwhfuefheufhue 饭盒uqh发去 发乎情发货夫妇忽前忽后赴俄气</a>
                               </div>
                               <div class="sales-promotion-wrap">
                                   促销: <span class="sales-key">满</span>
                               </div>
                               <div class="share-wrap clearfix">
                                    <div class="share lf">
                                        <span>分享立减</span>
                                        <span class="save">￥22.0</span>
                                    </div>
                                    <div class="share rt">
                                        <span>立赚</span>
                                        <span class="save">￥546.00</span>
                                    </div>
                                </div>
                                <div class="price-wrap">
                                    <span class="new-price">￥<em>418651.00</em></span>
                                    <span class="old-price">￥119000.00</span>
                                </div>
                                <div class="say-good-wrap orflow">
                                    <div class="say-good lf">
                                        <a href="#"><i class="icon"></i></a>
                                        1025人都说好
                                    </div>
                                    <div class="rt monthly-sales-wrap">
                                        月销量<span class="monthly-sales">41548</span>
                                    </div>
                                </div>
                           </div>
                        </li>
                     </ul>
                 </div>
             </div>
             <!-- 满减送 end -->
            </div>
        </div>

    </div>
</div>

<?php
include $this->view->getTplPath() . '/' . 'footer.php';
?>

