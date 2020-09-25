<?php if (!defined('ROOT_PATH')){exit('No Permission');}?>
<?php
include $this->view->getTplPath() . '/' . 'header.php';
?>

<script type="text/javascript" src="<?=$this->view->js?>/savemoney.js"></script>
<script type="text/javascript" src="<?=$this->view->js_com?>/template.js"></script>


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
                    <li></li><li></li>
                </ul>
            </div>
        </div>
    </div>
      <div class="wrap">
      <!--分类小导航开始-->
      	<div class="small-nav-wrap">
            <div class="small-nav all-type price-nav">
                <div class="kind lf  curr">
                    <a href="#">
                        <i></i>
                        全部类型
                    </a>
                </div>
                <ul style="overflow:hidden;">
                    <li class="lf" data-state="1"><a href="javascript:void(0)">50元以下</a></li>
                    <li class="lf" data-state="2"><a href="javascript:void(0)">50~100元</a></li>
                    <li class="lf" data-state="3"><a href="javascript:void(0)">100~300</a></li>
                    <li class="lf" data-state="4"><a href="javascript:void(0)">更多</a></li>
                </ul>
                <!--价钱筛选开始-->
                <div class="price-screen">
                	<ul>
                    	<li><input type="text" class="price-in Fprice"  placeholder="￥"  /></li>
                        <li><span class="sep">-</span></li>
                        <li><input type="text" class="price-in Sprice" placeholder="￥" /></li>
                        <li><button class="price-submit"  type="button">确定</button></li>
                    </ul>
                </div>
                <!--价钱筛选结束-->
            </div>

            <div class="small-nav all-type has-arrow firstCat">
                <div class="kind lf  curr">
                    <a href="#">
                        <i></i>
                        全部类目
                    </a>
                </div>
                <!-- 固定分类 start-->
                <ul class="orflow">

                    <script type="text/html" id="firstCat">
                        <% if(data){%>
                            <%for(var i in data){%>
                            <li class="ng-scope lf" data-id="<%=data[i].cat_id%>">
                                <a href="javascript:void(0);" class="ng-binding">
                                   <%=data[i].nav_name%>
                                </a>
                            </li>
                            <%}%>
                        <%}%>
                    </script>
                </ul>
                <!-- 固定分类 end-->

            </div>

            <div class="small-nav type-detail block secondCat">
                <script type="text/html" id="secondCat">
                    <%if(data.items){%>
                    <ul>

                        <!--二级分类-->
                      <%for(var i in data.items){%>
                        <li class="ng-scope lf" data-id="<%=data.items[i].cat_id%>" >
                            <a href="javascript:void(0);" class="ng-binding"><%=data.items[i].cat_name%></a>
                        </li>
                      <%}%>


                    </ul>
                    <%}%>
                </script>

            </div>

        </div>
        <!--分类小导航结束-->
      	<!-- 惠省 惠赚开始-->
        <div class="savemoney-main savemoney-main-first">
            <div class="save-item orflow">
                <div class="save-item-title">
                    <ul>
                        <li class="on">惠省
                            <?php if(count($data['share_list']['items'])>=18){?>
                                <a href="<?=YLB_Registry::get('url')?>?ctl=Goods_SaveMoney&met=moreGoodList" target="_blank" class="more-btn">更多>></a>
                            <?php }?>
                        </li>
                        <li>惠赚
                            <?php if(count($data['promotion_list']['items'])>=18){?>
                            <a target="_blank" href="<?=YLB_Registry::get('url')?>?ctl=Goods_SaveMoney&met=moreHZGoodList" class="more-btn">更多>></a>
                            <?php }?>
                        </li>
                    </ul>
                </div>
                <div class="save-item-contain HS">
                    <?php if($data['share_list']){?>
                        <ul class="clearfix">
                            <?php foreach ($data['share_list']['items'] as $k=>$v){?>
                                <li>
                            <!--   -->
                                    <div class="item-pic">
                                        <a href="<?=YLB_Registry::get('url')?>?ctl=Goods_Goods&met=goods&gid=<?=($v['goods_id'])?>" target="_blank"><img src="<?=($v['common_image'])?>" alt=""></a>
                                    </div>
                                    <div class="item-text">
                                        <p class="item-text-title">
											<a href="<?=YLB_Registry::get('url')?>?ctl=Goods_Goods&met=goods&gid=<?=($v['goods_id']) ?>" target="_blank">
											<?=($v['common_name'])?>
											</a>
										</p>
                                       
                                        <p class="item-text-save">狂省<?=(format_money($v['common_share_price']))?>元
											 <?php if($v['common_is_jia']==1){?>
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
                    <?php } else{?>
                        <div class="no_account">
                            <img src="<?= $this->view->img ?>/ico_none.png"/>
                            <p><?= _('暂无符合条件的数据记录') ?></p>
                        </div>
                    <?php }?>
                </div>
                <div class="save-item-contain hidden HZ">
                    <?php if($data['promotion_list']){?>
                        <ul class="clearfix">
                            <?php foreach ($data['promotion_list']['items'] as $k=>$v){?>
                            <li>
                                <div class="item-pic">
                                     <a href="<?=YLB_Registry::get('url')?>?ctl=Goods_Goods&met=goods&gid=<?=($v['goods_id'])?>" target="_blank"><img src="<?=($v['common_image'])?>" alt=""></a>
                                </div>
                                <div class="item-text">
                                    <p  class="item-text-title"><a href="<?=YLB_Registry::get('url')?>?ctl=Goods_Goods&met=goods&gid=<?=($v['goods_id'])?>" target="_blank"><?=($v['common_name'])?></a></p>
                                  
                                    <p class="item-text-save">狂赚<?=(format_money($v['common_promotion_price']))?>元
									  <?php if($v['common_is_jia']==1){?>
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
                </div>
            </div>
        </div>
        <!-- 惠省 惠赚结束-->
        <!-- 省到家  开始-->
        <?php if(count($data['jia_list']['items'])>0){?>
            <div class="savemoney-main savemoney-main-home">
                <div class="save-item orflow">
                    <div class="save-item-title">省到家<?php if(count($data['jia_list']['items'])>=18){?><a href="#" class="more-btn">更多>></a><?php }?></div>
                    <div class="save-item-contain">
                        <ul class="clearfix">
                            <?php foreach ($data['jia_list']['items'] as $k=>$v){?>
                                <li>
                                    <div class="item-pic">
                                        <a href="<?=YLB_Registry::get('url')?>?ctl=Goods_Goods&met=goods&gid=<?=($v['goods_id'])?>" target="_blank"><img src="<?=($v['common_image'])?>" alt=""></a>
                                    </div>
                                    <div class="item-text">
                                        <p class="item-text-title">
                                            <a href="<?=YLB_Registry::get('url')?>?ctl=Goods_Goods&met=goods&gid=<?=($v['goods_id'])?>" target="_blank">
                                                <?=$v['common_name']?>
                                            </a>
                                        </p>
                                        <p class="item-text-save">狂省<?=(format_money($v['common_share_price']))?>元</p>
                                        <a href="#" class="add_buy_btn" target="_blank">加购</a>
                                    </div>
                                </li>
                            <?php }?>
                        </ul>
                    </div>
                </div>
            </div>
        <?php }?>
        <!-- 省到家 结束-->
        <!-- 钱不尽  开始-->
          <?php if($data['bundling_list']){?>
            <div class="savemoney-main savemoney-main-home">
                <div class="save-item orflow">
                    <div class="save-item-title">钱不尽<?php if(count($data['bundling_list'])>=18){?><a href="#" class="more-btn">更多>></a><?php }?></div>
                    <div class="save-item-contain">
                        <ul class="clearfix">
                            <?php foreach ($data['bundling_list'] as $k=>$v){?>
                                <li>
                                    <div class="item-pic">
                                        <a href="<?=YLB_Registry::get('url')?>?ctl=Goods_Goods&met=bundling&bid=<?=($v['bundling_id'])?>" target="_blank">
                                            <img src="<?=($v['goods_list'][0]['goods_image'])?>" alt="">
                                        </a>
                                    </div>
                                    <div class="item-text">
                                        <p class="item-text-title"><a  href="<?=YLB_Registry::get('url')?>?ctl=Goods_Goods&met=bundling&bid=<?=($v['bundling_id'])?>" target="_blank"><?=($v['bundling_name'])?></a></p>
                                        <p class="item-text-save">狂省<?=(format_money($v['share_info']['share_total_price']))?>元</p>
                                        <a  href="<?=YLB_Registry::get('url')?>?ctl=Goods_Goods&met=bundling&bid=<?=($v['bundling_id'])?>" class="add_buy_btn" target="_blank">组合省<?=(format_money($v['old_total_price']-$v['bundling_discount_price']))?></a>
                                    </div>
                                </li>
                            <?php }?>
                        </ul>
                    </div>
                </div>
            </div>
          <?php }?>
        <!-- 钱不尽 结束-->
    </div>
<!--    惠省渲染-->
    <script type="text/html" id="HS">
        <%if(share_list.items){%>
            <ul class="clearfix">
                <%for(var i in share_list.items){%>
                <li>
                    <div class="item-pic">
                        <a href="<?=YLB_Registry::get('url')?>?ctl=Goods_Goods&met=goods&cid=<%=share_list.items[i]['common_id']%>" target="_blank"><img src="<%=share_list.items[i]['common_image']%>" alt=""></a>
                    </div>
                    <div class="item-text">
                        <p class="item-text-title"> <a href="<?=YLB_Registry::get('url')?>?ctl=Goods_Goods&met=goods&cid=<%=share_list.items[i]['common_id']%>" target="_blank"><%=share_list.items[i]['common_name']%></a></p>
                        <%if(share_list.items[i]['common_is_jia']==1){%>
                        <span class="item-text-icon">加</span>
                        <%}%>
                        <%if(share_list.items[i]['common_promotion_type']==1){%>
                        <span class="item-text-icon">惠</span>
                        <%}else if(share_list.items[i]['common_promotion_type']==2){%>
                        <span class="item-text-icon">限</span>
                        <%}else if(share_list.items[i]['common_promotion_type']==3){%>
                        <span class="item-text-icon">手</span>
                        <%}else if(share_list.items[i]['common_promotion_type']==4){%>
                        <span class="item-text-icon">新</span>
                        <%}else if(share_list.items[i]['common_promotion_type']==5){%>
                        <span class="item-text-icon">市</span>
                        <%}%>
                        <p class="item-text-save">狂省￥<%=share_list.items[i]['common_share_price']%>元</p>
                    </div>
                </li>
                <%}%>
            </ul>
        <%}%>
    </script>
<!--惠赚渲染-->
    <script type="text/html" id="HZ">
        <%if(share_list.items){%>
            <ul class="clearfix">
                <%for(var i in promotion_list.items){%>
                    <li>
                        <div class="item-pic">
                            <a href="<?=YLB_Registry::get('url')?>?ctl=Goods_Goods&met=goods&cid=<%=promotion_list.items[i]['common_id']%>" target="_blank"><img src="<%=promotion_list.items[i]['common_image']%>" alt=""></a>
                        </div>
                        <div class="item-text">
                            <p  class="item-text-title"><a href="<?=YLB_Registry::get('url')?>?ctl=Goods_Goods&met=goods&cid=<%=promotion_list.items[i]['common_id']%>" target="_blank"><%=promotion_list.items[i]['common_name']%></a></p>
                            <%if(promotion_list.items[i]['common_is_jia']==1){%>
                            <span class="item-text-icon">加</span>
                            <%}%>
                            <%if(promotion_list.items[i]['common_promotion_type']==1){%>
                            <span class="item-text-icon">惠</span>
                            <%}else if(promotion_list.items[i]['common_promotion_type']==2){%>
                            <span class="item-text-icon">限</span>
                            <%}else if(promotion_list.items[i]['common_promotion_type']==3){%>
                            <span class="item-text-icon">手</span>
                            <%}else if(promotion_list.items[i]['common_promotion_type']==4){%>
                            <span class="item-text-icon">新</span>
                            <%}else if(promotion_list.items[i]['common_promotion_type']==5){%>
                            <span class="item-text-icon">市</span>
                            <%}%>
                            <p class="item-text-save">狂赚￥<%=promotion_list.items[i]['common_promotion_price']%>元</p>
                        </div>
                    </li>
                <%}%>
            </ul>
        <%}%>
    </script>
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