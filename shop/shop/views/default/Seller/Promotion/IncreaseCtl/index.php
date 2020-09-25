<?php if (!defined('ROOT_PATH')){exit('No Permission');}?>
<?php
include $this->view->getTplPath() . '/' . 'seller_header.php';
?>

<link href="<?= $this->view->css_com ?>/jquery/plugins/dialog/green.css?ver=<?=VER?>" rel="stylesheet" type="text/css">
<script type="text/javascript" src="<?=$this->view->js_com?>/plugins/jquery.dialog.js" charset="utf-8"></script>

<div class="exchange">
	<div class="alert">
        <?php if($this->self_support_flag){ ?>
            <ul>
                <li>1、<?=_('点击添加活动按钮可以添加加价购活动，点击编辑按钮可以对加价购活动进行编辑')?></li>
                <li>2、<?=_('点击删除按钮可以删除加价购活动')?></li>
            </ul>
        <?php  }else{ ?>
            <h4>
                <?php if($this->combo_flag){ ?><?=_('套餐过期时间')?>：<em class="red"></em><?=$combo_row['combo_end_time']?>。
                <?php }else{ ?>
                    <?=_('你还没有购买套餐或套餐已经过期，请购买或续费套餐')?>
                <?php  } ?>
            </h4>
            <ul>
                <li>1、<?=_('点击套餐管理可以购买或续费套餐')?></li>
                <li>2、<?=_('点击添加活动按钮可以添加加价购活动，点击编辑按钮可以对加价购活动进行编辑')?></li>
                <li>3、<?=_('点击删除按钮可以删除加价购活动')?></li>
                <li>4、<strong  class="bbc_seller_color"><?=_('相关费用会在店铺的账期结算中扣除')?></strong></li>
            </ul>
        <?php } ?>
	</div>
	<div class="search fn-clear">
	<form id="search_form" method="get" action="<?=YLB_Registry::get('url')?>?ctl=Seller_Promotion_Increase&met=index&typ=e">
        <input type="hidden" name="ctl" value="Seller_Promotion_Increase">
        <input type="hidden" name="met" value="index">
        <a class="button refresh" href="<?=YLB_Registry::get('url')?>?ctl=Seller_Promotion_Increase&met=index&typ=e"><i class="iconfont icon-huanyipi"></i></a>
        <a class="button btn_search_goods" href="javascript:void(0);"><i class="iconfont icon-btnsearch"></i><?=_('搜索')?></a>
        <input type="text" name="keyword" class="text w200" placeholder="<?=_('请输入活动名称')?>" value="<?=request_string('keyword')?>" />
    
        <select name="state">
            <option value="0" <?=request_int('state') == 0 ?'selected':''?>><?=_('全部状态')?></option>
            <option value="<?=Increase_BaseModel::NORMAL?>" <?=Increase_BaseModel::NORMAL == request_int('state')?'selected':''?>><?=_('正常')?></option>
            <option value="<?=Increase_BaseModel::FINISHED?>" <?=Increase_BaseModel::FINISHED == request_int('state')?'selected':''?>><?=_('已结束')?></option>
            <option value="<?=Increase_BaseModel::CLOSED?>" <?=Increase_BaseModel::CLOSED == request_int('state')?'selected':''?>><?=_('管理员关闭')?></option>
		</select>
	</form>
	<script type="text/javascript">
	$(".search").on("click","a.button",function(){
		$("#search_form").submit();
	});
	</script>
	</div>

	<table class="table-list-style" id="table_list" width="100%" cellpadding="0" cellspacing="0">
		<tr>
			<th class="tl" width="200"><?=_('活动名称')?></th>
			<th width="100"><?=_('开始时间')?></th>
			<th width="100"><?=_('结束时间')?></th>
			<th width="80"><?=_('状态')?></th>
			<th width="70"><?=_('操作')?></th>
		</tr>
        <?php
        if($data['items'])
        {
            foreach($data['items'] as $key=>$value)
            {
        ?>
        <tr class="row_line">
            <td class="tl"><?=@$value['increase_name']?></td>
            <td><?=@$value['increase_start_time']?></td>
            <td><?=@$value['increase_end_time']?></td>
            <td><?=@$value['increase_state_label']?></td>
            <td>
                <span class="edit"><a href="<?=YLB_Registry::get('url')?>?ctl=Seller_Promotion_Increase&met=index&typ=e&op=edit&id=<?=@$value['increase_id']?>"><i class="iconfont icon-zhifutijiao"></i><?=_('编辑')?></a></span>
                <span class="del"><a data-param="{'ctl':'Seller_Promotion_Increase','met':'removeIncreaseAct','id':'<?=@$value['increase_id']?>'}" href="javascript:void(0)"><i class="iconfont icon-lajitong"></i><?=_('删除')?></a></span>
            </td>
        </tr>
        <?php }  }else{ ?>
            <tr class="row_line">
                <td colspan="99">
                    <div class="no_account">
                        <img src="<?=$this->view->img?>/ico_none.png">
                        <p>暂无符合条件的数据记录</p>
                    </div>
                </td>
            </tr>
        <?php } ?>
    </table>
    <?php if($page_nav){ ?>
        <div class="mm">
            <div class="page"><?=$page_nav?></div>
        </div>
    <?php }?>
</div>

<?php
include $this->view->getTplPath() . '/' . 'seller_footer.php';
?>



