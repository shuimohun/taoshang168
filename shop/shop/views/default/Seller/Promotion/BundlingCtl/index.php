<?php if (!defined('ROOT_PATH')){exit('No Permission');}?>
<?php
include $this->view->getTplPath() . '/' . 'seller_header.php';
?>

<link href="<?= $this->view->css_com ?>/jquery/plugins/dialog/green.css?ver=<?=VER?>" rel="stylesheet" type="text/css">
<script type="text/javascript" src="<?=$this->view->js_com?>/plugins/jquery.dialog.js" charset="utf-8"></script>

<div class="exchange">
	<div class="alert">
        <?php  if($this->self_support_flag){ ?>
            <ul>
                <li><?=_('1、您最多可以发布50个优惠套装。')?></li>
            </ul>
        <?php }else{ ?>
            <h4>
                <?php if($this->quota_flag){ ?>
                    <?=_('套餐过期时间')?>：<em class="red"></em><?=$quota_row['bundling_quota_endtime']?>。
                <?php }else{ ?>
                    <?=_('你还没有购买套餐或套餐已经过期，请购买或续费套餐')?>
                <?php  } ?>
            </h4>
            <ul>
                <li><?=_('1、点击购买套餐和套餐续费按钮可以购买或续费套餐')?></li>
                <li><?=_('2、点击添加活动按钮可以添加限时折扣活动，点击管理按钮可以对限时折扣活动内的商品进行管理')?></li>
                <li><?=_('3、点击删除按钮可以删除限时折扣活动')?></li>
                <li>4、<strong class="bbc_seller_color"><?=_('相关费用会在店铺的账期结算中扣除')?></strong>。</li>
            </ul>
        <?php } ?>
	</div>

	<div class="search fn-clear">
        <form id="search_form" method="get" action="<?=YLB_Registry::get('url')?>?ctl=Seller_Promotion_Bundling&met=index&typ=e">
            <input type="hidden" name="ctl" value="<?=request_string('ctl')?>">
            <input type="hidden" name="met" value="<?=request_string('met')?>">
            <input type="hidden" name="typ" value="<?=request_string('typ')?>">
            <a class="button refresh" href="<?=YLB_Registry::get('url')?>?ctl=Seller_Promotion_Bundling&met=index&typ=e"><i class="iconfont icon-huanyipi"></i></a>
            <a class="button btn_search_goods" href="javascript:void(0);"><i class="iconfont icon-btnsearch"></i><?=_('搜索')?></a>
            <input type="text" name="keyword" class="text w200" placeholder="<?=_('请输入活动名称')?>" value="<?=request_string('keyword')?>" />
            <select name="state">
                <option value="0">全部</option>
                <option value="<?=Bundling_BaseModel::NORMAL?>" <?=Bundling_BaseModel::NORMAL == request_int('state')?'selected':''?> ><?=Bundling_BaseModel::$state_array_map[Bundling_BaseModel::NORMAL]?></option>
                <option value="<?=Bundling_BaseModel::END?>" <?=Bundling_BaseModel::END == request_int('state')?'selected':''?>><?=Bundling_BaseModel::$state_array_map[Bundling_BaseModel::END]?></option>
                <option value="<?=Bundling_BaseModel::CANCEL?>" <?=Bundling_BaseModel::CANCEL == request_int('state')?'selected':''?>><?=Bundling_BaseModel::$state_array_map[Bundling_BaseModel::CANCEL]?></option>
            </select>
        </form>
        <script type="text/javascript">
            $(".search").on("click","a.button",function(){
                $("#search_form").submit();
            });
        </script>
	</div>

	<table class="table-list-style table-promotion-list" id="table_list" width="100%" cellpadding="0" cellspacing="0">
		<tr>
			<th class="tl" width="200"><?=_('活动名称')?></th>
			<th width="120"><?=_('优惠套装价格')?></th>
			<th width="120"><?=_('商品数量')?></th>
			<th width="50"><?=_('状态')?></th>
			<th width="120"><?=_('操作')?></th>
		</tr>
        <?php if($data['items']){foreach($data['items'] as $key=>$value){?>
            <tr class="row_line">
                <td class="tl"><a href="<?=YLB_Registry::get('url')?>?ctl=Goods_Goods&met=bundling&bid=<?=$value['bundling_id']?>" target="_blank"><?=$value['bundling_name']?></a></td>
                <td><?=$value['bundling_discount_price']?></td>
                <td><?=$value['count']?></td>
                <td><?=$value['bundling_state_label']?></td>
                <td class="nscs-table-handle">
                    <span class="edit"><a href="<?=YLB_Registry::get('url')?>?ctl=Seller_Promotion_Bundling&met=add&op=edit&typ=e&id=<?=$value['bundling_id']?>"><i class="iconfont icon-zhifutijiao"></i><?=_('编辑')?></a></span>
                    <span class="del"><a data-param="{'ctl':'Seller_Promotion_Bundling','met':'removeBundling','id':'<?=$value['bundling_id']?>'}" href="javascript:void(0)"><i class="iconfont icon-lajitong"></i><?=_('删除')?></a></span>
                </td>
            </tr>
        <?php }}else{ ?>
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



