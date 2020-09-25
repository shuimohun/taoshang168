<?php if (!defined('ROOT_PATH')){exit('No Permission');}?>
<?php
include $this->view->getTplPath() . '/' . 'seller_header.php';
?>
<link href="<?= $this->view->css?>/seller_center.css?ver=<?=VER?>" rel="stylesheet" type="text/css">
<link href="<?= $this->view->css_com ?>/jquery/plugins/dialog/green.css?ver=<?=VER?>" rel="stylesheet" type="text/css">
<script type="text/javascript" src="<?=$this->view->js_com?>/plugins/jquery.dialog.js" charset="utf-8"></script>

<style>
    .table-list-style td
    {
        padding: 12px 0.2%;
    }
</style>

<div class="exchange">
    <div class="alert">
        <strong><?=_('说明')?>：</strong>
        <ul>
            <li><?=_('1、限时折扣商品的时间段不能重叠')?></li>
            <li><?=_('2、点击添加商品按钮可以搜索并添加参加活动的商品，点击删除按钮可以删除该商品')?></li>
        </ul>
    </div>
    <table class="table-list-style mb10">
        <tbody>
        <tr>
            <td class="w80 tr"><strong><?=_('活动名称')?>：</strong></td>
            <td class="w140 tl"><?=@$data['discount_detail']['discount_name']?></td>
            <td class="w90 tr"><strong><?=_('开始时间')?>：</strong></td>
            <td class="w120 tl"><?=@$data['discount_detail']['discount_start_time']?></td>
            <td class="w90 tr"><strong><?=_('结束时间')?>：</strong></td>
            <td class="w120 tl"><?=@$data['discount_detail']['discount_end_time']?></td>
            <td class="w90 tr"><strong><?=_('购买下限')?>：</strong></td>
            <td class="w120 tl"><?=@$data['discount_detail']['discount_lower_limit']?></td>
            <td class="w90 tr"><strong><?=_('状态')?>：</strong></td>
            <td class="w70 tl"><?=@$data['discount_detail']['discount_state_label']?></td>
        </tr>
        </tbody>
    </table>
    <?php if($data['discount_detail']['discount_state'] == Discount_BaseModel::NORMAL){ ?>
        <div class="mb10 clearfix">
            <a class="button btn_search_goods fr btn_show_search_goods bbc_seller_btns"  href="javascript:void(0);"><i class="iconfont icon-jia"></i><?=_('添加商品')?></a>
        </div>
    <?php } ?>
    <div class="search-goods-list fn-clear" id="div_goods_select" style="line-height: 32px;">
        <div class="search-goods-list-hd">
            <label><?=_('第一步：搜索店内商品')?></label>
            <input id="search_goods_name" type="text w150" class="text" name="goods_name" value=""/>
            <a class="button btn_search_goods" id="btn_search_goods" href="javascript:void(0);"><i class="iconfont icon-btnsearch"></i><?=_('搜索')?></a>
        </div>
        <div  class="search-goods-list-bd fn-clear search-result" data-attr="<?=$data['discount_detail']['discount_id']?>"></div>
        <a href="javascript:void(0);" id="btn_hide_goods_select" class="close btn_hide_search_goods">X</a>
    </div>
    <table class="table-list-style" id="table_list" width="100%" cellpadding="0" cellspacing="0">
        <tr>
            <th width="50"></td>
            <th class="tl" width="250"><?=_('商品名称')?></th>
            <th width="80"><?=_('商品价格')?></th>
            <th width="80"><?=_('折扣价格')?></th>
            <th width="80"><?=_('分享优惠')?></th>
            <th width="80"><?=_('折扣率')?></th>
            <th width="80"><?=_('操作')?></th>
        </tr>
        <tbody id="discount_goods_list">
            <?php if($data['discount_goods_rows']){ foreach($data['discount_goods_rows'] as $key=>$value){ ?>
                <tr class="row_line">
                    <td width="50">
                        <div class="pic-thumb">
                            <a href="<?=YLB_Registry::get('url')?>?ctl=Goods_Goods&met=goods&gid=<?=$value['goods_id']?>&typ=e" target="_blank">
                                <img alt="" data-src="<?=image_thumb($value['goods_image'],36,36)?>" src="<?=$value['goods_image']?>" style="max-width:36px;max-height:36px;"/>
                            </a>
                        </div>
                    </td>
                    <td class="tl"><a target="_blank" href="<?=YLB_Registry::get('url')?>?ctl=Goods_Goods&met=goods&gid=<?=$value['goods_id']?>&typ=e"><?=$value['goods_name']?></a></td>
                    <td><?=format_money($value['goods_price'])?></td>
                    <td><span optype="discount_price" data-discount-price="<?=$value['discount_price']?>"><?=format_money($value['discount_price'])?></span></td>
                    <td><?=format_money($value['share_sum_price'])?></td>
                    <td><span optype="discount"><?=@$value['discount_percent']?></span><?=_('折')?></td>
                    <td>
                        <span class="edit"><a href="javascript:void(0);" optype="btn_edit_discount_goods" data-discount-goods-id="<?=$value['discount_goods_id']?>" data-goods-price-format = "<?=format_money($value['goods_price'])?>" data-goods-price="<?=$value['goods_price']?>" data-share-sum-price-format = "<?=format_money($value['share_sum_price'])?>"  data-share-sum-price="<?=$value['share_sum_price']?>"><i class="iconfont icon-zhifutijiao"></i><?=_('编辑')?></a></span>
                        <span class="del"><a optype="btn_del_discount_goods"  data-discount-goods-id="<?=$value['discount_goods_id']?>" data-param="{'ctl':'Seller_Promotion_Discount','met':'removeDiscountGoods','id':'<?=$value['discount_goods_id']?>'}" href="javascript:void(0)"><i class="iconfont icon-lajitong"></i><?=_('删除')?></a></span>
                    </td>
                </tr>
            <?php }}else{ ?>
                <tr class="row_line no-record">
                    <td colspan="99">
                        <div class="no_account">
                            <img src="<?=$this->view->img?>/ico_none.png">
                            <p>暂无符合条件的数据记录</p>
                        </div>
                    </td>
                </tr>
            <?php  } ?>
        </tbody>
    </table>
</div>

<!--编辑限时折扣商品价格-->
<div id="dialog_edit_discount_goods" class="eject_con" style="display:none;">
    <input id="dialog_discount_goods_id" type="hidden">
    <dl>
		<dt><?=_('商品价格')?>：</dt>
		<dd><span id="dialog_edit_goods_price" data-price = 0></dd>
    </dl>
    <dl>
        <dt><?=_('分享优惠')?>：</dt>
        <dd><span id="dialog_edit_share_sum_price" data-share-sum-price = 0></dd>
    </dl>
    <dl>
		<dt><?=_('折扣价格')?>：</dt>
		<dd><input id="dialog_edit_discount_price" type="text" class="text w70"><em class="add-on"><i class="iconfont icon-iconyouhuiquan"></i></em></dd>
		<p id="dialog_edit_discount_goods_error" style="display:none;font-size: 12px;text-align: center;"><label for="dialog_edit_discount_goods_error" class="error"><i class='icon-exclamation-sign'></i><?=_('折扣价格不能为空，必须小于商品价格，且必须大于分享优惠价')?></label></p>
    </dl>
    <div class="eject_con mb10">
        <div class="bottom"><a id="btn_edit_discount_goods_submit" class="button bbc_seller_submit_btns" href="javascript:void(0);"><?=_('提交')?></a></div>
    </div>
</div>

<!--动态添加限时折扣商品表格行元素-->
<table style="display:none;">
	<tbody id="table_list_template">
		<tr class="row_line">
			<td width="50">
				<div class="pic-thumb">
					<a href="<?=YLB_Registry::get('url')?>?ctl=Goods_Goods&met=goods&gid=__goodsid" target="_blank">
						<img alt="" data-src="__imageurl" style="max-width:36px;max-height:36px;"/>
					</a>
				</div>
			</td>
			<td class="tl">
				<a href="<?=YLB_Registry::get('url')?>?ctl=Goods_Goods&met=goods&gid=__goodsid" target="_blank">__goodsname</a>
			</td>
			<td><?=('￥')?>__goodsprice</td>
			<td><span optype="discount_price" data-discount-price="__discountprice"><?=('￥')?>__discountprice</span></td>
            <td><?=('￥')?>__sharesumprice</td>
			<td><span optype="discount">__discount</span><?=_('折')?></td>
			<td>
				<span class="edit"><a href="javascript:void(0);" optype="btn_edit_discount_goods" data-discount-goods-id="__discountgoodsid" data-goods-price-format = "__goodspriceformat" data-goods-price="__goodsprice" data-share-sum-price-format = "__sharesumpriceformat" data-share-sum-price="__sharesumprice" ><i class="iconfont icon-zhifutijiao"></i><?=_('编辑')?></a></span>
				<span class="del"><a optype="btn_del_discount_goods"  data-discount-goods-id="__discountgoodsid" data-param="{'ctl':'Seller_Promotion_Discount','met':'removeDiscountGoods','id':'__discountgoodsid'}" href="javascript:void(0)"><i class="iconfont icon-lajitong"></i><?=_('删除')?></a></span>
			</td>
		</tr>
	</tbody>
</table>

<script type="text/javascript">
    $(document).ready(function(){
        $edit_item = {};

        //显示商品搜索
        $('.btn_show_search_goods').on('click', function() {
            $('#div_goods_select').show();
        });

        //隐藏商品搜索
        $('#btn_hide_goods_select').on('click', function() {
            $('#div_goods_select').hide();
        });

        //搜索店铺商品
        $('.btn_search_goods').on('click', function() {
            var url = SITE_URL + '?ctl=Seller_Promotion_Discount&met=getShopGoods&typ=e';
            var key = $('#search_goods_name').val();
            $('.search-goods-list-bd').load(url,"&goods_name=" + key);
        });

        //店铺商品分页
        $('.search-goods-list-bd').on('click', '.page a', function() {
            $('.search-goods-list-bd').load($(this).attr('href'));
            return false;
        });
        $('.search-goods-list-bd').on('click', 'a.demo', function() {
            $('.search-goods-list-bd').load($(this).attr('href'));
            return false;
        });

        //添加限时折扣商品弹出窗口
        $('.search-goods-list-bd').on('click', '[data-type="btn_add_goods"]', function() {
            var data = $(this).data('param');
            $('#dialog_goods_id').val(data.goods_id);
            $('#dialog_goods_name').text(data.goods_name);
            $('#dialog_goods_price').text(data.goods_price);
            $('#dialog_share_sum_price').text(data.share_sum_price);
            $('#dialog_input_goods_price').val(data.goods_price);
            $('#dialog_input_share_sum_price').val(data.share_sum_price);
            $('#dialog_goods_img').attr('src', data.goods_image);
            $('#dialog_goods_stock').text(data.goods_stock);
            $('#dialog_add_discount_goods').YLB_show_dialog({width: 640,title: '限时折扣商品规则设定'});
            $('#dialog_discount_price').val('');
            $('#dialog_add_discount_goods_error').hide();
        });

        //添加限时折扣商品
        $('.search-goods-list-bd').on('click', '#btn_submit', function() {
            var discount_goods_param = {};
            discount_goods_param.goodsname = $('#dialog_goods_name').html();
            discount_goods_param.imageurl = $('#dialog_goods_img').attr('src');
            var goods_id = discount_goods_param.goodsid = $('#dialog_goods_id').val();
            var discount_id = discount_goods_param.discountid = Number($('.search-goods-list-bd').attr('data-attr'));
            var goods_price = discount_goods_param.goodsprice = Number($('#dialog_input_goods_price').val()).toFixed(2);
            var share_sum_price = discount_goods_param.sharesumprice = Number($('#dialog_input_share_sum_price').val()).toFixed(2);
            var discount_price = discount_goods_param.discountprice = (Number($('#dialog_discount_price').val())).toFixed(2);
            discount_goods_param.goodspriceformat = goods_price;
            discount_goods_param.sharesumpriceformat = share_sum_price;

            discount_goods_param.discount = (discount_price/goods_price*10).toFixed(1);

            $('#dialog_add_discount_goods_error').hide();

            if(discount_price > 0){
                if(Number(discount_price) < Number(goods_price)){
                    if(Number(discount_price) > Number(share_sum_price)){
                        $.post(SITE_URL + '?ctl=Seller_Promotion_Discount&met=addDiscountGoods&typ=json',{goods_id: goods_id,discount_id:discount_id,discount_price: discount_price},
                            function(d){
                                if(d &&　200 == d.status) {
                                    var data = d.data;
                                    $('#dialog_add_discount_goods').hide();
                                    $('#list_norecord').hide();

                                    Public.tips.success('操作成功!');
                                    discount_goods_param.discountgoodsid = data.discount_goods_id;
                                    var h = $('#table_list_template').html();
                                    h = h.replace(/__(\w+)/g, function(r, $1) {
                                        return discount_goods_param[$1];
                                    });
                                    var $h = $(h);
                                    $h.find('img[data-src]').each(function() {
                                        this.src = $(this).attr('data-src');
                                    });

                                    $('#discount_goods_list').prepend($h);
                                    $('#table_list').find('.no_account').remove();

                                    $("#bt_"+goods_id).html("<div class='button button_orange'>已加入本活动</div>");

                                } else {
                                    Public.tips.error(d.msg);
                                    $('#dialog_add_discount_goods').hide();
                                }
                            },
                            'json');
                    }else {
                        $('#dialog_add_discount_goods_error').find('.error').html('折扣价格必须大于分享优惠价格!')
                        $('#dialog_add_discount_goods_error').show();
                    }
                }else {
                    $('#dialog_add_discount_goods_error').find('.error').html('折扣价格必须小于商品价格!')
                    $('#dialog_add_discount_goods_error').show();
                }
            }else{
                $('#dialog_add_discount_goods_error').find('.error').html('折扣价格不能为空,且必须大于0!')
                $('#dialog_add_discount_goods_error').show();
            }
        });

        //编辑限时活动商品,修改折扣价格
        $('#table_list').on('click', '[optype="btn_edit_discount_goods"]', function() {
            $('#dialog_edit_discount_goods_error').hide();
            $edit_item = $(this).parents('tr.row_line');
            var discount_goods_id = $(this).attr('data-discount-goods-id');
            var discount_price = $edit_item.find('[optype="discount_price"]').attr('data-discount-price');
            var goods_price = $(this).attr('data-goods-price');
            var share_sum_price = $(this).attr('data-share-sum-price');
            var goods_price_format = $(this).attr('data-goods-price-format');
            var shere_sum_price_format = $(this).attr('data-share-sum-price-format');
            $('#dialog_discount_goods_id').val(discount_goods_id);
            $('#dialog_edit_goods_price').text(goods_price_format); //格式化的价格
            $('#dialog_edit_goods_price').attr('data-price',goods_price);
            $('#dialog_edit_share_sum_price').text(shere_sum_price_format);
            $('#dialog_edit_share_sum_price').attr('data-share-sum-price',share_sum_price);
            $('#dialog_edit_discount_price').val(discount_price);

            $('#dialog_edit_discount_goods').YLB_show_dialog({width: 450, title: '修改价格'});
        });

        //提交修改后的价格
        $('#btn_edit_discount_goods_submit').on('click', function(){
            var discount_goods_id = $('#dialog_discount_goods_id').val();
            var discount_price = Number($('#dialog_edit_discount_price').val());
            var goods_price = Number($('#dialog_edit_goods_price').attr('data-price'));
            var share_sum_price = Number($('#dialog_edit_share_sum_price').attr('data-share-sum-price'));

            if(!isNaN(discount_price) && discount_price > 0 && discount_price < goods_price && discount_price > share_sum_price) {
                $.post(SITE_URL + '?ctl=Seller_Promotion_Discount&met=editDiscountGoodsPrice&typ=json',
                    {discount_goods_id: discount_goods_id, discount_price: discount_price},
                    function(d) {
                        if(d.status == 200) {
                            var data = d.data;
                            $edit_item.find('[optype="discount_price"]').text(data.discount_price_format);
                            $edit_item.find('[optype="discount_price"]').attr('data-discount-price',(data.discount_price).toFixed(2));
                            $edit_item.find('[optype="discount"]').text((data.discount_price/goods_price*10).toFixed(1));

                            Public.tips.success('修改成功!');
                            $('#dialog_edit_discount_goods').hide();
                        } else {
                            if(d.msg){
                                Public.tips.error(d.msg);
                            }else{
                                Public.tips.error('操作失败！');
                            }
                            $('#dialog_edit_discount_goods').hide();
                        }
                    }, 'json'
                );
            } else {
                $('#dialog_edit_discount_goods_error').show();
            }
        });
		
    });
</script>

<?php
include $this->view->getTplPath() . '/' . 'seller_footer.php';
?>



