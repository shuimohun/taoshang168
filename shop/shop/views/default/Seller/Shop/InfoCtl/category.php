<?php if (!defined('ROOT_PATH')){exit('No Permission');}?>
<?php
include $this->view->getTplPath() . '/' . 'seller_header.php';
?>

    <div class="tabmenu">
	<ul>
        	<li class="active bbc_seller_bg"><a href="./index.php?ctl=Seller_Shop_Info&met=info&typ=e&act=category"><?=_('经营类目')?></a></li>
                 <?php if($shop['shop_self_support']=="false"){?> 
                <li ><a href="./index.php?ctl=Seller_Shop_Info&met=info&typ=e&act=info"><?=_('店铺信息')?></a></li>
                     <li ><a href="./index.php?ctl=Seller_Shop_Info&met=info&typ=e&act=record"><?=_('续签记录')?></a></li>
                <li ><a href="./index.php?ctl=Seller_Shop_Info&met=info&typ=e&act=renew"><?=_('申请续签')?></a></li>
                 <?php } ?>
        </ul>
        <?php if($shop['shop_all_class']=="0"){?>
        <a class="button add button_blue bbc_seller_btns" id="add_category"><i class="iconfont  icon-jia"></i><?=_('添加类目')?></a>
        <?php } ?>
        </div>
    
        <form id="form" action="./index.php?ctl=Seller_Shop_Cat&met=delAllCat&typ=json" method="post" onsubmit="return submitBtn();">
       <table class="table-list-style" width="100%" cellpadding="0" cellspacing="0">
    	<tr>
        	<th ><?=_('经营类目')?></th>
        	<th width="100"><?=_('分佣比例')?></th>
        	<th width="100"><?=_('状态')?></th>
        	<th width="120"><?=_('操作')?></th>
        </tr>
       <?php if($shop['shop_all_class']=="0"){?>
      <?php if($data['items']){
            foreach ($data['items']['product_parent_name'] as $key => $value) {
              
         
          ?>
        <tr class="row_line">
          
            
            <td class="tlf" > <?php  $i=0; foreach($value as $keys =>$val){
                if(!empty($val['cat_name'])){
                    ?><?php if($i){ ?> <i class="iconfont icon-iconjiantouyou" style="font-size: 12px;"></i> <?php } ?><?=$val['cat_name']?><?php } $i++;}?></td>
              
         
            
            <td><?=$data['items']['commission_rate'][$key]?>%</td>
            <td><?=$data['items']['shop_class_bind_enablecha'][$key]?></td>
           
            <td class="nscs-table-handle">
                 <?php if($data['items']['shop_class_bind_enable'][$key] == "1"){?>
                <span class="del" style="border-left: 0px;"><a data-param="{'ctl':'Seller_Shop_Info','met':'delInfo','id':'<?=$data['items']['shop_class_bind_id'][$key]?>'}" href="javascript:void(0)"><i class="iconfont icon-lajitong"></i>删除</a></span>
                 <?php }else{ ?>
                 <span class="unclick"><a data-param="{'ctl':'Seller_Shop_Info','met':'delInfo','id':'<?=$data['items']['shop_class_bind_id'][$key]?>'}" href="javascript:void(0)"><i class="iconfont icon-lajitong"></i>删除</a></span>
                 <?php }?>
            </td>
           
        </tr>
              
      
            <?php } }else{ ?>          
     
        <tr class="row_line">
                <td colspan="99">
                    <div class="no_account">
                        <img src="<?=$this->view->img?>/ico_none.png">
                        <p>暂无符合条件的数据记录</p>
                    </div>
                </td>
            </tr>
            <?php } }else{?>
             <tr class="row_line">
                <td colspan="99">
                    <div class="no_account">
                        <img src="<?=$this->view->img?>/ico_none.png">
                        <p>您已绑定所有类目</p>
                    </div>
                </td>
            </tr>
       <?php }?>  
         <!--- 分页 --->
       <?php if(!empty($page_nav)){?>
       <?php if($shop['shop_all_class']=="0"){?>
	<tr>
            <td colspan="99">
		<div class="page">
			<?=$page_nav?>
		</div>
	    </td>
	</tr>
        <?php }}?>
    </table>
        </form>

<script>
        $('#add_category').click(function ()
        {
            $.dialog({
                title: "<?=_('添加经营类目')?>",
                content: 'url: ' + SITE_URL + '?ctl=Seller_Shop_Info&met=addCategory&typ=e',
                width: 600,
                height: 300,
                max: !1,
                min: !1,
                cache: !1,
                lock: !0
            });

        });
    
</script>
<?php
include $this->view->getTplPath() . '/' . 'seller_footer.php';
?>