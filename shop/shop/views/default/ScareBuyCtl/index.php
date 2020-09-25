<?php if (!defined('ROOT_PATH')){exit('No Permission');}?>
<?php
include $this->view->getTplPath() . '/' . 'header.php';
?>

<link rel="stylesheet" type="text/css" href="<?=$this->view->css?>/base.css" />
<link rel="stylesheet" type="text/css" href="<?=$this->view->css?>/scarebuy.css" />
<div class="t_ban">
    <div class="tg_center scare-buy-banner" id="slides">
        <div class="banner bd">
            <ul class="items">
                <?php if(Web_ConfigModel::value('subsite_is_open') && isset($_COOKIE['sub_site_id']) && $_COOKIE['sub_site_id'] > 0){$scarebuy_subsite_id = '_'.$_COOKIE['sub_site_id'];}else{$scarebuy_subsite_id = '';} ?>
                <?php if(Web_ConfigModel::value('slider1_image'.$scarebuy_subsite_id)){ ?>
                    <li>
                        <a href="<?=Web_ConfigModel::value('live_link1'.$scarebuy_subsite_id)?>">
                            <img src="<?=image_thumb(Web_ConfigModel::value('slider1_image'.$scarebuy_subsite_id),1920,400)?>"/>
                        </a>
                    </li>
                <?php } ?>
                <?php if(Web_ConfigModel::value('slider2_image'.$scarebuy_subsite_id)){ ?>
                    <li>
                        <a href="<?=Web_ConfigModel::value('live_link2'.$scarebuy_subsite_id)?>">
                            <img src="<?=image_thumb(Web_ConfigModel::value('slider2_image'.$scarebuy_subsite_id),1920,400)?>"/>
                        </a>
                    </li>
                <?php } ?>
                <?php if(Web_ConfigModel::value('slider3_image'.$scarebuy_subsite_id)){ ?>
                    <li>
                        <a href="<?=Web_ConfigModel::value('live_link3'.$scarebuy_subsite_id)?>">
                            <img src="<?=image_thumb(Web_ConfigModel::value('slider3_image'.$scarebuy_subsite_id),1920,400)?>"/>
                        </a>
                    </li>
                <?php } ?>
                <?php if(Web_ConfigModel::value('slider4_image'.$scarebuy_subsite_id)){ ?>
                    <li>
                        <a href="<?=Web_ConfigModel::value('live_link3'.$scarebuy_subsite_id)?>">
                            <img src="<?=image_thumb(Web_ConfigModel::value('slider4_image'.$scarebuy_subsite_id),1920,400)?>"/>
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
jQuery(".scare-buy-banner").slide({
    mainCell:".bd ul",
    autoPlay:true
});
</script>
<div class="wrap scarebuy">
    <div class="title">
        <img src="<?=$this->view->img?>/flash_on_white_24x24.png" alt="">
        <span>限时限量</span>
        <span>疯狂抢购</span>
        <a href="index.php?ctl=ScareBuy&met=index"><img src="<?=$this->view->img?>/title_qianggou.png" alt=""></a>
        <a href="index.php?ctl=ScareBuy&met=index&state=underway"><img src="<?=$this->view->img?>/title_shouqing.png" alt=""></a>
        <a href="index.php?ctl=ScareBuy&met=index&state=history"><img src="<?=$this->view->img?>/title_qiangguang.png" alt=""></a>
    </div>
    <div>
        <?php   if($data['goods']['items']){  ?>
            <ul class="seckill">
                <?php  foreach($data['goods']['items'] as $key=>$value) { ?>

                    <li <?php if($value['hot'] == ScareBuy_BaseModel::LOOTALL){?>class="saleover" <?php }?>>
                        <div class="time">
                            <div class="time_title"><span>距离结束</span></div>
                            <div class="fnTimeCountDown" data-end="<?=$value['scarebuy_endtime'] ?>">
                                <span class="hour">00</span><strong>:</strong>
                                <span class="mini">00</span><strong>:</strong>
                                <span class="sec">00</span>
                            </div>
                            <div class="clear"></div>
                        </div>
                        <div class="seckill_img">
                            <a  href="<?= YLB_Registry::get('url') ?>?ctl=Goods_Goods&met=goods&gid=<?= $value['goods_id'] ?>" target="_blank">
                                <img class="jqzoom" src="<?= $value['goods_image'] ?>" alt=""></a>
                            <?php if($value['hot'] == ScareBuy_BaseModel::HOT){?>
                                <img src="<?=$this->view->img?>/scare_hot.png" alt="" class="hot">
                            <?php }else if($value['hot'] == ScareBuy_BaseModel::LOOTALL){ ?>
                                <img src="<?=$this->view->img?>/saleout.png" alt="" class="saleout">
                            <?php }?>

                        </div>
                        <div class="seckill_info">
                            <a href="<?= YLB_Registry::get('url') ?>?ctl=Goods_Goods&met=goods&gid=<?= $value['goods_id'] ?>" target="_blank"><span><?= $value['goods_name'] ?></span></a>
                            <!--<p><?/*= $value['scarebuy_remark'] */?></p>-->
                            <b><?= format_money($value['scarebuy_price']) ?></b>
                            <del><?= format_money($value['goods_price']) ?></del><br>
                            <i><b class="zj"><img src="<?=$this->view->img?>/label_reduce_price_btn.png" alt=""></b><em><?= _('直降') ?><?= format_money($value['reduce']) ?></em></i><br>
                            <a class="share" data-param="{goods_id:<?=$value['goods_id']?>,goods_image:'<?=$value['goods_image']?>',goods_name:'<?=$value['goods_name']?>',is_promotion:<?=$value['share_info']['is_promotion']?>,sqq:<?=$value['share_info']['sqq']?>,qzone:<?=$value['share_info']['qzone']?>,weixin:<?=$value['share_info']['weixin']?>,weixin_timeline:<?=$value['share_info']['weixin_timeline']?>,tsina:<?=$value['share_info']['tsina']?>}"><i><b><img src="<?=$this->view->img?>/label_share_save_btn.png" alt=""></b><em><?= _('分享立省') ?><?= format_money($value['goods_share_price']) ?></em></i></a><br>
                            <?php if($value['share_info']['is_promotion']){ ?>
                                <a class="share" data-param="{goods_id:<?=$value['goods_id']?>,goods_image:'<?=$value['goods_image']?>',goods_name:'<?=$value['goods_name']?>',is_promotion:<?=$value['share_info']['is_promotion']?>,sqq:<?=$value['share_info']['sqq']?>,qzone:<?=$value['share_info']['qzone']?>,weixin:<?=$value['share_info']['weixin']?>,weixin_timeline:<?=$value['share_info']['weixin_timeline']?>,tsina:<?=$value['share_info']['tsina']?>}"><i><b><img src="<?=$this->view->img?>/label_make_money_btn.png" alt=""></b><em><?= _('再赚') ?><?= format_money($value['goods_promotion_price']) ?></em></i></a><br>
                            <?php }?>
                            <div class="qiang">
                                <div class="qiang_left">
                                    <u><?= $value['sale_rate'] ?></u>
                                    <u class="yq">已抢<?= $value['scarebuy_buy_quantity'] ?>件</u>
                                    <div class="progress">
                                        <?php if($value['hot'] != ScareBuy_BaseModel::LOOTALL){?>
                                            <img src="<?=$this->view->img?>/rectangle@3x.png" alt="" width="<?= $value['sale_rate'] ?>">
                                        <?php }?>
                                    </div>
                                </div>
                                <a href="<?= YLB_Registry::get('url') ?>?ctl=Goods_Goods&met=goods&gid=<?= $value['goods_id'] ?>" target="_blank"><div class="qiang_right">立即抢购 &gt;</div></a>
                            </div>
                        </div>
                    </li>
                <?php  } ?>
            </ul>
        <?php  } ?>
    </div>

    <ul class="list">
        <img class="er" src="<?=YLB_Registry::get('base_url')?>/shop/api/qrcode.php?data=<?=urlencode(YLB_Registry::get('base_url')."/?ctl=ScareBuy&met=index")?>" />
        <li>扫描二维码</li>
        <li>手机购物更实惠</li>
        <?php if($data['cat']['physical']){ foreach($data['cat']['physical'] as $key=>$phy_cat){ ?>
                <li><a href="<?=YLB_Registry::get('url')?>?ctl=ScareBuy&met=index&cat_id=<?=$phy_cat['scarebuy_cat_id']?>"><?=$phy_cat['scarebuy_cat_name']?></a></li>
        <?php }} ?>
    </ul>
    <div class="page">
        <div colspan="5"><?=($page_nav)?></div>
    </div>

</div>
<script>
    $(function(){
        var _TimeCountDown = $(".fnTimeCountDown");
        _TimeCountDown.fnTimeCountDown();
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
    <?php if(request_int('totalRows')){?>
    $(function () {
        $("html,body").animate({scrollTop:$(".scarebuy").offset().top},1000)
    });
    <?php }?>
</script>

<!--分享立减Zhenzh-->
<div id="sharecover" style="display:none;">
    <span class="mask"></span>
</div>
<div id="code">
    <input class="share_goods_id" type="hidden"  />
    <input class="share_goods_image" type="hidden"  />
    <input class="share_goods_name" type="hidden"  />
    <div class="close">
        <span>分享有礼</span>
        <a href="javascript:void(0)" id="closebt"><img src="<?= $this->view->img ?>/close.png"></a>
    </div>
    <div class="sharetxt">
        <div class="share_explain lj">
            <p class="explain_title" >1.分享立減</p>
            <p class="explain_e" >将商品链接分享至相关平台可获得减免额度。每种渠道可分享一次，分享后点击可获得相应减免额度，最终支付金额以所分享平台数量决定。</p>
            <p class="explain_ex" ><span class="lr">例如：</span>&nbsp;您看中了一件100元的商品，弹出窗口提示您每分享一次可立减5元，如果您在QQ好友、QQ空间、微信好友、微信朋友圈、新浪微博5种渠道都分享了该商品，最终您就可以100-5*5=75元的价格购买到该商品。</p>
        </div>
        <div class="share_explain lz">
            <p class="explain_title">2.分享立赚</p>
            <p class="explain_e">将商品链接分享至相关平台可获得点击推广金。每种渠道可分享一次，每点击一次即可获得相应点击推广金，最终所获得点击推广金以所分享链接点击数决定。</p>
            <p class="explain_ex"><span class="lr">例如：</span>&nbsp;您将商品链接分享至QQ好友、QQ空间、微信好友、微信朋友圈、新浪微博等平台，共产生50次点击，每次点击的点击推广金为0.3元，那您最终将会获得0.3*50=15元点击推广金。每人在每个平台只可点击一次，所获得点击推广金由平台和商家所设定的单次点击金额与有效点击次数共同决定（总和不超过该商品的总点击推广金），相应推广详情可在商城“我的账户”中查看。</p>
        </div>

        <p>我要分享到：</p>
        <div class="share_c">
            <div class="bdsharebuttonbox" data-tag="share_1">
                <div class="share_d"><a class="bds_share bds_sqq " data-cmd="sqq"></a>
                    <p>QQ好友</p>
                    <p>立减<span class="sqq"></span>元</p>
                </div>
                <div class="share_d"><a class="bds_share bds_qzone" data-cmd="qzone" ></a>
                    <p>QQ空间</p>
                    <p>立减<span class="qzone"></span>元</p>
                </div>
                <div class="share_d"><a class="bds_share bds_weixin" data-cmd="weixin"></a>
                    <p>微信好友</p>
                    <p>立减<span class="weixin"></span>元</p>
                </div>
                <div class="share_d"><a class="bds_share bds_weixin_timeline" data-cmd="weixin"></a>
                    <p>微信朋友圈</p>
                    <p>立减<span class="weixin_timeline"></span>元</p>
                </div>
                <div class="share_d"><a class="bds_share bds_tsina" data-cmd="tsina"></a>
                    <p>新浪微博</p>
                    <p>立减<span class="tsina"></span>元</p>
                </div>
                <div class="share_d more"><a class="bds_more" ></a><p>分享越多</p><p>立赚越多</p></div>
                <div class="share_more">
                    <div class="triangle-css3 transform ie-transform-filter"></div>
                    <div class="more_s">
                        <div class="mss"><a class="bds_douban" data-cmd="douban"></a><p>豆瓣</p></div>
                        <div class="mss"><a class="bds_kaixin001" data-cmd="kaixin001"></a><p>开心网</p></div>
                        <div class="mss"><a class="bds_ty" data-cmd="ty"></a><p>天涯</p></div>
                        <div class="mss"><a class="bds_huaban" data-cmd="huaban"></a><p>花瓣网</p></div>
                        <div class="mss"> <a class="bds_copy" data-cmd="copy"></a><p>复制链接</p></div>
                    </div>
                </div>

                <div class="clear"></div>
            </div>

            <!--<script>
                function SetShareUrl(cmd, config) {
                    var url = location.href;
                    var gid = $('.share_goods_id').val();
                    var image = $('.share_goods_image').val();
                    var goods_name = $('.share_goods_name').val();
                    config.bdUrl = url.split('?')[0] +"?ctl=Goods_Goods&met=goods&gid=" +gid;
                    config.bdPic =image;
                    config.bdText =goods_name;
                    return config;
                }
                var img_url = $('.jqzoom')[0].src;
                window._bd_share_config = {
                    common : {
                        onBeforeClick: SetShareUrl,
                        //bdText : '' ,
                        bdDesc : '淘尚168商城',
                        //bdUrl : str_url +"&suid=" + <?php /*echo Perm::$userId;*/?>,
                        //bdPic : img_url,
                    },
                    share : [{
                        "bdSize" : 24,
                        "bdCustomStyle":'<?/*= $this->view->css */?>/bdshare.css'
                    }],
                    slide : [{
                        bdImg : 0,
                        bdPos : "left",
                        bdTop : 100
                    }],
                }


                with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='http://bdimg.share.baidu.com/static/api/js/share.js?cdnversion='+~(-new Date()/36e5)];

            </script>-->


        </div>
        <div class="share_xx"></div>
        <div class="sharefoot">
            <div class="promotion s_ljz">
                <span class="sp1">1.分享立减：</span>
                <span  class="sp2">将商品链接分享至相关平台可获得相应减免额度<span class="lj_xq" >（详情）</span></span>
                <span class="ljl red_line"></span>
            </div>
            <div class="promotion s_ljz">
                <span  class="sp1">2.分享立赚：</span>
                <span  class="sp2 ">将商品链接分享至相关平台可获得相应点击推广金<span class="lz_xq" >（详情）</span></span>
                <span class="lzl red_line"></span>
            </div>

            <div class="no_promotion">
                <span class="sp1">分享立减：</span>
                <span  class="sp2">将商品链接分享至相关平台可获得相应减免额度<span class="lj_xq" >（详情）</span>
                    </span>
            </div>
        </div>


    </div>

</div>
<script>
    /*$(function() {
        $('.share').click(function() {
            $('#code').center();
            $('#sharecover').show();

            eval('var _data = ' + $(this).data('param'));
            $('.sqq').html(_data.sqq);
            $('.qzone').html(_data.qzone);
            $('.weixin').html(_data.weixin);
            $('.weixin_timeline').html(_data.weixin_timeline);
            $('.tsina').html(_data.tsina);
            $('.share_goods_id').val(_data.goods_id);
            $('.share_goods_image').val(_data.goods_image);
            $('.share_goods_name').val(_data.goods_name);

            if(_data.is_promotion == 1){
                $('.promotion').show();
                $('.no_promotion').hide();
            }else{
                $('.promotion').hide();
                $('.no_promotion').show();
            }


            var top = document.body.scrollTop;
            $("#code").css({top:top+300});
            $('#code').fadeIn();
        });
        $('#closebt').click(function() {
            $('#code').hide();
            $('#sharecover').hide();
        });
        $('#sharecover').click(function() {
            $('#code').hide();
            $('#sharecover').hide();
        });
        $('.more').hover(function () {
            $('.share_more').fadeIn();
        });
        $('.share_more').mouseleave(function () {
            $('.share_more').hide();
        });
        $('#code').hover(function () {
            $('.share_more').hide();
        });
        jQuery.fn.center = function(loaded) {
            var obj = this;
            body_width = parseInt($(window).width());
            body_height = parseInt($(window).height());
            block_width = parseInt(obj.width());
            block_height = parseInt(obj.height());

            left_position = parseInt((body_width / 2) - (block_width / 2) + $(window).scrollLeft());
            if (body_width < block_width) {
                left_position = 0 + $(window).scrollLeft();
            };

            top_position = parseInt((body_height / 2) - (block_height / 2) + $(window).scrollTop());
            if (body_height < block_height) {
                top_position = 0 + $(window).scrollTop();
            };

            if (!loaded) {

                obj.css({
                    'position': 'absolute'
                });
                obj.css({
                    'top': ($(window).height() - $('#code').height()) * 0.5,
                    'left': left_position
                });
                $(window).bind('resize', function() {
                    obj.center(!loaded);
                });
                $(window).bind('scroll', function() {
                    obj.center(!loaded);
                });

            } else {
                obj.stop();
                obj.css({
                    'position': 'absolute'
                });
                obj.animate({
                    'top': top_position
                }, 200, 'linear');
            }
        }

        $('.lj_xq').hover(function () {
            $('.lj').fadeIn();
            $('.ljl').css("display","block");
        }).mouseleave(function () {
            $('.lj').fadeOut();
            $('.ljl').fadeOut();
        });
        $('.lz_xq').hover(function () {
            $('.lz').fadeIn();
            $('.lzl').css("display","block");
        }).mouseleave(function () {
            $('.lz').fadeOut();
            $('.lzl').fadeOut();
        });
    })*/
</script>

<?php
include $this->view->getTplPath() . '/' . 'footer.php';
?>