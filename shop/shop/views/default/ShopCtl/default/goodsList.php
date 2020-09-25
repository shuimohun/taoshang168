<?php if (!defined('ROOT_PATH'))
{
    exit('No Permission');
} ?>
<?php
if($shop_base['shop_type'] == 2)
{
    include $this->view->getTplPath() . '/' .'supplier_header.php';
    $ctl = 'Supplier_Goods';
}
else
{
    include $this->view->getTplPath() . '/' .'header.php';
    $ctl = 'Goods_Goods';
}

?>
<link rel="stylesheet"  type="text/css" href="<?= $this->view->css ?>/activity-base.css">
<link rel="stylesheet" type="text/css" href="<?= $this->view->css ?>/personalstores.css">
<link rel="stylesheet" type="text/css" href="<?= $this->view->css ?>/goods-detail.css"/>
<link rel="stylesheet" type="text/css" href="<?= $this->view->css ?>/Group-integral.css" />
<link rel="stylesheet" type="text/css" href="<?= $this->view->css ?>/base.css">
<link rel="stylesheet" type="text/css" href="<?= $this->view->css ?>/goods.css">
<script type="text/javascript" src="<?=$this->view->js?>/goods.js"></script>
<script type="text/javascript" src="<?=$this->view->js?>/common.js"></script>
<script type="text/javascript" src="<?=$this->view->js_com?>/plugins/jquery.toastr.min.js" charset="utf-8"></script>
<link href="<?= $this->view->css ?>/tips.css" rel="stylesheet">
<style>
    .wrap{width: 100% !important; margin: 0 auto;}
    .bbc-nav ul{width: 1200px !important;margin: 0 auto;}
    .head_cont{ width: 1200px !important;margin: 0 auto;}
    .ncsl-nav-banner{overflow: hidden;}
    .store-decoration-block-1{width: 100% !important; overflow: hidden; text-align: center;}
    .t_goods_bot{width: 1200px;margin: 0 auto;}
</style>
<style>
    .share_img:hover{cursor:pointer}
    .cl_content_ul li .tit{width:130px;height:36px;float:right;position:relative;border-radius:0;-webkit-transform-origin:10% 80%;-moz-transform-origin:10% 80%;-ms-transform-origin:10% 80%;-o-transform-origin:10% 80%;transform-origin:10% 80%}
    .cl_content_ul li .tit span{display:block;color:#fff}
    .goodslist_img3{overflow:hidden;width:160px;height:160px}
    .clearfix li{position:relative;margin-right:6px}
    .clearfix li:nth-child(5n){margin-right:0}
    .clearfix li .goodslist_img{margin-left:6px}
    .cr_xie_name{width:223px;height:40px!important;line-height:20px;overflow:hidden;/*position:absolute;left:0;top:250px;*/text-align:left;text-overflow:ellipsis;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical}
    /*.share_wrap1{position:absolute;left:0;top:295px}*/
    /*.share_wrap2{position:absolute;left:110px;top:295px}*/
    .share_wrap{margin-top: 4px;}
    .cr_xie li i{/*margin-top:105px;*/margin-left:8px}
    .cr_xie li .bbc_color{position:absolute;left:0;top:57%}
    .cr_xie li .shop_cr_xie_mon{margin-left:5px}
    /*.cr_xie li .list_padd .shopa{margin-left:7px}*/
    .cr_xie li .share_wrap .shopshare{margin-left:7px}
    .page{float:right;margin-top:20px;margin-right:370px}

    .con-div{display:inline-block;height: 30px;width: auto !important;text-align: center;margin-top:9px;}
    .one-key {float:left;background-color: #e45050;color:#fff;line-height: 30px;padding:0 30px;/*top:324px;*/}
    .one-key a{color:#fff;}
    .con-div>a{float: left;}
    .cr_xie_lia2{width:auto !important;height:28px !important;line-height: 28px;border:1px solid #ddd;padding: 0 6px;float: left;}
    .cr_xie_lia2 .cr_xie_lia2_span1{vertical-align: middle;}
    .list_padd>p.profit-ratio, .list_padd.img-b{margin-top: 4px;}
    .list_padd{padding: 0 10px;}
    .list_padd>p.profit-ratio{display: block;width: 100%;height: 45px;}
    .cr_xie li p .share{width:auto !important;}
</style>
<div style="width:1200px;position: relative;margin: 0 auto;">
    <div class="bbc-store-info">
        <div class="basic">
            <div class="displayed">
                <a href=""><?=$shop_base['shop_name']?></a>
                <span class="all-rate">
                    <div class="rating"><span style="width: <?=$shop_scores_percentage?>%"></span></div>
                    <em><?=$shop_scores_count?></em><em>分</em>
                </span>
            </div>
            <div class="sub">
                <div class="store-logo"><img src="<?=$shop_base['shop_logo']?>" alt="<?=$shop_base['shop_name']?>" title="<?=$shop_base['shop_name']?>"></div>
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
                        <div class="btns"><a href="index.php?ctl=Shop&met=goodsList&id=<?=$shop_id?>" class="goto">进店逛逛</a><a href="javascript:;" onclick="collectShop(<?=$shop_id?>)">收藏店铺</a></div>
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
                <img src="<?=$shop_base['shop_banner']?>" /></a>
            <?php }else{ ?>
                <img src="<?= $this->view->img ?>/shop_img.png"  /></a>
            <?php } ?>
        </div>
    </div>
    <div id="nav" class="bbc-nav">
        <ul>
            <li class="active9"><a href="index.php?ctl=Shop&met=index&id=<?=$shop_id?>"><span>店铺首页<i></i></span></a></li>
            <li class="active9"><a href="index.php?ctl=Shop&met=activity&id=<?=$shop_id?>"><span>优惠活动<i></i></span></a></li>
            <?php if($shop_nav['items']){ foreach ($shop_nav['items'] as $key => $value) {?>
                <li><a href="<?php if(!empty($value['url'])) echo $value['url'];else echo 'index.php?ctl=Shop&met=info&id='.$shop_id.'&nav_id='.$value['id']; ?>" <?php if($value['target']){?>target="_blank" <?php } ?>><span><?=$value['title']?><i></i></span></a></li>
            <?php }} ?>
        </ul>
    </div>
    <div class="clearfix">
        <div class="t_goods_bot clearfix">
            <div class="wrap clearfix">
                <div class="small-nav-wrap">
                    <div class="small-nav all-type has-arrow" style="height: unset;">
                        <div class="kind lf  curr">
                            <a href="<?=YLB_Registry::get('url')?>?ctl=Shop&met=goodsList&id=<?=$shop_id?>">
                                <i></i>
                                全部类目
                            </a>
                        </div>
                        <ul style="overflow: hidden">
                            <?php if($shop_cat_row['goods_cat']){ ?>
                                <?php foreach ($shop_cat_row['goods_cat'] as $key=>$value){ ?>
                                    <li class="lf <?php if(isset($value['curr'])){ ?> curr <?php }?>" style="margin:0 4px"><a href="<?=YLB_Registry::get('url')?>?ctl=Shop&met=goodsList&id=<?=$shop_id?>&shop_cat_id=<?=($value['shop_goods_cat_id'])?>"><?=($value['shop_goods_cat_name'])?></a></li>
                                <?php }?>
                            <?php }?>
                        </ul>
                    </div>
                    <?php if($shop_cat_row['goods_sub_cat']){ ?>
                        <div class="small-nav type-detail" >
                            <ul>
                                <?php foreach ($shop_cat_row['goods_sub_cat'] as $key=>$value){ ?>
                                    <li class="lf <?php if(isset($value['curr'])){ ?> curr <?php }?>"><a href="<?=YLB_Registry::get('url')?>?ctl=Shop&met=goodsList&id=<?=$shop_id?>&shop_cat_id=<?=($value['shop_goods_cat_id'])?>"><?=($value['shop_goods_cat_name'])?></a></li>
                                <?php }?>
                            </ul>
                        </div>
                    <?php }?>
                </div>
            </div>
            <div class="bbc-goodslist-bar">
                <ul class="bbc-array">
                    <li class="<?php if($order == 'common_sell_time'){?> sele <?php }?>"><a class="<?php if($sort == 'desc'){ echo 'down';}else{echo 'up'; }?>"
                                                                                            href="index.php?ctl=Shop&met=goodsList&id=<?=$shop_id?>&order=common_sell_time&sort=<?=$new_sort ? $new_sort:'desc';?>"><?=_('新品')?></a></li>
                    <li class="<?php if($order == 'common_price'){?> sele <?php }?>"><a class="<?php if($sort == 'desc'){ echo 'down';}else{echo 'up'; }?>"
                                                                                        href="index.php?ctl=Shop&met=goodsList&id=<?=$shop_id?>&order=common_price&sort=<?=$new_sort ? $new_sort:'desc';?>"><?=_('价格')?></a></li>
                    <li class="<?php if($order == 'common_salenum'){?> sele <?php }?>"><a class="<?php if($sort == 'desc'){ echo 'down';}else{echo 'up'; }?>"
                                                                                          href="index.php?ctl=Shop&met=goodsList&id=<?=$shop_id?>&order=common_salenum&sort=<?=$new_sort ? $new_sort:'desc';?>"><?=_('销量')?></a></li>
                    <li class="<?php if($order == 'common_collect'){?> sele <?php }?>"><a class="<?php if($sort == 'desc'){ echo 'down';}else{echo 'up'; }?>"
                                                                                          href="index.php?ctl=Shop&met=goodsList&id=<?=$shop_id?>&order=common_collect&sort=<?=$new_sort ? $new_sort:'desc';?>"><?=_('收藏')?></a></li>
                    <!--<li class=""><a href="index.php?ctl=Shop&met=goodsList&id=1&order=common_sell_time">人气</a></li>-->
                </ul>
                <div class="bbc-search">
                    <form id="" name="searchShop" method="get" action="index.php">
                        <input type="hidden" name="ctl" value="Shop">
                        <input type="hidden" name="met" value="goodsList">
                        <input type="hidden" name="id" value="<?=$shop_id?>">
                        <input type="text" class="buttext" name="search" value="" placeholder="<?=_('搜索店内商品')?>">
                        <a href="javascript:document.searchShop.submit();" class="ncbtn"><?=_('搜索')?></a>
                    </form>
                </div>
            </div>

            <!-- 商品列表 start -->
            <?php if($data['items']):?>
                <ul class="cr_xie clearfix" >
                    <?php foreach($data['items'] as $key => $val):?>
                        <li style="float:left">
                            <div class="goodslist_img">
                                <a href="<?=YLB_Registry::get('url')?>?ctl=<?=$ctl?>&met=goods&gid=<?=$val['goods_id']?>" target="_blank">
                                    <img src="<?=image_thumb($val['common_image'],220,220)?>" width="220" height="220"/>
                                </a>
                            </div>
                            <div class="list_padd orflow">
                                <span class="sub">减免前:<?=format_money($val['common_price'])?></span>
                                <span class="cr_xie_mon bbc_color shop_cr_xie_mon">
                                    <?php if($val['common_promotion_type'] > 0 && isset($val['promotion_price'])){?>
                                        <?=format_money($val['promotion_price'])?>
                                    <?php }else{?>
                                        <?=format_money($val['common_shared_price'])?>
                                    <?php }?>
                                </span>
                                <span class="cr_xie_amon"></span>
                            </div>
                            
                            <div class="list_padd img-b">
                                <a href="<?=YLB_Registry::get('url')?>?ctl=<?=$ctl?>&met=goods&gid=<?=$val['goods_id']?>" target="_blank" class="shopa cr_xie_name" target="_blank" title="<?=($val['common_name'])?>">
                                    <?=$val['common_name']?>
                                </a>


                                <?php if( $val['product_is_behalf_delivery']){?>

                                    <p class='share_wrap share_wrap1'><span class='share shopshare'>分享立减<u><?=format_money($val['common_share_price'])?></u></span></p>
                                    <?php if($val['common_is_promotion']){?>
                                        <p class='share_wrap share_wrap2'><span class='share'>立赚<u><?=format_money($val['common_promotion_price'])?></u></span></p>
                                    <?php }?>
                                    <!--0未参加活动 1惠抢购 2限时折扣 3手机专享 4新人优惠-->
                                    <?php if($val['common_promotion_type'] || $val['common_is_jia'] || $val['common_is_man']){?>
                                        <?php if($val['common_promotion_type']){?>
                                            <i><?=Goods_CommonModel::$promotionMap[$val['common_promotion_type']]?></i>
                                        <?php }?>
                                        <?php if($val['common_is_jia']){?>
                                            <i>加</i>
                                        <?php }?>
                                        <?php if($val['common_is_man']){?>
                                            <i>满</i>
                                        <?php }?>
                                    <?php }else{?>
                                        <div style='height:45px;'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
                                    <?php }?>
                                    <em>评分：
                                        <?php for($i = 0;$i<$val['goods_evaluation_good_star'];$i++){?>
                                            <img src="<?=$this->view->img?>/goods/star_y.png" alt="">
                                        <?php }?>
                                    </em>
                                    <img src="<?=$this->view->img?>/goods/share_n.png" alt="" class="share_n share share_img" prices='<?=json_encode($val["share_info"])?>' gid="<?=$val['goods_id']?>" gimg="<?=$val['common_image']?>" gname="<?=$val['common_name']?>" sum_prices="<?=$val['common_share_price']?>">
                                    <img src="<?=$this->view->img?>/goods/<?php if($val['is_favorite']){?>book_n.png<?php }else{?>book_s.png<?php }?>" alt="" class="book_s share_img collection_goods" id="coll_<?=(@$val['goods_id'])?>" data-flag="<?=$val['is_favorite']?>" data-goods_id="<?=$val['goods_id']?>">

                                <?php }else if($shop_base['shop_type'] == 2){?>
                                    <p class="profit-ratio">
                                        <span class="mar-r _letter-spacing"><span>利润比：</span></span>
                                        <span class="mar-b-1" style="color:#e45050;font-weight:bold;"> 0.00 % ~ 40.00 %</span>
                                    </p>
                                    <div class="con-div">
                                        <a onclick="collectGoods(26243)" class="cr_xie_lia2" id="coll_26243"><span class="cr_xie_lia2_span1 iconfont  icon-icoheart "></span><span class="cr_xie_lia2_span2">收藏</span></a><span class="one-key"><a href="javascript:;">一键代发</a></span>
                                    </div>



                                <?php }?>

                            </div>
                        </li>
                    <?php endforeach;?>
                </ul>
            <?php else: ?>
                <div class="no_account">
                    <img src="<?= $this->view->img ?>/ico_none.png"/>
                    <p><?= _('暂无符合条件的数据记录') ?></p>
                </div>
            <?php endif; ?>
            <!-- 商品列表 end  -->
        </div>
    </div>
    <div class="page">
        <div colspan="5"><?=($page_nav)?></div>
    </div>
</div>

<!--客服 S-->
<div class="bbuilder_code">
    <span class="bbc_codeArea"><img src="<?=YLB_Registry::get('base_url')?>/shop/api/qrcode.php?data=<?= urlencode(YLB_Registry::get('url')."?ctl=Shop&met=index&id=".$shop_base['shop_id'])?>"></span>
    <span class="bbc_arrow"></span>
    <div class="bbc_guide_con">
        <span>
            <div class="service-list1 service-list2" store_id="8" store_name="12312312发发">
                <dl>
                    <dt><?=_('售前客服：')?></dt>
                    <?php if(!empty($service['pre'])){?>
                        <?php foreach($service['pre'] as $key=>$val){ ?>
                            <?php if(!empty($val['number'])){?>
                                <dd>
                                    <span c_name="<?=$val['name']?>" member_id="9"><?=$val['tool']?></span>
                                </dd>
                            <?php }?>
                        <?php }?>
                    <?php }?>
                </dl>
                <dl>
                    <dt><?=_('售后客服：')?></dt>
                    <?php if(!empty($service['after'])){?>
                        <?php foreach($service['after'] as $key=>$val){ ?>
                            <?php if(!empty($val['number'])){?>
                                <dd>
                                    <span c_name="<?=$val['name']?>" member_id="9"><?=$val['tool']?></span>
                                </dd>
                            <?php }?>
                        <?php }?>
                    <?php }?>
                </dl>
                <dl class="workingtime">
                    <dt><?=_('工作时间：')?></dt>
                    <?php if($shop_base['shop_workingtime']){?>
                        <dd>
                            <p><?=($shop_base['shop_workingtime'])?></p>
                        </dd>
                    <?php }?>
                </dl>
            </div>
        </span>
    </div>
</div>
<!--客服 E-->

<!--立即分享 S-->
<div id="sharecover" style="display:none">
    <span class="mask"></span>
</div>
<div id="code">
    <div class="close">
        <span>分享有礼</span>
        <a href="javascript:void(0)" id="closebt">
            <img src="<?=$this->view->img?>/close.png" alt="">
        </a>
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

        <p>我要分享到:</p>
        <div class="share_c">
            <div class="bdsharebuttonbox" data-tag="share_1">
                <span style="display:none" id="gid"></span>
                <span style="display:none" id="gimg"></span>
                <span style="display:none" id="gname"></span>
                <span style="display:none" id="sum_prices"></span>
                <div class="share_d">
                    <a class="bds_share bds_sqq" data-cmd="sqq"></a>
                    <p>QQ好友</p>
                    <p>立减<span id="share_sqq"></span>元</p>
                </div>
                <div class="share_d">
                    <a class="bds_share bds_qzone" data-cmd="qzone"></a>
                    <p>QQ空间</p>
                    <p>立减<span id="share_qzone"></span>元</p>
                </div>
                <div class="share_d">
                    <a class="bds_share bds_weixin" data-cmd="weixin"></a>
                    <p>微信好友</p>
                    <p>立减<span id="share_weixin"></span>元</p>
                </div>
                <div class="share_d">
                    <a class="bds_share bds_weixin_timeline" data-cmd="bds_weixin_timeline"></a>
                    <p>微信朋友圈</p>
                    <p>立减<span id="share_weixin_timeline"></span>元</p>
                </div>
                <div class="share_d">
                    <a class="bds_share bds_tsina" data-cmd="tsina"></a>
                    <p>新浪微博</p>
                    <p>立减 <span id="share_tsina"></span>元</p>
                </div>
                <div class="share_d more">
                    <a class="bds_more" ></a><p>分享越多</p><p>立赚越多</p>
                </div>
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

            <script>
                function GetQueryString(name)
                {
                    var reg = new RegExp("(^|&)"+ name +"=([^&]*)(&|$)");
                    var r = window.location.search.substr(1).match(reg);
                    if(r!=null) return  unescape(r[2]); return null;
                }
                function SetShareUrl(cmd, config) {
                    var gid = $('#gid').html();
                    var img_url = $('#gimg').html();
                    var sum_prices = $('#sum_prices').html();
                    var gname = $('#gname').html();
                    config.bdDesc = '淘尚168商城';
                    config.bdText = '分享最高可减'+sum_prices+'--'+gname;
                    config.bdPic = img_url;
                    config.bdUrl = "http://www.taoshang168.com/taoshangbbc/shop/index.php?ctl=Goods_Goods&met=goods&gid=" + gid + '&suid=' + <?=Perm::$userId?>;
                    return config;
                }
                window._bd_share_config = {
                    common : {
                        onBeforeClick: SetShareUrl,
                    },
                    share : [{
                        "bdSize" : 24,
                        "bdCustomStyle":'<?= $this->view->css ?>/bdshare.css'
                    }],
                    slide : [{
                        bdImg : 0,
                        bdPos : "left",
                        bdTop : 100
                    }],
                }
                with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='http://bdimg.share.baidu.com/static/api/js/share.js?cdnversion='+~(-new Date()/36e5)];
            </script>

        </div>
        <div class="share_xx"></div>
        <div class="sharefoot">
            <?php if($goods_detail['goods_base']['share_info']['is_promotion']){?>
                <div class="s_ljz">
                    <span class="sp1">1.分享立减：</span>
                    <span  class="sp2">将商品链接分享至相关平台可获得相应减免额度<span class="lj_xq" >（详情）</span></span>
                    <span class="ljl red_line"></span>
                </div>
                <div class="s_ljz">
                    <span  class="sp1">2.分享立赚：</span>
                    <?/*= $goods_detail['goods_base']['share_info']['promotion_total_price'] */?>
                    <span  class="sp2 ">将商品链接分享至相关平台可获得相应点击推广金<span class="lz_xq" >（详情）</span></span>
                    <span class="lzl red_line"></span>
                </div>
            <?php }else{ ?>
                <div>
                    <span class="sp1">分享立减：</span><span  class="sp2">将商品链接分享至相关平台可获得相应减免额度<span class="lj_xq" >（详情）</span></span></div>
            <?php } ?>
        </div>

    </div>
</div>
<script>
    $(function(){
        $('.share').on('click',function(){
            var prices = JSON.parse($(this).attr('prices'));
            var sum_prices = $(this).attr('sum_prices');
            var gid = $(this).attr('gid');
            var gimg = $(this).attr('gimg');
            var gname = $(this).attr('gname');
            $('#share_sqq').html(prices.sqq);
            $('#share_qzone').html(prices.qzone);
            $('#share_weixin').html(prices.weixin);
            $('#share_weixin_timeline').html(prices.weixin_timeline);
            $('#share_tsina').html(prices.tsina);
            $('#gid').html(gid);
            $('#gimg').html(gimg);
            $('#gname').html(gname);
            $('#sum_prices').html(sum_prices);

            $("#code").center();
            $('#sharecover').show();
            var top = document.body.scrollTop;
            $("#code").css({top:top+300})
            $("#code").fadeIn();
        });
        $('#closebt').on('click',function(){
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
    })
</script>
<!--立即分享 E-->

<script>
    //收藏 取消收藏
    $('.collection_goods').bind('click',function(){
        if ($.cookie('key')) {
            var flag = $(this).data('flag');
            var goods_id = $(this).data('goods_id');
            if (flag == 1) {
                $.post(SITE_URL + '?ctl=Goods_Goods&met=canleCollectGoods&typ=json', {
                    goods_id: goods_id
                }, function(data) {
                    if (data.status == 200) {
                        Public.tips.success('取消收藏成功!');
                        $("#coll_" + goods_id).attr('src', '<?=$this->view->img?>/goods/book_s.png');
                        $("#coll_" + goods_id).data('flag', 0)
                    } else {
                        Public.tips.error(data.data.msg)
                    }
                })
            } else {
                $.post(SITE_URL + '?ctl=Goods_Goods&met=collectGoods&typ=json', {
                    goods_id: goods_id
                }, function(data) {
                    if (data.status == 200) {
                        Public.tips.success('收藏成功!');
                        $("#coll_" + goods_id).attr('src', '<?=$this->view->img?>/goods/book_n.png');
                        $("#coll_" + goods_id).data('flag', 1)
                    } else {
                        Public.tips.error(data.data.msg)
                    }
                })
            }
        } else {
            $("#login_content").show()
        }
    });

    //固定导航栏 start
    $(window).scroll(function(){
        if($(window).scrollTop() > ( $(".small-nav-wrap").outerHeight(true)) + $(".small-nav-wrap").offset().top){
            $(".fix-nav").css({"display":"block"});
        }else{
            $(".fix-nav").css({"display":"none"});
        }
    });

    $(function(){
        // 固定导航栏  start
        $(".fix-nav-kinds").mouseover(function(){
            $(".silde-menu-ul").addClass("block");
        }).mouseout(function(){
            $(".silde-menu-ul").removeClass("block");
        });
        $(".fix-nav-kinds").click(function(){
            $(".fix-nav-bottom").removeClass("block");
            $(".fix-nav-1200 .nav-1200-right li").removeClass("curr");
        });
        $(".fix-nav .fix-nav-1200 li").click(function(){
            $(this).addClass("curr");
            $(this).siblings(".curr").removeClass("curr");
            $(".fix-nav-bottom").addClass("block");
        });
        $(".fix-nav-bottom li").click(function(){
            $(this).addClass("curr");
            $(this).siblings(".curr").removeClass("curr");
        });
        //判断 什么时候有 fix-nav-bottom  start
        if($(".fix-nav .nav-1200-right li").hasClass("curr")){
            $(".fix-nav-bottom").addClass("block");
        }else{
            $(".fix-nav-bottom").removeClass("block");
        };
        //判断 什么时候有 fix-nav-bottom   end
        // 固定导航栏  end

        $(".kind").click(function(){
            $(this).addClass("curr");
            $(this).siblings("ul").children(".curr").removeClass("curr");
            $(".type-detail").removeClass("block");
        });

        $(".all-type li").click(function(){
            $(this).addClass("curr");
            $(this).siblings(".curr").removeClass("curr");
            $(this).parent("ul").siblings(".curr").removeClass("curr");
            $(".type-detail").addClass("block");
        });

        $(".type-detail li").click(function(){
            $(this).addClass("curr");
            $(this).siblings(".curr").removeClass("curr");
        });
        //判断 什么时候有 type-detail   start
        if($(".type-detail li").hasClass("curr")){
            $(".type-detail").addClass("block");
        }else{
            $(".type-detail").removeClass("block");
        };
        //判断 什么时候有 type-detail    end
    });
</script>

<?php
include $this->view->getTplPath() . '/' . 'footer.php';
?>
