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
            <li><?=_('店铺猜你喜欢推送最多只能推送20条')?></li>
        </ul>
    </div>
    <div class="mb10 clearfix">
            <a class="button btn_search_goods fr btn_show_search_goods bbc_seller_btns"  href="javascript:void(0);"><i class="iconfont icon-jia"></i><?=_('添加商品')?></a>
    </div>
    <div class="search-goods-list fn-clear" id="div_goods_select" style="line-height: 32px;">
        <div class="search-goods-list-hd">
            <label><?=_('搜索店内商品')?></label>
            <input id="search_goods_name" type="text w150" class="text" name="goods_name" value=""/>
            <a class="button btn_search_goods" id="btn_search_goods" href="javascript:void(0);"><i class="iconfont icon-btnsearch"></i><?=_('搜索')?></a>
        </div>
        <div  class="search-goods-list-bd fn-clear search-result" data-attr="<?=$data['discount_detail']['discount_id']?>"></div>
        <a href="javascript:void(0);" id="btn_hide_goods_select" class="close btn_hide_search_goods">X</a>
    </div>

    <table class="table-list-style" id="table_list" width="100%" cellpadding="0" cellspacing="0">
        <tr>
            <th class="tl" width="250"><?=_('商品名称')?></th>
            <th width="120"><?=_('商品价格')?></th>
            <th width="120"><?=_('分享后价格')?></th>
            <th width="80"><?=_('商品主图')?></th>
            <th width="80"><?=_('操作')?></th>
        </tr>
        <tbody id="discount_goods_list">
        <?php
        if($data['like_shop_goods'])
        {
            foreach($data['like_shop_goods'] as $key=>$value)
            {
                ?>
                <tr class="row_line">
                    <td class="tl"><a target="_blank" href="<?=YLB_Registry::get('url')?>?ctl=Goods_Goods&met=goods&type=goods&cid=<?=$value['common_id']?>&typ=e"><?=$value['common_name']?></a></td>
                    <td><del><?=format_money($value['common_price'])?></del></td>
                    <td><span optype="discount_price" data-shared-price="<?=$value['common_shared_price']?>"><?=format_money($value['common_shared_price'])?></span></td>
                    <td>
                        <div class="pic-thumb">
                            <a href="<?=YLB_Registry::get('url')?>?ctl=Goods_Goods&met=goods&type=goods&cid=<?=$value['common_id']?>&typ=e" target="_blank">
                                <img alt="" data-src="<?=image_thumb($value['common_image'],36,36)?>" src="<?=$value['common_image']?>" style="max-width:36px;max-height:36px;"/>
                            </a>
                        </div>
                    </td>
                    <td>
                        <span class="del"><a optype="btn_del_discount_goods"  data-like-id="<?=$value['like_id']?>" data-param="{'ctl':'Seller_Goods','met':'removeLikeGoods','id':'<?=$value['like_id']?>'}" href="javascript:void(0)"><i class="iconfont icon-lajitong"></i><?=_('删除')?></a></span>
                    </td>
                </tr>
                <?php
            }
        }
        else{
            ?>
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
        <dd><span id="dialog_edit_shared_price" data-shared-price = 0></dd>
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
        <td class="tl">
            <a href="" target="_blank">__commonname</a>
        </td>
        <td><del><?=('￥')?>__commonprice</del></td>
        <td><span optype="discount_price" data-discount-price="__discountprice"><?=('￥')?>__commonshared</span></td>
        <td>
                <div class="pic-thumb">
					<a href="__commonid" target="_blank">
						<img alt="" data-src="__commonimage" style="max-width:36px;max-height:36px;"/>
					</a>
				</div>
        <td>
            <span class="del"><a optype="btn_del_discount_goods"  data-like-id="__likeid" data-param="{'ctl':'Seller_Goods','met':'removeLikeGoods','id':'__likeid'}" href="javascript:void(0)"><i class="iconfont icon-lajitong"></i><?=_('删除')?></a></span>
        </td>
    </tr>
    </tbody>
</table>

<script type="text/javascript">
    $(document).ready(function(){

        $edit_item = {};

        $('.btn_show_search_goods').on('click', function() {
            $('#div_goods_select').show();
        });

        //隐藏商品搜索
        $('#btn_hide_goods_select').on('click', function() {
            $('#div_goods_select').hide();
        });

        //搜索店铺商品
        $('.btn_search_goods').on('click', function() {
            var url = SITE_URL + '?ctl=Seller_Goods&met=getShopGoods&typ=e';
            var key = $('#search_goods_name').val();
            url = key ? url + "&common_name=" + key : url;
            $('.search-goods-list-bd').load(url);
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


        //添加商品
        $('.search-goods-list-bd').on('click', '[data-type="btn_add_goods"]', function() {
            var param = {};
            var cat_id              = $(this).attr('data-cat-id');
            var cat_name            = $(this).attr('data-cat-name');
            var common_id           = $(this).attr('data-common-id');
            var common_name         = param.commonname   = $(this).attr('data-common-name');
            var common_price        = param.commonprice  = $(this).attr('data-common-price');
            var common_image        = param.commonimage  = $(this).attr('data-common-img');
            var common_shared_price = param.commonshared = $(this).attr('data-shared-price');
            var th = this;
            $.post(SITE_URL+'?ctl=Seller_Goods&met=addLikeShopGoods&typ=json',
                {cat_id:cat_id,cat_name:cat_name,common_id:common_id,common_name:common_name,common_price:common_price,common_shared_price:common_shared_price,common_image:common_image},
                function(r)
            {
                if(r.status == 200)
                {
                    var data = r.data;
                    Public.tips.success('操作成功!');
                    param.likeid = data.like_id;
                    var h = $('#table_list_template').html();
                    h = h.replace(/__(\w+)/g, function(r, $1) {
                        return param[$1];
                    });
                    var $h = $(h);
                    $h.find('img[data-src]').each(function() {
                        this.src = $(this).attr('data-src');
                    });
                    $('#discount_goods_list').prepend($h);
                    $('#table_list').find('.no_account').remove();
                    $(th).attr('class','button is_in');
                    $(th).html('已设定');
                }
                else if(r.status == 250)
                {
                    Public.tips.error(r.msg);
                    return false;
                }
                else
                {
                    window.location.href = SITE_URL;
                    return false;
                }
            },'json')

        });
    });
</script>

<?php
include $this->view->getTplPath() . '/' . 'seller_footer.php';
?>





