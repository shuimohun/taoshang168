<?php if (!defined('ROOT_PATH')){exit('No Permission');}

include $this->view->getTplPath() . '/' . 'buyer_header.php';
?>

    <style>
        p{display:block;-webkit-margin-before:1em;-webkit-margin-after:1em;-webkit-margin-start:0;-webkit-margin-end:0}
        .share{width:98px;height:18px;border:1px solid #c51e1e;font-size:12px;line-height:19px;color:#c51e1e;text-align:center}
        .share_wrap{display:inline-block;float:left;margin-left:20%;margin-top:3px;margin-bottom:4px}
        .share u{text-decoration:none;background-color:#c51e1e;color:#fff;float:right;width:48px;height:100%;text-align:center}
        .sub{float:right;font-size:12px;margin-top:-2px;color:#999}
        .goods_shared_price{color:red;margin-top:-2px;float:left}
    </style>
	</div>
		<?php if(!empty($data['items'])){?>
          <div id="favoritesGoods">
            <div class="favorite-goods-list">
              <ul>
				<?php foreach($data['items'] as $val){ ?>
                    <?php if(!empty($val['detail'])){?>
                        <li class="favorite-pic-list">
                          <div class="favorite-goods-thumb">
                            <a href="<?= YLB_Registry::get('url') ?>?ctl=Goods_Goods&met=goods&type=goods&gid=<?=$val['detail']['goods_id']?>" target="_blank" title="<?=$val['detail']['goods_name']?>">
                              <div class="jqthumb" style="width: 150px; height: 150px; opacity: 1;">
                                <div style="width: 100%; height: 100%; background-image: url(<?=$val['detail']['goods_image']?>); background-size: cover; background-position: 50% 50%; background-repeat: no-repeat;"></div>
                              </div>
                              <img src="<?=image_thumb($val['detail']['goods_image'],150,150)?>" style="display: none;"></a>
                          </div>
                          <div class="handle">
                            <a href="javascript:void(0)" data-param="{'ctl':'Buyer_Favorites','met':'delFavoritesGoods','id':'<?=$val['goods_id']?>'}" class="fr ml5 delete" title="<?=_('删除')?>"><i class="">删除</i>
                            </a>
                            <a href="javascript:void(0)" class="fr add_cart" title="<?=_('加入购物车')?>" data-param="{'ctl':'Buyer_Cart','met':'addCart','id':'<?=$val['goods_id']?>','num':'1'}"> <i class="">加入购物车</i>
                            </a>

                          </div>
                          <dl class="favorite-goods-info">
                            <dt>
                              <a href="<?= YLB_Registry::get('url') ?>?ctl=Goods_Goods&met=goods&type=goods&gid=<?=$val['detail']['goods_id']?>" target="_blank" title="<?=$val['detail']['goods_name']?>"><?=$val['detail']['goods_name']?></a>
                            </dt>
                            <dd class="goods-price">
        <!--                        --><?php //d($val['detail']);?>
                                <a class="goods_shared_price" href=""><?=format_money($val['detail']['goods_shared_price'])?></a>
                                <a class="sub">减免前:<?=format_money($val['detail']['goods_price'])?></a><!--<strong class="common-color"></strong>-->
                            </dd>
                            <dd>
                                <p class="share_wrap"><span class="share">分享立减<u><?=format_money($val['detail']['goods_share_price'])?></u></span></p>
                                <p class="share_wrap"><span class="share">分享立赚<u><?=format_money($val['detail']['goods_promotion_price'])?></u></span></p>
                            </dd>
                          </dl>
                        </li>
                    <?php }else{?>
                        <li class="favorite-pic-list">
                            <div class="favorite-goods-thumb">
                                <a href="<?= YLB_Registry::get('url') ?>?ctl=Goods_Goods&met=goods&type=goods&gid=<?=$val['goods_id']?>" target="_blank" title="<?=$val['goods_name']?>">
                                    <div class="jqthumb" style="width: 150px; height: 150px; opacity: 1;">
                                        <div style="width: 100%; height: 100%; background-image: url(<?=$val['goods_image']?>); background-size: cover; background-position: 50% 50%; background-repeat: no-repeat;"></div>
                                    </div>
                                    <img src="<?=image_thumb($val['goods_image'],150,150)?>" style="display: none;"></a>
                            </div>
                            <div class="handle">
                                <a href="javascript:void(0)" data-param="{'ctl':'Buyer_Favorites','met':'delFavoritesGoods','id':'<?=$val['goods_id']?>'}" class="fr ml5 delete" title="<?=_('删除')?>"><i class="">删除</i>
                                </a>
                            </div>
                            <dl class="favorite-goods-info">
                                <dt>
                                    <a href="<?= YLB_Registry::get('url') ?>?ctl=Goods_Goods&met=goods&type=goods&gid=<?=$val['goods_id']?>" target="_blank" title="<?=$val['goods_name']?>"><?=$val['goods_name']?></a>
                                </dt>
                                <dd class="goods-price">
                                    宝贝已失效
                                </dd>
                            </dl>
                        </li>
                    <?php }?>
                <?php }?>
              </ul>
            </div>
            </div>
	   <?php }else{?>
		 <div class="no_account">
            <img src="<?= $this->view->img ?>/ico_none.png"/>
            <p><?=_('暂无符合条件的数据记录')?></p>
        </div> 
        <div style="clear:both"></div> 
  	   <?php }?>
  	   <div class="flip page page_front clearfix">
         <?=$page_nav?>
        </div>
          <div style="clear:both"></div>
       </div>
        
<script type="text/javascript">
$(".add_cart").on('click', function(){
	var e = $(this);
	eval('data_str =' + $(this).attr('data-param'));
	$.post(SITE_URL  + '?ctl='+data_str.ctl+'&met='+data_str.met+'&typ=json',{goods_id:data_str.id,goods_num:data_str.num},function(data){
		if(data && 200 == data.status){
            var cat_num = parseInt($('#cart_num').html());
            $('#cart_num').html(cat_num+1);
            e.hide('slow');
			Public.tips.success("<?=_('加入成功！')?>");
		}else
		{
			Public.tips.error("<?=_('加入失败！')?>");
		}
	});
});
$(".delete").click(function(){
	var e = $(this);
	eval('data_str =' + $(this).attr('data-param'));
	$.dialog.confirm("<?=_('确认删除？')?>",function(){ 
	$.post(SITE_URL  + '?ctl='+data_str.ctl+'&met='+data_str.met+'&typ=json',{id:data_str.id},function(data){
		if(data && 200 == data.status){
		
			e.parents("li:first").hide('slow');

		}else
		{
			Public.tips.error("<?=_('删除失败！')?>");
		}
	});
	});
});
</script>
</div>
</div>
</div>
<?php
include $this->view->getTplPath() . '/' . 'buyer_footer.php';
?>