<?php if (!defined('ROOT_PATH')){exit('No Permission');}?>
<?php
include $this->view->getTplPath() . '/' . 'header.php';
?>
<link rel="stylesheet" type="text/css" href="<?=$this->view->css?>/Group-integral.css" />
<script type="text/javascript" src="<?=$this->view->js?>/fixed.js"></script>

<div class="wrap">
    <div class="crumbs clearfix">
        <p>
            <a href="<?=YLB_Registry::get('url')?>"><?=_('首页')?></a> <i class="iconfont icon-iconjiantouyou"></i>
            <a href="<?=YLB_Registry::get('url')?>?ctl=GroupBuy&met=index"><?=_('团购中心')?></a>
            <i class="iconfont icon-iconjiantouyou"></i>
            <a href="<?=YLB_Registry::get('url')?>?ctl=GroupBuy&met=groupBuyList"><?=_('线上团')?></a>
            <?php if ($data['current_cat']){ ?>
                <i class="iconfont icon-iconjiantouyou"></i>
                <a href="<?=YLB_Registry::get('url')?>?ctl=GroupBuy&met=groupBuyList&cat_id=<?=$data['current_cat']['groupbuy_cat_id']?>"><?=_($data['current_cat']['groupbuy_cat_name'])?></a>
            <?php } ?>
        </p>
    </div>

    <div class="ncg-content">
        <div class="tg tg_left">
            <h5><a href="<?=YLB_Registry::get('url')?>?ctl=GroupBuy&met=groupBuyList"><?=_('线上团')?></a></h5>
            <p>
                <?php
                if($data['cat']['physical'])
                {
                    foreach($data['cat']['physical'] as $key=>$phy_cat)
                    {
                        ?>
                        <a href="<?=YLB_Registry::get('url')?>?ctl=GroupBuy&met=groupBuyList&cat_id=<?=$phy_cat['groupbuy_cat_id']?>"><?=$phy_cat['groupbuy_cat_name']?></a>
                    <?php
                    }
                }
                ?>
            </p>
            <h5><a href="<?=YLB_Registry::get('url')?>?ctl=GroupBuy&met=vrGroupBuyList"><?=_('虚拟团')?></a></h5>
            <p>
                <?php
                if($data['cat']['virtual'])
                {
                    foreach($data['cat']['virtual'] as $key=>$vir_cat)
                    {
                        ?>
                        <a href="<?=YLB_Registry::get('url')?>?ctl=GroupBuy&met=vrGroupBuyList&cat_id=<?=$vir_cat['groupbuy_cat_id']?>"><?=$vir_cat['groupbuy_cat_name']?></a>
                    <?php
                    }
                }
                ?>
            </p>
        </div>
        <div class="rightcont">

            <div class="ncg-screen">
            <!-- 分类过滤列表 -->
                <?php if(@$data['groupbuy_cat']){ ?>
                <dl>
                    <dt><?=_('状态')?>：</dt>
                    <dd class="<?=(request_string('state')!='underway' && request_string('state')!='history') ? 'hova' : ''?>"><a href="<?=YLB_Registry::get('url')?>?ctl=GroupBuy&met=groupBuyList"><?=_('正在进行')?></a></dd>
                    <dd class="<?=request_string('state')=='underway'?'hova':''?>"><a href="<?=YLB_Registry::get('url')?>?ctl=GroupBuy&met=groupBuyList&state=underway" ><?=_('即将开始')?></a></dd>
                    <dd class="<?=request_string('state')=='history'?'hova':''?>"><a href="<?=YLB_Registry::get('url')?>?ctl=GroupBuy&met=groupBuyList&state=history" ><?=_('已经结束')?></a></dd>
                </dl>
                    <?php if(@$data['groupbuy_cat'][request_int('cat_id')]['scat']){ ?>
                        <dl>
                            <dt></dt>
                            <?php
                            foreach(@$data['groupbuy_cat'][request_int('cat_id')]['scat'] as $skey=>$scat)
                            {
                                ?>
                                <dd <?php if (!(request_int('s_cat_id')) && request_int('s_cat_id') == $scat['groupbuy_cat_id']){ ?>class="hova"<?php } ?>>
                                    <a onclick="cat(<?= ($scat['groupbuy_cat_id']) ?>)"><?=$scat['groupbuy_cat_name'] ?></a>
                                </dd>
                            <?php
                            }
                            ?>
                        </dl>
                    <?php } ?>
                <?php  } ?>

        <!-- 价格过滤列表 -->
                <?php if(@$data['price_range']){ ?>
                <dl>
                    <dt><?=_('价格')?>：</dt>
                    <dd <?php if(!request_int('price')){ ?>class="hova"<?php } ?>><a href="javascript:void(0);" onclick="price(0)"><?=_('不限')?></a></dd>
                    <?php  foreach($data['price_range'] as $key=>$price)
                    {
                    ?>
                    <dd <?php if(request_int('price') == $price['range_id']){ ?>class="hova"<?php } ?>><a href="javascript:void(0);" onclick="price(<?=$price['range_id']?>)"><?=$price['range_name']?></a> </dd>
                    <?php
                    }
                    ?>
                </dl>
                <?php } ?>
                <dl class="ncg-sortord">
                    <dt><?=_('排序')?>：</dt>
                    <dd  class="<?=(!request_string('orderby') || request_string('orderby')=='default')? 'hova':'' ?>"> <a href="javascript:void(0);" onclick="list('default')"><?=_('默认')?></a></dd>
                    <dd class="<?=(request_string('orderby')=='priceasc'|| request_string('orderby')=='pricedesc')? 'hova':'' ?>" > <a href="javascript:void(0);" onclick='list(<?=request_string('orderby')=='pricedesc'? '"priceasc"':'"pricedesc"'?>)'><?=_('价格')?></a><em class="<?=request_string('orderby')=='pricedesc'? "desc":"asc"?>"></em></dd>
                    <dd class="<?=(request_string('orderby')=='rateasc' || request_string('orderby')=='ratedesc')? 'hova':'' ?>"  > <a href="javascript:void(0);" onclick='list(<?=request_string('orderby')=='ratedesc'? '"rateasc"':'"ratedesc"' ?>)'><?=_('折扣')?></a><em class="<?=request_string('orderby')=='ratedesc'? "desc":"asc"?>"></em></dd>
                    <dd class="<?=(request_string('orderby')=='saleasc' || request_string('orderby')=='saledesc')? 'hova':'' ?>"  > <a href="javascript:void(0);" onclick='list(<?=request_string('orderby')=='saledesc'? '"saleasc"':'"saledesc"' ?>)'><?=_('销量')?></a><em class="<?=request_string('orderby')=='saledesc'? "desc":"asc" ?>"></em></dd>
                </dl>
            </div>

            <!-- 团购活动列表 -->
            <?php
                if(@$data['groupbuy_goods']['items'])
                {
            ?>
            <div class="group-list">
                <ul>
                <?php
                foreach($data['groupbuy_goods']['items'] as $key=>$groupbuy_goods)
                {
                ?>
                    <li class="online">
                        <div class="ncg-list-content">
                        <a title="<?=$groupbuy_goods['goods_name']?>" href="<?=YLB_Registry::get('url')?>?ctl=GroupBuy&met=detail&id=<?=$groupbuy_goods['groupbuy_id']?>" class="pic-thumb" target="_blank">
                        <img src="<?=image_thumb($groupbuy_goods['groupbuy_image'],260,193)?>" alt="">
                        </a>
                        <h3 class="title">
                        <a title="<?=$groupbuy_goods['goods_name']?>" href="" target="_blank"><?=$groupbuy_goods['goods_name']?></a>
                        </h3>
                            <div class="item-prices">
                                <span class="price" data-price="<?=$groupbuy_goods['groupbuy_price']?>"><?=format_money($groupbuy_goods['groupbuy_price'])?></span>
                                <div class="dock">
                                    <span class="limit-num"><?=$groupbuy_goods['rate']?>&nbsp;<?=_('折')?></span>
                                    <del class="orig-price"><?=format_money($groupbuy_goods['goods_price'])?></del>
                                </div>
                                <span class="sold-num"><em class="bbc_color"><?=$groupbuy_goods['groupbuy_virtual_quantity']?></em><?=_('件已购买')?></span>
                                <a href="<?=YLB_Registry::get('url')?>?ctl=GroupBuy&met=detail&id=<?=$groupbuy_goods['groupbuy_id']?>" target="_self" class="buy-button bbc_btns"><?=_('我要团')?></a>
                            </div>
                        </div>
                    </li>
                <?php
                }
                ?>
                </ul>
            </div>
            <?php }else{ ?>
            <div class="no_account">
                <img src="<?= $this->view->img ?>/ico_none.png"/>
                <p><?= _('暂无符合条件的数据记录') ?></p>
            </div>
            <?php } ?>
        </div>
    </div>
    <div class="flip clearfix">
        <?php if($page_nav){ ?>
            <div class="page"><?=$page_nav?></div>
        <?php } ?>
    </div>
</div>


<script>
    //综合排序，销量，价格，新品
    function list(e)
    {
        //地址中的参数
        var params= window.location.search;

        params = changeURLPar(params,'orderby',e);

        window.location.href = SITE_URL + params;


    }

    //搜索商品
    function searchgoods()
    {
        var searchstr = $("#search").val();

        //地址中的参数
        var params= window.location.search;

        params = changeURLPar(params,'keywords',searchstr);


        window.location.href = SITE_URL + params;
    }

    //品牌
    function price(e)
    {
        //地址中的参数
        var params= window.location.search;

        params = changeURLPar(params,'price',e);


        window.location.href = SITE_URL + params;
    }

    //分类
    function cat(e)
    {
        //地址中的参数
        var params= window.location.search;

        params = changeURLPar(params,'cat_id',e);

        window.location.href = SITE_URL + params;
    }
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
</script>
<?php
include $this->view->getTplPath() . '/' . 'footer.php';
?>