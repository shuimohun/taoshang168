<?php if (!defined('ROOT_PATH')){exit('No Permission');}?>
<?php
include $this->view->getTplPath() . '/' . 'seller_header.php';
?>

<link href="<?= $this->view->css_com ?>/jquery/plugins/dialog/green.css?ver=<?=VER?>" rel="stylesheet" type="text/css">
<script type="text/javascript" src="<?=$this->view->js_com?>/plugins/jquery.dialog.js" charset="utf-8"></script>
<link href="<?= $this->view->css?>/seller_center.css?ver=<?=VER?>" rel="stylesheet" type="text/css">

<div class="exchange">
	<div class="alert">
        <?php  if($this->self_support_flag){ ?>
            <ul>
                <li><?=_('1、点击添加活动按钮可以添加手机专享活动，点击管理按钮可以对手机专享活动内的商品进行管理')?></li>
                <li><?=_('2、点击删除按钮可以删除手机专享活动')?></li>
            </ul>
        <?php }else{ ?>
            <h4>
                <?php if($this->combo_flag){ ?><?=_('套餐过期时间')?>：<em class="red"></em><?=$combo_row['combo_end_time']?>。
                <?php }else{ ?>
                    <?=_('你还没有购买套餐或套餐已经过期，请购买或续费套餐')?>
                <?php  } ?>
            </h4>
            <ul>
                <li>1、只有使用移动设备（Wap、Android，IOS）购买参加促销的商品才能享受手机专享折扣。</li>
                <li><?=_('2、点击套餐管理按钮可以购买或续费套餐')?></li>
                <li><?=_('3、点击添加活动按钮可以添加手机专享活动，点击管理按钮可以对手机专享活动内的商品进行管理')?></li>
                <li><?=_('4、点击删除按钮可以删除手机专享活动')?></li>
                <li>4、<strong class="bbc_seller_color"><?=_('相关费用会在店铺的账期结算中扣除')?></strong>。</li>
            </ul>
        <?php } ?>
	</div>
	<table class="table-list-style" id="table_list" width="100%" cellpadding="0" cellspacing="0">
		<tr>
            <th width="50"></th>
			<th class="tl" width="300"><?=_('商品名称')?></th>
			<th width="100"><?=_('商品价格')?></th>
			<th width="100"><?=_('优惠价格')?></th>
            <th width="60"><?=_('分享优惠')?></th>
			<th width="80"><?=_('操作')?></th>
		</tr>
        <?php if($data['items']) { foreach($data["items"] as $key=>$value){ ?>
            <tr class="row_line">
                <td>
                    <a href="index.php?ctl=Goods_Goods&met=goods&gid=<?= $value['goods_id'] ?>" target="_blank"><img width="60" src="<?= $value['goods_image'] ?>"></a>
                </td>
                <td class="tl">
                    <a href="index.php?ctl=Goods_Goods&met=goods&gid=<?= $value['goods_id'] ?>" target="_blank"><?= $value['goods_name'] ?></a>
                </td>
                <td><?= format_money($value['goods_price']); ?></td>
                <td optype="zx_price"><?= format_money($value['zx_price']); ?></td>
                <td><?= format_money($value['share_sum_price']); ?></td>
                <td>
                    <span class="edit"><a href="javascript:void(0);" optype="btn_edit_price" data-zx-price="<?= $value['zx_price'] ?>" data-param="{price_id:'<?= $value['price_id'] ?>',goods_name:'<?=$value['goods_name']; ?>',goods_price:'<?=$value['goods_price']; ?>',goods_stock:'<?= $value['goods_stock'] ?>',share_sum_price:'<?= $value['share_sum_price'] ?>'}" ><i class="iconfont icon-zhifutijiao" ></i><?=_('编辑')?></a></span>
                    <span class="del"><a  data-param="{'ctl':'Seller_Promotion_Price','met':'removePriceAct','id':'<?=$value['price_id']?>'}" href="javascript:void(0)"><i class="iconfont icon-lajitong"></i><?=_('删除')?></a></span>
                </td>
            </tr>
        <?php } } else{ ?>
            <tr class="row_line">
                <td colspan="99">
                    <div class="no_account">
                        <img src="<?=$this->view->img?>/ico_none.png">
                        <p>手机专享商品列表暂无内容，请选择添加手机专享商品。</p>
                    </div>
                </td>
            </tr>
        <?php }?>
    </table>
    <?php if($page_nav){ ?>
        <div class="mm">
            <div class="page" ><?=$page_nav?></div>
        </div>
    <?php }?>
</div>

<!--编辑弹框-->
<div id="dialog_edit_price" class="eject_con" style="display:none;">
    <input id="dialog_price_id" type="hidden">
    <dl>
        <dt><?=_('商品名称')?>：</dt>
        <dd><span id="dialog_edit_goods_name"></dd>
    </dl>
    <dl>
        <dt><?=_('商品价格')?>：</dt>
        <dd><span id="dialog_edit_goods_price" data-goods-price = 0></dd>
    </dl>
    <dl>
        <dt><?=_('分享优惠')?>：</dt>
        <dd><span id="dialog_edit_share_sum_price" data-share-sum-price = 0></dd>
    </dl>
    <dl>
        <dt><?=_('库存')?>：</dt>
        <dd><span id="dialog_edit_goods_stock" data-goods-stock = 0></dd>
    </dl>
    <dl>
        <dt><?=_('优惠价格')?>：</dt>
        <dd><input id="dialog_edit_price_price" type="text" class="text w70"><em class="add-on"><i class="iconfont icon-iconyouhuiquan"></i></em></dd>
        <p id="dialog_edit_price_error" style="display:none;font-size: 12px;text-align: center;"><label for="dialog_edit_price_error" class="error"><i class='icon-exclamation-sign'></i><?=_('优惠价格不能为空。必须小于商品价格、且大于分享优惠价格')?></label></p>
    </dl>
    <div class="eject_con mb10">
        <div class="bottom"><a id="btn_edit_price_submit" class="button bbc_seller_submit_btns" href="javascript:void(0);"><?=_('提交')?></a></div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        //编辑限时活动商品,修改折扣价格
        $('#table_list').on('click', '[optype="btn_edit_price"]', function() {
            $('#dialog_edit_price_error').hide();
            $edit_item = $(this).parents('tr.row_line');
            eval('var _data = ' + $('[optype="btn_edit_price"]').data('param'));

            $('#dialog_price_id').val(_data.price_id);
            $('#dialog_edit_goods_name').html(_data.goods_name);
            $('#dialog_edit_goods_price').html('￥'+_data.goods_price);
            $('#dialog_edit_share_sum_price').html('￥'+_data.share_sum_price);
            $('#dialog_edit_goods_stock').html(_data.goods_stock);
            $('#dialog_edit_price_price').val($('[optype="btn_edit_price"]').data('zx-price'));

            $('#dialog_edit_goods_price').attr('data-goods-price',_data.goods_price);
            $('#dialog_edit_share_sum_price').attr('data-share-sum-price',_data.share_sum_price);
            $('#dialog_edit_goods_stock').attr('data-goods-stock',_data.goods_stock);

            $('#dialog_edit_price').YLB_show_dialog({width: 450, title: '修改价格'});
        });

        //提交修改后的价格
        $('#btn_edit_price_submit').on('click', function(){
            var price_id = $('#dialog_price_id').val();
            var goods_price = Number($('#dialog_edit_goods_price').attr('data-goods-price'));
            var share_sum_price = Number($('#dialog_edit_share_sum_price').attr('data-share-sum-price'));
            var price_price = Number($('#dialog_edit_price_price').val());

            if(!isNaN(price_price) && price_price > 0 && price_price < goods_price && price_price > share_sum_price) {
                var SITE_URL = "<?php echo YLB_Registry::get('url')?>";
                var url = SITE_URL+"?ctl=Seller_Promotion_Price&met=editPricePrice&typ=json";
                $.ajax({
                    url: url,
                    data:{price_id:price_id,zx_price:price_price},
                    type: 'post',
                    dataType: 'json',
                    success: function(msg) {
                        if(msg.status == 200) {
                            var data = msg.data;
                            $edit_item.find('[optype="zx_price"]').text('￥'+(data.zx_price).toFixed(2));
                            $edit_item.find('[optype="btn_edit_price"]').attr('data-zx-price',(data.zx_price).toFixed(2));

                            Public.tips.success('修改成功!');
                            $('#dialog_edit_price').hide();
                        } else {
                            if(msg.msg){
                                Public.tips.error(msg.msg);
                            }else{
                                Public.tips.error('操作失败！');
                            }
                            $('#dialog_edit_price').hide();
                        }
                    }
                });
            }else {
                $('#dialog_edit_price_error').show();
            }
        });
    });
</script>
<?php
include $this->view->getTplPath() . '/' . 'seller_footer.php';
?>



