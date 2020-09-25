<?php if (!defined('ROOT_PATH')){exit('No Permission');}

include $this->view->getTplPath() . '/' . 'buyer_header.php';
?>

    <style>
        p{display:block;-webkit-margin-before:1em;-webkit-margin-after:1em;-webkit-margin-start:0;-webkit-margin-end:0}
        .share{width:98px;height:18px;border:1px solid #c51e1e;font-size:12px;line-height:19px;color:#c51e1e;text-align:center}
        .share_wrap{display:inline-block;float:left;margin-left:11%;margin-top:3px;margin-bottom:4px}
        .share u{text-decoration:none;background-color:#c51e1e;color:#fff;float:right;width:48px;height:100%;text-align:center}
        .sub{float:right;font-size:12px;margin-top:-2px;color:#999}
        .goods_shared_price{color:red;margin-top:-2px;float:left}
    </style>

		</div>
         <!--  有内容显示 -->
		  <?php if(!empty($data['items'])){?>
		  <?php foreach($data['items'] as $val){ ?>
		  <?php if(!empty($val['shop'])){?>
          <div class="ncm-favorite-store">
            <div class="store-info">
             <div class="store-pic" >
               <img src="<?php if(!empty($val['shop']['shop_logo'])){?><?=image_thumb($val['shop']['shop_logo'],50,50)?><?php }else{?><?=image_thumb($this->web['shop_head_logo'],50,50)?><?php }?>"></div>
             <dl>
               <dt>
                 <a href="<?= YLB_Registry::get('url') ?>?ctl=Shop&id=<?=$val['shop']['shop_id']?>" target="_blank"><?=$val['shop']['shop_name']?></a>
               </dt>
               <dd>
                 <?=_('联系方式：')?>
                 <span member_id="7"><?=$val['shop']['shop_tel']?></span>
               </dd>

               <dd><?=_('所在地：')?><?=$val['shop']['shop_address']?></dd>
             </dl>
             <div class="handle" >
              
               <a href="javascript:void(0)" data-param="{'ctl':'Buyer_Favorites','met':'delFavoritesShop','id':'<?=$val['shop']['shop_id']?>'}" class="fr ml5 delete" title="<?=_('删除')?>"><i class="icon-trash iconfont icon-lajitong"></i>
               </a>
             </div>
           </div>
           <div class="store-goods" >
             <a href="<?= YLB_Registry::get('url') ?>?ctl=Shop&met=index&typ=e&id=<?=$val['shop']['shop_id']?>" class="more" target="_blank"><?=_('查看更多')?><i class="iconfont icon-iconjiantouyou"></i></a>
             <div class="show-tab" data-sid="6">
               <a href="javascript:void(0)" class="current "><?=_('优惠促销')?></a>
             </div>
             <div class="show-list" >
               <ul>
				<?php if(!empty($val['shop']['detail']['items'])){?>
				<?php foreach($val['shop']['detail']['items'] as $v){ ?>
                 <li>
                   <div class="goods-thumb">
                     <a href="<?= YLB_Registry::get('url') ?>?ctl=Goods_Goods&met=goods&type=goods&gid=<?=$v['goods_id']?>" title="<?=$v['common_name']?>" target="_blank">
                       
                       <img src="<?php if($v['common_image']){?><?=image_thumb($v['common_image'],120,120)?><?php }else{?><?=image_thumb($this->web['goods_image'],120,120)?><?php }?>" height="120" width="120"></a>
                   </div>

                   <p><?=format_money($v['common_price'])?></p>

                     <p class="share_wrap"><span class="share">分享立减<u><?=format_money($v['common_share_price'])?></u></span></p>
                    <?php if($v['common_is_promotion']){?>
                     <p class="share_wrap"><span class="share">分享立赚<u><?=format_money($v['common_promotion_price'])?></u></span></p>
                    <?php }?>

                 </li>
                 <?php }?>
				<?php } ?>
               </ul>
             </div>
             
           </div>
          </div> 
		  <?php }?>
		  <?php }?>
		<?php }else{ ?>
		 <div class="no_account">
            <img src="<?= $this->view->img ?>/ico_none.png"/>
            <p><?=_('暂无符合条件的数据记录')?></p>
        </div>  
		<?php }?>
          <div class="flip page page_front clearfix">
           <?=$page_nav?>
          </div>
       </div>
     </div>
 </div>
 </div>
<script>	
$(".delete").click(function(){
	var e = $(this);
	eval('data_str =' + $(this).attr('data-param'));
	$.dialog.confirm("<?=_('确认删除？')?>",function(){ 
	$.post(SITE_URL  + '?ctl='+data_str.ctl+'&met='+data_str.met+'&typ=json',{id:data_str.id},function(data){
		if(data && 200 == data.status){

			Public.tips.success("<?=_('删除成功！')?>");
			location.href= SITE_URL+"?ctl=Buyer_Favorites&met=favoritesShop";
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