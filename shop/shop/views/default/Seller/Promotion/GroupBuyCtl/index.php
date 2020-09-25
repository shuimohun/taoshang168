<?php if (!defined('ROOT_PATH')){exit('No Permission');}?>
<?php
include $this->view->getTplPath() . '/' . 'seller_header.php';
?>

<div class="exchange">
	<div class="alert">
        <?php if($shop_type){ ?>
        <ul>
            <li><?=_('1、点击新增团购按钮可以添加团购活动')?></li>
            <li><?=_('2、如发布虚拟商品的团购活动，请点击新增虚拟团购按钮')?></li>
        </ul>
        <?php }else{ ?>
        <h4>
            <?php if($com_flag){ ?><?=_('套餐过期时间')?>：<em class="red"></em><?=$combo_row['combo_endtime']?>。
            <?php }else{ ?>
                <?=_('你还没有购买套餐或套餐已经过期，请购买或续费套餐')?>
            <?php  } ?>
        </h4>
        <ul>
            <li><?=_('1、点击套餐管理或续费套餐可以购买或续费套餐')?></li>
            <li>2、<strong  class="bbc_seller_color"><?=_('相关费用会在店铺的账期结算中扣除')?></strong></li>
        </ul>
        <?php } ?>
	</div>
	<div class="search fn-clear">
	<form id="search_form" method="get" action="<?=YLB_Registry::get('url')?>">
        <input type="hidden" name="ctl" value="<?=request_string('ctl')?>">
        <input type="hidden" name="met" value="<?=request_string('met')?>">
        <input type="hidden" name="typ" value="<?=request_string('typ')?>">
        <a class="button refresh" href="<?=YLB_Registry::get('url')?>?ctl=Seller_Promotion_GroupBuy&met=index&typ=e"><i class="iconfont icon-huanyipi"></i></a>
        <a class="button btn_search_goods" href="javascript:void(0);"><i class="iconfont icon-btnsearch"></i><?=_('搜索')?></a>

        <select name="type">
            <option value=""><?=_('请选择团购类型')?></option>
            <option><?=_('全部')?></option>
            <option value="<?=GroupBuy_BaseModel::ONLINEGBY?>" <?=GroupBuy_BaseModel::ONLINEGBY == request_int('type')?'selected':''?>><?=_('线上团')?></option>
            <option value="<?=GroupBuy_BaseModel::VIRGBY?>"  <?=GroupBuy_BaseModel::VIRGBY == request_int('type')?'selected':''?>><?=_('虚拟团')?></option>
        </select>
        <select name="state">
            <option value=""><?=_('请选择活动状态')?></option>
            <option value="0"><?=_('全部')?></option>
            <option value="<?=GroupBuy_BaseModel::UNDERREVIEW?>" <?=GroupBuy_BaseModel::UNDERREVIEW == request_int('state')?'selected':''?>><?=_('审核中')?></option>
            <option value="<?=GroupBuy_BaseModel::NORMAL?>" <?=GroupBuy_BaseModel::NORMAL == request_int('state')?'selected':''?>><?=_('正常')?></option>
            <option value="<?=GroupBuy_BaseModel::FINISHED?>" <?=GroupBuy_BaseModel::FINISHED == request_int('state')?'selected':''?>><?=_('已结束')?></option>
            <option value="<?=GroupBuy_BaseModel::AUDITFAILUER?>" <?=GroupBuy_BaseModel::AUDITFAILUER == request_int('state')?'selected':''?>><?=_('审核失败')?></option>
            <option value="<?=GroupBuy_BaseModel::CLOSED?>" <?=GroupBuy_BaseModel::CLOSED == request_int('state')?'selected':''?>><?=_('管理员关闭')?></option>
        </select>

        <input type="text" name="keyword" class="text w200" placeholder="<?=_('请输入团购名称')?>" value="<?=request_string('keyword')?>" />

    </form>
	<script type="text/javascript">
	$(".search").on("click","a.button",function(){
		$("#search_form").submit();
	});
	</script>
	</div>

	<table class="table-list-style table-promotion-list" width="100%" cellpadding="0" cellspacing="0">
		<tr>
            <th width="50"></td>
			<th class="tl" width="300"><?=_('团购名称')?></th>
			<th width="120"><?=_('开始时间')?></th>
			<th width="120"><?=_('结束时间')?></th>
            <th width="50"><?=_('浏览数')?></th>
			<th width="50"><?=_('已购买')?></th>
			<th width="60"><?=_('活动状态')?></th>
		</tr>
        <?php
        if($data['items'])
        {
            foreach($data['items'] as $key=>$value)
            {
        ?>
        <tr>
            <td width="50"><a href="<?=YLB_Registry::get('url')?>?ctl=GroupBuy&met=detail&id=<?=$value['groupbuy_id']?>&typ=e" target="_blank"><img src="<?=image_thumb($value['groupbuy_image'],30,30)?>" width="30" height="30"></a></td>
            <td class="tl"><a href="<?=YLB_Registry::get('url')?>?ctl=GroupBuy&met=detail&id=<?=$value['groupbuy_id']?>&typ=e" target="_blank"><?=$value['groupbuy_name']?></a></td>
            <td><?=$value['groupbuy_starttime']?></td>
            <td><?=$value['groupbuy_endtime']?></td>
            <td><?=$value['groupbuy_views']?></td>
            <td><?=$value['groupbuy_buy_quantity']?></td>
            <td><?=$value['groupbuy_state_label']?></td>
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



