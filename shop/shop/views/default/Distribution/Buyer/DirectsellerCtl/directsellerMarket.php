<?php if (!defined('ROOT_PATH')){exit('No Permission');}

include $this->view->getTplPath() . '/' . 'buyer_header.php';
?>
<div class="aright">
    <div class="div_head tabmenu clearfix">
        <ul class="tab clearfix">
            <li><a href="<?= YLB_Registry::get('url') ?>?ctl=Distribution_Buyer_Directseller&met=index&typ=e"><?=_('淘金申请')?></a></li>
            <li><a href="<?= YLB_Registry::get('url') ?>?ctl=Distribution_Buyer_Goods&met=index"><?=_('商品列表')?></a></li>
            <li><a href="<?= YLB_Registry::get('url') ?>?ctl=Distribution_Buyer_Directseller&met=directsellerList"><?=_('我的推广')?></a></li>
            <li><a href="<?= YLB_Registry::get('url') ?>?ctl=Distribution_Buyer_Directseller&met=directsellerOrder"><?=_('我的业绩')?></a></li>
            <li><a href="<?= YLB_Registry::get('url') ?>?ctl=Distribution_Buyer_Directseller&met=directsellerCommission"><?=_('佣金记录')?></a></li>
            <li class="active"><a href="<?= YLB_Registry::get('url') ?>?ctl=Distribution_Buyer_Directseller&met=directsellerMarket"><?=_('淘金市场')?></a></li>
        </ul>
    </div>
<div class="wrap w-1200">
<!--	<div class="filter-wrap">-->
	<div>
		<div class="classify-wrap row-wrap">
			<div class="filter-head">
				<span class="filter-head-name">分类</span>
			</div>
			<div class="filter-body">
				<ul class="filter-body-list">
                    <?php foreach ($data['class'] as $value):  ?>
					<li class="filter-body-item lf" data-id="<?= $value['cat_id'] ?>    ">
						<a href="javascript:;"><?= $value['nav_name']?></a>
					</li>
                    <?php endforeach;?>

				</ul>
			</div>
<!--			<div class="filter-foot">-->
<!--				<div class="filter-foot-more">-->
<!--					<a href="javascript:;">更多<i class="icon"></i></a>-->
<!--				</div>-->
<!--			</div>-->
		</div>
		<div class="sort-wrap row-wrap">
			<div class="filter-head">
				<a href="javascript:;">
					<span class="filter-head-name curr">默认排序</span>
				</a>
			</div>
			<div class="filter-body">
				<ul class="filter-body-list">
					<li class="filter-body-item lf sort">
						<a href="javascript:;" class="item-a">
							人气 <i class="icon"></i>
						</a>
					</li>
					<li class="filter-body-item lf sort">
						<a href="javascript:;" class="item-a">
							价格 <i class="icon"></i>
						</a>
					</li>
					<li class="filter-body-item lf sort">
						<a href="javascript:;" class="item-a">
							销量 <i class="icon"></i>
						</a>
					</li>
					<li class="filter-body-item lf sort">
						<a href="javascript:;" class="item-a">
							佣金比例 <i class="icon"></i>
						</a>
					</li>
<!--					<li class="filter-body-item lf sort">-->
<!--						<a href="javascript:;" class="item-a">-->
<!--							月推广量 <i class="icon"></i>-->
<!--						</a>-->
<!--					</li>-->
<!--					<li class="filter-body-item lf sort">-->
<!--						<a href="javascript:;" class="item-a">-->
<!--							月支出佣金 <i class="icon"></i>-->
<!--						</a>-->
<!--					</li>-->
<!--					<li class="filter-body-item lf slider-down">-->
<!--						<a href="javascript:;" class="item-a">-->
<!--							发货地 <i class="icon"></i>-->
<!--						</a>-->
<!--						<div class="port-pop">-->
<!--							<ul class="port-pop-list orflow">-->
<!--								<li class="port-pop-item lf">-->
<!--									<a href="javascript:;">北京</a>-->
<!--								</li>-->
<!--							</ul>-->
<!--							<div class="search-port orflow">-->
<!--								<input type="text" name="" placeholder="多个地区用逗号分割">-->
<!--								<span class="confirm">确定</span>-->
<!--							</div>-->
<!--						</div>-->
<!--					</li>-->
					
				</ul>
			</div>
			<div class="filter-foot">
				<div class="filter-foot-more">
					<div class="show-way-wrap lf orflow">
						<a href="javascript:;" class="lf">
							<i class="icon table-way curr"></i>
						</a>
						<a href="javascript:;" class="lf">
							<i class="icon row-way"></i>
						</a>
					</div>
					<div class="paging lf">
						<a href="javascript:;" class="lf page-before-a">
							<i class="icon page-before"></i>
						</a>
						<div class="paging-num">
							<span class="num-before"><?= $data['detail']['page']?></span>
							/
							<span class="num-next"><?= $data['detail']['total']?></span>
						</div>
						<a href="javascript:;" class="rt page-next-a curr">
							<i class="icon page-next"></i>
						</a>
					</div>
				</div>
			</div>
		</div>
<!--		<div class="option-wrap row-wrap row-wrap-48">-->
<!--			<div class="filter-tag lf">-->
<!--				<label>-->
<!--					<input type="checkbox" name="">包邮-->
<!--				</label>-->
<!--			</div>-->
<!--			<div class="filter-tag lf">-->
<!--				<label>-->
<!--					<input type="checkbox" name="">平台自营-->
<!--				</label>-->
<!--			</div>-->
<!--			<div class="input-wrap lf">-->
<!--				<span>月销量</span>-->
<!--				<input type="text" name="">以上-->
<!--			</div>-->
<!--			<div class="input-wrap lf">-->
<!--				<span>收入比率</span>-->
<!--				<input type="text" name="">%&nbsp;--->
<!--				<input type="text" name="">%-->
<!--			</div>-->
<!--			<div class="input-wrap lf">-->
<!--				<span>价格</span>-->
<!--				<input type="text" name="">元&nbsp;--->
<!--				<input type="text" name="">元-->
<!--			</div>-->
<!--		</div>-->
	</div>	
	<div class="show-wrap show-table">
		<ul class="show-list">
            <?php foreach ($data['detail']['items'] as $detail):?>
			<li class="show-item lf">
				<div class="img-center">
					<a href="<?=YLB_Registry::get('url')?>?ctl=Goods_Goods&met=goods&type=goods&gid=<?=$detail['goods_mark_id']?>">
						<img src="<?= $detail['common_image']?>" alt="">
						<div class="bg-xl">销量：<?= $detail['common_salenum']?></div>
					</a>
				</div>
				<div class="goods-detail w-270 text2 mt-6">
					<a href="<?=YLB_Registry::get('url')?>?ctl=Goods_Goods&met=goods&type=goods&gid=<?=$detail['goods_mark_id']?>">
						<?= $detail['common_name'] ?>
					</a>
				</div>
				<div class="price-wrap w-270 orflow mt-6">
					<div class="price lf">
						￥<span class="price-num"><?= $detail['common_price']?></span>
					</div>
					<div class="tag-wrap rt">
						<span class="red-tag">包邮</span>
					</div>
				</div>
				<div class="share-wrap-270 w-270 orflow mt-6">
					<div class="share-wrap lf">
	                    <div class="share orflow">
	                        <span>分享立减</span>
	                        <span class="save">￥<?= $detail['common_share_price']?></span>
	                    </div>                  
	                </div>
	                <div class="share-wrap rt">
	                    <div class="share orflow">
	                        <span>立赚</span>
	                        <span class="save">￥<?= $detail['common_promotion_price']?></span>
	                    </div>
	                </div>
				</div>
				<div class="rate-wrap mt-6 w-270 orflow">
					<div class="rate lf">
						佣金比例:<span><?= $detail['common_cps_rate']?>.00%</span>
					</div>
					<div class="rate rt">
						可得佣金:<span><i>￥</i><?=$detail['common_cps_commission']?></span>
					</div>
				</div>
				<div class="shop-wrap mt-6">
					<a href="<?= YLB_Registry::get('url') ?>?ctl=Shop&met=index&typ=e&id=<?= $detail['shop_id']?>" class="shop-a">
						<i class="icon"></i>
						<span><?= $detail['shop_name']?></span>
					</a>
				</div>
				<div class="spread-wrap mt-6">
                <?php if ($detail['exist']):?>
                    <div class="spread apply">
                        <a href="<?= YLB_Registry::get('url') ?>?ctl=Goods_Goods&met=goods&type=goods&gid=<?=($detail['goods_mark_id'])?>" class="grid-1 rt extend-once">立即推广</a>
                        <a href="javascript:;" class="grid-1 rt erweima grid-brown">二维码</a>
                        <a href="javascript:;" class="grid-1 rt copy-code grid-brown">
                            <i class="icon"></i>
                            复制链接</a>
                    </div>
                    <?php else:?>
                    <div class="spread apply cl">
						<a href="javascript:;" class="grid-1 rt">申请淘金</a>
					</div>
					<?php endif;?>

				</div>
			</li>
                <div class="extend-pop pop">
                    <div class="pop-title">
                        <span>立即推广</span>
                        <i class="icon close"></i>
                    </div>
                    <div class="pop-content">
                        <div class="content">
                            <div class="w-480">
                                <div class="col-1 orflow">
                                    <span class="s-title">商品标题：</span>
                                    <p class="s-content text1"><?= $detail['common_name']?></p>
                                </div>
                                <div class="col-2 orflow">
                                    <span class="s-title">商品图片：</span>
                                    <div class="img-container orflow">
                                        <div class="img-center lf">
                                            <img src="<?= $detail['common_image']?>" alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="content-bottom">
                            <div class="w-480">
                                <span class="s-title s-share">我要分享到：</span>
                                <div class="img-container">
                                    <div class="img-container-item">
                                        <a href="">
                                            <div class="img-center">
                                                <img src="<?= $this->view->img ?>/sqq.png" alt="">
                                            </div>
                                            <span>QQ好友</span>
                                        </a>
                                    </div>
                                    <div class="img-container-item">
                                        <a href="">
                                            <div class="img-center">
                                                <img src="<?= $this->view->img ?>/qzone.png" alt="">
                                            </div>
                                            <span>QQ空间</span>
                                        </a>
                                    </div>
                                    <div class="img-container-item">
                                        <a href="">
                                            <div class="img-center">
                                                <img src="<?= $this->view->img ?>/wx.png" alt="">
                                            </div>
                                            <span>微信好友</span>
                                        </a>
                                    </div>
                                    <div class="img-container-item">
                                        <a href="">
                                            <div class="img-center">
                                                <img src="<?= $this->view->img ?>/wx_timeline.png" alt="">
                                            </div>
                                            <span>微信朋友圈</span>
                                        </a>
                                    </div>
                                    <div class="img-container-item">
                                        <a href="">
                                            <div class="img-center">
                                                <img src="<?= $this->view->img ?>/tsina.png" alt="">
                                            </div>
                                            <span>新浪微博</span>
                                        </a>
                                    </div>
                                    <div class="img-container-item more-extend">
                                        <a href="">
                                            <div class="img-center">
                                                <img src="<?= $this->view->img ?>/more.png" alt="">
                                            </div>
                                            <span>更多推广</span>
                                        </a>
                                        <div class="more-extend-pop">
                                            <div class="icon-container lf">
                                                <a href="">
                                                    <div class="img-center">
                                                        <img src="<?= $this->view->img ?>/douban.png" alt="">
                                                    </div>
                                                    <span>豆瓣</span>
                                                </a>
                                            </div>
                                            <div class="icon-container lf">
                                                <a href="">
                                                    <div class="img-center">
                                                        <img src="<?= $this->view->img ?>/kaixin.png" alt="">
                                                    </div>
                                                    <span>开心网</span>
                                                </a>
                                            </div>
                                            <div class="icon-container lf">
                                                <a href="">
                                                    <div class="img-center">
                                                        <img src="<?= $this->view->img ?>/ty.png" alt="">
                                                    </div>
                                                    <span>天涯</span>
                                                </a>
                                            </div>
                                            <div class="icon-container lf">
                                                <a href="">
                                                    <div class="img-center">
                                                        <img src="<?= $this->view->img ?>/huaban.png" alt="">
                                                    </div>
                                                    <span>花瓣</span>
                                                </a>
                                            </div>
                                            <div class="icon-container lf">
                                                <a href="">
                                                    <div class="img-center">
                                                        <img src="<?= $this->view->img ?>/copy.png" alt="">
                                                    </div>
                                                    <span>复制链接</span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-1 orflow">
                                    <span class="s-title">淘金规则：</span>
                                    淘尚168商城平台的用户发布信息等行为发生在本规则生效之日或修订之日以后的，适用生效或修订后的规则，发生在本规则生效日。
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach ?>
		</ul>
	</div>
	<div class="show-wrap show-row">
		<div class="list-nav">
			<ul class="nav-list orflow">
				<li class="nav-item lf w-510 text-i-20">
					<span>商品信息</span>
				</li>
				<li class="nav-item lf w-140 text-i-20">
					<span>价格</span>
				</li>
				<li class="nav-item lf w-155 text-i-20">
					<span>佣金比例</span>
				</li>
				<li class="nav-item lf w-155 text-i-20">
					<span>可得佣金</span>
				</li>
				<li class="nav-item lf w-120 text-i-20">
					<span>销量</span>
				</li>
				<li class="nav-item lf w-100 center">
					<span>操作</span>
				</li>
			</ul>
		</div>
		<ul class=show-list>
            <?php foreach($data['detail']['items'] as $detail):?>
			<li class="show-item lf">
				<ul class="item-ul">
					<li class="item-li lf w-530">
						<div class="img-center lf">
							<a href="javascript:;">
								<img src="<?= $detail['common_image']?>" alt="">
							</a>
						</div>
						<div class="li-main w-370 lf">
							<div class="goods-detail text1 w-350">
								<a href="#">
									<?= $detail['common_name'] ?>
								</a>
							</div>
							<div class="tag-wrap">
								<span class="red-tag">包邮</span>
							</div>
							<div class="share-wrap-300 w-300 orflow mt-6">
								<div class="share-wrap lf">
				                    <div class="share orflow">
				                        <span>分享立减</span>
				                        <span class="save">￥<?= $detail['common_share_price']?></span>
				                    </div>                  
				                </div>
				                <div class="share-wrap rt">
				                    <div class="share orflow">
				                        <span>立赚</span>
				                        <span class="save">￥<?= $detail['common_promotion_price']?></span>
				                    </div>
				                </div>				                
							</div>
							<div class="shop-wrap mt-6">
								<a href="javascript:;" class="shop-a">
									<i class="icon"></i>
									<span><?= $detail['shop_name'] ?></span>
								</a>
							</div>
						</div>
					</li>
					<li class="item-li lf w-140">
						<div class="price lf mt-50">
							￥<span class="price-num"><?= $detail['common_price'] ?></span>
						</div>
					</li>
					<li class="item-li lf w-155">
						<div class="rate lf mt-50">
							<span><?= $detail['common_cps_rate']?>.00%</span>
						</div>
					</li>
					<li class="item-li lf w-155">
						<div class="rate mt-50">
							<span><i>￥</i><?=$detail['common_cps_commission']?></span>
						</div>
					</li>
					<li class="item-li lf w-120">
						<div class="xl mt-50"><?= $detail['common_salenum']?>件</div>
					</li>
					<li class="item-li lf w-100 center">
						<div class="spread-wrap">
                            <?php if ($detail['exist']):?>
                            <div class="spread apply">
                            <a href="javascript:;" class="grid-1 rt extend-once">立即推广</a>
                            <a href="javascript:;" class="grid-1 rt erweima grid-brown">二维码</a>
                            <a href="javascript:;" class="grid-1 rt copy-code grid-brown">
                                <i class="icon"></i>
                                复制链接</a>
							</div>
                            <?php else:?>
							<div class="spread apply cl">
                                <a href="javascript:;" class="grid-1 rt">申请淘金</a>
							</div>
                            <?php endif;?>
						</div>
					</li>
				</ul>
			</li>
		    <?php endforeach;?>
		</ul>
	</div>
</div>
<div class="apply-progress">
	<span>申请成功,后台审核中..</span>
</div>
<div class="ui-mask"></div>
<div class="erweima-pop pop">
	<div class="pop-title">
		<span>推广二维码</span>
		<i class="icon close"></i>
	</div>
	<div class="pop-content">
		<div class="content">
			<div class="p-content">
				<p>1、如您推广的是航旅的当面付、火车票或者理财保险类商品，将无法获得佣金。</p>
				<p>2、二维码是由短链接转换而来，只有300天的有效期，过期失效需要重新获取。</p>
				<p>3、若订单使用红包或购物券后佣金有可能支付给红包推广者，如您是自推自买，请勿使用红包及购物券。红包推广是什么？</p>
			</div>
			<div class="content-bottom">
				<div class="erweima-img">
					<img src="<?= $this->view->img ?>/opening/erweima.png" alt="">
				</div>

			</div>
		</div>
	</div>
</div>

</div>
<script type="text/javascript" id="list_0">
    <% for(var i in items){ %>
    <li class="show-item lf">
            <div class="img-center">
            <a href="<?=YLB_Registry::get('url')?>?ctl=Goods_Goods&met=goods&type=goods&gid=<%= items[i].goods_mark_id%>">
            <img src="<%= items[i].common_image %>" alt="">
            <div class="bg-xl">销量：<%= items[i].common_salenum %></div>
        </a>
        </div>
        <div class="goods-detail w-270 text2 mt-6">
            <a href="<?=YLB_Registry::get('url')?>?ctl=Goods_Goods&met=goods&type=goods&gid=<%= items[i].goods_mark_id%>? +
            ?">
            <%= items[i].common_name %>
            </a>
            </div>
            <div class="price-wrap w-270 orflow mt-6">
            <div class="price lf">
            ￥<span class="price-num"><%= items[i].common_price %></span>
            </div>
            <div class="tag-wrap rt">
            <span class="red-tag">包邮</span>
            </div>
            </div>
            <div class="share-wrap-270 w-270 orflow mt-6">
            <div class="share-wrap lf">
            <div class="share orflow">
            <span>分享立减</span>
            <span class="save">￥<%= items[i].common_share_price %></span>
            </div>
            </div>
            <div class="share-wrap rt">
            <div class="share orflow">
            <span>立赚</span>
            <span class="save">￥<%= items[i].common_promotion_price %></span>
            </div>
            </div>
            </div>
            <div class="rate-wrap mt-6 w-270 orflow">
            <div class="rate lf">
            佣金比例:<span><%= items[i].common_cps_rate%>.00%</span>
        </div>
        <div class="rate rt">
            可得佣金:<span><i>￥</i><%= items[i].common_cps_commission%></span>
        </div>
        </div>
        <div class="shop-wrap mt-6">
            <a href="?ctl=Shop&met=index&typ=e&id=<%= items[i].shop_id%>" class="shop-a">
            <i class="icon"></i>
            <span><%= items[i].shop_name%></span>
            </a>
            </div>
            <div class="spread-wrap mt-6">
            <% if( items[i].exist){%>
            <div class="spread apply">
            <a href="javascript:;" class="grid-1 rt extend-once">立即推广</a>
            <a href="javascript:;" class="grid-1 rt erweima grid-brown">二维码</a>
            <a href="javascript:;" class="grid-1 rt copy-code grid-brown">
            <i class="icon"></i>
            复制链接</a>
            </div>
            <%}else{%>
            <div class="spread apply cl">
            <a href="javascript:;" class="grid-1 rt">申请淘金</a>
            </div>
            <%}%>

            </div>
            </li>
        <%}%>
</script>
<script type="text/javascript" id="list_1">
    <% for(var i in items){ %>
    <li class="show-item lf">
        <ul class="item-ul">
        <li class="item-li lf w-530">
        <div class="img-center lf">
        <a href="<?=YLB_Registry::get('url')?>?ctl=Goods_Goods&met=goods&type=goods&gid=<%= items[i].goods_mark_id%>">
        <img src="<%= items[i].common_image %>" alt="">
        </a>
        </div>
        <div class="li-main w-370 lf">
        <div class="goods-detail text1 w-350">
        <a href="<?=YLB_Registry::get('url')?>?ctl=Goods_Goods&met=goods&type=goods&gid=<%= items[i].goods_mark_id%>">
        <%= items[i].common_name %>
        </a>
        </div>
        <div class="tag-wrap">
        <span class="red-tag">包邮</span>
        </div>
        <div class="share-wrap-300 w-300 orflow mt-6">
        <div class="share-wrap lf">
        <div class="share orflow">
        <span>分享立减</span>
        <span class="save">￥<%= items[i].common_share_price%></span>
        </div>
        </div>
        <div class="share-wrap rt">
        <div class="share orflow">
        <span>立赚</span>
        <span class="save">￥<%= items[i].common_promotion_price%></span>
        </div>
        </div>
        </div>
        <div class="shop-wrap mt-6">
        <a href="javascript:;" class="shop-a">
        <i class="icon"></i>
        <span><%= items[i].shop_name%></span>
        </a>
        </div>
        </div>
        </li>
        <li class="item-li lf w-140">
        <div class="price lf mt-50">
        ￥<span class="price-num"><% items[i].common_price %></span>
        </div>
        </li>
        <li class="item-li lf w-155">
        <div class="rate lf mt-50">
        <span><%= items[i].common_cps_rate%>.00%</span>
        </div>
        </li>
        <li class="item-li lf w-155">
        <div class="rate mt-50">
        <span><i>￥</i><%= items[i].common_cps_commission%></span>
        </div>
        </li>
        <li class="item-li lf w-120">
        <div class="xl mt-50"><%= items[i].common_salenum%>件</div>
        </li>
        <li class="item-li lf w-100 center">
        <div class="spread-wrap">
      <% if( items[i].exist){%>
        <div class="spread apply">
        <a href="javascript:;" class="grid-1 rt extend-once">立即推广</a>
        <a href="javascript:;" class="grid-1 rt erweima grid-brown">二维码</a>
        <a href="javascript:;" class="grid-1 rt copy-code grid-brown">
        <i class="icon"></i>
        复制链接</a>
        </div>
                <%}else{%>
        <div class="spread apply cl">
        <a href="javascript:;" class="grid-1 rt">申请淘金</a>
        </div>
                <%}%>
        </div>
        </li>
        </ul>
        </li>
   <%}%>
</script>
<?php
include $this->view->getTplPath() . '/' . 'buyer_footer.php';
?>