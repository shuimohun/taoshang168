<?php if (!defined('ROOT_PATH')){exit('No Permission');}

include $this->view->getTplPath() . '/' . 'header.php';
?>
	</div>
	<div class="ncm-security-user">
		<h3><?=_('您的账户信息')?></h3>
		<div class="user-avatar"><span><img src="<?php if(!empty($data['user_avatar'])){ echo $data['user_avatar'];}else{echo $this->web['user_avatar']; } ?>"></span></div>
		<div class="user-intro">
			<dl>
				<dt><?=_('登录账号：')?></dt>
				<dd>
					<?=$data['user_name']?>
				</dd>
			</dl>
			<dl>
				<dt><?=_('绑定邮箱：')?></dt>
				<dd>
					<?=$data['user_email']?>
				</dd>
			</dl>
			<dl>
				<dt><?=_('手机号码：')?></dt>
				<dd>
					<?=$data['user_mobile']?>
				</dd>
			</dl>
			<dl>
				<dt><?=_('上次登录：')?></dt>
				<dd>
					<?=date(Web_ConfigModel::value('date_format') . ' ' . Web_ConfigModel::value('time_format'), $data['user_lastlogin_time'])?>
						<?php if($data['user_lastlogin_ip']){?>|
							<?=_('IP地址:')?>
								<?=$data['user_lastlogin_ip']?>&nbsp;
									<?php }?>
				</dd>
			</dl>
		</div>
	</div>
	<div class="ncm-security-container">
		<div class="title">
			<?=_('您的安全服务')?>
		</div>
		<div class="current low clearfix">
			<div class="divleft">
				<?=_('当前安全等级：')?>
			</div>
			<div class="divright">
				<strong><?php if($data['user_level_id']<1){?><?=_('低')?><?php }elseif($data['user_level_id']==1){?><?=_('中')?><?php }else{?><?=_('高')?><?php }?></strong><span><?=_('(建议您开启全部安全设置，以保障账户及资金安全)')?></span>
			</div>
		</div>

		<dl id="email" class="<?php if($data['user_email_verify']){ ?> yes<?php }else{?>no<?php }?>">
			<dt><span class="iconfont icon-youxiangbangding" style="top:4px;"><?php if($data['user_email_verify']){ ?><i></i><?php }?></span><span class="itemss">
              <h4><?=_('邮箱绑定')?></h4>
              <h6><?php if($data['user_email_verify']){ ?><?=_('已绑定')?><?php }else{?><?=_('未绑定')?><?php }?></h6>
              </span></dt>
			<dd><span class="explain"><?=_('进行邮箱验证后，可用于接收敏感操作的身份验证信息，以及订阅更优惠商品的促销邮件。')?></span><span class="handle"><a href="<?= YLB_Registry::get('url') ?>?ctl=User&met=security&op=email" class="ncbtn ncbtn-aqua bd  bbc_btns"><?=_('绑定邮箱')?></a><a href="<?= YLB_Registry::get('url') ?>?ctl=User&met=security&op=emails" class="ncbtn ncbtn-bittersweet jc  bbc_btns"><?=_('修改邮箱')?></a></span></dd>
		</dl>
		<dl id="mobile" class="<?php if($data['user_mobile_verify']){ ?> yes<?php }else{?>no<?php }?>">
			<dt><span class="iconfont icon-shoujibangding"><?php if($data['user_mobile_verify']){ ?><i></i><?php }?></span><span class="itemss">
              <h4><?=_('手机绑定')?></h4>
              <h6><?php if($data['user_mobile_verify']=='1'){ ?><?=_('已绑定')?><?php }else{?><?=_('未绑定')?><?php }?></h6>
              </span></dt>
			<dd><span class="explain"><?=_('进行手机验证后，可用于接收敏感操作的身份验证信息，以及进行金蛋消费的验证确认，非常有助于保护您的账号和账户财产安全。')?></span><span class="handle"><a href="<?= YLB_Registry::get('url') ?>?ctl=User&met=security&op=mobile" class="ncbtn ncbtn-aqua bd  bbc_btns"><?=_('绑定手机')?></a><a href="<?= YLB_Registry::get('url') ?>?ctl=User&met=security&op=mobiles" class="ncbtn ncbtn-bittersweet jc  bbc_btns"><?=_('修改手机')?></a></span></dd>
		</dl>

	</div>
	</div>
	</div>

	</div>

	</div>

	<?php
include $this->view->getTplPath() . '/' . 'footer.php';
?>