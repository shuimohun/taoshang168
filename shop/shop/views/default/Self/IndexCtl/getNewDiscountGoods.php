
<div class="all-day orflow" style="margin-top: 10px;">
    <div class="all-day-title orflow">
        <div class="today-activity lf half-day curr">
            <div class="center-wrap lf">
                今日上新 <a href="<?=YLB_Registry::get('url')?>?ctl=Self_Goods&met=act" class="rt" target="_blank">进入精选</a>
            </div>
        </div>
        <div id="night" class="today-activity lf half-day">
            <div class="center-wrap lf">
                限时秒 <a href="<?=YLB_Registry::get('url')?>?ctl=DiscountBuy&met=index" class="rt">进入秒</a>
            </div>
        </div>
    </div>
    <div class="all-day-content">
        <div class="all-day-content-item-wrap curr">
            <div class="goods-slide">
                <div class="bd">
                <ul>
                    <?php if($new_goods){foreach ($new_goods['items'] as $key=>$value){?>
                        <li class="swiper-slide">
                            <div class="all-day-content-item">
                                <div class="img-center">
                                    <a href="<?=YLB_Registry::get('url')?>?ctl=Goods_Goods&met=goods&gid=<?=$value['goods_id']?>" target="_blank">
                                        <img src="<?=image_thumb($value['common_image'],180,180)?>">
                                    </a>
                                </div>
                                <div class="img-botom">
                                    <div class="text-content">
                                        <a href="<?=YLB_Registry::get('url')?>?ctl=Goods_Goods&met=goods&gid=<?=$value['goods_id']?>" target="_blank"><div class="text-2"><?=$value['common_name']?></div></a>
                                    </div>
                                    <div class="share-wrap clearfix">
                                        <div class="share">
                                            <span>分享立减</span>
                                            <span class="save"><?=format_money($value['common_share_price'])?></span>
                                        </div>
                                    </div>
                                    <div class="share-wrap clearfix">
                                        <div class="share">
                                            <span>立赚</span>
                                            <span class="save"><?=format_money($value['common_promotion_price'])?></span>
                                        </div>
                                        <div class="activity-wrap">
                                        </div>
                                    </div>
                                    <div class="price-content clearfix">
                                        <div class="now-price">
                                            <span class="coin-sign">￥</span><span class="coin-much"><?=$value['common_shared_price']?></span>
                                        </div>
                                        <div class="old-price">
                                            <span class="coin-sign">￥</span><span><?=$value['common_price']?></span>
                                        </div>
                                    </div>
                                    <div class="buy-once-button">
                                        <a href="<?=YLB_Registry::get('url')?>?ctl=Goods_Goods&met=goods&gid=<?=$value['goods_id']?>" target="_blank" class="buy-once">
                                            立即购买
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </li>
                    <?php }}?>
                </ul>
                </div>
                <div class="hd">
                    <div class="prev"></div>
                    <div class="next"></div>
                </div>
            </div>
        </div>
        <div class="all-day-content-item-wrap two no-block seconds">
            <div class="goods-slide">
                <div class="bd">
                <ul>
                    <?php if($discount_goods['items']){foreach ($discount_goods['items'] as $key=>$value){?>
                        <li class="swiper-slide">
                            <div class="all-day-content-item">
                                <div class="img-center">
                                    <a href="<?=YLB_Registry::get('url')?>?ctl=Goods_Goods&met=goods&gid=<?=$value['goods_id']?>" target="_blank">
                                        <img src="<?=image_thumb($value['goods_image'],180,180)?>">
                                    </a>
                                </div>
                                <div class="img-botom">
                                    <div class="text-content">
                                        <a href="<?=YLB_Registry::get('url')?>?ctl=Goods_Goods&met=goods&gid=<?=$value['goods_id']?>" target="_blank">
                                            <div class="text-2"><i class="zhekou1"><?=$value['discount_rate']?>折</i><?=$value['goods_name']?></div>
                                        </a>
                                    </div>
                                    <div class="share-wrap clearfix">
                                        <div class="share">
                                            <span>分享立减</span>
                                            <span class="save"><?=format_money($value['goods_share_price'])?></span>
                                        </div>
                                    </div>
                                    <div class="share-wrap clearfix">
                                        <div class="share">
                                            <span>立赚</span>
                                            <span class="save"><?=format_money($value['goods_promotion_price'])?></span>
                                        </div>
                                        <div class="activity-wrap">
                                        </div>
                                    </div>
                                    <div class="price-content clearfix">
                                        <div class="now-price">
                                            <span class="coin-sign">￥</span><span class="coin-much"><?=number_format($value['discount_price'] - $value['common_share_price'],2)?></span>
                                        </div>
                                        <div class="old-price">
                                            <span class="coin-sign">￥</span><span><?=$value['goods_price']?></span>
                                        </div>
                                    </div>
                                    <div class="contro" style="overflow:hidden;font-size: 0;margin-top: 5px;">
                                        <div class="progress"><img src="<?=$this->view->img?>/gradient.png" alt="" width="<?=number_format($value['goods_salenum']/($value['goods_stock']+$value['goods_salenum'])*100,2)?>%"></div>
                                        <div class="buy-once-button">
                                            <a href="<?=YLB_Registry::get('url')?>?ctl=Goods_Goods&met=goods&gid=<?=$value['goods_id']?>" target="_blank" class="buy-once">
                                                立即秒
                                            </a>
                                        </div>
                                    </div>
                                    <div class="sheng">已售<i style="color:#e45050;"><?=$value['goods_salenum']?>/<?=($value['goods_stock']+$value['goods_salenum'])?></i>件</div>
                                </div>
                            </div>
                        </li>
                    <?php }}?>

                </ul>
                </div>
                <div class="hd">
                    <div class="prev"></div>
                    <div class="next"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(function () {
        if($('#night').attr('class')/*.trim()*/.substr(($('#night').attr('class')/*.trim()*/.length)-4) == 'curr' && $('#night').attr('class')/*.trim()*/.substr(($('#night').attr('class')/*.trim()*/.length)-7) !='no-curr' )
        {
            $(".all-day").children(".all-day-content").children(".all-day-content-item-wrap").removeClass("curr").addClass("no-block");
            $(".all-day").children(".all-day-content").children(".all-day-content-item-wrap.two").removeClass("no-block").addClass("curr");
        }
        else
        {
            $(".all-day").children(".all-day-content").children(".all-day-content-item-wrap").eq(0).addClass("curr");
        }

        $(".half-day").click(function(){

            var index = $(this).index();
            $(this).addClass("curr").removeClass("no-curr").siblings(".half-day").removeClass("curr").addClass("no-curr");

            $(".all-day").children(".all-day-content").children(".curr").removeClass("curr").addClass("no-block");
            $(".all-day").children(".all-day-content").children(".all-day-content-item-wrap").eq(index).removeClass("no-block").addClass("curr");
        });
   })
        /*tab 切换*/





jQuery(".all-day-content-item-wrap.curr .goods-slide").slide({
    mainCell:".bd ul",
    autoPage:true,
    effect:"left",
    autoPlay:false,
    vis:6,
    scroll:6
})
jQuery(".all-day-content-item-wrap.two .goods-slide").slide({
    mainCell:".bd ul",
    autoPage:true,
    effect:"left",
    autoPlay:false,
    vis:6,
    scroll:6
})

</script>