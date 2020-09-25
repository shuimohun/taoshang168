<?php if (!defined('ROOT_PATH')){exit('No Permission');}?>
<?php
include $this->view->getTplPath() . '/' . 'seller_header.php';
?>
<link href="<?= $this->view->css?>/seller_center.css?ver=<?=VER?>" rel="stylesheet" type="text/css">
<link href="<?= $this->view->css_com ?>/jquery/plugins/dialog/green.css?ver=<?=VER?>" rel="stylesheet" type="text/css">
<script type="text/javascript" src="<?=$this->view->js_com?>/plugins/jquery.dialog.js" charset="utf-8"></script>
<style>
    .nscs-table-handle span a i{font-size: 25px;}
</style>
<div class="exchange">
	<div class="alert">
        <?php  if($this->self_support_flag){ ?>
            <ul>
                <li><?=_('1、点击添加活动按钮可以添加新人优惠活动，点击管理按钮可以对新人优惠活动内的商品进行管理')?></li>
                <li><?=_('2、点击删除按钮可以删除新人优惠活动')?></li>
            </ul>
        <?php }else{ ?>
            <h4>
                <?php if($this->quota_flag){ ?><?=_('套餐过期时间')?>：<em class="red"></em><?=$quota_row['quota_endtime']?>。
                <?php }else{ ?>
                    <?=_('你还没有购买套餐或套餐已经过期，请购买或续费套餐')?>
                <?php  } ?>
            </h4>
            <ul>
                <li><?=_('1、点击购买套餐和套餐续费按钮可以购买或续费套餐')?></li>
                <li><?=_('2、点击添加活动按钮可以添加新人优惠活动，点击管理按钮可以对新人优惠活动内的商品进行管理')?></li>
                <li><?=_('3、点击删除按钮可以删除新人优惠活动')?></li>
                <li>4、<strong class="bbc_seller_color"><?=_('相关费用会在店铺的账期结算中扣除')?></strong>。</li>
            </ul>
        <?php } ?>
	</div>
	<div class="search fn-clear">
        <form id="search_form" method="get" action="<?=YLB_Registry::get('url')?>?ctl=Seller_Promotion_NewBuyer&met=index&typ=e">
            <input type="hidden" name="ctl" value="<?=request_string('ctl')?>">
            <input type="hidden" name="met" value="<?=request_string('met')?>">
            <input type="hidden" name="typ" value="<?=request_string('typ')?>">
            <a class="button refresh" href="<?=YLB_Registry::get('url')?>?ctl=Seller_Promotion_NewBuyer&met=index&typ=e"><i class="iconfont icon-huanyipi"></i></a>
            <a class="button btn_search_goods" href="javascript:void(0);"><i class="iconfont icon-btnsearch"></i><?=_('搜索')?></a>
            <input type="text" name="keyword" class="text w200" placeholder="<?=_('请输入商品名称')?>" value="<?=request_string('keyword')?>" />
            <select name="state">
                <option value="0">全部状态</option>
                <option value="<?=NewBuyer_BaseModel::NORMAL?>" <?=NewBuyer_BaseModel::NORMAL == request_int('state')?'selected':''?> ><?=NewBuyer_BaseModel::$state_array_map[NewBuyer_BaseModel::NORMAL]?></option>
                <option value="<?=NewBuyer_BaseModel::END?>" <?=NewBuyer_BaseModel::END == request_int('state')?'selected':''?>><?=NewBuyer_BaseModel::$state_array_map[NewBuyer_BaseModel::END]?></option>
                <option value="<?=NewBuyer_BaseModel::CANCEL?>" <?=NewBuyer_BaseModel::CANCEL == request_int('state')?'selected':''?>><?=NewBuyer_BaseModel::$state_array_map[NewBuyer_BaseModel::CANCEL]?></option>
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
			<th width="50"></th>
			<th class="tl" width="200"><?=_('商品名称')?></th>
			<th width="80"><?=_('商品价格')?></th>
			<th width="80"><?=_('优惠价格')?></th>
            <th width="80"><?=_('分享优惠')?></th>
			<th width="100"><?=_('开始时间')?></th>
			<th width="100"><?=_('结束时间')?></th>
			<th width="50"><?=_('状态')?></th>
			<th width="120"><?=_('操作')?></th>
		</tr>
        <?php if($data['items']) { foreach($data['items'] as $key=>$value) { ?>
            <tr class="row_line">
                <td width="50"><a href="<?=YLB_Registry::get('url')?>?ctl=Goods_Goods&met=goods&gid=<?=$value['goods_id']?>&typ=e" target="_blank"><img src="<?=image_thumb($value['goods_image'],30,30)?>" width="30" height="30"></a></td>
                <td class="tl"><a href="<?=YLB_Registry::get('url')?>?ctl=Goods_Goods&met=goods&gid=<?=$value['goods_id']?>&typ=e" target="_blank"><?=$value['goods_name']?></a></td>
                <td><?=format_money($value['goods_price'])?></td>
                <td><span optype="newbuyer_price" data-newbuyer-price="<?=$value['newbuyer_price']?>"><?=format_money($value['newbuyer_price'])?></span></td>
                <td><?=format_money($value['share_sum_price'])?></td>
                <td><?=$value['newbuyer_starttime']?></td>
                <td><?=$value['newbuyer_endtime']?></td>
                <td><?=$value['newbuyer_state_label']?></td>
                <td class="nscs-table-handle" >
                    <!--<span class="edit"><a href="<?/*=YLB_Registry::get('url')*/?>?ctl=Seller_Promotion_NewBuyer&met=add&op=edit&typ=e&id=<?/*=$value['newbuyer_id']*/?>"><i class="iconfont icon-zhifutijiao"></i><?/*=_('编辑')*/?></a></span>-->
                    <span class="edit"><a href="javascript:void(0);" optype="btn_edit_newbuyer_goods" data-newbuyer-goods-id="<?=$value['newbuyer_id']?>" data-newbuyer-name="<?=$value['newbuyer_name']?>" data-goods-price-format = "<?=format_money($value['goods_price'])?>" data-goods-price="<?=$value['goods_price']?>" data-share-sum-price-format = "<?=format_money($value['share_sum_price'])?>"  data-share-sum-price="<?=$value['share_sum_price']?>"><i class="iconfont icon-zhifutijiao" ></i><?=_('编辑')?></a></span>
                    <span class="del"><a data-param="{'ctl':'Seller_Promotion_NewBuyer','met':'removeNewBuyerAct','id':'<?=$value['newbuyer_id']?>'}" href="javascript:void(0)"><i class="iconfont icon-lajitong"></i><?=_('删除')?></a></span>
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
<!--编辑限时折扣商品价格-->
<div id="dialog_edit_newbuyer_goods" class="eject_con" style="display:none;">
    <input id="dialog_newbuyer_goods_id" type="hidden">
    <dl>
        <dt><?=_('商品价格')?>：</dt>
        <dd><span id="dialog_edit_goods_price" data-price = 0></dd>
    </dl>
    <dl>
        <dt><?=_('分享优惠')?>：</dt>
        <dd><span id="dialog_edit_share_sum_price" data-share-sum-price = 0></dd>
    </dl>
    <dl>
        <dt><?=_('活动说明')?>：</dt>
        <dd><input id="dialog_edit_newbuyer_name" type="text" class="text w200"></dd>
    </dl>
    <dl>
        <dt><?=_('优惠价格')?>：</dt>
        <dd><input id="dialog_edit_newbuyer_price" type="text" class="text w70"><em class="add-on"><i class="iconfont icon-iconyouhuiquan"></i></em></dd>
        <p id="dialog_edit_newbuyer_goods_error" style="display:none;font-size: 12px;text-align: center;"><label for="dialog_edit_newbuyer_goods_error" class="error"><i class='icon-exclamation-sign'></i><?=_('折扣价格不能为空。必须小于商品价格、且大于分享优惠价格')?></label></p>
    </dl>
    <div class="eject_con mb10">
        <div class="bottom"><a id="btn_edit_newbuyer_goods_submit" class="button bbc_seller_submit_btns" href="javascript:void(0);"><?=_('提交')?></a></div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        //编辑限时活动商品,修改折扣价格
        $('#table_list').on('click', '[optype="btn_edit_newbuyer_goods"]', function() {
            $('#dialog_edit_newbuyer_goods_error').hide();
            $edit_item = $(this).parents('tr.row_line');

            var newbuyer_goods_id = $(this).attr('data-newbuyer-goods-id');
            var newbuer_name = $(this).attr('data-newbuyer-name');
            var newbuyer_price = $edit_item.find('[optype="newbuyer_price"]').attr('data-newbuyer-price');
            var goods_price = $(this).attr('data-goods-price');
            var share_sum_price = $(this).attr('data-share-sum-price');
            var goods_price_format = $(this).attr('data-goods-price-format');
            var shere_sum_price_format = $(this).attr('data-share-sum-price-format');

            $('#dialog_newbuyer_goods_id').val(newbuyer_goods_id);
            $('#dialog_edit_newbuyer_name').val(newbuer_name);
            $('#dialog_edit_newbuyer_price').val(newbuyer_price);
            $('#dialog_edit_goods_price').attr('data-price',goods_price);
            $('#dialog_edit_share_sum_price').attr('data-share-sum-price',share_sum_price);
            $('#dialog_edit_goods_price').text(goods_price_format);
            $('#dialog_edit_share_sum_price').text(shere_sum_price_format);

            $('#dialog_edit_newbuyer_goods').YLB_show_dialog({width: 450, title: '修改价格'});
        });

        //提交修改后的价格
        $('#btn_edit_newbuyer_goods_submit').on('click', function(){
            var newbuyer_goods_id = $('#dialog_newbuyer_goods_id').val();
            var newbuyer_name = $('#dialog_edit_newbuyer_name').val();
            var newbuyer_price = Number($('#dialog_edit_newbuyer_price').val());
            var goods_price = Number($('#dialog_edit_goods_price').attr('data-price'));
            var share_sum_price = Number($('#dialog_edit_share_sum_price').attr('data-share-sum-price'));
            if(!isNaN(newbuyer_price) && newbuyer_price > 0 && newbuyer_price < goods_price && newbuyer_price > share_sum_price) {
                $.post(SITE_URL + '?ctl=Seller_Promotion_NewBuyer&met=editNewBuyerGoodsPrice&typ=json',
                    {newbuyer_id: newbuyer_goods_id,newbuyer_name:newbuyer_name, newbuyer_price: newbuyer_price},
                    function(d) {
                        if(d.status == 200) {
                            var data = d.data;
                            $edit_item.find('[optype="newbuyer_price"]').text('￥'+(data.newbuyer_price).toFixed(2));
                            $edit_item.find('[optype="newbuyer_price"]').attr('data-newbuyer-price',(data.newbuyer_price).toFixed(2));
                            $edit_item.find('[optype="btn_edit_newbuyer_goods"]').attr('data-newbuyer-name',newbuyer_name);

                            Public.tips.success('修改成功!');
                            $('#dialog_edit_newbuyer_goods').hide();
                        } else {
                            if(d.msg){
                                Public.tips.error(d.msg);
                            }else{
                                Public.tips.error('操作失败！');
                            }
                            $('#dialog_edit_newbuyer_goods').hide();
                        }
                    }, 'json'
                );
            } else {
                $('#dialog_edit_newbuyer_goods_error').show();
            }
        });
    });
</script>
<?php
include $this->view->getTplPath() . '/' . 'seller_footer.php';
?>



