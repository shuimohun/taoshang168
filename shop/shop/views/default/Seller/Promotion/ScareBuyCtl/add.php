<?php if (!defined('ROOT_PATH')){exit('No Permission');}?>
<?php
include $this->view->getTplPath() . '/' . 'seller_header.php';
?>
<div class="form-style">
    <form method="post" id="form" action="<?=YLB_Registry::get('url')?>?ctl=Seller_Promotion_ScareBuy&met=add&typ=e">
        <dl>
            <dt><i>*</i><?=_('惠抢购标题')?>：</dt>
            <dd>
                <input type="text" name="scarebuy_name" class="text w450"/>
                <p class="hint"><?=_('长度最多可输入30个字符')?></p>
            </dd>
        </dl>
        <dl>
            <dt><?=_('惠抢购副标题')?>：</dt>
            <dd>
                <input type="text" name="scarebuy_remark" class="text w450"/>
                <p class="hint"><?=_('最多可输入60个字符')?></p>
            </dd>
        </dl>

        <dl>
            <dt><i>*</i><?=_('惠抢购商品')?>：</dt>
            <dd>
                <div class="selected-goods fn-hide" hidden="true">
                    <div class="goods-image"><img src="" /></div>
                    <div class="goods-name"></div>
                    <div class="goods-price"><?=_('销售价')?>：<span></span></div>
                    <div class="share-sum-price"><?=_('分享优惠')?>：<span></span></div>
                    <div class="goods-stock"><?=_('库存')?>：<span></span></div>
                </div>
                <a class="bbc_seller_btns button button_blue btn_show_search_goods" href="javascript:void(0);"><?=_('选择商品')?></a>
                <input type="hidden" name="goods_id" id="goods_id" value="" />
                <div class="search-goods-list fn-clear">
                    <div class="search-goods-list-hd">
                        <label><?=_('搜索店内商品')?></label>
                        <input type="text" name="goods_name" class="text w200" id="key" value="" placeholder="请输入商品名称"/>
                        <a class="button btn_search_goods" href="javascript:void(0);"><i class="iconfont icon-btnsearch"></i><?=_('搜索')?></a>
                    </div>
                    <div class="search-goods-list-bd fn-clear"></div>
                    <a href="javascript:void(0);" class="close btn_hide_search_goods">X</a>
                </div>
                <p class="hint"><?=_('点击上方输入框从已发布商品中选择要参加惠抢购的商品')?></p>
                <p class="hint"><?=_('惠抢购生效后该商品的所有规格SKU都将执行统一的惠抢购价格')?>。</p>
            </dd>
        </dl>

        <dl class="goods_price" style="display:none;">
            <dt><?=_('店铺价格')?>：</dt>
            <dd><span></span><input type="hidden" id="goods_price" value></dd>
        </dl>
        <dl class="share_sum_price" style="display:none;">
            <dt><?=_('分享优惠')?>：</dt>
            <dd><span></span><input type="hidden" id="share_sum_price" value></dd>
        </dl>
        <dl>
            <dt><i>*</i><?=_('惠抢购价格')?>：</dt>
            <dd>
                <input type="text" name="scarebuy_price" class="text" style="width:78px;"/><em><?=Web_ConfigModel::value('monetary_unit')?></em>
                <p class="hint"><?=_('必须是0.01~1000000之间的数字')?>(<?=_('单位：')?><?=Web_ConfigModel::value('monetary_unit')?>)</p>
            </dd>
        </dl>
        <dl>
            <dt><i>*</i><?=_('开始时间')?>：</dt>
            <dd>
                <input type="text" readonly="readonly" autocomplete="off" name="scarebuy_starttime" id="start_time" class="text w100"/><em><i class="iconfont icon-rili"></i></em>
                <p class="hint"><?=_('惠抢购开始时间不能小于')?><?=$data['combo']['combo_starttime']?></p>
            </dd>
        </dl>
        <dl>
            <dt><i>*</i><?=_('结束时间')?>：</dt>
            <dd>
                <input type="text" readonly="readonly" autocomplete="off" name="scarebuy_endtime" id="end_time" class="text w120"/>
                <p class="hint"><?=_('结束时间为开始时间后24小时，系统自动生成')?></p>
            </dd>
        </dl>
        <dl>
            <dt><?=_('惠抢购类别')?>：</dt>
            <dd>
                <select id="class_id" name="scarebuy_cat_id" class="w80">
                    <option value="0"><?=_('不限')?></option>
                </select>
                <select id="s_class_id" name="scarebuy_scat_id" class="w80">
                    <option value="0"><?=_('不限')?></option>
                </select>
                <span></span>
                <p class="hint"><?=_('请选择惠抢购商品的所属类别')?></p>
            </dd>
        </dl>
        <dl>
            <dt><?=_('参加数量')?>：</dt>
            <dd>
                <input type="text" name="scarebuy_count" value="0" class="text w70"/>
                <p class="hint"><?=_('参加惠抢购活动的数量，大于0且小于库存')?><span class="goods_stock bbc_seller_color">0</span><?=_('件')?></p>
            </dd>
        </dl>
        <?php if($this->self_support_flag){?>
            <dl>
                <dt><?=_('虚拟数量')?>：</dt>
                <dd>
                    <input type="text" name="scarebuy_virtual_quantity" value="0" class="text w70"/>
                    <p class="hint"><?=_('虚拟购买数量，只用于前台显示，不影响成交记录')?></p>
                </dd>
            </dl>
        <?php } ?>
        <dl>
            <dt><?=_('优惠数量')?>：</dt>
            <dd>
                <input type="text" name="scarebuy_upper_limit" value="0" class="text w70"/>
                <p class="hint"><?=_('购买商品的最大优惠量，超出数量部分按原价，不限数量请填 "0"')?></p>
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
<link href="<?= $this->view->css_com ?>/webuploader.css" rel="stylesheet" type="text/css">
<script type="text/javascript">
   $(document).ready(function(){
        Date.prototype.format = function(format)
        {
            var o = {
               "M+" : this.getMonth()+1, //month
               "d+" : this.getDate(),    //day
               "h+" : this.getHours(),   //hour
               "m+" : this.getMinutes(), //minute
               "s+" : this.getSeconds(), //second
               "q+" : Math.floor((this.getMonth()+3)/3),  //quarter
               "S" : this.getMilliseconds() //millisecond
            };
            if(/(y+)/.test(format)) format=format.replace(RegExp.$1,
               (this.getFullYear()+"").substr(4 - RegExp.$1.length));
            for(var k in o)if(new RegExp("("+ k +")").test(format))
               format = format.replace(RegExp.$1,
                   RegExp.$1.length==1 ? o[k] :
                       ("00"+ o[k]).substr((""+ o[k]).length));
            return format;
        };

        //开始时间限制
        var s_date = $.trim("<?=$data['combo']['combo_starttime']?>");
        var mindate =  new Date(Date.parse(s_date.replace(/-/g, "/")));

        //结束时间限制
        var combo_end_time = $.trim("<?=$data['combo']['combo_endtime']?>");
        var maxdate = new Date(Date.parse(combo_end_time.replace(/-/g, "/")));

        $('#start_time').datetimepicker({
            controlType: 'select',
            minDate:mindate,
            onShow:function( ct ){
            this.setOptions({
                minDate:mindate,
                minDateTime:mindate,
                maxDate:maxdate,
                maxDateTime:maxdate,
                })
            }
        }).on('change',function(){
            var stime = $('#start_time').val();
            if(stime){
                var day = $('#start_time').val().replace("-", "/").replace("-", "/");
                var curDate = new Date(day);
                var newDate=new Date(curDate.setDate(curDate.getDate()+1));
                $('#end_time').val((newDate.format("yyyy-MM-dd hh:mm:ss")));
            }
        });

        //显示
        $(".btn_show_search_goods").on('click', function() {
            $('.search-goods-list').show();
            $('.btn_search_goods').click();
        });

        //隐藏
        $(".btn_hide_search_goods").on('click', function() {
            $('.search-goods-list').hide();
        });

        //搜索店铺商品
        $('.btn_search_goods').on('click', function() {
            var url = "index.php?ctl=Seller_Promotion_ScareBuy&met=getShopGoods&typ=e";
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

            var goods_id = $(this).attr('data-goods-id');
            var goods_name = $(this).parents("li").find(".goods-name").html();
            var goods_price = $(this).attr('data-goods-price');
            var goods_price_format = $(this).parents("li").find(".goods-price span").html();
            var share_sum_price = $(this).attr('data-share-sum-price');
            var share_sum_price_format = $(this).parents("li").find(".share-sum-price span").html();
            var goods_image = $(this).parents("li").find("img").attr("src");
            var goods_stock = $(this).parents("li").find(".goods-stock span").html();

            $("input[name='goods_id']").val(goods_id);
            $(".selected-goods").find("img").attr("src",goods_image);
            $(".selected-goods").find(".goods-name").html(goods_name);
            $(".selected-goods").find(".goods-price").find("span").html(goods_price_format);
            $(".selected-goods").find(".share-sum-price").find("span").html(share_sum_price_format);
            $(".selected-goods").find(".goods-stock").find("span").html(goods_stock);

            $(".goods_price").find("span").html(goods_price_format);
            $(".share_sum_price").find("span").html(share_sum_price_format);
            $('.goods_stock').html(goods_stock);
            $("input[name='scarebuy_count']").val(goods_stock);

            $("#goods_price").val(goods_price);
            $("#share_sum_price").val(share_sum_price);

            $(".selected-goods").show();
            $(".goods_price").show();
            $(".share_sum_price").show();
            $('.search-goods-list').hide();
        });

        (function(data) {
           var s = '<option value="0">不限</option>';
           if (typeof data.children != 'undefined') {
               if (data.children[0]) {
                   $.each(data.children[0], function(k, v) {
                       s += '<option value="'+v+'">'+data['name'][v]+'</option>';
                   });
               }
           }
           $('#class_id').html(s).change(function() {
               var ss = '<option value="0">不限</option>';
               var v = this.value;
               if (parseInt(v) && data.children[v]) {
                   $.each(data.children[v], function(kk, vv) {
                       ss += '<option value="'+vv+'">'+data['name'][vv]+'</option>';
                   });
               }
               $('#s_class_id').html(ss);
           });
       })($.parseJSON('<?=$data['scarebuy_cat']?>'));

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
                            return '惠抢购价格必须小于商品价格！';
                        }else if(Number(element.value) <= Number(share_sum_price)){
                            return '惠抢购价格必须大于分享优惠价格！';
                        }
                    },

                     //自定义规则,大于当前时间，如果通过返回true，否则返回错误消息
                    greaterThanStartDate : function(element, param, field)
                    {
                        var date1 = new Date(Date.parse((element.value).replace(/-/g, "/")));//开始时间
                        param = JSON.parse(param);
                        var date2 = new Date(Date.parse(param.replace(/-/g, "/")));	//套餐开始时间

                        return date1 > date2 || "活动开始时间不能小于"+ param;
                    },
                    //自定义规则，小于套餐活动结束时间
                    lessThanEndDate  : function(element, param, field)
                    {
                        var date1 = new Date(Date.parse((element.value).replace(/-/g, "/")));//选择的结束时间
                        param = JSON.parse(param);
                        var date2 = new Date(Date.parse(param.replace(/-/g, "/")));  //套餐结束时间
                        return date1 < date2 || "活动结束时间不能大于"+ param;
                    },
                    //自定义规则，结束时间大于开始时间
                    startGrateThansEndDate  : function(element, param, field)
                    {
                        var s_time = $("#start_time").val();
                        var date1 = new Date(Date.parse(element.value.replace(/-/g, "/")));
                        var date2 = new Date(Date.parse(s_time.replace(/-/g, "/")));

                        return date1 > date2 || "结束时间必须大于开始时间";
                    },
                    myRemote: function(element){
                        var start_time = $("#start_time").val();
                        var end_time = $("#end_time").val();
                        var flag = false;
                        $.ajax({
                            url: SITE_URL + '?ctl=Seller_Promotion_ScareBuy&met=checkScareBuyGoods&typ=json',
                            type: 'POST',
                            data:{start_time: start_time,end_time:end_time,goods_id: element.value},
                            dataType: 'json',
                            async: false,
                            success: function(d){
                                if(d.status ==200){
                                    flag = true;
                                }else{
                                    flag = false;
                                }
                            }
                        });
                        return flag;
                    },
                    countStock: function(element){
                        var stock = $('.goods_stock').html();
                        if(Number(element.value) > Number(stock)){
                            return '参加活动的数量必须小于库存！';
                        }
                    }
                },
                messages: {
                    myRemote: "该商品已经参加了同时段的活动"
                },
                fields: {
                    'scarebuy_name': 'required;length[~30]',
                    'scarebuy_remark': 'length[~60]',
                    'scarebuy_starttime':'required;greaterThanStartDate["<?=$data['combo']['combo_starttime']?>"];lessThanEndDate["<?=$data['combo']['combo_endtime']?>"];',
                    'scarebuy_endtime': 'required;lessThanEndDate["<?=$data['combo']['combo_endtime']?>"];startGrateThansEndDate;',
                    'goods_id': 'required;integer[+];myRemote;',
                    'scarebuy_price': 'required;range[0.01~1000000];noGreaterThanGoodsPrice',
                    'scarebuy_virtual_quantity': 'integer[+0];',
                    'scarebuy_upper_limit': 'integer[+0];',
                    'scarebuy_count':'integer[+0];countStock;'
                },
                valid: function(form){
                    var me = this;
                    // 提交表单之前，hold住表单，并且在以后每次hold住时执行回调
                    me.holdSubmit(function(){
                        Public.tips.error('正在处理中...');
                    });
                    $.ajax({
                        url: "index.php?ctl=Seller_Promotion_ScareBuy&met=addScareBuy&typ=json",
                        data: $(form).serialize(),
                        type: "POST",
                        success:function(e){
                            if(e.status == 200){
                                var data = e.data;
                                Public.tips.success('操作成功!');
                                setTimeout(window.location.href='index.php?ctl=Seller_Promotion_ScareBuy&met=index&typ=e',5000);
                                //成功后跳转
                            }else{
                                if(e.msg){
                                    Public.tips.error(e.msg);
                                }else {
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

