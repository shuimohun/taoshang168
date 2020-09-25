<script type="text/javascript" src="<?= $this->view->js ?>/nav.min.js"></script>

<div class="toolbar-wrap J-wrap">
    <div class="toolbar">
        <div class="toolbar-panels J-panel">
            <!--公告  start-->
            <div style="visibility: hidden;" class="J-content toolbar-panel tbar-panel-news toolbar-animate-out ">
                <div class="toolbar-panelff">
                    <div class="padd2">
                        <a class="close_p ml10">关闭<i class="iconfont icon-youshaungjiantou"></i></a>
                        <p class="view_all"><a href="<?= YLB_Registry::get('url') ?>?ctl=Buyer_Cart&met=cart">查看更多</a></p>
                    </div>
                    <div class="tbar-panel-main tbar-panel-main-sidebar news_contents">
                        <ul>
                            <?php if(!empty($information['items'])){ foreach($information['items'] as $k=>$v){?>
                                <li><a href="<?= YLB_Registry::get('url') ?>?ctl=Article_Base&article_id=<?= $v['article_id'] ?>" target="_blank">&bull;&nbsp;<?=$v['article_title']?></a></li>
                            <?php }}else{?>
                                <div class="item_cons_no">
                                    <?=_('公告为空')?>
                                </div>
                            <?php }?>
                        </ul>
                    </div>
                </div>
            </div>
            <!--公告 end-->

            <!--购物车 start-->
            <div style="visibility: hidden;" class="J-content toolbar-panel tbar-panel-cart toolbar-animate-out">
                <div class="padd2">
                    <a class="close_p ml10"><?=_('关闭')?><i class="iconfont icon-youshaungjiantou"></i></a>
                    <p class="view_all">
                        <a href="<?=YLB_Registry::get('url')?>?ctl=Buyer_Cart&met=cart">
                            <?=_('全屏查看')?>
                        </a>
                    </p>
                </div>
                <div class="item_cons cart_c">
                    <?php  if(isset($cart) && $cart['count']) :?>
                        <script>
                            $('.cart_count').html('<?=$cart['count']?>');
                        </script>
                        <div class="tbar-panel-main tbar-panel-main-sidebar cart_con">
                            <?php foreach($cart['cart_list'] as $cartk => $cartv): ?>
                                <div class="cart_contents">
                                    <!--店铺信息 start-->
                                    <div class="cart_contents_head">
                                        <div class="cart_shop_icon">
                                            <i class="iconfont icon-icoshop"></i>
                                        </div>
                                        <div class="cart_contents_title">
                                            <a href="<?= YLB_Registry::get('url') ?>?ctl=Shop&met=Index&id=<?=($cartv['shop_id'])?>">
                                                <span title="<?=($cartv['shop_name'])?>"><?=($cartv['shop_name'])?></span>
                                            </a>
                                        </div>
                                        <div class="cart_contents_cost">
                                            <strong>
                                                <?=format_money($cartv['sprice'])?>
                                            </strong>
                                        </div>
                                    </div>
                                    <!--店铺信息 end-->

                                    <!--购物车商品 start-->
                                    <div class="cart_lists">
                                        <?php foreach($cartv['goods'] as $cartgk => $cartgv):?>
                                            <?php if($cartgv['bl_id']){?>
                                                <div class="cart_bl_title">
                                                    <span class="ti"><?=('套装')?></span>
                                                    <span><a href="<?=YLB_Registry::get('url')?>?ctl=Goods_Goods&met=bundling&bid=<?=$cartgv['bl_id']?>" target="_blank"><?=($cartgv['bundling_info']['bundling_name'])?></a></span>
                                                </div>
                                                <?php foreach ($cartgv['bundling_info']['goods_list'] as $bl_k=>$bl_v){?>
                                                    <div class="cart_list bl_cart_list">
                                                        <div class="cart_list_order clearfix">
                                                            <div class="cart_list_orderimg">
                                                                <a href="<?=YLB_Registry::get('url')?>?ctl=Goods_Goods&met=goods&type=goods&gid=<?=($bl_v['goods_id'])?>" target="_blank">
                                                                    <img src="<?=image_thumb($bl_v['goods_image'],50,50)?>">
                                                                </a>
                                                            </div>
                                                            <div class="cart_list_content" style="">
                                                                <div>
                                                                    <span class="cart_goods_name"><a href="<?=YLB_Registry::get('url')?>?ctl=Goods_Goods&met=goods&gid=<?=($bl_v['goods_id'])?>" target="_blank"><?=$bl_v['goods_name']?></a></span>
                                                                </div>
                                                                <div>
                                                                    <span><?=$bl_v['spec_str']?></span>
                                                                </div>
                                                                <div>
                                                                    <span class="bbc_color"><?=format_money($bl_v['bundling_goods_price'])?></span>
                                                                    <span><?=('x')?></span>
                                                                    <span><?=($cartgv['goods_num'])?></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php }?>
                                            <?php }else{?>
                                                <div class="cart_list">
                                                    <div class="cart_list_order clearfix">
                                                        <div class="cart_list_orderimg">
                                                            <a href="<?=YLB_Registry::get('url')?>?ctl=Goods_Goods&met=goods&type=goods&gid=<?=($cartgv['goods_id'])?>" target="_blank">
                                                                <img src="<?=image_thumb($cartgv['goods_image'],50,50)?>">
                                                            </a>
                                                        </div>
                                                        <div class="cart_list_content">
                                                            <div>
                                                                <span class="cart_goods_name"><a href="<?=YLB_Registry::get('url')?>?ctl=Goods_Goods&met=goods&gid=<?=($cartgv['goods_id'])?>" target="_blank"><?=$cartgv['goods_name']?></a></span>
                                                            </div>
                                                            <div>
                                                                <span><?=$cartgv['spec_str']?></span>
                                                            </div>
                                                            <div>
                                                                <span class="bbc_color"><?=format_money($cartgv['now_price'])?></span>
                                                                <span><?=('x')?></span>
                                                                <span><?=($cartgv['goods_num'])?></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php }?>
                                        <?php endforeach;?>
                                    </div>
                                    <!--购物车商品 end-->
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <div class="cart_pay">
                            <div class="padd">
                                <div class="cart_foot clearfix">
                                    <span class="cartall"><?='总计:'?><?=format_money($cart['sum'])?></span>
                                </div>
                                <div class="topay">
                                    <a class="bbc_bg_col" href="<?=YLB_Registry::get('url')?>?ctl=Buyer_Cart&met=cart" target="_blank">
                                        <?=_('去购物车结算')?><b class="yuan iconfont icon-iconjiantouyou"></b>
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php else: ?>
                        <div class="item_cons_no">
                            <?=_('购物车为空')?>
                        </div>
                    <?php endif;?>
                </div>
            </div>
            <!--购物车 end-->

            <!--我的资产 start-->
            <div style="visibility: hidden;" class="J-content toolbar-panel tbar-panel-assets toolbar-animate-out">
                <div class="padd">
                    <p>
                        <a href="#" class="close_p">
                            <?=_('关闭')?><i class="iconfont icon-youshaungjiantou"></i></a>
                        <a href="<?= YLB_Registry::get('paycenter_api_url') ?>" class="view_all">
                            <?=_('全屏查看')?>
                        </a>
                    </p>
                    <ul class="assets_overview clearfix">
                        <li>
                            <a href="<?= YLB_Registry::get('url') ?>?ctl=Buyer_Points&met=points">
                                <span><?=@$user_list['user_points'];?></span>
                                <h6><?=_('金蛋')?></h6>
                            </a>
                        </li>
                        <li>
                            <a href="<?= YLB_Registry::get('url') ?>?ctl=Buyer_User&met=getUserGrade">
                                <span><?=@$user_list['user_growth'];?></span>
                                <h6><?=_('成长值')?></h6>
                            </a>
                        </li>
                    </ul>
                    <div class="other_voucher"></div>
                </div>
            </div>
            <!--我的资产 end-->

            <!--收藏店铺 start-->
            <div style="visibility: hidden;" class="J-content toolbar-panel tbar-panel-follow toolbar-animate-out">
                <div class="padd">
                    <p>
                        <a href="#" class="close_p">
                            <?=_('关闭')?><i class="iconfont icon-youshaungjiantou"></i></a>
                        <a href="<?= YLB_Registry::get('url') ?>?ctl=Buyer_Favorites&met=favoritesShop" class="view_all">
                            <?=_('全屏查看')?>
                        </a>
                    </p>
                    <div class="shop_contents item_cons">
                        <?php if(!empty($shop_list['items'])){?>
                            <?php
                            foreach($shop_list['items'] as $k=>$v){ ?>
                                <div class="item">
                                    <img class="brand_logo" src="<?=image_thumb($v['shop_logo'],90,45)?>">
                                    <a class="barnd_shop" href="<?= YLB_Registry::get('url') ?>?ctl=Shop&met=index&typ=e&id=<?=$v['shop_id']?>">
                                        <?=_('进入店铺')?>
                                    </a>
                                    <div class="brand_goodsList">
                                        <?php if(!empty($v['detail']['items'])){?>
                                            <?php foreach($v['detail']['items'] as $kk=>$vv){ ?>
                                                <a href="<?= YLB_Registry::get('url') ?>?ctl=Goods_Goods&met=goods&type=goods&gid=<?=$vv['goods_id']?>">
                                                    <img src="<?=image_thumb($vv['common_image'],100,100)?>">
                                                    <p class="brand_name" title="<?=$vv['common_name']?>"><?=$vv['common_name']?></p>
                                                    <p class="brand_price" title="<?=format_money($vv['common_price'])?>"><?=format_money($vv['common_price'])?></p>
                                                </a>
                                            <?php }?>
                                        <?php }?>
                                    </div>
                                </div>
                            <?php }?>
                        <?php }else{?>
                            <div class="item_cons_no">
                                <?=_('店铺收藏为空')?>
                            </div>
                        <?php }?>
                    </div>
                </div>
            </div>
            <!--收藏店铺 end-->

            <!--足迹 start-->
            <div style="visibility: hidden;" class="J-content toolbar-panel tbar-panel-history toolbar-animate-out">
                <div class="padd over">
                    <p>
                        <a class="close_p">
                            <?=_('关闭')?><i class="iconfont icon-youshaungjiantou"></i></a>
                        <a href="<?= YLB_Registry::get('url') ?>?ctl=Buyer_Favorites&met=footprint" class="view_all">
                            <?=_('全屏查看')?>
                        </a>
                    </p>
                    <ul class="history_goods clearfix">
                        <?php if(!empty($footprint_list['items'])){?>
                            <?php
                            foreach($footprint_list['items'] as $k=>$v){ ?>
                                <?php if(!empty($v['detail'])){?>
                                    <li>
                                        <a href="<?=YLB_Registry::get('url')?>?ctl=Goods_Goods&met=goods&type=goods&gid=<?=$v['detail']['goods_id']?>">
                                            <img src="<?php if(!empty($v['detail']['common_image'])){?><?=image_thumb($v['detail']['common_image'],116,116)?><?php }else{?><?= image_thumb($this->web['goods_image'],116,116)?><?php }?>"/>
                                            <h5><?=$v['detail']['common_name']?></h5>
                                            <h6 class="bbc_color"><?=format_money($v['detail']['common_price'])?></h6>
                                        </a>
                                    </li>
                                <?php }?>
                            <?php }?>
                        <?php }else{?>
                            <div class="item_cons_no">
                                <?=_('你没有浏览商品')?>
                            </div>
                        <?php }?>
                    </ul>
                </div>
            </div>
            <!--足迹 end-->

            <!--收藏商品 start-->
            <div style="visibility: hidden;" class="J-content toolbar-panel tbar-panel-sav toolbar-animate-out">
                <div class="padd over">
                    <p class="padd2">
                        <a class="close_p">
                            <?=_('关闭')?><i class="iconfont icon-youshaungjiantou"></i></a>
                        <a href="<?= YLB_Registry::get('url') ?>?ctl=Buyer_Favorites&met=favoritesGoods" class="view_all">
                            <?=_('全屏查看')?>
                        </a>
                    </p>
                    <ul class="sav_goods clearfix">
                        <?php if(!empty($goods_list['items'])){?>
                            <?php
                            foreach($goods_list['items'] as $k=>$v){ ?>
                                <?php if(!empty($v['detail'])){?>
                                    <li>
                                        <a href="<?= YLB_Registry::get('url') ?>?ctl=Goods_Goods&met=goods&type=goods&gid=<?=$v['goods_id']?>">
                                            <img src="<?php if(!empty($v['detail']['goods_image'])){?><?=image_thumb($v['detail']['goods_image'],116,116)?><?php }else{?><?= image_thumb($this->web['goods_image'],116,116)?><?php }?>"/>
                                            <h5><?=$v['detail']['goods_name']?></h5>
                                            <h6 class="bbc_color">
                                                <?=format_money($v['detail']['goods_price'])?>
                                            </h6>
                                        </a>
                                    </li>
                                <?php }?>
                            <?php }?>
                        <?php }else{?>
                            <div class="item_cons_no">
                                <?=_('你没有收藏商品为空')?>
                            </div>
                        <?php }?>
                    </ul>
                </div>
            </div>
            <!--收藏商品 end-->

            <!--代金券 start-->
            <div style="visibility: hidden;" class="J-content toolbar-panel tbar-panel-voucher toolbar-animate-out">
                <div class="padd over">
                    <p>
                        <a class="close_p">
                            <?=_('关闭')?><i class="iconfont icon-youshaungjiantou"></i></a>
                        <a href="<?= YLB_Registry::get('url') ?>?ctl=Buyer_Favorites&met=footprint" class="view_all">
                            <?=_('全屏查看')?>
                        </a>
                    </p>
                    <div class="voucher-wrap">
                        <?php if(!empty($v_t_row)){ ?>
                            <!-- 可领取的券 -->
                            <div class="voucher-type">
                                <div class="clapboard">
                                    可领取的券
                                </div>
                            </div>
                            <ul class="voucher-list">
                                <?php foreach($v_t_row as $k=>$v){ ?>
                                    <li class="voucher-item">
                                        <div class="voucher-price">
                                            <span class="money-sign">￥</span><?= $v['voucher_t_price']; ?>
                                            <span class="voucher-name">代金券</span>
                                        </div>
                                        <div class="voucher-info">  <?= $v['voucher_t_title'];?>
                                        </div>

                                        <?php if($v['is_taken']){?>
                                            <div class="recevied"></div>
                                            <span class="voucher-limit"></span>
                                            <a href="<?=YLB_Registry::get('url').'?ctl=Shop&met=index&typ=e&id='.$v['shop_id']?>"class="receive" data-tid="<?=$v['voucher_t_id'] ?>">立即使用</a>
                                        <?php }else{?>
                                            <?php if($v['voucher_t_giveout'] == $v['voucher_t_total']){ ?>
                                                <div class="loot_all"></div>
                                            <?php } ?>
                                            <?php if($v['voucher_t_access_method']==3){ ?>
                                                <span class="voucher-limit"></span>
                                                <a href="javascript:void(0);"class="receive get" data-tid="<?=$v['voucher_t_id'] ?>">立即领取</a>
                                            <?php }else if($v['voucher_t_access_method']==1){ ?>
                                                <span class="voucher-limit">兑换需：<?= $v['voucher_t_points'];?> 金蛋</span>
                                                <a href="javascript:void(0);" class="receive get" data-tid="<?=$v['voucher_t_id'] ?>">立即兑换</a>
                                            <?php }?>
                                            <div class="loot_all" style="display: none"></div>
                                        <?php }?>
                                        <p class="voucher-time">
                                            <?=  date('Y-m-d',strtotime($v['voucher_t_start_date']));?>至<?= date('Y-m-d',strtotime($v['voucher_t_end_date'])) ; ?>
                                        </p>
                                    </li>
                                <?php } ?>
                            </ul>
                        <?php }else{ ?>
                            <div class="voucher-type">
                                <div class="clapboard">
                                    可领取的券
                                </div>
                            </div>
                            <div style="margin: 20px auto;width: 55%"><p>老板小气，不给代金券</p></div>
                        <?php } ?>
                        <!-- 已领取的券 -->
                        <div class="voucher-type">
                            <div class="clapboard">
                                已领取的券
                            </div>
                        </div>
                        <ul class="voucher-list">
                            <?php if(!empty($v_row)){?>
                                <?php foreach($v_row as $k=>$v){ ?>
                                    <li class="voucher-item">
                                        <?php if($v['voucher_end_date'] <  date("Y-m-d H:i:s",strtotime("+7 days"))){?>
                                            <div class="will-overdue"></div>
                                        <?php } ?>
                                        <div class="voucher-price">
                                            <span class="money-sign">￥</span><?= $v['voucher_price']; ?>
                                            <span class="voucher-name">代金券</span>
                                        </div>
                                        <div class="voucher-info"> <?= $v['voucher_title'];?>
                                        </div>
                                        <div class="recevied"></div>
                                        <?php if( $v['voucher_t_points']){ ?>
                                            <span class="voucher-limit">兑换需：<?= $v['voucher_t_points'];?> 金蛋</span>
                                        <?php }else{ ?>
                                            <span class="voucher-limit"></span>
                                        <?php } ?>
                                        <a href="<?=YLB_Registry::get('url').'?ctl=Shop&met=index&typ=e&id='.$v['voucher_shop_id']?>" class="receive" >立即使用</a>
                                        <p class="voucher-time">
                                            <?=  date('Y-m-d',strtotime($v['voucher_start_date']));?>至<?= date('Y-m-d',strtotime($v['voucher_end_date'])) ; ?>
                                        </p>
                                    </li>
                                <?php } ?>
                            <?php }else{ ?>
                                <div class="item_cons_no">
                                    <?=_('代金券为空')?>
                                </div>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
            </div>
            <!--代金券 end-->
        </div>
        <div class="toolbar-header"></div>

        <div class="toolbar-tab tbar-tab-news" data-type="news">
            <i class="tab-ico iconfont icon-icongonggao nav_icon news_icon"></i>
            <em class="tab-text "><?=_('通知')?></em>
            <span class="tab-sub J-count hide"></span>
        </div>
        <div class="tbar-tab-online-contact">
            <i class="tab-ico iconfont icon-logo_im nav_icon"></i>
            <em class="tab-text "><?=_('在线联系')?></em>
            <span class="tab-sub J-count hide"></span>
        </div>
        <div class="toolbar-tabs J-tab">
            <div class="nav_head">
                <a href="<?=YLB_Registry::get('url')?>?ctl=Buyer_Index&met=index">
                    <img src="<?= YLB_Registry::get('ucenter_api_url') ?>?ctl=Index&met=img&user_id=<?= @Perm::$userId ?>"/>
                </a>
            </div>
            <div class=" toolbar-tab  tbar-tab-cart shopcli" data-type="cart">
                <i class="tab-ico iconfont icon-gouwuche2 nav_icon"></i>
                <em class="tab-text"><?=_('我的购物车')?></em>
                <span class="tab-sub J-count cart_count"><?php if(isset($cart['count'])){echo $cart['count'];}else{echo 0;}?></span>
            </div>
            <div class=" toolbar-tab  tbar-tab-assets" data-type="assets">
                <i class="tab-ico iconfont icon-iconyouhuiquan nav_icon"></i>
                <em class="tab-text"><?=_('我的资产')?></em>
            </div>
            <div class=" toolbar-tab tbar-tab-follow" data-type="follow">
                <i class="tab-ico iconfont icon-icoheart nav_icon"></i>
                <em class="tab-text"><?=_('我的关注')?></em>
                <span class="tab-sub J-count hide"></span>
            </div>
            <div class=" toolbar-tab tbar-tab-sav" data-type="sav">
                <i class="tab-ico iconfont  icon-iconshoucang nav_icon"></i>
                <em class="tab-text"><?=_('我的收藏')?></em>
                <span class="tab-sub J-count hide"></span>
            </div>
            <div class=" toolbar-tab tbar-tab-history" data-type="history">
                <i class="tab-ico iconfont icon-iconzuji nav_icon"></i>
                <em class="tab-text"><?=_('我的足迹')?></em>
                <span class="tab-sub J-count hide"></span>
            </div>
            <div class=" toolbar-tab tbar-tab-voucher" data-type="voucher">
                <i class="tab-ico iconfont icon-iconquanchangquan nav_icon"></i>
                <em class="tab-text"><?=_('代金券')?></em>
                <span class="tab-sub J-count hide"></span>
            </div>
        </div>
        <div class="toolbar-footer">
            <div class="code_screen">
                <a class="about_code iconfont icon-btnsaoma tab-ico nav_icon" href="#"></a>
                <p class="code_cont">
                    <img src="<?= Web_ConfigModel::value('mobile_wx')?>" />
                </p>
            </div>
            <div>
                <a class="about_top iconfont icon-top about_top tab-ico nav_icon" href="#"></a>
            </div>
        </div>
    </div>
    <div id="J-toolbar-load-hook"></div>
</div>
<script>

    $('.receive.get').on('click', function(){
        getFreeVoucher($(this).attr('data-tid'));
    });

    // 免费领代金券
    function getFreeVoucher(tid) {
        var key = getCookie('key');
        if (!key) { checkLogin(0); return; }
        $.ajax({
            type:'post',
            url:SITE_URL+"?ctl=Voucher&met=receiveVoucher&typ=json",
            data:{vid:tid},
            dataType:'json',
            success:function(result){
                var msg = '';
                if(result.data['voucher_t_points'] > 0){
                    msg = '兑换';
                }else {
                    msg = '领取';
                }

                if(result.status == 200){
                    msg += '成功';
                    Public.tips.success(msg);
                }else{
                    if(result.msg){
                        if(result.msg=='代金券已被领完！'){
                            $("[data-tid='"+tid+"']").siblings(".loot_all").css("display",'');
                        }
                        msg = result.msg;
                    }else {
                        msg += '失败!'
                    }
                    Public.tips.error(msg);
                }
            }
        });
    }

    $(function () {
        <?php if(Web_ConfigModel::value('im_statu')==1){ ?>
            $('#im_ajax_load1').load(SITE_URL+'?ctl=Api_IM_Im&met=index',function () {
                im_builder_ch();
                iconbtncomment();
            });
            function im_builder_ch(){
                var onl = $(".tbar-tab-online-contact");
                onl.show().click(function(){
                    $('#imbuiler').show();
                    $('#imbuiler').contents().find('.bottom-bar a').click();
                    return;
                });
            }
            function iconbtncomment(){
                $('.chat-enter').click(function(){
                    var ch_u = $(this).attr('rel');
                    if(!getCookie('id')){
                        alert('请登录！');
                    }
                    if(ch_u == getCookie('id')){
                        alert('不能跟自己聊天');
                        return ;
                    }
                    var inner = $('#imbuiler')[0].contentWindow;

                    $('#imbuiler').show();
                    //查看聊天右侧的用户列表有没有，没有就点一下最下面的就出来了。
                    var dis = $('#imbuiler').contents().find('.chat-list').css('display');

                    if(dis!='block'){
                        $('#imbuiler').contents().find('.bottom-bar a').click();
                    }
                    //传值消息到IM
                    inner.chat(ch_u);
                    return false;
                });
            }
        <?php }?>

        var nice_scroll_row = ['.news_contents', '.shop_contents', '.history_goods', '.sav_goods', '.voucher-wrap'];
        $.each($.unique(nice_scroll_row), function(index, data) {
            $scroll_obj = $(data);
            if ($scroll_obj.length > 0) {
                $scroll_obj.niceScroll({
                    cursorcolor: "#666",
                    cursoropacitymax: 1,
                    touchbehavior: false,
                    cursorwidth: "3px",
                    cursorborder: "0",
                    cursorborderradius: "3px",
                    autohidemode: false,
                    nativeparentscrolling: true
                });
            }
        });

        <?php if(isset($cart['count'])){?>
            $('#cart_num').html(<?php echo $cart['count'];?>);
        <?php }?>
    });

</script>

