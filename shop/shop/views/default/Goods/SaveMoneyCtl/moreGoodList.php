<?php if (!defined('ROOT_PATH')){exit('No Permission');}?>
<?php
include $this->view->getTplPath() . '/' . 'header.php';
?>

<script type="text/javascript" src="<?=$this->view->js?>/common.js"></script>
    <script type="text/javascript" src="<?=$this->view->js?>/moreGoodList.js"></script>
    <script type="text/javascript" src="<?=$this->view->js?>/template.js"></script>


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
                    <ul style="overflow:hidden;" class="priceNav">
                        <li class="lf <?php if(isset($state_id) && $state_id == 1){ ?> curr <?php }?>" data-state="1"><a href="<?=YLB_Registry::get('url')?>?ctl=Goods_SaveMoney&met=moreGoodList&state_id=1<?php if(isset($cat_id)){?>&cat_id=<?=$cat_id?><?php }?><?php if(isset($cat_sid)){?>&cat_sid=<?=$cat_sid?><?php }?>">50元以下</a></li>
                        <li class="lf <?php if(isset($state_id) && $state_id == 2){ ?> curr <?php }?>" data-state="2"><a href="<?=YLB_Registry::get('url')?>?ctl=Goods_SaveMoney&met=moreGoodList&state_id=2<?php if(isset($cat_id)){?>&cat_id=<?=$cat_id?><?php }?><?php if(isset($cat_sid)){?>&cat_sid=<?=$cat_sid?><?php }?>">50~100元</a></li>
                        <li class="lf <?php if(isset($state_id) && $state_id == 3){ ?> curr <?php }?>" data-state="3"><a href="<?=YLB_Registry::get('url')?>?ctl=Goods_SaveMoney&met=moreGoodList&state_id=3<?php if(isset($cat_id)){?>&cat_id=<?=$cat_id?><?php }?><?php if(isset($cat_sid)){?>&cat_sid=<?=$cat_sid?><?php }?>">100~300</a></li>
                        <li class="lf <?php if(isset($state_id) && $state_id == 4){ ?> curr <?php }?>" data-state="4"><a href="<?=YLB_Registry::get('url')?>?ctl=Goods_SaveMoney&met=moreGoodList&state_id=4<?php if(isset($cat_id)){?>&cat_id=<?=$cat_id?><?php }?><?php if(isset($cat_sid)){?>&cat_sid=<?=$cat_sid?><?php }?>">更多</a></li>
                    </ul>
                </ul>
                <!--价钱筛选开始-->
                <div class="price-screen">
                	<ul>
                        <form>
                            <input type="hidden" name="ctl" value="<?=request_string('ctl')?>">
                            <input type="hidden" name="met" value="<?=request_string('met')?>">
                            <input type="hidden" name="cat_id" value="<?=request_string('cat_id')?>">
                            <input type="hidden" name="cat_sid" value="<?=request_string('cat_sid')?>">
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
                    <?php if($data['oneCat']){ foreach ($data['oneCat'] as $k=>$v){?>
                    <li class="ng-scope lf <?php if(isset($v['curr'])){ ?> curr <?php }?>">
                        <a href="<?=YLB_Registry::get('url')?>?ctl=Goods_SaveMoney&met=moreGoodList&cat_id=<?=($v['cat_id'])?><?php if(isset($state_id)){ ?>&state_id=<?=($state_id)?><?php }?>" class="ng-binding">
                            <?=($v['nav_name'])?>
                        </a>
                    </li>
                    <?php }}?>
                </ul>
                <!-- 固定分类 end-->               
            </div>
            <div class="small-nav type-detail block">
                <ul>

                    <?php if($data['sub_cat']){ foreach ($data['sub_cat'] as $k=>$v){?>
                        <li class="ng-scope lf <?php if(isset($v['curr'])){ ?> curr <?php }?>">
                            <a href="<?=YLB_Registry::get('url')?>?ctl=Goods_SaveMoney&met=moreGoodList&cat_sid=<?=($v['cat_id'])?>&cat_id=<?=($v['cat_parent_id'])?><?php if(isset($state_id)){ ?>&state_id=<?=($state_id)?><?php }?>"  class="ng-binding"><?=($v['cat_name'])?></a>
                        </li>
                    <?php }}?>
    
    
                </ul>
            </div>
    
        </div>
        <!--分类小导航结束-->
      	<!-- 惠省 惠赚开始-->
        <div class="savemoney-main savemoney-main-first">  
            <div class="save-item orflow moreGoodList">
                <div class="save-item-title lv2_page_title">
                    <!--<ul>
                        <li class="on">惠省</li>
                        <li>惠赚</li>
                    </ul>-->
                    惠省
                </div>
                <div class="save-item-contain">
                    <?php if($data['share_list']['items']){?>
                    <ul class="clearfix">
                        <?php foreach ($data['share_list']['items'] as $k=>$v){?>
                            <li>
                                <div class="item-pic">
                                    <a href="<?=YLB_Registry::get('url')?>?ctl=Goods_Goods&met=goods&gid=<?=($v['goods_id'])?>" target="_blank"><img src="<?=($v['common_image'])?>" alt=""></a>
                                </div>
                                <div class="item-text">

                                    <p class="item-text-title"> <a href="<?=YLB_Registry::get('url')?>?ctl=Goods_Goods&met=goods&gid=<?=$v['goods_id']?>" target="_blank"><?=($v['common_name'])?></a></p>

                                    <p class="item-text-save">狂省<?=(format_money($v['common_share_price']))?>元 <?php if($v['common_is_jia']==1){?>
                                            <span class="item-text-icon">加</span>
                                        <?php }?>
                                        <?php if($v['common_promotion_type']==1){?>
                                            <span class="item-text-icon">惠</span>
                                        <?php }else if($v['common_promotion_type']==2){?>
                                            <span class="item-text-icon">限</span>
                                        <?php }else if($v['common_promotion_type']==3){?>
                                            <span class="item-text-icon">手</span>
                                        <?php }else if($v['common_promotion_type']==4){?>
                                            <span class="item-text-icon">新</span>
                                        <?php }else if($v['common_promotion_type']==5){?>
                                            <span class="item-text-icon">市</span>
                                        <?php }?>
                                    </p>
                                </div>
                            </li>
                        <?php }?>
                    </ul>
                    <?php }else{?>
                        <div class="no_account">
                            <img src="<?= $this->view->img ?>/ico_none.png"/>
                            <p><?= _('暂无符合条件的数据记录') ?></p>
                        </div>
                    <?php }?>
                    <!--分页开始-->
                    <nav class="page page_front">

                            <?=($page_nav)?>

                    </nav>
                    <!--分页结束-->
                </div>

            </div>  
        </div>
        <!-- 惠省 惠赚结束--> 
        
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