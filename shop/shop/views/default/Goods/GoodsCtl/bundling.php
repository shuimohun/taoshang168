<?php if (!defined('ROOT_PATH'))
{
    exit('No Permission');
} ?>
<?php
include $this->view->getTplPath() . '/' . 'header.php';
?>
<link rel="stylesheet" type="text/css" href="<?= $this->view->css ?>/goods-detail.css"/>
<link rel="stylesheet" type="text/css" href="<?= $this->view->css ?>/Group-integral.css"/>
<script src="<?=$this->view->js_com?>/plugins/jquery.slideBox.min.js" type="text/javascript"></script>
<script src="<?= $this->view->js_com ?>/sppl.js"></script>
<script src="<?= $this->view->js_com ?>/plugins/jquery.imagezoom.min.js"></script>
<script type="text/javascript" src="<?=$this->view->js?>/common.js"></script>
<link href="<?= $this->view->css ?>/tips.css" rel="stylesheet">
<link href="<?= $this->view->css ?>/login.css" rel="stylesheet">
<script type="text/javascript" src="<?=$this->view->js_com?>/plugins/jquery.toastr.min.js" charset="utf-8"></script>
<script type="text/javascript" src="<?=$this->view->js_com?>/plugins/share.js" charset="utf-8"></script>
<style>
    div.zoomDiv{z-index:999;position:absolute;top:0px;left:0px;width:200px;height:200px;background:#ffffff;border:1px solid #CCCCCC;display:none;text-align:center;overflow:hidden;}
    div.zoomMask{position:absolute;background:url("<?=$this->view->img?>/mask.png") repeat scroll 0 0 transparent;cursor:move;z-index:1;}

    .share_cart{
        border:1px solid #c51e1e;
        font-size:12px;
        color:#c51e1e;
        float:left;
        margin-left: 10px;
        margin-top: 3px;
    }
    .share_car u{
        text-decoration: none;
        background-color: #c51e1e;
        color: #fff;
    }
    .ev_left{width:968px;height:auto !important;display: block;}
    .goods_det_about li a{padding:0 20px;}
</style>
    <div class="bgcolor">
        <div class="wrapper">
            <div class="t_goods_detail">
                <div class="t_goods_ev clearfix">
                    <?php if($data){?>
                        <?php  if(!empty($data['goods_list'])){?>
                            <div class="ev_left">
                                <div class="ev_left_top">
                                    <span class="goods-title"><?=$data['bundling_name']?></span>
                                    <div class="goods-group-wrap orflow">
                                        <ul class="goods-group-list orflow">
                                            <?php foreach($data['goods_list'] as $v){?>
                                                <li class="goods-group-item lf orflow">
                                                    <div class="group-contain rt">
                                                        <a href="index.php?ctl=Goods_Goods&met=goods&gid=<?php echo $v['goods_id']; ?>" target="_blank">
                                                            <div class="img-center">
                                                                <img src="<?php echo $v['goods_image'];?>" alt="">
                                                            </div>
                                                            <div class="goods-detail">
                                                                <?=$v['goods_name'];?>
                                                            </div>
                                                            <div class="price-wrap">
                                                                <span class="new-price">￥<?=$v['bundling_goods_price'] ?></span>
                                                                <span class="old-price">￥<?=$v['goods_price'] ?></span>
                                                            </div>
                                                        </a>
                                                    </div>
                                                </li>
                                            <?php } ?>
                                        </ul>
                                    </div>
                                    <div class="aside orflow">
                                        <div class="share-container lf">
                                            <div class="share-wrap clearfix">
                                                <div class="share orflow">
                                                    <span>合计立减</span>
                                                    <span class="save">￥<?=$data['share_info']['share_total_price']?></span>
                                                </div>
                                            </div>
                                            <?php if($data['share_info']['is_promotion']){?>
                                                <div class="share-wrap clearfix">
                                                    <div class="share orflow">
                                                        <span>合计立赚</span>
                                                        <span class="save">￥<?=$data['share_info']['promotion_total_price']?></span>
                                                    </div>
                                                </div>
                                            <?php }?>
                                        </div>
                                        <div class="group-container lf">
                                            <div class="group-price-wrap">
                                                套装优惠价：<span class="group-price">￥<?=$data['bundling_discount_price']?></span>
                                            </div>
                                            <div class="old-price-wrap">
                                                套装原价：<span class="old-price">￥<?=$data['old_total_price']?></span>
                                            </div>
                                        </div>
                                        <div class="total-save">
                                            合计节省：<span>￥<?=$data['old_total_price']-$data['bundling_discount_price']?></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="ev_left_bottom">
                                    <div class="li-item">
                                        <span class="choose-need lf">数量：</span>
                                        <div class="choose-body">
                                            <ul class="opration orflow lf">
                                                <li class="decrease lf">
                                                    -
                                                </li>
                                                <li class="opration-num lf" data-max="<?=$data['goods_stock']?>">1</li>
                                                <li class="add lf">
                                                    +
                                                </li>
                                            </ul>
                                            <?php if($data['bunlding_limit']){ ?>
                                                <p class="tip lf">限购<span><?=$data['bunlding_limit']?></span> 套</p>
                                            <?php } ?>
                                            <?php if($data['share_info']['time_down'] ){ ?>
                                                <i class="lf">|</i>
                                                <div class="share lf fnTimeCountDown" data-end="<?=$data['share_info']['time_down'] ?>">
                                                    下一轮分享  <span class="hour">00</span><strong>:</strong>
                                                    <span class="mini">00</span><strong>:</strong>
                                                    <span class="sec">00</span>
                                                </div>
                                            <?php } ?>
                                        </div>
                                    </div>

                                    <div class="li-item">
                                        <span class="choose-need lf">购买方式：</span>
                                        <div class="choose-body">
                                            <div class="buy-btn btn" bl_id="<?php echo $data['id']?>">立即购买
                                                <span class="price">
                                                    ￥<span class="d_price" style="font-weight: normal;color:#d80202;">
                                                        <?php if($data['share_info']['price']){?>
                                                            <?=$data['bundling_discount_price']-$data['share_info']['price']['price']?>
                                                        <?php }else{?>
                                                            <?=$data['bundling_discount_price']?>
                                                        <?php }?>
                                                    </span>
                                                </span>
                                            </div>
                                            <div class="add-car-btn btn"  bl_id="<?php echo $data['id']?>">加入购物车</div>
                                            <a href="javascript:void(0);"  class="ncbtn ncbtn-grapefruit btn share-btn" nctype="share" data-type="1" data-id="<?php echo $data['id']?>" data-name="<?php echo $data['bundling_name'];?>" data-pic="<?=$data['goods_list'][0]['goods_image'];?>" data-price="<?php echo $data['share_info']['share_total_price']?>"  bl_id="<?php echo $data['id']?>" data-shared='<?= json_encode($data['share_info']['price']['share_base'])?>' data-sqq="<?php echo $data['share_info']['sqq']?>" data-qzone="<?php echo $data['share_info']['qzone']?>" data-weixin="<?php echo $data['share_info']['weixin']?>" data-weixin_timeline="<?php echo $data['share_info']['weixin_timeline']?>" data-tsina="<?php echo $data['share_info']['tsina']?>">
                                                <i class="iconfont icon-share"></i>分享购买
                                                <span class="price">￥
                                                    <span class="f_price" style="font-weight: normal;color:#fff;">
                                                        <?=$data['bundling_discount_price']-$data['share_info']['share_total_price']?>
                                                    </span>
                                                </span>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="li-item">
                                        <div class="package-price">
                                            <?php if($data['bundling_freight_choose']==0){ ?>
                                            快递费：<span>￥<?=$data['bundling_freight']?></span>
                                            <?php }?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php }?>
                    <?php }?>
                    <div class="ev_right ">
                        <div class="ev_right_pad ">
                            <div class="divimg ">
                                <?php if(!empty($shop_detail['shop_logo']))
                                {
                                    $shop_logo = $shop_detail['shop_logo'];
                                }else{
                                    $shop_logo =$this->web['shop_logo']; }
                                ?>

                                <img src="<?=($shop_logo)?>">
                            </div>
                            <div class="txttitle clearfix ">
                                <p>
                                    <a class="store-names" href="<?= YLB_Registry::get('url') ?>?ctl=Shop&met=index&typ=e&id=<?=($shop_detail['shop_id'])?>"><?=($shop_detail['shop_name'])?></a>
                                    <?php if(Web_ConfigModel::value('im_statu')==1 ){?>
                                        <a href="javascript:;" class="chat-enter" rel="<?=$shop_detail['user_name']?>"><i class="iconfont icon-btncomment"></i></a>
                                    <?php }?>
                                </p>
                                <?php if($shop_detail['shop_self_support'] == 'true'){?>
                                    <div class="bbc_btns"><?=_('平台自营')?></div>
                                <?php }?>
                            </div>

                            <!-- 品牌-->
                            <?php if($shop_detail['shop_self_support'] == 'false'){?>
                                <div class="brandself ">
                                    <ul class="shop_score clearfix ">
                                        <li><?=_('店铺动态评分')?></li>
                                        <li><?=_('同行业相比')?></li>
                                    </ul>
                                    <ul class="shop_score_content clearfix ">
                                        <li>
                                            <span><?=_('描述相符：')?><?=number_format($shop_detail['shop_desc_scores'],2,'.','')?></span>
                                            <span class="high_than bbc_bg">
                                        <?php if($shop_detail['com_desc_scores'] >= 0): ?><i class="iconfont  icon-gaoyu rel_top1"></i>
                                            <?=_('高于')?><?php else: ?><i class="iconfont  icon-diyu rel_top1"></i><?=_('低于')?><?php endif; ?>
                                    </span>
                                            <em class="bbc_color"><?=number_format(abs($shop_detail['com_desc_scores']),2,'.','')?><?=_('%')?></em>
                                        </li>
                                        <li>
                                            <span><?=_('服务态度：')?><?=number_format($shop_detail['shop_service_scores'],2,'.','')?></span>
                                            <span class="high_than bbc_bg">
                                        <?php if($shop_detail['com_service_scores'] >= 0): ?><i class="iconfont  icon-gaoyu rel_top1"></i><?=_('高于')?><?php else: ?><i class="iconfont  icon-diyu rel_top1"></i><?=_('低于')?><?php endif; ?>
                                    </span>
                                            <em  class="bbc_color"><?=number_format(abs($shop_detail['com_service_scores']),2,'.','')?><?=_('%')?></em>
                                        </li>
                                        <li>
                                            <span><?=_('发货速度：')?><?=number_format($shop_detail['shop_send_scores'],2,'.','')?></span>
                                            <span class="high_than bbc_bg">
                                        <?php if($shop_detail['com_send_scores'] >= 0): ?><i class="iconfont  icon-gaoyu rel_top1"></i><?=_('高于')?><?php else: ?><i class="iconfont  icon-diyu rel_top1"></i><?=_('低于')?><?php endif; ?>
                                    </span>
                                            <em  class="bbc_color"><?=number_format(abs($shop_detail['com_send_scores']),2,'.','')?><?=_('%')?></em>
                                        </li>
                                    </ul>
                                </div>

                                <div class="shop_address">
                                    <?=_('所 在 地 ：')?><?=($shop_detail['shop_region'])?>
                                </div>

                                <div class="follow_shop ">
                                    <a href="<?= YLB_Registry::get('url') ?>?ctl=Shop&met=index&typ=e&id=<?=($shop_detail['shop_id'])?>" target="_blank" class="shop_enter"><?=_('进入店铺')?></a>
                                    <a onclick="collectShop(<?=($shop_detail['shop_id'])?>)" class="shop_save"><?=_('收藏店铺')?></a>
                                </div>

                            <?php }?>

                            <?php if(isset($shop_detail['contract']) && $shop_detail['contract'] ):?>
                                <span class="fwzc "><?=_('服务支持：')?></span>
                                <ul class="ev_right_ul clearfix ">
                                    <?php foreach($shop_detail['contract'] as $sckey => $scval):?>
                                        <a href="<?=($scval['contract_type_url'])?>"><li><i><img src="<?=image_thumb($scval['contract_type_logo'],22,22)?>"/></i>&nbsp;&nbsp;&nbsp;<?=($scval['contract_type_name'])?></li></a>
                                        <?php
                                    endforeach;
                                    ?>
                                </ul>
                                <?php
                            endif;
                            ?>
                        </div>
                        <!-- 自营 -->
                        <?php if($shop_detail['shop_self_support'] == 'true'){?>
                            <div class="look_again "><?=_('看了又看')?></div>
                            <ul class="look_again_goods clearfix ">
                                <?php if (!empty($data_recommon_goods))
                                {
                                    foreach ($data_recommon_goods as $key_recommon => $value_recommon)
                                    {
                                        ?>
                                        <li>
                                            <a target="_blank" href="<?= YLB_Registry::get('url') ?>?ctl=Goods_Goods&met=goods&type=goods&gid=<?=($value_recommon['goods_id'])?>">
                                                <img src="<?= $value_recommon['common_image'] ?>"/>
                                                <h5 class="bbc_color"><?= format_money($value_recommon['common_shared_price']) ?></h5>
                                            </a>
                                        </li>
                                        <?php
                                    }
                                }
                                ?>
                            </ul>
                        <?php }?>
                    </div>
                </div>
            </div>
            <div class="ewm" style="">
                <img src="<?=YLB_Registry::get('base_url')?>/shop/api/qrcode.php?data=<?=urlencode(YLB_Registry::get('shop_wap_url')."/tmpl/product_detail.html?goods_id=".$goods_detail['goods_base']['goods_id'])?>" width="120" height="120"/>
                <p>扫描二维码</p><p>手机购物更实惠</p>
            </div>
        </div>
    </div>
<div class="wrap">
    <div class="t_goods_bot clearfix ">
        <div class="t_goods_bot_left ">

            <?php if($shop_detail['shop_self_support'] == 'false'){?>

                <div class="goods_classify">
                    <h4><?=($shop_detail['shop_name'])?>
                        <?php if($shop_detail['shop_qq']){?>
                        <a rel="1" target="_blank" href="http://wpa.qq.com/msgrd?v=3&uin=<?=$shop_detail['shop_qq']?>&site=qq&menu=yes" title="QQ: <?=$shop_detail['shop_qq']?>"><img border="0" src="http://wpa.qq.com/pa?p=2:<?=$shop_detail['shop_qq']?>:52&amp;r=0.22914223582483828" style=" vertical-align: middle;"></a><?php }?><?php if($shop_detail['shop_ww']){?>
                        <a rel="2"  target="_blank" href='http://www.taobao.com/webww/ww.php?ver=3&touid=<?=$shop_detail['shop_ww']?>&siteid=cntaobao&status=2&charset=utf-8'><img border="0" src='http://amos.alicdn.com/realonline.aw?v=2&uid=<?=$shop_detail['shop_ww']?>&site=cntaobao&s=2&charset=utf-8' alt="<?=_('点击这里给我发消息')?>" style=" vertical-align: middle;"></a><?php }?></h4>

                    <div class="service-list1" store_id="8" store_name="<?=($shop_detail['shop_name'])?>">
                        <?php if(!empty($service['pre'])){?>
                            <dl>
                                <dt><?=_('售前客服：')?></dt>

                                <?php foreach($service['pre'] as $key=>$val){ ?>
                                    <?php if(!empty($val['number'])){?>
                                        <dd><span><?=$val['name']?></span><span>
									<span c_name="<?=$val['name']?>" member_id="9"><?=$val['tool']?></span>
									</span></dd>
                                    <?php }?>
                                <?php }?>
                            </dl>
                        <?php }?>
                        <?php if(!empty($service['after'])){?>
                            <dl>
                                <dt><?=_('售后客服：')?></dt>
                                <?php foreach($service['after'] as $key=>$val){ ?>
                                    <?php if(!empty($val['number'])){?>
                                        <dd><span><?=$val['name']?></span><span>
									<span c_name="<?=$val['name']?>" member_id="9"><?=$val['tool']?></span>
									</span></dd>
                                    <?php }?>
                                <?php }?>

                            </dl>
                        <?php }?>
                        <?php if($shop_detail['shop_workingtime']){?>
                            <dl class="workingtime">
                                <dt><?=_('工作时间：')?></dt>
                                <dd>
                                    <p><?=($shop_detail['shop_workingtime'])?></p>
                                </dd>
                            </dl>
                        <?php }?>
                    </div>
                </div>

            <?php }?>

            <div class="goods_classify ">
                <h4><?=_('商品分类')?></h4>
                <p class="classify_like">
                    <a href="<?= YLB_Registry::get('url') ?>?ctl=Shop&met=goodsList&id=<?=$shop_detail['shop_id'];?>&order=common_sell_time "><?=_('按新品')?></a>
                    <a href="<?= YLB_Registry::get('url') ?>?ctl=Shop&met=goodsList&id=<?=$shop_detail['shop_id'];?>&order=common_price "><?=_('按价格')?></a>
                    <a href="<?= YLB_Registry::get('url') ?>?ctl=Shop&met=goodsList&id=<?=$shop_detail['shop_id'];?>&order=common_salenum "><?=_('按销量')?></a>
                    <a href="<?= YLB_Registry::get('url') ?>?ctl=Shop&met=goodsList&id=<?=$shop_detail['shop_id'];?>&order=common_collect"><?=_('按人气')?></a></p>

                <p class="classify_ser"><input type="text" name="searchGoodsList" placeholder="<?=_('搜索店内商品')?>"><a  id="searchGoodsList"><?=_('搜索')?></a></p>
                <ul class="ser_lists ">
                </ul>
            </div>


            <div class="goods_ranking ">
                <h4><?=_('商品排行')?></h4>
                <p class="selling"><a ><?=_('热销商品排行')?></a><a><?=_('热门收藏排行')?></a></p>
                <ul id="hot_salle">
                    <?php if (!empty($data_salle))
                    {
                        foreach ($data_salle as $key_salle => $value_salle)
                        {?>
                            <li class="clearfix">
                                <a target="_blank" href="<?= YLB_Registry::get('url') ?>?ctl=Goods_Goods&met=goods&type=goods&gid=<?= ($value_salle['goods_id']) ?>" class="selling_goods_img"><img src="<?= $value_salle['common_image'] ?>"></a>
                                <p>
                                    <a target="_blank" href="<?= YLB_Registry::get('url') ?>?ctl=Goods_Goods&met=goods&type=goods&gid=<?= ($value_salle['goods_id']) ?>"><?= $value_salle['common_name'] ?></a>
                                    <span class="bbc_color"><?= format_money($value_salle['common_price']) ?></span>
                                    <span>
                                                <i></i><?=_('出售：')?>
                                        <i class="num_style"><?= $value_salle['common_salenum'] ?></i> <?=_('件')?>
                                           </span>
                                </p>
                                <span class="share_cart">
                                        立减
                                         <u>￥<?= $value_salle['common_share_price'] ?></u>
                                     </span>
                                <span class="share_cart">
                                         立赚
                                         <u>￥<?= $value_salle['common_promotion_price'] ?></u>
                                     </span>
                            </li>
                            <?php
                        }
                    } ?>
                </ul>
                <ul style="display: none;" id="hot_collect">
                    <?php if (!empty($data_collect))
                    {
                        foreach ($data_collect as $key_collect => $value_collect)
                        {
                            ?>
                            <li class="clearfix">
                                <a target="_blank" href="<?= YLB_Registry::get('url') ?>?ctl=Goods_Goods&met=goods&type=goods&gid=<?= $value_collect['goods_id'] ?>" class="selling_goods_img"><img src="<?= $value_collect['common_image'] ?>"></a>
                                <p>
                                    <a target="_blank" href="<?= YLB_Registry::get('url') ?>?ctl=Goods_Goods&met=goods&type=goods&gid=<?= $value_collect['goods_id'] ?>"><?= $value_collect['common_name'] ?></a>
                                    <span class="bbc_color"><?= format_money($value_collect['common_price']) ?></span>
                                    <span>
                                            <i></i><?=_('收藏人气：')?>
                                        <i class="num_style"><?= $value_collect['common_salenum'] ?></i>
                                        </span>
                                </p>
                                <span class="share_cart">
                                        立减
                                         <u>￥<?= $value_collect['common_share_price'] ?></u>
                                     </span>
                                <span class="share_cart">
                                         立赚
                                         <u>￥<?= $value_collect['common_promotion_price'] ?></u>
                                     </span>

                            </li>
                            <?php
                        }
                    } ?>
                </ul>
                <a target="_blank" href="<?= YLB_Registry::get('url') ?>?ctl=Shop&met=goodsList&id=<?=($shop_detail['shop_id'])?>"><p class="look_other_goods bbc_btns"><?=_('查看本店其他商品')?></p></a>
            </div>


        </div>
        <div name="elist" id="elist"></div>
        <div class="t_goods_bot_right ">

            <ul class="goods_det_about clearfix border_top">
                <?php foreach ($data['goods_list'] as $key=>$value){?>
                    <li><a class="xq" data-cid="<?=$value['common_id']?>" data-gid="<?=$value['goods_id']?>" href="javascript:void(0);"><?=$value['goods_name']?></a></li>
                <?php }?>
            </ul>

            <ul class="goods_det_about_cont">
                <!-- 详细-->
                <?php foreach ($data['goods_list'] as $key=>$value){?>
                    <li class="xq_1 xq<?=$value['goods_id']?> hide" >

                    </li>
                <?php }?>
            </ul>

        </div>
    </div>
</div>

<!-- 登录遮罩层 -->
<div id="login_content" style="display:none;">
    <div>
        <div class="login-form">
            <div class="login-tab login-tab-r">
                <a href="javascript:void(0)" class="checked">
                    账户登录
                </a>
            </div>
            <div class="login-box" style="visibility: visible;">
                <div class="mt tab-h">
                </div>
                <div class="msg-wrap" style="display:none;">
                    <div class="msg-error"></div>
                </div>
                <div class="mc">
                    <div class="form">
                        <form id="formlogin" method="post" onsubmit="return false;">

                            <div class="item item-fore1">
                                <label for="loginname" class="login-label name-label"></label>
                                <input id="loginname" class="lo_user_account" type="text" class="itxt" name="loginname" tabindex="1" autocomplete="off" placeholder="邮箱/用户名/已验证手机">
                                <span class="clear-btn"></span>
                            </div>
                            <div id="entry" class="item item-fore2" style="visibility: visible;">
                                <label class="login-label pwd-label" for="nloginpwd"></label>
                                <input type="password" class="lo_user_password" id="nloginpwd" name="nloginpwd" class="itxt itxt-error" tabindex="2" autocomplete="off" placeholder="密码">
                                <span class="clear-btn"></span>
                                <span class="capslock" style="display: none;"><b></b>大小写锁定已打开</span>
                            </div>
                            <div class="item item-fore5">
                                <div class="login-btn">
                                    <a href="javascript:;" onclick="loginSubmit()" class="btn-img btn-entry" id="loginSubmit" tabindex="6">登&nbsp;&nbsp;&nbsp;&nbsp;录</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="coagent" style="display: block; visibility: visible;">

                <ul>
                    <li><a href="<?=YLB_Registry::get('ucenter_api_url')?>?ctl=Login&act=reset">忘记密码</a></li>
                    <li class="extra-r">
                        <div>
                            <div class="regist-link pa"><a href="<?=YLB_Registry::get('url')?>?ctl=Login&met=reg" target="_blank"><b></b>立即注册</a></div>
                        </div>
                    </li>
                </ul>
            </div>
            <a class="btn-close">×</a>
        </div>
    </div>
    <span class="mask"></span>
</div>

<!--分享立减Zhenzh-->
<div id="sharecover" style="display:none;">
    <span class="mask"></span>
</div>
<div id="code">
    <div class="close">
        <span>分享有礼</span>
        <a href="javascript:void(0)" id="closebt">
            <img src="<?= $this->view->img ?>/close.png">
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

        <p>我要分享到：</p>
        <div class="share_c">
            <div class="bdsharebuttonbox" data-tag="share_1">
                <div class="share_d">
                    <a class="bds_share bds_sqq " data-cmd="sqq"></a>
                    <p>QQ好友</p>
                    <p id="sqq"></p>
                </div>
                <div class="share_d"><a class="bds_share bds_qzone" data-cmd="qzone" ></a>
                    <p>QQ空间</p>
                    <p id="qzone"></p>
                </div>
                <div class="share_d"><a class="bds_share bds_weixin" data-cmd="weixin"></a>
                    <p>微信好友</p>
                    <p id="weixin"></p>
                </div>
                <div class="share_d"><a class="bds_share bds_weixin_timeline" data-cmd="weixin"></a>
                    <p>微信朋友圈</p>
                    <p id="weixin_timeline"></p>
                </div>
                <div class="share_d"><a class="bds_share bds_tsina" data-cmd="tsina"></a>
                    <p>新浪微博</p>
                    <p id="tsina"></p>
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
        </div>
        <div class="share_xx"></div>
        <div class="sharefoot">
            <?php if($data['share_info']['is_promotion']){?>
                <div class="s_ljz">
                    <span class="sp1">1.分享立减：</span>
                    <span  class="sp2"><span class="lj_xq" ><?= $data['share_info']['share_total_price'].'元'?>（详情）</span></span>
                    <span class="ljl red_line"></span>
                </div>
                <div class="s_ljz">
                    <span  class="sp1">2.分享立赚：</span>
                    <span  class="sp2 "><span class="lz_xq" ><?= $data['share_info']['promotion_total_price'].'元' ?>（详情）</span></span>
                    <span class="lzl red_line"></span>
                </div>
            <?php }else{ ?>
                <div>
                    <span class="sp1">分享立减：</span><span  class="sp2"><span class="lj_xq" ><?= $data['share_info']['share_total_price'] ?>（详情）</span></span></div>
            <?php } ?>
        </div>
    </div>
</div>
<!--记录分享立减Zhenzh-->

<script>
    //激活分享
    var bid = Public.getQueryString("bid");
    var suid = Public.getQueryString("suid");
    var from = Public.getQueryString("from");
    var hash = location.hash;
    if(suid > 0 && bid > 0 && (hash != "" || from)){
        $.ajax({
            url: SITE_URL + "/index.php?ctl=Goods_Goods&met=actShare",
            type: 'get',
            dataType: 'json',
            data:{'bid':bid,'suid':suid,'hash':hash,'from':from},
            success: function(result) {
            }
        });
    }
</script>

<script>

    // 点击数量 加减
    $(".decrease").click(function(){
        var num = parseInt($(".opration-num").text());
        if(num > 1) {
            $(".opration-num").text(num-=1);
        }
    });

    $(".add").click(function(){
        var num = parseInt($(".opration-num").text());
        if(num >= <?=$data['goods_stock'] ?>){
            $(".add").addClass("no_add");
        }else{
            $(".opration-num").text(num+=1);
        }
    });

    $(".btn-close").click(function (){
        $("#login_content").hide();
        $(".msg-wrap").hide();
        $('.lo_user_account').val("");
        $('.lo_user_password').val("");
    });

    $("#formlogin").keydown(function(e){
        var e = e || event, keycode = e.which || e.keyCode;

        if(keycode == 13){
            loginSubmit();
        }
    });

    //登录按钮
    function loginSubmit(){
        var user_account = $('.lo_user_account').val();
        var user_password = $('.lo_user_password').val();
        $("#loginsubmit").html('正在登录...');
        login_url = UCENTER_URL+'?ctl=Api&met=login&user_account='+user_account+'&user_password='+user_password;
        login_url = login_url + '&from=shop&callback=' + encodeURIComponent(window.location.href);
        window.location.href = login_url;
    }

    var shop_id = <?=($shop_detail['shop_id'])?>;
    //热销商品
    $(".selling").children().eq(0).hover(function (){
        $("#hot_salle").show();
        $("#hot_collect").hide();
    });

    //热搜商品
    $(".selling").children().eq(1).hover(function (){
        $("#hot_salle").hide();
        $("#hot_collect").show();
    });

    //收藏店铺
    window.collectShop = function(e){
        if ($.cookie('key')){
            $.post(SITE_URL  + '?ctl=Shop&met=addCollectShop&typ=json',{shop_id:e},function(data){
                if(data.status == 200){
                    Public.tips.success(data.data.msg);
                }else{
                    Public.tips.error(data.data.msg);
                }
            });
        }else{
            $("#login_content").show();
        }
    }

    //店铺内搜索
    $("input[name='searchGoodsList']").blur(function(){
        var search = $("input[name='searchGoodsList']").val();
        if(search)
        {
            $("#searchGoodsList").attr('href',SITE_URL + '?ctl=Shop&met=goodsList&search='+search+'&id='+ shop_id );
        }
    });

    //立即购买 - 实物商品
    $(".buy-btn").bind("click", function (){
        if(<?=$data['goods_stock']?> == ''){
            Public.tips.warning('<?=_('商品无货，无法进行购买')?>');
            return false;
        }
        <?php if($data['shop_owner']){?>
            Public.tips.warning('<?=_('不能购买自己商店的商品！')?>');
            return false;
        <?php }?>

        var g_num = $('.opration-num').text();
        if ($.cookie('key')) {
            $.ajax({
                url: SITE_URL + '?ctl=Buyer_Cart&met=addCart&typ=json',
                data: {
                    bl_id: $(this).attr('bl_id'),
                    goods_num: g_num
                },
                dataType: "json",
                contentType: "application/json;charset=utf-8",
                async: false,
                success: function(a) {
                    if (a.status == 250) {
                        $.dialog.alert(a.msg);
                    } else {
                        if (a.data.cart_id) {
                            window.location.href = SITE_URL + '?ctl=Buyer_Cart&met=confirm&product_id=' + a.data.cart_id;
                        }
                    }
                },
                failure: function(a) {
                    Public.tips.error('<?=_('操作失败！')?>');
                    //$.dialog.alert("操作失败！");
                }
            });
        } else {
            $("#login_content").show();
        }
    });

    //套装加入购物车
    function addblcart(bl_id){
        <?php if($data['shop_owner']){?>
            Public.tips.warning('<?=_('不能购买自己商店的商品！')?>');
            return false;
        <?php }?>

        if ( <?= $data['goods_stock'] ?> == '') {
            Public.tips.warning('<?=_('商品无货，无法进行购买')?>');
            return false;
        }

        var g_num = $('.opration-num').text();
        if ( <?= Perm::checkUserPerm() ? 1 : 0 ?> ) {
            $.ajax({
                url: SITE_URL + '?ctl=Buyer_Cart&met=addCart&typ=json',
                data: {
                    bl_id: bl_id,
                    goods_num: g_num
                },
                dataType: "json",
                contentType: "application/json;charset=utf-8",
                async: false,
                success: function(a) {
                    if (a.status == 250) {
                        Public.tips.error(a.msg);
                    } else {
                        $.dialog({
                            title: "<?=_('加入购物车')?>",
                            height: 100,
                            width: 250,
                            lock: true,
                            drag: false,
                            content: 'url: ' + SITE_URL + '?ctl=Buyer_Cart&met=add&typ=e'
                        });
                    }
                },
                failure: function(a) {
                    Public.tips.error('<?=_('操作失败！')?>');
                }
            });
        } else {
            login_url = UCENTER_URL + '?ctl=Login&met=index&typ=e';
            callback = SITE_URL + '?ctl=Login&met=check&typ=e&redirect=' + encodeURIComponent(window.location.href);
            login_url = login_url + '&from=shop&callback=' + encodeURIComponent(callback);
            window.location.href = login_url;
        }
    }

    $(function(){
        var _TimeCountDown = $(".fnTimeCountDown");
        _TimeCountDown.fnTimeCountDown();

        url = 'index.php?ctl=Goods_Goods&met=getShopCat&shop_id='+shop_id;
        $(".ser_lists").load(url, function(){
        });

        <?php if(isset($_REQUEST['from'])){ ?>
            from = '<?=$_REQUEST['from']?>';
        <?php }else{ ?>
            from = '';
        <?php } ?>

        if(from == 'consult'){
            window.location.hash = "#elist";
            $(".zl").click();
        }

        $('.goods_det_about .xq:first').addClass('checked');
        var cid = $('.goods_det_about .xq:first').data('cid');
        var gid = $('.goods_det_about .xq:first').data('gid');
        $(".goods_det_about_cont .xq"+gid).show();
        url = 'index.php?ctl=Goods_Goods&met=getGoodsDetail&common_id='+cid;
        $(".goods_det_about_cont .xq"+gid).load(url, function(){
            $(".goods_det_about_cont .xq"+gid).addClass('loaded');
            $("img").lazyload({skip_invisible : false,placeholder : IMG_URL+"/grey.gif",effect: "show",failurelimit : 10});
        });

        $('.goods_det_about .xq').click(function () {
            $('.goods_det_about').find('.checked').removeClass('checked');
            $(".goods_det_about_cont .xq_1").hide();

            $(this).addClass('checked');
            var cid = $(this).data('cid');
            var gid = $(this).data('gid');
            $(".goods_det_about_cont .xq"+gid).show();

            if(!$(".goods_det_about_cont .xq"+gid).hasClass('loaded')){
                url = 'index.php?ctl=Goods_Goods&met=getGoodsDetail&common_id='+cid;
                $(".goods_det_about_cont .xq"+gid).load(url, function(){
                    $(".goods_det_about_cont .xq"+gid).addClass('loaded');
                    $("img").lazyload({skip_invisible : false,placeholder : IMG_URL+"/grey.gif",effect: "show",failurelimit : 10});
                });
            }
        })
    });

</script>

<script>
    var url = '';
    var txt = '';
    var pic = '';
    function SetShareUrl(cmd, config) {
        config.bdUrl = url;
        config.bdText = txt;
        config.bdPic = pic;
        return config;
    }
    window._bd_share_config = {
        common : {
            onBeforeClick: SetShareUrl,
            bdDesc : '淘尚168商城',
        },
        share : [{
            "bdSize" : 24,
            "bdCustomStyle":'<?= $this->view->css ?>/bdshare.css'
        }],
    }

    var share_type = 0;
    var share_id = 0;
    function share(t) {
        var suid = <?php echo Perm::$userId;?>;
        if(t.data('type') == 0){
            share_type = 0;
            url = SITE_URL + "?ctl=Goods_Goods&met=goods&gid=" + t.data('id')+'&suid='+suid;
        }else if(t.data('type') == 1){
            share_type = 1;
            share_id = t.data('id');
            url = SITE_URL + "?ctl=Goods_Goods&met=bundling&bid=" + t.data('id')+'&suid='+suid;
        }

        txt = '分享最高可减' + t.data('price') + '--' + t.data('name');
        pic = t.data('pic');

        var share_all = new Array('sqq','qzone','weixin','weixin_timeline','tsina');
        var shared = JSON.parse(t.attr('data-shared'));
        $.each(share_all,function (i,e) {
            var ht_content = '';
            if(shared && shared[e]){
                ht_content = '<span>已减'+t.data(e)+'元</span>';
            }else{
                ht_content = '立减<span>'+t.data(e)+'</span>元';
            }
            $("#"+e).html(ht_content);
        })

        $('#code').center();
        $('#sharecover').show();
        var top = document.body.scrollTop;
        $("#code").css({top:top+300})
        $('#code').fadeIn();

        if(<?=$data['goods_stock']?> == ''){
            Public.tips.warning('<?=_('商品无货，无法进行购买')?>');
            return false;
        }else{
            $('#code').center();
            $('#sharecover').show();
            var top = document.body.scrollTop;
            $("#code").css({top:top+300})
            $('#code').fadeIn();
         }
    }

    $(function () {

        $('.add-car-btn').click(function(){
            addblcart($(this).attr('bl_id'));
        });
        $('a[nctype="share"]').click(function() {
            if($(this).attr('bl_id')){
                share($(this));
            }
        });
        $('.share').click(function() {
            share($(this));
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

        $('.bds_share').click(function(){
            var parm = '';
            if(share_type == 0){
                parm = {'bid':bid,'cid':cid};
            }else if(share_type == 1){
                parm = {'bid':share_id};
            }
            $.ajax({
                url:SITE_URL + "/index.php?ctl=Goods_Goods&met=addShare",
                type:'get',
                dataType:'json',
                data:parm,
                success:function (data) {
                }
            });
        });
    });
</script>

<?php
include $this->view->getTplPath() . '/' . 'footer.php';
?>