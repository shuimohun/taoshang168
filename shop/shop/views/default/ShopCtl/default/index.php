<?php if (!defined('ROOT_PATH')){exit('No Permission');}?>
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
<link rel="stylesheet"  type="text/css" href="<?=$this->view->css ?>/personalstores.css">
<link rel="stylesheet" type="text/css" href="<?= $this->view->css ?>/goods-detail.css" />
<link rel="stylesheet" type="text/css" href="<?= $this->view->css ?>/Group-integral.css" />
<link rel="stylesheet" type="text/css" href="<?= $this->view->css ?>/goods.css" rel="stylesheet">
<script type="text/javascript" src="<?=$this->view->js?>/goods.js"></script>
<script type="text/javascript" src="<?=$this->view->js?>/common.js"></script>
<script type="text/javascript" src="<?=$this->view->js_com?>/plugins/jquery.toastr.min.js" charset="utf-8"></script>
<link href="<?= $this->view->css ?>/login.css" rel="stylesheet">
    <link href="<?= $this->view->css ?>/tips.css" rel="stylesheet">
    <style>
      .full-screen-slides-pagination{
        display:none !important;
      }
    </style>
<style>
    .share_img:hover{cursor:pointer}
    .cl_content_ul li .tit{width:130px;height:36px;float:right;position:relative;border-radius:0;-webkit-transform-origin:10% 80%;-moz-transform-origin:10% 80%;-ms-transform-origin:10% 80%;-o-transform-origin:10% 80%;transform-origin:10% 80%}
    .cl_content_ul li .tit span{display:block;color:#fff}
    .goodslist_img3{overflow:hidden;width:160px;height:160px}
    .cr_xie li p .share{width:auto;vertical-align:top}
    .cr_xie li p .share u{width:auto}
    .clearfix li{position:relative}
    .cr_xie_name{display:block;width:223px;height:40px!important;line-height:20px;overflow:hidden;text-align:left}
    /*.cr_xie li i{margin-left:10px}*/
    .share_wrap{margin-top: 4px;}
    /*.share_wrap1{position:absolute;left:10px!important;top:295px}*/
    /*.share_wrap2{position:absolute;left:110px;margin-left:18px;top:295px}*/
    .cr_xie li i{margin-top:10px}
    .cr_xie li .cr_xie_mon{position:absolute;left:3%;top:57%}
    .wrap{width:100%!important;margin:0 auto}
    .head_cont{width:1200px!important;margin:0 auto}
    .ncsl-nav-banner{overflow:hidden}
    .store-decoration-block-1{width:100%!important;overflow:hidden;text-align:center}
    .t_goods_bot{width:1200px;margin:0 auto}
    .store-decoration-page .goods-list{margin-bottom:10px}
    .ncs-top-panel ol li{padding:0;margin:0;width:100%;border:1px solid #fff}
    .ncs-top-panel ol li:hover{border:1px solid #c51e1e}
    .ncs-top-panel ol li>dl{width:100%;height:auto;padding-bottom:12px}
    .ncs-top-panel ol .goods-pic{width:100%;height:198px;position:relative}
    .ncs-top-panel ol .goods-pic>a{width:100%;height:100%;padding:0;text-align:center}
    .ncs-top-panel ol .goods-pic>a img{width:198px;height:100%}
    .ncs-top-panel ol .goods-pic .img-title{display:none;position:absolute;bottom:0;left:5px;width:196px;background-color:rgba(0,0,0,.6);color:#fff;height:34px;line-height:17px;overflow:hidden}
    .ncs-top-panel .price.pngFix.bbc_color,.ncs-top-panel dd.selled{margin-left:0;font-size:14px;margin-top:5px}
    .ncs-top-panel .share_wrap_cart.rt,.ncs-top-panel dd.selled{margin-right:3px}
    .ncs-top-panel .price.pngFix.bbc_color,.ncs-top-panel .share_wrap_cart.lf{margin-left:3px}
    .ncs-top-panel .price.pngFix.bbc_color{display:inline-block}
    .ncs-top-panel .share_div_cart{overflow:hidden;margin-top:6px;font-size:14px}
    .ncs-top-panel dd.goods-pic a{border:none}
    .con-div{display:inline-block;height: 30px;width: auto !important;text-align: center;margin-top:9px;}
    .one-key {float:left;background-color: #e45050;color:#fff;line-height: 30px;padding:0 30px;/*top:324px;*/}
    .one-key a{color:#fff;}
    .con-div>a{float: left;}
    .cr_xie_lia2{width:auto !important;height:28px !important;line-height: 28px;border:1px solid #ddd;padding: 0 6px;float: left;}
    .cr_xie_lia2 .cr_xie_lia2_span1{vertical-align: middle;}
    .list_padd>p.profit-ratio, .list_padd.img-b{margin-top: 4px;}
    .list_padd{padding: 0 10px;}
    .list_padd>p.profit-ratio{display: block;width: 100%;height: 45px;}
</style>
<div style="width:1200px;position: relative;margin: 0 auto;">
    <div class="bbc-store-info">
        <div class="basic">
            <div class="displayed"><a href=""><?=$shop_base['shop_name']?></a>
                <span class="all-rate">
                     <div class="rating"><span style="width: <?=$shop_scores_percentage?>%"></span></div>
                       <em><?=$shop_scores_count?></em><em>分</em></span>
            </div>
            <div class="sub">
                <div class="store-logo"><img src="<?php if(empty($shop_base['shop_logo'])){ echo $this->web['shop_head_logo']; }else{echo $shop_base['shop_logo']; } ?>" alt="<?=$shop_base['shop_name']?>" title="<?=$shop_base['shop_name']?>"></div>
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
                        <div class="btns"><a href="index.php?ctl=Shop&met=goodsList&id=<?=$shop_id?>" class="goto">进店逛逛</a><a href="javascript:;" onclick="collectShop(<?=$shop_id?>)">收藏店铺</a></div>
                        <?php /*if(!empty($shop_all_base)){*/?><!--
                            <dl class="no-border">
                                <dt>公司名称：</dt>
                                <dd><?/*=$shop_all_base['shop_company_name']*/?></dd>
                            </dl>
                            <dl>
                                <dt>电　　话：</dt>
                                <dd><?/*=$shop_all_base['company_phone']*/?></dd>
                            </dl>
                            <dl>
                                <dt>所&nbsp;&nbsp;在&nbsp;&nbsp;地：</dt>
                                <dd><?/*=$shop_all_base['shop_company_address']*/?></dd>
                            </dl>
                        --><?php /*}*/?>
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
<?php if(!empty($shop_base['is_renovation'])) {?>

<div class="wrap clearfix">
<div id="store_decoration_content" class="background" style="<?php echo $decoration_detail['decoration_background_style'];?>">
<?php if(!empty($decoration_detail['decoration_nav'])) {?>
    <style><?php echo $decoration_detail['decoration_nav']['style'];?></style>
<?php } ?>
<div class="ncsl-nav">
    <?php if(isset($decoration_detail['decoration_banner'])) { ?>
        <!-- 启用店铺装修 -->
        <?php if(@$decoration_detail['decoration_banner']['display'] == 'true') { ?>
            <div id="decoration_banner" class="ncsl-nav-banner" style="text-align: center;">
                <img src="<?php echo $decoration_detail['decoration_banner']['image_url'];?>" alt="">
            </div>
        <?php } ?>
    <?php } else { ?>
        <!-- 不启用店铺装修 -->
        <div class="banner">
            <a href="" class="img">
                <?php if(!empty($decoration_detail['store_info']['store_banner'])){?>
                    <img src="" alt="<?php echo $decoration_detail['store_info']['store_name']; ?>" title="<?php echo $decoration_detail['store_info']['store_name']; ?>" class="pngFix">
                <?php }else{?>
                    <div class="ncs-default-banner"></div>
                <?php }?>
            </a>
        </div>
    <?php } ?>

    <?php if(!empty($decoration_detail['decoration_nav']) || $decoration_detail['decoration_nav']['display'] == 'true') {?>
        <div id="nav" class="ncs-nav">
            <ul>
            <li class="active9"><a href="index.php?ctl=Shop&met=index&id=<?=$shop_id?>"><span>店铺首页<i></i></span></a></li>
            <li class="active9"><a href="index.php?ctl=Shop&met=activity&id=<?=$shop_id?>"><span>优惠活动<i></i></span></a></li>
            <?php if($shop_nav['items']){ foreach ($shop_nav['items'] as $key => $value) {?>
                <li><a href="<?php if(!empty($value['url'])) echo $value['url'];else echo 'index.php?ctl=Shop&met=info&id='.$shop_id.'&nav_id='.$value['id']; ?>" <?php if($value['target']){?>target="_blank" <?php } ?>><span><?=$value['title']?><i></i></span></a></li>
            <?php }} ?>
            </ul>
        </div>
    <?php } ?>
</div>
<?php require('store_decoration.preview.php');} ?>
</div>
</div>

<?php if(($shop_base['is_renovation'] && $shop_base['is_only_renovation']=="0") || !$shop_base['is_renovation']){?>
<div class="wrap clearfix">
    <?php if(empty($shop_base['is_renovation'])){?>

        <div class="clearfix">
            <div class="div_shop_Carouselfigure1" style="overflow: hidden;background:#fff;">
                <?php if(!empty($shop_base['shop_banner']) ){ ?>
                    <img src="<?=$shop_base['shop_banner']?>" /></a>
                <?php }else{ ?>
                    <img src="<?= $this->view->img ?>/shop_img.png"  /></a>
                <?php } ?>
            </div>
        </div>

        <div id="nav" class="ncs-nav">
            <ul>
                <li class="active9"><a href="index.php?ctl=Shop&met=index&id=<?=$shop_id?>"><span>店铺首页<i></i></span></a></li>
                <li class="active9"><a href="index.php?ctl=Shop&met=activity&id=<?=$shop_id?>"><span>优惠活动<i></i></span></a></li>
                <?php if($shop_nav['items']){ foreach ($shop_nav['items'] as $key => $value) {?>
                    <li><a href="<?php if(!empty($value['url'])) echo $value['url'];else echo 'index.php?ctl=Shop&met=info&id='.$shop_id.'&nav_id='.$value['id']; ?>" <?php if($value['target']){?>target="_blank" <?php } ?>><span><?=$value['title']?><i></i></span></a></li>
                <?php }} ?>
            </ul>
        </div>

        <div class="clearfix">
            <div class="div_shop_Carouselfigure" style="max-height:600px;">
                <div class="swiper-container">
                <ul class="ui_shop_Carouselfigure items clearfix swiper-wrapper">
                    <?php if(!empty($shop_slide)){ foreach ($shop_slide as $key => $value) { if($value){?>
                        <li class="swiper-slide"><a href="<?=$shop_slide_url[$key]?>"><img src="<?=$value ?>" width="max-height:600px" /></a></li>
                    <?php }}}?>
                </ul>
                <!-- Add Pagination -->
                <div class="swiper-pagination"></div>
                    <script type="text/javascript">
                        $(document).ready(function () {
                            var swiper = new Swiper('.swiper-container', {
                                pagination: '.swiper-pagination',
                                paginationClickable: true,
                                autoplayDisableOnInteraction: false,
                                autoplay: 3000,
                                speed: 300,
                                loop: true,
                                grabCursor: true,
                                paginationClickable: true,
                                lazyLoading: true
                            });
                        });
                    </script>
                </div>
            </div>
        </div>
    <?php }?>
    <div class="t_goods_bot clearfix">
    <div class="t_goods_bot_left">
      <div class="goods_classify">
        <h4>商品分类</h4>
        <p class="classify_like"><a href="index.php?ctl=Shop&met=goodsList&id=<?=$shop_id?>&order=common_sell_time&sort=desc">按新品</a><a href="index.php?ctl=Shop&met=goodsList&id=<?=$shop_id?>&order=common_price&sort=desc">按价格</a><a href="index.php?ctl=Shop&met=goodsList&id=<?=$shop_id?>&order=common_salenum&sort=desc">按销量</a><a href="index.php?ctl=Shop&met=goodsList&id=<?=$shop_id?>&order=common_collect&sort=desc">按收藏</a></p>
        <p class="classify_ser">
          <input  name="searchGoodsList" type="text" value="搜索店内商品" onclick="this.value = '';">
          <a  id="searchGoodsList">搜索</a>
        </p>
        <ul class="ser_lists">
          <li><a href="index.php?ctl=Shop&met=goodsList&id=<?=$shop_id?>">全部商品</a></li>
           <?php if(!empty($shop_cat)){
                    foreach ($shop_cat as $key => $value) {
                ?>
          <li><a href="index.php?ctl=Shop&met=goodsList&id=<?=$shop_id?>&shop_cat_id=<?=$value['shop_goods_cat_id']?>"><?=$value['shop_goods_cat_name']?></a></li>
                  <?php if(!empty($value['subclass'])){
                              foreach ($value['subclass'] as $keys => $values) {
                      ?>
          <li class="list_style"><a href="index.php?ctl=Shop&met=goodsList&id=<?=$shop_id?>&shop_cat_id=<?=$values['shop_goods_cat_id']?>"><?=$values['shop_goods_cat_name']?></a></li>
                              <?php } } } }?>
        </ul>
      </div>
      <div class="goods_ranking">
        <h4>商品排行</h4>
     <ul class="ncs-top-tab pngFix">
      <li id="hot_sales_tab" class="current"><a >热销商品排行</a></li>
      <li id="hot_collect_tab"><a>热门收藏排行</a></li>
    </ul>
    <div id="hot_sales_list" class="ncs-top-panel">
            <ol>

                <?php if(!empty($goods_selling_list['items'])){
                    foreach ($goods_selling_list['items'] as $key => $value) {
                ?>
          <li>
          <li>
          <dl>
            <!-- <dt></dt> -->
            <dd class="goods-pic"><a href="index.php?ctl=<?=$ctl?>&met=goods&gid=<?=$value['goods_id']?>" class="img-title"><?=$value['common_name']?></a><a href="index.php?ctl=<?=$ctl?>&met=goods&gid=<?=$value['goods_id']?>"><span class="thumb size40"><i></i><img src="<?=$value['common_image']?>"></span></a>
             <!--  <p><span class="thumb size100"><i></i><img src="<?=$value['common_image']?>" style="width:100px;height: 100px;" title="<?=$value['common_name']?>"><big></big><small></small></span></p> -->
            </dd>
            <dd class="price pngFix bbc_color"><?=format_money($value['common_price']) ?></dd>
            <dd class="selled pngFix rt">售出：<strong class="num-color"><?=$value['common_salenum']?></strong>笔</dd>
              <div class="share_div_cart">
                  <p class="share_wrap_cart lf">
                    <span class="share_cart">立减
                        <u>￥<?=$value['common_share_price']?></u>
                    </span>
                  </p>
                  <p class="share_wrap_cart rt">
                    <span class="share_cart">立赚
                        <u>￥<?=$value['common_promotion_price']?></u>
                    </span>
                  </p>
                  <p class="clear"></p>
              </div>
          </dl>
        </li>
                <?php } }?>

              </ol>
      </div>
    <div id="hot_collect_list" class="ncs-top-panel hide">
            <ol>
               <?php if(!empty($goods_collec_list['items'])){
                    foreach ($goods_collec_list['items'] as $key => $value) {
                ?>
          <li>
          <li>
          <dl>
            <!-- <dt></dt> -->
            <dd class="goods-pic"><a href="index.php?ctl=<?=$ctl?>&met=goods&gid=<?=$value['goods_id']?>" class="img-title"><?=$value['common_name']?></a><a href="index.php?ctl=<?=$ctl?>&met=goods&gid=<?=$value['goods_id']?>"><span class="thumb size40"><i></i><img src="<?=$value['common_image']?>"></span></a>
             <!--  <p><span class="thumb size100"><i></i><img src="<?=$value['common_image']?>" style="
              width:100px;height: 100px;" title="<?=$value['common_name']?>"><big></big><small></small></span></p> -->
            </dd>
            <dd class="price pngFix bbc_color"><?=format_money($value['common_price']) ?></dd>
            <dd class="selled pngFix rt">收藏人气：<strong><?=$value['common_collect']?></strong></dd>
              <div class="share_div_cart">
                  <p class="share_wrap_cart lf">
                            <span class="share_cart">立减
                                <u>￥<?=$value['common_share_price']?></u>
                            </span>
                  </p>
                  <p class="share_wrap_cart rt">
                            <span class="share_cart">立赚
                                <u>￥<?=$value['common_promotion_price']?></u>
                            </span>
                  </p>
                  <p class="clear"></p>
              </div>


          </dl>
        </li>
                <?php } }?>

              </ol>
          </div>

          <a href="./index.php?ctl=Shop&met=goodsList&id=<?=$shop_id ?>"><p class="look_other_goods bbc_btns">查看本店其他商品</p></a>
      </div>

        <?php if (isset($data_hot)):?>
        <div class="current_hot">
            <h4>本店热门惠抢购</h4>
            <ul>
                <?php  foreach ($data_hot as $key_hot => $value_hot):  ?>
                    <li>
                        <a href="./index.php?ctl=<?=$ctl?>&met=goods&gid=<?= $value_hot['goods_id'] ?>">
                            <img src="<?= $value_hot['goods_image'] ?>">
                        </a>
                        <h5><?= $value_hot['goods_name'] ?></h5>

                        <p class="current_hot_price bbc_color"><span class="common-color"><?=format_money($value_hot['scarebuy_price']) ?></span></p>

                        <div class="current_hot__look clearfix"> <a class="bbc_btns" href="./index.php?ctl=<?=$ctl?>&met=goods&gid=<?= $value_hot['goods_id'] ?>">去看看</a>
                        </div>
                    </li>
                <?php  endforeach; ?>
            </ul>
            <div class="hot_all"><a href="./index.php?ctl=ScareBuy&met=index" class="bbc_btns">全部热门惠抢购</a></div>
        </div>
        <?php endif;?>
    </div>
    <div class="t_goods_bot_right-1">

      <div class="bbc-main-container">
          <div class="title"> <span><a href="index.php?ctl=Shop&met=goodsList&id=<?=$shop_id?>" class="more">更多<span class="iconfont icon-iconjiantouyou rel_top-3"></span></a></span>
          <h4>推荐商品</h4>
        </div>

          <!-- 推荐商品 start -->
          <ul class="cr_xie clearfix" >
              <?php if($goods_recom_list['items']):
              foreach($goods_recom_list['items'] as $key => $val):?>
                  <li style="float:left;">
                      <?php if(isset($val['good']))
                      {
                          $id = 'gid='. $val['goods_id'];
                      }else{
                          $id = 'gid=0';
                      }?>

                      <div class="goodslist_img">
                          <a href="<?=YLB_Registry::get('url')?>?ctl=<?=$ctl?>&met=goods&type=goods&<?=$id?>">
                          <img src="<?=image_thumb($val['common_image'],220,220)?>"  width="220" height="220"/>
                          </a>
                      </div>
                      <div class="list_padd orflow">
                          <span class="sub">减免前:<?=format_money($val['common_price'])?></span>
                          <span class="cr_xie_mon bbc_color">
                            <?=format_money($val['common_price']-$val['share_total_price'])?>
                        </span>

                          <span class="cr_xie_amon"></span>
                      </div>

                      <div class="list_padd img-b">
                          <a href="<?=YLB_Registry::get('url')?>?ctl=<?=$ctl?>&met=goods&type=goods&<?=$id?>" target="_blank" class="cr_xie_name" title="<?=($val['common_name'])?>">
                              <?php if(mb_strwidth($val['common_name'],'utf8')>60){
                                  echo $str=mb_strimwidth($val['common_name'],0,60,'...','utf8');
                              }else{
                                  echo $val['common_name'];
                              }?>
                          </a>

                          <?php if( $val['product_is_behalf_delivery']){?>
                              <div style="display: block;overflow: hidden;">
                                  <p class='share_wrap share_wrap1'><span class='share'>分享立减<u><?=format_money($val['share_total_price'])?></u></span></p>
                                  <p class='share_wrap share_wrap2'><span class='share'>立赚<u><?=format_money($val['promotion_total_price'])?></u></span></p>
                              </div>
                              <!--0未参加活动 1惠抢购 2限时折扣 3手机专享 4新人优惠-->
                              <?php if($val['common_is_xian'] == 1){?><i>限时</i><?php }else{}?>
                              <?php if($val['common_promotion_type'] == 4){?><i>新</i><?php }else{}?>
                              <?php if($val['common_promotion_type'] == 3){?><i>手机</i><?php }else{}?>
                              <?php if($val['is_man'] == 1){?><i>满</i><?php }else{}?>
                              <?php if($val['common_is_jia'] == 1){?><i>加</i><?php }else{}?>
                              <?php if($val['common_is_qiang'] == 1){?><i>抢</i><?php }else{ echo "<div style='height:45px;'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>";}?>
                              <em>评分：
                                  <?php for($i = 0;$i<$val['good'][0]['goods_evaluation_good_star'];$i++){?>
                                      <img src="<?=$this->view->img?>/goods/star_y.png" alt="">
                                  <?php }?>
                              </em>
                              <img src="<?=$this->view->img?>/goods/share_n.png" alt="" class="share_n share share_img" prices='<?=json_encode($val["share_price"])?>' gid="<?=$val['goods_id']?>" gimg="<?=$val['common_image']?>" gname="<?=$val['common_name']?>" sum_prices="<?=$val['share_total_price']?>">
                              <img src="<?=$this->view->img?>/goods/<?php if($val['is_favorite']){?>book_n.png<?php }else{?>book_s.png<?php }?>" alt="" class="book_s share_img cllectGoods" id="coll_<?=(@$val['goods_id'])?>" data-cflag="<?=$val['is_favorite']?>" data-goods_id="<?=$val['goods_id']?>">
                          <?php }else if($shop_base['shop_type'] == 2){?>

                                <p class="profit-ratio">
                                    <span class="mar-r _letter-spacing"><span>利润比：</span></span>
                                    <span class="mar-b-1" style="color:#e45050;font-weight:bold;"> 0.00 % ~ 40.00 %</span>
                                </p>

                                <div class="con-div">
                                    <a onclick="collectGoods(<?=(@$val['goods_id'])?>)" class="cr_xie_lia2" id="coll_<?=(@$val['goods_id'])?>">
                                        <span class="cr_xie_lia2_span1 iconfont <?php if($val['is_favorite']){?> icon-taoxinshi bbc_color <?php }else{?> icon-icoheart <?php }?>"></span>
                                        <span class="cr_xie_lia2_span2">收藏</span>
                                    </a>
                                    <span class="one-key"><a href="javascript:;">一键上架</a></span>
                                </div>

                          <?php }?>
                      </div>
                  </li>
              <?php endforeach;?>
          </ul>
          <?php endif; ?>
          <!-- 推荐商品 end  -->

      </div>

      <div class="bbc-main-container">
        <div class="title"><span><a href="index.php?ctl=Shop&met=goodsList&id=<?=$shop_id?>" class="more">更多<span class="iconfont icon-iconjiantouyou rel_top-3"></span></a></span>
          <h4>新品</h4>
        </div>

            <!-- 新品 start -->
            <ul class="cr_xie clearfix" >
                <?php if($goods_new_list['items']):
                foreach($goods_new_list['items'] as $key => $val):?>

                    <li style="float:left;">
                        <?php if(isset($val['good']))
                        {
                            $id = 'gid='. $val['goods_id'];
                        }else{
                            $id = 'gid=0';
                        }?>

                        <div class="goodslist_img">
                            <a href="<?=YLB_Registry::get('url')?>?ctl=<?=$ctl?>&met=goods&type=goods&<?=$id?>">
                                <img src="<?=image_thumb($val['common_image'],220,220)?>" width="220" height="220"/>
                            </a>
                        </div>
                        <div class="list_padd orflow">
                            <span class="sub">减免前:<?=format_money($val['common_price'])?></span>
                            <span class="cr_xie_mon bbc_color">
                                <?=format_money($val['common_price']-$val['share_total_price'])?>
                            </span>
                            <span class="cr_xie_amon"></span>
                        </div>
                        
                        <div class="list_padd img-b">
                            <a href="<?=YLB_Registry::get('url')?>?ctl=<?=$ctl?>&met=goods&type=goods&<?=$id?>" target="_blank" class="cr_xie_name" title="<?=($val['common_name'])?>">
                                <?php if(mb_strwidth($val['common_name'],'utf8')>60){
                                    echo $str=mb_strimwidth($val['common_name'],0,60,'...','utf8');
                                }else{
                                    echo $val['common_name'];
                                }?>
                            </a>
                            <?php if( $val['product_is_behalf_delivery']){?>
                               <div style="display: block;overflow: hidden;">
                                    <p class='share_wrap share_wrap1'><span class='share'>分享立减<u><?=format_money($val['share_total_price'])?></u></span></p>
                                    <p class='share_wrap share_wrap2'><span class='share'>立赚<u><?=format_money($val['promotion_total_price'])?></u></span></p>
                               </div>
                                <!--0未参加活动 1惠抢购 2限时折扣 3手机专享 4新人优惠-->
                                <?php if($val['common_is_xian'] == 1){?><i>限时</i><?php }else{}?>
                                <?php if($val['common_promotion_type'] == 4){?><i>新</i><?php }else{}?>
                                <?php if($val['common_promotion_type'] == 3){?><i>手机</i><?php }else{}?>
                                <?php if($val['is_man'] == 1){?><i>满</i><?php }else{}?>

                                <?php if($val['common_is_jia'] == 1){?><i>加</i><?php }else{}?>
                                <?php if($val['common_is_qiang'] == 1){?><i>抢</i><?php }else{ echo "<div style='height:45px;'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>";}?>
                                <em>评分：
                                    <?php for($i = 0;$i<$val['good'][0]['goods_evaluation_good_star'];$i++){?>
                                        <img src="<?=$this->view->img?>/goods/star_y.png" alt="">
                                    <?php }?>
                                </em>
                                <img src="<?=$this->view->img?>/goods/share_n.png" alt="" class="share_n share share_img" prices='<?=json_encode($val["share_price"])?>' gid="<?=$val['goods_id']?>" gimg="<?=$val['common_image']?>" gname="<?=$val['common_name']?>" sum_prices="<?=$val['share_total_price']?>">
                                <img src="<?=$this->view->img?>/goods/<?php if($val['is_favorite']){?>book_n.png<?php }else{?>book_s.png<?php }?>" alt="" class="book_s share_img cllectGoods" id="coll_<?=(@$val['goods_id'])?>" data-cflag="<?=$val['is_favorite']?>" data-goods_id="<?=$val['goods_id']?>">
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
            <?php endif; ?>
            <!-- 新品 end  -->

      </div>

        <div class="bbc-main-container">
            <div class="title">
                <h4>猜你喜欢</h4>
            </div>

            <ul class="cr_xie clearfix" >
                <?php if($shop_common_like){
                foreach($shop_common_like as $key => $val){ ?>

                    <li style="float:left">
                        <?php if(isset($val['id_goods']))
                        {
                            $id = 'gid='. $val['id_goods'];
                        }else{
                            $id = 'gid=0';
                        }?>

                        <div class="goodslist_img">
                            <a href="<?=YLB_Registry::get('url')?>?ctl=<?=$ctl?>&met=goods&type=goods&<?=$id?>">
                                <img src="<?=image_thumb($val['common_image'],220,220)?>" width="220" height="220"/>
                            </a>
                        </div>
                        <span class="sub">减免前:<?=format_money($val['common_price'])?></span>
                        <span class="cr_xie_mon bbc_color">
                            <?=format_money($val['common_price']-$val['share_total_price'])?>
                        </span>
                        <span class="cr_xie_amon"></span>
                        <div class="list_padd">
                            <a href="<?=YLB_Registry::get('url')?>?ctl=<?=$ctl?>&met=goods&type=goods&<?=$id?>" target="_blank" class="cr_xie_name" title="<?=($val['common_name'])?>">
                                <?php if(mb_strwidth($val['common_name'],'utf8')>60){
                                    echo $str=mb_strimwidth($val['common_name'],0,60,'...','utf8');
                                }else{
                                    echo $val['common_name'];
                                }?>
                            </a>

                            <?php if( $val['product_is_behalf_delivery']){?>
                                <div style="display: block;overflow: hidden;">
                                    <p class='share_wrap share_wrap1'><span class='share'>分享立减<u><?=format_money($val['share_total_price'])?></u></span></p>
                                    <p class='share_wrap share_wrap2'><span class='share'>立赚<u><?=format_money($val['promotion_total_price'])?></u></span></p>
                                </div>
                                <!--0未参加活动 1惠抢购 2限时折扣 3手机专享 4新人优惠-->
                                <?php if($val['common_is_xian'] == 1){?><i>限时</i><?php }else{}?>
                                <?php if($val['common_promotion_type'] == 4){?><i>新</i><?php }else{}?>
                                <?php if($val['common_promotion_type'] == 3){?><i>手机</i><?php }else{}?>
                                <?php if($val['is_man'] == 1){?><i>满</i><?php }else{}?>

                                <?php if($val['common_is_jia'] == 1){?><i>加</i><?php }else{}?>
                                <?php if($val['common_is_qiang'] == 1){?><i>抢</i><?php }else{ echo "<div style='height:45px;'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>";}?>
                                <em>评分：
                                    <?php for($i = 0;$i<$val['good'][0]['goods_evaluation_good_star'];$i++){?>
                                        <img src="<?=$this->view->img?>/goods/star_y.png" alt="">
                                    <?php }?>
                                </em>
                                <img src="<?=$this->view->img?>/goods/share_n.png" alt="" class="share_n share share_img" prices='<?=json_encode($val["share_price"])?>' gid="<?=$val['goods_id']?>" gimg="<?=$val['common_image']?>" gname="<?=$val['common_name']?>" sum_prices="<?=$val['share_total_price']?>">
                                <img src="<?=$this->view->img?>/goods/<?php if($val['is_favorite']){?>book_n.png<?php }else{?>book_s.png<?php }?>" alt="" class="book_s share_img cllectGoods" id="coll_<?=(@$val['goods_id'])?>" data-cflag="<?=$val['is_favorite']?>" data-goods_id="<?=$val['goods_id']?>">
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
                <?php }?>
            </ul>
            <?php } ?>


        </div>

    </div>
  </div>
<?php }?>
</div>


<script>
    $("input[name='searchGoodsList']").blur(function(){
        var search = $("input[name='searchGoodsList']").val();
        if(search)
        {
            $("#searchGoodsList").attr('href',SITE_URL + '?ctl=Shop&met=goodsList&id=' + <?=$shop_id?>+'&search='+search);
        }
    });

        $(document).ready(function(){
        //热销排行切换
            $('#hot_sales_tab').on('mouseenter', function() {
                $(this).addClass('current');
                $('#hot_collect_tab').removeClass('current');
                $('#hot_sales_list').removeClass('hide');
                $('#hot_collect_list').addClass('hide');
            });
            $('#hot_collect_tab').on('mouseenter', function() {
                $(this).addClass('current');
                $('#hot_sales_tab').removeClass('current');
                $('#hot_sales_list').addClass('hide');
                $('#hot_collect_list').removeClass('hide');
            });
    });
   	//收藏店铺
	window.collectShop = function(e){
		if ($.cookie("key"))
        {
			$.post(SITE_URL  + '?ctl=Shop&met=addCollectShop&typ=json',{shop_id:e},function(data)
			{
				if(data.status == 200)
				{
				    Public.tips.success(data.data.msg);
					//$.dialog.alert(data.data.msg);
				}
				else
				{
				    Public.tips.error(data.data.msg);
					//$.dialog.alert(data.data.msg);
				}
			});
		}
		else
		{
            $("#login_content").show();
        }
	}
</script>

<!--收藏/取消收藏 商品 start @刘贵龙 20170630 -->
<script>
    $('.cllectGoods').bind('click',function(){

        if ($.cookie('key'))
        {
            var cflag = $(this).data('cflag');
            var goods_id = $(this).data('goods_id');
            if(cflag == 1){
                $.post(SITE_URL  + '?ctl=Goods_Goods&met=canleCollectGoods&typ=json',{goods_id:goods_id},function(data)
                {
                    if(data.status == 200)
                    {
                        Public.tips.error('取消收藏成功!');
                        $("#coll_"+goods_id).attr('src','<?=$this->view->img?>/goods/book_s.png');
                        $("#coll_"+goods_id).data('cflag',0);
                    } else {
                        Public.tips.error(data.data.msg);
                    }
                });
            }else{
                $.post(SITE_URL  + '?ctl=Goods_Goods&met=collectGoods&typ=json',{goods_id:goods_id},function(data)
                {
                    if(data.status == 200)
                    {
                        Public.tips.success('收藏成功!');
                        $("#coll_"+goods_id).attr('src','<?=$this->view->img?>/goods/book_n.png');
                        $("#coll_"+goods_id).data('cflag',1);
                    } else {
                        Public.tips.error(data.data.msg);
                    }
                });
            }
        } else {
            $("#login_content").show();
        }
    })
</script>
<!--收藏/取消收藏 商品 end -->

<!--立即分享 start-->
<!--分享立减 Dom-->
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

<!--分享立减 Js-->
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
        })

        $('#closebt').on('click',function(){
            $('#code').hide();
            $('#sharecover').hide();
        })
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
<!--立即分享 end-->


<div class="bbuilder_code">
    <span class="bbc_codeArea"><img src="<?=YLB_Registry::get('base_url')?>/shop/api/qrcode.php?data=<?= urlencode(YLB_Registry::get('shop_wap_url')."/tmpl/store.html?shop_id=".$shop_base['shop_id'])?>"></span>
    <span class="bbc_arrow"></span>
    <div class="bbc_guide_con">
      <span>
          <div class="service-list1 service-list2" store_id="8" store_name="12312312发发">

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

    $(function() {
        $(".ncs-top-panel ol li").on("mouseover", function() {
            var _this = $(this);
            _this.find(".img-title").show();
        })
        $(".ncs-top-panel ol li").on("mouseleave", function() {
            var _this = $(this);
            _this.find(".img-title").hide();
         })
    })

    //收藏商品
    window.collectGoods = function(e){
        if (<?=Perm::checkUserPerm()?1:0?>)
        {
            $.post(SITE_URL  + '?ctl=Goods_Goods&met=collectGoods&typ=json',{goods_id:e},function(data)
            {
                if(data.status == 200)
                {
                    Public.tips.success(data.data.msg);
                    $("#coll_"+e).find(".iconfont").removeClass('icon-icoheart');
                    $("#coll_"+e).find(".iconfont").addClass('icon-taoxinshi').addClass('bbc_color');
                }
                else
                {
                    Public.tips.error(data.data.msg);
                }
            });
        }
    };
        
</script>

<?php
include $this->view->getTplPath() . '/' . 'footer.php';
?>
