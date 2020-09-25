<?php if (!defined('ROOT_PATH')){exit('No Permission');}
include $this->view->getTplPath() . '/' . 'site_nav.php';


$search_words = array_map(function($v) {
	return sprintf('<a href="%s?ctl=Fresh_Goods&met=goodslist&typ=e&keywords=%s" class="cheap">%s</a>', YLB_Registry::get('url'), urlencode($v), $v);
}, explode(',',  Web_ConfigModel::value('search_words')));

$keywords = current($this->searchWord);

?>
<script type="text/javascript" src="<?=$this->view->js_com?>/jquery.blueberry.js"></script>
<script src="<?=$this->view->js_com?>/plugins/jquery.timeCountDown.js" ></script>
<div class="wrap">
	<div class="head_cont">
		<div style="clear:both;"></div>
		<div class="nav_left">
			<a href="?ctl=Fresh_Index&met=index" class="logo"><img src="<?=@$this->web['fresh_logo']?>"/></a>
			<a href="#" class="download iconfont"></a>
		</div>
		<div class="nav_right clearfix" >
			<div class="clearfix">
				<form name="form_search" id="form_search" action="">
					<input type="hidden" name="ctl" value="Fresh_Goods">
					<input type="hidden" name="met" value="goodslist">
					<input type="hidden" name="typ" value="e">
					<input name="keywords" id="site_keywords" value="<?=request_string('keywords', $keywords['search_keyword'])?>"  type="text" class="" onclick="this.value = '';" >
					<input type="submit" style="display: none;" >
				</form>
				<a href="#" class="ser" id="site_search"><?=('搜索')?></a>
				<!-- 购物车 -->
				<div class="bbuyer_cart">
					<div class="bbc_buyer_icon bbc_buyer_icon2">
						<i class="ci_left iconfont icon-zaiqigoumai bbc_color rel_top2"></i>
						<a href="<?= YLB_Registry::get('url') ?>?ctl=Buyer_Cart&met=cart" target="_blank"><?=_('我的购物车')?></a>
						<i class="ci_right iconfont icon-iconjiantouyou"></i>
						<i class="ci-count bbc_bg" id="cart_num">0</i>
					</div>
				</div>
			</div>
			<div class="nav clearfix">
				<?=implode($search_words)?>
			</div>
		</div>
		<div style="clear:both;"></div>
	</div>
	<div>
		<div class="thead clearfix">
			<div class="classic clearfix">
				<div  class="class_title"><span>&equiv;</span><a href="#" class="ta1">全部分类</a></div>
				<div class="tleft" id="show"  style="display: none;">
					<ul>
						<?php if($this->cat){ foreach ($this->cat as $keyone => $catone) {?>
                            <li>
                                <h3>
                                    <a href="index.php?ctl=Fresh_Goods&met=goodslist&debug=1&cat_id=<?=$catone['cat_id']?>"><?=$catone['cat_name']?></a>
                                    <span class="iconfont icon-iconjiantouyou"></span>
                                </h3>
                                <div class="hover_content clearfix">
                                    <div class="left">
                                        <div class="channels">
                                            <?php if(!empty($catone['brand'])){
                                                foreach ($catone['brand'] as $brand_key => $brand_value) {
                                                    if(7 >=$brand_key && $brand_value){
                                                        ?>
                                                        <a href="index.php?ctl=Fresh_Goods&met=goodslist&debug=1&brand_id=<?=$brand_value['brand_id']?>"><?=$brand_value['brand_name']?><span class="iconfont icon-iconjiantouyou "></span></a>
                                                    <?php } } }?>

                                        </div>
                                        <div class="rel_content">
                                            <?php if(!empty($catone['sub'])){ ?>
                                                <dl class="clearfix">
                                                    <dd>
                                                        <?php foreach ($catone['sub'] as $key => $value) { ?>
                                                        <a href="index.php?ctl=Fresh_Goods&met=goodslist&debug=1&cat_id=<?=$value['cat_id']?>"><?=$value['cat_name']?></a>
                                                        <?php } ?>
                                                    </dd>
                                                </dl>
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
                                                            <a href="index.php?ctl=Fresh_Goods&met=goodslist&debug=1&brand=<?=$brand_value['brand_id']?>"><img src="<?=$brand_value['brand_pic']?>" alt="<?=$brand_value['brand_name']?>">
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
                        <?php } } ?>
					</ul>
				</div>
			</div>
			<nav class="tnav">
				<?php if($this->nav){
					foreach ($this->nav['items'] as $key => $nav) {
						if($key<10){
							?>
							<a href="<?=$nav['nav_url']?>" <?php if($nav['nav_new_open']==1){?>target="_blank"<?php } ?>><?=$nav['nav_title']?></a>
						<?php }else{
							return;
						}}} ?>
			</nav>
			<p class="high_gou"><!--<img src="">--></p>
		</div>
	</div>
</div>
<div class="hr" style="background:#c51e1e;">
</div>
<div class="J-global-toolbar">
</div>
