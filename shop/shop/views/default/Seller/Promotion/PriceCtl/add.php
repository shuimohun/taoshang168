<?php if (!defined('ROOT_PATH')){exit('No Permission');}?>
<?php
include $this->view->getTplPath() . '/' . 'seller_header.php';
?>
<div class="form-style">
    <form method="post" id="form" action="<?=YLB_Registry::get('url')?>?ctl=Seller_Promotion_Price&met=add&typ=e">
        <dl>
            <dt><i>*</i><?=_('优惠商品')?>：</dt>
            <dd>
                <div class="selected-goods fn-hide" hidden="true">
                    <div class="goods-image"><img src="" /></div>
                    <div class="goods-name"></div>
                    <div class="goods-price"><?=_('店铺价格')?>：<span></span></div>
                    <div class="share-sum-price"><?=_('分享优惠')?>：<span></span></div>
                    <div class="goods-stock"><?=_('库存')?>：<span></span></div>
                </div>
                <a class="bbc_seller_btns button button_blue btn_show_search_goods" href="javascript:void(0);"><?=_('选择商品')?></a>
                <input type="hidden" name="goods_id" value="" />
                <div class="search-goods-list fn-clear">
                    <div class="search-goods-list-hd">
                        <label><?=_('搜索店内商品')?></label>
                        <input type="text" name="goods_name" class="text w200" id="key" value="" placeholder="请输入商品名称"/>
                        <a class="button btn_search_goods" href="javascript:void(0);"><i class="iconfont icon-btnsearch"></i><?=_('搜索')?></a>
                    </div>
                    <div class="search-goods-list-bd fn-clear"></div>
                    <a href="javascript:void(0);" class="close btn_hide_search_goods">X</a>
                </div>
                <p class="hint"><?=_('点击上方输入框从已发布商品中选择要参加优惠的商品')?></p>
            </dd>
        </dl>
        <dl class="goods_price" style="display:none;">
            <dt><?=_('商品价格')?>：</dt>
            <dd><span></span><input type="hidden" id="goods_price" value></dd>
        </dl>
        <dl class="share_sum_price" style="display:none;">
            <dt><?=_('分享优惠')?>：</dt>
            <dd><span></span><input type="hidden" id="share_sum_price" value></dd>
        </dl>
        <dl>
            <dt><i>*</i><?=_('优惠价格')?>：</dt>
            <dd>
                <input type="text" name="zx_price" class="text" style="width:78px;"/><em><?=Web_ConfigModel::value('monetary_unit')?></em>
                <p class="hint"><?=_('优惠价格为该商品参加活动时的促销价格')?></p>
                <p class="hint"><?=_('必须是0.01~10优惠000之间的数字')?>(<?=_('单位：')?><?=Web_ConfigModel::value('monetary_unit')?>)</p>
            </dd>
        </dl>
        <dl>
            <dt></dt>
            <dd>
                <input type="submit" class="button button_blue bbc_seller_submit_btns" value="提交"  />
                <input type="hidden" name="act" value="save" />
            </dd>
        </dl>
    </form>
</div>

<script type="text/javascript" src="<?=$this->view->js_com?>/webuploader.js" charset="utf-8"></script>
<link href="<?= $this->view->css_com ?>/webuploader.css" rel="stylesheet" type="text/css">
<script type="text/javascript">
    $(document).ready(function(){
        $(".btn_show_search_goods").on('click', function() {
            $('.search-goods-list').show();
            $('.btn_search_goods').click();
        });
        $(".btn_hide_search_goods").on('click', function() {
            $('.search-goods-list').hide();
        });
        //搜索店铺商品
        $('.btn_search_goods').on('click', function() {
            var url = "index.php?ctl=Seller_Promotion_Price&met=getShopGoods&typ=e";
            var key = $("#key").val();
            $('.search-goods-list-bd').load(url,"&goods_name=" + key);
        });
        //分页
        $('.search-goods-list-bd').on('click', '.page a', function() {
            $('.search-goods-list-bd').load($(this).attr('href'));
            return false;
        });
        //选择商品
        $('.search-goods-list-bd').on('click', '[data-type="btn_add_goods"]', function(){

            $("input[name='goods_id']").val($(this).data('goods-id'));

            var goods_name = $(this).parents("li").find(".goods-name").html();
            var goods_price = $(this).parents("li").find(".goods-price span").html();
            var goods_image = $(this).parents("li").find("img").attr("src");
            var share_sum_price = $(this).parents("li").find(".share-sum-price span").html();
            var goods_stock = $(this).parents("li").find(".goods-stock span").html();

            $(".selected-goods").find(".goods-name").html(goods_name);
            $(".selected-goods").find(".goods-price").find("span").html(goods_price);
            $(".selected-goods").find("img").attr("src",goods_image);
            $(".selected-goods").find(".share-sum-price").find("span").html(share_sum_price);
            $(".selected-goods").find(".goods-stock").find("span").html(goods_stock);

            $(".goods_price").find("span").html(goods_price);
            $(".share_sum_price").find("span").html(share_sum_price);

            $("#goods_price").val($(this).data('goods-price'));
            $("#share_sum_price").val($(this).data('share-sum-price'));

            $(".selected-goods").show();
            $(".goods_price").show();
            $(".share_sum_price").show();
            $('.search-goods-list').hide();
        });

        $('#form').validator({
            debug:true,
            //ignore: ':hidden',
            theme: 'yellow_right',
            timely: true,
            stopOnError: true,
            rules:{
                noGreaterThanGoodsPrice:function(element) {
                    var goods_price = $("#goods_price").val();
                    var share_sum_price = $("#share_sum_price").val();
                    if(Number(element.value) >= Number(goods_price)){
                        return '优惠价格必须小于商品价格！';
                    }else if(Number(element.value) <= Number(share_sum_price)){
                        return '优惠价格必须大于商品分享优惠价格！';
                    }
                },
                myRemote: function(element){
                    var flag = false;
                    $.ajax({
                        url: SITE_URL + '?ctl=Seller_Promotion_Price&met=checkPrice&typ=json',
                        type: 'POST',
                        data:{goods_id: element.value},
                        dataType: 'json',
                        async: false,
                        success: function(d){
                            if(d.status ==200){
                                flag = true;
                            }
                            else{
                                flag = false;
                            }
                        }
                    });
                    return flag;
                }
            },
            messages: {
                myRemote: "该商品已经参加了本活动"
            },
            fields: {
                'goods_id': 'required;integer[+];myRemote;',
                'zx_price': 'required;range[0.01~1000000];noGreaterThanGoodsPrice',
            },
            valid: function(form){
                var me = this;
                // 提交表单之前，hold住表单，并且在以后每次hold住时执行回调
                me.holdSubmit(function(){
                    Public.tips.error('正在处理中...');
                });
                $.ajax({
                    url: "index.php?ctl=Seller_Promotion_Price&met=addPrice&typ=json",
                    data: $(form).serialize(),
                    type: "POST",
                    success:function(e){
                        if(e.status == 200){
                            Public.tips.success('操作成功!');
                            setTimeout(window.location.href='index.php?ctl=Seller_Promotion_Price&met=index&typ=e',5000);
                            //成功后跳转
                        }else{
                            if(e.msg){
                                Public.tips.error(e.msg);
                            }else{
                                Public.tips.error('操作失败！');
                            }
                        }
                        me.holdSubmit(false);
                    }
                });
            }
        });
    });
</script>
<?php
include $this->view->getTplPath() . '/' . 'seller_footer.php';
?>


