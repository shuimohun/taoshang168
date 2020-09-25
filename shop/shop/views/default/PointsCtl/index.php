<?php if (!defined('ROOT_PATH')){exit('No Permission');}?>
<?php
include $this->view->getTplPath() . '/' . 'header.php';
?>

<link rel="stylesheet" type="text/css" href="<?=$this->view->css?>/Group-integral.css" />
<script src="<?=$this->view->js_com?>/plugins/jquery.slideBox.min.js" type="text/javascript"></script>

<div class="wrap">
	<!--  右登陆 -->
	<div class="bbc-base-layout">
		<div class="bbc-member-left">
            <?php  if(Perm::checkUserPerm()) { ?>
                <div class="bbc-member-info">
                <div class="avatar"><img src="<?=image_thumb($data['user_info']['user_logo'],80,80)?>">
                    <div class="frame"></div>
                </div>
                <dl>
                    <dt>Hi, <?=$data['user_info']['user_name']?></dt>
                    <dd><?=_('当前等级')?>：<strong class="common-color">V<?=$data['user_info']['user_grade']?></strong></dd>
                    <dd><?=_('当前经验值')?>：<strong class="common-color"><?=$data['user_resource']['user_growth']?></strong></dd>
                </dl>
            </div>
            <div class="bbc-member-grade">
                <div class="progress-bar"><em title="V<?=$data['user_info']['user_grade']?><?=_('需经验值')?><?=$data['growth']['grade_growth_start']?>">V<?=$data['user_info']['user_grade']?></em><span title="<?=$data['growth']['grade_growth_per']?>%"><i class="bbc_bg" style="width:<?=$data['growth']['grade_growth_per']?>%;"></i></span><em title="V<?=$data['user_info']['user_grade']+1?><?=_('需经验值')?><?=$data['growth']['grade_growth_end']?>">V<?=$data['user_info']['user_grade']+1?></em></div>
                <div class="progress"><?=_('还差')?><em class="bbc_color"><?=$data['growth']['next_grade_growth']?></em><?=_('经验值即可升级成为')?>V<?=$data['user_info']['user_grade']+1?><?=_('等级会员')?></div>
            </div>
            <div class="bbc-member-point">
                <dl style="border-left: none 0;">
                    <a href="<?=YLB_Registry::get('url')?>?ctl=Buyer_Points&met=points" target="_blank">
                        <dt><strong class="bbc_color"><?=$data['user_resource']['user_points']?></strong><?=_('分')?></dt>
                        <dd><?=_('我的金蛋')?></dd>
                    </a>
                </dl>
                <dl>
                    <a href="<?=YLB_Registry::get('url')?>?ctl=Buyer_Voucher&met=voucher" target="_blank">
                        <dt><strong class="bbc_color"><?=$data['ava_voucher_num']?></strong><?=_('张')?></dt>
                        <dd><?=_('可用代金券')?></dd>
                    </a>
                </dl>
                <dl>
                    <a href="<?=YLB_Registry::get('url')?>?ctl=Buyer_Points&met=points&op=getPointsOrder" target="_blank">
                        <dt><strong class="bbc_color"><?=$data['points_order_num']?></strong><?=_('个')?></dt>
                        <dd><?=_('已兑换礼品')?></dd>
                    </a>
                </dl>
            </div>
            <div class="bbc-memeber-pointcart"> <a href="<?=YLB_Registry::get('url')?>?ctl=Points&met=pointsCart" class="btn bbc_bg_col"><?=_('礼品兑换购物车')?></a></div>
            <?php
            }else{
            ?>
			<div class="bbc-not-login">
				<div class="member"><a href="<?=YLB_Registry::get('url')?>?ctl=Login&met=login" style="color:#000"><?=_('立即登录')?></a>
					<p><?=_('获知会员信息详情')?></p>
				</div>
				<div class="function" style="border: none;"> <i class="voucher"> </i>
					<dl>
						<dt><?=_('店铺代金券')?></dt>
						<dd><?=_('换取店铺代金券购买商品更划算')?></dd>
					</dl>
				</div>
				<div class="function"> <i class="exchange"></i>
					<dl>
						<dt><?=_('金蛋兑换礼品')?></dt>
						<dd><?=_('可使用金蛋兑换商城超值礼品')?></dd>
					</dl>
				</div>
			</div>
            <?php } ?>
		</div>

        <div class="bbc-banner-right">
			<a href="<?=Web_ConfigModel::value('promotiom_img_url')?>" title="<?=_('金蛋列表页中部广告位')?>">
				<img style="width:900px;height:368px; float:right" border="0" src="<?=Web_ConfigModel::value('promotiom_img')?>" alt="">
			</a>
		</div>
    </div>


	<div class="bbc-main-layout">
        <!--金蛋礼品-->
		<div class="bbc-main-layout mb30">
			<div class="title">
				<h3>
                    <span class="iconfont icon-lipin bbc_color"></span><?=_('热门礼品兑换')?>
				    <span class="more"><a href="<?=YLB_Registry::get('url')?>?ctl=Points&met=pList"><?=_('更多')?><i class="iconfont icon-iconjiantouyou rel_top2"></i></a></span>
                </h3>
            </div>
			<ul class="bbc-exchange-list">
				<?php
                    if($data['points_goods'])
                    {
					foreach($data['points_goods'] as $key=>$value)
					{
				?>
				<li>
					<div class="gift-pic">
						<a target="_blank" href="<?=YLB_Registry::get('url')?>?ctl=Points&met=detail&id=<?=$value['points_goods_id']?>"><img src="<?=image_thumb($value['points_goods_image'],150,150)?>" alt="<?=$value['points_goods_name']?>"> </a>
					</div>
					<div class="gift-name">
						<a href="<?=YLB_Registry::get('url')?>?ctl=Points&met=detail&id=<?=$value['points_goods_id']?>" target="_blank" tile="<?=$value['points_goods_name']?>"><?=$value['points_goods_name']?></a>
					</div>
					<div class="exchange-rule">
                        <?php
                        if($value['points_goods_limitgrade']-1){
                            ?>
                            <span class="pgoods-grade"><img src="<?=$this->view->img?>/V<?=$value['points_goods_limitgrade']-1?>.png"></span>
                        <?php }?>
						<span class="pgoods-price"><label><?=_('参考价格')?>：</label><em><?=format_money($value['points_goods_price'])?></em></span>
						<span class="pgoods-points"><label><?=_('所需金蛋')?>：</label><strong  class="bbc_color"><?=$value['points_goods_points']?></strong></span>
					</div>
				</li>
				<?php
                    }
                    } ?>
			  
			</ul>
		</div>

       <!-- 代金券-->
		<div class="bbc-main-layout">
			<div class="title">
				<h3>
                    <span class="iconfont icon-daijinquan bbc_color"></span><?=_('热门代金券')?>
				    <span class="more"> <a href="<?=YLB_Registry::get('url')?>?ctl=Voucher&met=vList"><?=_('更多')?><i class="iconfont icon-iconjiantouyou rel_top2"></i></a></span>
                </h3>
            </div>
            <?php if($data['voucher'])
            {
                ?>
                <ul class="ncp-voucher-list">
                    <?php
                    foreach($data['voucher'] as $key=>$value)
                    {
                        ?>
                        <li>
                            <div class="ncp-voucher" data-id="<?=$value['voucher_t_id']?>">
                                <div class="cut"></div>
                                <div class="pic"><img src="<?=image_thumb($value['voucher_t_customimg'],120,120)?>"></div>
                                <div class="info">
                                    <a href="<?=YLB_Registry::get('url')?>?ctl=Shop&met=index&typ=e&id=<?=$value['shop_id']?>" class="store"><?=$value['shop_name']?></a>
                                    <p class="store-classify"><?=$value['voucher_t_cat_name']?></p>
                                    <dl class="value mt-11">
                                        <dt><em class="bbc_color"><?=format_money($value['voucher_t_price'])?></em></dt>
                                        <dd class="full-reduce"><?=_('购物满')?><?=format_money($value['voucher_t_limit'])?><?=_('可用')?></dd>
                                    </dl>
                                    <div class="info-middle mt-11">
                                        <!--                            <span class="free-change">免费兑换</span>-->
                                        <!--                            <span class="change-num">6人兑换</span>-->
                                        <?php if($value['voucher_t_access_method']==1){ ?>
                                            <p class="required"><?=_('需')?><em class="margin2"><?=$value['voucher_t_points']?></em><?=_('金蛋')?></p>
                                        <?php }else{ ?>
                                            <p class="required"><em class="margin2"><?=$value['voucher_t_access_method_label']?></em></p>
                                        <?php } ?>
                                        <p><em class="giveout"><?=$value['voucher_t_giveout']?></em><?=_('人兑换')?></p>
                                    </div>
                                    <div class="time-wrap mt-11">
                                        <span class="effect-date">有效期</span>
                                        <span class="time"><?=$value['voucher_t_end_date_day']?></span>
                                    </div>
                                </div>
                                <div class="btn-right">
                                    <?php if($value['is_vouver']==1){ ?>
                                        <a target="_blank"  href="<?=YLB_Registry::get('url')?>?ctl=Shop&met=goodsList&id=<?=$value['shop_id']?>">立即使用</a>
                                    <?php }else{ ?>
                                        <?php if($value['voucher_t_access_method']==1){ ?>
                                            <a target="_blank"  href="javascript:void(0);" op_type="exchangebtn" data-param='{"vid":"<?=$value['voucher_t_id']?>"}' >立即兑换</a>
                                        <?php }else{ ?>
                                            <a target="_blank"  href="javascript:void(0);" op_type="exchangebtn" data-param='{"vid":"<?=$value['voucher_t_id']?>"}' >免费领取</a>
                                        <?php } ?>
                                    <?php } ?>
                                </div>
                            </div>
                        </li>
                        <?php
                    }
                    ?>
                </ul>
            <?php }else{ ?>
                <div class="no_account">
                    <img src="<?= $this->view->img ?>/ico_none.png"/>
                    <p><?= _('暂无符合条件的数据记录') ?></p>
                </div>
            <?php } ?>
		</div>
	</div>
</div>

<link href="<?=$this->view->css?>/tips.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="<?=$this->view->js_com?>/plugins/jquery.toastr.min.js"></script>
<script type="text/javascript" src="<?=$this->view->js?>/common.js"></script>
<script type="text/javascript" src="<?=$this->view->js?>/home.js"></script>

<?php
include $this->view->getTplPath() . '/' . 'footer.php';
?>