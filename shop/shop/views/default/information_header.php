<?php if (!defined('ROOT_PATH')){exit('No Permission');}
include $this->view->getTplPath() . '/' . 'site_nav.php';

/*$search_words = array_map(function($v) {
	return sprintf('<a href="%s?ctl=Goods_Goods&met=goodslist&typ=e&keywords=%s" class="cheap">%s</a>', YLB_Registry::get('url'), urlencode($v), $v);
}, explode(',',  Web_ConfigModel::value('search_words')));

$keywords = current($this->searchWord);*/
$search_array = array();
foreach($this->searchWord as $key => $val)
{
    $search_array[] = $val['search_keyword'];
}

$search_words = array_map(function($v) {
    return sprintf('<a href="%s?ctl=Goods_Goods&met=goodslist&typ=e&keywords=%s" class="cheap">%s</a>', YLB_Registry::get('url'), urlencode($v), $v);
}, $search_array);

$keywords = Web_ConfigModel::value('search_words');

?>
<script type="text/javascript" src="<?=$this->view->js_com?>/jquery.blueberry.js"></script>
<script src="<?=$this->view->js_com?>/plugins/jquery.timeCountDown.js" ></script>
<div class="wrap">
    <div class="head_cont">
        <div style="clear:both;"></div>
        <div class="nav_left">
            <a href="<?=YLB_Registry::get('url')?>" class="logo"><img src="<?php if(Web_ConfigModel::value('subsite_is_open') && isset($_COOKIE['sub_site_logo']) && $_COOKIE['sub_site_logo']!='' && isset($_COOKIE['sub_site_id']) && $_COOKIE['sub_site_id'] > 0){echo $_COOKIE['sub_site_logo'];}else{echo @$this->web['web_logo'];} ?>"/></a>
            <a href="#" class="download iconfont"></a>
        </div>
        <div class="nav_right clearfix" >
            <ul class="clearfix search-types">
                <li class="<?php if(@request_string('ctl')!='Shop_Index') echo 'active'; ?>"><a href="javascript:void(0);" data-param='goods'>宝贝</a></li>
                <li class="<?php if(@request_string('ctl') == 'Shop_Index') echo 'active'; ?>"><a href="javascript:void(0);" data-param='shop'>店铺</a></li>
            </ul>
            <div class="clearfix">
                <form name="form_search" id="form_search" action="">
                    <input type="hidden" id="search_ctl" name="ctl" value="<?php if(@request_string('ctl')!='Shop_Index') echo 'Goods_Goods';else echo 'Shop_Index'; ?>">
                    <input type="hidden" id="search_met" name="met" value="<?php if(@request_string('ctl')!='Shop_Index') echo 'goodslist';else echo 'index'; ?>">
                    <input type="hidden" name="typ" value="e">
                    <input name="keywords" id="site_keywords" value="<?=request_string('keywords', $keywords)?>"  type="text" class="" onclick="this.value = '';" >
                    <input type="submit" style="display: none;" >
                </form>
                <a href="#" class="ser" id="site_search"><?=('搜索')?></a>
                <!-- 购物车 -->
                <div class="bbuyer_cart">
                    <a href="<?= YLB_Registry::get('url') ?>?ctl=Buyer_Cart&met=cart" target="_blank" class="bbc_buyer_icon bbc_buyer_icon2">
                        <i class="ci_left iconfont icon-zaiqigoumai bbc_color rel_top2"></i>
                        <span><?=_('我的购物车')?></span>
                        <i class="ci_right iconfont icon-iconjiantouyou"></i>
                        <i class="ci-count bbc_bg" id="cart_num">0</i>
                    </a>
                </div>
            </div>
            <div class="nav clearfix">
                <?=implode($search_words)?>
            </div>
        </div>
        <div style="clear:both;"></div>
    </div>
    <?php if($this->cat){?>
        <div>
            <div class="thead clearfix">
                <div class="classic clearfix">
                    <div  class="class_title"><span>&equiv;</span><a href="<?=YLB_Registry::get('url')?>?ctl=Goods_Cat&met=goodsCatList" class="ta1">全部分类</a></div>
                    <div class="tleft" id="show" <?php if(( $this->ctl=="Index" && $this->met == "index") || ($this->ctl =="" && $this->met == "") ){?>style="display:block;"<?php }else{?> style="display: none;"<?php }?>>
                        <ul>
                            <?php if($this->cat){
                                $i = 0;
                                foreach ($this->cat as $keyone => $catone) {
                                    if($i < 14){
                                        ?>
                                        <li>
                                            <h3><?php if(!empty($catone['cat_nav'])){ ?>
                                                    <img width="16" height="16" style="margin-right: 6px;"src="<?=$catone['cat_nav']['goods_cat_nav_pic']?>"><a href="<?=YLB_Registry::get('url')?>?ctl=Goods_Goods&met=goodslist&debug=1&cat_id=<?=$catone['cat_nav']['goods_cat_id']?>"><?=$catone['cat_nav']['goods_cat_nav_name']?></a><?php }else{?><a href="<?=YLB_Registry::get('url')?>?ctl=Goods_Goods&met=goodslist&debug=1&cat_id=<?=$catone['cat_id']?>"><?=$catone['cat_name']?></a><?php }?><span class="iconfont icon-iconjiantouyou"></span></h3>

                                            <div class="hover_content clearfix">
                                                <div class="left">
                                                    <div class="channels">
                                                        <?php if(!empty($catone['brand'])){
                                                            foreach ($catone['brand'] as $brand_key => $brand_value) {
                                                                if(7 >=$brand_key && $brand_value){
                                                                    ?>
                                                                    <a href="<?=YLB_Registry::get('url')?>?ctl=Goods_Goods&met=goodslist&debug=1&brand_id=<?=$brand_value['brand_id']?>"><?=$brand_value['brand_name']?><span class="iconfont icon-iconjiantouyou "></span></a>
                                                                <?php } } }?>

                                                    </div>
                                                    <div class="rel_content">
                                                        <?php
                                                        if(!empty($catone['cat_nav'])){


                                                            ?>

                                                            <?php
                                                            foreach ($catone['cat_nav']['goods_cat_nav_recommend_display'] as $key => $value) {
                                                                ?>
                                                                <dl class="clearfix"><dt>
                                                                        <a href="<?=YLB_Registry::get('url')?>?ctl=Goods_Goods&met=goodslist&debug=1&cat_id=<?=$value['cat_id']?>"><?=$value['cat_name']?>&nbsp;&nbsp;<span class="iconfont icon-iconjiantouyou rel_top1"></span></a>
                                                                    </dt>

                                                                    <dd>
                                                                        <?php if(!empty($value['sub'])){
                                                                            foreach ($value['sub'] as $sub_key => $sub_value) {

                                                                                ?>
                                                                                <a href="<?=YLB_Registry::get('url')?>?ctl=Goods_Goods&met=goodslist&debug=1&cat_id=<?=$sub_value['cat_id']?>"><?=$sub_value['cat_name']?></a>
                                                                            <?php } } ?>
                                                                    </dd></dl>
                                                            <?php } ?>

                                                        <?php } ?>
                                                    </div>
                                                </div>

                                                <!-- 广告位-->
                                                <div class="right">
                                                    <!-- 品牌-->
                                                    <ul class="d1ul clearfix">
                                                        <?php if(!empty($catone['brand'])){
                                                            foreach ($catone['brand'] as $brand_key => $brand_value) {
                                                                if(3 >=$brand_key && $brand_value){
                                                                    ?>
                                                                    <li class="">
                                                                        <a href="<?=YLB_Registry::get('url')?>?ctl=Goods_Goods&met=goodslist&debug=1&brand=<?=$brand_value['brand_id']?>"><img src="<?=$brand_value['brand_pic']?>" alt="<?=$brand_value['brand_name']?>">
                                                                            <span><?=$brand_value['brand_name']?></span></a>
                                                                    </li>

                                                                <?php } } }?>
                                                    </ul>
                                                    <ul class="index_ad_big">
                                                        <?php if(!empty($catone['adv'])){
                                                            foreach ($catone['adv'] as $adv_key => $adv_value) {

                                                                ?>
                                                                <li>
                                                                    <a href="#"><img src="<?=$adv_value?>"></a>
                                                                </li>
                                                            <?php }} ?>

                                                    </ul>
                                                </div>
                                            </div>
                                        </li>
                                    <?php } $i++;} }?>
                        </ul>
                    </div>
                </div>

          <nav class="tnav">
                <?php if($data_all_group){
                    foreach ($data_all_group as $key => $val) {
                        if($key<10){
                            ?>
                            <a href="<?=YLB_Registry::get('url')?>?ctl=Information_Base&met=list_row&information_group_id=<?=$key?>">
                                <?=$val['information_group_title']?>
                            </a>
                        <?php }else{
                            return;
                        }}} ?>
            </nav>


            </div>
        </div>
    <?php }?>
</div>
<?php if($this->cat){?>
    <div class="hr" style="background:#c51e1e;"></div>
<?php }?>




<div class="J-global-toolbar">
</div>
