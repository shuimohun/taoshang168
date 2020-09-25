<?php if (!defined('ROOT_PATH')){exit('No Permission');}

include $this->view->getTplPath() . '/' . 'buyer_header.php';
?>

    <style>
        .share_wrap{margin-top:3px;margin-right:10px;margin-left:20%}
        .share_wrap .share{margin-top:2px;line-height:20px;width:98px;height:18px;border:1px solid #c51e1e;font-size:12px;color:#c51e1e;text-align:center}
        .share u{text-decoration:none;background-color:#c51e1e;color:#fff;float:right;width:48px;height:100%;text-align:center}
    </style>

</div>
 <ul class="tracks_con_types clearfix">
			<?php if(!empty($cat)){ ?>
            <li><a href="<?= YLB_Registry::get('url') ?>?ctl=Buyer_Favorites&met=footprint" class="<?php if($classid == ''){ ?>bbc_btns<?php }?>"><?=_('全部分类')?></a></li>
			
			<?php foreach($cat as $val){ ?>
            <li ><a class="<?php if($classid == $val['cat_id']){ ?>bbc_btns<?php }?>" href="<?= YLB_Registry::get('url') ?>?ctl=Buyer_Favorites&met=footprint&classid=<?=$val['cat_id']?>"><?=$val['cat_name']?></a></li>
			<?php } ?>
			<?php } ?>
          </ul>
<div class="tracks_con_more">
			<?php if(!empty($arr['items'])){?>
			<?php foreach($arr['items'] as $key=>$val){ ?>
            <div class="tracks_con_time_list">
				<?php foreach($val as $ke=>$va){ ?>
				
              <p class="tracks_con_time_p"><i class="bgred"></i><span></span><time><?=$ke?></time><a href="javascript:void(0)" data-param="{'ctl':'Buyer_Favorites','met':'delFootPrint','time':'<?=$ke?>','classid':'<?=$class?>'}" class="delete" title="<?=_('删除')?>"><i class="icon-trash iconfont icon-lajitong mar0"></i><?=_('删除')?></a></p>
              <ul class="clearfix li_hover">
				<?php foreach($va as $k=>$v){ ?>
				<?php if(!empty($v['detail'])){?>
                <li>
                 <a href="<?= YLB_Registry::get('url') ?>?ctl=Goods_Goods&met=goods&type=goods&gid=<?=$v['detail']['goods_id']?>" target="_blank"> <img src="<?php if($v['detail']['common_image']){?><?=image_thumb($v['detail']['common_image'],118,118)?><?php }else{?><?=image_thumb($this->web['goods_image'],118,118)?><?php }?>" height="118" width="138"/></a>
                  <span><?=format_money($v['detail']['common_price'])?></span>

                    <a class="share_wrap" style="margin-top:-12px"><span class="share">分享立减<u><?=format_money($v['detail']['common_share_price'])?></u></span></a>
                    <?php if($v['detail']['common_is_promotion']){?>
                    <a class="share_wrap"><span class="share">分享立赚<u><?=format_money($v['detail']['common_promotion_price'])?></u></span></a>
                    <?php }?>
                  <a class="add_cart" href="javascript:void(0)" title="<?=_('加入购物车')?>" data-param="{'ctl':'Buyer_Cart','met':'addCart','id':'<?=$v['detail']['goods_id']?>','num':'1'}"><i class="iconfont icon-zaiqigoumai f18 vermiddle"></i><?=_('加入购物车')?></a>

                </li>
				<?php }?>
				<?php }?>
				
              </ul>
			  <?php }?>
            </div>
			<?php }?>
			<?php }else{ ?>
			 <div class="no_account">
				<img src="<?= $this->view->img ?>/ico_none.png"/>
				<p><?=_('暂无符合条件的数据记录')?></p>
			</div>  
			<div style="clear:both"></div>
			<?php } ?>
			<?php if($page_nav){?>
			<div class="flip page page_front clearfix" style="text-align: center;">
				<?=$page_nav?>
			</div>
			<?php }?>
			<div style="clear:both"></div>
          </div> 
          
    </div>
   </div>
 </div>
</div>
<script type="text/javascript">
$(".add_cart").click(function(){
	var e = $(this);
	eval('data_str =' + $(this).attr('data-param'));

	$.post(SITE_URL  + '?ctl='+data_str.ctl+'&met='+data_str.met+'&typ=json',{goods_id:data_str.id,goods_num:data_str.num},function(data){
		if(data && 200 == data.status){
			
			Public.tips.success("<?=_('加入成功！')?>");
		}else
		{
			Public.tips.error("<?=_('加入失败！')?>"+data.msg);
		}
	});
});
$(".delete").click(function(){
	var e = $(this);
	eval('data_str =' + $(this).attr('data-param'));
	$.dialog.confirm("<?=_('确认删除？')?>",function(){ 
	$.post(SITE_URL  + '?ctl='+data_str.ctl+'&met='+data_str.met+'&typ=json',{time:data_str.time,id:data_str.classid},function(data){

		if(data && 200 == data.status){
		
			e.parents("div:first").hide('slow');

		}else
		{
			Public.tips.error("<?=_('删除失败！')?>");
		}
	});
	});
});
</script>
<?php
include $this->view->getTplPath() . '/' . 'buyer_footer.php';
?>