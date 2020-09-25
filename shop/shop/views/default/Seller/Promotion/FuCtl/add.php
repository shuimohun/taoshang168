<?php if (!defined('ROOT_PATH')){exit('No Permission');}?>
<?php
include $this->view->getTplPath() . '/' . 'seller_header.php';
?>
<div class="form-style">
    <form method="post" id="form" action="<?=YLB_Registry::get('url')?>?ctl=Seller_Promotion_Fu&met=add&typ=e">
        <dl>
            <dt><i>*</i><?=_('送福免单标题')?>：</dt>
            <dd>
                <input type="text" name="fu_name" class="text w450"/>
                <p class="hint"><?=_('长度最多可输入30个字符')?></p>
            </dd>
        </dl>
        <dl>
            <dt><i>*</i><?=_('送福免单商品')?>：</dt>
            <dd>
                <div class="selected-goods fn-hide" hidden="true">
                    <div class="goods-image"><img src="" /></div>
                    <div class="goods-name"></div>
                    <div class="goods-price"><?=_('商品价格')?>：<span></span></div>
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
        <dl class="fu_count" style="display:none;">
            <dt><?=_('参加数量')?>：</dt>
            <dd>
                <input type="text" name="fu_count" value="0" class="text w70"/>
                <p class="hint"><?=_('参加活动的数量，大于0且小于库存')?><span class="goods_stock bbc_seller_color">0</span><?=_('件')?></p>
            </dd>
        </dl>
        <dl class="goods_price" style="display:none;">
            <dt><?=_('商品价格')?>：</dt>
            <dd><span></span><input type="hidden" id="goods_price" value></dd>
        </dl>

        <dl style="border: none;">
            <dt><i>*</i>社交类型：</dt>
            <dd>
                <div class="share">
                    <div  class="share_d">
                        <span class="share_s wx_single"></span>
                        <input type="text" class="text w60 share_price" name="weixin" value=""/><em>次</em>
                    </div>
                    <div  class="share_d">
                        <span class="share_s wx_timeline"></span>
                        <input type="text" class="text w60 share_price" name="weixin_timeline" value=""/><em>次</em>
                    </div>
                    <div  class="share_d">
                        <span class="share_s sqq"></span>
                        <input type="text" class="text w60 share_price" name="sqq" value=""/><em>次</em>
                    </div>
                    <div  class="share_d">
                        <span class="share_s qzone"></span>
                        <input type="text" class="text w60 share_price" name="qzone" value=""/><em>次</em>
                    </div>
                    <div  class="share_d">
                        <span class="share_s weibo"></span>
                        <input type="text" class="text w60 share_price" name="tsina" value=""/><em>次</em>
                    </div>
                    <div class="clear"></div>
                </div>
                <p class="hint">消费者将商品分享到各社交平台可获得相应的送福减免额度，最终送福减免额度以消费者所分享平台设定数量决定</p>
            </dd>
        </dl>

        <dl style="border: none;">
            <dt></dt>
            <dd>
                <div>
                    <span>送福成功免单 <span class="fu_total_times bbc_color">0</span> 次</span>
                    <span>送福邀请好友注册减  <input type="text" class="text w60 bbc_color" name="fu_price" value="" readonly/> 元</span>
                </div>
            </dd>
        </dl>

        <dl>
            <dt></dt>
            <dd>
                <div>
                    <span>送福邀请好友注册在活动时间内购买送福减</span>
                    <input type="text" class="text w60" name="fu_t_price" value=""/><em>元</em>
                </div>
            </dd>
        </dl>
        <dl>
            <dt><?=_('是否注册会员点击')?>：</dt>
            <dd>
                <label>
                    <input type="radio" name="is_register" value="1" checked>
                    是
                </label>
                <label>
                    <input type="radio" name="is_register" value="0">
                    否
                </label>
            </dd>
        </dl>
        <dl>
            <dt><?=_('是否叠加免邮')?>：</dt>
            <dd>
                <label>
                    <input type="radio" name="is_mian" value="1" checked>
                    是
                </label>
                <label>
                    <input type="radio" name="is_mian" value="0">
                    否
                </label>
                <p class="hint"><?=_('参加活动的商品是否享受免运费额度')?></p>
            </dd>
        </dl>
        <dl>
            <dt><?=_('是否叠加满减')?>：</dt>
            <dd>
                <label>
                    <input type="radio" name="is_man" value="1" checked>
                    是
                </label>
                <label>
                    <input type="radio" name="is_man" value="0">
                    否
                </label>
                <p class="hint"><?=_('参加活动的商品是否享受满减送')?></p>
            </dd>
        </dl>
        <dl>
            <dt><?=_('是否叠加代金券')?>：</dt>
            <dd>
                <label>
                    <input type="radio" name="is_voucher" value="1" checked>
                    是
                </label>
                <label>
                    <input type="radio" name="is_voucher" value="0">
                    否
                </label>
                <p class="hint"><?=_('参加活动的商品是否享受代金券')?></p>
            </dd>
        </dl>
        <dl>
            <dt><?=_('是否叠加加价购')?>：</dt>
            <dd>
                <label>
                    <input type="radio" name="is_jia" value="1" checked>
                    是
                </label>
                <label>
                    <input type="radio" name="is_jia" value="0">
                    否
                </label>
                <p class="hint"><?=_('参加活动的商品是否享受加价购')?></p>
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
            var url = "index.php?ctl=Seller_Promotion_Fu&met=getShopGoods&typ=e";
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
            //$(".share_sum_price").find("span").html(share_sum_price);
            $("input[name='fu_count']").val(goods_stock);
            $('.goods_stock').html(goods_stock);
            $("#goods_price").val($(this).data('goods-price'));
            //$("#share_sum_price").val($(this).data('share-sum-price'));

            $(".selected-goods").show();
            $(".goods_price").show();
            $(".fu_count").show();
            $('.search-goods-list').hide();

            if(fu_total_times){
                var goods_price = $(this).data('goods-price');
                var unit_price = (goods_price / fu_total_times);
                $("input[name=fu_price]").val(unit_price.toFixed(2));
            }
        });

        var fu_total_times = 0;
        $(".share_price").change(function () {
            fu_total_times = 0;
            $(".share_price").each(function () {
               if($(this).val()){
                   fu_total_times += $(this).val() * 1;
               }
            });

            var goods_price = $('#goods_price').val();
            var unit_price = (goods_price / fu_total_times);

            $("input[name=fu_price]").val(unit_price.toFixed(2));
            $('.fu_total_times').html(fu_total_times);
        });

        $('#form').validator({
            debug:true,
            ignore: ':hidden',
            theme: 'yellow_right',
            timely: true,
            stopOnError: true,
            rules:{
                noGreaterThanGoodsPrice:function(element) {
                    var goods_price = $("#goods_price").val();
                    var share_sum_price = $("#share_sum_price").val();
                    if(Number(element.value) >= Number(goods_price)){
                        return '必须小于商品价格！';
                    }
                },
                myRemote: function(element){
                    var flag = false;
                    $.ajax({
                        url: SITE_URL + '?ctl=Seller_Promotion_Fu&met=checkFuGoods&typ=json',
                        type: 'POST',
                        data:{goods_id: element.value},
                        dataType: 'json',
                        async: false,
                        success: function(d){
                            if(d.status ==200){
                                flag = true;
                            }
                        }
                    });
                    return flag;
                },
            },
            messages: {
                myRemote: "该商品已经参加了同时段的活动",
            },
            fields: {
                'fu_name': 'required;length[~30]',
                'goods_id': 'required;integer[+];myRemote;',
                'fu_price': 'required;range[0.01~1000000];noGreaterThanGoodsPrice',
                'fu_t_price': 'required;range[0.01~1000000];',
                'weixin':'required;integer[+];',
                'weixin_timeline':'required;integer[+];',
                'sqq':'required;integer[+];',
                'qzone':'required;integer[+];',
                'tsina':'required;integer[+];',
            },
            valid: function(form){
                var me = this;
                // 提交表单之前，hold住表单，并且在以后每次hold住时执行回调
                me.holdSubmit(function(){
                    Public.tips.error('正在处理中...');
                });
                $.ajax({
                    url: "index.php?ctl=Seller_Promotion_Fu&met=addFu&typ=json",
                    data: $(form).serialize(),
                    type: "POST",
                    success:function(e){
                        if(e.status == 200){
                            Public.tips.success('操作成功!');
                            setTimeout(window.location.href='index.php?ctl=Seller_Promotion_Fu&met=index&typ=e',5000);
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
        }).on("click", ".bbc_seller_submit_btns", function (e) {
            var weixin = $('input[name=weixin]').val();
            var weixin_timeline = $('input[name=weixin_timeline]').val();
            var sqq = $('input[name=sqq]').val();
            var qzone = $('input[name=qzone]').val();
            var tsina = $('input[name=tsina]').val();
            var total_times = weixin * 1 + weixin_timeline * 1 + sqq * 1 + qzone * 1 + tsina * 1;

            if(fu_total_times != total_times ){
                Public.tips.error('社交类型点击总次数不正确！');
                return false;
            }

            $(e.delegateTarget).trigger("validate");
        });
    });
</script>
<?php
include $this->view->getTplPath() . '/' . 'seller_footer.php';
?>

