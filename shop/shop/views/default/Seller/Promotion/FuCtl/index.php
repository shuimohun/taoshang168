<?php if (!defined('ROOT_PATH')){exit('No Permission');}?>
<?php
include $this->view->getTplPath() . '/' . 'seller_header.php';
?>
<link href="<?= $this->view->css?>/seller_center.css?ver=<?=VER?>" rel="stylesheet" type="text/css">
<link href="<?= $this->view->css_com ?>/jquery/plugins/dialog/green.css?ver=<?=VER?>" rel="stylesheet" type="text/css">
<script type="text/javascript" src="<?=$this->view->js_com?>/plugins/jquery.dialog.js" charset="utf-8"></script>
<style>
    .nscs-table-handle span a i{font-size: 25px;}
    .nscs-table-handle span a:hover{border:none;margin:1px;}
</style>
<div class="exchange">
	<div class="alert">
        <?php  if($this->self_support_flag){ ?>
            <ul>
                <li><?=_('1、点击添加活动按钮可以添加送福免单活动')?></li>
                <li><?=_('2、点击删除按钮可以删除送福免单活动')?></li>
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
                <li><?=_('2、点击添加活动按钮可以添加送福免单活动')?></li>
                <li><?=_('3、点击删除按钮可以删除送福免单活动')?></li>
                <li>4、<strong class="bbc_seller_color"><?=_('相关费用会在店铺的账期结算中扣除')?></strong>。</li>
            </ul>
        <?php } ?>
	</div>
	<div class="search fn-clear">
        <form id="search_form" method="get" action="<?=YLB_Registry::get('url')?>?ctl=Seller_Promotion_Fu&met=index&typ=e">
            <input type="hidden" name="ctl" value="<?=request_string('ctl')?>">
            <input type="hidden" name="met" value="<?=request_string('met')?>">
            <input type="hidden" name="typ" value="<?=request_string('typ')?>">
            <a class="button refresh" href="<?=YLB_Registry::get('url')?>?ctl=Seller_Promotion_Fu&met=index&typ=e"><i class="iconfont icon-huanyipi"></i></a>
            <a class="button btn_search_goods" href="javascript:void(0);"><i class="iconfont icon-btnsearch"></i><?=_('搜索')?></a>
            <input type="text" name="keyword" class="text w200" placeholder="<?=_('请输入商品名称')?>" value="<?=request_string('keyword')?>" />
            <select name="state">
                <option value="0">全部状态</option>
                <option value="<?=Fu_BaseModel::NORMAL?>" <?=Fu_BaseModel::NORMAL == request_int('state')?'selected':''?> ><?=Fu_BaseModel::$state_array_map[Fu_BaseModel::NORMAL]?></option>
                <option value="<?=Fu_BaseModel::END?>" <?=Fu_BaseModel::END == request_int('state')?'selected':''?>><?=Fu_BaseModel::$state_array_map[Fu_BaseModel::END]?></option>
                <option value="<?=Fu_BaseModel::CANCEL?>" <?=Fu_BaseModel::CANCEL == request_int('state')?'selected':''?>><?=Fu_BaseModel::$state_array_map[Fu_BaseModel::CANCEL]?></option>
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
            <th width="80"><?=_('点击多少钱')?></th>
            <th width="50"><?=_('次')?></th>
            <th width="50"><?=_('参加数量')?></th>
            <th width="50"><?=_('销量')?></th>
            <th width="50"><?=_('是否注册福')?></th>
			<th width="50"><?=_('状态')?></th>
            <th width="140"><?=_('操作')?></th>
		</tr>
        <?php if($data['items']) { foreach($data['items'] as $key=>$value) { ?>
            <tr class="row_line">
                <td width="50"><a href="<?=YLB_Registry::get('url')?>?ctl=Goods_Goods&met=goods&gid=<?=$value['goods_id']?>&typ=e" target="_blank"><img src="<?=image_thumb($value['goods_image'],30,30)?>" width="30" height="30"></a></td>
                <td class="tl"><a href="<?=YLB_Registry::get('url')?>?ctl=Goods_Goods&met=goods&gid=<?=$value['goods_id']?>&typ=e" target="_blank"><?=$value['goods_name']?></a></td>
                <td><?=format_money($value['goods_price'])?></td>
                <td><?=format_money($value['fu_price'])?></td>
                <td><?=$value['fu_total_times']?></td>
                <td><?=$value['fu_count']?></td>
                <td><?=$value['fu_count'] - $value['fu_stock']?></td>
                <td><?=$value['is_register']?'是':'否'?></td>
                <td><?=$value['fu_state_label']?></td>
                <td class="nscs-table-handle" >
                    <span class="edit"><a href="<?=YLB_Registry::get('url')?>?ctl=Seller_Promotion_Fu&met=index&op=detail&id=<?=$value['fu_id']?>"><i class="iconfont icon-btnclassify2"></i><?=_('详情')?></a></span>
                    <?php if($value['fu_state'] > Fu_BaseModel::NORMAL){?>
                        <span class="del">
                                <a data-param="{'ctl':'Seller_Promotion_Fu','met':'removeFuAct','id':'<?=$value['fu_id']?>'}" href="javascript:void(0)"><i class="iconfont icon-lajitong"></i><?=_('删除')?></a>
                            </span>
                    <?php }else{?>
                        <span class="lock">
                                <a alt="已参加活动，不能修改商品"><i class="iconfont icon-icopwd"></i>锁定</a>
                            </span>
                    <?php }?>
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

<script type="text/javascript">
    $(document).ready(function(){
        //编辑限时活动商品,修改折扣价格
        $('#table_list').on('click', '[optype="btn_edit_fu_goods"]', function() {
            $('#dialog_edit_fu_goods_error').hide();
            $edit_item = $(this).parents('tr.row_line');

            var fu_goods_id = $(this).attr('data-fu-goods-id');
            var newbuer_name = $(this).attr('data-fu-name');
            var fu_price = $edit_item.find('[optype="fu_price"]').attr('data-fu-price');
            var goods_price = $(this).attr('data-goods-price');
            var share_sum_price = $(this).attr('data-share-sum-price');
            var goods_price_format = $(this).attr('data-goods-price-format');
            var shere_sum_price_format = $(this).attr('data-share-sum-price-format');

            $('#dialog_fu_goods_id').val(fu_goods_id);
            $('#dialog_edit_fu_name').val(newbuer_name);
            $('#dialog_edit_fu_price').val(fu_price);
            $('#dialog_edit_goods_price').attr('data-price',goods_price);
            $('#dialog_edit_share_sum_price').attr('data-share-sum-price',share_sum_price);
            $('#dialog_edit_goods_price').text(goods_price_format);
            $('#dialog_edit_share_sum_price').text(shere_sum_price_format);

            $('#dialog_edit_fu_goods').YLB_show_dialog({width: 450, title: '修改价格'});
        });

        //提交修改后的价格
        $('#btn_edit_fu_goods_submit').on('click', function(){
            var fu_goods_id = $('#dialog_fu_goods_id').val();
            var fu_name = $('#dialog_edit_fu_name').val();
            var fu_price = Number($('#dialog_edit_fu_price').val());
            var goods_price = Number($('#dialog_edit_goods_price').attr('data-price'));
            var share_sum_price = Number($('#dialog_edit_share_sum_price').attr('data-share-sum-price'));
            if(!isNaN(fu_price) && fu_price > 0 && fu_price < goods_price && fu_price > share_sum_price) {
                $.post(SITE_URL + '?ctl=Seller_Promotion_Fu&met=editFuGoodsPrice&typ=json',
                    {fu_id: fu_goods_id,fu_name:fu_name, fu_price: fu_price},
                    function(d) {
                        if(d.status == 200) {
                            var data = d.data;
                            $edit_item.find('[optype="fu_price"]').text('￥'+(data.fu_price).toFixed(2));
                            $edit_item.find('[optype="fu_price"]').attr('data-fu-price',(data.fu_price).toFixed(2));
                            $edit_item.find('[optype="btn_edit_fu_goods"]').attr('data-fu-name',fu_name);

                            Public.tips.success('修改成功!');
                            $('#dialog_edit_fu_goods').hide();
                        } else {
                            if(d.msg){
                                Public.tips.error(d.msg);
                            }else{
                                Public.tips.error('操作失败！');
                            }
                            $('#dialog_edit_fu_goods').hide();
                        }
                    }, 'json'
                );
            } else {
                $('#dialog_edit_fu_goods_error').show();
            }
        });
    });
</script>
<?php
include $this->view->getTplPath() . '/' . 'seller_footer.php';
?>



