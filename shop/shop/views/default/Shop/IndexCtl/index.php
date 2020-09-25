<?php if (!defined('ROOT_PATH')){exit('No Permission');}?>
<?php
include $this->view->getTplPath() . '/' . 'header.php';
?>
	<script type="text/javascript" src="<?=$this->view->js?>/common.js"></script>
	<link href="<?= $this->view->css ?>/tips.css" rel="stylesheet">
	<script type="text/javascript" src="<?=$this->view->js_com?>/plugins/jquery.toastr.min.js" charset="utf-8"></script>
	<link href="<?= $this->view->css ?>/login.css" rel="stylesheet">

	<script type="application/javascript">
	    $(function(){
	        $(".store-privilege").hover(function(){
	            $(this).find(".popup-shopinfo").show();
	        },function(){
	            $(this).find(".popup-shopinfo").hide();
	        });
	    })
	</script>

	<link rel="stylesheet"  type="text/css" href="<?=$this->view->css ?>/store.css">
    <div class="wrap">
        <div class="QR-layout">
            <!-- 筛选 -->
            <div class="sort-bar">
                <div class="sort-bar-wrap">
                    <div class="nch-sortbar-array">
                        <ul class="screen">
                            <li class="<?php if(!request_string('or')) echo 'selected'; ?>">
                                <a href="<?= YLB_Registry::get('url') ?>/index.php?ctl=Shop_Index&plat=<?=@request_string('plat')?>&district=<?=@request_string('district')?>" title="默认排序">默认排序</a>
                            </li>
                            <li class="<?php if(request_string('or')=='collect') echo 'selected'; ?>" >
                                <a href="<?= YLB_Registry::get('url') ?>/index.php?ctl=Shop_Index&or=collect&district=<?=@request_string('district')?>&plat=<?=@request_string('plat')?>" title="点击按成收藏量从高到低排序">收藏量</a>
                            </li>
                        </ul>
                    </div>
                    <div class="nch-sortbar-filter">
                        <div class="widget-label">
                            <span class="widget-label-txt" style="width:38px; text-align:right">
                                <?php if(@request_string('district')) echo request_string('district'); else echo '所在地'?>
                            </span>
                            <i class="widget-label-arrow"></i>
                        </div>
                        <div class="widget-location">
                            <?php if(request_string('district')){?>
                            <a class="lacation-sure" href="<?= YLB_Registry::get('url') ?>/index.php?ctl=Shop_Index&plat=<?=@request_string('plat')?>">取消选择</a>
                            <?php } ?>
                            <div class="section_ul">
                                <ul>
                            <?php
                                if($district_data){
                                foreach($district_data['items'] as $ks=>$district)
                                {
                            ?>
                                    <li><a href="<?= YLB_Registry::get('url') ?>/index.php?ctl=Shop_Index&or=<?=@request_string('or')?>&district=<?=@$district['district_name']?>&plat=<?=@request_string('plat')?>"><?=@$district['district_name']?></a></li>
                                    <?php if(($ks+1)%6==0){ ?>
                                    </ul>
                            </div>
                            <div class="section_ul">
                                <ul>
                                    <?php } ?>
                            <?php }}?>
                            </ul>
                            </div>
                        </div>
                    </div>
                    <div class="nch-sortbar-filter" style="width:100px;">
                        <div class="widget-label">
                            <input type="checkbox" class="checkbox rel_top-1 vermiddle" <?php if(request_string('plat') == '1'){?>checked<?php }?> name="plat" />
                            <label><?=_('平台自营')?></label>
                        </div>
                    </div>
                    <div class="nch-sortbar-filter" style="width:120px;">
                        <div class="widget-label">
                            <input type="checkbox" class="checkbox rel_top-2 vermiddle" <?php if(request_string('plat2') == '1'){?>checked<?php }?> name="plat2" />
                            <label><?=_('第三方店铺')?></label>
                        </div>
                    </div>
                </div>
                <!--店铺列表-->
                <div class="search-store">
                    <ul>
                        <?php if($data['items'])
                        {
                            foreach($data['items'] as $key=>$val)
                            {
                        ?>
                        <li class="store-list">
                            <div class="store-left">
                                <div class="store-info">
                                    <div class="store-img">
                                        <a href="<?= YLB_Registry::get('url') ?>?ctl=Shop&met=index&typ=e&id=<?=($val['shop_id'])?>" target="_blank" title=""><img src="<?php if($val['shop_logo']) echo $val['shop_logo'];else echo $this->view->img.'/default_store_image.png';?>"></a>
                                    </div>
                                    <div class="store-info-o">
                                        <p>
                                            <a class="store-name m-r-5" href="<?= YLB_Registry::get('url') ?>?ctl=Shop&met=index&typ=e&id=<?=($val['shop_id'])?>" target="_blank">
                                                <?php if($val['shop_self_support'] == 'true'){ ?><span class="goods_self m-r-5">自营</span><?php } ?>
                                                <?=$val['shop_name']?><?=$val['shop_grade']?>
                                            </a>
                                            <a href="javascript:;" data-nc-im="" data-im-seller-id="6" data-im-common-id="0"><i class="im_common offline"></i></a>
                                        </p>
                                        <?php if($val['shop_self_support'] == 'false'){ ?>
                                        <p>所在地：<span><?=@$val['shop_company_address']?></span></p>
                                        <p>店铺等级：<span class="store-major" title=""><?=$val['shop_grade']?></span></p>
                                        <?php } ?>
                                    </div>
                                </div>

                                <div class="store-activity"></div>
                                <div class="store-sever">
                                    <div class="store-volume">
                                        <!---<span>销量<em>39</em></span>-->
                                        <span>共有<em>&nbsp;<?=@$val['goods_num']?>&nbsp;</em>件商品</span>
                                    </div>
                                    <div class="store-privilege">
                                        <em class="pf"></em>
                                        <div class="popup-shopinfo" style="display: none;">
                                            <div class="popup-shopinfo-arrow"></div>
                                            <div class="popup-wrap">
                                                <div class="ncs-detail-rate">
                                                    <dl>
                                                      <dt>店铺评分 </dt>
                                                      <dd>商品满意度：<?=@$val['shop_detail']['shop_desc_scores']?>分</dd>
                                                      <dd>服务满意度：<?=@$val['shop_detail']['shop_service_scores']?>分</dd>
                                                      <dd>物流满意度：<?=@$val['shop_detail']['shop_send_scores']?>分</dd>
                                                    </dl>
                                                    <dl>
                                                      <dt>同类对比</dt>
                                                      <dd>
                                                            <div class="<?php if(@$val['shop_detail']['com_desc_scores'] >= 0)echo 'high';else echo 'low';?>"><span><i></i><?php if(@$val['shop_detail']['com_desc_scores'] >= 0): ?><?=_('高于')?><?php else: ?><?=_('低于')?><?php endif; ?></span> <?=number_format(abs(@$val['shop_detail']['com_desc_scores']),2,'.','')?><?=_('%')?></div>
                                                      </dd>
                                                      <dd>
                                                            <div class="<?php if(@$val['shop_detail']['com_service_scores'] >= 0)echo 'high';else echo 'low';?>"><span><i></i><?php if(@$val['shop_detail']['com_service_scores'] >= 0): ?><?=_('高于')?><?php else: ?><?=_('低于')?><?php endif; ?></span> <?=number_format(abs(@$val['shop_detail']['com_service_scores']),2,'.','')?><?=_('%')?></div>
                                                      </dd>
                                                      <dd>
                                                            <div class="<?php if(@$val['shop_detail']['com_send_scores'] >= 0)echo 'high';else echo 'low';?>"><span><i></i><?php if(@$val['shop_detail']['com_send_scores'] >= 0): ?><?=_('高于')?><?php else: ?><?=_('低于')?><?php endif; ?></span> <?=number_format(abs(@$val['shop_detail']['com_send_scores']),2,'.','')?><?=_('%')?></div>
                                                      </dd>
                                                    </dl>
                                                 </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="fav-store">
                                    <a href="javascript:;" nc_type="storeFavoritesBtn" onclick="collectShop(<?=($val['shop_id'])?>)"> <i class="icon fa fa-star-o"></i>收藏店铺<em class="m-l-5 shop_<?=($val['shop_id'])?>" nc_type="storeFavoritesNum"><?=@$val['shop_collect']?></em> </a>
                                </div>
                            </div>

                            <div class="store-right">
                                <div class="warp">
                                    <div class="store-goods-container">
                                        <ul>
                                            <?php
                                                if($val['goods_recommended']['items']){
                                                foreach($val['goods_recommended']['items'] as $k=>$goods){
                                            ?>
                                            <li class="store-goods">
                                                <a class="goods" href="<?=YLB_Registry::get('url')?>?ctl=Goods_Goods&met=goods&type=goods&gid=<?=@$goods['goods_id'] ?>" title="<?=@$goods['common_name']?>" target="_blank"><img src="<?=@$goods['common_image']?>"></a>
                                                <div class="goods-info">
                                                    <p class="goods-name m-t-5"><a href="<?=YLB_Registry::get('url')?>?ctl=Goods_Goods&met=goods&type=goods&gid=<?=@$goods['goods_id'] ?>" target="_blank"><?=@$goods['common_name']?></a></p>
                                                    <p class='share'>分享立省<span><?=format_money($goods['common_share_price'])?></span></p><br>
                                                    <?php if($goods['common_is_promotion']){?>
                                                        <p  class='share2'>立赚<span><?=format_money($goods['common_promotion_price'])?></span></p>
                                                    <?php }?>
                                                    <p class="goods-price m-t-5">
                                                        <em><?=@format_money($goods['common_shared_price'])?></em>
                                                        <span>售出<em class="num-color margin2"><?=@$goods['common_salenum']?></em>件</span>
                                                    </p>
                                                </div>
                                            </li>
                                            <?php }} ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </li>
                            <?php }}else{ ?>
                        <div class="no_account">
                                <img src="<?= $this->view->img ?>/ico_none.png"/>
                                <p><?= _('暂无符合条件的数据记录') ?></p>
                        </div>
                        <?php } ?>
                    </ul>
                    <div class="page page_front">
                        <?=@$page_nav?>
                    </div>
                </div>
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
	<script>
		$(".btn-close").click(function ()
		{
			$("#login_content").hide();

			$(".msg-wrap").hide();
			$('.lo_user_account').val("");
			$('.lo_user_password').val("");
		});

		$("#formlogin").keydown(function(e){
			var e = e || event,
				keycode = e.which || e.keyCode;

			if(keycode == 13)
			{
				loginSubmit();
			}
		});

		//检验验证码是否正确

		//登录按钮
		function loginSubmit()
		{
			var user_account = $('.lo_user_account').val();
			var user_password = $('.lo_user_password').val();

			$("#loginsubmit").html('正在登录...');

			login_url = UCENTER_URL+'?ctl=Api&met=login&user_account='+user_account+'&user_password='+user_password;

			login_url = login_url + '&from=shop&callback=' + encodeURIComponent(window.location.href);

			window.location.href = login_url;

		}
	    </script>

    <script>
    $(".checkbox").bind("click", function ()
    {
        var _self = this;
        if(_self.checked)
        {
            if($(this).attr('name') == 'plat' || $(this).attr('name') == 'plat2')
            {
                checkbox($(this).attr('name'),'1');
            }
        }else
        {
            if($(this).attr('name') == 'plat' || $(this).attr('name') == 'plat2')
            {
                checkbox($(this).attr('name'),'');
            }
        }
    });

    //仅显示有货，仅显示促销商品
    function checkbox(a,e)
    {
        //地址中的参数
        var params= window.location.search;
        params = changeURLPar(params,a,e);
        window.location.href = SITE_URL + params;
    }

    function changeURLPar(destiny, par, par_value)
    {
        var pattern = par+'=([^&]*)';
        var replaceText = par+'='+par_value;
        if (destiny.match(pattern))
        {
            var tmp = new RegExp(pattern);
            tmp = destiny.replace(tmp, replaceText);
            return (tmp);
        }
        else
        {
            if (destiny.match('[\?]'))
            {
                return destiny+'&'+ replaceText;
            }
            else
            {
                return destiny+'?'+replaceText;
            }


        }
        return destiny+'\n'+par+'\n'+par_value;
    }

    //收藏店铺
	window.collectShop = function(e){
		if ($.cookie('key'))
        {
			$.post(SITE_URL  + '?ctl=Shop&met=addCollectShop&typ=json',{shop_id:e},function(data)
			{
				if(data.status == 200)
				{
				    Public.tips.success(data.data.msg);
					a = $('.shop_'+e).html();
					$('.shop_'+e).html(a*1+1);
				}
				else
				{
				    Public.tips.error(data.data.msg);
				}
			});
		}
		else
		{
			$("#login_content").show();
        }
	}
</script>
<?php
include $this->view->getTplPath() . '/' . 'footer.php';
?>