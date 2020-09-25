<?php if (!defined('ROOT_PATH')){exit('No Permission');}?>
<?php
include $this->view->getTplPath() . '/' . 'header.php';
?>

<script type="text/javascript" src="<?=$this->view->js?>/common.js"></script>
    <script type="text/javascript" src="<?=$this->view->js_com?>/template.js"></script>
    <script type="text/javascript" src="<?=$this->view->js?>/moreGoodList.js"></script>



    <link rel="stylesheet"  type="text/css" href="<?= $this->view->css ?>/activity-base.css">
    <link rel="stylesheet"  type="text/css" href="<?= $this->view->css ?>/sonanddaughter.css">
    <link rel="stylesheet"  type="text/css" href="<?= $this->view->css ?>/swiper.css">
    <link rel="stylesheet" type="text/css" href="<?=$this->view->css?>/scarebuy.css">
    <link rel="stylesheet" type="text/css" href="<?= $this->view->css ?>/savemoney.css"/>
    <div class="banner">
        <div class="cheape-buy-banner">
            <div class="bd">
                <ul>
                    <?php if($adv_list['items']){ foreach ($adv_list['items'] as $key=>$value){?>
                        <li>
                            <div class="swiper-slide" >
                                <a href="<?=($value['url'])?>"><img src="<?=($value['pic_url'])?>"/></a>
                            </div>
                        </li>
                    <?php }}?>
                </ul>
            </div>
            <div class="hd">
                <ul>
                    <li></li>
                </ul>
            </div>
        </div>
    </div>
      <div class="wrap">
      <!--分类小导航开始-->
      	<div class="small-nav-wrap">
            <div class="small-nav all-type">
                <div class="kind lf  curr">
                    <a href="#">
                        <i></i>
                        全部类型
                    </a>
                </div>
                <ul style="overflow:hidden;">
                    <li class="lf <?php if($state_id && $state_id==1){ ?> curr <?php }?>" data-id="1">
                        <a href="<?=YLB_Registry::get('url')?>?ctl=Goods_SaveMoney&met=saveList&state_id=1<?php if(isset($cat_id)){?>&cat_id=<?=$cat_id?><?php }?>">50以下</a>
                    </li>
                    <li class="lf <?php if($state_id && $state_id==2){ ?> curr <?php }?>" data-id="2">
                        <a href="<?=YLB_Registry::get('url')?>?ctl=Goods_SaveMoney&met=saveList&state_id=2<?php if(isset($cat_id)){?>&cat_id=<?=$cat_id?><?php }?>">50-100元</a>
                    </li>
                    <li class="lf <?php if($state_id && $state_id==3){ ?> curr <?php }?>" data-id="3">
                        <a href="<?=YLB_Registry::get('url')?>?ctl=Goods_SaveMoney&met=saveList&state_id=3<?php if(isset($cat_id)){?>&cat_id=<?=$cat_id?><?php }?>">100-300元</a>
                    </li>
                    <li class="lf <?php if($state_id && $state_id==4){ ?> curr <?php }?>" data-id="4">
                        <a href="<?=YLB_Registry::get('url')?>?ctl=Goods_SaveMoney&met=saveList&state_id=4<?php if(isset($cat_id)){?>&cat_id=<?=$cat_id?><?php }?>">更多</a>
                    </li>
                </ul>
                <!--价钱筛选开始-->
                <div class="price-screen">
                	<ul>
                        <form>
                            <input type="hidden" name="ctl" value="<?=request_string('ctl')?>">
                            <input type="hidden" name="met" value="<?=request_string('met')?>">
                            <input type="hidden" name="cat_id" value="<?=request_string('cat_id')?>">
                            <input type="hidden" name="state_id" value="<?=request_string('state_id')?request_string('state_id'):'';?>">
                            <li><input type="text" class="price-in Fmoney" onkeyup="checkPrice()" placeholder="￥" name="Fmoney" value="<?php if(isset($Fmoney)){echo $Fmoney;}?>"/></li>
                            <li><span class="sep">-</span></li>
                            <li><input type="text" class="price-in Smoney" onkeyup="checkPrice()" placeholder="￥" name="Smoney" value="<?php if(isset($Smoney)){echo $Smoney;}?>"/></li>
                            <li><input type="submit"  class="price-submit" value="确定" /></li>
                        </form>
                    </ul>
                </div>
                <!--价钱筛选结束-->
            </div>   
            <div class="small-nav all-type has-arrow">
                <div class="kind lf  curr">
                    <a href="#">
                        <i></i>
                        全部类目
                    </a>
                </div>
                <!-- 固定分类 start-->
                <ul class="orflow">
                    <?php if($nav_cats){ foreach ($nav_cats as $k=>$v){?>
                        <li class="ng-scope lf <?php if($v['curr']){?> curr <?php }?>">
                            <a href="<?=YLB_Registry::get('url')?>?ctl=Goods_SaveMoney&met=saveList&cat_id=<?=($v['goods_cat_id'])?><?php if(isset($state_id)){ ?>&state_id=<?=($state_id)?><?php }?>" class="ng-binding">
                                <?=($v['goods_cat_nav_name'])?>
                            </a>

                        </li>
                    <?php }}?>

                </ul>
                <!-- 固定分类 end-->               
            </div>
    
        </div>
        <!--分类小导航结束-->
      	<!-- 省到家  开始-->
        <div class="savemoney-main savemoney-main-home">
            <div class="save-item orflow save-list">
                <div class="save-item-title">省到家</div>
                <div class="save-item-contain">
                    <ul class="clearfix">
                        <?php if($data['goods_list']['items']){ foreach ($data['goods_list']['items'] as $k=>$v){?>
                        <li>
                            <div class="item-pic">
                                <a href="<?=YLB_Registry::get('url')?>?ctl=Goods_Goods&met=goods&gid=<?=($v['goods_id'])?>" target="_blank"><img src="<?=($v['common_image'])?>" alt=""></a>
                            </div>
                            <div class="item-text">
                                <p class="item-text-title"> <a href="<?=YLB_Registry::get('url')?>?ctl=Goods_Goods&met=goods&gid=<?=($v['goods_id'])?>" target="_blank"><?=($v['common_name'])?></a></p>
                                <p class="item-text-save">狂省<?=($v['common_share_price'])?>元</p>
                                <a href="#" class="add_buy_btn" target="_blank">加购</a>
                            </div>
                        </li>
                        <?php }}else{ ?>
                            <div class="no_account">
                                <img src="<?= $this->view->img ?>/ico_none.png"/>
                                <p><?= _('暂无符合条件的数据记录') ?></p>
                            </div>
                        <?php }?>
                    </ul>
                    <!--分页开始-->
                    <nav class="page page_front">
                       <?=($page_nav)?>
                    </nav>
                    <!--分页结束-->
                </div>
            </div>
        </div>
        <!-- 省到家 结束-->
    </div>
    <script>
        jQuery(".cheape-buy-banner").slide({
            mainCell:".bd ul",
            autoPlay:true
        })
    </script>

    <script src="<?= $this->view->js ?>/swiper.min.js"></script>
    <script>
		
        $(".savemoney-main-first .save-item-title ul li").click(function(){
            var this_num = $(this).index();
             $(this).addClass("on").siblings().removeClass("on");
			 $(this).parents(".savemoney-main-first").find(".save-item-contain").hide();
              $(this).parents(".savemoney-main-first").find(".save-item-contain").eq(this_num).show();
        })
    </script>
<?php
include $this->view->getTplPath() . '/' . 'footer.php';
?>