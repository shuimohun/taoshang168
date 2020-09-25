<?php if (!defined('ROOT_PATH')){exit('No Permission');}?>
<?php
include $this->view->getTplPath() . '/' . 'header.php';
?>
<link rel="stylesheet" type="text/css" href="<?=$this->view->css?>/base.css" />
<link rel="stylesheet" type="text/css" href="<?=$this->view->css?>/Scare-integral.css" />
<div class="wrap">
	<div class="t_ban">
		<div style="clear:both;"></div>
		<div class="tg tg_left">
			<h5><a href="<?=YLB_Registry::get('url')?>?ctl=ScareBuy&met=scareBuyList"><?=_('线上团')?></a></h5>
			<p>
                <?php
                    if($data['cat']['physical'])
                    {
                        foreach($data['cat']['physical'] as $key=>$phy_cat)
                        {
                ?>
                <a href="<?=YLB_Registry::get('url')?>?ctl=ScareBuy&met=scareBuyList&cat_id=<?=$phy_cat['scarebuy_cat_id']?>"><?=$phy_cat['scarebuy_cat_name']?></a>
                <?php
                        }
                    }
                ?>
			</p>
            <h5><a href="<?=YLB_Registry::get('url')?>?ctl=ScareBuy&met=vrScareBuyList"><?=_('虚拟团')?></a></h5>
            <p>
                <?php
                if($data['cat']['virtual'])
                {
                    foreach($data['cat']['virtual'] as $key=>$vir_cat)
                    {
                        ?>
                        <a href="<?=YLB_Registry::get('url')?>?ctl=ScareBuy&met=vrScareBuyList&cat_id=<?=$vir_cat['scarebuy_cat_id']?>"><?=$vir_cat['scarebuy_cat_name']?></a>
                    <?php
                    }
                }
                ?>
            </p>
		</div>
		<div class="tg_center" id="slides">
            <div class="banner swiper-container">
    			<ul class="items swiper-wrapper">
                    <?php if(Web_ConfigModel::value('subsite_is_open') && isset($_COOKIE['sub_site_id']) && $_COOKIE['sub_site_id'] > 0){$scarebuy_subsite_id = '_'.$_COOKIE['sub_site_id'];}else{$scarebuy_subsite_id = '';} ?>
                    <?php if(Web_ConfigModel::value('slider1_image'.$scarebuy_subsite_id)){ ?>
    				    <li class="swiper-slide"><a href="<?=Web_ConfigModel::value('live_link1'.$scarebuy_subsite_id)?>"><img src="<?=image_thumb(Web_ConfigModel::value('slider1_image'.$scarebuy_subsite_id),1043,396)?>"/></a></li>
    				<?php } ?>
                    <?php if(Web_ConfigModel::value('slider2_image'.$scarebuy_subsite_id)){ ?>
                        <li class="swiper-slide"><a href="<?=Web_ConfigModel::value('live_link2'.$scarebuy_subsite_id)?>"><img src="<?=image_thumb(Web_ConfigModel::value('slider2_image'.$scarebuy_subsite_id),1043,396)?>"/></a></li>
                    <?php } ?>
                    <?php if(Web_ConfigModel::value('slider3_image'.$scarebuy_subsite_id)){ ?>
                        <li class="swiper-slide"><a href="<?=Web_ConfigModel::value('live_link3'.$scarebuy_subsite_id)?>"><img src="<?=image_thumb(Web_ConfigModel::value('slider3_image'.$scarebuy_subsite_id),1043,396)?>"/></a></li>
                    <?php } ?>
                    <?php if(Web_ConfigModel::value('slider4_image'.$scarebuy_subsite_id)){ ?>
                        <li class="swiper-slide"><a href="<?=Web_ConfigModel::value('live_link3'.$scarebuy_subsite_id)?>"><img src="<?=image_thumb(Web_ConfigModel::value('slider4_image'.$scarebuy_subsite_id),1043,396)?>"/></a></li>
                    <?php } ?>
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
		<div style="clear:both;"></div>
	</div>

    <!-- 线上团-->
	<div class="scares">
		<h3>
            <a href="<?=YLB_Registry::get('url')?>?ctl=ScareBuy&met=scareBuyList"><?=_('线上团')?></a><i><?=_('每天整点开抢')?></i>
            <span class="more"> <a href="<?=YLB_Registry::get('url')?>?ctl=ScareBuy&met=scareBuyList"><?=_('更多')?><i class="iconfont icon-iconjiantouyou"></i></a></span>
        </h3>
            <?php
                if ($data['goods']['physical']['highly_recommend']) {
            ?>
                <div class="gr_goods clearfix">
                    <img src="<?=image_thumb($data['goods']['physical']['highly_recommend']['scarebuy_image_rec'],612,318)?>"/>

                    <div class="gr_goods_imfor">
                        <div class="gr_goods_div">
                            <h4><a href="<?=YLB_Registry::get('url')?>?ctl=ScareBuy&met=detail&id=<?=$data['goods']['physical']['highly_recommend']['scarebuy_id']?>"><?= $data['goods']['physical']['highly_recommend']['scarebuy_name'] ?></a></h4>
                            <ul>
                                <li>&bull;<?=$data['goods']['physical']['highly_recommend']['scarebuy_remark'] ?></li>
                            </ul>
                            <div class="gr_good_price clearfix">
                                <span class="bbc_color"><?=format_money($data['goods']['physical']['highly_recommend']['scarebuy_price'])?><em><?=format_money($data['goods']['physical']['highly_recommend']['goods_price'])?></em></span>
                                <a class="bbc_btns" href="<?=YLB_Registry::get('url')?>?ctl=ScareBuy&met=detail&id=<?=$data['goods']['physical']['highly_recommend']['scarebuy_id']?>"><?=_('立即购买')?><i class="iconfont icon-iconjiantouyou"></i></a>
                            </div>
                            <div class="gr_good_lastime clearfix fnTimeCountDown" data-end="<?=$data['goods']['physical']['highly_recommend']['scarebuy_endtime']?>">
                                <span><i class="iconfont icon-shijian2"></i><?=_('还剩')?>
                                    <span class="day" >00</span><strong><?=_('天')?></strong>
                                    <span class="hour">00</span><strong><?=_('小时')?></strong>
                                    <span class="mini">00</span><strong><?=_('分')?></strong>
                                    <span class="sec" >00</span><strong><?=_('秒')?></strong>
                                </span>
                                <em><strong class="bbc_color"><?=$data['goods']['physical']['highly_recommend']['scarebuy_virtual_quantity'] ?></strong> <?=_('人已付款')?></em>
                            </div>
                        </div>
                        <p class="hotbg"></p>
                    </div>
                </div>
        <?php
            }
        ?>
        <?php   if($data['goods']['physical']['recommend']['items']){  ?>
		<ul class="gr_goods_list clearfix">
            <?php  foreach($data['goods']['physical']['recommend']['items'] as $key=>$value) { ?>
                <li>
                    <a href="<?= YLB_Registry::get('url') ?>?ctl=ScareBuy&met=detail&id=<?= $value['scarebuy_id'] ?>"
                       class="gr_goods_a"><img src="<?= image_thumb($value['goods_image'], 206, 230) ?>"/></a>

                    <p class="gr_goods_ev clearfix"><span><strong
                                class="bbc_color"><?= format_money($value['scarebuy_price']) ?></strong></span><em
                            class="bbc_color"><?= _('立省') ?><?= $value['reduce'] ?></em></p>
                    <h5>
                        <a href="<?= YLB_Registry::get('url') ?>?ctl=ScareBuy&met=detail&id=<?= $value['scarebuy_id'] ?>"><?= $value['scarebuy_name'] ?></a>
                    </h5>

                    <p class="gr_sold_hav clearfix"><span><?= _('已售') ?><i class="num-color ml4"><?= $value['scarebuy_buy_quantity'] ?></i></span>
                        <em class="fnTimeCountDown" data-end="<?= $value['scarebuy_endtime'] ?>">
                            <span class="day">00</span><strong><?= _('天') ?></strong>
                            <span class="hour">00</span><strong><?= _('小时') ?></strong>
                            <span class="mini">00</span><strong><?= _('分') ?></strong>
                            <span class="sec">00</span><strong><?= _('秒') ?></strong>
                        </em>
                    </p>
                </li>
            <?php
                }
            ?>
		</ul>
        <?php  } ?>
	</div>


    <!--虚拟团-->
	<div class="scares">
		<h3>
            <a href="<?=YLB_Registry::get('url')?>?ctl=ScareBuy&met=vrScareBuyList"><?=_('虚拟团')?></a><i><?=_('每天整点开抢')?></i>
            <span class="more"> <a href="<?=YLB_Registry::get('url')?>?ctl=ScareBuy&met=vrScareBuyList"><?=_('更多')?><i class="iconfont icon-iconjiantouyou"></i></a></span>
        </h3>
            <?php
            if ($data['goods']['virtual']['highly_recommend']) {
        ?>
            <div class="gr_goods clearfix">
                <img src="<?=image_thumb($data['goods']['virtual']['highly_recommend']['scarebuy_image_rec'],612,318)?>"/>

                <div class="gr_goods_imfor">
                    <div class="gr_goods_div">
                        <h4><a href="<?=YLB_Registry::get('url')?>?ctl=ScareBuy&met=detail&id=<?=$data['goods']['virtual']['highly_recommend']['scarebuy_id']?>"><?= $data['goods']['virtual']['highly_recommend']['scarebuy_name'] ?></a></h4>
                        <ul>
                            <li>&bull;<?=$data['goods']['virtual']['highly_recommend']['scarebuy_remark'] ?></li>
                        </ul>
                        <div class="gr_good_price clearfix">
                            <span class="bbc_color"><?=format_money($data['goods']['virtual']['highly_recommend']['scarebuy_price'])?><em><?=format_money($data['goods']['virtual']['highly_recommend']['goods_price'])?></em></span>
                            <a  class="bbc_btns" href="<?=YLB_Registry::get('url')?>?ctl=ScareBuy&met=detail&id=<?=$data['goods']['virtual']['highly_recommend']['scarebuy_id']?>"><?=_('立即购买')?><i class="iconfont icon-iconjiantouyou"></i></a>
                        </div>
                        <div class="gr_good_lastime clearfix fnTimeCountDown" data-end="<?=$data['goods']['virtual']['highly_recommend']['scarebuy_endtime']?>">
                                <span><i class="iconfont icon-shijian2"></i><?=_('还剩')?>
                                    <span class="day" >00</span><strong><?=_('天')?></strong>
                                    <span class="hour">00</span><strong><?=_('小时')?></strong>
                                    <span class="mini">00</span><strong><?=_('分')?></strong>
                                    <span class="sec" >00</span><strong><?=_('秒')?></strong>
                                </span>
                            <em><strong class="bbc_color"><?=$data['goods']['virtual']['highly_recommend']['scarebuy_virtual_quantity'] ?></strong> <?=_('人已付款')?></em>
                        </div>
                    </div>
                    <p class="hotbg"></p>
                </div>
            </div>
            <?php
        }
            ?>
		<ul class="gr_goods_list clearfix">
            <?php  foreach($data['goods']['virtual']['recommend']['items'] as $key=>$value) {
                    ?>
                    <li>
                        <a href="<?=YLB_Registry::get('url')?>?ctl=ScareBuy&met=detail&id=<?=$value['scarebuy_id']?>" class="gr_goods_a"><img src="<?=image_thumb($value['goods_image'],206,230)?>"/></a>
                        <p class="gr_goods_ev clearfix"><span><strong class="bbc_color"><?=$value['scarebuy_price']?></strong></span><em class="bbc_color"><?=_('立省')?><?=$value['reduce']?></em></p>
                        <h5><a href="<?=YLB_Registry::get('url')?>?ctl=ScareBuy&met=detail&id=<?=$value['scarebuy_id']?>"><?=$value['scarebuy_name']?></a></h5>
                        <p class="gr_sold_hav clearfix"><span><?=_('已售')?><i class="num-color ml4"><?=$value['scarebuy_buy_quantity']?></i></span>
                            <em class="fnTimeCountDown" data-end="<?=$value['scarebuy_endtime']?>">
                                <span class="day" >00</span><strong><?=_('天')?></strong>
                                <span class="hour">00</span><strong><?=_('小时')?></strong>
                                <span class="mini">00</span><strong><?=_('分')?></strong>
                                <span class="sec" >00</span><strong><?=_('秒')?></strong>
                            </em>
                        </p>
                    </li>
            <?php
                }
            ?>
		</ul>
	</div>
</div>

<script src="<?=$this->view->js_com?>/plugins/jquery.timeCountDown.js" ></script>
<script>
    // $("#slides").slideBox();
    $(function(){
        var _TimeCountDown = $(".fnTimeCountDown");
        _TimeCountDown.fnTimeCountDown();
    })

    //城市
    function city(e)
    {
        //地址中的参数
        var params = window.location.search;
        params = changeURLPar(params, 'city_id', e);
        window.location.href = SITE_URL + params;

    }

    function changeURLPar(destiny, par, par_value)
    {
        var pattern = par + '=([^&]*)';
        var replaceText = par + '=' + par_value;
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
                return destiny + '&' + replaceText;
            }
            else
            {
                return destiny + '?' + replaceText;
            }


        }
        return destiny + '\n' + par + '\n' + par_value;
    }
</script>

<?php
include $this->view->getTplPath() . '/' . 'footer.php';
?>