<?php if (!defined('ROOT_PATH')){exit('No Permission');}?>
<?php
include $this->view->getTplPath() . '/' . 'header.php';
?>
    <link rel="stylesheet" type="text/css" href="<?=$this->view->css?>/newbuyer.css" />

    <div class="newbuyer_head">
        <img src="<?=$this->view->img?>/newBuyer_bottom.png">
        <div class="newbuyer_top">
            <img src="<?=$this->view->img?>/newbuyer_top.png">
            <div class="head_div">
                <div class="fl img2">
                    <?php if($data['guanggao']){ ?>
                        <p class="op_b"></p>
                        <a href="<?=YLB_Registry::get('url')?>?ctl=Goods_Goods&met=goods&type=goods&gid=<?=$data['guanggao']['goods_id']?>" target="_blank"><img src="<?=($data['guanggao']['goods_image'])?>"/></a>
                        <div class="gg_title">
                            <h2><?=($data['guanggao']['goods_name'])?></h2>
                            <p>专柜价：<del><?=format_money($data['guanggao']['goods_price'])?></del> 新人价：
                                <span  class="xrj"><?=format_money($data['guanggao']['shared_price'])?></span>
                            </p>
                        </div>
                    <?php }?>
                </div>
                <div class="clear"></div>
            </div>
        </div>
    </div>
    <div class="newbuyer_nav">
        <div class="fl nav_one fen">
            <a href="<?=YLB_Registry::get('url')?>?ctl=NewBuyer&met=index&type_id=1" target="_self"><i></i><h2><?=('1分包邮')?></h2></a>
        </div>
        <div class="fl nav_one mao">
            <a href="<?=YLB_Registry::get('url')?>?ctl=NewBuyer&met=index&type_id=2" target="_self"><i></i><h2><?=('1毛包邮')?></h2></a>
        </div>
        <div class="fl nav_one yuan">
            <a href="<?=YLB_Registry::get('url')?>?ctl=NewBuyer&met=index&type_id=3" target="_self"><i></i><h2><?=('1元包邮')?></h2></a>
        </div>
        <div class="fl nav_one moreshop">
            <a href="<?=YLB_Registry::get('url')?>?ctl=NewBuyer&met=shop" target="_self"><i></i><h2><?=('更多店铺')?></h2></a>
        </div>
    </div>

    <div class="line"></div>

    <div class="newbuyer_content">
        <div class="sd">
            <div class="c_sd1"></div>
            <div class="c_sd2"></div>
        </div>
        <div class="goods_list">
            <?php if($type_id){ ?>
                <?php if($data['list'] && $data['list']['items']){ ?>
                    <?php foreach ($data['list']['items'] as $key=>$value){?>
                        <div class="goods">
                            <div class="fl goods_l"></div>
                            <div class="fl goods_c">
                                <div class="fl g_content">
                                    <div class="g_title shop_name"><a href="<?=YLB_Registry::get('url')?>?ctl=Shop&met=actDetail&id=<?=$value['shop_id']?>&type=newBuyer"><?=$value['shop_name']?></a></div>
                                    <div class="g_title">
                                        <a href="<?=YLB_Registry::get('url')?>?ctl=Goods_Goods&met=goods&type=goods&gid=<?=$value['goods_id']?>" target="_blank"><h2><?=($value['goods_name'])?></h2></a>
                                        <a href="<?=YLB_Registry::get('url')?>?ctl=Goods_Goods&met=goods&type=goods&gid=<?=$value['goods_id']?>" target="_blank"><h3><?=($value['newbuyer_name'])?></h3></a>
                                    </div>
                                    <div class="g_buy">
                                        <div class="fl">
                                            <p class="zg">专柜价：￥<?=($value['goods_price'])?></p>
                                            <p class="zg">新人：<span class="rmb">￥</span><span class="xrj"><?=($value['shared_price'])?></span><span class="by">包邮</span></p>
                                        </div>
                                        <div class="fl">
                                            <a class="buy" href="<?=YLB_Registry::get('url')?>?ctl=Goods_Goods&met=goods&type=goods&gid=<?=$value['goods_id']?>" target="_blank">立即购买</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="fl g_img">
                                    <a href="<?=YLB_Registry::get('url')?>?ctl=Goods_Goods&met=goods&type=goods&gid=<?=$value['goods_id']?>" target="_blank"><img src="<?=($value['goods_image'])?>"/></a>
                                </div>
                                <div class="clear"></div>
                            </div>
                            <div class="fl goods_r"></div>
                            <div class="clear"></div>
                        </div>
                    <?php }?>
                    <?php if($page_nav){?>
                        <div class="goods_page_c">
                            <nav class="page page_front">
                                <?=$page_nav?>
                            </nav>
                        </div>
                    <?php }?>
                <?php }else{?>
                    <div class="goods">
                        <div class="fl goods_l"></div>
                        <div class="fl goods_c">
                            <div class="no_account">
                                <img src="<?= $this->view->img ?>/ico_none.png"/>
                                <p><?= _('暂无符合条件的数据记录') ?></p>
                            </div>
                        </div>
                        <div class="fl goods_r"></div>
                        <div class="clear"></div>
                    </div>
                <?php }?>
            <?php }else{ ?>
                <!--一分-->
                <?php if($data['yifen']){ ?>
                    <?php foreach ($data['yifen']['items'] as $key=>$value){?>
                        <div class="goods">
                            <div class="fl goods_l"></div>
                            <div class="fl goods_c">
                                <div class="fl g_content">
                                    <div class="g_title shop_name"><a href="<?=YLB_Registry::get('url')?>?ctl=Shop&met=actDetail&id=<?=$value['shop_id']?>&type=newBuyer"><?=$value['shop_name']?></a></div>
                                    <div class="g_title">
                                        <a href="<?=YLB_Registry::get('url')?>?ctl=Goods_Goods&met=goods&type=goods&gid=<?=$value['goods_id']?>" target="_blank"><h2><?=($value['goods_name'])?></h2></a>
                                        <a href="<?=YLB_Registry::get('url')?>?ctl=Goods_Goods&met=goods&type=goods&gid=<?=$value['goods_id']?>" target="_blank"><h3><?=($value['newbuyer_name'])?></h3></a>
                                    </div>
                                    <div class="g_buy">
                                        <div class="fl">
                                            <p class="zg">专柜价：￥<?=($value['goods_price'])?></p>
                                            <p class="zg">新人：<span class="rmb">￥</span><span class="xrj"><?=($value['shared_price'])?></span><span class="by">包邮</span></p>
                                        </div>
                                        <div class="fl">
                                            <a class="buy" href="<?=YLB_Registry::get('url')?>?ctl=Goods_Goods&met=goods&type=goods&gid=<?=$value['goods_id']?>" target="_blank">立即购买</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="fl g_img">
                                    <a href="<?=YLB_Registry::get('url')?>?ctl=Goods_Goods&met=goods&type=goods&gid=<?=$value['goods_id']?>" target="_blank"><img src="<?=($value['goods_image'])?>"/></a>
                                </div>
                                <div class="clear"></div>
                            </div>
                            <div class="fl goods_r"></div>
                            <div class="clear"></div>
                        </div>
                    <?php } ?>
                <?php }?>
                <!--一毛-->
                <?php if($data['yimao']){ ?>
                    <?php foreach ($data['yimao']['items'] as $key=>$value){?>
                        <div class="goods">
                            <div class="fl goods_l"></div>
                            <div class="fl goods_c">
                                <div class="fl g_content">
                                    <div class="g_title shop_name"><a href="<?=YLB_Registry::get('url')?>?ctl=Shop&met=actDetail&id=<?=$value['shop_id']?>&type=newBuyer"><?=$value['shop_name']?></a></div>
                                    <div class="g_title">
                                        <a href="<?=YLB_Registry::get('url')?>?ctl=Goods_Goods&met=goods&type=goods&gid=<?=$value['goods_id']?>" target="_blank"><h2><?=($value['goods_name'])?></h2></a>
                                        <a href="<?=YLB_Registry::get('url')?>?ctl=Goods_Goods&met=goods&type=goods&gid=<?=$value['goods_id']?>" target="_blank"><h3><?=($value['newbuyer_name'])?></h3></a>
                                    </div>
                                    <div class="g_buy">
                                        <div class="fl">
                                            <p class="zg">专柜价：￥<?=($value['goods_price'])?></p>
                                            <p class="zg">新人：<span class="rmb">￥</span><span class="xrj"><?=($value['shared_price'])?></span><span class="by">包邮</span></p>
                                        </div>
                                        <div class="fl">
                                            <a class="buy" href="<?=YLB_Registry::get('url')?>?ctl=Goods_Goods&met=goods&type=goods&gid=<?=$value['goods_id']?>" target="_blank">立即购买</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="fl g_img">
                                    <a href="<?=YLB_Registry::get('url')?>?ctl=Goods_Goods&met=goods&type=goods&gid=<?=$value['goods_id']?>" target="_blank"><img src="<?=($value['goods_image'])?>"/></a>
                                </div>
                                <div class="clear"></div>
                            </div>
                            <div class="fl goods_r"></div>
                            <div class="clear"></div>
                        </div>
                    <?php } ?>
                <?php }?>
                <!--一元-->
                <?php if($data['yiyuan']){ ?>
                    <?php foreach ($data['yiyuan']['items'] as $key=>$value){?>
                        <div class="goods">
                            <div class="fl goods_l"></div>
                            <div class="fl goods_c">
                                <div class="fl g_content">
                                    <div class="g_title shop_name"><a href="<?=YLB_Registry::get('url')?>?ctl=Shop&met=actDetail&id=<?=$value['shop_id']?>&type=newBuyer"><?=$value['shop_name']?></a></div>
                                    <div class="g_title">
                                        <a href="<?=YLB_Registry::get('url')?>?ctl=Goods_Goods&met=goods&type=goods&gid=<?=$value['goods_id']?>" target="_blank"><h2><?=($value['goods_name'])?></h2></a>
                                        <a href="<?=YLB_Registry::get('url')?>?ctl=Goods_Goods&met=goods&type=goods&gid=<?=$value['goods_id']?>" target="_blank"><h3><?=($value['newbuyer_name'])?></h3></a>
                                    </div>
                                    <div class="g_buy">
                                        <div class="fl">
                                            <p class="zg">专柜价：￥<?=($value['goods_price'])?></p>
                                            <p class="zg">新人：<span class="rmb">￥</span><span class="xrj"><?=($value['shared_price'])?></span><span class="by">包邮</span></p>
                                        </div>
                                        <div class="fl">
                                            <a class="buy" href="<?=YLB_Registry::get('url')?>?ctl=Goods_Goods&met=goods&type=goods&gid=<?=$value['goods_id']?>" target="_blank">立即购买</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="fl g_img">
                                    <a href="<?=YLB_Registry::get('url')?>?ctl=Goods_Goods&met=goods&type=goods&gid=<?=$value['goods_id']?>" target="_blank"><img src="<?=($value['goods_image'])?>"/></a>
                                </div>
                                <div class="clear"></div>
                            </div>
                            <div class="fl goods_r"></div>
                            <div class="clear"></div>
                        </div>
                    <?php } ?>
                <?php }?>
            <?php }?>
        </div>
    </div>

    <div class="shopSidesNavBox">
        <ul>
            <li ><a href="<?=YLB_Registry::get('url')?>?ctl=NewBuyer&met=index&type_id=1" target="_self"></a></li>
            <li ><a href="<?=YLB_Registry::get('url')?>?ctl=NewBuyer&met=index&type_id=2" target="_self"></a></li>
            <li ><a href="<?=YLB_Registry::get('url')?>?ctl=NewBuyer&met=index&type_id=3" target="_self"></a></li>
            <li ><a href="<?=YLB_Registry::get('url')?>?ctl=NewBuyer&met=index&type_id=3" target="_self"></a></li>
        </ul>
        <div class="nav_erm">
            <img class="er" src="<?=YLB_Registry::get('base_url')?>/shop/api/qrcode.php?data=<?=urlencode(YLB_Registry::get('base_url')."/?ctl=NewBuyer&met=index")?>" />
        </div>
        <div class="nav_content">
            <span>仅限新注册用户购买，每人限选购一种商品，限购一件</span>
        </div>
    </div>
    <script>
    
        var get_css_top1 = parseFloat($(".c_sd1").css("top"));
        var get_css_top2 = parseFloat($(".c_sd2").css("top"));
        var sdHeight = $(".c_sd2").outerHeight(true) + get_css_top2;
        
        
        $(window).scroll(function () {
            if ($(window).scrollTop() > 800) {
                $('.shopSidesNavBox').show();
            }else {
                $('.shopSidesNavBox').hide();
            };
            // 红丝带 js 控制样式
            var allHeight = $(".newbuyer_content").outerHeight(true) + $(".newbuyer_content").offset().top;
            if($(window).scrollTop() < $(".newbuyer_content").offset().top){      ///以上
                $(".c_sd1").css({"position":"absolute","top":get_css_top1});
                $(".c_sd2").css({"position":"absolute","top":get_css_top2});
            }else if($(window).scrollTop() > allHeight - sdHeight ){    //以下
                $(".c_sd1").css({"position":"absolute","top":$(".newbuyer_content").outerHeight(true) - $(".c_sd1").outerHeight(true) - $(".c_sd2").outerHeight(true)});
                $(".c_sd2").css({"position":"absolute","top":$(".newbuyer_content").outerHeight(true) - $(".c_sd2").outerHeight(true)});
            }else{                                   //中间
                var top = $(window).scrollTop() - $(".newbuyer_content").offset().top;
                $(".c_sd1").css({"position":"fixed","top":get_css_top1});
                $(".c_sd2").css({"position":"fixed","top":get_css_top2});
            };
        });

        <?php if(request_int('type_id')){?>
            $(function () {
                $("html,body").animate({scrollTop:$(".newbuyer_content").offset().top},1000)
            });
        <?php }?>
    </script>

<?php
include $this->view->getTplPath() . '/' . 'footer.php';
?>
