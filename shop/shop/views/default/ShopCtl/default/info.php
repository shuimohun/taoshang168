<?php if (!defined('ROOT_PATH'))
{
    exit('No Permission');
} ?>
<?php
if($shop_base['shop_type'] == 2)
{
    include $this->view->getTplPath() . '/' .'supplier_header.php';
}
else
{
    include $this->view->getTplPath() . '/' .'header.php';
}
?>
<style>
	.define_detail{text-align:left;padding:0;margin: 0 auto;}
    /*.define_detail img{max-width: 1200px;}*/
</style>
<link rel="stylesheet" type="text/css" href="<?= $this->view->css ?>/personalstores.css">
<link rel="stylesheet" type="text/css" href="<?= $this->view->css ?>/goods-detail.css"/>
<link rel="stylesheet" type="text/css" href="<?= $this->view->css ?>/Group-integral.css" />
<style>
    .wrap{width: 100% !important; margin: 0 auto;}
    .bbc-nav ul{width: 1200px !important;margin: 0 auto;}
    .head_cont{ width: 1200px !important;margin: 0 auto;}
    .ncsl-nav-banner{overflow: hidden;}
    .store-decoration-block-1{width: 100% !important; overflow: hidden; text-align: center;}
    .t_goods_bot{margin: 0 auto;padding: 0;}
</style>
<div style="width:1200px;position: relative;margin: 0 auto;">
    <div class="bbc-store-info">
        <div class="basic">
            <div class="displayed">
                <a href=""><?=$shop_base['shop_name']?></a>
                <span class="all-rate">
                <div class="rating">
                    <span style="width: <?=$shop_scores_percentage?>%"></span>
                </div>
               <em><?=$shop_scores_count?></em><em>分</em>
            </span>
            </div>
            <div class="sub">
                <div class="store-logo">
                    <img src="<?=$shop_base['shop_logo']?>" alt="<?=$shop_base['shop_name']?>" title="<?=$shop_base['shop_name']?>">
                </div>
                <!--店铺基本信息 S-->
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
                        <div class="btns">
                            <a href="index.php?ctl=Shop&met=goodsList&id=<?=$shop_id?>" class="goto">进店逛逛</a>
                            <a href="javascript:;" onclick="collectShop(<?=$shop_id?>)">收藏店铺</a>
                        </div>
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
            <img src="<?=$shop_base['shop_banner']?>" />
        <?php }else{ ?>
            <img src="<?= $this->view->img ?>/shop_img.png" />
        <?php } ?>
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
            <div class="bbc-main-container">
                <!--<div class="title">
                    <h4><?/*=@$data['title']*/?></h4>
                </div>-->
                <div class="define_detail">
                    <?=@$data['detail']?>
                </div>
            </div>
        </div>
    </div>
    </div>
</div>

<div class="bbuilder_code">
    <span class="bbc_codeArea"><img src="<?=YLB_Registry::get('base_url')?>/shop/api/qrcode.php?data=<?= urlencode(YLB_Registry::get('url')."?ctl=Shop&met=index&id=".$shop_base['shop_id'])?>"></span>
    <span class="bbc_arrow"></span>
    <div class="bbc_guide_con">
      <span>
          <div class="service-list1" store_id="8" store_name="12312312发发">

            <dl>
              <dt><?=_('售前客服：')?></dt>
			  <?php if(!empty($service['pre'])){?>
			   <?php foreach($service['pre'] as $key=>$val){ ?>
			   <?php if(!empty($val['number'])){?>
               <dd><span>
                  <span c_name="<?=$val['name']?>" member_id="9"><?=$val['tool']?></span>
                  </span></dd>
				<?php }?>
				<?php }?>
				<?php }?>
            </dl>


            <dl>
              <dt><?=_('售后客服：')?></dt>
			  <?php if(!empty($service['after'])){?>
			  <?php foreach($service['after'] as $key=>$val){ ?>
			  <?php if(!empty($val['number'])){?>
                <dd><span>
                  <span c_name="<?=$val['name']?>" member_id="9"><?=$val['tool']?></span>
                  </span></dd>
				<?php }?>
				<?php }?>
				<?php }?>
            </dl>


            <dl class="workingtime">
              <dt><?=_('工作时间：')?></dt>
			  <?php if($shop_base['shop_workingtime']){?>
              <dd>
              <p><?=($shop_base['shop_workingtime'])?></p>
              </dd><?php }?>
            </dl>

        </div>
      </span>
    </div>
  </div>
<?php
include $this->view->getTplPath() . '/' . 'footer.php';
?>