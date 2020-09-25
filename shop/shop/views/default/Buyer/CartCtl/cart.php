<?php if (!defined('ROOT_PATH')){exit('No Permission');}?>
<?php
include $this->view->getTplPath() . '/' . 'site_nav.php';
?>
    <link rel="stylesheet" type="text/css" href="<?= $this->view->css ?>/shop-cart.css" />
    <style>
        .showImages img:hover{width:90px;height:90px}
        .share_div{margin-top:5px}
        .share{width:98px;height:18px;border:1px solid #c51e1e;font-size:12px;line-height:19px;color:#c51e1e;text-align:center}
        .share_wrap{display:inline-block;margin-top:0;margin-bottom:2px}
        .share u{text-decoration:none;background-color:#c51e1e;color:#fff;float:right;width:48px;height:100%;text-align:center}
    </style>

    <div class="wrap">
        <div class="head_cont clearfix">
            <div class="nav_left" style="float:none;">
                <a href="index.php" class="logo"><img src="<?=$this->web['web_logo']?>"/></a>
                <a href="#" class="download iconfont"></a>
            </div>
        </div>
    </div>
    <div class="wrap wrap_w">
        <div class="shop_cart_head clearfix">
            <div class="cart_head_left">
                <h4><?=_('我的购物车')?></h4>
                <p><?=_('查看购物车商品清单,增加减少商品数量,并勾选想要的商品进入下一步操作。')?></p>
            </div>
            <ul class="cart_process">
                <li class="mycart process_selected1">
                    <i class="iconfont icon-wodegouwuche bbc_color"></i>
                    <div class="line">
                        <p class="bbc_border"></p>
                        <span class="bbc_bg bbc_border"></span>
                    </div>
                    <h4 class="bbc_color"><?=_('我的购物车')?><h4>
                </li>
                <li class="mycart">
                    <i class="iconfont icon-iconquerendingdan"></i>
                    <div class="line">
                        <p></p>
                        <span></span>
                    </div>
                    <h4><?=_('确认订单')?><h4>
                </li>
                <li class="mycart">
                    <i class="iconfont icon-icontijiaozhifu"></i>
                    <div class="line">
                        <p></p>
                        <span></span>
                    </div>
                    <h4><?=_('支付提交')?><h4>
                </li>
                <li class="mycart">
                    <i class="iconfont icon-dingdanwancheng"></i>
                    <div class="line">
                        <p></p>
                        <span></span>
                    </div>
                    <h4><?=_('订单完成')?><h4>
                </li>

            </ul>
        </div>

        <?php if($data['count'] == 0){?>
            <div class="cart_empty clearfix">
                <div class="cart_log">
                    <img src="<?=$this->view->img?>/img_sc_icon2.png"/>
                </div>
                <div class="empty-warn">
                    <p><?=_('您的购物车还是空的')?></p>
                    <div>
                        <a href="<?= YLB_Registry::get('url') ?>"><span class="iconfont icon-mashangqugouwu"></span><?=_('马上去购物')?></a>
                        <a href="<?= YLB_Registry::get('url') ?>?ctl=Buyer_Order&met=physical"><span class="iconfont icon-dingdan rel_top2"></span><?=_('查看自己的订单')?></a>
                    </div>
                </div>
            </div>
        <?php }else{?>
            <ul class="cart_goods_type clearfix">
                <li><a class="goods_selected bbc_bg"><?=_('全部商品')?><i>(<?=($data['count'])?>)</i></a></li>
                <?php unset($data['count']);?>
            </ul>
            <div class="cart_goods">
                <ul class='cart_goods_head clearfix'>
                    <li class="done"><?=_('操作')?></li>
                    <li class="price_all"><?=_('小计')?>(<?=(Web_ConfigModel::value('monetary_unit'))?>)</li>
                    <li class="goods_num"><?=_('数量')?></li>
                    <li class="goods_price"><?=_('单价')?>(<?=(Web_ConfigModel::value('monetary_unit'))?>)</li>
                    <li class="goods_name"><?=_('商品')?></li>
                    <li class="cart_goods_all cart-checkbox " style="float:left;"><input class="checkall" type="checkbox"  data-type="all"><div class="select_all"><?=_('全选')?></div></li>
                </ul>
                <form id="form" action="?ctl=Buyer_Cart&met=confirm" method='post'>
                    <ul class="cart_goods_list clearfix">
                        <?php foreach($data['cart_list'] as $key=>$val){?>
                            <li class="carts_content">
                                <div class="bus_imfor clearfix">
                                    <p class="bus_name">
                                        <input class="checkshop checkitem" type="checkbox" data-type="all">
                                        <span>
                                            <i class="iconfont icon-icoshop"></i>
                                            <a href="<?= YLB_Registry::get('url') ?>?ctl=Shop&met=index&id=<?=($key)?>"><?=($val['shop_name'])?></a>
                                        </span>
                                    </p>
                                    <!--购物车 代金券 S-->
                                    <?php if($val['voucher_base']){?>
                                        <div class="shop_voucher">
                                            <a class="show_voucher" onclick="showVoucher(this)"> </a>
                                            <?php if($val['voucher_base']){?>
                                                <div class="voucher_detail box_list">
                                                    <div class="box_list_title">
                                                        <div class="bk"><i class="iconfont icon-cuowu"></i></div>
                                                        <span class="bbc_color"></span>
                                                    </div>
                                                    <ul class="voucher clearfix">
                                                        <?php foreach($val['voucher_base'] as $voukey => $vouval){?>
                                                            <li class="voucher_list">
                                                                <div class="quan_num"><?=(Web_ConfigModel::value('monetary_unit'))?><?=($vouval['voucher_price'])?></div>
                                                                <div class="quan_condition">
                                                                    <span>
                                                                        <?=$vouval['voucher_title']?>
                                                                    </span>
                                                                    <span>
                                                                        <?='满'.Web_ConfigModel::value('monetary_unit').number_format($vouval['voucher_limit']).'减'.Web_ConfigModel::value('monetary_unit').$vouval['voucher_price']?>
                                                                    </span>
                                                                    <?php if($vouval['voucher_type'] == Voucher_TempModel::GETBYPOINTS && $vouval['voucher_points']){?>
                                                                        <span>
                                                                            <?='兑换需'.$vouval['voucher_points'].'个金蛋'?>
                                                                        </span>
                                                                    <?php }?>
                                                                    <span>
                                                                        <time><?=date('Y-m-d',strtotime($vouval['voucher_start_date']))?></time>
                                                                        <?=_('至')?>
                                                                        <time><?=date('Y-m-d',strtotime($vouval['voucher_end_date']))?></time>
                                                                    </span>
                                                                    <span><?=($vouval['voucher_desc'])?></span>
                                                                </div>
                                                                <div>
                                                                    <input type="hidden" name="shop_id" id="shop_id" value="<?=($vouval['voucher_shop_id'])?>">
                                                                    <?php if($vouval['taken']){?>
                                                                        <a class="quan_get taken" href="javascript:;"><?=$vouval['voucher_type_con']?></a>
                                                                    <?php }else{?>
                                                                        <a class="quan_get" onclick="getVoucher($(this))" href="javascript:;" data-tid="<?=$vouval['voucher_t_id']?>" data-type="<?=$vouval['voucher_type']?>"><?=$vouval['voucher_type_con']?></a>
                                                                    <?php }?>
                                                                </div>
                                                            </li>
                                                        <?php }?>
                                                    </ul>
                                                </div>
                                            <?php }?>
                                        </div>
                                    <?php }?>
                                    <!--购物车 代金券 E-->
                                </div>
                                <table id="table_list" class="table_list">
                                    <tbody class="rel_good_infor">
                                        <!--购物车 店铺头部满减送和加价购 S-->
                                        <?php if($val['mansong_info'] || ($val['increase_info'] && $val['increase_info']['rule_info']) || $val['newbuyer_tips']){?>
                                            <tr class="row_line" >
                                                <td class="row_pro" colspan="7">
                                                    <!--满减送 S-->
                                                    <?php if($val['mansong_info']){?>
                                                        <div class="bus_sale">
                                                            <div class="fl">
                                                                <span class="full-icon">满减</span>
                                                                <span>
                                                                    <?=_('活动商品购满')?>
                                                                    <em><?=format_money($val['mansong_info']['rule_price'])?></em>
                                                                    <?php if(!empty($val['mansong_info']['rule_discount'])) { ?>
                                                                        <?=_('，减')?><?=(format_money($val['mansong_info']['rule_discount']))?>
                                                                    <?php } ?>
                                                                    <?php if(!empty($val['mansong_info']['goods_id'])) { ?>
                                                                        <?=_('，再送商品1件 > ')?>
                                                                    <?php } ?>
                                                                </span>
                                                            </div>
                                                            <?php if(!empty($val['mansong_info']['goods_id'])) { ?>
                                                                <div class="fl get_div">
                                                                    <i class="get get<?=($key)?>" data-sid="<?=($key)?>" onclick="showManSong(this)"><?=_('查看赠品')?></i>
                                                                    <a href="#">去凑单 ></a>
                                                                    <?php if($val['mansong_info']['goods_id']){?>
                                                                        <div class="sale_detail box_list mansong_info<?=($key)?>">
                                                                            <div class="box_list_title">
                                                                                <div class="bk"><i class="iconfont icon-cuowu"></i></div>
                                                                                <span class="bbc_color">赠品已加入结算单</span>
                                                                            </div>
                                                                            <ul class="increase clearfix">
                                                                                <li class="increase_list">
                                                                                    <a href="<?= YLB_Registry::get('url') ?>?ctl=Goods_Goods&met=goods&type=goods&gid=<?=$val['mansong_info']['goods_id']?>" target="_blank">
                                                                                        <div><img alt="<?=($val['mansong_info']['goods_name'])?>" src="<?=image_thumb($val['mansong_info']['goods_image'],60,60)?>"></div>
                                                                                    </a>
                                                                                    <div class="quan_condition">
                                                                                        <span><a href="<?= YLB_Registry::get('url') ?>?ctl=Goods_Goods&met=goods&type=goods&gid=<?=($val['mansong_info']['goods_id'])?>" target="_blank"><?=($val['mansong_info']['goods_name'])?></a></span>
                                                                                        <span><?=$val['mansong_info']['spec_str']?></span>
                                                                                        <span><?=_('价格')?> <?=format_money($val['mansong_info']['goods_price'])?></span>
                                                                                    </div>
                                                                                    <div><a class="quan_get" href="<?=YLB_Registry::get('url')?>?ctl=Goods_Goods&met=goods&gid=<?=$val['mansong_info']['goods_id']?>" target="_blank"><?=_('查看')?></a></div>
                                                                                </li>
                                                                            </ul>
                                                                        </div>
                                                                    <?php }?>
                                                                </div>
                                                            <?php } ?>
                                                        </div>
                                                    <?php }?>
                                                    <!--满减送 E-->

                                                    <!--加价购 S-->
                                                    <?php if($val['increase_info']){?>
                                                        <?php foreach($val['increase_info'] as $incgkey => $incgval){?>
                                                            <div class="bus_sale">
                                                                <div class="fl">
                                                                    <span class="full-icon">换购</span>
                                                                    <span><?=_('活动商品购满')?> <?=format_money($incgval['rule_info']['rule_price'])?> </span>
                                                                    <?=_('，即可加价换购商品')?>
                                                                    <?php if($incgval['rule_info']['rule_goods_limit']){echo $incgval['rule_info']['rule_goods_limit'].'件 > '; }?>
                                                                </div>
                                                                <div class="fl get_div">
                                                                    <i class="get" data-sid="<?=($key)?>" data-iid="<?=$incgkey?>" onclick="get(this)" ><?=_('查看换购品')?></i>
                                                                    <a href="#">去凑单 ></a>
                                                                    <?php if($val['increase_info']){?>
                                                                        <div class="sale_detail box_list increase_info<?=($incgkey)?>">
                                                                            <div class="box_list_title">
                                                                                <div class="bk"><i class="iconfont icon-cuowu"></i></div>
                                                                                <span class="bbc_color">
                                                                            <?php if($incgval['rule_info']['rule_goods_limit']){echo '可换购最多'.$incgval['rule_info']['rule_goods_limit'].'件商品 '; }?>
                                                                        </span>
                                                                            </div>
                                                                            <ul class="increase clearfix">
                                                                                <?php foreach($incgval['exc_goods'] as $excgkey => $excgval){?>
                                                                                    <li class="increase_list">
                                                                                        <input type="hidden" name="redemp_goods_id" id="redemp_goods_id" value="<?=($excgval['redemp_goods_id'])?>">
                                                                                        <a href="<?= YLB_Registry::get('url') ?>?ctl=Goods_Goods&met=goods&type=goods&gid=<?=($excgval['goods_id'])?>">
                                                                                            <div class=""><img alt="<?=($excgval['goods_name'])?>" src="<?=image_thumb($excgval['goods_image'],60,60)?>"></div>
                                                                                        </a>
                                                                                        <div class="quan_condition">
                                                                                            <span><a href="<?= YLB_Registry::get('url') ?>?ctl=Goods_Goods&met=goods&type=goods&gid=<?=($excgval['goods_id'])?>"><?=($excgval['goods_name'])?></a></span>
                                                                                            <span><?=($excgval['spec_str'])?></span>
                                                                                            <span><?=_('加购价')?> <?=format_money($excgval['redemp_price'])?></span>
                                                                                            <input type="hidden" class="redemp_price" value="<?=($excgval['redemp_price'])?>">
                                                                                            <input type="hidden" class="redemp_price_rate" value="<?=($excgval['redemp_price']*(100-$user_rate)/100)?>">
                                                                                        </div>
                                                                                        <div><a class="quan_get" href="<?=YLB_Registry::get('url')?>?ctl=Goods_Goods&met=goods&gid=<?=$excgval['goods_id']?>" target="_blank"><?=_('查看')?></a></div>
                                                                                    </li>
                                                                                <?php }?>
                                                                            </ul>
                                                                        </div>
                                                                    <?php }?>
                                                                </div>
                                                            </div>
                                                        <?php }?>
                                                    <?php }?>
                                                    <!--加价购 E-->

                                                    <?php if($val['newbuyer_tips']){?>
                                                        <div class="bus_sale">
                                                            <div class="fl">
                                                                <span class="full-icon">限制</span>
                                                                <span>
                                                                <?=_('新人优惠商品每个店铺限优惠1件，超出数量按原价计算')?>
                                                            </span>
                                                            </div>
                                                        </div>
                                                    <?php }?>
                                                </td>
                                            </tr>
                                        <?php }?>
                                        <!--购物车 店铺头部满减送和加价购 E-->



                                        <!--购物车 店铺商品 S-->
                                        <?php foreach($val['goods'] as $k=>$v){ ?>
                                            <?php if($v['bl_id']){?>
                                                <!--套装 S-->
                                                <tr class="row_line">
                                                    <td class="goods_sel cart-checkbox bl">
                                                        <p>
                                                            <input class="checkitem" type="checkbox" name="product_id[]" value="<?php echo $v['cart_id'];?>">
                                                        </p>
                                                    </td>
                                                    <td class="goods_img"><strong><?=_('【优惠套装】')?></strong></td>
                                                    <td class="goods_name_reset">
                                                        <a target="_blank" href="<?=YLB_Registry::get('url')?>?ctl=Goods_Goods&met=bundling&bid=<?=$v['bl_id']?>"><?php echo ('【优惠套装】').$v['bundling_info']['bundling_name'];?></a>
                                                        <?php if(isset($v['share_price'])): ?>
                                                            <p class="sal_price">
                                                                <?php if($v['share_price']){?><?=_('分享立减：')?><?=format_money($v['share_price'])?><?php echo '，最多'.$v['share_limit'].'件';} ?>
                                                            </p>
                                                        <?php endif; ?>
                                                    </td>

                                                    <td class="goods_price">
                                                        <?php if($v['old_price']){ ?>
                                                            <p class="ori_price"><?=number_format($v['old_price'],2)?></p><?php }?>
                                                            <p class="now_price np<?=($v['cart_id'])?>"><?=number_format($v['now_price'],2)?></p>
                                                    </td>
                                                    <td class="goods_num">
                                                        <a class="<?php if($v['goods_num'] == 1){?>no_<?php }?>reduce" ><?=_('-')?></a><input class="nums" data-id="<?=($v['cart_id'])?>" data-max="<?=$v['buy_residue']?>"  value="<?=($v['goods_num'])?>"><a class="<?php if($v['buy_residue'] <= 1){?>no_<?php }?>add" ><?=_('+')?></a>
                                                    </td>
                                                    <td class="price_all cell<?php echo $v['cart_id'];?>">
                                                        <span class="subtotal"><?php echo $v['sumprice'];?></span>
                                                    </td>
                                                    <td class="done del"><a data-param="{'ctl':'Buyer_Cart','met':'delCartByCid','id':'<?php echo $v['cart_id'];?>'}">删除</a></td>
                                                </tr>
                                                <!--套装商品 S-->
                                                <?php if($v['bundling_info']['goods_list']){?>
                                                    <?php foreach ($v['bundling_info']['goods_list'] as $k_goods => $v_goods){?>
                                                        <tr class="row_line bundling_list bl<?php echo $v['cart_id'];?>" data-param="{'price':'<?=($v_goods['bundling_goods_price'])?>'}">
                                                            <td class="goods_sel cart-checkbox">
                                                            </td>
                                                            <td class="goods_img"><img src="<?=($v_goods['goods_image'])?>"/></td>
                                                            <td class="goods_name_reset">
                                                                <a  target="_blank" href="<?= YLB_Registry::get('url') ?>?ctl=Goods_Goods&met=goods&gid=<?=($v_goods['goods_id'])?>"><?=($v_goods['goods_name'])?></a>
                                                            </td>
                                                            <td class="goods_price">
                                                                <p class="ori_price"><?=$v_goods['goods_price']?></p>
                                                                <p class="now_price"><?=$v_goods['bundling_goods_price']?></p>
                                                            </td>
                                                            <td class="goods_num">
                                                                <?=_($v['goods_num'])?>
                                                            </td>
                                                            <td class="price_all cell<?=($v_goods['goods_id'])?>">
                                                                <span class="subtotal"><?=number_format($v_goods['bundling_goods_price']*$v['goods_num'],2)?></span>
                                                            </td>
                                                            <td class="done del"></td>
                                                        </tr>
                                                    <?php }?>
                                                <?php }?>
                                                <!--套装商品 E-->
                                                <!--套装 E-->
                                            <?php }else{?>
                                                <!--普通商品 S-->
                                                <tr class="row_line">
                                                    <td class="goods_sel cart-checkbox">
                                                        <p>
                                                            <input class="checkitem"  type="checkbox" name="product_id[]" value="<?=($v['cart_id'])?>" <?php if($v['IsHaveBuy']){?>disabled="" title="您已达限购数量" <?php }?> >
                                                        </p>
                                                    </td>
                                                    <td class="goods_img"><img src="<?=($v['goods_base']['goods_image'])?>"/></td>
                                                    <td class="goods_name_reset">
                                                        <a  target="_blank" href="<?= YLB_Registry::get('url') ?>?ctl=Goods_Goods&met=goods&type=goods&gid=<?=($v['goods_base']['goods_id'])?>"><?=($v['goods_base']['goods_name'])?></a>
                                                        <p>
                                                            <?=$v['goods_base']['spec_str'];?>
                                                        </p>
                                                        <?php if(isset($v['buy_limit']) && $v['buy_limit']): ?>
                                                            <p class="sal_price">
                                                                <?=_('限购：')?><?=$v['buy_limit'].'件'?>
                                                                <?php if(isset($v['buy_residue'])): ?>
                                                                    <?=_('还可以购买：')?><?=$v['buy_residue'].'件'?>
                                                                <?php endif; ?>
                                                            </p>
                                                        <?php endif; ?>
                                                        <?php if(isset($v['goods_base']['promotion'])): ?>
                                                            <p class="sal_price">
                                                                <?php if($v['goods_base']['promotion']){ ?>
                                                                    <?php if($v['goods_base']['promotion']['promotion_type'] == Goods_CommonModel::FU){ ?>
                                                                        <?=_($v['goods_base']['promotion']['promotion_type_con'])?>
                                                                    <?php }else{ ?>
                                                                        <?=_($v['goods_base']['promotion']['promotion_type_con'].',直降：')?><?=format_money($v['goods_base']['promotion']['down_price'])?>
                                                                    <?php } ?>
                                                                    <?php if($v['goods_base']['promotion']['upper_limit']){ ?>
                                                                        <?=_('，最多'.$v['goods_base']['promotion']['upper_limit'].'件')?>
                                                                    <?php } ?>
                                                                    <?php if($v['goods_base']['promotion']['lower_limit']){ ?>
                                                                        <?=_('，最低'.$v['goods_base']['promotion']['lower_limit'].'件')?>
                                                                    <?php } ?>
                                                                <?php } ?>
                                                            </p>
                                                        <?php endif; ?>
                                                        <?php if(isset($v['share_price'])): ?>
                                                            <p class="sal_price">
                                                                <?php if($v['share_price']){?><?=_('分享立减：')?><?=format_money($v['share_price'])?><?php echo '，最多'.$v['share_limit'].'件';} ?>
                                                            </p>
                                                        <?php endif; ?>
                                                    </td>

                                                    <td class="goods_price">
                                                        <?php if($v['old_price'] > 0){?><p class="ori_price"><?=($v['old_price'])?></p><?php }?>
                                                        <p class="now_price np<?=($v['cart_id'])?>"><?=($v['now_price'])?></p>
                                                    </td>
                                                    <td class="goods_num">
                                                        <a class="<?php if($v['goods_num'] <= $v['lower_limit']){?>no_<?php }?>reduce" ><?=_('-')?></a>
                                                        <input class="nums" data-id="<?=($v['cart_id'])?>" data-max="<?=$v['buy_residue']?>" data-min="<?=$v['lower_limit']?>" value="<?=($v['goods_num'])?>">
                                                        <a class="<?php if($v['goods_num'] >= $v['buy_residue']){?>no_<?php }?>add" ><?=_('+')?></a>
                                                    </td>
                                                    <td class="price_all cell<?=($v['cart_id'])?>">
                                                        <span class="subtotal"><?=($v['sumprice'])?></span>
                                                    </td>
                                                    <td class="done del"><a data-param="{'ctl':'Buyer_Cart','met':'delCartByCid','id':'<?=($v['cart_id'])?>'}"><?=_('删除')?></a></td>
                                                </tr>
                                                <!--普通商品 E-->
                                            <?php }?>
                                        <?php }?>
                                        <!--购物车 店铺商品 E-->

                                    </tbody>
                                </table>
                            </li>
                        <?php }?>
                    </ul>
                </form>
            </div>
            <div class="pay_fix wrap3">
                <div class="wrap cart-checkbox">
                    <div class="clearfix cart_pad">
                        <input class="checkall" type="checkbox" data-type="all">
                        <div class="select_all"><?=_('全选')?></div>
                        <div  class="delete"><?=_('删除')?></div>
                        <a class="submit-btn-disabled submit-btn bbc_btns"><?=_('去付款')?><span class="iconfont icon-iconjiantouyou"></span></a>
                        <div class="cart-sum">
                            <span><?=_('合计(不含运费)：')?></span>
                            <strong class="price common-color"><?=(Web_ConfigModel::value('monetary_unit'))?><em class="subtotal subtotal_all common-color">0.00</em></strong>
                        </div>
                    </div>
                </div>
            </div>
        <?php }?>
    </div>
    <br><br>

    <ul class="cart_goods_list clearfix" ng-app="app" style="width:70%;margin-left:270px;">
        <li class="carts_content" ng-controller="likeCtl">
            <div class="cart_head_left" style="left:80px;position:absolute;">
                <h4>猜你喜欢</h4>
                <p></p>
            </div>
            <div class="bus_imfor clearfix">
                <p class="bus_name">
                    <span style="right:104px;position:absolute">
                        <a ng-click="loadData()" style="color: #000;">换一组</a>
                    </span>
                </p>
            </div>
            <table id="table_list" class="table_list">
                <tbody class="rel_good_infor">
                <tr class="row_line">
                    <td class="goods_img" ng-repeat="item in likes_list">
                        <a href="<?= YLB_Registry::get('url') ?>?ctl=Goods_Goods&met=goods&type=goods&cid={{item.common_id}}">
                            <img ng-src="{{item.common_image}}">
                        </a>
                        <div>
                            <a target="_blank" href="<?= YLB_Registry::get('url') ?>?ctl=Goods_Goods&met=goods&type=goods&cid={{item.common_id}}" class="common_name">
                                {{item.common_name | limitTo:8}}
                            </a>
                        </div>
                        <a class="sal_price">￥ {{item.common_price}}</a>

                        <div class="share_div">
                            <p class="share_wrap">
                                <span class="share">分享立减
                                    <u>{{item.common_share_price}}</u>
                                </span>
                            </p>
                            <p class="share_wrap">
                                <span class="share">分享立赚
                                    <u>{{item.common_promotion_price}}</u>
                                </span>
                            </p>
                            <p class="clear"></p>
                        </div>

                    </td>
                </tr>
                </tbody>
            </table>
        </li>
    </ul>



    <script type="text/javascript" src="<?=$this->view->js?>/cart.js"></script>

    <script type="text/javascript" src="<?=$this->view->js?>/angular.js"></script>
    <script>
        var app = angular.module('app',[]);
        app.controller('likeCtl',function($scope,$http){
            var loadData = $scope.loadData = function(){
                $http({
                    method: 'GET',
                    url: SITE_URL+'?ctl=Buyer_Index&met=likesList&typ=json',
                }).then(function successCallback(response) {
                    $scope.likes_list = response.data.data;
                }, function errorCallback(response) {
                    // 请求失败执行代码
                });
            }
            loadData();
        })
    </script>

<?php
include $this->view->getTplPath() . '/' . 'buyer_footer.php';
?>